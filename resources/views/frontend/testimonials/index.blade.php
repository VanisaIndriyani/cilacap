@php($title = 'Testimoni Pengunjung')
@php($metaDescription = 'Baca pengalaman dan testimoni dari pengunjung yang sudah menjelajahi Kabupaten Cilacap.')
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <section class="mx-auto max-w-7xl px-3 sm:px-4 py-10 lg:py-12 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-800">Testimoni <span class="text-primary">Pengunjung</span></h1>
            <p class="mt-2 text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">Cerita pengalaman dari para pengunjung yang telah menjelajahi keindahan Cilacap.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Submit Testimonial Form -->
        <div class="mb-12 rounded-2xl border border-gray-200 bg-white p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="bi-pencil-square text-primary"></i>
                Kirim Testimoni Anda
            </h2>
            <form action="{{ route('testimonials.store') }}" method="POST" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @csrf
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Nama Anda</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Pekerjaan</label>
                    <input type="text" name="role" value="{{ old('role') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Rating</label>
                    <select name="rating" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">Pilih Rating</option>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>
                <div class="sm:col-span-4">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Pesan Anda</label>
                    <textarea name="message" rows="4" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('message') }}</textarea>
                </div>
                <div class="sm:col-span-4">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90 hover:shadow-lg w-full sm:w-auto">
                        <i class="bi-send"></i>
                        Kirim Testimoni
                    </button>
                </div>
            </form>
        </div>

        <!-- Testimonials List -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-8">
            @forelse($testimonials as $t)
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="grid place-items-center bg-accent text-dark text-sm font-bold" style="height: 40px; width: 40px; border-radius: 0.8rem;">
                            {{ mb_substr($t->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-800">{{ $t->name }}</div>
                            @if($t->role)
                                <div class="text-xs text-gray-500">{{ $t->role }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-1 text-sm leading-relaxed text-gray-600 mb-3">“{{ $t->message }}”</div>
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi-star-fill text-sm {{ $i <= $t->rating ? 'text-accent' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-gray-200 bg-white p-10 text-center text-gray-500 lg:col-span-3">
                    Belum ada testimoni. Jadilah yang pertama!
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        {{ $testimonials->links() }}
    </section>
@endsection
