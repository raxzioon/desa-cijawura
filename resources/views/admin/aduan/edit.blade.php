<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Edit Aduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.aduan.update', $aduan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Data Pelapor --}}
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">Data
                                    Pelapor</h3>

                                <div>
                                    <label for="nama"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama', $aduan->nama) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('nama')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nik"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                                    <input type="text" name="nik" id="nik"
                                        value="{{ old('nik', $aduan->nik) }}" required maxlength="20"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('nik')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="no_hp"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                        HP</label>
                                    <input type="text" name="no_hp" id="no_hp"
                                        value="{{ old('no_hp', $aduan->no_hp) }}" maxlength="15"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                    @error('no_hp')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="alamat"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('alamat', $aduan->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Data Aduan --}}
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b pb-2">Data
                                    Aduan</h3>

                                <div>
                                    <label for="jenis_aduan"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                        Surat</label>
                                    <select name="jenis_aduan" id="jenis_aduan" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                        <option value="">Pilih Jenis Aduan</option>
                                        @foreach (\App\Models\Aduan::getJenisAduanOptions() as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('jenis_aduan', $aduan->jenis_aduan) == $key ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_aduan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="isi_aduan"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Isi
                                        Aduan</label>
                                    <textarea name="isi_aduan" id="isi_aduan" rows="4" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('isi_aduan', $aduan->isi_aduan) }}</textarea>
                                    @error('isi_aduan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">
                                        @foreach (\App\Models\Aduan::getStatusOptions() as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('status', $aduan->status) == $key ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nomor_aduan"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor
                                        Surat</label>
                                    <input type="text" name="nomor_aduan" id="nomor_aduan"
                                        value="{{ old('nomor_aduan', $aduan->nomor_aduan) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue"
                                        disabled>
                                    @error('nomor_aduan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="catatan_admin"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan
                                        Admin</label>
                                    <textarea name="catatan_admin" id="catatan_admin" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-desa-skyblue focus:ring-desa-skyblue">{{ old('catatan_admin', $aduan->catatan_admin) }}</textarea>
                                    @error('catatan_admin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="lampiran_pendukung"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lampiran
                                        Pendukung</label>
                                    @if ($aduan->lampiran_pendukung)
                                        <div class="mb-2">
                                            <span class="text-sm text-green-600 dark:text-green-400">File saat ini:
                                            </span>
                                            <a href="{{ asset('storage/' . $aduan->lampiran_pendukung) }}"
                                                target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                Lihat File
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" name="lampiran_pendukung" id="lampiran_pendukung"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                               file:mr-4 file:py-2 file:px-4
                                               file:rounded-full file:border-0
                                               file:text-sm file:font-semibold
                                               file:bg-blue-50 file:text-blue-700
                                               hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, JPEG, PNG. Max: 2MB.
                                        Kosongkan jika tidak ingin mengubah file.</p>
                                    @error('lampiran_pendukung')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Info Tambahan --}}
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">Tanggal
                                        Pengajuan:</span>
                                    <span
                                        class="text-gray-600 dark:text-gray-400">{{ $aduan->created_at->format('d M Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">Terakhir Update:</span>
                                    <span
                                        class="text-gray-600 dark:text-gray-400">{{ $aduan->updated_at->format('d M Y H:i') }}</span>
                                </div>
                                @if ($aduan->tanggal_selesai)
                                    <div>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Tanggal
                                            Selesai:</span>
                                        <span
                                            class="text-gray-600 dark:text-gray-400">{{ $aduan->tanggal_selesai->format('d M Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6 space-x-2">
                            <a href="{{ route('admin.aduan.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
