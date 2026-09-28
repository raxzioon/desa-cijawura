<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Program Desa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="">
            <div class="">
                <div x-data="{ searchTerm: '' }" class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">

                    {{-- Tombol Tambah dan Input Cari --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                        <a href="{{ route('admin.program-desa.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                            Tambah Program Desa
                        </a>
                        <input type="text" x-model="searchTerm" placeholder="Cari data statistik..."
                            class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50 w-full sm:w-auto">
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Table Responsive --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Urutan</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Nama Program Desa</th>
                                    <th
                                        class="px-4 py-2 text-right font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($programDesa as $data)
                                    <tr
                                        x-show="dataMatch(JSON.parse('{{ json_encode($data->only(['name', 'deskripsi'])) }}'), searchTerm)">
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ $data->urutan }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            <div class="flex items-center">
                                                {{ $data->name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.program-desa.edit', $data) }}"
                                                class="text-desa-skyblue hover:text-blue-900 dark:hover:text-blue-300 mr-3">Edit</a>
                                            <form action="{{ route('admin.program-desa.destroy', $data) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data statistik ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada
                                            program desa ditemukan.</td>
                                    </tr>
                                @endforelse
                                <tr
                                    x-show="!$el.parentNode.querySelector('tr:not([x-show=\'false\'])') && searchTerm !== ''">
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada hasil
                                        ditemukan untuk pencarian Anda.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AlpineJS Function --}}
    <script>
        function dataMatch(data, term) {
            if (!term || term.trim() === '') {
                return true;
            }
            const lowerCaseTerm = term.toLowerCase();
            return (data.nama_statistik && data.nama_statistik.toLowerCase().includes(lowerCaseTerm)) ||
                (data.satuan && data.satuan.toLowerCase().includes(lowerCaseTerm));
        }
    </script>
</x-admin-layout>
