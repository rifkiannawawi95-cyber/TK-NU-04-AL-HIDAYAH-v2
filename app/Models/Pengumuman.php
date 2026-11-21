<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'slug',
        'kategori', // Akademik, Hari Libur, Himbauan, Parenting
        'target_audiens', // Semua, Wali Murid, Dewan Guru
        'isi_pengumuman',
        'file_lampiran',
        'is_published',
        'published_at',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

