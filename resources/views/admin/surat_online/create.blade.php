<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Tambah Surat Online') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.surat-online.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Data Pemohon --}}
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">Data Pemohon</h3>
                                
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required maxlength="20"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('nik')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. HP</label>
                                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" maxlength="15"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('no_hp')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Data Surat --}}
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">Data Surat</h3>
                                
                                <div>
                                    <label for="jenis_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Surat</label>
                                    <select name="jenis_surat" id="jenis_surat" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                        <option value="">Pilih Jenis Surat</option>
                                        @foreach(\App\Models\SuratOnline::getJenisSuratOptions() as $key => $value)
                                            <option value="{{ $key }}" {{ old('jenis_surat') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_surat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="keperluan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keperluan</label>
                                    <textarea name="keperluan" id="keperluan" rows="4" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('keperluan') }}</textarea>
                                    @error('keperluan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                        @foreach(\App\Models\SuratOnline::getStatusOptions() as $key => $value)
                                            <option value="{{ $key }}" {{ old('status', 'pending') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Surat</label>
                                    <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('nomor_surat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="catatan_admin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan Admin</label>
                                    <textarea name="catatan_admin" id="catatan_admin" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('catatan_admin') }}</textarea>
                                    @error('catatan_admin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="file_persyaratan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Persyaratan</label>
                                    <input type="file" name="file_persyaratan" id="file_persyaratan" accept=".pdf,.jpg,.jpeg,.png"
                                        class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                               file:mr-4 file:py-2 file:px-4
                                               file:rounded-full file:border-0
                                               file:text-sm file:font-semibold
                                               file:bg-blue-50 file:text-blue-700
                                               hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Max: 2MB</p>
                                    @error('file_persyaratan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6 space-x-2">
                            <a href="{{ route('admin.surat-online.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>