@php($title = 'Tambah Testimoni')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Tambah Testimoni</h1>
            <div class="mt-1 text-sm text-[--color-muted]">Masukkan testimoni pengunjung.</div>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data" class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
        @csrf

        <div class="grid gap-5 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Nama</label>
                <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Role (opsional)</label>
                <input name="role" value="{{ old('role') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Rating (1-5)</label>
                <input name="rating" value="{{ old('rating', 5) }}" inputmode="numeric" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Avatar (opsional)</label>
                <input type="file" name="avatar" accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div class="lg:col-span-2">
                <label class="text-sm font-semibold">Pesan</label>
                <textarea name="message" rows="4" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('message') }}</textarea>
            </div>
            <div class="flex items-center gap-2 pt-2 lg:col-span-2">
                <input id="is_published" type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_published', true))>
                <label for="is_published" class="text-sm font-semibold">Published</label>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan</button>
        </div>
    </form>
@endsection

