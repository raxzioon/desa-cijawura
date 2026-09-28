<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Aduan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="">
            <div class="">
                <div x-data="{ searchTerm: '' }" class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">

                    {{-- Tombol Tambah dan Filter --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                        <a href="{{ route('admin.aduan.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                            Tambah Aduan Baru
                        </a>

                        {{-- Filter dan Search Form --}}
                        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                            <form method="GET" action="{{ route('admin.aduan.index') }}"
                                class="flex flex-col sm:flex-row gap-2">
                                <select name="status"
                                    class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                    <option value="">Semua Status</option>
                                    @foreach (\App\Models\Aduan::getStatusOptions() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="jenis_aduan"
                                    class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                    <option value="">Semua Jenis</option>
                                    @foreach (\App\Models\Aduan::getJenisAduanOptions() as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request('jenis_aduan') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama/NIK..."
                                    class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">

                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    Filter
                                </button>

                                <a href="{{ route('admin.aduan.index') }}"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-center">
                                    Reset
                                </a>
                            </form>
                        </div>
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
                                        Nama</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        NIK</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Jenis Aduan</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Status</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Tanggal</th>
                                    <th
                                        class="px-4 py-2 text-right font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($aduan as $aduanOnline)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ $aduanOnline->nama }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ $aduanOnline->nik }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ \App\Models\Aduan::getJenisAduanOptions()[$aduanOnline->jenis_aduan] ?? $aduanOnline->jenis_aduan }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold rounded-full {{ $aduanOnline->getStatusBadgeClass() }}">
                                                {{ \App\Models\Aduan::getStatusOptions()[$aduanOnline->status] ?? $aduanOnline->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ $aduanOnline->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.aduan.show', $aduanOnline) }}"
                                                class="text-green-600 hover:text-green-900 dark:hover:text-green-300 mr-3">Detail</a>
                                            <a href="{{ route('admin.aduan.edit', $aduanOnline) }}"
                                                class="text-desa-skyblue hover:text-blue-900 dark:hover:text-blue-300 mr-3">Edit</a>
                                            <form action="{{ route('admin.aduan.destroy', $aduanOnline) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus aduan ini?');">
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
                                            aduan ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $aduan->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
