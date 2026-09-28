<x-app-layout>

    {{-- Hero Section --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Surat Online</h1>
            <p class="text-lg mb-8 max-w-3xl mx-auto">
                Permudah proses pengajuan surat menyurat dengan sistem online yang mudah dan cepat untuk berbagai
                kebutuhan administratif
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#form-pengajuan"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-6 rounded-lg transition">
                    AJUKAN SURAT
                </a>
                <a href="#lacak-surat"
                    class="border-2 border-white hover:bg-white hover:text-blue-700 font-bold py-3 px-6 rounded-lg transition">
                    LACAK SURAT
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Tentang Layanan Section --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Tentang Layanan Surat Online</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto mb-6"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Layanan Surat Online kami memungkinkan warga desa untuk mengajukan berbagai jenis surat
                        dengan mudah tanpa harus datang ke kantor desa. Sistem ini dirancang untuk memberikan kemudahan
                        dan kecepatan dalam proses administrasi desa.
                    </p>

                    <p class="text-gray-700 mb-6 leading-relaxed">
                        Dengan menggunakan platform digital yang aman dan terpercaya, Anda dapat mengajukan surat
                        kapan saja dan di mana saja, serta memantau status pengajuan Anda secara real-time.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Keunggulan Layanan</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Mudah diakses 24/7 dari rumah atau kantor Anda</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Proses pengajuan yang cepat dan efisien</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Tracking status surat secara real-time</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Mengurangi antrian dan waktu tunggu</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Dokumentasi digital yang aman dan tersimpan rapi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3">✓</span>
                            <span class="text-gray-700">Transparansi proses administrasi desa</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Layanan Surat yang Tersedia --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Layanan Surat yang Tersedia</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach (\App\Models\SuratOnline::getJenisSurat() as $key)
                    <div class="bg-white p-6 rounded-lg shadow-md border hover:shadow-lg transition">
                        <div class="text-center mb-4">
                            <div
                                class="bg-blue-100 text-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
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
                        <a href="{{ route('service-procedures.show', $key['slug']) }}"
                            class="block text-desa-skyblue text-center hover:underline mt-2">Persyaratan Lengkap
                            &rarr;</a>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Proses Pengajuan Surat --}}
        <section class="mb-16" data-aos="fade-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Proses Pengajuan Surat</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
            </div>

            <div class="relative overflow-x-auto">
                <div class="flex items-center justify-between min-w-max px-8">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-blue-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            1
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Isi Formulir</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Lengkapi formulir pengajuan dengan data
                            yang benar</p>
                    </div>

                    <!-- Connector Line 1-2 -->
                    <div class="flex-1 h-0.5 bg-blue-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-blue-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            2
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Upload Dokumen</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Unggah file persyaratan yang diperlukan
                        </p>
                    </div>

                    <!-- Connector Line 2-3 -->
                    <div class="flex-1 h-0.5 bg-blue-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-blue-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            3
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Verifikasi</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Admin akan memverifikasi dan memproses
                            pengajuan Anda</p>
                    </div>

                    <!-- Connector Line 3-4 -->
                    <div class="flex-1 h-0.5 bg-blue-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 4 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-blue-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            4
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Proses Surat</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Surat akan diproses oleh perangkat desa
                            yang berwenang</p>
                    </div>

                    <!-- Connector Line 4-5 -->
                    <div class="flex-1 h-0.5 bg-blue-300 mx-4 relative top-[-60px]"></div>

                    <!-- Step 5 -->
                    <div class="flex flex-col items-center relative">
                        <div
                            class="bg-blue-500 text-white w-16 h-16 rounded-full flex items-center justify-center mb-4 text-xl font-bold z-10 relative">
                            5
                        </div>
                        <h3 class="font-semibold text-dark-text mb-2 text-center">Pengambilan</h3>
                        <p class="text-gray-600 text-sm text-center max-w-32">Anda akan dihubungi untuk pengambilan
                            surat yang sudah jadi</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Pelacakan Status Surat --}}
        <section id="lacak-surat" class="mb-16 bg-gray-50 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-12"
            data-aos="fade-up">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-dark-text mb-4">Pelacakan Status Surat</h2>
                    <div class="w-24 h-1 bg-blue-500 mx-auto mb-6"></div>
                    <p class="text-gray-600">
                        Masukkan data Surat yang telah diajukan untuk memastikan status surat yang telah Anda ajukan
                        sebelumnya
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('surat-online.search-status') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="track_nik" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                    Induk
                                    Kependudukan</label>
                                <input type="text" name="nik" id="track_nik" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="track_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Lengkap (Sesuai KTP)</label>
                                <input type="text" name="nama" id="track_nama" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-md transition">
                            CEK STATUS
                        </button>
                    </form>
                </div>
            </div>
        </section>

        {{-- Form Pengajuan Surat --}}
        <section id="form-pengajuan" class="mb-16" data-aos="fade-up">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-dark-text mb-4">Formulir Pengajuan Surat</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
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
                <form action="{{ route('surat-online.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Data Pemohon --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Pemohon</h3>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    required placeholder="Masukkan nama lengkap sesuai KTP"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk
                                    Kependudukan <span class="text-red-500">*</span></label>
                                <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                    required maxlength="20" placeholder="16 digit NIK"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No.
                                    Telepon/WhatsApp</label>
                                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                    maxlength="15" placeholder="Contoh: 081234567890"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" rows="4" required
                                    placeholder="Jl. contoh No. 123, RT/RW, Kelurahan, Kecamatan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat') }}</textarea>
                            </div>
                        </div>

                        {{-- Data Surat --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Surat</h3>

                            <div>
                                <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                    Surat <span class="text-red-500">*</span></label>
                                <select name="jenis_surat" id="jenis_surat" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Jenis Surat</option>
                                    @foreach (\App\Models\SuratOnline::getJenisSuratOptions() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('jenis_surat') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-1">Keperluan
                                    <span class="text-red-500">*</span></label>
                                <textarea name="keperluan" id="keperluan" rows="4" required
                                    placeholder="Jelaskan keperluan surat yang akan dibuat..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('keperluan') }}</textarea>
                            </div>

                            <div>
                                <label for="file_persyaratan"
                                    class="block text-sm font-medium text-gray-700 mb-1">File Persyaratan</label>
                                <input type="file" name="file_persyaratan" id="file_persyaratan"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Maksimal: 2MB</p>
                            </div>

                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm text-blue-800 font-medium mb-2">Catatan Penting:</p>
                                <ul class="text-xs text-blue-700 space-y-1">
                                    <li>• Pastikan data yang dimasukkan benar dan sesuai dengan dokumen resmi</li>
                                    <li>• Surat akan diproses dalam waktu 1-3 hari kerja</li>
                                    <li>• Anda akan dihubungi melalui nomor telepon yang tercantum</li>
                                    <li>• Biaya administrasi sesuai dengan ketentuan yang berlaku</li>
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
                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                            KIRIM PENGAJUAN SURAT
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <!-- Tambahkan skrip reCAPTCHA di sini -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</x-app-layout>
