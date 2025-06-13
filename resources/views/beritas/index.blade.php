<x-app-layout>
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            {{-- Title and Add Button --}}
            <header class="sticky top-0 bg-white z-50 shadow-md py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-indigo-600">
            📚 Daftar Berita
        </h2>
        <a href="{{ route('beritas.create') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-black hover:text-gray-900 text-sm font-semibold px-4 py-2 rounded-lg shadow transition"> <i class="fas fa-plus-circle"></i> <span>Tambah Berita</span> </a>
    </div>
</header>

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-900 px-4 py-3 rounded relative shadow">
                    <strong class="font-semibold">Berhasil! </strong> {{ session('success') }}
                </div>
            @endif

            {{-- News Table --}}
            <div class="bg-white rounded-xl overflow-hidden shadow-inner">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full table-auto divide-y divide-gray-300">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Penulis</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @forelse ($beritas as $berita)
                                <tr class="odd:bg-white even:bg-gray-50 hover:bg-indigo-50 transition">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        @if($berita->foto)
                                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="w-16 h-16 object-cover rounded-md shadow border border-gray-200">
                                        @else
                                            <span class="text-gray-400 text-sm">(tidak ada)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ Str::limit($berita->judul, 70) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $berita->penulis }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $berita->tanggal_publikasi->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('beritas.show', $berita->id) }}" class="px-3 py-1 bg-blue-200 hover:bg-blue-300 text-blue-900 hover:text-blue-800 text-xs rounded-md shadow inline-flex items-center gap-1" title="Lihat">
                                                <i class="fas fa-eye"></i><span>Lihat</span>
                                            </a>
                                            <a href="{{ route('beritas.edit', $berita->id) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 font-semibold text-xs rounded-md shadow inline-flex items-center gap-1" title="Edit">
                                                <i class="fas fa-edit"></i><span>Edit</span>
                                            </a>
                                            <form action="{{ route('beritas.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs rounded-md shadow inline-flex items-center gap-1" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i><span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-sm text-gray-500 px-6 py-4">
                                        Belum ada berita.
                                        @if(Auth::check() && Auth::user()->role === 'admin')
                                            <a href="{{ route('beritas.create') }}" class="text-indigo-600 hover:underline ml-1">Tambah Sekarang</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if($beritas instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-6">
                            {{ $beritas->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>