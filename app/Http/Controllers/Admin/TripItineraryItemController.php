<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Culinary;
use App\Models\Culture;
use App\Models\Destination;
use App\Models\TripItineraryItem;
use App\Models\TripPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripItineraryItemController extends Controller
{
    public function create(TripPackage $tripPackage): View
    {
        return view('admin.trip-itinerary-items.create', [
            'package' => $tripPackage,
            'item' => new TripItineraryItem(),
            'types' => $this->types(),
            'options' => $this->options(),
        ]);
    }

    public function store(Request $request, TripPackage $tripPackage)
    {
        $data = $this->validated($request, $tripPackage);
        [$type, $id] = $this->resolveItemable($request);

        $data['trip_package_id'] = $tripPackage->id;
        $data['itemable_type'] = $type;
        $data['itemable_id'] = $id;

        TripItineraryItem::query()->create($data);

        return redirect()->route('admin.trip-packages.edit', $tripPackage);
    }

    public function edit(TripPackage $tripPackage, TripItineraryItem $tripItineraryItem): View
    {
        abort_unless($tripItineraryItem->trip_package_id === $tripPackage->id, 404);

        $selectedType = $this->selectedType($tripItineraryItem);

        return view('admin.trip-itinerary-items.edit', [
            'package' => $tripPackage,
            'item' => $tripItineraryItem->load('itemable'),
            'types' => $this->types(),
            'options' => $this->options(),
            'selectedType' => $selectedType,
        ]);
    }

    public function update(Request $request, TripPackage $tripPackage, TripItineraryItem $tripItineraryItem)
    {
        abort_unless($tripItineraryItem->trip_package_id === $tripPackage->id, 404);

        $data = $this->validated($request, $tripPackage);
        [$type, $id] = $this->resolveItemable($request);

        $data['itemable_type'] = $type;
        $data['itemable_id'] = $id;

        $tripItineraryItem->update($data);

        return redirect()->route('admin.trip-packages.edit', $tripPackage);
    }

    public function destroy(TripPackage $tripPackage, TripItineraryItem $tripItineraryItem)
    {
        abort_unless($tripItineraryItem->trip_package_id === $tripPackage->id, 404);

        $tripItineraryItem->delete();

        return redirect()->route('admin.trip-packages.edit', $tripPackage);
    }

    private function validated(Request $request, TripPackage $package): array
    {
        return $request->validate([
            'day' => ['required', 'integer', 'min:1', 'max:'.$package->days],
            'time' => ['nullable', 'string', 'max:10'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'item_type' => ['required', 'string'],
            'item_id' => ['nullable', 'integer'],
        ]);
    }

    private function types(): array
    {
        return [
            'destination' => 'Wisata',
            'culinary' => 'Kuliner',
            'accommodation' => 'Penginapan',
            'culture' => 'Budaya',
            'custom' => 'Custom',
        ];
    }

    private function options(): array
    {
        return [
            'destination' => Destination::query()->orderBy('name')->limit(500)->get(['id', 'name']),
            'culinary' => Culinary::query()->orderBy('name')->limit(500)->get(['id', 'name']),
            'accommodation' => Accommodation::query()->orderBy('name')->limit(500)->get(['id', 'name']),
            'culture' => Culture::query()->orderBy('name')->limit(500)->get(['id', 'name']),
        ];
    }

    private function resolveItemable(Request $request): array
    {
        $type = (string) $request->input('item_type');
        $id = $request->input('item_id');

        if ($type === 'destination' && is_numeric($id)) {
            return [Destination::class, (int) $id];
        }
        if ($type === 'culinary' && is_numeric($id)) {
            return [Culinary::class, (int) $id];
        }
        if ($type === 'accommodation' && is_numeric($id)) {
            return [Accommodation::class, (int) $id];
        }
        if ($type === 'culture' && is_numeric($id)) {
            return [Culture::class, (int) $id];
        }

        return [null, null];
    }

    private function selectedType(TripItineraryItem $item): string
    {
        return match ($item->itemable_type) {
            Destination::class => 'destination',
            Culinary::class => 'culinary',
            Accommodation::class => 'accommodation',
            Culture::class => 'culture',
            default => 'custom',
        };
    }
}

