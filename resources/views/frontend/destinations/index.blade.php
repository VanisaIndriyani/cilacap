@php($title = 'Destinasi Wisata')
@php($metaDescription = 'Destinasi wisata Kabupaten Cilacap. Cari dan filter berdasarkan kategori.')
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <section class="mx-auto max-w-[1320px] px-3 sm:px-4 py-8 lg:py-10 lg:px-8">
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight">Destinasi Wisata</h1>
            <p class="mt-1.5 text-sm text-gray-600">Jelajahi pantai, alam, wisata keluarga, dan berbagai destinasi unggulan Cilacap.</p>
        </div>

        <div class="mb-6 rounded-xl border border-gray-200 bg-white p-3.5 sm:p-4 shadow-sm">
            <form method="GET" class="grid gap-2.5 sm:grid-cols-2 lg:grid-cols-5 items-end">
                <div class="sm:col-span-2 lg:col-span-2">
                    <label class="text-[11px] font-semibold text-gray-600">Cari</label>
                    <div class="mt-1 relative">
                        <i class="bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input name="q" value="{{ $filters['q'] }}" placeholder="Cari nama destinasi..." class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-9 pr-3 py-2 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>
                </div>
                <div>
                    <label class="text-[11px] font-semibold text-gray-600">Kategori</label>
                    <select name="category" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <option value="">Semua</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" @selected($filters['category'] === $cat->slug)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-[11px] font-semibold text-gray-600">Zona</label>
                    <select name="zone" class="mt-1 w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                        <option value="">Semua</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected($filters['zone'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-1.5 sm:justify-end">
                    <a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-[11px] font-semibold text-gray-700 transition hover:bg-gray-50">
                        Reset
                    </a>
                    <button class="btn btn-primary inline-flex items-center justify-center rounded-lg px-4 py-2 text-[11px] font-semibold transition">
                        <i class="bi-filter mr-1"></i>
                        Filter
                    </button>
                </div>
            </form>
            <div class="mt-2.5 text-[11px] text-gray-500 flex items-center gap-1.5">
                <i class="bi-info-circle"></i>
                Menampilkan {{ $destinations->total() }} destinasi
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($destinations as $item)
                @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                <a href="{{ route('destinations.show', $item) }}" class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-md transition hover:-translate-y-1 hover:border-primary/30 hover:shadow-lg">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-gray-100">
                        @if($img)
                            @if(Str::startsWith($img, 'http'))
                                <img src="{{ $img }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                            @elseif(Str::startsWith($img, 'img/'))
                                <img src="{{ asset($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                            @else
                                <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]">
                            @endif
                        @endif
                    </div>
                    <div class="p-4.5">
                        <div class="flex items-start justify-between gap-2.5">
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-bold tracking-tight truncate">{{ $item->name }}</div>
                                <div class="mt-1.5 text-[11px] text-gray-500">
                                    {{ $item->category?->name }}
                                    @if($item->location_zone)
                                        <span class="mx-1.5">•</span>{{ $locationZones[$item->location_zone] ?? $item->location_zone }}
                                    @endif
                                </div>
                            </div>
                            @if($item->ticket_price !== null)
                                <div class="rounded-xl bg-accent/15 px-2.5 py-1 text-[11px] font-bold text-accent whitespace-nowrap">Rp {{ number_format($item->ticket_price) }}</div>
                            @endif
                        </div>
                        <div class="mt-3 line-clamp-2 text-[13px] text-gray-600">{{ $item->short_description }}</div>
                        <div class="mt-4 flex items-center gap-1.5 text-[13px] font-bold text-primary">
                            <span>Lihat Detail</span>
                            <i class="bi-arrow-right text-base transition group-hover:translate-x-1"></i>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-2xl border border-gray-200 bg-white p-8 text-[13px] text-gray-500 lg:col-span-3 text-center">
                    Belum ada data destinasi sesuai filter.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $destinations->links() }}
        </div>
    </section>
@endsection
