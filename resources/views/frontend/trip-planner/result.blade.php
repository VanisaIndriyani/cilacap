@php($title = 'Hasil Rekomendasi')
@php($metaDescription = 'Hasil itinerary dan rekomendasi perjalanan di Cilacap berdasarkan preferensi Anda.')
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm text-[--color-muted]">
                    <a href="{{ route('home') }}#jelajah" class="hover:text-primary">Jelajahi Cilacap</a>
                    <span class="mx-2">/</span>
                    <span>Hasil</span>
                </div>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight">Itinerary Perjalanan</h1>
                <p class="mt-2 text-sm text-[--color-muted]">
                    {{ $selectedPackage->name }} — {{ $input['days'] }} Hari, {{ $locationZones[$input['location_zone']] ?? $input['location_zone'] }}, {{ $budgets[$input['budget']] ?? $input['budget'] }}
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach($input['travel_types'] as $t)
                    <span class="rounded-full bg-accent/20 px-3 py-1 text-xs font-semibold text-[#92400E]">{{ $travelTypes[$t] ?? $t }}</span>
                @endforeach
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-6">
                @foreach($itineraryByDay as $day => $items)
                    <div class="rounded-3xl border border-primary/10 bg-[--color-surface] p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-primary text-white font-bold">
                                    {{ $day }}
                                </div>
                                <div class="text-lg font-semibold">Hari Ke-{{ $day }}</div>
                            </div>
                            <div class="rounded-full bg-primary/10 px-3 py-1 text-sm font-semibold text-primary">
                                {{ $items->count() }} agenda
                            </div>
                        </div>

                        <div class="mt-5 space-y-4">
                            @foreach($items as $it)
                                @php($model = $it->itemable)
                                @php($display = $it->title ?: ($model->name ?? 'Agenda'))
                                @php($time = $it->time ?: '--:--')

                                @php($link = null)
                                @if($model instanceof \App\Models\Destination)
                                    @php($link = route('destinations.show', $model))
                                @elseif($model instanceof \App\Models\Culinary)
                                    @php($link = route('culinaries.show', $model))
                                @elseif($model instanceof \App\Models\Accommodation)
                                    @php($link = route('accommodations.show', $model))
                                @elseif($model instanceof \App\Models\Culture)
                                    @php($link = route('cultures.show', $model))
                                @endif

                                <div class="relative pl-10">
                                    <div class="absolute left-[19px] top-2 h-full w-0.5 bg-primary/20"></div>
                                    <div class="absolute left-0 top-0 grid h-10 w-10 place-items-center rounded-full bg-primary text-white shadow-lg shadow-primary/30">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="rounded-2xl border border-[--color-border] bg-[--color-bg] p-5 shadow-sm hover:border-primary/30 transition">
                                        <div class="flex flex-wrap items-start justify-between gap-3">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2">
                                                    <div class="text-xs font-bold text-accent bg-accent/15 px-2 py-1 rounded-full">
                                                        {{ $time }}
                                                    </div>
                                                </div>
                                                <div class="mt-2 text-base font-semibold tracking-tight">
                                                    @if($link)
                                                        <a href="{{ $link }}" class="hover:text-primary hover:underline">{{ $display }}</a>
                                                    @else
                                                        {{ $display }}
                                                    @endif
                                                </div>
                                                @if($it->notes)
                                                    <div class="mt-2 text-sm text-[--color-muted]">{{ $it->notes }}</div>
                                                @endif
                                            </div>
                                            @if($model)
                                                <div class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">
                                                    {{ class_basename($model) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-primary/10 bg-gradient-to-br from-primary/5 to-accent/5 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="grid h-10 w-10 place-items-center rounded-2xl bg-accent text-dark shadow-sm">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="text-lg font-semibold">Ringkasan Paket</div>
                    </div>
                    <div class="mt-2 text-sm leading-relaxed text-[--color-muted]">
                        {!! nl2br(e($selectedPackage->description ?: 'Paket itinerary disusun berdasarkan preferensi Anda.')) !!}
                    </div>
                </div>

                <div class="rounded-3xl border border-primary/10 bg-[--color-surface] p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="grid h-10 w-10 place-items-center rounded-2xl bg-primary text-white shadow-sm">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-lg font-semibold">Rekomendasi</div>
                    </div>
                    <div class="mt-2 space-y-3 text-sm">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-primary/5">
                            <span class="font-semibold">Wisata</span>
                            <span class="rounded-full bg-primary text-white px-3 py-1 text-xs font-bold">{{ $recommendations['destinations']->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-accent/10">
                            <span class="font-semibold">Kuliner</span>
                            <span class="rounded-full bg-accent text-dark px-3 py-1 text-xs font-bold">{{ $recommendations['culinaries']->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-primary/5">
                            <span class="font-semibold">Penginapan</span>
                            <span class="rounded-full bg-primary text-white px-3 py-1 text-xs font-bold">{{ $recommendations['accommodations']->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-accent/10">
                            <span class="font-semibold">Budaya</span>
                            <span class="rounded-full bg-accent text-dark px-3 py-1 text-xs font-bold">{{ $recommendations['cultures']->count() }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}#jelajah" class="block">
                    <button class="w-full inline-flex items-center justify-center gap-2 rounded-2xl border-0 bg-primary px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Atur Ulang Preferensi
                    </button>
                </a>
            </aside>
        </div>

        <div class="mt-12 space-y-10">
            @if($recommendations['destinations']->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="grid h-10 w-10 place-items-center rounded-2xl bg-primary text-white shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold tracking-tight">Rekomendasi Wisata</h2>
                </div>
                <div class="mt-2 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendations['destinations'] as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('destinations.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/10">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-primary/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-base font-semibold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 line-clamp-2 text-sm text-[--color-muted]">{{ $item->short_description }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($recommendations['culinaries']->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="grid h-10 w-10 place-items-center rounded-2xl bg-accent text-dark shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold tracking-tight">Rekomendasi Kuliner</h2>
                </div>
                <div class="mt-2 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendations['culinaries'] as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('culinaries.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/10">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-accent/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-base font-semibold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 line-clamp-2 text-sm text-[--color-muted]">{{ $item->short_description }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($recommendations['accommodations']->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="grid h-10 w-10 place-items-center rounded-2xl bg-primary text-white shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold tracking-tight">Rekomendasi Penginapan</h2>
                </div>
                <div class="mt-2 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendations['accommodations'] as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('accommodations.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/10">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-primary/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-base font-semibold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 line-clamp-2 text-sm text-[--color-muted]">{{ $item->address }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($recommendations['cultures']->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="grid h-10 w-10 place-items-center rounded-2xl bg-accent text-dark shadow-sm">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold tracking-tight">Rekomendasi Budaya</h2>
                </div>
                <div class="mt-2 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendations['cultures'] as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('cultures.show', $item) }}" class="group overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/10">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-accent/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]">
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="text-base font-semibold tracking-tight">{{ $item->name }}</div>
                                <div class="mt-2 line-clamp-2 text-sm text-[--color-muted]">{{ $item->short_description }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection
