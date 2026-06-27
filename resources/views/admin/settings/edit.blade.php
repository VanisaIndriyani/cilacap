@php($title = 'Pengaturan Website')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div>
        <h1 class="text-2xl font-semibold tracking-tight">Pengaturan Website</h1>
        <div class="mt-1 text-sm text-[--color-muted]">Atur logo, banner, tentang, kontak, sosial media, dan footer.</div>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="grid gap-5 lg:grid-cols-2">
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Nama Website</label>
                    <input name="site_name" value="{{ old('site_name', $settings->site_name) }}" required class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Tentang</label>
                    <textarea name="about" rows="4" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('about', $settings->about) }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold">Telepon</label>
                    <input name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Alamat</label>
                    <textarea name="contact_address" rows="3" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('contact_address', $settings->contact_address) }}</textarea>
                </div>
                <div class="lg:col-span-2">
                    <label class="text-sm font-semibold">Footer</label>
                    <textarea name="footer_text" rows="2" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">{{ old('footer_text', $settings->footer_text) }}</textarea>
                </div>
            </div>
        </div>

        @php($social = $settings->social_links ?? [])
        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="text-base font-semibold">Sosial Media</div>
            <div class="mt-4 grid gap-5 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold">Instagram</label>
                    <input name="social_instagram" value="{{ old('social_instagram', $social['Instagram'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">Facebook</label>
                    <input name="social_facebook" value="{{ old('social_facebook', $social['Facebook'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">TikTok</label>
                    <input name="social_tiktok" value="{{ old('social_tiktok', $social['TikTok'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
                <div>
                    <label class="text-sm font-semibold">YouTube</label>
                    <input name="social_youtube" value="{{ old('social_youtube', $social['YouTube'] ?? '') }}" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-[--color-border] bg-[--color-surface] p-6 shadow-sm">
            <div class="text-base font-semibold">Media</div>
            <div class="mt-4 grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold">Logo</label>
                    <input type="file" name="logo" accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    @if($settings->logo_path)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings->logo_path) }}" alt="Logo" class="h-14 w-14 rounded-2xl border border-[--color-border] object-cover">
                            <label class="flex items-center gap-2 text-sm font-semibold">
                                <input type="checkbox" name="remove_logo" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary">
                                Hapus Logo
                            </label>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="text-sm font-semibold">Banner / Hero Image</label>
                    <input type="file" name="banner" accept="image/*" class="mt-2 w-full rounded-2xl border border-[--color-border] bg-[--color-bg] px-4 py-3 text-sm">
                    @if($settings->banner_path)
                        <div class="mt-3 space-y-2">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings->banner_path) }}" alt="Banner" class="h-28 w-full rounded-2xl border border-[--color-border] object-cover">
                            <label class="flex items-center gap-2 text-sm font-semibold">
                                <input type="checkbox" name="remove_banner" value="1" class="h-4 w-4 rounded border-[--color-border] text-primary">
                                Hapus Banner
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button class="rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white hover:bg-primary/90">Simpan</button>
        </div>
    </form>
@endsection

