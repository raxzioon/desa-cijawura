<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Header Section --}}
        <div class="text-center mb-8" data-aos="fade-up">
            <h1 class="text-3xl font-bold text-dark-text mb-4">Hasil Pencarian Status Surat</h1>
            <div class="w-24 h-1 bg-blue-500 mx-auto mb-6"></div>
            <p class="text-gray-600">Ditemukan {{ $suratList->count() }} pengajuan surat</p>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" data-aos="fade-up">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" data-aos="fade-up">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Search Again Button --}}
        <div class="text-center mb-8" data-aos="fade-up">
            <a href="{{ route('surat-online.index') }}#lacak-surat"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari Surat Lain
            </a>
        </div>

        {{-- Surat List --}}
        <div class="space-y-6">
            @foreach ($suratList as $surat)
                <div class="bg-white rounded-lg shadow-md border hover:shadow-lg transition p-6" data-aos="fade-up"
                    data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">

                        {{-- Surat Info --}}
                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-3">
                                <h3 class="text-xl font-bold text-dark-text">
                                    {{ \App\Models\SuratOnline::getJenisSuratOptions()[$surat->jenis_surat] ?? $surat->jenis_surat }}
                                </h3>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $surat->getStatusBadgeClass() }} w-fit">
                                    {{ \App\Models\SuratOnline::getStatusOptions()[$surat->status] ?? $surat->status }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-sm">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">Nama Pemohon:</span>
                                    <span class="text-gray-600">{{ $surat->nama }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-700">Tanggal Pengajuan:</span>
                                    <span class="text-gray-600">{{ $surat->created_at->format('d M Y H:i') }}</span>
                                </div>
                                @if ($surat->nomor_surat)
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700">Nomor Surat:</span>
                                        <span class="text-gray-600">{{ $surat->nomor_surat }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Keperluan --}}
                            <div class="mt-3">
                                <span class="font-medium text-gray-700 block mb-1">Keperluan:</span>
                                <p class="text-gray-600 text-sm">{{ Str::limit($surat->keperluan, 150) }}</p>
                            </div>

                            {{-- Catatan Admin --}}
                            @if ($surat->catatan_admin)
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <span class="font-medium text-yellow-800 block mb-1">Catatan Admin:</span>
                                    <p class="text-yellow-700 text-sm">{{ $surat->catatan_admin }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- Action Button --}}
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('surat-online.status', $surat->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Detail
                            </a>
                        </div>
                    </div>

                    {{-- Timeline Progress --}}
                    <div class="mt-6 pt-4 border-t">
                        <div class="flex items-center space-x-4 text-xs">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-gray-600">Diajukan:
                                    {{ $surat->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            @if ($surat->updated_at != $surat->created_at)
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <span class="text-gray-600">Update:
                                        {{ $surat->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif

                            @if ($surat->tanggal_selesai)
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    <span class="text-gray-600">Selesai:
                                        {{ $surat->tanggal_selesai->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Information Section --}}
        <div class="mt-12 bg-gray-50 rounded-lg p-6" data-aos="fade-up">
            <h3 class="text-lg font-bold text-dark-text mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                Informasi Penting
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Status Surat:</h4>
                    <ul class="space-y-1 text-gray-600">
                        <li><span
                                class="inline-flex w-3 h-3 bg-yellow-400 rounded-full mr-2"></span><strong>Menunggu:</strong>
                            Pengajuan sedang diverifikasi</li>
                        <li><span
                                class="inline-flex w-3 h-3 bg-blue-400 rounded-full mr-2"></span><strong>Diproses:</strong>
                            Surat sedang dibuat</li>
                        <li><span
                                class="inline-flex w-3 h-3 bg-green-400 rounded-full mr-2"></span><strong>Selesai:</strong>
                            Surat siap diambil</li>
                        <li><span
                                class="inline-flex w-3 h-3 bg-red-400 rounded-full mr-2"></span><strong>Ditolak:</strong>
                            Pengajuan tidak dapat diproses</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Kontak:</h4>
                    <ul class="space-y-1 text-gray-600">
                        @php
                            $contactEmail = App\Models\ProfileContent::where('key', 'contact_email')->first();
                            $contactPhone = App\Models\ProfileContent::where('key', 'contact_phone')->first();
                            $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
                        @endphp
                        @if ($contactEmail && $contactEmail->content)
                            <li>📧 Email: {{ $contactEmail->content }}</li>
                        @else
                            Email belum diatur.
                        @endif
                        @if ($contactPhone && $contactPhone->content)
                            <li>📞 Telepon: {{ $contactPhone->content }}</li>
                        @else
                            Telepon belum diatur.
                        @endif
                        <li>🕘 Jam Kerja: Senin-Jumat 08:00-16:00 WIB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
