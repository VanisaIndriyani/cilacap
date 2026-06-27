@php($title = 'Beranda')
@php($metaDescription = 'Portal informasi wisata Kabupaten Cilacap: destinasi, kuliner khas, penginapan, budaya, dan rekomendasi perjalanan.')
@php($heroBackground = asset('bg.webp'))
@extends('layouts.app', ['settings' => $settings, 'title' => $title, 'metaDescription' => $metaDescription])

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden flex items-center" style="min-height: 75vh;">
        <div class="absolute inset-0 -z-10">
            <div class="h-full w-full bg-cover bg-center" style="background-image:url('{{ $heroBackground }}')"></div>
            <div class="absolute inset-0 bg-primary" style="opacity: 0.75;"></div>
        </div>

        <div class="mx-auto w-full max-w-[1320px] items-center gap-7 px-3 py-9 sm:px-6 lg:grid lg:grid-cols-2 lg:px-8 lg:py-14">
            <div class="relative z-10">
                <div class="inline-flex items-center gap-1.5 rounded-full border border-accent/70 bg-accent/20 px-3.5 py-1.5 text-[11px] font-bold text-white shadow-md backdrop-blur-md mb-5">
                    <span class="flex h-2.5 w-2.5 items-center justify-center">
                        <span class="absolute inline-flex h-3.5 w-3.5 animate-ping rounded-full bg-accent"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-accent"></span>
                    </span>
                    Portal Resmi Informasi Wisata
                </div>
                <h1 class="font-extrabold tracking-tight text-white mb-3" style="font-size: 1.75rem; line-height: 1.2;">
                    Jelajahi Pesona
                    <span class="text-accent block mt-0.5">Kabupaten Cilacap</span>
                </h1>
                <p class="max-w-xl leading-relaxed text-white/90 mb-7" style="font-size: 0.95rem;">
                    Temukan destinasi unggulan, kuliner khas, penginapan pilihan, dan budaya Cilacap.
                </p>
                <div class="flex flex-col gap-2.5 sm:flex-row sm:items-center">
                    <a href="#jelajah" class="btn btn-accent gap-1.5 rounded-xl px-5 py-2.5 text-sm font-bold custom-shadow">
                        <i class="bi-rocket-takeoff-fill text-base"></i>
                        Mulai Jelajahi
                    </a>
                    <a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-white bg-transparent px-5 py-2.5 text-sm font-bold text-white transition hover:bg-white hover:text-primary">
                        <i class="bi-binoculars-fill text-base"></i>
                        Lihat Destinasi
                    </a>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="relative z-10 mt-7 lg:mt-0">
                <div class="bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1" style="border-radius: 1rem;">
                    <div class="text-[13px] font-bold text-[#1E293B] mb-3.5 flex items-center gap-1.5">
                        <i class="bi-bar-chart-steps text-primary text-lg"></i>
                        Informasi Wisata Cilacap
                    </div>
                    <div class="grid grid-cols-2 gap-2.5">
                        <div class="group bg-primary/10 p-3.5 transition-all duration-300 hover:bg-primary/15 hover:shadow-md" style="border-radius: 0.875rem;">
                            <div class="flex items-center gap-1.5 mb-1">
                                <div class="flex items-center justify-center bg-primary text-white" style="height: 30px; width: 30px; border-radius: 0.7rem;">
                                    <i class="bi-geo-alt-fill text-xs"></i>
                                </div>
                                <div class="text-[9px] font-bold text-primary">Total Wisata</div>
                            </div>
                            <div class="font-extrabold text-primary" style="font-size: 1.4rem;">{{ number_format($stats['destinations']) }}</div>
                            <div class="text-[9px] text-gray-500 mt-0.5">destinasi</div>
                        </div>
                        <div class="group bg-accent/10 p-3.5 transition-all duration-300 hover:bg-accent/15 hover:shadow-md" style="border-radius: 0.875rem;">
                            <div class="flex items-center gap-1.5 mb-1">
                                <div class="flex items-center justify-center bg-accent text-dark" style="height: 30px; width: 30px; border-radius: 0.7rem;">
                                    <i class="bi-utensils text-xs"></i>
                                </div>
                                <div class="text-[9px] font-bold text-accent">Total Kuliner</div>
                            </div>
                            <div class="font-extrabold text-accent" style="font-size: 1.4rem;">{{ number_format($stats['culinaries']) }}</div>
                            <div class="text-[9px] text-gray-500 mt-0.5">kuliner</div>
                        </div>
                        <div class="group bg-primary/10 p-3.5 transition-all duration-300 hover:bg-primary/15 hover:shadow-md" style="border-radius: 0.875rem;">
                            <div class="flex items-center gap-1.5 mb-1">
                                <div class="flex items-center justify-center bg-primary text-white" style="height: 30px; width: 30px; border-radius: 0.7rem;">
                                    <i class="bi-house-door-fill text-xs"></i>
                                </div>
                                <div class="text-[9px] font-bold text-primary">Total Penginapan</div>
                            </div>
                            <div class="font-extrabold text-primary" style="font-size: 1.4rem;">{{ number_format($stats['accommodations']) }}</div>
                            <div class="text-[9px] text-gray-500 mt-0.5">penginapan</div>
                        </div>
                        <div class="group bg-accent/10 p-3.5 transition-all duration-300 hover:bg-accent/15 hover:shadow-md" style="border-radius: 0.875rem;">
                            <div class="flex items-center gap-1.5 mb-1">
                                <div class="flex items-center justify-center bg-accent text-dark" style="height: 30px; width: 30px; border-radius: 0.7rem;">
                                    <i class="bi-buildings text-xs"></i>
                                </div>
                                <div class="text-[9px] font-bold text-accent">Total Budaya</div>
                            </div>
                            <div class="font-extrabold text-accent" style="font-size: 1.4rem;">{{ number_format($stats['cultures']) }}</div>
                            <div class="text-[9px] text-gray-500 mt-0.5">budaya</div>
                        </div>
                    </div>
                    <div class="mt-3.5 flex items-start gap-1.5 bg-primary/5 p-2.5" style="border-radius: 0.75rem;">
                        <div class="flex items-center justify-center rounded-full bg-accent/20 flex-shrink-0" style="height: 28px; width: 28px;">
                            <i class="bi-info-circle text-accent text-xs"></i>
                        </div>
                        <div class="text-[10px] leading-relaxed text-gray-600">
                            Data dikelola melalui panel admin untuk menjaga <span class="font-bold text-primary">akurasi</span>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-[#F8FAFC] to-transparent"></div>
    </section>

    <!-- Categories Section -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12">
        <div class="text-center mb-6">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                Jelajahi <span class="text-primary">Kategori Wisata</span>
            </h2>
            <p class="mt-1.5 text-[13px] text-gray-500 max-w-2xl mx-auto font-normal">
                Temukan berbagai informasi menarik seputar wisata di Cilacap
            </p>
        </div>
        
        <div class="grid gap-3.5 sm:grid-cols-2 lg:grid-cols-5">
            <a href="{{ route('destinations.index') }}" class="group rounded-xl border border-gray-200 bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                <div class="flex items-center gap-1.5 mb-2.5">
                    <div class="flex items-center justify-center bg-primary/10 text-primary transition-all duration-300 group-hover:scale-105 group-hover:bg-primary group-hover:text-white" style="height: 36px; width: 36px; border-radius: 0.875rem;">
                        <i class="bi-geo-alt-fill text-base"></i>
                    </div>
                    <div class="text-sm font-bold text-[#1E293B]">Destinasi</div>
                    <i class="bi-arrow-right text-gray-400 ml-auto transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary"></i>
                </div>
                <p class="text-[11px] text-gray-500 font-normal">Jelajahi tempat-tempat wisata terbaik di Cilacap</p>
            </a>

            <a href="{{ route('culinaries.index') }}" class="group rounded-xl border border-gray-200 bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                <div class="flex items-center gap-1.5 mb-2.5">
                    <div class="flex items-center justify-center bg-accent/20 text-accent transition-all duration-300 group-hover:scale-105 group-hover:bg-accent group-hover:text-dark" style="height: 36px; width: 36px; border-radius: 0.875rem;">
                        <i class="bi-utensils text-base"></i>
                    </div>
                    <div class="text-sm font-bold text-[#1E293B]">Kuliner Khas</div>
                    <i class="bi-arrow-right text-gray-400 ml-auto transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary"></i>
                </div>
                <p class="text-[11px] text-gray-500 font-normal">Nikmati berbagai kuliner khas Cilacap</p>
            </a>

            <a href="{{ route('culinary-cafes.index') }}" class="group rounded-xl border border-gray-200 bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                <div class="flex items-center gap-1.5 mb-2.5">
                    <div class="flex items-center justify-center bg-primary/10 text-primary transition-all duration-300 group-hover:scale-105 group-hover:bg-primary group-hover:text-white" style="height: 36px; width: 36px; border-radius: 0.875rem;">
                        <i class="bi-cup-hot text-base"></i>
                    </div>
                    <div class="text-sm font-bold text-[#1E293B]">Kuliner & Caffe</div>
                    <i class="bi-arrow-right text-gray-400 ml-auto transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary"></i>
                </div>
                <p class="text-[11px] text-gray-500 font-normal">Tempat makan dan ngopi terbaik di Cilacap</p>
            </a>

            <a href="{{ route('accommodations.index') }}" class="group rounded-xl border border-gray-200 bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                <div class="flex items-center gap-1.5 mb-2.5">
                    <div class="flex items-center justify-center bg-accent/20 text-accent transition-all duration-300 group-hover:scale-105 group-hover:bg-accent group-hover:text-dark" style="height: 36px; width: 36px; border-radius: 0.875rem;">
                        <i class="bi-house-door-fill text-base"></i>
                    </div>
                    <div class="text-sm font-bold text-[#1E293B]">Penginapan</div>
                    <i class="bi-arrow-right text-gray-400 ml-auto transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary"></i>
                </div>
                <p class="text-[11px] text-gray-500 font-normal">Temukan penginapan yang nyaman sesuai kebutuhan</p>
            </a>

            <a href="{{ route('cultures.index') }}" class="group rounded-xl border border-gray-200 bg-white p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                <div class="flex items-center gap-1.5 mb-2.5">
                    <div class="flex items-center justify-center bg-primary/10 text-primary transition-all duration-300 group-hover:scale-105 group-hover:bg-primary group-hover:text-white" style="height: 36px; width: 36px; border-radius: 0.875rem;">
                        <i class="bi-buildings text-base"></i>
                    </div>
                    <div class="text-sm font-bold text-[#1E293B]">Budaya</div>
                    <i class="bi-arrow-right text-gray-400 ml-auto transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary"></i>
                </div>
                <p class="text-[11px] text-gray-500 font-normal">Kenali budaya dan tradisi lokal Cilacap</p>
            </a>
        </div>
    </section>

    <!-- Profile Kabupaten Cilacap -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12 bg-white rounded-[1.75rem] custom-shadow border border-gray-100 my-6">
        <div class="text-center mb-10">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                Profil <span class="text-primary">Kabupaten Cilacap</span>
            </h2>
            <p class="mt-1.5 text-[13px] text-gray-500 max-w-2xl mx-auto font-normal">
                "The Light of Java" & Gerbang Utama Koridor Selatan Jawa
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-5">
                <div class="rounded-xl border border-primary/10 bg-primary/5 p-5">
                    <h3 class="text-sm font-bold text-primary flex items-center gap-2 mb-3">
                        <i class="bi-globe-asia-australasia"></i>
                        1. Pengantar Geografis dan Identitas Wilayah
                    </h3>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Kabupaten Cilacap merupakan wilayah administratif terluas di Provinsi Jawa Tengah, dengan posisi geopolitik yang sangat strategis di pesisir selatan Pulau Jawa. Wilayah ini berbatasan langsung dengan Samudra Hindia di sebelah selatan dan Provinsi Jawa Barat di sebelah barat. Letak geografis yang unik ini menjadikan Cilacap sebagai area transisi kebudayaan yang dinamis antara tradisi Jawa Banyumasan dan kebudayaan Sunda.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2">
                        Secara topografi, Cilacap memiliki karakteristik yang sangat beragam, mulai dari dataran rendah pesisir, kawasan rawa pasang surut di Segara Anakan, hingga kawasan perbukitan di bagian utara dan barat. Keberadaan Pulau Nusakambangan di sisi selatan bertindak sebagai benteng sekaligus penahan ombak alami (breakwater), yang secara hidrografis memungkinkan terbentuknya pelabuhan alam laut dalam satu-satunya di pantai selatan Jawa yang aman dari ombak besar samudra.
                    </p>
                </div>

                <div class="rounded-xl border border-accent/10 bg-accent/5 p-5">
                    <h3 class="text-sm font-bold text-accent flex items-center gap-2 mb-3">
                        <i class="bi-book"></i>
                        2. Sejarah dan Asal-Usul Perkembangan Wilayah
                    </h3>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Secara etimologi, nama "Cilacap" diyakini berasal dari gabungan kata dalam bahasa Sunda dan Jawa kuno, yaitu "Tji" (air/sungai) dan "Tjacap" atau "Cap" yang merujuk pada tanah lancip atau menjorok ke laut (tanjung). Penamaan ini sangat selaras dengan kondisi geografis wilayah pesisir Cilacap kuno yang membentuk semenanjung.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2 font-semibold">Masa Klasik hingga Kesultanan Mataram</p>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Pada masa kerajaan klasik, wilayah Cilacap berada di bawah pengaruh silih berganti antara kerajaan-kerajaan besar di Jawa Barat (seperti Pajajaran dan Galuh) dan kerajaan di Jawa Tengah. Pada abad ke-16, wilayah ini masuk ke dalam pengaruh Kesultanan Demak yang kemudian diteruskan oleh Kesultanan Mataram Islam. Di bawah pemerintahan Mataram, Cilacap menjadi pos penting di pesisir selatan, terutama dalam aktivitas perdagangan maritim terbatas dan pertahanan wilayah.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2 font-semibold">Masa Kolonial Hindia Belanda dan Pembentukan Administratif</p>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Arti penting Cilacap secara geopolitik meningkat tajam pada masa penjajahan Hindia Belanda. Melihat potensi pelabuhannya yang terlindung oleh Pulau Nusakambangan, pemerintah kolonial mulai membangun infrastruktur militer dan ekonomi besar-besaran sejak abad ke-19. Pemerintah Hindia Belanda mendirikan Benteng Pendem (Kustbatterij op de Landtong te Tjilatjap) antara tahun 1861 hingga 1879 sebagai basis pertahanan utama pantai selatan. Pelabuhan Cilacap kemudian dikembangkan menjadi pelabuhan ekspor komoditas hasil tanam paksa dari daerah pedalaman Jawa, seperti kopi, gula, dan indigo, yang didukung oleh pembangunan jalur kereta api.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2">
                        Secara administratif, hari jadi Kabupaten Cilacap ditetapkan jatuh pada tanggal 21 Maret 1856. Penetapan ini didasarkan pada besluit Gubernur Jenderal Hindia Belanda, yang secara resmi meningkatkan status Cilacap dari distrik menjadi kadipaten (kabupaten) mandiri di bawah kedaulatan pemerintah kolonial, dengan bupati pertama bernama Tumenggung Tjakrawerdaya.
                    </p>
                </div>
            </div>

            <div class="space-y-5">
                <div class="rounded-xl border border-primary/10 bg-primary/5 p-5">
                    <h3 class="text-sm font-bold text-primary flex items-center gap-2 mb-3">
                        <i class="bi-building"></i>
                        3. Strategis Ekonomi: Raksasa Industri Nasional
                    </h3>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Di era modern, Cilacap telah bertransformasi menjadi salah satu pilar industri dan energi terbesar di Indonesia. Kawasan ini ditetapkan sebagai Kawasan Industri Cilacap (KIC) yang menampung berbagai objek vital nasional.
                    </p>
                    <div class="mt-4 grid gap-3">
                        <div class="flex items-start gap-3 bg-white p-3 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-center bg-primary text-white flex-shrink-0" style="height: 40px; width: 40px; border-radius: 0.75rem;">
                                <i class="bi-oil-can"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-[#1E293B]">Pengolahan Minyak & Gas</div>
                                <p class="text-[11px] text-gray-600">Kilang Minyak Pertamina Refinery Unit (RU) IV Cilacap - Kilang terbesar di Indonesia yang memasok sekitar 34% kebutuhan BBM nasional atau 60% kebutuhan BBM di Pulau Jawa.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white p-3 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-center bg-accent text-dark flex-shrink-0" style="height: 40px; width: 40px; border-radius: 0.75rem;">
                                <i class="bi-lightning"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-[#1E293B]">Ketenagalistrikan</div>
                                <p class="text-[11px] text-gray-600">PLTU Karangkandri (Cilacap) - Penyuplai energi listrik skala masif untuk memperkuat sistem interkoneksi Jawa-Madura-Bali (Jamali).</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white p-3 rounded-lg border border-gray-200">
                            <div class="flex items-center justify-center bg-primary text-white flex-shrink-0" style="height: 40px; width: 40px; border-radius: 0.75rem;">
                                <i class="bi-bricks"></i>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-[#1E293B]">Manufaktur Konstruksi</div>
                                <p class="text-[11px] text-gray-600">Pabrik Semen PT Solusi Bangun Indonesia (SBI / Dynamix) - Memanfaatkan deposit batu kapur di kawasan pesisir dan Nusakambangan untuk memasok material infrastruktur nasional.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-accent/10 bg-accent/5 p-5">
                    <h3 class="text-sm font-bold text-accent flex items-center gap-2 mb-3">
                        <i class="bi-people"></i>
                        5. Keragaman Budaya, Tradisi, dan Kuliner
                    </h3>
                    <p class="text-[13px] leading-relaxed text-gray-600">
                        Pertemuan dua kebudayaan besar membentuk karakter masyarakat Cilacap yang unik. Bahasa Jawa Banyumasan (Ngapak) dengan dialek yang tegas dan egaliter digunakan oleh mayoritas penduduk di wilayah tengah dan timur. Sementara itu, di wilayah barat yang berbatasan dengan Jawa Barat (seperti Majenang, Dayeuhluhur, dan Wanareja), bahasa Sunda digunakan secara aktif dalam kehidupan sehari-hari.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2">
                        Salah satu ekspresi budaya terbesar di kabupaten ini adalah upacara adat Sedekah Laut. Tradisi tahunan ini digelar setiap bulan Sura dalam penanggalan Jawa sebagai wujud syukur kolektif para nelayan atas rezeki hasil laut yang melimpah sekaligus permohonan keselamatan kepada Tuhan Yang Maha Esa.
                    </p>
                    <p class="text-[13px] leading-relaxed text-gray-600 mt-2">
                        Di sektor kuliner, Cilacap memiliki hidangan laut autentik yang sangat populer, seperti Brekecek Pathak Jahan. Kuliner ini menggunakan bahan dasar kepala ikan jahan yang dimasak dengan bumbu rempah-rempah tradisional berkuah kental, menghasilkan cita rasa yang sangat pedas, gurih, dan segar. Selain itu, terdapat pula hidangan Tahu Masak, yaitu ketupat dan tahu yang disajikan dengan bumbu kacang encer gurih manis khas pesisiran dan taburan kerupuk merah.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trip Planner Section -->
    <section id="jelajah" class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12 bg-white rounded-[1.75rem] custom-shadow border border-gray-100 my-6">
        <div class="grid gap-7 lg:grid-cols-2">
            <div>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                    Rencanakan <span class="text-primary">Liburan Anda</span> di Cilacap
                </h2>
                <p class="mt-2.5 text-[13px] text-gray-500 font-normal">
                    Pilih berapa hari Anda berada di Cilacap, lokasi menginap, budget, dan jenis wisata.
                </p>
                <div class="mt-5 rounded-xl border border-primary/10 bg-[#F8FAFC] p-4.5 custom-shadow">
                    <form action="{{ route('trip-planner.recommend') }}" method="POST" class="space-y-3.5">
                        @csrf

                        <div>
                            <label class="text-[13px] font-semibold text-[#1E293B]">Berapa hari di Cilacap?</label>
                            <select name="days" class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-[13px] text-gray-700 shadow-sm transition-all duration-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                                @for($d = 1; $d <= 5; $d++)
                                    <option value="{{ $d }}">{{ $d }} Hari</option>
                                @endfor
                            </select>
                        </div>

                        <div class="grid gap-2.5 sm:grid-cols-2">
                            <div>
                                <label class="text-[13px] font-semibold text-[#1E293B]">Lokasi Menginap</label>
                                <select name="location_zone" class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-[13px] text-gray-700 shadow-sm transition-all duration-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                                    @foreach($locationZones as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-[13px] font-semibold text-[#1E293B]">Budget</label>
                                <select name="budget" class="mt-1.5 w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-[13px] text-gray-700 shadow-sm transition-all duration-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                                    @foreach($budgets as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="text-[13px] font-semibold text-[#1E293B]">Jenis Wisata</label>
                            <div class="mt-1.5 grid gap-2 sm:grid-cols-2">
                                @foreach($travelTypes as $key => $label)
                                    <label class="flex cursor-pointer items-center gap-1.5 rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-[13px] shadow-sm transition-all duration-300 hover:border-primary/40 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                        <input type="checkbox" name="travel_types[]" value="{{ $key }}" class="h-3.5 w-3.5 rounded border-gray-300 text-primary shadow-none focus:ring-primary">
                                        <span class="font-semibold text-gray-700">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-full items-center justify-center gap-1.5 rounded-lg px-5 py-2.5 text-sm font-bold custom-shadow hover:shadow-lg">
                            <i class="bi-search text-base"></i>
                            Cari Rekomendasi
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-3.5">
                <div class="rounded-xl border border-accent/20 bg-accent/5 p-4.5 custom-shadow">
                    <div class="flex items-center gap-1.5 mb-2.5">
                        <div class="flex items-center justify-center bg-accent text-dark" style="height: 34px; width: 34px; border-radius: 0.7rem;">
                            <i class="bi-lightbulb text-sm"></i>
                        </div>
                        <div class="text-sm font-bold text-[#1E293B]">Panduan Cepat</div>
                    </div>
                    <div class="mt-2.5 space-y-1.5">
                        <div class="flex items-start gap-1.5">
                            <div class="mt-1 h-1.5 w-1.5 rounded-full bg-accent"></div>
                            <div class="text-[13px] text-gray-600 font-normal">Paket itinerary diatur admin tanpa perlu coding.</div>
                        </div>
                        <div class="flex items-start gap-1.5">
                            <div class="mt-1 h-1.5 w-1.5 rounded-full bg-accent"></div>
                            <div class="text-[13px] text-gray-600 font-normal">Rekomendasi menampilkan timeline interaktif per hari.</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-primary/10 bg-primary/5 p-4.5 custom-shadow">
                    <div class="flex items-center gap-1.5 mb-2.5">
                        <div class="flex items-center justify-center bg-primary text-white" style="height: 34px; width: 34px; border-radius: 0.7rem;">
                            <i class="bi-phone text-sm"></i>
                        </div>
                        <div class="text-sm font-bold text-primary">Desain Responsif</div>
                    </div>
                    <div class="mt-2.5 text-[13px] leading-relaxed text-gray-600 font-normal">
                        Tampilan nyaman untuk HP, tablet, dan desktop.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12">
        <div class="flex items-end justify-between gap-3">
            <div>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                    Wisata <span class="text-primary">Unggulan</span>
                </h2>
                <p class="mt-1.5 text-[13px] text-gray-500 font-normal">Pilihan destinasi terbaik untuk memulai perjalanan.</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                Lihat semua <i class="bi-arrow-right"></i>
            </a>
        </div>

        <div class="mt-5 grid gap-3.5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredDestinations as $item)
                @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                <a href="{{ route('destinations.show', $item) }}" class="group overflow-hidden rounded-xl border border-gray-200 bg-white custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-lg">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-primary/10">
                        @if($img)
                            @if(Str::startsWith($img, 'http'))
                                <img src="{{ $img }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @elseif(Str::startsWith($img, 'img/'))
                                <img src="{{ asset($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @else
                                <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @endif
                        @endif
                    </div>
                    <div class="p-4.5">
                        <div class="flex items-center justify-between gap-2 mb-1.5">
                            <div class="text-sm font-bold tracking-tight text-[#1E293B] truncate">{{ $item->name }}</div>
                            <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-[10px] font-bold text-accent">Unggulan</span>
                        </div>
                        <div class="mt-1.5 line-clamp-2 text-[13px] text-gray-500 font-normal">{{ $item->short_description }}</div>
                        <div class="mt-3.5 flex items-center gap-1.5 text-[13px] font-bold text-primary group-hover:gap-2 transition-all duration-300">
                            <span>Lihat Detail</span>
                            <i class="bi-arrow-right transition-transform text-sm"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Popular Culinaries & Accommodations -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12 bg-white rounded-[1.75rem] custom-shadow border border-gray-100 my-6">
        <div class="grid gap-7 lg:grid-cols-2">
            <div>
                <div class="flex items-end justify-between gap-3 mb-5">
                    <div>
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                            Kuliner <span class="text-accent">Populer</span>
                        </h2>
                        <p class="mt-1.5 text-[13px] text-gray-500 font-normal">Cita rasa khas yang wajib dicoba.</p>
                    </div>
                    <a href="{{ route('culinaries.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Lihat semua <i class="bi-arrow-right"></i>
                    </a>
                </div>
                <div class="grid gap-3.5 sm:grid-cols-2">
                    @foreach($popularCulinaries as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('culinaries.show', $item) }}" class="group overflow-hidden rounded-xl border border-gray-200 bg-[#F8FAFC] custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-lg">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-accent/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                                @endif
                            </div>
                            <div class="p-3.5">
                                <div class="flex items-center justify-between gap-2 mb-1.5">
                                    <div class="text-sm font-bold tracking-tight text-[#1E293B] truncate">{{ $item->name }}</div>
                                    <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-[10px] font-bold text-primary">Populer</span>
                                </div>
                                <div class="mt-1.5 line-clamp-2 text-[11px] text-gray-500 font-normal">{{ $item->short_description }}</div>
                                <div class="mt-3.5 flex items-center gap-1.5 text-[13px] font-bold text-primary group-hover:gap-2 transition-all duration-300">
                                    <span>Lihat Detail</span>
                                    <i class="bi-arrow-right transition-transform text-sm"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex items-end justify-between gap-3 mb-5">
                    <div>
                        <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                            Penginapan <span class="text-primary">Populer</span>
                        </h2>
                        <p class="mt-1.5 text-[13px] text-gray-500 font-normal">Rekomendasi hotel dan penginapan pilihan.</p>
                    </div>
                    <a href="{{ route('accommodations.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                        Lihat semua <i class="bi-arrow-right"></i>
                    </a>
                </div>
                <div class="grid gap-3.5 sm:grid-cols-2">
                    @foreach($popularAccommodations as $item)
                        @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                        <a href="{{ route('accommodations.show', $item) }}" class="group overflow-hidden rounded-xl border border-gray-200 bg-[#F8FAFC] custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-lg">
                            <div class="aspect-[16/10] w-full overflow-hidden bg-primary/10">
                                @if($img)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                                @endif
                            </div>
                            <div class="p-3.5">
                                <div class="flex items-center justify-between gap-2 mb-1.5">
                                    <div class="text-sm font-bold tracking-tight text-[#1E293B] truncate">{{ $item->name }}</div>
                                    <span class="rounded-full bg-accent/20 px-2.5 py-0.5 text-[10px] font-bold text-accent">{{ $item->category ? (config('cilacap.accommodation_categories')[$item->category] ?? $item->category) : 'Penginapan' }}</span>
                                </div>
                                <div class="mt-1.5 line-clamp-2 text-[11px] text-gray-500 font-normal">{{ $item->address }}</div>
                                <div class="mt-3.5 flex items-center gap-1.5 text-[13px] font-bold text-primary group-hover:gap-2 transition-all duration-300">
                                    <span>Lihat Detail</span>
                                    <i class="bi-arrow-right transition-transform text-sm"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Cultures -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12">
        <div class="flex items-end justify-between gap-3 mb-6">
            <div>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-[#1E293B]">
                    Budaya <span class="text-accent">Cilacap</span>
                </h2>
                <p class="mt-1.5 text-[13px] text-gray-500 font-normal">Warisan adat dan budaya yang membanggakan.</p>
            </div>
            <a href="{{ route('cultures.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">
                Lihat semua <i class="bi-arrow-right"></i>
            </a>
        </div>

        <div class="mt-5 grid gap-3.5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredCultures as $item)
                @php($img = is_array($item->images) ? ($item->images[0] ?? null) : null)
                <a href="{{ route('cultures.show', $item) }}" class="group overflow-hidden rounded-xl border border-gray-200 bg-white custom-shadow transition-all duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-lg">
                    <div class="aspect-[16/10] w-full overflow-hidden bg-accent/10">
                        @if($img)
                            @if(Str::startsWith($img, 'http'))
                                <img src="{{ $img }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @elseif(Str::startsWith($img, 'img/'))
                                <img src="{{ asset($img) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @else
                                <img src="{{ asset('storage/' . ltrim($img, '/')) }}" alt="{{ $item->name }}" class="h-full w-full object-cover transition-all duration-500 group-hover:scale-[1.03]">
                            @endif
                        @endif
                    </div>
                    <div class="p-4.5">
                        <div class="flex items-center justify-between gap-2 mb-1.5">
                            <div class="text-sm font-bold tracking-tight text-[#1E293B] truncate">{{ $item->name }}</div>
                            <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-[10px] font-bold text-primary">
                                {{ $item->type ? (config('cilacap.culture_types')[$item->type] ?? $item->type) : 'Budaya' }}
                            </span>
                        </div>
                        <div class="mt-1.5 line-clamp-2 text-[13px] text-gray-500 font-normal">{{ $item->short_description }}</div>
                        <div class="mt-3.5 flex items-center gap-1.5 text-[13px] font-bold text-primary group-hover:gap-2 transition-all duration-300">
                            <span>Lihat Detail</span>
                            <i class="bi-arrow-right transition-transform text-sm"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Testimonials -->
    <section class="mx-auto max-w-[1320px] px-3 py-8 sm:px-6 lg:px-8 lg:py-12 bg-gradient-to-br from-primary to-primary-dark rounded-[1.75rem] custom-shadow my-6">
        <div class="flex items-end justify-between gap-3 mb-6">
            <div>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold tracking-tight text-white">
                    Testimoni <span class="text-accent">Pengunjung</span>
                </h2>
                <p class="mt-1.5 text-[13px] text-white/80 font-normal">Pengalaman pengunjung di Cilacap.</p>
            </div>
            <a href="{{ route('testimonials.index') }}" class="text-sm font-bold text-white hover:underline flex items-center gap-1">
                Lihat semua <i class="bi-arrow-right"></i>
            </a>
        </div>

        <div class="grid gap-3.5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($testimonials as $t)
                <div class="rounded-xl bg-white/95 backdrop-blur-md p-4.5 custom-shadow transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <div class="grid place-items-center bg-accent text-dark text-sm font-bold" style="height: 36px; width: 36px; border-radius: 0.7rem;">
                            {{ mb_substr($t->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-[#1E293B]">{{ $t->name }}</div>
                            <div class="text-[11px] text-gray-500 font-normal">{{ $t->role }}</div>
                        </div>
                    </div>
                    <div class="mt-2.5 text-[13px] leading-relaxed text-gray-600 font-normal">“{{ $t->message }}”</div>
                    <div class="mt-3.5 flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi-star-fill text-sm {{ $i <= $t->rating ? 'text-accent' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
