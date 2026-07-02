<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culinary;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CulinaryController extends Controller
{
    private function culinaryTypes(): array
    {
        return [
            'khas' => 'Kuliner Khas',
            'cafe' => 'Kuliner & Caffe',
        ];
    }

    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));
        $published = $request->query('published', '');

        $types = $this->culinaryTypes();
        if (! array_key_exists($type, $types)) {
            $type = '';
        }

        $culinaries = Culinary::query()
            ->when($type !== '', fn ($query) => $query->where('type', $type))
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            })
            ->when($published !== '', function ($query) use ($published) {
                $query->where('is_published', $published === '1');
            })
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.culinaries.index', [
            'culinaries' => $culinaries,
            'culinaryTypes' => $types,
            'filters' => [
                'q' => $q,
                'type' => $type,
                'published' => (string) $published,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.culinaries.create', [
            'culinary' => new Culinary(),
            'locationZones' => config('cilacap.location_zones'),
            'culinaryTypes' => $this->culinaryTypes(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['images'] = Uploads::storeMany((array) $request->file('images', []), 'culinaries');
        $data['main_ingredients'] = Uploads::normalizeStringList($request->input('ingredients_text'));

        Culinary::query()->create($data);

        return redirect()->route('admin.culinaries.index', ['type' => $data['type']]);
    }

    public function edit(Culinary $culinary): View
    {
        return view('admin.culinaries.edit', [
            'culinary' => $culinary,
            'locationZones' => config('cilacap.location_zones'),
            'culinaryTypes' => $this->culinaryTypes(),
        ]);
    }

    public function update(Request $request, Culinary $culinary)
    {
        $data = $this->validated($request, $culinary);

        $existingImages = is_array($culinary->images) ? $culinary->images : [];
        $remove = (array) $request->input('remove_images', []);
        $remove = collect($remove)->filter()->values()->all();

        if ($remove !== []) {
            Uploads::deleteMany($remove);
            $existingImages = collect($existingImages)->reject(fn ($p) => in_array($p, $remove, true))->values()->all();
        }

        $newImages = Uploads::storeMany((array) $request->file('images', []), 'culinaries');
        $data['images'] = array_values(array_merge($existingImages, $newImages));
        $data['main_ingredients'] = Uploads::normalizeStringList($request->input('ingredients_text'));

        $culinary->update($data);

        return redirect()->route('admin.culinaries.index', ['type' => $data['type']]);
    }

    public function destroy(Culinary $culinary)
    {
        $images = is_array($culinary->images) ? $culinary->images : [];
        Uploads::deleteMany($images);

        $culinary->delete();

        return redirect()->route('admin.culinaries.index');
    }

    private function validated(Request $request, ?Culinary $culinary = null): array
    {
        $id = $culinary?->id;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:culinaries,slug,'.((string) $id)],
            'type' => ['required', 'in:khas,cafe'],
            'short_description' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'location_zone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'maps_url' => ['nullable', 'string'],
            'is_popular' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:180'],
            'images.*' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_popular'] = (bool) ($data['is_popular'] ?? false);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        return $data;
    }
}
