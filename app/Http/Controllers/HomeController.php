<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Culinary;
use App\Models\Culture;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = WebsiteSetting::current();

        $stats = [
            'destinations' => Destination::query()->where('is_published', true)->count(),
            'culinaries' => Culinary::query()->where('is_published', true)->count(),
            'accommodations' => Accommodation::query()->where('is_published', true)->count(),
            'cultures' => Culture::query()->where('is_published', true)->count(),
        ];

        $featuredDestinations = Destination::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->limit(6)
            ->get();

        $popularCulinaries = Culinary::query()
            ->where('is_published', true)
            ->where('is_popular', true)
            ->latest('published_at')
            ->limit(6)
            ->get();

        $popularAccommodations = Accommodation::query()
            ->where('is_published', true)
            ->where('is_popular', true)
            ->latest('published_at')
            ->limit(6)
            ->get();

        $featuredCultures = Culture::query()
            ->where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->limit(6)
            ->get();

        $testimonials = Testimonial::query()
            ->where('is_published', true)
            ->latest()
            ->limit(6)
            ->get();

        return view('frontend.home', [
            'settings' => $settings,
            'stats' => $stats,
            'featuredDestinations' => $featuredDestinations,
            'popularCulinaries' => $popularCulinaries,
            'popularAccommodations' => $popularAccommodations,
            'featuredCultures' => $featuredCultures,
            'testimonials' => $testimonials,
            'locationZones' => config('cilacap.location_zones'),
            'budgets' => config('cilacap.budgets'),
            'travelTypes' => config('cilacap.travel_types'),
        ]);
    }
}
