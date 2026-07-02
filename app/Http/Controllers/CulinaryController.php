<?php

namespace App\Http\Controllers;

use App\Models\Culinary;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CulinaryController extends Controller
{
    public function index(Request $request): View
    {
        return $this->renderIndex($request, 'khas');
    }

    public function cafes(Request $request): View
    {
        return $this->renderIndex($request, 'cafe');
    }

    public function show(Culinary $culinary): View
    {
        abort_unless($culinary->is_published, 404);

        return view('frontend.culinaries.show', [
            'settings' => WebsiteSetting::current(),
            'culinary' => $culinary,
        ]);
    }

    private function renderIndex(Request $request, string $mode): View
    {
        $settings = WebsiteSetting::current();
        $q = trim((string) $request->query('q', ''));
        $zone = trim((string) $request->query('zone', ''));

        $query = Culinary::query()
            ->where('is_published', true)
            ->where('type', $mode)
            ->latest('published_at');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', '%'.$q.'%')
                    ->orWhere('short_description', 'like', '%'.$q.'%')
                    ->orWhere('history', 'like', '%'.$q.'%')
                    ->orWhere('description', 'like', '%'.$q.'%')
                    ->orWhere('address', 'like', '%'.$q.'%');
            });
        }

        if ($zone !== '') {
            $query->where('location_zone', $zone);
        }

        $page = $mode === 'cafe'
            ? [
                'title' => 'Kuliner & Caffe di Cilacap',
                'description' => 'Temukan rekomendasi kuliner, tempat nongkrong, dan cafe favorit di Cilacap.',
                'reset_route' => 'culinary-cafes.index',
                'badge' => 'Cafe & Nongkrong',
            ]
            : [
                'title' => 'Kuliner Khas Cilacap',
                'description' => 'Rekomendasi makanan khas, sejarah singkat, bahan utama, dan lokasi.',
                'reset_route' => 'culinaries.index',
                'badge' => 'Kuliner Khas',
            ];

        return view('frontend.culinaries.index', [
            'settings' => $settings,
            'culinaries' => $query->paginate(9)->withQueryString(),
            'locationZones' => config('cilacap.location_zones'),
            'filters' => [
                'q' => $q,
                'zone' => $zone,
            ],
            'page' => $page,
        ]);
    }
}
