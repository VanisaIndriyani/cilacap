@php($title = 'Pengunjung')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div>
        <h1 class="text-2xl font-semibold tracking-tight">Pengunjung</h1>
        <div class="mt-1 text-sm text-[--color-muted]">Statistik kunjungan berdasarkan log pengunjung.</div>
    </div>

    <div class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <label class="text-sm font-semibold">Tanggal</label>
                <input type="date" name="date" value="{{ $filters['date'] }}" class="rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.visitor-logs.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm font-semibold hover:border-primary">Reset</a>
                <button class="rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">Filter</button>
            </div>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[--color-border] bg-[--color-bg]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Waktu</th>
                        <th class="px-5 py-3 font-semibold">IP</th>
                        <th class="px-5 py-3 font-semibold">Path</th>
                        <th class="px-5 py-3 font-semibold">UA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="border-b border-[--color-border] last:border-b-0">
                            <td class="px-5 py-3">{{ $log->visited_at?->format('d/m/Y H:i:s') }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ $log->ip }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ $log->path }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ \Illuminate\Support\Str::limit((string) $log->user_agent, 70) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $logs->links() }}
    </div>
@endsection

