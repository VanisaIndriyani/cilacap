<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $published = $request->query('published', '');

        $destinations = Destination::query()
            ->with('category')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            })
            ->when($category !== '', function ($query) use ($category) {
                $query->whereHas('category', fn ($sub) => $sub->where('slug', $category));
            })
            ->when($published !== '', function ($query) use ($published) {
                $query->where('is_published', $published === '1');
            })
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.destinations.index', [
            'destinations' => $destinations,
            'categories' => DestinationCategory::query()->orderBy('sort_order')->orderBy('name')->get(),
            'filters' => [
                'q' => $q,
                'category' => $category,
                'published' => (string) $published,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.destinations.create', [
            'destination' => new Destination(),
            'categories' => DestinationCategory::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'locationZones' => config('cilacap.location_zones'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $images = Uploads::storeMany((array) $request->file('images', []), 'destinations');
        $data['images'] = $images;
        $data['facilities'] = Uploads::normalizeStringList($request->input('facilities_text'));

        Destination::query()->create($data);

        return redirect()->route('admin.destinations.index');
    }

    public function edit(Destination $destination): View
    {
        return view('admin.destinations.edit', [
            'destination' => $destination,
            'categories' => DestinationCategory::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'locationZones' => config('cilacap.location_zones'),
        ]);
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $this->validated($request, $destination);

        $existingImages = is_array($destination->images) ? $destination->images : [];

        $remove = (array) $request->input('remove_images', []);
        $remove = collect($remove)->filter()->values()->all();

        if ($remove !== []) {
            Uploads::deleteMany($remove);
            $existingImages = collect($existingImages)->reject(fn ($p) => in_array($p, $remove, true))->values()->all();
        }

        $newImages = Uploads::storeMany((array) $request->file('images', []), 'destinations');
        $data['images'] = array_values(array_merge($existingImages, $newImages));
        $data['facilities'] = Uploads::normalizeStringList($request->input('facilities_text'));

        $destination->update($data);

        return redirect()->route('admin.destinations.index');
    }

    public function destroy(Destination $destination)
    {
        $images = is_array($destination->images) ? $destination->images : [];
        Uploads::deleteMany($images);

        $destination->delete();

        return redirect()->route('admin.destinations.index');
    }

    private function validated(Request $request, ?Destination $destination = null): array
    {
        $id = $destination?->id;

        $data = $request->validate([
            'destination_category_id' => ['nullable', 'integer', 'exists:destination_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:destinations,slug,'.((string) $id)],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'location_zone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'maps_url' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'ticket_price' => ['nullable', 'integer', 'min:0'],
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

