<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white-800 leading-tight">
                Berita Terkini
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white rounded-lg shadow-sm">
            <div class="p-6 bg-white text-gray-900">
                <h3 class="text-2xl font-bold mb-6">Halo, {{ Auth::user()->name }}! Selamat datang di Portal Berita.</h3>

                <h4 class="text-xl font-semibold mb-4 text-gray-800">Berita Pilihan Terbaru</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    @forelse($beritas as $berita)
                        <div class="bg-gray-100 rounded-lg shadow overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-lg">
                            @if($berita->foto)
                                <div class="w-full h-48 overflow-hidden">
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-500">
                                    Gambar Tidak Tersedia
                                </div>
                            @endif
                            <div class="p-4">
                                <a href="{{ route('beritas.show', $berita->id) }}" class="block">
                                    <h5 class="font-bold text-lg mb-2 leading-tight text-gray-900 hover:text-indigo-600">
                                        {{ \Illuminate\Support\Str::limit($berita->judul, 50) }}
                                    </h5>
                                </a>
                                <p class="text-sm text-gray-600 mb-2">Oleh {{ $berita->penulis }} pada {{ $berita->tanggal_publikasi->format('d M Y') }}</p>
                                <p class="text-sm text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 100) }}</p>
                                <a href="{{ route('beritas.show', $berita->id) }}" class="text-indigo-600 hover:underline text-sm font-medium">Baca Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600">Belum ada berita terbaru saat ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>