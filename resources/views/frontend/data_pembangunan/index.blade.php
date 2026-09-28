<x-app-layout>
    {{-- <x-slot title="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pembangunan Desa') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-accent text-center" data-aos="fade-down">Data Pembangunan Desa
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($data_pembangunan as $index => $pembangunan)
                            <div class="mb-4 p-4 border rounded-lg shadow-md" data-aos="fade-up"
                                data-aos-delay="{{ 100 * ($index + 1) }}">
                                <a href="{{ route('data-pembangunan.show', $pembangunan->slug) }}" class="block group">
                                    @if ($pembangunan->image)
                                        <img src="{{ Storage::url($pembangunan->image) }}"
                                            alt="Sampul {{ $pembangunan->title }}"
                                            class="w-full h-48 object-cover rounded-lg shadow-md mb-3 transform hover:scale-105 transition duration-500">
                                    @else
                                        <div
                                            class="w-full h-48 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg mb-3">
                                            Tidak ada Gambar</div>
                                    @endif
                                    <h4 class="text-xl font-bold text-desa mb-2">{{ $pembangunan->title }}</h4>
                                    <p class="text-gray-600 text-xs mt-2">Pelaksanaan
                                        {{ $pembangunan->date_at ? $pembangunan->date_at->format('d F Y') : '-' }}
                                    </p>

                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada data pembangunan yang
                                dipublikasikan.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $data_pembangunan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
