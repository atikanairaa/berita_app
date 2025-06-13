<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'beritas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'foto',
        'penulis',
        'tanggal_publikasi',
        'isi_berita',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    // Jika Anda ingin menambahkan relasi atau metode kustom lainnya, Anda bisa menambahkannya di sini.
    // Contoh: Jika ada relasi dengan user yang membuat berita
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id'); // asumsi ada kolom user_id di tabel beritas
    // }
}
