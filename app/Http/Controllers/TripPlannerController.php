<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Culinary;
use App\Models\Culture;
use App\Models\Destination;
use App\Models\TripPackage;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class TripPlannerController extends Controller
{
    public function recommend(Request $request): View
    {
        $validated = $request->validate([
            'days' => ['required', 'integer', 'min:1', 'max:5'],
            'location_zone' => ['required', 'string'],
            'budget' => ['required', 'string'],
            'travel_types' => ['required', 'array', 'min:1'],
            'travel_types.*' => ['string'],
        ]);

        $days = (int) $validated['days'];
        $locationZone = (string) $validated['location_zone'];
        $budget = (string) $validated['budget'];
        $travelTypes = collect($validated['travel_types'])->values()->all();

        $packages = TripPackage::query()
            ->where('is_active', true)
            ->where('days', $days)
            ->where('location_zone', $locationZone)
            ->where('budget', $budget)
            ->get();

        if ($packages->isEmpty()) {
            $packages = TripPackage::query()
                ->where('is_active', true)
                ->where('days', $days)
                ->where('location_zone', $locationZone)
                ->get();
        }

        if ($packages->isEmpty()) {
            $packages = TripPackage::query()
                ->where('is_active', true)
                ->where('days', $days)
                ->get();
        }

        $selected = $packages
            ->map(function (TripPackage $package) use ($travelTypes) {
                $packageTypes = collect($package->travel_types ?? []);
                $score = $packageTypes->intersect($travelTypes)->count();

                return [$package, $score];
            })
            ->sortByDesc(fn (array $row) => $row[1])
            ->map(fn (array $row) => $row[0])
            ->first();

        if (! $selected) {
            $selected = TripPackage::query()
                ->where('is_active', true)
                ->orderBy('days')
                ->first();
        }

        abort_if(! $selected, 404);

        $selected->load([
            'itineraryItems' => function ($query) {
                $query->with('itemable');
            },
        ]);

        $itineraryByDay = $selected->itineraryItems
            ->groupBy('day')
            ->sortKeys();

        [$destinations, $culinaries, $accommodations, $cultures] = $this->extractRecommendations($selected->itineraryItems);

        return view('frontend.trip-planner.result', [
            'settings' => WebsiteSetting::current(),
            'selectedPackage' => $selected,
            'itineraryByDay' => $itineraryByDay,
            'recommendations' => [
                'destinations' => $destinations,
                'culinaries' => $culinaries,
                'accommodations' => $accommodations,
                'cultures' => $cultures,
            ],
            'input' => [
                'days' => $days,
                'location_zone' => $locationZone,
                'budget' => $budget,
                'travel_types' => $travelTypes,
            ],
            'locationZones' => config('cilacap.location_zones'),
            'budgets' => config('cilacap.budgets'),
            'travelTypes' => config('cilacap.travel_types'),
        ]);
    }

    private function extractRecommendations(Collection $items): array
    {
        $destinations = collect();
        $culinaries = collect();
        $accommodations = collect();
        $cultures = collect();

        foreach ($items as $item) {
            $model = $item->itemable;

            if ($model instanceof Destination) {
                $destinations->push($model);
            } elseif ($model instanceof Culinary) {
                $culinaries->push($model);
            } elseif ($model instanceof Accommodation) {
                $accommodations->push($model);
            } elseif ($model instanceof Culture) {
                $cultures->push($model);
            }
        }

        return [
            $destinations->unique('id')->values(),
            $culinaries->unique('id')->values(),
            $accommodations->unique('id')->values(),
            $cultures->unique('id')->values(),
        ];
    }
}
