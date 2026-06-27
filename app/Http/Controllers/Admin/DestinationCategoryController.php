<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $categories = DestinationCategory::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%');
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.destination-categories.index', [
            'categories' => $categories,
            'filters' => ['q' => $q],
        ]);
    }

    public function create(): View
    {
        return view('admin.destination-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:destination_categories,slug'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        DestinationCategory::query()->create($data);

        return redirect()->route('admin.destination-categories.index');
    }

    public function edit(DestinationCategory $destinationCategory): View
    {
        return view('admin.destination-categories.edit', [
            'category' => $destinationCategory,
        ]);
    }

    public function update(Request $request, DestinationCategory $destinationCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:destination_categories,slug,'.$destinationCategory->id],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        $destinationCategory->update($data);

        return redirect()->route('admin.destination-categories.index');
    }

    public function destroy(DestinationCategory $destinationCategory)
    {
        $destinationCategory->delete();

        return redirect()->route('admin.destination-categories.index');
    }
}

