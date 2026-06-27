@php($title = 'Tambah Paket Trip')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Tambah Paket Trip</h1>
            <div class="mt-1 text-sm text-[--color-muted]">Paket dipakai oleh fitur rekomendasi Jelajahi Cilacap.</div>
        </div>
        <a href="{{ route('admin.trip-packages.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('admin.trip-packages.store') }}" class="mt-6 space-y-6">
        @csrf

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-2">
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Nama Paket</label>
                    <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Lama Kunjungan</label>
                    <select name="days" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        @for($d=1;$d<=5;$d++)
                            <option value="{{ $d }}" @selected(old('days', 1) == $d)>{{ $d }} Hari</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Lokasi Menginap (Zona)</label>
                    <select name="location_zone" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Budget</label>
                    <select name="budget" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($budgets as $key => $label)
                            <option value="{{ $key }}" @selected(old('budget') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Jenis Wisata</label>
                    <div class="mt-2 grid gap-2 sm:grid-cols-2">
                        @foreach($travelTypes as $key => $label)
                            <label class="flex items-center gap-3 rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                                <input type="checkbox" name="travel_types[]" value="{{ $key }}" class="h-4 w-4 rounded border-[--color-border] text-primary">
                                <span class="font-semibold">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Deskripsi Paket</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('description') }}</textarea>
                </div>
                <div class="flex items-center gap-2 pt-2 lg:col-span-2">
                    <input id="is_active" type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_active', true))>
                    <label for="is_active" class="text-sm font-semibold">Aktif</label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan</button>
        </div>
    </form>
@endsection

