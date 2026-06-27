@php($title = 'Edit Testimoni')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Edit Testimoni</h1>
            <div class="mt-1 text-sm text-[--color-muted]">{{ $testimonial->name }}</div>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" enctype="multipart/form-data" class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-5 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Nama</label>
                <input name="name" value="{{ old('name', $testimonial->name) }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Role</label>
                <input name="role" value="{{ old('role', $testimonial->role) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Rating (1-5)</label>
                <input name="rating" value="{{ old('rating', $testimonial->rating) }}" inputmode="numeric" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Ganti Avatar (opsional)</label>
                <input type="file" name="avatar" accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div class="lg:col-span-2">
                <label class="text-sm font-semibold">Pesan</label>
                <textarea name="message" rows="4" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('message', $testimonial->message) }}</textarea>
            </div>
            <div class="flex items-center gap-6 pt-2 lg:col-span-2">
                <label class="flex items-center gap-2 text-sm font-semibold">
                    <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_published', $testimonial->is_published))>
                    Published
                </label>
                @if($testimonial->avatar_path)
                    <label class="flex items-center gap-2 text-sm font-semibold">
                        <input type="checkbox" name="remove_avatar" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary">
                        Hapus Avatar
                    </label>
                @endif
            </div>
            @if($testimonial->avatar_path)
                <div class="lg:col-span-2">
                    <div class="text-sm font-semibold">Avatar Saat Ini</div>
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($testimonial->avatar_path) }}" alt="Avatar" class="mt-2 h-20 w-20 rounded-2xl object-cover border border-[--color-border]">
                </div>
            @endif
        </div>

        <div class="mt-8 flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan Perubahan</button>
        </div>
    </form>
@endsection

