<x-admin-layout>
    {{-- Anda telah mengomentari x-slot header. Jika Anda ingin header di dashboard, aktifkan kembali --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-300">
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors duration-300">
                    <div class="flex items-center mb-6">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="h-16 w-16 rounded-full object-cover mr-4 shadow-md">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF"
                                alt="{{ Auth::user()->name }}"
                                class="h-16 w-16 rounded-full object-cover mr-4 shadow-md">
                        @endif
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors">Selamat Datang,
                            {{ Auth::user()->name }}!</h3>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Statistik Umum --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 transition-colors">Statistik
                        Situs</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        {{-- Card Berita Artikel --}}
                        <div
                            class="bg-green-600 dark:bg-green-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalNews }}</div>
                                <div class="text-sm opacity-90">Berita Artikel</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M7 16h13v1h-13v-1zm13-3h-13v1h13v-1zm0-6h-5v1h5v-1zm0 3h-5v1h5v-1zm-17-8v17.199c0 .771-1 .771-1 0v-15.199h-2v15.98c0 1.115.905 2.02 2.02 2.02h19.958c1.117 0 2.022-.904 2.022-2.02v-17.98h-21zm19 17h-17v-15h17v15zm-9-12h-6v4h6v-4z" />
                            </svg>
                        </div>
                        {{-- Card Produk Desa --}}
                        <div
                            class="bg-blue-600 dark:bg-blue-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalProducts }}</div>
                                <div class="text-sm opacity-90">Produk Desa</div>
                            </div>
                            <svg width="42" height="42" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M11.499 12.03v11.971l-10.5-5.603v-11.835l10.5 5.467zm11.501 6.368l-10.501 5.602v-11.968l10.501-5.404v11.77zm-16.889-15.186l10.609 5.524-4.719 2.428-10.473-5.453 4.583-2.499zm16.362 2.563l-4.664 2.4-10.641-5.54 4.831-2.635 10.474 5.775z" />
                            </svg>
                        </div>
                        {{-- Card Album Galeri --}}
                        <div
                            class="bg-purple-600 dark:bg-purple-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalGalleries }}</div>
                                <div class="text-sm opacity-90">Album Galeri</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M14 9l-2.519 4-2.481-1.96-5 6.96h16l-6-9zm8-5v16h-20v-16h20zm2-2h-24v20h24v-20zm-20 6c0-1.104.896-2 2-2s2 .896 2 2c0 1.105-.896 2-2 2s-2-.895-2-2z" />
                            </svg>
                        </div>
                        {{-- Card Dokumen Publik --}}
                        <div
                            class="bg-red-600 dark:bg-red-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalDocuments }}</div>
                                <div class="text-sm opacity-90">Dokumen Publik</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M11.362 2c4.156 0 2.638 6 2.638 6s6-1.65 6 2.457v11.543h-16v-20h7.362zm.827-2h-10.189v24h20v-14.386c0-2.391-6.648-9.614-9.811-9.614zm4.811 13h-10v-1h10v1zm0 2h-10v1h10v-1zm0 3h-10v1h10v-1z" />
                            </svg>
                        </div>
                        {{-- Card Agenda Kegiatan --}}
                        <div
                            class="bg-teal-600 dark:bg-teal-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalEvents }}</div>
                                <div class="text-sm opacity-90">Agenda Kegiatan</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M20 20h-4v-4h4v4zm-6-10h-4v4h4v-4zm6 0h-4v4h4v-4zm-12 6h-4v4h4v-4zm6 0h-4v4h4v-4zm-6-6h-4v4h4v-4zm16-8v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2z" />
                            </svg>
                        </div>
                        {{-- Card Lembaga Desa --}}
                        <div
                            class="bg-orange-600 dark:bg-orange-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalInstitutions }}</div>
                                <div class="text-sm opacity-90">Lembaga Desa</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M7 21h-4v-11h4v11zm7-11h-4v11h4v-11zm7 0h-4v11h4v-11zm2 12h-22v2h22v-2zm-23-13h24l-12-9-12 9z" />
                            </svg>
                        </div>
                        <div
                            class="bg-indigo-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105  duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalVisits }}</div>
                                <div class="text-sm">Total Kunjungan</div>
                                <div class="text-xs opacity-75 mt-1">{{ $uniqueVisitors }} Pengunjung Unik</div>
                            </div>
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                width="42" height="42">
                                <path
                                    d="m17.5 11c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm-5.346 6.999c-.052.001-.104.001-.156.001-4.078 0-7.742-3.093-9.854-6.483-.096-.159-.144-.338-.144-.517s.049-.358.145-.517c2.111-3.39 5.775-6.483 9.853-6.483 4.143 0 7.796 3.09 9.864 6.493.092.156.138.332.138.507 0 .179-.062.349-.15.516-.58-.634-1.297-1.14-2.103-1.472-1.863-2.476-4.626-4.544-7.749-4.544-3.465 0-6.533 2.632-8.404 5.5 1.815 2.781 4.754 5.34 8.089 5.493.09.529.25 1.034.471 1.506zm3.071-2.023 1.442 1.285c.095.085.215.127.333.127.136 0 .271-.055.37-.162l2.441-2.669c.088-.096.131-.217.131-.336 0-.274-.221-.499-.5-.499-.136 0-.271.055-.37.162l-2.108 2.304-1.073-.956c-.096-.085-.214-.127-.333-.127-.277 0-.5.224-.5.499 0 .137.056.273.167.372zm-3.603-.994c-2.031-.19-3.622-1.902-3.622-3.982 0-2.208 1.792-4 4-4 1.804 0 3.331 1.197 3.829 2.84-.493.146-.959.354-1.389.615-.248-1.118-1.247-1.955-2.44-1.955-1.38 0-2.5 1.12-2.5 2.5 0 1.363 1.092 2.472 2.448 2.499-.169.47-.281.967-.326 1.483z"
                                    fill-rule="nonzero" />
                            </svg>
                        </div>
                        <div
                            class="bg-yellow-500 dark:bg-orange-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalPotentials }}</div>
                                <div class="text-sm opacity-90">Potensi Desa</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="currentColor"
                                class="bi bi-globe-asia-australia" viewBox="0 0 16 16">
                                <path
                                    d="m10.495 6.92 1.278-.619a.483.483 0 0 0 .126-.782c-.252-.244-.682-.139-.932.107-.23.226-.513.373-.816.53l-.102.054c-.338.178-.264.626.1.736a.48.48 0 0 0 .346-.027ZM7.741 9.808V9.78a.413.413 0 1 1 .783.183l-.22.443a.6.6 0 0 1-.12.167l-.193.185a.36.36 0 1 1-.5-.516l.112-.108a.45.45 0 0 0 .138-.326M5.672 12.5l.482.233A.386.386 0 1 0 6.32 12h-.416a.7.7 0 0 1-.419-.139l-.277-.206a.302.302 0 1 0-.298.52z" />
                                <path
                                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M1.612 10.867l.756-1.288a1 1 0 0 1 1.545-.225l1.074 1.005a.986.986 0 0 0 1.36-.011l.038-.037a.88.88 0 0 0 .26-.755c-.075-.548.37-1.033.92-1.099.728-.086 1.587-.324 1.728-.957.086-.386-.114-.83-.361-1.2-.207-.312 0-.8.374-.8.123 0 .24-.055.318-.15l.393-.474c.196-.237.491-.368.797-.403.554-.064 1.407-.277 1.583-.973.098-.391-.192-.634-.484-.88-.254-.212-.51-.426-.515-.741a7 7 0 0 1 3.425 7.692 1 1 0 0 0-.087-.063l-.316-.204a1 1 0 0 0-.977-.06l-.169.082a1 1 0 0 1-.741.051l-1.021-.329A1 1 0 0 0 11.205 9h-.165a1 1 0 0 0-.945.674l-.172.499a1 1 0 0 1-.404.514l-.802.518a1 1 0 0 0-.458.84v.455a1 1 0 0 0 1 1h.257a1 1 0 0 1 .542.16l.762.49a1 1 0 0 0 .283.126 7 7 0 0 1-9.49-3.409Z" />
                            </svg>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Statistik Layanan & Moderasi --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 mt-8 transition-colors">
                        Status Layanan</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        {{-- Card Pengajuan Surat Pending --}}
                        <div
                            class="bg-yellow-500 dark:bg-yellow-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingSuratRequests }}</div>
                                <div class="text-sm opacity-90">Pengajuan Surat Pending</div>
                            </div>
                            <a href="{{ route('admin.surat-online.index') }}"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                        {{-- Card Komentar Pending --}}
                        <div
                            class="bg-red-500 dark:bg-red-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingAduans }}</div>
                                <div class="text-sm opacity-90">Aduan Pending</div>
                            </div>
                            <a href="{{ route('admin.aduan.index') }}"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                        {{-- Card Prosedur Layanan --}}
                        <div
                            class="bg-indigo-600 dark:bg-indigo-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalServiceProcedures }}</div>
                                <div class="text-sm opacity-90">Prosedur Layanan</div>
                            </div>
                            <a href="{{ route('admin.service-procedures.index') }}"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Aktivitas Terbaru --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 mt-8 transition-colors">
                        Aktivitas & Data Terbaru</h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 transition-colors">
                                Berita Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestNews as $newsItem)
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center justify-between transition-colors duration-200">
                                        <div>
                                            <a href="{{ route('admin.news.edit', $newsItem) }}"
                                                class="text-gray-800 dark:text-gray-100 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ Str::limit($newsItem->title, 50) }}
                                            </a>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $newsItem->published_at ? $newsItem->published_at->format('d M Y H:i') : 'Draft' }}
                                            </p>
                                        </div>
                                        @if ($newsItem->is_published)
                                            <span
                                                class="px-2.5 py-0.5 bg-green-500 text-white text-xs font-medium rounded-full">Terbit</span>
                                        @else
                                            <span
                                                class="px-2.5 py-0.5 bg-yellow-500 text-white text-xs font-medium rounded-full">Draft</span>
                                        @endif
                                    </li>
                                @empty
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                        Tidak ada berita terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($totalNews > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.news.index') }}"
                                        class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                        Semua Berita &rarr;</a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 transition-colors">
                                Pengajuan Surat Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestServiceRequests as $requestItem)
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center justify-between transition-colors duration-200">
                                        <div>
                                            <a href="{{ route('admin.service-requests.show', $requestItem) }}"
                                                class="text-gray-800 dark:text-gray-100 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ Str::limit($requestItem->jenis_surat, 40) }}
                                            </a>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $requestItem->nama }} -
                                                {{ $requestItem->created_at->format('d M Y H:i') }}
                                            </p>
                                        </div>
                                        @php
                                            $statusClass =
                                                [
                                                    'pending' => 'bg-yellow-500',
                                                    'diproses' => 'bg-blue-500',
                                                    'selesai' => 'bg-green-500',
                                                    'ditolak' => 'bg-red-500',
                                                ][$requestItem->status] ?? 'bg-gray-500';
                                        @endphp
                                        <span
                                            class="px-2.5 py-0.5 {{ $statusClass }} text-white text-xs font-medium rounded-full">
                                            {{ ucfirst($requestItem->status) }}
                                        </span>
                                    </li>
                                @empty
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                        Tidak ada pengajuan surat terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($pendingSuratRequests > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.surat-online.index') }}"
                                        class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                        Semua Pengajuan &rarr;</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Komentar Pending Terbaru --}}
                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 mt-8 transition-colors">
                        Komentar Pending Terbaru</h5>
                    <ul class="space-y-3">
                        @forelse($latestComments as $commentItem)
                            <li
                                class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm transition-colors duration-200">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $commentItem->guest_name ?? ($commentItem->user->name ?? 'Anonim') }}
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $commentItem->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-200 mb-2">
                                    {{ Str::limit($commentItem->content, 100) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pada artikel:
                                    <a href="{{ route('news.show', $commentItem->news->slug) }}" target="_blank"
                                        class="text-blue-600 dark:text-blue-400 hover:underline transition-colors">
                                        {{ Str::limit($commentItem->news->title, 40) }}
                                    </a>
                                </p>
                                <div class="text-right mt-2">
                                    <a href="{{ route('admin.comments.index') }}"
                                        class="text-green-600 dark:text-green-400 text-xs hover:underline transition-colors">Moderasi
                                        &rarr;</a>
                                </div>
                            </li>
                        @empty
                            <li
                                class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                Tidak ada komentar pending.</li>
                        @endforelse
                    </ul>
                    @if ($pendingComments > 0)
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.comments.index') }}"
                                class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                Semua Komentar Pending &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
