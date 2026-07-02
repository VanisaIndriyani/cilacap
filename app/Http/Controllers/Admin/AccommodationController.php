<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccommodationController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $zone = trim((string) $request->query('zone', ''));
        $published = $request->query('published', '');

        $accommodations = Accommodation::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->when($zone !== '', fn ($query) => $query->where('location_zone', $zone))
            ->when($published !== '', function ($query) use ($published) {
                $query->where('is_published', $published === '1');
            })
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.accommodations.index', [
            'accommodations' => $accommodations,
            'locationZones' => config('cilacap.location_zones'),
            'categories' => config('cilacap.accommodation_categories'),
            'filters' => [
                'q' => $q,
                'category' => $category,
                'zone' => $zone,
                'published' => (string) $published,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.accommodations.create', [
            'accommodation' => new Accommodation(),
            'locationZones' => config('cilacap.location_zones'),
            'categories' => config('cilacap.accommodation_categories'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['images'] = Uploads::storeMany((array) $request->file('images', []), 'accommodations');

        Accommodation::query()->create($data);

        return redirect()->route('admin.accommodations.index');
    }

    public function edit(Accommodation $accommodation): View
    {
        return view('admin.accommodations.edit', [
            'accommodation' => $accommodation,
            'locationZones' => config('cilacap.location_zones'),
            'categories' => config('cilacap.accommodation_categories'),
        ]);
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $data = $this->validated($request, $accommodation);

        $existingImages = is_array($accommodation->images) ? $accommodation->images : [];
        $remove = (array) $request->input('remove_images', []);
        $remove = collect($remove)->filter()->values()->all();

        if ($remove !== []) {
            Uploads::deleteMany($remove);
            $existingImages = collect($existingImages)->reject(fn ($p) => in_array($p, $remove, true))->values()->all();
        }

        $newImages = Uploads::storeMany((array) $request->file('images', []), 'accommodations');
        $data['images'] = array_values(array_merge($existingImages, $newImages));

        $accommodation->update($data);

        return redirect()->route('admin.accommodations.index');
    }

    public function destroy(Accommodation $accommodation)
    {
        $images = is_array($accommodation->images) ? $accommodation->images : [];
        Uploads::deleteMany($images);

        $accommodation->delete();

        return redirect()->route('admin.accommodations.index');
    }

    private function validated(Request $request, ?Accommodation $accommodation = null): array
    {
        $id = $accommodation?->id;

        $data = $request->validate([
            'category' => ['nullable', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:accommodations,slug,'.((string) $id)],
            'location_zone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'purchase_link' => ['nullable', 'url', 'max:2048'],
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
