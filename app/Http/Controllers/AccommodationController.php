<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccommodationController extends Controller
{
    public function index(Request $request): View
    {
        $settings = WebsiteSetting::current();
        $q = trim((string) $request->query('q', ''));
        $zone = trim((string) $request->query('zone', ''));
        $category = trim((string) $request->query('category', ''));

        $query = Accommodation::query()
            ->where('is_published', true)
            ->latest('published_at');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            });
        }

        if ($zone !== '') {
            $query->where('location_zone', $zone);
        }

        if ($category !== '') {
            $query->where('category', $category);
        }

        return view('frontend.accommodations.index', [
            'settings' => $settings,
            'accommodations' => $query->paginate(9)->withQueryString(),
            'locationZones' => config('cilacap.location_zones'),
            'categories' => config('cilacap.accommodation_categories'),
            'filters' => [
                'q' => $q,
                'zone' => $zone,
                'category' => $category,
            ],
        ]);
    }

    public function show(Accommodation $accommodation): View
    {
        abort_unless($accommodation->is_published, 404);

        return view('frontend.accommodations.show', [
            'settings' => WebsiteSetting::current(),
            'accommodation' => $accommodation,
        ]);
    }
}
