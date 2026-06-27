<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(Request $request): View
    {
        $settings = WebsiteSetting::current();
        $q = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $zone = trim((string) $request->query('zone', ''));

        $query = Destination::query()
            ->with('category')
            ->where('is_published', true)
            ->latest('published_at');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%')
                    ->orWhere('description', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            });
        }

        if ($category !== '') {
            $query->whereHas('category', function ($sub) use ($category) {
                $sub->where('slug', $category);
            });
        }

        if ($zone !== '') {
            $query->where('location_zone', $zone);
        }

        return view('frontend.destinations.index', [
            'settings' => $settings,
            'destinations' => $query->paginate(9)->withQueryString(),
            'categories' => DestinationCategory::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'locationZones' => config('cilacap.location_zones'),
            'filters' => [
                'q' => $q,
                'category' => $category,
                'zone' => $zone,
            ],
        ]);
    }

    public function show(Destination $destination): View
    {
        abort_unless($destination->is_published, 404);

        return view('frontend.destinations.show', [
            'settings' => WebsiteSetting::current(),
            'destination' => $destination->load('category'),
        ]);
    }
}
