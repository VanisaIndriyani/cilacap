<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Culinary;
use App\Models\Culture;
use App\Models\Destination;
use App\Models\VisitorLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        return view('admin.dashboard', [
            'stats' => [
                'destinations' => Destination::query()->count(),
                'culinaries' => Culinary::query()->count(),
                'accommodations' => Accommodation::query()->count(),
                'cultures' => Culture::query()->count(),
                'visitors_today' => VisitorLog::query()->where('visited_on', $today)->count(),
            ],
        ]);
    }
}

