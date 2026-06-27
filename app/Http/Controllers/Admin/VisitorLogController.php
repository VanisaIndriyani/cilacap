<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorLogController extends Controller
{
    public function index(Request $request): View
    {
        $date = trim((string) $request->query('date', ''));

        $logs = VisitorLog::query()
            ->when($date !== '', fn ($query) => $query->where('visited_on', $date))
            ->latest('visited_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.visitor-logs.index', [
            'logs' => $logs,
            'filters' => ['date' => $date],
        ]);
    }
}

