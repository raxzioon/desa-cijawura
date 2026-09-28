<x-app-layout>

    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-green-500 to-green-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Aduan Masyarakat</h1>
            <p class="text-lg mb-8 max-w-3xl mx-auto">
                Sampaikan aspirasi dan pengaduan Anda untuk desa yang lebih baik
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#form-pengajuan"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition">
                    BUAT ADUAN
                </a>
                <a href="#lacak-aduan"
                    class="border-2 border-white hover:bg-white hover:text-green-700 font-bold py-3 px-6 rounded-lg transition">
                    LACAK ADUAN
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Tentang Layanan Section --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Tentang Layanan Aduan Masyarakat</h2>
                <div class="w-24 h-1 bg-green-500 mx-auto mb-6"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Merupakan platform pengaduan masyarakat online yang dikembangkan oleh Pemerintah Desa untuk
                        memfasilitasi warga dalam menyampaikan aspirasi, laporan, dan pengaduan terkait
                        pelayanan publik dan pembangunan desa.
                    </p>

                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Kami berkomitmen untuk menjembatani komunikasi antara masyarakat dan pemerintah desa secara
                        efektif, transparan, dan dapat dipertanggungjawabkan dalam rangka meningkatkan kualitas
                        pelayanan publik dan pembangunan desa yang partisipatif.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-green-600 mb-4">Manfaat Sistem Pengaduan</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Mempercepat penanganan masalah dan keluhan masyarakat</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Meningkatkan transparansi dan akuntabilitas pemerintah
                                desa</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Memberikan ruang partisipasi masyarakat dalam pembangunan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Mempermudah pelaporan tanpa harus datang ke kantor desa</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Membantu mengidentifikasi dan memetakan permasalahan desa</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Meningkatkan kualitas pelayanan publik</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Membangun komunikasi dua arah antara warga dan pemerintah
                                desa</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Layanan Aduan yang Tersedia --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Kategori Pengaduan Layanan Aduan yang Tersedia</h2>
                <div class="w-24 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach (\App\Models\Aduan::getJenisAduan() as $key)
                    <div class="bg-white p-6 rounded-lg shadow-md border hover:shadow-lg transition">
                        <div class="text-center mb-4">
                            <div
                                class="bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                @if ($key['icon'])
                                    <i class="{{ $key['icon'] }} text-4xl"></i>
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
                            <h3 class="text-lg font-semibold text-dark-text">{{ $key['title'] }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm text-center leading-relaxed">
                            {{ $key['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Proses Pengajuan Aduan --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Proses Aduan</h2>
                <div class="w-24 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="relative overflow-x-auto">
                <div class="flex items-center justify-between min-w-max px-8">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            1
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Buat Pengaduan</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">si formulir pengaduan dengan lengkap dan
                            jelas, sertakan foto pendukung jika ada</p>
                    </div>

                    <!-- Connector Line 1-2 -->
                    <div class="flex-1 h-0.5 bg-green-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            2
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Verifikasi</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Admin akan memverifikasi pengaduan Anda
                            dalam 1x24 jam
                        </p>
                    </div>

                    <!-- Connector Line 2-3 -->
                    <div class="flex-1 h-0.5 bg-green-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            3
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Penelusuran</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Tim desa akan melakukan penelusuran dan
                            investigasi terkait pengaduan</p>
                    </div>

                    <!-- Connector Line 3-4 -->
                    <div class="flex-1 h-0.5 bg-green-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 4 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            4
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Tindak Lanjut</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Pengaduan ditindaklanjuti oleh bagian atau
                            pihak terkait</p>
                    </div>

                    <!-- Connector Line 4-5 -->
                    <div class="flex-1 h-0.5 bg-green-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 5 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            5
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Penyelesaian</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Penyelesaian masalah dan respon final akan
                            diberikan kepada pelapor</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Pelacakan Status Aduan --}}
        <section id="lacak-aduan" class="mb-16 bg-gray-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-12"
            data-aos="fade-up">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-dark-text mb-4">Pelacakan Status Aduan</h2>
                    <div class="w-24 h-1 bg-green-500 mx-auto mb-6"></div>
                    <p class="text-gray-600">
                        Masukkan Nomor Aduan yang telah diajukan untuk melihat status penanganan
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('aduan.search-status') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                            <div>
                                <label for="track_nomor" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                    Aduan</label>
                                <input type="text" name="nomor_aduan" id="track_nomor" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-md transition">
                            LACAK ADUAN
                        </button>
                    </form>
                </div>
            </div>
        </section>

        {{-- Form Pengajuan Aduan --}}
        <section id="form-pengajuan" class="mb-16" data-aos="fade-up">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Sampaikan Pengaduan Anda</h2>
                <div class="w-24 h-1 bg-green-500 mx-auto"></div>
            </div>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <strong class="font-bold">Terjadi kesalahan!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-8">
                <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Data Pemohon --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Pelapor</h3>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    required placeholder="Masukkan nama lengkap sesuai KTP"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk
                                    Kependudukan <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                    required maxlength="20" placeholder="16 digit NIK"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No.
                                    Telepon/WhatsApp</label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                    maxlength="15" placeholder="Contoh: 081234567890"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" rows="4" required
                                    placeholder="Jl. contoh No. 123, RT/RW, Kelurahan, Kecamatan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('alamat') }}</textarea>
                            </div>
                        </div>

                        {{-- Data Aduan --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Aduan</h3>

                            <div>
                                <label for="jenis_aduan" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                    Aduan <span class="text-red-500">*</span></label>
                                <select name="jenis_aduan" id="jenis_aduan" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <option value="">Pilih Jenis Aduan</option>
                                    @foreach (\App\Models\Aduan::getJenisAduanOptions() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('jenis_aduan') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="isi_aduan" class="block text-sm font-medium text-gray-700 mb-1">Isi Aduan
                                    <span class="text-red-500">*</span></label>
                                <textarea name="isi_aduan" id="isi_aduan" rows="4" required
                                    placeholder="Jelaskan secara detail aduan yang akan dibuat..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('isi_aduan') }}</textarea>
                            </div>

                            <div>
                                <label for="lokasi_kejadian"
                                    class="block text-sm font-medium text-gray-700 mb-1">Lokasi Kejadian <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian"
                                    value="{{ old('lokasi_kejadian') }}" required
                                    placeholder="Masukkan lokasi kejadian/pengaduan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="lampiran_pendukung"
                                    class="block text-sm font-medium text-gray-700 mb-1">Lampiran Pendukung</label>
                                <input type="file" name="lampiran_pendukung" id="lampiran_pendukung"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Maksimal: 2MB</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm text-green-800 font-medium mb-2">Catatan Penting:</p>
                                <ul class="text-xs text-green-700 space-y-1">
                                    <li>• Pastikan data yang dimasukkan benar, lengkap dan jelas</li>
                                    <li>• Aduan akan ditindak lanjuti 1x24 jam</li>
                                    <li>• Anda akan dihubungi melalui nomor telepon terkait aduan yang sudah di tindak
                                        lanjut</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center flex flex-col items-center justify-center space-y-4">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        @if($errors->has('g-recaptcha-response'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('g-recaptcha-response') }}</div>
                        @endif
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                            KIRIM ADUAN
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    
    <!-- Tambahkan skrip reCAPTCHA di sini -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</x-app-layout>
