<!doctype html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trim(($title ?? '') ? ($title.' | ') : '').'Admin Login - '.config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen antialiased" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);">
    <div class="min-h-[85vh] flex items-center justify-center px-3 sm:px-4 py-8">
        <div class="w-full max-w-sm">
            <div class="text-center mb-7">
                <div class="inline-flex items-center justify-center h-14 w-14 rounded-xl bg-white border border-primary/20 mb-4 shadow-md">
                    <svg class="h-7 w-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight text-gray-800">Login Admin</h1>
                <p class="mt-2 text-xs sm:text-sm text-gray-600">Masuk untuk mengelola konten portal wisata Kabupaten Cilacap.</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3.5 text-xs text-red-800">
                    <div class="font-semibold">Terjadi kesalahan</div>
                    <ul class="mt-1.5 list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-xl">
                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-xs font-semibold text-gray-700">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-1.5 w-full rounded-lg border border-gray-300 bg-gray-50 px-3.5 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-700">Password</label>
                        <div class="relative mt-1.5">
                            <input id="passwordInput" name="password" type="password" required class="w-full rounded-lg border border-gray-300 bg-gray-50 px-3.5 pr-9 py-2.5 text-sm transition focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-primary transition">
                                <i class="bi bi-eye-slash text-base" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <label class="flex items-center gap-2 text-xs text-gray-600">
                        <input type="checkbox" name="remember" class="h-3.5 w-3.5 rounded border-gray-300 text-primary focus:ring-primary/30">
                        Ingat saya
                    </label>

                    <button class="btn btn-primary inline-flex w-full items-center justify-center gap-2 rounded-lg border-0 px-6 py-2.5 text-sm font-semibold shadow-md transition hover:-translate-y-0.5">
                        <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                        Masuk
                    </button>
                </form>
            </div>

            <div class="mt-5 text-center text-xs text-gray-600">
                Kembali ke <a href="{{ route('home') }}" class="font-semibold text-primary hover:underline transition">Beranda</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        
        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>
</html>
