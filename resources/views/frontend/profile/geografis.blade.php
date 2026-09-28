<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Struktur Pemerintahan') }}
        </h2>
    </x-slot> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-accent" data-aos="fade-down">Geografis Desa
                        {{ $villageName->content ?? '' }}</h3>
                    <div class="prose text-gray-700 leading-relaxed mt-6" data-aos="fade-up" data-aos-delay="100">
                        {!! $geografis->content ?? 'Geografis desa belum diatur. Silakan hubungi admin.' !!}
                    </div>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md h-full">
                    <h3 class="text-xl font-semibold text-dark-text mb-4">Lokasi dan kondisi geografis</h3>
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        {{-- Menggunakan string URL Google Maps dinamis --}}
                        @if ($googleMapsEmbedUrl)
                            {{-- Cukup cek apakah string URLnya tidak null --}}
                            <iframe src="{{ $googleMapsEmbedUrl }}" width="100%" height="100%" {{-- Langsung pakai variabel --}}
                                style="min-height: 300px;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" class="rounded-lg">
                            </iframe>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg"
                                style="min-height: 300px;">
                                Peta belum diatur atau koordinat tidak valid.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
