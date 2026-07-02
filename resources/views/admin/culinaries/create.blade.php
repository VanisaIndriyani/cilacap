@php($title = 'Tambah Kuliner')
@extends('admin.layout', ['title' => $title])

@section('content')
    @php($selectedType = old('type', request('type', 'khas')))
    @php($typeLabel = $culinaryTypes[$selectedType] ?? 'Kuliner')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-6 px-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Kuliner</h1>
            <div class="mt-1 text-sm text-slate-500">Masukkan data {{ $typeLabel }}.</div>
        </div>
        <a href="{{ route('admin.culinaries.index', array_filter(['type' => request('type')])) }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
            <i class="bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.culinaries.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-egg-fried text-primary"></i>
                Informasi Dasar Kuliner
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Nama Kuliner</label>
                    <input name="name" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Slug
                        <span class="text-xs text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input name="slug" value="{{ old('slug') }}" class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Jenis Kuliner</label>
                    <select name="type" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        @foreach($culinaryTypes as $key => $label)
                            <option value="{{ $key }}" @selected(old('type', request('type', 'khas')) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Zona</label>
                    <select name="location_zone" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">-</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Alamat</label>
                    <input name="address" value="{{ old('address') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi Singkat</label>
                    <textarea name="short_description" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('short_description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-journal-text text-primary"></i>
                Detail & Media
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Sejarah Kuliner</label>
                    <textarea name="history" rows="4" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('history') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('description') }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Bahan Utama (pisahkan dengan koma / baris baru)</label>
                    <textarea name="ingredients_text" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('ingredients_text') }}</textarea>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Google Maps URL</label>
                    <textarea name="maps_url" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('maps_url') }}</textarea>
                    <div class="mt-2 text-xs text-slate-500">Boleh isi link share Google Maps biasa. Sistem akan otomatis menampilkan preview peta.</div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Foto (Multi Upload)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-2">
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_published" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_published'))>
                        Published
                    </label>
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_popular" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_popular'))>
                        Populer
                    </label>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Meta Description
                        <span class="text-xs text-slate-400 font-normal">(maks 180 karakter)</span>
                    </label>
                    <div class="relative">
                        <textarea name="meta_description" id="metaDescription" maxlength="180" rows="2" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all pr-12">{{ old('meta_description') }}</textarea>
                        <span id="charCount" class="absolute bottom-3 right-3 text-xs text-slate-400 font-semibold">0/180</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90 hover:shadow-lg w-full sm:w-auto">
                <i class="bi-check-circle"></i>
                Simpan Kuliner
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
