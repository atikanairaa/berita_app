<x-app-layout>
    <div class="flex flex-col min-h-screen bg-white">
        {{-- Header --}}
        <header class="sticky top-0 bg-white z-50 shadow-md py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-indigo-600">
                    Selamat Datang Admin 👋
                </h2>
                <p class="text-sm text-gray-600 mt-1 max-w-xl">
                    Berikut adalah ringkasan berita terbaru.
                </p>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-grow max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10 py-12 w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8">

                {{-- Berita Terbaru Title --}}
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-indigo-500">📰 Berita Terbaru</h3>
                </div>

                {{-- Berita Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($beritas as $index => $berita)
                        @php
                            // Warna solid terang untuk setiap card
                            $cardColors = [
                                'bg-pink-200',
                                'bg-yellow-200',
                                'bg-green-200',
                                'bg-blue-200',
                                'bg-purple-200',
                                'bg-orange-200',
                            ];
                            $color = $cardColors[$index % count($cardColors)];
                        @endphp

                        <a href="{{ route('beritas.show', $berita->id) }}" class="block rounded-2xl overflow-hidden shadow-md {{ $color }} transition hover:scale-[1.01] duration-200 flex flex-col h-full no-underline focus:outline-none focus:ring-4 focus:ring-indigo-400" aria-label="Baca selengkapnya: {{ $berita->judul }}">
                            <div class="relative w-full" style="padding-top: 100%;">
                                @if ($berita->foto)
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}"
                                        class="absolute top-0 left-0 w-full h-full object-cover rounded-t-2xl">
                                @else
                                    <div class="absolute top-0 left-0 w-full h-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm rounded-t-2xl">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </div>

                            <div class="p-10 space-y-3 flex-1 flex flex-col justify-between text-gray-800">
                                <div>
                                    <h4 class="text-lg font-bold line-clamp-2">
                                        {{ $berita->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-600 mt-1">
                                        Oleh <span class="font-medium">{{ $berita->penulis }}</span> • {{ $berita->tanggal_publikasi->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="mt-4 text-indigo-700 font-semibold underline text-sm">
                                    Baca Selengkapnya →
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="sticky bottom-0 bg-white z-50 shadow-inner py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600 text-sm select-none">
                &copy; 2025 | Atika Naira.
            </div>
        </footer>
    </div>
</x-app-layout>

