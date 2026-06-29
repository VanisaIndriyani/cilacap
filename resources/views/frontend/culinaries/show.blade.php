@php($title = $culinary->meta_title ?: $culinary->name)
@php($metaDescription = $culinary->meta_description ?: ($culinary->short_description ?: 'Detail kuliner khas Cilacap.'))
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    @php($images = is_array($culinary->images) ? $culinary->images : [])
    @php($mapsEmbedUrl = $culinary->maps_embed_url)
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm text-[--color-muted]">
                    <a href="{{ route('culinaries.index') }}" class="hover:text-primary transition">Kuliner</a>
                    <span class="mx-2">/</span>
                    <span>{{ $culinary->name }}</span>
                </div>
                <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-[--color-text] sm:text-4xl lg:text-5xl">{{ $culinary->name }}</h1>
                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
                    @if($culinary->location_zone)
                        <span class="rounded-full bg-accent/10 px-4 py-1.5 font-semibold text-accent">{{ config('cilacap.location_zones')[$culinary->location_zone] ?? $culinary->location_zone }}</span>
                    @endif
                    @if($culinary->is_popular)
                        <span class="rounded-full bg-primary px-4 py-1.5 font-bold text-white">Populer</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10 grid gap-10 lg:grid-cols-3">
            <div class="lg:col-span-2 space-y-8">
                <div class="overflow-hidden rounded-3xl border border-accent/10 bg-[--color-surface] shadow-xl">
                    <div class="flex snap-x snap-mandatory gap-4 overflow-x-auto p-5">
                        @forelse($images as $path)
                            <div class="aspect-[16/10] min-w-[90%] snap-center overflow-hidden rounded-2xl bg-accent/10 sm:min-w-[75%] lg:min-w-[70%]">
                                @if(Str::startsWith($path, 'http'))
                                    <img src="{{ $path }}" alt="{{ $culinary->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
                                @elseif(Str::startsWith($path, 'img/'))
                                    <img src="{{ asset($path) }}" alt="{{ $culinary->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
                                @else
                                    <img src="{{ asset('storage/' . ltrim($path, '/')) }}" alt="{{ $culinary->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
                                @endif
                            </div>
                        @empty
                            <div class="aspect-[16/10] w-full overflow-hidden rounded-2xl bg-accent/10 flex items-center justify-center">
                                <svg class="h-20 w-20 text-accent/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endforelse
                    </div>
                </div>

                @if($culinary->history)
                    <div class="rounded-3xl border border-accent/10 bg-[--color-surface] p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-accent/10">
                                <svg class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-xl font-bold text-[--color-text]">Sejarah Kuliner</div>
                        </div>
                        <div class="mt-4 space-y-4 text-base leading-relaxed text-[--color-muted]">
                            {!! nl2br(e($culinary->history)) !!}
                        </div>
                    </div>
                @endif

                <div class="rounded-3xl border border-primary/10 bg-[--color-surface] p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                            <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xl font-bold text-[--color-text]">Deskripsi</div>
                    </div>
                    <div class="mt-4 space-y-4 text-base leading-relaxed text-[--color-muted]">
                        {!! nl2br(e($culinary->description ?: $culinary->short_description)) !!}
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-accent/10 bg-[--color-surface] p-7 shadow-xl">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                            <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xl font-bold text-[--color-text]">Bahan Utama</div>
                    </div>
                    @php($ingredients = is_array($culinary->main_ingredients) ? $culinary->main_ingredients : [])
                    <div class="mt-3 flex flex-wrap gap-2">
                        @forelse($ingredients as $i)
                            <span class="rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">{{ $i }}</span>
                        @empty
                            <div class="text-sm text-[--color-muted]">Belum ada data bahan.</div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-3xl border border-primary/10 bg-[--color-surface] p-7 shadow-xl">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-accent/10">
                            <svg class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="text-xl font-bold text-[--color-text]">Lokasi</div>
                    </div>
                    @if($culinary->address)
                        <div class="mb-4 flex items-start gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-primary"></div>
                            <div class="text-sm text-[--color-muted]">{{ $culinary->address }}</div>
                        </div>
                    @endif
                    @if($mapsEmbedUrl)
                        <div class="mt-4 overflow-hidden rounded-2xl border border-primary/10 bg-[--color-bg] shadow-inner">
                            <iframe src="{{ $mapsEmbedUrl }}" class="h-64 w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    @endif
                    @if($culinary->maps_url)
                        <a href="{{ $culinary->maps_url }}" target="_blank" rel="noopener" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-6 py-3 text-base font-bold text-white shadow-lg shadow-primary/30 transition hover:bg-primary/90 hover:-translate-y-1">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Buka di Google Maps
                        </a>
                    @else
                        <div class="mt-3 text-sm text-[--color-muted]">Belum ada tautan maps.</div>
                    @endif
                </div>
            </aside>
        </div>
    </section>
@endsection
