@php($title = 'Edit Budaya')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-6 px-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Edit Budaya</h1>
            <div class="mt-1 text-sm text-slate-500">{{ $culture->name }}</div>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('cultures.show', $culture) }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
                <i class="bi-eye"></i>
                Lihat
            </a>
            <a href="{{ route('admin.cultures.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
                <i class="bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.cultures.update', $culture->id) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-music-note-beamed text-primary"></i>
                Informasi Dasar Budaya
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Nama Budaya</label>
                    <input name="name" value="{{ old('name', $culture->name) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Slug
                        <span class="text-xs text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input name="slug" value="{{ old('slug', $culture->slug) }}" class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Tipe Budaya</label>
                    <select name="type" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">-</option>
                        @foreach($cultureTypes as $key => $label)
                            <option value="{{ $key }}" @selected(old('type', $culture->type) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Ganti Foto Utama</label>
                    <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi Singkat</label>
                    <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('short_description', $culture->short_description) }}</textarea>
                </div>
            </div>

            @if($culture->image)
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <i class="bi-image text-primary"></i>
                        Foto Utama Saat Ini
                    </div>
                    <div class="w-full max-w-xs">
                        <div class="aspect-video overflow-hidden rounded-xl border border-slate-200">
                            @if(Str::startsWith($culture->image, 'http'))
                                <img src="{{ $culture->image }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @elseif(Str::startsWith($culture->image, 'img/'))
                                <img src="{{ asset($culture->image) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . ltrim($culture->image, '/')) }}" alt="{{ $culture->name }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-journal-text text-primary"></i>
                Detail & Media
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi Lengkap</label>
                    <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('description', $culture->description) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Artikel Lengkap</label>
                    <textarea name="article" rows="5" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('article', $culture->article) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Tambah Foto Galeri (Multi Upload)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-2">
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_published" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_published', $culture->is_published))>
                        Published
                    </label>
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_featured', $culture->is_featured))>
                        Unggulan
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Meta Description
                        <span class="text-xs text-slate-400 font-normal">(maks 180 karakter)</span>
                    </label>
                    <div class="relative">
                        <textarea name="meta_description" id="metaDescription" maxlength="180" rows="2" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all pr-12">{{ old('meta_description', $culture->meta_description) }}</textarea>
                        <span id="charCount" class="absolute bottom-3 right-3 text-xs text-slate-400 font-semibold">0/180</span>
                    </div>
                </div>
            </div>

            @php($images = is_array($culture->images) ? $culture->images : [])
            @if(count($images))
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <i class="bi-images text-primary"></i>
                        Foto Galeri Saat Ini (centang untuk hapus)
                    </div>
                    <div class="grid gap-3 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($images as $path)
                            <label class="group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-50 cursor-pointer hover:border-primary transition-all">
                                @if(Str::startsWith($path, 'http'))
                                    <img src="{{ $path }}" alt="Foto" class="h-32 w-full object-cover">
                                @elseif(Str::startsWith($path, 'img/'))
                                    <img src="{{ asset($path) }}" alt="Foto" class="h-32 w-full object-cover">
                                @else
                                    <img src="{{ asset('storage/' . ltrim($path, '/')) }}" alt="Foto" class="h-32 w-full object-cover">
                                @endif
                                <div class="flex items-center gap-2 p-3 bg-white border-t border-slate-200">
                                    <input type="checkbox" name="remove_images[]" value="{{ $path }}" class="h-4 w-4 rounded border-slate-300 text-primary">
                                    <span class="text-xs text-slate-600 font-semibold">Hapus</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90 hover:shadow-lg w-full sm:w-auto">
                <i class="bi-check-circle"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const metaDescInput = document.getElementById('metaDescription');
            const charCount = document.getElementById('charCount');

            function updateCharCount() {
                const length = metaDescInput.value.length;
                charCount.textContent = length + '/180';
                charCount.className = 'absolute bottom-3 right-3 text-xs font-semibold ' + 
                    (length > 170 ? 'text-red-500' : length > 150 ? 'text-yellow-500' : 'text-slate-400');
            }

            metaDescInput.addEventListener('input', updateCharCount);
            updateCharCount();
        });
    </script>
@endsection
