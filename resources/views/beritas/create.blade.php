{{-- resources/views/beritas/create.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Buat Berita Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">

                    {{-- Form untuk membuat berita baru --}}
                    <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul Berita --}}
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Berita')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        {{-- Isi Berita --}}
                        <div class="mb-4">
                            <x-input-label for="isi_berita" :value="__('Isi Berita')" />
                            {{-- Menggunakan textarea biasa karena x-textarea tidak tersedia default di Breeze --}}
                            <textarea id="isi_berita" name="isi_berita" rows="10"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                required>{{ old('isi_berita') }}</textarea>
                            <x-input-error :messages="$errors->get('isi_berita')" class="mt-2" />
                        </div>

                        {{-- Penulis (bisa diisi otomatis dari Auth::user()->name) --}}
                        <div class="mb-4">
    <x-input-label for="penulis" :value="__('Penulis')" />
    <x-text-input id="penulis" class="block mt-1 w-full" type="text" name="penulis"
        :value="old('penulis', $berita->penulis ?? '')" required />
    <x-input-error :messages="$errors->get('penulis')" class="mt-2" />
</div>

                        {{-- Tanggal Publikasi (opsional, bisa diisi otomatis di controller) --}}
                        <div class="mb-4">
                            <x-input-label for="tanggal_publikasi" :value="__('Tanggal Publikasi')" />
                            <x-text-input id="tanggal_publikasi" class="block mt-1 w-full" type="datetime-local" name="tanggal_publikasi" :value="old('tanggal_publikasi', now()->format('Y-m-d\TH:i'))" />
                            <x-input-error :messages="$errors->get('tanggal_publikasi')" class="mt-2" />
                        </div>

                        {{-- Upload Foto --}}
                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto Berita')" />
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

                        {{-- Tombol Submit --}}
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan Berita') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
