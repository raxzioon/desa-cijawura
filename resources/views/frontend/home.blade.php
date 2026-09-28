<x-app-layout>
    {{-- Hero Slider Section --}}
    <div class="relative w-full overflow-hidden h-screen" x-data="{ activeSlide: 0, slides: {{ $sliders->toJson() }} }" x-init="if (slides.length > 1) {
        setInterval(() => {
            activeSlide = (activeSlide + 1) % slides.length;
        }, 5000);
    }">
        {{-- Slides --}}
        @forelse ($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-5000"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat flex items-center justify-center"
                style="background-image: url('{{ Storage::url($slider->image) }}');">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                {{-- description Slides --}}
                <div class="relative z-10 text-center px-4 max-w-2xl mx-auto mt-8 md:mt-16">
                    <h1
                        class="text-3xl md:text-5xl font-extrabold text-white drop-shadow-lg mb-3 md:mb-4 animate-fade-in-down">
                        {{ $slider->title }}
                    </h1>
                    <p class="text-base md:text-lg text-white/90 leading-relaxed animate-fade-in-up">
                        {{ $slider->description }}
                    </p>
                </div>
            </div>
        @empty
            <div class="relative w-full overflow-hidden h-screen flex items-center justify-center">
                <p class="text-gray-600 text-xl">Tidak ada slider aktif yang tersedia.</p>
            </div>
        @endforelse

        {{-- Menu Horizontal Grid Overlay --}}
        <div class="absolute bottom-32 left-0 right-0 z-10 px-6">
            <div class="container mx-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    {{-- Menu Item 1 --}}
                    <a href="{{ route('surat-online.index') }}"
                        class="group flex items-center justify-center p-3 bg-white/20 backdrop-blur-md rounded-lg hover:bg-white/30 transition-all duration-300 shadow-lg hover:shadow-xl border border-white/20">
                        <div class="text-center">
                            <svg class="h-6 w-6 text-white mx-auto mb-1 group-hover:scale-110 transition-transform"
                                fill="none" stroke-width="1.5" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <span class="text-xs font-semibold text-white drop-shadow-sm">Surat Keterangan</span>
                        </div>
                    </a>

                    {{-- Menu Item 2 --}}
                    <a href="{{ route('service-procedures') }}"
                        class="group flex items-center justify-center p-3 bg-white/20 backdrop-blur-md rounded-lg hover:bg-white/30 transition-all duration-300 shadow-lg hover:shadow-xl border border-white/20">
                        <div class="text-center">
                            <svg class="h-6 w-6 text-white mx-auto mb-1 group-hover:scale-110 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="text-xs font-semibold text-white drop-shadow-sm">Prosedur Layanan</span>
                        </div>
                    </a>

                    {{-- Menu Item 3 --}}
                    <a href="{{ route('aduan.index') }}"
                        class="group flex items-center justify-center p-3 bg-white/20 backdrop-blur-md rounded-lg hover:bg-white/30 transition-all duration-300 shadow-lg hover:shadow-xl border border-white/20">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="h-6 w-6 text-white mx-auto mb-1 group-hover:scale-110 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                            </svg>
                            <span class="text-xs font-semibold text-white drop-shadow-sm">Aduan/Laporan</span>
                        </div>
                    </a>

                    {{-- Menu Item 4 --}}
                    <a href="{{ route('data-pembangunan.index') }}"
                        class="group flex items-center justify-center p-3 bg-white/20 backdrop-blur-md rounded-lg hover:bg-white/30 transition-all duration-300 shadow-lg hover:shadow-xl border border-white/20">
                        <div class="text-center">
                            <svg class="h-6 w-6 text-white mx-auto mb-1 group-hover:scale-110 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                            </svg>
                            <span class="text-xs font-semibold text-white drop-shadow-sm">Data Pembangunan</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Dots --}}
        @if ($sliders->count() > 1)
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-3 z-10">
                @foreach ($sliders as $index => $slider)
                    <button @click="activeSlide = {{ $index }}"
                        :class="activeSlide === {{ $index }} ?
                            'w-4 h-4 bg-white shadow-lg scale-110' :
                            'w-3 h-3 bg-gray-400 hover:bg-white/80'"
                        class="rounded-full transition-all duration-300 focus:outline-none"></button>
                @endforeach
            </div>
        @endif

        {{-- Tombol Navigasi --}}
        @if ($sliders->count() > 1)
            <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-10 hidden md:block">
                ❮
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-10 hidden md:block">
                ❯
            </button>
        @endif
    </div>

    <section class="py-20 bg-gradient-to-r from-primary-light/10 via-white to-primary-light/10 backdrop-blur-md">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-accent mb-10 tracking-tight" data-aos="fade-down">
                Data Statistik Desa
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($dataStatistik as $index => $statistik)
                    @php
                        // Tentukan warna border berdasarkan index
                        $borderColors = ['border-primary', 'border-secondary', 'border-accent', 'border-primary'];
                        $textColors = ['text-primary', 'text-secondary', 'text-accent', 'text-primary'];
                        $bgColors = ['bg-primary/10', 'bg-secondary/10', 'bg-accent/10', 'bg-primary/10'];
                        $decorativeColors = ['bg-primary-light', 'bg-secondary-light', 'bg-accent', 'bg-primary-light'];

                        $borderClass = $borderColors[$index % 4];
                        $textClass = $textColors[$index % 4];
                        $bgClass = $bgColors[$index % 4];
                        $decorativeClass = $decorativeColors[$index % 4];
                    @endphp

                    <a href=""
                        class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 transition-all duration-300 border-t-4 {{ $borderClass }} hover:-translate-y-1"
                        data-aos="zoom-in" data-aos-delay="{{ 200 + $index * 100 }}">
                        <div class="p-6">
                            <!-- Floating Icon -->
                            <div
                                class="absolute top-6 right-6 w-16 h-16 flex items-center justify-center {{ $textClass }} opacity-20 group-hover:opacity-40 group-hover:scale-110 transition-all duration-700">
                                @if ($statistik->icon)
                                    <i class="{{ $statistik->icon }} text-4xl"></i>
                                @else
                                    {{-- Default SVG Icon --}}
                                    <svg class="h-full w-full" fill="currentColor" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>

                            {{-- Main Content --}}
                            <div class="relative">
                                <div
                                    class="inline-flex items-center px-3 py-1 rounded-full {{ $bgClass }} {{ $textClass }} text-xs font-medium">
                                    @if ($statistik->icon)
                                        <i class="{{ $statistik->icon }} mr-1.5"></i>
                                    @else
                                        <svg class="h-4 w-4 mr-1.5" viewBox="0 0 24 24" fill="{{ $statistik->icon }}">
                                            <path fill-rule="evenodd"
                                                d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                    <span>{{ $statistik->nama_statistik }}</span>
                                </div>

                                <h3
                                    class="text-2xl font-bold text-gray-800 tracking-tight group-hover:{{ $textClass }} transition-colors duration-300">
                                    {{ $statistik->formatted_jumlah }}
                                    <span
                                        class="text-sm font-normal {{ $textClass }} ml-1">{{ $statistik->satuan }}</span>
                                </h3>

                                <p
                                    class="text-sm text-gray-500 mt-2 group-hover:text-gray-700 transition-colors duration-300">
                                    {{ $statistik->deskripsi ?? 'Jumlah ' . $statistik->nama_statistik }}
                                </p>
                                <!-- Decorative Element -->
                                <div
                                    class="w-12 h-1 {{ $decorativeClass }} rounded-full mt-4 group-hover:w-20 transition-all duration-500">
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- Fallback jika tidak ada data statistik --}}
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Data statistik belum tersedia. Silakan tambahkan melalui panel admin.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-gray-900" x-data="{ activeTab: 'sambutan' }">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Tab Navigation -->
            <div class="flex justify-center mb-8">
                <div class="flex bg-gray-100 dark:bg-gray-800 rounded-full p-1">
                    <button @click="activeTab = 'sambutan'"
                        :class="activeTab === 'sambutan' ? 'bg-primary text-white shadow-md' :
                            'text-gray-600 dark:text-gray-300 hover:text-primary'"
                        class="px-6 py-2 rounded-full font-medium transition-all duration-300 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <span>Sambutan</span>
                    </button>
                    <button @click="activeTab = 'program'"
                        :class="activeTab === 'program' ? 'bg-primary text-white shadow-md' :
                            'text-gray-600 dark:text-gray-300 hover:text-primary'"
                        class="px-6 py-2 rounded-full font-medium transition-all duration-300 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        <span>Program Desa</span>
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="relative">
                <!-- Sambutan Tab -->
                <div x-show="activeTab === 'sambutan'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4">

                    <div class="flex flex-col lg:flex-row items-center gap-12">
                        <!-- Profile Image -->
                        <div class="flex-shrink-0">
                            <div class="relative">
                                <div
                                    class="w-48 h-48 rounded-full overflow-hidden shadow-2xl border-4 border-primary/20">
                                    @php
                                        $avatarKepalaDesa = $avatarKepalaDesa->content ?? 'images/logo.png';
                                    @endphp
                                    <img src="{{ asset('storage/' . $avatarKepalaDesa) }}" alt="Avatar Kepala Desa"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                            <!-- Profile Info -->
                            <div class="text-center mt-6">
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                                    {{ $namaKepalaDesa->content ?? 'Bp. Kades' }}</h3>
                                <p class="text-primary font-semibold">Kepala Desa</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $periodeKepalaDesa->content ?? '2025 - 2029' }}</p>
                            </div>
                        </div>

                        <!-- Welcome Content -->
                        <div class="flex-1 text-left">
                            <div
                                class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed space-y-4">
                                {!! $sekilasDesa->content ??
                                    '<p>Puji syukur kita panjatkan kehadirat Allah SWT, karena atas berkat dan rahmat-Nya kita masih diberikan kesehatan dan kesempatan untuk menjalankan tugas sebagai pelayan masyarakat di Desa.</p>                                                                                                                                                                                                                                                                                                                                                            <p>Mari bersama-sama kita bangun Desa Kedungwungu yang lebih baik, maju, dan sejahtera. Dengan kerjasama dan gotong royong, tidak ada yang tidak mungkin untuk kita wujudkan.</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Program Desa -->
                <div x-show="activeTab === 'program'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-4">

                    <div class="text-center mb-8">
                        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                            Program yang menjadi fokus pembangunan dan pengembangan desa untuk mewujudkan kesejahteraan
                            masyarakat
                        </p>
                    </div>

                    <!-- Program Tabs -->
                    <div class="flex justify-center mb-8" x-data="{ programTab: 'prioritas' }">
                        <!-- Program Content -->
                        <div class="w-full mt-8">
                            <!-- Program Prioritas -->
                            <div x-show="programTab === 'prioritas'" class="max-w-4xl mx-auto">
                                <div class="space-y-6">
                                    @forelse ($programDesa as $index => $program)
                                        <div
                                            class="flex items-start space-x-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold text-sm">
                                                {{ $program->urutan }}</div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                                                    {{ $program->name }}</h4>
                                                <p class="text-gray-600 dark:text-gray-300"> {{ $program->deskripsi }}
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <div
                                            class="relative w-full overflow-hidden h-screen flex items-center justify-center">
                                            <p class="text-gray-600 text-xl">Tidak ada program desa yang tersedia.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="berita-terbaru" class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-accent">Berita Terbaru</h2>
                <div class="w-24 h-1 mx-auto bg-[--color-primary-dark]"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($news as $index => $article)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition hover:shadow-lg duration-300"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">

                        @if ($article->image)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-[--color-primary] hover:opacity-80">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                Oleh {{ $article->author ?? 'Admin' }} pada
                                {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('news.show', $article->slug) }}"
                                class="inline-block bg-[--color-primary] text-white font-bold py-2 px-4 rounded-md text-sm hover:bg-[--color-primary-dark] transition">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-300">
                        Belum ada berita terbaru yang dipublikasikan.
                    </p>
                @endforelse
            </div>

            @if ($news->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('news') }}"
                        class="inline-block text-white text-sm bg-[--color-primary] font-bold py-3 px-8 rounded-full transition duration-300 hover:bg-[--color-primary-dark]">
                        Lihat Semua Berita
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section id="potensi" class="py-20 bg-[--color-soft-gray]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-accent border-accent inline-block pb-2">
                    Potensi {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <div class="w-24 h-1 mx-auto bg-[--color-primary-dark] mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($potentials as $index => $potential)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105 duration-500"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                        @if ($potential->image)
                            <img src="{{ Storage::url($potential->image) }}" alt="{{ $potential->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[--color-dark-text] mb-3">{{ $potential->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">{!! Str::limit($potential->description, 100) !!}</p>
                            <a href="{{ route('potentials') }}"
                                class="font-medium inline-flex items-center text-[--color-primary-dark] hover:underline">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada potensi desa yang ditambahkan.</p>
                @endforelse
            </div>

            @if ($potentials->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('potentials') }}"
                        class="inline-block text-white bg-[--color-primary] font-bold py-3 px-8 rounded-full transition duration-300 hover:bg-[--color-primary-dark]">
                        Lihat Semua Potensi
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section id="galeri" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-extrabold text-accent dark:text-white mb-2">
                    Galeri {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <p class="text-gray-500 dark:text-gray-300 text-sm">Dokumentasi kegiatan dan potret desa kami</p>
                <div class="mt-4 w-16 h-1 mx-auto bg-accent"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @php
                    $homepageGalleries = App\Models\Gallery::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->with('images')
                        ->get();
                @endphp

                @forelse ($homepageGalleries as $index => $gallery)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                        data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
                        <a href="{{ route('gallery.show', $gallery->slug) }}" class="block group">
                            @if ($gallery->cover_image)
                                <img src="{{ Storage::url($gallery->cover_image) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif ($gallery->images->isNotEmpty())
                                <img src="{{ Storage::url($gallery->images->first()->path) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-64 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                    No Image
                                </div>
                            @endif

                            <div class="p-5">
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-1">
                                    {{ Str::limit($gallery->name, 40) }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                    {{ $gallery->images->count() }} Foto
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        Belum ada album galeri yang dipublikasikan.
                    </p>
                @endforelse
            </div>

            @if ($homepageGalleries->count() > 0)
                <div class="text-center mt-14">
                    <a href="{{ route('gallery') }}"
                        class="inline-block bg-primary text-white font-semibold py-3 px-10 rounded-full shadow-md hover:bg-primary-dark active:bg-primary-darker transition">
                        Lihat Semua Galeri
                    </a>

                </div>
            @endif
        </div>
    </section>

    <section id="lokasi" class="py-20 bg-soft-gray">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold text-accent mb-4">Lokasi Kantor Desa</h2>
                <div class="w-24 h-1 bg-accent mx-auto"></div>
            </div>
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="lg:w-full" data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-dark-text mb-4">Informasi Kontak & Lokasi</h3>
                        <div class="aspect-w-16 aspect-h-9 mb-6">
                            {{-- Menggunakan string URL Google Maps dinamis --}}
                            @if ($googleMapsEmbedUrl)
                                {{-- Cukup cek apakah string URLnya tidak null --}}
                                <iframe src="{{ $googleMapsEmbedUrl }}" width="100%" height="100%"
                                    {{-- Langsung pakai variabel --}} style="min-height: 300px;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg">
                                </iframe>
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg"
                                    style="min-height: 300px;">
                                    Peta belum diatur atau koordinat tidak valid.
                                </div>
                            @endif
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-700">
                                    @if ($contactAddress && $contactAddress->content)
                                        {!! $contactAddress->content !!}
                                    @else
                                        Alamat belum diatur.
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-700">
                                    @if ($contactEmail && $contactEmail->content)
                                        <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                            class="text-desa-skyblue hover:underline">{{ strip_tags($contactEmail->content) }}</a>
                                    @else
                                        Email belum diatur.
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-gray-700">
                                    @if ($contactPhone && $contactPhone->content)
                                        @php $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content); @endphp
                                        <a href="tel:{{ $cleanPhoneNumber }}"
                                            class="text-desa-skyblue hover:underline">{{ strip_tags($contactPhone->content) }}</a>
                                    @else
                                        Telepon belum diatur.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>