<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('GET') && ! $request->is('admin*')) {
            $ip = (string) $request->ip();
            $userAgent = (string) $request->userAgent();
            $ipHash = hash('sha256', $ip.'|'.$userAgent);
            $visitedOn = now()->toDateString();

            $cacheKey = 'visitor_logged:'.$ipHash.':'.$visitedOn;

            if (! Cache::has($cacheKey)) {
                Cache::put($cacheKey, true, now()->addDay());

                VisitorLog::query()->firstOrCreate(
                    [
                        'ip_hash' => $ipHash,
                        'visited_on' => $visitedOn,
                    ],
                    [
                        'ip' => $ip ?: null,
                        'user_agent' => $userAgent ?: null,
                        'path' => '/'.ltrim($request->path(), '/'),
                        'visited_at' => now(),
                    ],
                );
            }
        }

        return $next($request);
    }
}

