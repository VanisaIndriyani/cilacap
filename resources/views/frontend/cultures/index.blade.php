@php($title = 'Budaya Cilacap')
@php($metaDescription = 'Informasi adat istiadat, kesenian, upacara adat, pakaian adat, dan sejarah budaya Cilacap.')
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <section class="mx-auto max-w-7xl px-3 sm:px-4 py-10 lg:py-12 lg:px-8">
        <div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">Budaya Cilacap</h1>
            <p class="mt-2 text-sm sm:text-base text-gray-600">Adat istiadat, kesenian daerah, upacara adat, pakaian adat, dan sejarah budaya.</p>
        </div>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-3 sm:p-4 shadow-sm">
            <form method="GET" class="grid gap-2 lg:grid-cols-4 items-end">
                <div class="lg:col-span-2">
                    <label class="text-xs font-semibold text-gray-600">Cari</label>
                    <div class="mt-1 relative">
                        <i class="bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input name="q" value="{{ $filters['q'] }}" placeholder="Cari nama budaya..." class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-9 pr-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Kategori</label>
                    <select name="type" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <option value="">Semua</option>
                        @foreach($cultureTypes as $key => $label)
                            <option value="{{ $key }}" @selected($filters['type'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 lg:justify-end">
                    <a href="{{ route('cultures.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-50">
                        Reset
                    </a>
                    <button class="btn btn-primary inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-xs font-semibold transition">
                        <i class="bi-filter mr-1"></i>
                        Filter
                    </button>
                </div>
            </form>
            <div class="mt-2 text-xs text-gray-500 flex items-center gap-2">
                <i class="bi-info-circle"></i>
                Menampilkan {{ $cultures->total() }} budaya
            </div>
        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($cultures as $item)
                @php($img = $item->image ?? (is_array($item->images) ? ($item->images[0] ?? null) : null))
                <a href="{{ route('cultures.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-xl transition hover:-translate-y-2 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-accent/10">
                        @if($img)
                            @if(Str::startsWith($img, 'http'))
                                <img src="{{ $img }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                            @else
                                <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                            @endif
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-lg font-bold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 text-sm text-[--color-muted]">{{ $cultureTypes[$item->type] ?? $item->type }}</div>
                            </div>
                            @if($item->is_featured)
                                <div class="rounded-2xl bg-primary/15 px-4 py-2 text-sm font-bold text-primary">Unggulan</div>
                            @endif
                        </div>
                        <div class="mt-4 line-clamp-2 text-base text-[--color-muted]">{{ $item->short_description }}</div>
                        <div class="mt-6 flex items-center gap-2 text-base font-bold text-primary">
                            <span>Lihat Detail</span>
                            <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-10 text-base text-[--color-muted] lg:col-span-3">
                    Belum ada data budaya sesuai filter.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $cultures->links() }}
        </div>
    </section>
@endsection
