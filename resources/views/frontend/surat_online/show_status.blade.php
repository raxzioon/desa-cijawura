<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Header Section --}}
        <div class="text-center mb-8" data-aos="fade-up">
            <h1 class="text-3xl font-bold text-dark-text mb-4">Detail Status Surat</h1>
            <div class="w-24 h-1 bg-blue-500 mx-auto mb-6"></div>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" data-aos="fade-up">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Navigation Buttons --}}
        <div class="flex flex-wrap justify-center gap-4 mb-8" data-aos="fade-up">
            <a href="{{ route('surat-online.index') }}#lacak-surat"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari Surat Lain
            </a>
            <a href="{{ route('surat-online.index') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Ajukan Surat Baru
            </a>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up">

            {{-- Header Card --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">
                            {{ \App\Models\SuratOnline::getJenisSuratOptions()[$suratOnline->jenis_surat] ?? $suratOnline->jenis_surat }}
                        </h2>
                        <p class="text-blue-100">Pemohon: {{ $suratOnline->nama }}</p>
                        <p class="text-blue-100">NIK: {{ $suratOnline->nik }}</p>
                    </div>
                    <div class="text-center lg:text-right">
                        <span class="inline-flex px-4 py-2 text-sm font-bold rounded-full bg-white text-gray-800">
                            {{ \App\Models\SuratOnline::getStatusOptions()[$suratOnline->status] ?? $suratOnline->status }}
                        </span>
                        @if ($suratOnline->nomor_surat)
                            <p class="text-blue-100 mt-2 text-sm">No. Surat: {{ $suratOnline->nomor_surat }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6">
                {{-- Status Progress --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-dark-text mb-4">Progress Pengajuan</h3>
                    <div class="relative">
                        <div class="flex items-center justify-between relative z-10">
                            {{-- Step 1: Pengajuan --}}
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold mb-2">
                                    1</div>
                                <span class="text-xs font-medium text-blue-600">Pengajuan</span>
                                <span
                                    class="text-xs text-gray-500">{{ $suratOnline->created_at->format('d/m/y') }}</span>
                            </div>

                            {{-- Step 2: Verifikasi --}}
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-8 h-8 rounded-full {{ in_array($suratOnline->status, ['diproses', 'selesai']) ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center text-sm font-bold mb-2">
                                    2</div>
                                <span
                                    class="text-xs font-medium {{ in_array($suratOnline->status, ['diproses', 'selesai']) ? 'text-blue-600' : 'text-gray-500' }}">Verifikasi</span>
                                @if (in_array($suratOnline->status, ['diproses', 'selesai']))
                                    <span
                                        class="text-xs text-gray-500">{{ $suratOnline->updated_at->format('d/m/y') }}</span>
                                @endif
                            </div>

                            {{-- Step 3: Proses --}}
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-8 h-8 rounded-full {{ in_array($suratOnline->status, ['diproses', 'selesai']) ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center text-sm font-bold mb-2">
                                    3</div>
                                <span
                                    class="text-xs font-medium {{ in_array($suratOnline->status, ['diproses', 'selesai']) ? 'text-blue-600' : 'text-gray-500' }}">Proses</span>
                                @if ($suratOnline->status == 'diproses')
                                    <span class="text-xs text-blue-500">Sedang berlangsung</span>
                                @endif
                            </div>

                            {{-- Step 4: Selesai --}}
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-8 h-8 rounded-full {{ $suratOnline->status == 'selesai' ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-600' }} flex items-center justify-center text-sm font-bold mb-2">
                                    4</div>
                                <span
                                    class="text-xs font-medium {{ $suratOnline->status == 'selesai' ? 'text-green-600' : 'text-gray-500' }}">Selesai</span>
                                @if ($suratOnline->tanggal_selesai)
                                    <span
                                        class="text-xs text-gray-500">{{ $suratOnline->tanggal_selesai->format('d/m/y') }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Progress Line --}}
                        <div class="absolute top-4 left-4 right-4 h-0.5 bg-gray-300 -z-0"></div>
                        <div class="absolute top-4 left-4 h-0.5 bg-blue-500 transition-all duration-500 -z-0"
                            style="width: {{ $suratOnline->status == 'pending' ? '0%' : ($suratOnline->status == 'diproses' ? '66%' : ($suratOnline->status == 'selesai' ? '100%' : '33%')) }}">
                        </div>
                    </div>
                </div>

                {{-- Detail Information --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    {{-- Data Pemohon --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Pemohon</h3>

                        <div class="space-y-3">
                            <div class="flex flex-col sm:flex-row">
                                <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">Nama:</span>
                                <span class="text-gray-600">{{ $suratOnline->nama }}</span>
                            </div>

                            <div class="flex flex-col sm:flex-row">
                                <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">NIK:</span>
                                <span class="text-gray-600">{{ $suratOnline->nik }}</span>
                            </div>

                            @if ($suratOnline->email)
                                <div class="flex flex-col sm:flex-row">
                                    <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">Email:</span>
                                    <span class="text-gray-600">{{ $suratOnline->email }}</span>
                                </div>
                            @endif

                            @if ($suratOnline->no_hp)
                                <div class="flex flex-col sm:flex-row">
                                    <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">No. HP:</span>
                                    <span class="text-gray-600">{{ $suratOnline->no_hp }}</span>
                                </div>
                            @endif

                            <div class="flex flex-col">
                                <span class="font-medium text-gray-700 mb-2">Alamat:</span>
                                <span
                                    class="text-gray-600 pl-4 bg-gray-50 p-3 rounded">{{ $suratOnline->alamat }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Data Surat --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-dark-text border-b pb-2">Data Surat</h3>

                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-700 mb-2">Jenis Surat:</span>
                                <span class="text-gray-600 pl-4">
                                    {{ \App\Models\SuratOnline::getJenisSuratOptions()[$suratOnline->jenis_surat] ?? $suratOnline->jenis_surat }}
                                </span>
                            </div>

                            <div class="flex flex-col">
                                <span class="font-medium text-gray-700 mb-2">Keperluan:</span>
                                <div class="text-gray-600 pl-4 bg-gray-50 p-3 rounded">
                                    {{ $suratOnline->keperluan }}
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row">
                                <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">Status:</span>
                                <span
                                    class="inline-flex px-2 text-xs font-semibold rounded-full {{ $suratOnline->getStatusBadgeClass() }} w-fit">
                                    {{ \App\Models\SuratOnline::getStatusOptions()[$suratOnline->status] ?? $suratOnline->status }}
                                </span>
                            </div>

                            @if ($suratOnline->nomor_surat)
                                <div class="flex flex-col sm:flex-row">
                                    <span class="font-medium text-gray-700 w-32 mb-1 sm:mb-0">No. Surat:</span>
                                    <span class="text-gray-600 font-mono">{{ $suratOnline->nomor_surat }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- File Persyaratan --}}
                        @if ($suratOnline->file_persyaratan)
                            <div class="pt-4 border-t">
                                <span class="font-medium text-gray-700 block mb-2">File Persyaratan:</span>
                                <a href="{{ asset('storage/' . $suratOnline->file_persyaratan) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                    Lihat File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Catatan Admin --}}
                @if ($suratOnline->catatan_admin)
                    <div class="mt-8 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                        <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Catatan dari Admin
                        </h4>
                        <p class="text-yellow-700">{{ $suratOnline->catatan_admin }}</p>
                    </div>
                @endif

                {{-- Timeline --}}
                <div class="mt-8 pt-6 border-t">
                    <h3 class="text-lg font-semibold text-dark-text mb-4">Timeline Pengajuan</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700">Pengajuan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $suratOnline->created_at->format('d M Y H:i:s') }}
                                    WIB</p>
                            </div>
                        </div>

                        @if ($suratOnline->updated_at != $suratOnline->created_at)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">Status Terakhir Diperbarui</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $suratOnline->updated_at->format('d M Y H:i:s') }} WIB</p>
                                </div>
                            </div>
                        @endif

                        @if ($suratOnline->tanggal_selesai)
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-700">Surat Selesai</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $suratOnline->tanggal_selesai->format('d M Y H:i:s') }} WIB</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


                {{-- Contact Information --}}
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    @php
                        $contactEmail = App\Models\ProfileContent::where('key', 'contact_email')->first();
                        $contactPhone = App\Models\ProfileContent::where('key', 'contact_phone')->first();
                        $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
                    @endphp
                    <h4 class="font-semibold text-blue-800 mb-3">Butuh Bantuan?</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-blue-700">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            @if ($contactEmail && $contactEmail->content)
                                <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                    class="hover:text-primary-dark underline">
                                    {{ strip_tags($contactEmail->content) }}
                                </a>
                            @else
                                Email belum diatur.
                            @endif
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                </path>
                            </svg>
                            @if ($contactPhone && $contactPhone->content)
                                <a href="tel:{{ $cleanPhoneNumber }}" class="hover:text-primary-dark underline">
                                    {{ strip_tags($contactPhone->content) }}
                                </a>
                            @else
                                Telepon belum diatur.
                            @endif
                        </div>
                    </div>
                    <p class="text-xs text-blue-600 mt-2">Jam kerja: Senin-Jumat 08:00-16:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
