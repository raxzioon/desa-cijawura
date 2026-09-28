<x-app-layout>
    @php
        $heroSlides = $sliders->map(function ($s) {
            return [
                'image' => $s->image ? \Illuminate\Support\Facades\Storage::url($s->image) : null,
                'title' => $s->title,
                'description' => $s->description,
            ];
        });

        $avatarPath = $avatarKepalaDesa->content ?? 'images/logo.png';
        $namaKades = $namaKepalaDesa->content ?? 'Kepala Desa';
        $periodeKades = $periodeKepalaDesa->content ?? '2025 - 2029';
        $villageTitle = $villageName->content ?? 'Nama Desa';

        $cleanPhoneNumber = null;
        if ($contactPhone && $contactPhone->content) {
            $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content);
        }
    @endphp

    <div class="bg-slate-50 text-slate-800">
        {{-- ======================================================
            HERO (REVAMP)
        ======================================================= --}}
        <section id="hero" class="relative overflow-hidden" x-data="{
            active: 0,
            slides: {{ $heroSlides->toJson() }},
            next() { if (this.slides.length) this.active = (this.active + 1) % this.slides.length },
            prev() { if (this.slides.length) this.active = (this.active - 1 + this.slides.length) % this.slides.length }
        }"
            x-init="if (slides.length > 1) { setInterval(() => next(), 7000); }">

            <div class="absolute inset-0">
                <template x-if="slides.length">
                    <div class="w-full h-full bg-cover bg-center transition-all duration-700"
                        :style="slides[active].image ? `background-image:url('${slides[active].image}')` : ''">
                    </div>
                </template>
                <template x-if="!slides.length">
                    <div class="w-full h-full bg-[radial-gradient(circle_at_top,rgba(14,116,144,0.12),transparent_55%),linear-gradient(180deg,#f8fafc,#eef2f7)]">
                    </div>
                </template>
                <div class="absolute inset-0 bg-gradient-to-br from-white/85 via-white/70 to-white/30"></div>
                <div class="absolute -top-20 -right-32 h-80 w-80 rounded-full bg-emerald-200/30 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-sky-200/40 blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24">
                <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-center">
                    <div class="space-y-6" data-aos="fade-right">
                        <div
                            class="inline-flex items-center gap-2 bg-white/80 border border-emerald-100 px-4 py-1.5 rounded-full text-xs md:text-sm text-emerald-700 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Portal Resmi {{ $villageTitle }}
                        </div>

                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-semibold leading-tight text-slate-900"
                            x-text="slides.length && slides[active].title ? slides[active].title : 'Ruang Layanan Digital Desa'">
                        </h1>

                        <p class="text-sm md:text-base text-slate-600 max-w-xl"
                            x-text="slides.length && slides[active].description
        ? slides[active].description
        : 'Akses informasi, layanan administrasi, hingga program pembangunan dalam satu platform yang transparan, cepat, dan mudah diakses.'">
                        </p>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('surat-online.index') }}"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-medium bg-primary hover:bg-primary-700 text-white shadow-lg shadow-primary-300/40 transition-all">
                                Ajukan Surat Online
                                <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                            </a>
                            <a href="{{ route('service-procedures') }}"
                                class="inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-medium border border-slate-300 bg-white hover:bg-slate-50 text-slate-800 transition-all">
                                Lihat Prosedur Layanan
                            </a>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs text-slate-600">
                            <div class="flex items-center gap-2 bg-white/70 border border-slate-200 rounded-xl px-3 py-2">
                                <i class="fa-solid fa-shield-check text-emerald-600"></i>
                                Data transparan & terverifikasi
                            </div>
                            <div class="flex items-center gap-2 bg-white/70 border border-slate-200 rounded-xl px-3 py-2">
                                <i class="fa-solid fa-bolt text-amber-600"></i>
                                Pelayanan lebih cepat
                            </div>
                            <div class="flex items-center gap-2 bg-white/70 border border-slate-200 rounded-xl px-3 py-2">
                                <i class="fa-solid fa-people-group text-sky-600"></i>
                                Akses untuk semua warga
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6" data-aos="fade-left">
                        <div class="bg-white/90 backdrop-blur-xl rounded-2xl border border-slate-200 p-6 shadow-xl">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full overflow-hidden border-2 border-primary-400 bg-slate-100">
                                    <img src="{{ asset('storage/' . $avatarPath) }}"
                                        alt="Kepala Desa {{ $namaKades }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-[11px] text-slate-400 uppercase tracking-widest">Sambutan</p>
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $namaKades }}</h3>
                                    <p class="text-[11px] text-slate-500">Kepala Desa {{ $villageTitle }}</p>
                                    <p class="text-[11px] text-slate-500">Periode: {{ $periodeKades }}</p>
                                </div>
                            </div>
                            <div class="text-xs text-slate-600 space-y-2 max-h-40 overflow-y-auto custom-scroll mt-4">
                                {!! $sekilasDesa->content ??
                                    '<p>Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa sehingga portal resmi desa ini dapat hadir sebagai jembatan informasi dan layanan bagi seluruh warga.</p>' !!}
                            </div>
                            <p class="text-[11px] text-slate-500 border-t border-slate-200 pt-3 mt-4">
                                Jam layanan kantor: <span class="font-semibold text-slate-800">Senin–Jumat, 08.00–15.00
                                    WIB</span>
                            </p>
                        </div>

                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                            <p class="text-[11px] text-slate-400 uppercase tracking-widest mb-2">Akses cepat</p>
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <a href="{{ route('aduan.index') }}"
                                    class="flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 hover:border-primary-300 hover:bg-primary-50 transition-all">
                                    <i class="fa-solid fa-comments text-primary"></i>
                                    Pengaduan
                                </a>
                                <a href="{{ route('data-pembangunan.index') }}"
                                    class="flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 hover:border-primary-300 hover:bg-primary-50 transition-all">
                                    <i class="fa-solid fa-database text-primary"></i>
                                    Data Pembangunan
                                </a>
                                <a href="{{ route('news') }}"
                                    class="flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 hover:border-primary-300 hover:bg-primary-50 transition-all">
                                    <i class="fa-solid fa-newspaper text-primary"></i>
                                    Berita Desa
                                </a>
                                <a href="{{ route('gallery') }}"
                                    class="flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 hover:border-primary-300 hover:bg-primary-50 transition-all">
                                    <i class="fa-solid fa-images text-primary"></i>
                                    Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-3" x-show="slides.length > 1">
                <button @click="prev"
                    class="w-8 h-8 rounded-full bg-white/80 hover:bg-white shadow flex items-center justify-center text-xs text-slate-700 border border-slate-200">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <div class="flex gap-1.5">
                    <template x-for="(s, i) in slides" :key="i">
                        <button @click="active = i" class="w-2.5 h-2.5 rounded-full border border-slate-400"
                            :class="i === active ? 'bg-slate-700' : 'bg-slate-200'"></button>
                    </template>
                </div>
                <button @click="next"
                    class="w-8 h-8 rounded-full bg-white/80 hover:bg-white shadow flex items-center justify-center text-xs text-slate-700 border border-slate-200">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </section>

        {{-- ======================================================
            LAYANAN CEPAT
        ======================================================= --}}
        <section id="akses-cepat" class="bg-white border-t border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-400">Layanan</p>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Akses Layanan Utama</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Mulai dari administrasi hingga aspirasi warga, semua bisa diakses di sini.
                        </p>
                    </div>
                    <a href="{{ route('service-procedures') }}"
                        class="inline-flex items-center text-sm text-primary hover:text-primary-800">
                        Lihat semua layanan
                        <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" data-aos="fade-up">
                    <a href="{{ route('surat-online.index') }}"
                        class="group rounded-2xl bg-slate-50 hover:bg-white border border-slate-200 hover:border-primary-300 p-5 transition-all shadow-sm hover:shadow-md">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-200 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900 mb-1">Pengajuan Surat</h3>
                        <p class="text-xs text-slate-600">Ajukan berbagai jenis surat secara online.</p>
                    </a>
                    <a href="{{ route('service-procedures') }}"
                        class="group rounded-2xl bg-slate-50 hover:bg-white border border-slate-200 hover:border-primary-300 p-5 transition-all shadow-sm hover:shadow-md">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-200 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900 mb-1">Prosedur Layanan</h3>
                        <p class="text-xs text-slate-600">Alur dan persyaratan pelayanan desa.</p>
                    </a>
                    <a href="{{ route('aduan.index') }}"
                        class="group rounded-2xl bg-slate-50 hover:bg-white border border-slate-200 hover:border-primary-300 p-5 transition-all shadow-sm hover:shadow-md">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-200 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900 mb-1">Pengaduan Warga</h3>
                        <p class="text-xs text-slate-600">Sampaikan aspirasi dan keluhan Anda.</p>
                    </a>
                    <a href="{{ route('data-pembangunan.index') }}"
                        class="group rounded-2xl bg-slate-50 hover:bg-white border border-slate-200 hover:border-primary-300 p-5 transition-all shadow-sm hover:shadow-md">
                        <div
                            class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-200 flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-slate-900 mb-1">Data Pembangunan</h3>
                        <p class="text-xs text-slate-600">Ikuti progres dan program desa.</p>
                    </a>
                </div>
            </div>
        </section>

        {{-- ======================================================
            ALUR LAYANAN
        ======================================================= --}}
        <section id="alur-layanan" class="bg-slate-50 border-t border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
                <div class="grid lg:grid-cols-[1fr_1.2fr] gap-10 items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-400">Panduan</p>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Langkah Layanan Digital</h2>
                        <p class="text-sm text-slate-600 mt-2">
                            Proses yang ringkas dan transparan agar warga dapat mengakses layanan dengan nyaman.
                        </p>
                    </div>
                    <div class="grid md:grid-cols-3 gap-4" data-aos="fade-left">
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                            <div class="text-xs text-slate-400 uppercase tracking-widest mb-2">Langkah 01</div>
                            <h3 class="text-sm font-semibold text-slate-900 mb-1">Isi Permohonan</h3>
                            <p class="text-xs text-slate-600">Lengkapi data dan unggah dokumen yang dibutuhkan.</p>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                            <div class="text-xs text-slate-400 uppercase tracking-widest mb-2">Langkah 02</div>
                            <h3 class="text-sm font-semibold text-slate-900 mb-1">Verifikasi</h3>
                            <p class="text-xs text-slate-600">Petugas memeriksa kelengkapan dan validasi data.</p>
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                            <div class="text-xs text-slate-400 uppercase tracking-widest mb-2">Langkah 03</div>
                            <h3 class="text-sm font-semibold text-slate-900 mb-1">Dokumen Siap</h3>
                            <p class="text-xs text-slate-600">Notifikasi dikirim saat dokumen dapat diambil.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ======================================================
            STATISTIK DESA
        ======================================================= --}}
        <section id="statistik" class="bg-white py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Statistik Desa</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Gambaran singkat kondisi {{ $villageTitle }} berdasarkan data terakhir.
                        </p>
                    </div>
                </div>

                @if ($dataStatistik->count())
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up">
                        @foreach ($dataStatistik as $index => $statistik)
                            @php
                                $colorSchemes = [
                                    [
                                        'bg' => 'from-blue-50 to-blue-100',
                                        'accent' => 'bg-primary-500',
                                        'text' => 'text-blue-600',
                                    ],
                                    [
                                        'bg' => 'from-emerald-50 to-emerald-100',
                                        'accent' => 'bg-emerald-500',
                                        'text' => 'text-emerald-600',
                                    ],
                                    [
                                        'bg' => 'from-amber-50 to-amber-100',
                                        'accent' => 'bg-amber-500',
                                        'text' => 'text-amber-600',
                                    ],
                                    [
                                        'bg' => 'from-sky-50 to-sky-100',
                                        'accent' => 'bg-sky-500',
                                        'text' => 'text-sky-600',
                                    ],
                                ];
                                $scheme = $colorSchemes[$index % count($colorSchemes)];
                            @endphp

                            <div class="group relative" data-aos="zoom-in" data-aos-delay="{{ $index * 80 }}">
                                <div
                                    class="bg-gradient-to-br {{ $scheme['bg'] }} rounded-2xl border border-slate-200 shadow-sm hover:shadow-lg p-6 transition-all duration-300">
                                    <div class="flex items-start justify-between gap-4 mb-4">
                                        <div>
                                            <p class="text-[11px] text-slate-400 uppercase tracking-widest mb-1">
                                                Statistik
                                            </p>
                                            <h3 class="text-base font-semibold text-slate-900">
                                                {{ $statistik->nama_statistik }}
                                            </h3>
                                        </div>
                                        @if ($statistik->icon)
                                            <div
                                                class="w-9 h-9 rounded-xl bg-white/70 border border-slate-200 flex items-center justify-center text-lg {{ $scheme['text'] }}">
                                                <i class="{{ $statistik->icon }}"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-baseline gap-2 mb-2">
                                        <p class="text-2xl font-semibold text-slate-900">
                                            {{ $statistik->formatted_jumlah }}
                                        </p>
                                        @if ($statistik->satuan)
                                            <span class="text-xs text-slate-600">
                                                {{ $statistik->satuan }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-xs text-slate-600">
                                        {{ $statistik->deskripsi ?? 'Jumlah ' . $statistik->nama_statistik }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-600">Data statistik belum tersedia.</p>
                @endif
            </div>
        </section>

        {{-- ======================================================
            PROGRAM DESA
        ======================================================= --}}
        <section id="program-desa" class="bg-slate-50 py-16 border-y border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Program Unggulan Desa</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Deretan program kerja yang sedang dan akan dijalankan untuk kemajuan desa.
                        </p>
                    </div>
                </div>

                @if ($programDesa->count())
                    <div class="grid md:grid-cols-2 gap-6" data-aos="fade-up">
                        @foreach ($programDesa as $index => $program)
                            <div class="bg-white border border-slate-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-50 border border-primary-200 flex items-center justify-center font-semibold text-sm text-emerald-700">
                                    {{ $program->urutan }}
                                </div>
                                <div>
                                    <h3 class="text-base font-semibold text-slate-900 mb-1">
                                        {{ $program->name }}
                                    </h3>
                                    <p class="text-sm text-slate-600">
                                        {{ $program->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-600">Belum ada program desa yang terdaftar.</p>
                @endif
            </div>
        </section>

        {{-- ======================================================
            POTENSI DESA
        ======================================================= --}}
        <section id="potensi" class="bg-white py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                            Potensi {{ $villageTitle }}
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Sumber daya dan keunggulan yang dimiliki desa.
                        </p>
                    </div>
                    <a href="{{ route('potentials') }}"
                        class="inline-flex items-center text-sm text-primary hover:text-primary-800">
                        Lihat semua potensi
                        <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>

                @if ($potentials->count())
                    <div class="grid md:grid-cols-3 gap-6" data-aos="fade-up">
                        @foreach ($potentials as $index => $potential)
                            <div
                                class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-transform hover:-translate-y-1 duration-300">
                                @if ($potential->image)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($potential->image) }}"
                                        alt="{{ $potential->title }}" class="w-full h-40 object-cover">
                                @else
                                    <div
                                        class="w-full h-40 bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="p-5 flex flex-col gap-2">
                                    <h3 class="text-base font-semibold text-slate-900">
                                        {{ $potential->title }}
                                    </h3>
                                    <p class="text-xs text-slate-600">
                                        {!! \Illuminate\Support\Str::limit($potential->description, 120) !!}
                                    </p>
                                    <a href="{{ route('potentials') }}"
                                        class="mt-2 inline-flex items-center text-xs text-primary hover:text-primary-800">
                                        Selengkapnya
                                        <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-600">Belum ada data potensi desa.</p>
                @endif
            </div>
        </section>

        {{-- ======================================================
            BERITA & PENGUMUMAN
        ======================================================= --}}
        <section id="berita" class="bg-slate-50 py-16 border-y border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">Berita & Pengumuman</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Informasi terkini mengenai kegiatan dan kebijakan desa.
                        </p>
                    </div>
                    <a href="{{ route('news') }}"
                        class="inline-flex items-center text-sm text-primary hover:text-primary-800">
                        Lihat semua berita
                        <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>

                @if ($news->count())
                    <div class="grid md:grid-cols-3 gap-6" data-aos="fade-up">
                        @foreach ($news as $index => $article)
                            <article
                                class="bg-white border border-slate-200 rounded-2xl overflow-hidden flex flex-col shadow-sm hover:shadow-lg transition-shadow duration-300">
                                @if ($article->image)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                        class="w-full h-40 object-cover">
                                @else
                                    <div
                                        class="w-full h-40 bg-slate-100 flex items-center justify-center text-slate-400 text-sm">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="p-5 flex flex-col flex-1">
                                    <p class="text-[11px] text-slate-500 mb-1">
                                        {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                                    </p>
                                    <h3 class="text-sm font-semibold mb-2 text-slate-900 line-clamp-2">
                                        <a href="{{ route('news.show', $article->slug) }}"
                                            class="hover:text-emerald-700">
                                            {{ \Illuminate\Support\Str::limit($article->title, 60) }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-slate-600 line-clamp-3 flex-1">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 110) }}
                                    </p>
                                    <a href="{{ route('news.show', $article->slug) }}"
                                        class="mt-3 inline-flex items-center text-xs text-primary hover:text-primary-800">
                                        Baca selengkapnya
                                        <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-600">Belum ada berita yang dipublikasikan.</p>
                @endif
            </div>
        </section>

        {{-- ======================================================
            GALERI
        ======================================================= --}}
        <section id="galeri" class="bg-white py-16">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                            Galeri {{ $villageTitle }}
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Dokumentasi kegiatan dan momen penting desa.
                        </p>
                    </div>
                    <a href="{{ route('gallery') }}"
                        class="inline-flex items-center text-sm text-primary hover:text-primary-800">
                        Lihat semua galeri
                        <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>

                @if ($homepageGalleries->count())
                    <div class="grid md:grid-cols-3 gap-6" data-aos="fade-up">
                        @foreach ($homepageGalleries as $index => $gallery)
                            <div
                                class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 group">
                                <a href="{{ route('gallery.show', $gallery->slug) }}" class="block">
                                    @if ($gallery->cover_image)
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->cover_image) }}"
                                            alt="Sampul {{ $gallery->name }}"
                                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-500">
                                    @elseif ($gallery->images->isNotEmpty())
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->images->first()->path) }}"
                                            alt="Sampul {{ $gallery->name }}"
                                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div
                                            class="w-full h-40 flex items-center justify-center bg-slate-100 text-slate-400 text-sm">
                                            Tidak ada gambar
                                        </div>
                                    @endif

                                    <div class="p-5">
                                        <h4 class="text-sm font-semibold text-slate-900 mb-1">
                                            {{ \Illuminate\Support\Str::limit($gallery->name, 40) }}
                                        </h4>
                                        <p class="text-[11px] text-slate-500 mb-1">
                                            {{ $gallery->images->count() }} foto
                                        </p>
                                        <span
                                            class="inline-flex items-center text-[11px] text-primary group-hover:text-primary-800">
                                            Lihat galeri
                                            <i class="fa-solid fa-arrow-right ml-1 text-[9px]"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-600">Belum ada galeri yang ditampilkan.</p>
                @endif
            </div>
        </section>

        {{-- ======================================================
            CTA BAND
        ======================================================= --}}
        <section class="bg-slate-900 text-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid md:grid-cols-[1.2fr_0.8fr] gap-8 items-center">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-slate-300">Partisipasi Warga</p>
                        <h2 class="text-2xl md:text-3xl font-semibold mt-2">Bangun desa melalui kolaborasi</h2>
                        <p class="text-sm text-slate-300 mt-2">
                            Sampaikan aspirasi, cari informasi layanan, atau ikuti program desa untuk kesejahteraan
                            bersama.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3 md:justify-end">
                        <a href="{{ route('aduan.index') }}"
                            class="inline-flex items-center justify-center px-5 py-3 rounded-full text-sm font-medium bg-emerald-500 hover:bg-emerald-400 text-slate-900 transition-all">
                            Kirim Aspirasi
                            <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                        </a>
                        <a href="{{ route('news') }}"
                            class="inline-flex items-center justify-center px-5 py-3 rounded-full text-sm font-medium border border-slate-500 hover:border-white text-white transition-all">
                            Update Berita Desa
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ======================================================
            KONTAK & LOKASI
        ======================================================= --}}
        <section id="kontak" class="bg-slate-50 py-16 border-t border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-10 items-start">
                <div data-aos="fade-right">
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden h-72 md:h-80 shadow-sm">
                        @if ($googleMapsEmbedUrl)
                            <iframe src="{{ $googleMapsEmbedUrl }}" width="100%" height="100%"
                                style="min-height: 300px; border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" class="rounded-none"></iframe>
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-sm"
                                style="min-height: 300px;">
                                Peta belum diatur atau koordinat tidak valid.
                            </div>
                        @endif
                    </div>
                </div>

                <div data-aos="fade-left" class="space-y-5">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold text-slate-900 mb-2">Kontak & Lokasi</h2>
                        <p class="text-sm text-slate-600">
                            Hubungi kami atau kunjungi kantor desa pada jam operasional.
                        </p>
                    </div>

                    <div class="space-y-4 text-sm text-slate-700">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot mt-1 text-primary"></i>
                            <div>
                                <p class="text-[11px] text-slate-400 uppercase tracking-widest mb-0.5">Alamat</p>
                                <p class="text-sm">
                                    @if ($contactAddress && $contactAddress->content)
                                        {!! $contactAddress->content !!}
                                    @else
                                        Alamat belum diatur.
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-envelope mt-1 text-primary"></i>
                            <div>
                                <p class="text-[11px] text-slate-400 uppercase tracking-widest mb-0.5">Email</p>
                                <p class="text-sm">
                                    @if ($contactEmail && $contactEmail->content)
                                        <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                            class="text-primary hover:underline">
                                            {{ strip_tags($contactEmail->content) }}
                                        </a>
                                    @else
                                        Email belum diatur.
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-phone mt-1 text-primary"></i>
                            <div>
                                <p class="text-[11px] text-slate-400 uppercase tracking-widest mb-0.5">Telepon</p>
                                <p class="text-sm">
                                    @if ($contactPhone && $contactPhone->content)
                                        @php
                                            $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content);
                                        @endphp
                                        <a href="tel:{{ $cleanPhoneNumber }}" class="text-primary hover:underline">
                                            {{ strip_tags($contactPhone->content) }}
                                        </a>
                                    @else
                                        Telepon belum diatur.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        @if (!empty($cleanPhoneNumber))
                            <a href="https://wa.me/{{ ltrim($cleanPhoneNumber, '+') }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 rounded-full bg-emerald-600 hover:bg-emerald-700 text-xs font-medium text-white transition-all shadow">
                                <i class="fa-brands fa-whatsapp mr-2"></i>
                                Hubungi via WhatsApp
                            </a>
                        @endif
                        <a href="#hero"
                            class="inline-flex items-center px-4 py-2 rounded-full border border-slate-300 bg-white text-xs font-medium text-slate-700 hover:bg-slate-50 transition-all">
                            <i class="fa-solid fa-arrow-up mr-2 text-[10px]"></i>
                            Kembali ke atas
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
