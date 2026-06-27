@php($title = $culture->meta_title ?: $culture->name)
@php($metaDescription = $culture->meta_description ?: ($culture->short_description ?: 'Detail budaya Cilacap.'))
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    @php($images = is_array($culture->images) ? $culture->images : [])
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm text-[--color-muted]">
                    <a href="{{ route('cultures.index') }}" class="hover:text-primary transition">Budaya</a>
                    <span class="mx-2">/</span>
                    <span>{{ $culture->name }}</span>
                </div>
                <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-[--color-text] sm:text-4xl lg:text-5xl">{{ $culture->name }}</h1>
                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
                    @if($culture->type)
                        <span class="rounded-full bg-primary/10 px-4 py-1.5 font-semibold text-primary">{{ config('cilacap.culture_types')[$culture->type] ?? $culture->type }}</span>
                    @endif
                    @if($culture->is_featured)
                        <span class="rounded-full bg-accent px-4 py-1.5 font-bold text-dark">Unggulan</span>
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
                                    <img src="{{ $path }}" alt="{{ $culture->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
                                @elseif(Str::startsWith($path, 'img/'))
                                    <img src="{{ asset($path) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
                                @else
                                    <img src="{{ asset('storage/' . ltrim($path, '/')) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover transition duration-500 hover:scale-[1.02]">
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

                <div class="rounded-3xl border border-primary/10 bg-[--color-surface] p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                            <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-xl font-bold text-[--color-text]">Deskripsi Lengkap</div>
                    </div>
                    <div class="mt-4 space-y-4 text-base leading-relaxed text-[--color-muted]">
                        {!! nl2br(e($culture->description ?: $culture->short_description)) !!}
                    </div>
                </div>

                @if($culture->article)
                    <div class="rounded-3xl border border-accent/10 bg-[--color-surface] p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-accent/10">
                                <svg class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="text-xl font-bold text-[--color-text]">Artikel</div>
                        </div>
                        <div class="mt-4 space-y-4 text-base leading-relaxed text-[--color-muted]">
                            {!! nl2br(e($culture->article)) !!}
                        </div>
                    </div>
                @endif
            </div>

            <aside class="space-y-6">
                @if($culture->image)
                    <div class="rounded-3xl border border-accent/10 bg-[--color-surface] p-7 shadow-xl">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-accent/10">
                                <svg class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-lg font-bold text-[--color-text]">Galeri Budaya</div>
                        </div>
                        <div class="aspect-square overflow-hidden rounded-2xl border border-accent/20">
                            @if(Str::startsWith($culture->image, 'http'))
                                <img src="{{ $culture->image }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @elseif(Str::startsWith($culture->image, 'img/'))
                                <img src="{{ asset($culture->image) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . ltrim($culture->image, '/')) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                    </div>
                @endif

                <div class="rounded-3xl border border-accent/10 bg-[--color-surface] p-7 shadow-xl">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-accent/10">
                            <svg class="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="text-lg font-bold text-[--color-text]">Informasi</div>
                    </div>
                    <div class="text-sm text-[--color-muted]">Geser foto pada slider untuk melihat dokumentasi budaya.</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
