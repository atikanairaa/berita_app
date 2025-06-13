<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Berita; // Jangan lupa import model Berita

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard berdasarkan role user.
     * Admin akan melihat dashboard default (resources/views/dashboard.blade.php).
     * User biasa akan melihat dashboard dengan daftar berita (resources/views/dashboard/user_dashboard.blade.php).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user(); // User sudah dijamin ada karena middleware 'auth'

        // Ambil semua berita, diurutkan berdasarkan tanggal publikasi terbaru
        $beritas = Berita::orderBy('tanggal_publikasi', 'desc')->get();

        // Cek role user
        if ($user->role === 'user') {
            // Render dashboard khusus user biasa dengan daftar berita
            return view('dashboard.user', compact('beritas'));
        } elseif ($user->role === 'admin') {
            // Render dashboard default Laravel Breeze untuk admin.
            // Anda bisa membuat 'dashboard.admin_dashboard' jika ingin tampilan admin yang benar-benar berbeda.
            // Untuk saat ini, kita tetap melewatkan $beritas jika admin juga perlu melihatnya di dashboard mereka,
            // atau Anda bisa menghapusnya jika view 'dashboard' tidak memerlukannya.
            return view('dashboard.admin', compact('beritas'));
        }

        // Sebagai fallback jika role tidak cocok dengan 'user' atau 'admin',
        // meskipun seharusnya tidak tercapai jika semua user memiliki role yang valid.
        return view('dashboard');
    }
}
