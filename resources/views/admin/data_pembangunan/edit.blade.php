<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Edit Data Pembangunan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors">
                {{-- Latar belakang card utama --}}
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors"> {{-- Warna teks konten utama --}}
                    <form action="{{ route('admin.data-pembangunan.update', $data_pembangunan) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Judul</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('title', $data_pembangunan->title) }}" required>
                            @error('title')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Konten
                                Data Pembangunan</label>
                            <textarea name="content" id="content" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                required>{{ old('content', $data_pembangunan->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Gambar
                                (Opsional)</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full
                                       text-gray-900 dark:text-gray-200
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-desa-skyblue
                                       hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200 dark:hover:file:bg-gray-500
                                       cursor-pointer transition-colors"
                                accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mt-2" id="image-preview-container">
                                @if ($data_pembangunan->image)
                                    <img id="image-preview" src="{{ Storage::url($data_pembangunan->image) }}"
                                        alt="Gambar Saat Ini"
                                        class="h-32 w-auto object-cover rounded-md block shadow-md">
                                    {{-- Menambahkan shadow --}}
                                @else
                                    <img id="image-preview" src="#" alt="Pratinjau Gambar"
                                        class="hidden h-32 w-auto object-cover rounded-md shadow-md">
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="date_at"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Tanggal
                                Pelaksanaan
                                (Opsional)</label>
                            <input type="datetime-local" name="date_at" id="date_at"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('date_at', $data_pembangunan->date_at ? $data_pembangunan->date_at->format('Y-m-d\TH:i') : null) }}">
                            {{-- Perbaiki default value jika null --}}
                            @error('date_at')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="lokasi"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Lokasi
                                Pelaksanaan
                                (Opsional)</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('lokasi', $data_pembangunan->lokasi) }}">
                            @error('lokasi')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6"> {{-- Margin-top ditingkatkan --}}
                            <a href="{{ route('admin.data-pembangunan.index') }}"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 mr-4 transition-colors">Batal</a>
                            <button type="submit"
                                class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                       transition-colors duration-200">
                                Perbarui Data Pembangunan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const output = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    output.src = reader.result;
                    output.classList.remove('hidden');
                    output.classList.add('block');
                };
                reader.readAsDataURL(file);
            } else {
                // If no new file is selected, and there was an existing image, keep it visible
                // Otherwise, hide the preview
                const currentImageSrc = "{{ $data_pembangunan->image ? Storage::url($data_pembangunan->image) : '' }}";
                if (currentImageSrc) {
                    output.src = currentImageSrc;
                    output.classList.remove('hidden');
                    output.classList.add('block');
                } else {
                    output.classList.add('hidden');
                    output.classList.remove('block');
                    output.src = '#';
                }
            }
        }
    </script>
</x-admin-layout>
