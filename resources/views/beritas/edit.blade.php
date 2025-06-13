{{-- resources/views/beritas/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Berita: {{ $berita->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">

                    {{-- Form untuk mengedit berita --}}
                    <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Digunakan untuk metode UPDATE --}}

                        {{-- Judul Berita --}}
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Berita')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $berita->judul)" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        {{-- Isi Berita --}}
                        <div class="mb-4">
                            <x-input-label for="isi_berita" :value="__('Isi Berita')" />
                            <textarea id="isi_berita" name="isi_berita" rows="10"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                required>{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                            <x-input-error :messages="$errors->get('isi_berita')" class="mt-2" />
                        </div>

                        {{-- Penulis --}}
                        <div class="mb-4">
                            <x-input-label for="penulis" :value="__('Penulis')" />
                            <x-text-input id="penulis" class="block mt-1 w-full" type="text" name="penulis" :value="old('penulis', isset($berita) ? $berita->penulis : '')" required />
                            <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
                        </div>

                        {{-- Tanggal Publikasi --}}
                        <div class="mb-4">
                            <x-input-label for="tanggal_publikasi" :value="__('Tanggal Publikasi')" />
                            <x-text-input id="tanggal_publikasi" class="block mt-1 w-full" type="datetime-local" name="tanggal_publikasi" :value="old('tanggal_publikasi', $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('Y-m-d\TH:i') : '')" />
                            <x-input-error :messages="$errors->get('tanggal_publikasi')" class="mt-2" />
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto Berita (Biarkan kosong jika tidak ingin mengubah)')" />
                            @if ($berita->foto)
                                <div class="mt-2 mb-2">
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto saat ini" class="max-w-[200px] max-h-[200px] object-cover rounded-md shadow">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <input id="foto" class="block mt-1 w-full text-sm text-gray-900 dark:text-gray-100
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-violet-50 file:text-violet-700
                                hover:file:bg-violet-100"
                                type="file" name="foto" accept="image/*" />
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Ukuran maksimal file: 2MB. Format: JPG, PNG, GIF.</p>
                        </div>

                        {{-- Tombol Submit dan Batal --}}
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('beritas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Perbarui Berita') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
