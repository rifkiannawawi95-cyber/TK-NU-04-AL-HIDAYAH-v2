<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    use HasFactory;

    protected $table = 'tagihan_siswas';

    protected $fillable = [
        'no_tagihan',
        'siswa_id',
        'kategori_id',
        'periode_bulan',
        'tahun',
        'jumlah_tagihan',
        'jumlah_terbayar',
        'sisa_tagihan',
        'status_pembayaran', // Lunas, Belum Lunas, Cicilan
        'jatuh_tempo',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPembayaran::class, 'kategori_id');
    }

    public function transaksis()
    {
        return $this->hasMany(TransaksiPembayaran::class, 'tagihan_id');
    }
}

