@php($title = 'Tambah Penginapan')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Tambah Penginapan</h1>
            <div class="mt-1 text-sm text-[--color-muted]">Masukkan data penginapan.</div>
        </div>
        <a href="{{ route('admin.accommodations.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('admin.accommodations.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold">Nama</label>
                    <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Slug (opsional)</label>
                    <input name="slug" value="{{ old('slug') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Kategori</label>
                    <select name="category" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" @selected(old('category') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Zona</label>
                    <select name="location_zone" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Alamat</label>
                    <textarea name="address" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('address') }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold">Harga / malam</label>
                    <input name="price_per_night" value="{{ old('price_per_night') }}" inputmode="decimal" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Google Maps URL (Embed)</label>
                    <textarea name="maps_url" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('maps_url') }}</textarea>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Fasilitas (pisahkan dengan koma / baris baru)</label>
                    <textarea name="facilities_text" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('facilities_text') }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold">Foto (Multi Upload)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div class="flex items-center gap-6 pt-8">
                    <label class="flex items-center gap-2 text-sm font-semibold">
                        <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_published'))>
                        Published
                    </label>
                    <label class="flex items-center gap-2 text-sm font-semibold">
                        <input type="checkbox" name="is_popular" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_popular'))>
                        Populer
                    </label>
                </div>
                <div>
                    <label class="text-sm font-semibold">Meta Title</label>
                    <input name="meta_title" value="{{ old('meta_title') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Meta Description (maks 180)</label>
                    <input name="meta_description" value="{{ old('meta_description') }}" maxlength="180" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan</button>
        </div>
    </form>
@endsection

