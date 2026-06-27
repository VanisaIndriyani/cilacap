<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TripPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripPackageController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));
        $days = trim((string) $request->query('days', ''));
        $active = $request->query('active', '');

        $packages = TripPackage::query()
            ->withCount('itineraryItems')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('description', 'like', '%'.$q.'%');
            })
            ->when($days !== '' && is_numeric($days), fn ($query) => $query->where('days', (int) $days))
            ->when($active !== '', fn ($query) => $query->where('is_active', $active === '1'))
            ->orderBy('days')
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('admin.trip-packages.index', [
            'packages' => $packages,
            'locationZones' => config('cilacap.location_zones'),
            'budgets' => config('cilacap.budgets'),
            'travelTypes' => config('cilacap.travel_types'),
            'filters' => [
                'q' => $q,
                'days' => $days,
                'active' => (string) $active,
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.trip-packages.create', [
            'package' => new TripPackage(),
            'locationZones' => config('cilacap.location_zones'),
            'budgets' => config('cilacap.budgets'),
            'travelTypes' => config('cilacap.travel_types'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['travel_types'] = array_values((array) $request->input('travel_types', []));
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        TripPackage::query()->create($data);

        return redirect()->route('admin.trip-packages.index');
    }

    public function edit(TripPackage $tripPackage): View
    {
        $tripPackage->load('itineraryItems.itemable');

        return view('admin.trip-packages.edit', [
            'package' => $tripPackage,
            'locationZones' => config('cilacap.location_zones'),
            'budgets' => config('cilacap.budgets'),
            'travelTypes' => config('cilacap.travel_types'),
        ]);
    }

    public function update(Request $request, TripPackage $tripPackage)
    {
        $data = $this->validated($request);
        $data['travel_types'] = array_values((array) $request->input('travel_types', []));
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        $tripPackage->update($data);

        return redirect()->route('admin.trip-packages.edit', $tripPackage);
    }

    public function destroy(TripPackage $tripPackage)
    {
        $tripPackage->delete();

        return redirect()->route('admin.trip-packages.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'days' => ['required', 'integer', 'min:1', 'max:5'],
            'location_zone' => ['nullable', 'string', 'max:50'],
            'budget' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
