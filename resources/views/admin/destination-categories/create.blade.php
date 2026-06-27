@php($title = 'Tambah Kategori Wisata')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Tambah Kategori Wisata</h1>
            <div class="mt-1 text-sm text-slate-500">Kategori digunakan untuk filter destinasi wisata.</div>
        </div>
        <a href="{{ route('admin.destination-categories.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
            <i class="bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.destination-categories.store') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md">
        @csrf

        <div class="grid gap-5 lg:grid-cols-1">
            <div class="lg:col-span-2 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Nama Kategori</label>
                    <input name="name" id="categoryName" value="{{ old('name') }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Slug
                        <span class="text-xs text-slate-400 font-normal">(opsional, otomatis dibuat dari nama)</span>
                    </label>
                    <div class="flex gap-2">
                        <input name="slug" id="categorySlug" value="{{ old('slug') }}" class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <button type="button" id="generateSlugBtn" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary/10 border border-primary/20 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/20">
                            <i class="bi-magic"></i>
                            Generate
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Urutan Tampil</label>
                    <input name="sort_order" value="{{ old('sort_order', 0) }}" inputmode="numeric" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="flex items-center gap-3">
                    <input id="is_active" type="checkbox" name="is_active" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" checked>
                    <label for="is_active" class="text-sm font-semibold text-slate-700">Aktifkan Kategori</label>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90 hover:shadow-lg">
                <i class="bi-check-circle"></i>
                Simpan Kategori
            </button>
        </div>
    </form>

    <script>
        // Auto-generate slug from name
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('categoryName');
            const slugInput = document.getElementById('categorySlug');
            const generateBtn = document.getElementById('generateSlugBtn');

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
            }

            // Auto-generate when user types in name field
            nameInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual || slugInput.value === '') {
                    slugInput.value = generateSlug(this.value);
                }
            });

            // Generate button click
            generateBtn.addEventListener('click', function() {
                slugInput.value = generateSlug(nameInput.value);
                slugInput.dataset.manual = 'true';
            });

            // Mark as manual when user edits slug
            slugInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });
        });
    </script>
@endsection
