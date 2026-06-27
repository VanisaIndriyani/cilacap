<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim(($title ?? '') ? ($title.' | ') : '').'Admin - '.config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body class="min-h-screen bg-[--admin-bg] text-[--color-text] antialiased overflow-x-hidden">
    @php
        $adminLogo = asset('IMG_1972.PNG');
        $adminNavItems = [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'patterns' => ['admin.dashboard'], 'icon' => 'bi-speedometer2'],
            ['label' => 'Kategori Wisata', 'route' => 'admin.destination-categories.index', 'patterns' => ['admin.destination-categories.*'], 'icon' => 'bi-tags'],
            ['label' => 'Wisata', 'route' => 'admin.destinations.index', 'patterns' => ['admin.destinations.*'], 'icon' => 'bi-geo-alt'],
            ['label' => 'Kuliner', 'route' => 'admin.culinaries.index', 'patterns' => ['admin.culinaries.*'], 'icon' => 'bi-egg-fried'],
            ['label' => 'Penginapan', 'route' => 'admin.accommodations.index', 'patterns' => ['admin.accommodations.*'], 'icon' => 'bi-house'],
            ['label' => 'Budaya', 'route' => 'admin.cultures.index', 'patterns' => ['admin.cultures.*'], 'icon' => 'bi-music-note-beamed'],
            ['label' => 'Testimoni', 'route' => 'admin.testimonials.index', 'patterns' => ['admin.testimonials.*'], 'icon' => 'bi-chat-square-heart'],
            ['label' => 'Trip Planner', 'route' => 'admin.trip-packages.index', 'patterns' => ['admin.trip-packages.*', 'admin.trip-itinerary-items.*'], 'icon' => 'bi-map'],
            ['label' => 'Pengaturan Website', 'route' => 'admin.settings.edit', 'patterns' => ['admin.settings.*'], 'icon' => 'bi-gear'],
            ['label' => 'Pengunjung', 'route' => 'admin.visitor-logs.index', 'patterns' => ['admin.visitor-logs.*'], 'icon' => 'bi-people'],
        ];
    @endphp

    <!-- Mobile Sidebar Overlay -->
    @auth
        <div id="sidebarOverlay" class="fixed inset-0 z-[55] bg-black/50 backdrop-blur-sm lg:hidden hidden" data-toggle-target="#adminSidebar"></div>
    @endauth

    <!-- Sticky Navbar -->
    <header class="sticky top-0 z-[60] border-b border-slate-200 bg-white text-slate-800 shadow-md">
        <div class="flex items-center justify-between gap-2 px-4 h-[60px]">
            <!-- Left Section -->
            <div class="flex items-center gap-3">
                @auth
                    <button type="button" data-toggle-target="#adminSidebar,#sidebarOverlay" aria-expanded="false" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 p-2.5 text-slate-700 transition hover:bg-slate-100">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                    </button>
                @endauth
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-primary/10 p-1 shadow-sm">
                        <img src="{{ $adminLogo }}" alt="Logo" class="h-full w-full object-contain">
                    </div>
                    <div class="hidden sm:flex flex-col leading-tight">
                        <div class="text-sm font-bold tracking-tight">Admin Panel</div>
                        <div class="text-[10px] text-slate-500">Wisata Cilacap</div>
                    </div>
                </a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="hidden sm:flex items-center gap-2 rounded-xl bg-slate-50 border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <i class="bi-globe text-base"></i>
                    <span>Website</span>
                </a>
                <a href="{{ route('home') }}" class="sm:hidden inline-flex items-center justify-center rounded-xl bg-slate-50 border border-slate-200 p-2.5 text-slate-700 shadow-sm transition hover:bg-slate-100">
                    <i class="bi-globe text-base"></i>
                </a>
                @auth
                    <form action="{{ route('admin.logout') }}" method="POST" class="hidden sm:block">
                        @csrf
                        <button class="inline-flex items-center gap-2 rounded-xl bg-red-50 border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 shadow-sm transition hover:bg-red-100">
                            <i class="bi-box-arrow-right text-base"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    <form action="{{ route('admin.logout') }}" method="POST" class="sm:hidden">
                        @csrf
                        <button class="inline-flex items-center justify-center rounded-xl bg-red-50 border border-red-200 p-2.5 text-red-700 shadow-sm transition hover:bg-red-100">
                            <i class="bi-box-arrow-right text-base"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="flex">
        <!-- Sidebar (Drawer for Mobile, Fixed for Desktop) -->
        @auth
            <aside id="adminSidebar" class="fixed left-0 top-0 z-[60] h-full w-[260px] -translate-x-full bg-white shadow-2xl transition-all duration-300 lg:sticky lg:top-[60px] lg:h-[calc(100vh-60px)] lg:translate-x-0 lg:shadow-sm lg:w-[260px] lg:flex-shrink-0 lg:border-r lg:border-slate-200">
                <div class="flex h-full flex-col">
                    <!-- Mobile Sidebar Header -->
                    <div class="flex items-center justify-between border-b border-slate-200 p-4 lg:hidden">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-primary/10 p-1 shadow-sm">
                                <img src="{{ $adminLogo }}" alt="Logo" class="h-full w-full object-contain">
                            </div>
                            <div class="flex flex-col leading-tight">
                                <div class="text-sm font-bold tracking-tight">Admin Panel</div>
                                <div class="text-[10px] text-slate-500">Wisata Cilacap</div>
                            </div>
                        </a>
                        <button type="button" data-toggle-target="#adminSidebar,#sidebarOverlay" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-slate-50 p-2 text-slate-700 hover:bg-slate-100">
                            <svg viewBox="0 0 24 24" fill="none" class="h-4.5 w-4.5"><path d="M6 18 18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                        </button>
                    </div>
                    
                    <!-- Desktop Sidebar Info -->
                    <div class="border-b border-slate-200 p-4 hidden lg:flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary/80 p-1.5 shadow-md">
                            <img src="{{ $adminLogo }}" alt="Logo" class="h-full w-full object-contain">
                        </div>
                        <div class="flex flex-col">
                            <div class="text-sm font-bold text-slate-800">Admin Panel</div>
                            <div class="text-xs text-slate-500">Wisata Cilacap</div>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex-1 overflow-y-auto p-3">
                        <div class="mb-3 px-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
                            Menu Utama
                        </div>
                        <div class="space-y-1.5">
                            @foreach($adminNavItems as $item)
                                @php($isActive = request()->routeIs(...$item['patterns']))
                                <a href="{{ route($item['route']) }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition-all duration-200 {{ $isActive ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'text-slate-700 hover:bg-primary/10 hover:text-primary' }}">
                                    <i class="{{ $item['icon'] }} text-lg"></i>
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </nav>

                    <!-- Profile & Footer Links -->
                    <div class="border-t border-slate-200 p-3">
                        <div class="grid gap-2">
                            <div class="flex items-center gap-2 rounded-xl bg-slate-50 p-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-slate-500 to-slate-700 text-white">
                                    <i class="bi-person text-lg"></i>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-xs font-bold text-slate-800">Administrator</div>
                                    <div class="text-[10px] text-slate-500">admin@cilacap.go.id</div>
                                </div>
                            </div>
                            <a href="{{ route('home') }}" class="group hidden lg:flex items-center justify-center gap-2 rounded-xl bg-slate-50 border border-slate-200 px-3 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                <i class="bi-globe text-base group-hover:scale-105 transition-transform"></i>
                                Lihat Website
                            </a>
                            <form action="{{ route('admin.logout') }}" method="POST" class="hidden lg:block">
                                @csrf
                                <button class="group flex w-full items-center justify-center gap-2 rounded-xl bg-red-50 border border-red-200 px-3 py-2.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                    <i class="bi-box-arrow-right text-base group-hover:scale-105 transition-transform"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>
        @endauth

        <!-- Main Content -->
        <main class="flex-1 min-w-0">
            <div class="px-4 py-4 sm:px-5 sm:py-6 lg:px-6 lg:py-7">
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-xs text-red-800 shadow-md">
                        <div class="flex items-center gap-2 font-semibold">
                            <i class="bi-exclamation-triangle text-red-600 text-lg"></i>
                            Terjadi kesalahan
                        </div>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-green-200 bg-green-50 p-4 text-xs text-green-800 shadow-md">
                        <div class="flex items-center gap-2 font-semibold">
                            <i class="bi-check-circle text-green-600 text-lg"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <section>
                    @yield('content')
                </section>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-toggle-target]');
            
            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targets = this.getAttribute('data-toggle-target').split(',');
                    targets.forEach(selector => {
                        const el = document.querySelector(selector.trim());
                        if(el) {
                            if(el.classList.contains('hidden')) {
                                el.classList.remove('hidden');
                                if(el.id === 'adminSidebar') {
                                    el.classList.remove('-translate-x-full');
                                }
                            } else {
                                if(el.id === 'adminSidebar') {
                                    el.classList.add('-translate-x-full');
                                    document.getElementById('sidebarOverlay')?.classList.add('hidden');
                                } else {
                                    el.classList.add('hidden');
                                }
                            }
                        }
                    });
                });
            });
            
            // Close sidebar when clicking overlay
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            if(sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    document.getElementById('adminSidebar')?.classList.add('-translate-x-full');
                    this.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
