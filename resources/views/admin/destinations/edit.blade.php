@php($title = 'Edit Wisata')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between mb-6 px-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Edit Wisata</h1>
            <div class="mt-1 text-sm text-slate-500">Mengedit wisata: <span class="font-semibold text-slate-700">{{ $destination->name }}</span></div>
        </div>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('destinations.show', $destination) }}" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
                <i class="bi-eye"></i>
                Lihat
            </a>
            <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:border-primary">
                <i class="bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Informasi Dasar -->
        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-info-circle text-primary"></i>
                Informasi Dasar Wisata
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Nama Wisata</label>
                    <input name="name" id="destinationName" value="{{ old('name', $destination->name) }}" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Slug
                        <span class="text-xs text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input name="slug" id="destinationSlug" value="{{ old('slug', $destination->slug) }}" class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <button type="button" id="generateSlugBtn" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary/10 border border-primary/20 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/20">
                            <i class="bi-magic"></i>
                            Generate
                        </button>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Kategori</label>
                    <select name="destination_category_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('destination_category_id', $destination->destination_category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Zona</label>
                    <select name="location_zone" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="">Pilih Zona</option>
                        @foreach($locationZones as $key => $label)
                            <option value="{{ $key }}" @selected(old('location_zone', $destination->location_zone) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi Singkat</label>
                    <textarea name="short_description" id="shortDescription" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('short_description', $destination->short_description) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Deskripsi Lengkap</label>
                    <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('description', $destination->description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Lokasi & Fasilitas -->
        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-geo-alt text-primary"></i>
                Lokasi & Fasilitas
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Alamat</label>
                    <textarea name="address" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('address', $destination->address) }}</textarea>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Google Maps URL</label>
                    <textarea name="maps_url" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('maps_url', $destination->maps_url) }}</textarea>
                    <div class="mt-2 text-xs text-slate-500">Boleh isi link share Google Maps biasa. Sistem akan otomatis menampilkan preview peta.</div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Jam Operasional</label>
                    <input name="opening_hours" value="{{ old('opening_hours', $destination->opening_hours) }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Harga Tiket</label>
                    <input name="ticket_price" value="{{ old('ticket_price', $destination->ticket_price) }}" inputmode="numeric" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-2">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Fasilitas (pisahkan dengan koma / baris baru)</label>
                    @php($fac = is_array($destination->facilities) ? implode("\n", $destination->facilities) : '')
                    <textarea name="facilities_text" rows="3" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('facilities_text', $fac) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Media & Pengaturan -->
        <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-md">
            <h2 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                <i class="bi-images text-primary"></i>
                Media & Pengaturan
            </h2>
            <div class="grid gap-4 sm:gap-5 sm:grid-cols-1 lg:grid-cols-2">
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 block">Tambah Foto (Multi Upload)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="sm:col-span-1 flex flex-wrap items-center gap-6 pt-2">
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_published" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_published', $destination->is_published))>
                        Published
                    </label>
                    <label class="flex items-center gap-3 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" class="h-5 w-5 rounded border-slate-300 text-primary" @checked(old('is_featured', $destination->is_featured))>
                        Unggulan
                    </label>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Meta Title
                        <span class="text-xs text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input name="meta_title" id="metaTitle" value="{{ old('meta_title', $destination->meta_title) }}" class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <button type="button" id="generateMetaBtn" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary/10 border border-primary/20 px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/20">
                            <i class="bi-magic"></i>
                            Generate
                        </button>
                    </div>
                </div>
                <div class="sm:col-span-1">
                    <label class="text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                        Meta Description
                        <span class="text-xs text-slate-400 font-normal">(maks 180 karakter)</span>
                    </label>
                    <div class="relative">
                        <textarea name="meta_description" id="metaDescription" maxlength="180" rows="2" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all pr-12">{{ old('meta_description', $destination->meta_description) }}</textarea>
                        <span id="charCount" class="absolute bottom-3 right-3 text-xs text-slate-400 font-semibold">0/180</span>
                    </div>
                </div>
            </div>

            <!-- Foto Saat Ini -->
            @php($images = is_array($destination->images) ? $destination->images : [])
            @if(count($images))
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <i class="bi-image text-primary"></i>
                        Foto Saat Ini (centang untuk hapus)
                    </div>
                    <div class="grid gap-3 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($images as $path)
                            <label class="group relative overflow-hidden rounded-xl border border-slate-200 bg-slate-50 cursor-pointer hover:border-primary transition-all">
                                @if(Str::startsWith($path, 'http'))
                                    <img src="{{ $path }}" alt="Foto" class="h-32 w-full object-cover">
                                @elseif(Str::startsWith($path, 'img/'))
                                    <img src="{{ asset($path) }}" alt="Foto" class="h-32 w-full object-cover">
                                @else
                                    <img src="{{ asset('storage/' . ltrim($path, '/')) }}" alt="Foto" class="h-32 w-full object-cover">
                                @endif
                                <div class="flex items-center gap-2 p-3 bg-white border-t border-slate-200">
                                    <input type="checkbox" name="remove_images[]" value="{{ $path }}" class="h-4 w-4 rounded border-slate-300 text-primary">
                                    <span class="text-xs text-slate-600 font-semibold">Hapus</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-md transition hover:bg-primary/90 hover:shadow-lg w-full sm:w-auto">
                <i class="bi-check-circle"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>

    <script>
        // Auto-generate functions
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('destinationName');
            const slugInput = document.getElementById('destinationSlug');
            const generateSlugBtn = document.getElementById('generateSlugBtn');
            const shortDescInput = document.getElementById('shortDescription');
            const metaTitleInput = document.getElementById('metaTitle');
            const metaDescInput = document.getElementById('metaDescription');
            const generateMetaBtn = document.getElementById('generateMetaBtn');
            const charCount = document.getElementById('charCount');

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
            }

            function updateCharCount() {
                const length = metaDescInput.value.length;
                charCount.textContent = length + '/180';
                charCount.className = 'absolute bottom-3 right-3 text-xs font-semibold ' + 
                    (length > 170 ? 'text-red-500' : length > 150 ? 'text-yellow-500' : 'text-slate-400');
            }

            // Auto-generate slug from name
            nameInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual || slugInput.value === '') {
                    slugInput.value = generateSlug(this.value);
                }
                // Also update meta title if empty
                if (!metaTitleInput.dataset.manual || metaTitleInput.value === '') {
                    metaTitleInput.value = this.value + ' - Wisata Cilacap';
                }
            });

            // Generate slug button click
            generateSlugBtn.addEventListener('click', function() {
                slugInput.value = generateSlug(nameInput.value);
                slugInput.dataset.manual = 'true';
            });

            // Mark as manual when user edits slug
            slugInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });

            // Auto-generate meta from short desc
            shortDescInput.addEventListener('input', function() {
                if (!metaDescInput.dataset.manual || metaDescInput.value === '') {
                    let desc = this.value.substring(0, 175);
                    if (desc.length === 175) desc += '...';
                    metaDescInput.value = desc;
                    updateCharCount();
                }
            });

            // Generate meta button click
            generateMetaBtn.addEventListener('click', function() {
                // Generate meta title
                metaTitleInput.value = nameInput.value + ' - Wisata Cilacap';
                metaTitleInput.dataset.manual = 'true';
                
                // Generate meta description
                let desc = shortDescInput.value || nameInput.value + ' adalah destinasi wisata menarik di Cilacap yang wajib dikunjungi.';
                desc = desc.substring(0, 175);
                if (desc.length === 175) desc += '...';
                metaDescInput.value = desc;
                metaDescInput.dataset.manual = 'true';
                updateCharCount();
            });

            // Mark as manual when user edits meta
            metaTitleInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });
            metaDescInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
                updateCharCount();
            });

            // Initial char count
            updateCharCount();
        });
    </script>
@endsection
