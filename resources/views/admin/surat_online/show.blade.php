<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Detail Surat Online') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Header dengan Status dan Aksi --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $suratOnline->nama }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">NIK: {{ $suratOnline->nik }}</p>
                        </div>
                        <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $suratOnline->getStatusBadgeClass() }}">
                                {{ \App\Models\SuratOnline::getStatusOptions()[$suratOnline->status] ?? $suratOnline->status }}
                            </span>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.surat-online.edit', $suratOnline) }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <a href="{{ route('admin.surat-online.index') }}"
                                    class="inline-flex items-center px-3 py-1 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 transition ease-in-out duration-150">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Data Pemohon --}}
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2 mb-4">Data Pemohon</h4>
                                
                                <div class="space-y-4">
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">Nama Lengkap:</span>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $suratOnline->nama }}</span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">NIK:</span>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $suratOnline->nik }}</span>
                                    </div>
                                    
                                    @if($suratOnline->email)
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">Email:</span>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $suratOnline->email }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($suratOnline->no_hp)
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">No. HP:</span>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $suratOnline->no_hp }}</span>
                                    </div>
                                    @endif
                                    
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat:</span>
                                        <span class="text-gray-600 dark:text-gray-400 pl-4">{{ $suratOnline->alamat }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- File Persyaratan --}}
                            @if($suratOnline->file_persyaratan)
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2 mb-4">File Persyaratan</h4>
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <a href="{{ asset('storage/' . $suratOnline->file_persyaratan) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        Lihat File
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>

                        {{-- Data Surat --}}
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2 mb-4">Data Surat</h4>
                                
                                <div class="space-y-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Surat:</span>
                                        <span class="text-gray-600 dark:text-gray-400 pl-4">
                                            {{ \App\Models\SuratOnline::getJenisSuratOptions()[$suratOnline->jenis_surat] ?? $suratOnline->jenis_surat }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 mb-2">Keperluan:</span>
                                        <div class="text-gray-600 dark:text-gray-400 pl-4 bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                            {{ $suratOnline->keperluan }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">Status:</span>
                                        <span class="inline-flex px-2 text-xs font-semibold rounded-full {{ $suratOnline->getStatusBadgeClass() }}">
                                            {{ \App\Models\SuratOnline::getStatusOptions()[$suratOnline->status] ?? $suratOnline->status }}
                                        </span>
                                    </div>
                                    
                                    @if($suratOnline->nomor_surat)
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 w-32 mb-1 sm:mb-0">Nomor Surat:</span>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $suratOnline->nomor_surat }}</span>
                                    </div>
                                    @endif
                                    
                                    @if($suratOnline->catatan_admin)
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan Admin:</span>
                                        <div class="text-gray-600 dark:text-gray-400 pl-4 bg-yellow-50 dark:bg-yellow-900 p-3 rounded">
                                            {{ $suratOnline->catatan_admin }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Timeline --}}
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2 mb-4">Timeline</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Pengajuan Dibuat</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $suratOnline->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($suratOnline->updated_at != $suratOnline->created_at)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Terakhir Diperbarui</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $suratOnline->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($suratOnline->tanggal_selesai)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Surat Selesai</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $suratOnline->tanggal_selesai->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Status Update --}}
                    <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Update Status Cepat</h4>
                        <form action="{{ route('admin.surat-online.update-status', $suratOnline) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            @method('PUT')
                            
                            <select name="status" required class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                @foreach(\App\Models\SuratOnline::getStatusOptions() as $key => $value)
                                    <option value="{{ $key }}" {{ $suratOnline->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            
                            <input type="text" name="nomor_surat" placeholder="Nomor Surat (opsional)" value="{{ $suratOnline->nomor_surat }}"
                                class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                            
                            <input type="text" name="catatan_admin" placeholder="Catatan Admin (opsional)" value="{{ $suratOnline->catatan_admin }}"
                                class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                            
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring ring-green-300 transition ease-in-out duration-150">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>