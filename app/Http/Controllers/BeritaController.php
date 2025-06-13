<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BeritaController extends Controller
{
    /**
     * Middleware untuk mengamankan akses ke controller ini.
     * Pastikan ini sudah diterapkan di routes/web.php sesuai kebutuhan aplikasi Anda.
     */

    /**
     * Menampilkan daftar semua berita.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->get();
        return view('beritas.index', compact('beritas'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beritas.create');
    }

    /**
     * Menyimpan berita baru yang dikirim dari form ke database.
     * File foto akan disimpan di `storage/app/public/berita_images`
     * dan di database akan disimpan path relatifnya (misal: `berita_images/nama_file_unik.jpg`).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validatedData = $request->validate([
            'judul'             => 'required|string|min:10|max:255',
            'isi_berita'        => 'required|string',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Foto opsional, max 2MB
            'tanggal_publikasi' => 'nullable|date',
            'penulis'           => 'required|string|max:255', // Tambahkan validasi untuk penulis
        ]);

        // 2. Proses upload foto jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('berita_images', $filename, 'public');
            $validatedData['foto'] = $path;
            Log::info("Foto baru diunggah dan disimpan: " . $path);
        } else {
            $validatedData['foto'] = null; // Pastikan kolom foto diset null jika tidak ada upload
        }

        // 3. Tentukan tanggal publikasi jika tidak diisi dari form
        if (empty($validatedData['tanggal_publikasi'])) {
            $validatedData['tanggal_publikasi'] = now();
        } else {
            $validatedData['tanggal_publikasi'] = \Carbon\Carbon::parse($validatedData['tanggal_publikasi']);
        }

        // 4. Buat record berita baru di database
        Berita::create($validatedData);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil ditambahkan!');
    }


    /**
     * Menampilkan detail satu berita berdasarkan ID-nya.
     *
     * @param  \App\Models\Berita  $berita (Route Model Binding otomatis menemukan berita berdasarkan ID)
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        return view('beritas.show', compact('berita'));
    }

    /**
     * Menampilkan form untuk mengedit berita yang sudah ada.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return view('beritas.edit', compact('berita'));
    }

    /**
     * Memperbarui data berita yang sudah ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
{
    // 1. Validasi input dari form
    $validatedData = $request->validate([
        'judul'             => 'required|string|min:10|max:255',
        'isi_berita'        => 'required|string',
        'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'tanggal_publikasi' => 'nullable|date',
        'penulis'           => 'required|string|max:255', // Tambahkan validasi untuk penulis
    ]);

    // 2. Proses upload foto jika ada file foto baru yang diunggah
    if ($request->hasFile('foto')) {
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
            Log::info("Foto lama berhasil dihapus saat update: " . $berita->foto);
        } else {
            Log::warning("Gagal menghapus foto lama saat update (file tidak ditemukan atau path kosong): " . $berita->foto);
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('berita_images', $filename, 'public');
        $validatedData['foto'] = $path;
        Log::info("Foto baru diunggah dan disimpan saat update: " . $path);
    } else {
        $validatedData['foto'] = $berita->foto; // Pertahankan foto lama jika tidak ada foto baru diunggah
    }

    // 3. Tentukan tanggal publikasi
    if (empty($validatedData['tanggal_publikasi'])) {
        $validatedData['tanggal_publikasi'] = now();
    } else {
        $validatedData['tanggal_publikasi'] = \Carbon\Carbon::parse($validatedData['tanggal_publikasi']);
    }

    // 4. Perbarui record berita di database
    $berita->update($validatedData);

    return redirect()->route('beritas.index')->with('success', 'Berita berhasil diperbarui!');
}


    /**
     * Menghapus berita dari database.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        // 1. Hapus file foto terkait dari storage jika ada
        // $berita->foto sudah menyimpan path relatif (misal: berita_images/nama_file.jpg)
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
            Log::info("Foto berhasil dihapus saat destroy: " . $berita->foto);
        } else {
            Log::warning("Gagal menghapus foto saat destroy (file tidak ditemukan atau path kosong): " . $berita->foto);
        }

        // 2. Hapus record berita dari database
        $berita->delete();
        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dihapus!');
    }
}
