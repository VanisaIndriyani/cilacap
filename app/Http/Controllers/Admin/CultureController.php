<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CultureController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));
        $published = $request->query('published', '');

        $cultures = Culture::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%');
            })
            ->when($type !== '', fn ($query) => $query->where('type', $type))
            ->when($published !== '', function ($query) use ($published) {
                $query->where('is_published', $published === '1');
            })
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.cultures.index', [
            'cultures' => $cultures,
            'cultureTypes' => config('cilacap.culture_types'),
            'filters' => [
                'q' => $q,
                'type' => $type,
                'published' => (string) $published,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.cultures.create', [
            'culture' => new Culture(),
            'cultureTypes' => config('cilacap.culture_types'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['image'] = Uploads::store($request->file('image'), 'cultures');
        $data['images'] = Uploads::storeMany((array) $request->file('images', []), 'cultures');

        Culture::query()->create($data);

        return redirect()->route('admin.cultures.index');
    }

    public function edit(Culture $culture): View
    {
        return view('admin.cultures.edit', [
            'culture' => $culture,
            'cultureTypes' => config('cilacap.culture_types'),
        ]);
    }

    public function update(Request $request, Culture $culture)
    {
        $data = $this->validated($request, $culture);

        // Handle foto utama
        if ($request->hasFile('image')) {
            if ($culture->image) {
                Uploads::delete($culture->image);
            }
            $data['image'] = Uploads::store($request->file('image'), 'cultures');
        }

        // Handle foto galeri
        $existingImages = is_array($culture->images) ? $culture->images : [];
        $remove = (array) $request->input('remove_images', []);
        $remove = collect($remove)->filter()->values()->all();

        if ($remove !== []) {
            Uploads::deleteMany($remove);
            $existingImages = collect($existingImages)->reject(fn ($p) => in_array($p, $remove, true))->values()->all();
        }

        $newImages = Uploads::storeMany((array) $request->file('images', []), 'cultures');
        $data['images'] = array_values(array_merge($existingImages, $newImages));

        $culture->update($data);

        return redirect()->route('admin.cultures.index');
    }

    public function destroy(Culture $culture)
    {
        // Hapus foto utama
        if ($culture->image) {
            Uploads::delete($culture->image);
        }
        
        // Hapus foto galeri
        $images = is_array($culture->images) ? $culture->images : [];
        Uploads::deleteMany($images);

        $culture->delete();

        return redirect()->route('admin.cultures.index');
    }

    private function validated(Request $request, ?Culture $culture = null): array
    {
        $id = $culture?->id;

        $data = $request->validate([
            'type' => ['nullable', 'string', 'max:60'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:cultures,slug,'.((string) $id)],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'article' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:180'],
            'images.*' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        return $data;
    }
}

