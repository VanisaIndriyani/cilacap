<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim(($title ?? '') ? ($title.' | ') : '').($settings->site_name ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $metaDescription ?? ($settings->footer_text ?? 'Portal informasi wisata Kabupaten Cilacap.') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[--color-bg] text-[--color-text] antialiased">
    @php
        $primaryLogo = asset('logo.PNG');
        $footerLogo = asset('IMG_1972.PNG');
        $navItems = [
            ['label' => 'Beranda', 'route' => 'home', 'patterns' => ['home'], 'icon' => 'bi-house-fill'],
            ['label' => 'Destinasi', 'route' => 'destinations.index', 'patterns' => ['destinations.*'], 'icon' => 'bi-geo-alt-fill'],
            ['label' => 'Kuliner Khas', 'route' => 'culinaries.index', 'patterns' => ['culinaries.*'], 'icon' => 'bi-utensils'],
            ['label' => 'Kuliner & Caffe', 'route' => 'culinary-cafes.index', 'patterns' => ['culinary-cafes.index'], 'icon' => 'bi-cup-hot'],
            ['label' => 'Penginapan', 'route' => 'accommodations.index', 'patterns' => ['accommodations.*'], 'icon' => 'bi-house-door-fill'],
            ['label' => 'Budaya', 'route' => 'cultures.index', 'patterns' => ['cultures.*'], 'icon' => 'bi-buildings'],
            ['label' => 'Testimoni', 'route' => 'testimonials.index', 'patterns' => ['testimonials.*'], 'icon' => 'bi-chat-square-heart-fill'],
        ];
    @endphp
    <header class="sticky top-0 z-50 py-1.5">
        <div class="mx-auto max-w-[1320px] px-3 sm:px-4 lg:px-8">
            <!-- Navbar Container -->
            <div class="flex items-center justify-between rounded-2xl bg-gradient-to-r from-primary to-primary-dark px-3.5 py-2.5 shadow-lg">
                <!-- Logo Section -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 min-w-0">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-white p-1 shadow-md">
                        <img src="{{ $primaryLogo }}" alt="Logo Kabupaten Cilacap" class="h-full w-full object-contain">
                    </div>
                    <div class="min-w-0 leading-tight">
                        <div class="truncate text-[10px] font-bold tracking-tight text-white sm:text-[11px]">{{ $settings->site_name ?? 'Wisata Cilacap' }}</div>
                        <div class="truncate text-[8px] font-medium text-white/80">Kabupaten Cilacap</div>
                    </div>
                </a>

                <!-- Desktop Menu (Centered) -->
                <nav class="hidden items-center gap-0.5 md:flex">
                    @foreach($navItems as $item)
                        @php($isActive = request()->routeIs(...$item['patterns']))
                        <a href="{{ route($item['route']) }}" class="{{ $isActive ? 'bg-accent text-primary-dark shadow-sm' : 'text-white hover:bg-white/10' }} flex items-center gap-1 whitespace-nowrap rounded-full px-2.5 py-1.5 text-[10px] font-semibold transition-all duration-300">
                            <i class="{{ $item['icon'] }} text-[11px]"></i>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Search & Mobile Menu Button -->
                <div class="flex items-center gap-1.5">
                    <!-- Search (Desktop) -->
                    <div class="hidden items-center gap-1 rounded-full bg-white/15 px-2.5 py-1.5 md:flex">
                        <i class="bi-search text-white/70 text-[11px]"></i>
                        <input type="text" placeholder="Cari..." class="w-20 bg-transparent border-none text-[10px] text-white placeholder-white/60 focus:ring-0 focus:outline-none">
                    </div>

                    <!-- Mobile Menu Button -->
                    <button type="button" id="mobileMenuBtn" class="inline-flex items-center justify-center rounded-full bg-white/20 p-1.5 text-white md:hidden transition-all duration-300 hover:bg-white/30">
                        <svg viewBox="0 0 24 24" fill="none" class="h-4.5 w-4.5" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Sidebar -->
    <div id="mobileOverlay" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm transition-opacity md:hidden"></div>
    <aside id="mobileSidebar" class="mobile-sidebar fixed left-0 top-0 z-50 h-full w-[88%] max-w-[340px] -translate-x-full transform bg-white shadow-2xl transition-transform duration-300 md:hidden">
        <div class="mobile-sidebar__header flex items-center justify-between border-b border-gray-100 p-3.5 bg-gradient-to-r from-primary to-primary-dark">
            <a href="{{ route('home') }}" class="mobile-brand flex min-w-0 items-center gap-2.5">
                <div class="mobile-brand__logo flex h-11 w-11 items-center justify-center rounded-xl bg-white p-1 shadow-md">
                    <img src="{{ $primaryLogo }}" alt="Logo Kabupaten Cilacap" class="h-full w-full object-contain">
                </div>
                <div class="mobile-brand__text min-w-0 leading-tight">
                    <div class="mobile-brand__title text-sm font-bold text-white">{{ $settings->site_name ?? 'Wisata Cilacap' }}</div>
                    <div class="mobile-brand__subtitle text-[9px] font-medium text-white/80">Kabupaten Cilacap</div>
                </div>
            </a>
            <button id="closeMobileMenu" class="mobile-sidebar__close flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white transition-all duration-300 hover:bg-white/30">
                <i class="bi-x-lg text-base"></i>
            </button>
        </div>
        <nav class="mobile-sidebar__content p-3.5">
            <!-- Mobile Search -->
            <div class="mobile-search mb-4 flex items-center gap-2 rounded-xl bg-gray-100 px-3.5 py-2 border border-gray-200">
                <i class="bi-search text-primary text-sm"></i>
                <input type="text" placeholder="Cari destinasi, kuliner..." class="w-full bg-transparent border-none text-sm text-gray-700 focus:ring-0 focus:outline-none">
            </div>

            <!-- Menu -->
            <div class="grid gap-2">
                @foreach($navItems as $item)
                    @php($isActive = request()->routeIs(...$item['patterns']))
                    <a href="{{ route($item['route']) }}" class="nav-link mobile-nav-link {{ $isActive ? 'border-primary bg-gradient-to-r from-primary/15 to-primary-dark/15 text-primary' : 'border-gray-200 bg-gray-50 text-gray-700 hover:bg-primary/5 hover:text-primary' }} flex items-center gap-2 rounded-xl border px-3.5 py-2.5 text-[13px] font-semibold transition-all duration-300">
                        <i class="{{ $item['icon'] }} text-sm"></i>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </nav>
    </aside>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-gray-200 bg-white">
        <div class="mx-auto max-w-[1320px] px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-100 bg-[#F8FAFC] p-6 custom-shadow">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 p-1.5">
                            <img src="{{ $footerLogo }}" alt="Foto Footer Cilacap" class="h-full w-full rounded-full object-cover">
                        </div>
                        <div class="leading-tight">
                            <div class="text-sm font-bold text-dark">{{ $settings->site_name ?? 'Wisata Cilacap' }}</div>
                        </div>
                    </div>
                    <div class="text-sm leading-relaxed text-gray-600">
                        {!! nl2br(e($settings->about ?? 'Portal informasi destinasi wisata, kuliner khas, penginapan, dan budaya Kabupaten Cilacap.')) !!}
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-[#F8FAFC] p-6 custom-shadow">
                    <div class="text-base font-bold mb-4 text-dark">Navigasi</div>
                    <div class="grid gap-2">
                        @foreach(array_slice($navItems, 0, 4) as $item)
                            <a href="{{ route($item['route']) }}" class="text-sm text-gray-600 hover:text-primary transition-colors duration-300 flex items-center gap-2">
                                <i class="bi-chevron-right text-xs"></i>
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-[#F8FAFC] p-6 custom-shadow">
                    <div class="text-base font-bold mb-4 text-dark">Kontak</div>
                    <div class="grid gap-3">
                        <div class="text-sm text-gray-600 flex items-center gap-2">
                            <i class="bi-geo-alt text-primary"></i>
                            Kabupaten Cilacap, Jawa Tengah
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 border-t border-gray-100 pt-6 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between">
                <div>{{ $settings->footer_text ?? ('© '.now()->year.' Sistem Informasi Wisata Kabupaten Cilacap') }}</div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Sidebar
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const navLinks = document.querySelectorAll('.nav-link');

        function openSidebar() {
            mobileOverlay.classList.remove('hidden');
            setTimeout(() => {
                mobileSidebar.classList.remove('-translate-x-full');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            mobileSidebar.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        mobileMenuBtn.addEventListener('click', openSidebar);
        closeMobileMenu.addEventListener('click', closeSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        navLinks.forEach(link => link.addEventListener('click', closeSidebar));
    </script>
</body>
</html>
