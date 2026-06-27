@php($title = 'Wisata')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Wisata</h1>
            <div class="mt-2 text-sm text-slate-500">Kelola semua destinasi wisata: foto, deskripsi, lokasi, maps, dan fasilitas.</div>
        </div>
        <a href="{{ route('admin.destinations.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-primary/90 hover:shadow-xl">
            <i class="bi-plus-lg"></i>
            Tambah Wisata
        </a>
    </div>

    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-lg">
        <form method="GET" class="grid gap-4 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <i class="bi-search text-slate-400"></i>
                    <input name="q" value="{{ $filters['q'] }}" placeholder="Cari wisata..." class="w-full bg-transparent text-sm outline-none">
                </div>
            </div>
            <div>
                <select name="category" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" @selected($filters['category'] === $cat->slug)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="published" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    <option value="">Semua Status</option>
                    <option value="1" @selected($filters['published'] === '1')>Published</option>
                    <option value="0" @selected($filters['published'] === '0')>Draft</option>
                </select>
            </div>

            <div class="lg:col-span-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <i class="bi-info-circle"></i>
                    Menampilkan {{ $destinations->total() }} data
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold transition hover:border-primary hover:bg-primary/5">
                        <i class="bi-arrow-counterclockwise"></i>
                        Reset
                    </a>
                    <button class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90">
                        <i class="bi-funnel"></i>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-5 py-4 font-bold text-slate-700">Gambar</th>
                        <th class="px-5 py-4 font-bold text-slate-700">Nama</th>
                        <th class="px-5 py-4 font-bold text-slate-700">Kategori</th>
                        <th class="px-5 py-4 font-bold text-slate-700">Status</th>
                        <th class="px-5 py-4 font-bold text-slate-700">Update Terakhir</th>
                        <th class="px-5 py-4 font-bold text-slate-700 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destinations as $d)
                        <tr class="border-b border-slate-200 last:border-b-0 transition hover:bg-slate-50">
                            <td class="px-5 py-4">
                                @php($images = is_array($d->images) ? $d->images : [])
                                @if(count($images))
                                    <div class="flex items-center gap-2">
                                        @php($imagePath = $images[0])
                                        @if(Str::startsWith($imagePath, 'http'))
                                            <img src="{{ $imagePath }}" alt="Foto" class="h-16 w-20 rounded-xl object-cover border border-slate-200">
                                        @elseif(Str::startsWith($imagePath, 'img/'))
                                            <img src="{{ asset($imagePath) }}" alt="Foto" class="h-16 w-20 rounded-xl object-cover border border-slate-200">
                                        @else
                                            <img src="{{ asset('storage/' . ltrim($imagePath, '/')) }}" alt="Foto" class="h-16 w-20 rounded-xl object-cover border border-slate-200">
                                        @endif
                                        @if(count($images) > 1)
                                            <span class="text-xs text-slate-500">+{{ count($images) - 1 }}</span>
                                        @endif
                                    </div>
                                @else
                                    <div class="h-16 w-20 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-200">
                                        <i class="bi-image text-slate-400 text-xl"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-slate-800">{{ $d->name }}</div>
                                <div class="mt-1 text-xs text-slate-500">{{ $d->slug }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $d->category?->name ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @if($d->is_published)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary">
                                            <i class="bi-check-circle"></i>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-500/10 px-3 py-1 text-xs font-bold text-red-700">
                                            <i class="bi-x-circle"></i>
                                            Draft
                                        </span>
                                    @endif
                                    @if($d->is_featured)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-500/20 px-3 py-1 text-xs font-bold text-yellow-700">
                                            <i class="bi-star-fill"></i>
                                            Unggulan
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-slate-500">{{ $d->updated_at?->format('d/m/Y H:i') ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.destinations.edit', $d->id) }}" class="inline-flex items-center gap-1 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-bold transition hover:border-primary hover:bg-primary/10 hover:text-primary">
                                        <i class="bi-pencil"></i>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.destinations.destroy', $d->id) }}" onsubmit="return confirm('Yakin ingin menghapus wisata ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center gap-1 rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-bold text-red-700 transition hover:border-red-300 hover:bg-red-100">
                                            <i class="bi-trash"></i>
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

    <div>
        {{ $destinations->links() }}
    </div>
@endsection
