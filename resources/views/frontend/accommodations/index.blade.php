@php($title = 'Tempat Penginapan')
@php($metaDescription = 'Daftar hotel, homestay, villa, dan guest house di Cilacap.')
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <section class="mx-auto max-w-7xl px-3 sm:px-4 py-10 lg:py-12 lg:px-8">
        <div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">Tempat Penginapan</h1>
            <p class="mt-2 text-sm sm:text-base text-gray-600">Filter berdasarkan lokasi, kategori, dan rentang harga.</p>
        </div>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-3 sm:p-4 shadow-sm">
            <form method="GET" class="grid gap-2 sm:grid-cols-2 lg:grid-cols-7 items-end">
                <div class="sm:col-span-2 lg:col-span-2">
                    <label class="text-xs font-semibold text-gray-600">Cari</label>
                    <div class="mt-1 relative">
                        <i class="bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input name="q" value="{{ $filters['q'] }}" placeholder="Cari nama penginapan..." class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-9 pr-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Zona</label>
                    <select name="zone" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <option value="">Semua</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected($filters['zone'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Kategori</label>
                    <select name="category" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <option value="">Semua</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" @selected($filters['category'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Min Harga</label>
                    <input name="min_price" value="{{ $filters['min_price'] }}" inputmode="numeric" placeholder="0" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-600">Max Harga</label>
                    <input name="max_price" value="{{ $filters['max_price'] }}" inputmode="numeric" placeholder="1000000" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                </div>
                <div class="flex gap-2 sm:justify-end">
                    <a href="{{ route('accommodations.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-50">
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
                Menampilkan {{ $accommodations->total() }} penginapan
            </div>
        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($accommodations as $item)
                @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                <a href="{{ route('accommodations.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-xl transition hover:-translate-y-2 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-primary/10">
                        @if($img)
                            @if(Str::startsWith($img, 'http'))
                                <img src="{{ $img }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                            @elseif(Str::startsWith($img, 'img/'))
                                <img src="{{ asset($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                            @else
                                <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                            @endif
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="text-lg font-bold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 text-sm text-[--color-muted]">
                                    @if($item->category)
                                        {{ $categories[$item->category] ?? $item->category }}
                                    @endif
                                    @if($item->location_zone)
                                        <span class="mx-2">•</span>{{ $locationZones[$item->location_zone] ?? $item->location_zone }}
                                    @endif
                                </div>
                            </div>
                            @if($item->price_per_night !== null)
                                <div class="rounded-2xl bg-accent/20 px-4 py-2 text-sm font-bold text-accent">Rp {{ number_format((float) $item->price_per_night) }}</div>
                            @endif
                        </div>
                        <div class="mt-4 line-clamp-2 text-base text-[--color-muted]">{{ $item->address }}</div>
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
                    Belum ada data penginapan sesuai filter.
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $accommodations->links() }}
        </div>
    </section>
@endsection
