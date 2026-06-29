@php($title = 'Edit Penginapan')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Edit Penginapan</h1>
            <div class="mt-1 text-sm text-[--color-muted]">{{ $accommodation->name }}</div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('accommodations.show', $accommodation) }}" target="_blank" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Lihat</a>
            <a href="{{ route('admin.accommodations.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.accommodations.update', $accommodation->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold">Nama</label>
                    <input name="name" value="{{ old('name', $accommodation->name) }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Slug</label>
                    <input name="slug" value="{{ old('slug', $accommodation->slug) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Kategori</label>
                    <select name="category" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" @selected(old('category', $accommodation->category) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Zona</label>
                    <select name="location_zone" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone', $accommodation->location_zone) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Alamat</label>
                    <textarea name="address" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('address', $accommodation->address) }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold">Link Pembelian</label>
                    <input name="purchase_link" type="url" value="{{ old('purchase_link', $accommodation->purchase_link) }}" placeholder="https://www.agoda.com/..." class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <div class="mt-2 text-xs text-[--color-muted]">Isi dengan tautan langsung ke halaman pemesanan, misalnya Agoda, Traveloka, atau platform lainnya.</div>
                </div>
                <div>
                    <label class="text-sm font-semibold">Google Maps URL</label>
                    <textarea name="maps_url" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('maps_url', $accommodation->maps_url) }}</textarea>
                    <div class="mt-2 text-xs text-[--color-muted]">Boleh isi link share Google Maps biasa. Sistem akan otomatis menampilkan preview peta.</div>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Fasilitas (pisahkan dengan koma / baris baru)</label>
                    @php($fac = is_array($accommodation->facilities) ? implode("\n", $accommodation->facilities) : '')
                    <textarea name="facilities_text" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('facilities_text', $fac) }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold">Tambah Foto (Multi Upload)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div class="flex items-center gap-6 pt-8">
                    <label class="flex items-center gap-2 text-sm font-semibold">
                        <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_published', $accommodation->is_published))>
                        Published
                    </label>
                    <label class="flex items-center gap-2 text-sm font-semibold">
                        <input type="checkbox" name="is_popular" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_popular', $accommodation->is_popular))>
                        Populer
                    </label>
                </div>
                <div>
                    <label class="text-sm font-semibold">Meta Title</label>
                    <input name="meta_title" value="{{ old('meta_title', $accommodation->meta_title) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Meta Description (maks 180)</label>
                    <input name="meta_description" value="{{ old('meta_description', $accommodation->meta_description) }}" maxlength="180" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
            </div>

            @php($images = is_array($accommodation->images) ? $accommodation->images : [])
            @if(count($images))
                <div class="mt-6">
                    <div class="text-sm font-semibold">Foto Saat Ini (centang untuk hapus)</div>
                    <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($images as $path)
                            <label class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-bg]">
                                @if(Str::startsWith($path, 'http'))
                                    <img src="{{ $path }}" alt="Foto" class="h-32 w-full object-cover">
                                @elseif(Str::startsWith($path, 'img/'))
                                    <img src="{{ asset($path) }}" alt="Foto" class="h-32 w-full object-cover">
                                @else
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($path) }}" alt="Foto" class="h-32 w-full object-cover">
                                @endif
                                <div class="flex items-center gap-2 p-3 text-xs">
                                    <input type="checkbox" name="remove_images[]" value="{{ $path }}" class="h-4 w-4 rounded border-[--color-border] text-primary">
                                    <span class="text-[--color-muted]">Hapus</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan Perubahan</button>
        </div>
    </form>
@endsection
