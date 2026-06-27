@php($title = 'Kategori Wisata')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Kategori Wisata</h1>
            <div class="mt-1 text-sm text-[--color-muted]">Kelola kategori destinasi wisata untuk filter di frontend.</div>
        </div>
        <a href="{{ route('admin.destination-categories.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">
            Tambah Kategori
        </a>
    </div>

    <div class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex-1">
                <input name="q" value="{{ $filters['q'] }}" placeholder="Cari kategori..." class="w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.destination-categories.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm font-semibold hover:border-primary">
                    Reset
                </a>
                <button class="rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl border border-[--color-border] bg-[--color-surface] shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-[--color-border] bg-[--color-bg]">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold">Slug</th>
                        <th class="px-5 py-3 font-semibold">Urutan</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr class="border-b border-[--color-border] last:border-b-0">
                            <td class="px-5 py-3 font-semibold">{{ $cat->name }}</td>
                            <td class="px-5 py-3 text-[--color-muted]">{{ $cat->slug }}</td>
                            <td class="px-5 py-3">{{ $cat->sort_order }}</td>
                            <td class="px-5 py-3">
                                @if($cat->is_active)
                                    <span class="rounded-full bg-primary/15 px-3 py-1 text-xs font-semibold text-primary">Aktif</span>
                                @else
                                    <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.destination-categories.edit', $cat->id) }}" class="rounded-xl border border-[--color-border] bg-[--color-bg] px-3 py-2 text-xs font-semibold hover:border-primary">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.destination-categories.destroy', $cat->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:border-red-300">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $categories->links() }}
    </div>
@endsection

