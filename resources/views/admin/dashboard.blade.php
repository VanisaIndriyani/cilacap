@php($title = 'Dashboard')
@extends('admin.layout', ['title' => $title])

@section('content')
    <div class="flex flex-col gap-2 mb-6">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
            <p class="mt-2 text-sm text-[--color-muted]">Selamat datang di Admin Panel Wisata Cilacap. Kelola semua konten wisata Anda disini.</p>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        <div class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
            <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-primary/15 blur-2xl transition group-hover:bg-primary/20"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-primary">Total Wisata</div>
                    <div class="mt-2 text-3xl font-extrabold text-[--color-text]">{{ number_format($stats['destinations']) }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-primary transition group-hover:scale-110">
                    <i class="bi-geo-alt text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
            <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-accent/25 blur-2xl transition group-hover:bg-accent/30"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-amber-600">Total Kuliner</div>
                    <div class="mt-2 text-3xl font-extrabold text-[--color-text]">{{ number_format($stats['culinaries']) }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-xl bg-accent/25 text-amber-700 transition group-hover:scale-110">
                    <i class="bi-egg-fried text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
            <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-green-500/15 blur-2xl transition group-hover:bg-green-500/20"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-green-600">Total Penginapan</div>
                    <div class="mt-2 text-3xl font-extrabold text-[--color-text]">{{ number_format($stats['accommodations']) }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-xl bg-green-500/15 text-green-600 transition group-hover:scale-110">
                    <i class="bi-house text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl">
            <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-purple-500/15 blur-2xl transition group-hover:bg-purple-500/20"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-purple-600">Total Budaya</div>
                    <div class="mt-2 text-3xl font-extrabold text-[--color-text]">{{ number_format($stats['cultures']) }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-xl bg-purple-500/15 text-purple-600 transition group-hover:scale-110">
                    <i class="bi-music-note-beamed text-2xl"></i>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl sm:col-span-2 lg:col-span-1">
            <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-pink-500/15 blur-2xl transition group-hover:bg-pink-500/20"></div>
            <div class="relative flex items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-pink-600">Pengunjung Hari Ini</div>
                    <div class="mt-2 text-3xl font-extrabold text-[--color-text]">{{ number_format($stats['visitors_today']) }}</div>
                </div>
                <div class="grid h-12 w-12 place-items-center rounded-xl bg-pink-500/15 text-pink-600 transition group-hover:scale-110">
                    <i class="bi-people text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-[--color-border] bg-[--color-surface] p-6 shadow-lg">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-4">
                <div class="grid h-12 w-12 flex-shrink-0 place-items-center rounded-xl bg-primary/10 text-primary">
                    <i class="bi-lightbulb text-2xl"></i>
                </div>
                <div>
                    <div class="text-sm font-bold">Tips & Panduan</div>
                    <div class="mt-1 text-sm text-[--color-muted]">Kelola konten portal wisata melalui menu sidebar. Pastikan semua informasi selalu diperbarui untuk pengunjung.</div>
                </div>
            </div>
            <div class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary/10 to-accent/20 px-4 py-2 text-sm font-bold text-primary">
                <span class="relative flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-primary"></span>
                </span>
                Siap Kelola Data
            </div>
        </div>
    </div>
@endsection
