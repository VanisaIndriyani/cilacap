@php($title = 'Edit Itinerary')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Edit Itinerary</h1>
            <div class="mt-1 text-sm text-[--color-muted]">{{ $package->name }}</div>
        </div>
        <a href="{{ route('admin.trip-packages.edit', $package->id) }}" class="rounded-2xl border border-[--color-border] bg-[--color-surface] px-4 py-3 text-sm font-semibold hover:border-primary">Kembali</a>
    </div>

    <form method="POST" action="{{ route('admin.trip-itinerary-items.update', ['tripPackage' => $package->id, 'tripItineraryItem' => $item->id]) }}" class="mt-6 rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
        @csrf
        @method('PUT')

        @php($currentType = old('item_type', $selectedType))
        @php($currentId = old('item_id', $item->itemable_id))

        <div class="grid gap-5 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Hari</label>
                <select name="day" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    @for($d=1;$d<=$package->days;$d++)
                        <option value="{{ $d }}" @selected(old('day', $item->day) == $d)>Hari Ke-{{ $d }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold">Jam (opsional)</label>
                <input name="time" value="{{ old('time', $item->time) }}" placeholder="08.00" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Urutan</label>
                <input name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" inputmode="numeric" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Jenis Item</label>
                <select name="item_type" data-item-type class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" @selected($currentType === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-2 {{ $currentType !== 'destination' ? 'hidden' : '' }}" data-item-select="destination">
                <label class="text-sm font-semibold">Pilih Wisata</label>
                <select name="item_id_destination" data-item-choice class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">-</option>
                    @foreach($options['destination'] as $m)
                        <option value="{{ $m->id }}" @selected($currentType === 'destination' && (int) $currentId === (int) $m->id)>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:col-span-2 {{ $currentType !== 'culinary' ? 'hidden' : '' }}" data-item-select="culinary">
                <label class="text-sm font-semibold">Pilih Kuliner</label>
                <select name="item_id_culinary" data-item-choice class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">-</option>
                    @foreach($options['culinary'] as $m)
                        <option value="{{ $m->id }}" @selected($currentType === 'culinary' && (int) $currentId === (int) $m->id)>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:col-span-2 {{ $currentType !== 'accommodation' ? 'hidden' : '' }}" data-item-select="accommodation">
                <label class="text-sm font-semibold">Pilih Penginapan</label>
                <select name="item_id_accommodation" data-item-choice class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">-</option>
                    @foreach($options['accommodation'] as $m)
                        <option value="{{ $m->id }}" @selected($currentType === 'accommodation' && (int) $currentId === (int) $m->id)>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:col-span-2 {{ $currentType !== 'culture' ? 'hidden' : '' }}" data-item-select="culture">
                <label class="text-sm font-semibold">Pilih Budaya</label>
                <select name="item_id_culture" data-item-choice class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    <option value="">-</option>
                    @foreach($options['culture'] as $m)
                        <option value="{{ $m->id }}" @selected($currentType === 'culture' && (int) $currentId === (int) $m->id)>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="item_id" value="{{ $currentId }}" data-item-id>

            <div class="lg:col-span-2">
                <label class="text-sm font-semibold">Judul (opsional / untuk Custom)</label>
                <input name="title" value="{{ old('title', $item->title) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
            </div>
            <div class="lg:col-span-2">
                <label class="text-sm font-semibold">Catatan (opsional)</label>
                <textarea name="notes" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('notes', $item->notes) }}</textarea>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan</button>
        </div>
    </form>

    <script type="module">
        const typeSelect = document.querySelector('[data-item-type]');
        const selects = document.querySelectorAll('[data-item-select]');
        const hiddenId = document.querySelector('[data-item-id]');
        function sync() {
            const type = typeSelect?.value || 'destination';
            selects.forEach((el) => {
                const active = el.getAttribute('data-item-select') === type;
                el.classList.toggle('hidden', !active);
                if (active) {
                    const select = el.querySelector('[data-item-choice]');
                    if (hiddenId) hiddenId.value = select?.value || '';
                }
            });
        }
        typeSelect?.addEventListener('change', sync);
        document.querySelectorAll('[data-item-choice]').forEach((el) => el.addEventListener('change', sync));
        sync();
    </script>
@endsection

