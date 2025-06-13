<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Detail Berita
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-black">

                    {{-- Foto Berita --}}
                    @if($berita->foto)
                        <div class="mb-6 text-center">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                 class="max-w-full lg:max-w-xl mx-auto h-auto rounded-lg shadow-lg object-cover">
                        </div>
                    @endif

                    {{-- Judul Berita --}}
                    <h1 class="text-3xl font-bold text-black mb-2">
                        {{ $berita->judul }}
                    </h1>

                    {{-- Informasi Penulis dan Tanggal --}}
                    <p class="text-sm text-black mb-6">
                        Oleh <span class="font-semibold">{{ $berita->penulis }}</span> pada
                        <span class="font-semibold">{{ $berita->tanggal_publikasi->format('d F Y, H:i') }} WIB</span>
                    </p>

                    {{-- Isi Berita --}}
                    <div class="prose max-w-none text-black leading-relaxed text-justify">
                        {!! nl2br(e($berita->isi_berita)) !!}
                    </div>

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-black border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Kembali ke Dashboard') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>