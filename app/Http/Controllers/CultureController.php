<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CultureController extends Controller
{
    public function index(Request $request): View
    {
        $settings = WebsiteSetting::current();
        $q = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', ''));

        $query = Culture::query()
            ->where('is_published', true)
            ->latest('published_at');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%')
                    ->orWhere('description', 'like', '%'.$q.'%')
                    ->orWhere('article', 'like', '%'.$q.'%');
            });
        }

        if ($type !== '') {
            $query->where('type', $type);
        }

        return view('frontend.cultures.index', [
            'settings' => $settings,
            'cultures' => $query->paginate(9)->withQueryString(),
            'cultureTypes' => config('cilacap.culture_types'),
            'filters' => [
                'q' => $q,
                'type' => $type,
            ],
        ]);
    }

    public function show(Culture $culture): View
    {
        abort_unless($culture->is_published, 404);

        return view('frontend.cultures.show', [
            'settings' => WebsiteSetting::current(),
            'culture' => $culture,
        ]);
    }
}
