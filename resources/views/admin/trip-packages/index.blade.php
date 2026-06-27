@php($title = 'Trip Planner')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Trip Planner</h1>
            <div class="mt-1 text-sm text-[--color-muted]">Atur paket itinerary 1-5 hari untuk fitur rekomendasi.</div>
        </div>
        <a href="{{ route('admin.trip-packages.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">
            Tambah Paket
        </a>
    </div>

    <div class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-5 shadow-sm">
        <form method="GET" class="grid gap-3 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <input name="q" value="{{ $filters['q'] }}" placeholder="Cari paket..." class="w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <select name="days" class="w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">Semua Hari</option>
                    @for($d=1;$d<=5;$d++)
                        <option value="{{ $d }}" @selected($filters['days'] == (string) $d)>{{ $d }} Hari</option>
                    @endfor
                </select>
            </div>
            <div>
                <select name="active" class="w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">Semua Status</option>
                    <option value="1" @selected($filters['active'] === '1')>Aktif</option>
                    <option value="0" @selected($filters['active'] === '0')>Nonaktif</option>
                </select>
            </div>
            <div class="lg:col-span-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-[--color-muted]">Menampilkan {{ $packages->total() }} paket</div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.trip-packages.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm font-semibold hover:border-primary">Reset</a>
                    <button class="rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[--color-border] bg-[--color-bg]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold">Hari</th>
                        <th class="px-5 py-3 font-semibold">Zona</th>
                        <th class="px-5 py-3 font-semibold">Budget</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $p)
                        <tr class="border-b border-[--color-border] last:border-b-0">
                            <td class="px-5 py-3">
                                <div class="font-semibold">{{ $p->name }}</div>
                                <div class="mt-1 text-xs text-[--color-muted]">{{ $p->itinerary_items_count }} item itinerary</div>
                            </td>
                            <td class="px-5 py-3">{{ $p->days }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ $locationZones[$p->location_zone] ?? $p->location_zone }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ $budgets[$p->budget] ?? $p->budget }}</td>
                            <td class="px-5 py-3">
                                @if($p->is_active)
                                    <span class="rounded-full bg-primary/15 px-3 py-1 text-xs font-semibold text-primary">Aktif</span>
                                @else
                                    <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.trip-packages.edit', $p->id) }}" class="rounded-xl border border-[--color-border] bg-[--color-bg] px-3 py-2 text-xs font-semibold hover:border-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.trip-packages.destroy', $p->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:border-red-300">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $packages->links() }}
    </div>
@endsection
