<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Edit Data Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors">
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors">
                    <form action="{{ route('admin.data-statistik.update', $dataStatistik) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_statistik"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Nama Statistik</label>
                            <input type="text" name="nama_statistik" id="nama_statistik"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('nama_statistik', $dataStatistik->nama_statistik) }}" placeholder="Contoh: Penduduk" required>
                            @error('nama_statistik')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jumlah"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('jumlah', $dataStatistik->jumlah) }}" placeholder="Contoh: 2000" required>
                            @error('jumlah')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="satuan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Satuan</label>
                            <input type="text" name="satuan" id="satuan"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('satuan', $dataStatistik->satuan) }}" placeholder="Contoh: Jiwa, Dusun, RT, KK" required>
                            @error('satuan')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                placeholder="Contoh: Jumlah Penduduk Desa">{{ old('deskripsi', $dataStatistik->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="icon"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Icon CSS Class (Opsional)</label>
                            <input type="text" name="icon" id="icon"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('icon', $dataStatistik->icon) }}" placeholder="Contoh: fas fa-users">
                            @error('icon')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="warna"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Warna</label>
                            <input type="color" name="warna" id="warna"
                                class="mt-1 block w-20 h-10 rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('warna', $dataStatistik->warna) }}" required>
                            @error('warna')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="urutan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Urutan Tampilan</label>
                            <input type="number" name="urutan" id="urutan" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('urutan', $dataStatistik->urutan) }}" required>
                            @error('urutan')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                class="rounded border-gray-300 dark:border-gray-600
                                       text-desa-green dark:text-green-500
                                       shadow-sm
                                       focus:border-desa-green dark:focus:border-green-600
                                       focus:ring focus:ring-desa-green dark:focus:ring-green-600 focus:ring-opacity-50
                                       transition-colors"
                                {{ old('is_active', $dataStatistik->is_active) ? 'checked' : '' }}>
                            <label for="is_active"
                                class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Aktif</label>
                            @error('is_active')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.data-statistik.index') }}"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 mr-4 transition-colors">Batal</a>
                            <button type="submit"
                                class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                       transition-colors duration-200">
                                Update Data Statistik
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>