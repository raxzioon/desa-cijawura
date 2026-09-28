<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Edit Program Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors">
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors">
                    <form action="{{ route('admin.program-desa.update', $programDesa) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Nama
                                Program Desa</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('name', $programDesa->name) }}" placeholder="Contoh: Pengembangan BUMDES"
                                required>
                            @error('name')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                placeholder="Contoh: Program bumdes untuk kemajuan">{{ old('deskripsi', $programDesa->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="urutan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Urutan
                                Tampilan</label>
                            <input type="number" name="urutan" id="urutan" min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('urutan', $programDesa->urutan) }}" required>
                            @error('urutan')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.program-desa.index') }}"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 mr-4 transition-colors">Batal</a>
                            <button type="submit"
                                class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                       transition-colors duration-200">
                                Update Program Desa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
