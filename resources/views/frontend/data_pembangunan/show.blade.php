{{-- resources/views/frontend/news/news_show.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pembangunan: {{ $data_pembangunan->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-gray-900">
                        <h3 class="text-2xl font-bold mb-4 text-accent text-center" data-aos="fade-down">
                            {{ $data_pembangunan->title }}
                        </h3>
                        @if ($data_pembangunan->image)
                            <img src="{{ $data_pembangunan->image_url }}" alt="{{ $data_pembangunan->title }}"
                                class="w-full h-full object-cover rounded-lg shadow-md mb-6" data-aos="zoom-in">
                        @endif

                        <p class="text-gray-700 " data-aos="fade-down" data-aos-delay="100">
                            Pelaksanaan :
                            {{ $data_pembangunan->date_at ? $data_pembangunan->date_at->format('d F Y') : '-' }}
                        </p>

                        <p class="text-gray-700 " data-aos="fade-down" data-aos-delay="100">
                            Lokasi :
                            {{ $data_pembangunan->lokasi ? $data_pembangunan->lokasi : '-' }}
                        </p>

                        <div class="prose max-w-none text-gray-700 leading-relaxed"
                            style="color: var(--color-dark-text);" data-aos="fade-up">
                            {!! $data_pembangunan->content !!}
                        </div>

                        <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('data-pembangunan.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150"
                                style="color: var(--color-dark-text); focus-ring-color: var(--color-secondary);">
                                {{-- Ubah warna fokus --}}
                                &larr; Kembali ke Data Pembangunan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
