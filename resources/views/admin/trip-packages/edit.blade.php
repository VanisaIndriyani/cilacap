@php($title = 'Edit Paket Trip')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Edit Paket Trip</h1>
            <div class="mt-1 text-sm text-[--color-muted]">{{ $package->name }}</div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.trip-itinerary-items.create', $package->id) }}" class="rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white hover:bg-primary/90">
                Tambah Itinerary
            </a>
            <a href="{{ route('admin.trip-packages.index') }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.trip-packages.update', $package->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-2">
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Nama Paket</label>
                    <input name="name" value="{{ old('name', $package->name) }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Lama Kunjungan</label>
                    <select name="days" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        @for($d=1;$d<=5;$d++)
                            <option value="{{ $d }}" @selected(old('days', $package->days) == $d)>{{ $d }} Hari</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Lokasi Menginap (Zona)</label>
                    <select name="location_zone" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone', $package->location_zone) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold">Budget</label>
                    <select name="budget" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                        <option value="">-</option>
                        @foreach($budgets as $key => $label)
                            <option value="{{ $key }}" @selected(old('budget', $package->budget) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Jenis Wisata</label>
                    @php($selectedTypes = (array) old('travel_types', $package->travel_types ?? []))
                    <div class="mt-2 grid gap-2 sm:grid-cols-2">
                        @foreach($travelTypes as $key => $label)
                            <label class="flex items-center gap-3 rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                                <input type="checkbox" name="travel_types[]" value="{{ $key }}" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(in_array($key, $selectedTypes, true))>
                                <span class="font-semibold">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Deskripsi Paket</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('description', $package->description) }}</textarea>
                </div>
                <div class="flex items-center gap-2 pt-2 lg:col-span-2">
                    <input id="is_active" type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary" @checked(old('is_active', $package->is_active))>
                    <label for="is_active" class="text-sm font-semibold">Aktif</label>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end">
                <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan Perubahan</button>
            </div>
        </div>
    </form>

    <div class="mt-8 rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
        <div class="flex items-end justify-between gap-4">
            <div>
                <div class="text-lg font-semibold">Itinerary</div>
                <div class="mt-1 text-sm text-[--color-muted]">Atur urutan agenda per hari.</div>
            </div>
        </div>

        @php($grouped = $package->itineraryItems->groupBy('day')->sortKeys())
        <div class="mt-6 space-y-6">
            @for($d=1;$d<=$package->days;$d++)
                @php($items = $grouped->get($d, collect()))
                <div class="rounded-2xl border border-[--color-border] bg-[--color-bg] p-5">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">Hari Ke-{{ $d }}</div>
                        <div class="text-sm text-[--color-muted]">{{ $items->count() }} agenda</div>
                    </div>
                    <div class="mt-4 space-y-3">
                        @foreach($items as $it)
                            @php($model = $it->itemable)
                            @php($titleIt = $it->title ?: ($model->name ?? 'Agenda'))
                            <div class="flex flex-col gap-3 rounded-2xl border border-[--color-border] bg-[--color-surface] p-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <div class="text-xs font-semibold text-primary">{{ $it->time ?: '--:--' }} • Urutan {{ $it->sort_order }}</div>
                                    <div class="mt-1 font-semibold">{{ $titleIt }}</div>
                                    @if($it->notes)
                                        <div class="mt-1 text-sm text-[--color-muted]">{{ $it->notes }}</div>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.trip-itinerary-items.edit', ['tripPackage' => $package->id, 'tripItineraryItem' => $it->id]) }}" class="rounded-xl border border-[--color-border] bg-[--color-bg] px-3 py-2 text-xs font-semibold hover:border-primary">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.trip-itinerary-items.destroy', ['tripPackage' => $package->id, 'tripItineraryItem' => $it->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:border-red-300">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        @if($items->isEmpty())
                            <div class="text-sm text-[--color-muted]">Belum ada agenda untuk hari ini.</div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection

