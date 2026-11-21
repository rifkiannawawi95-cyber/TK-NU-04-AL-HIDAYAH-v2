<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPembayaran extends Model
{
    use HasFactory;

    protected $table = 'kategori_pembayarans';

    protected $fillable = [
        'kode_biaya',
        'nama_biaya',
        'tipe', // Bulanan, Sekali Bayar, Sukarela
        'nominal_default',
        'deskripsi',
    ];

    public function tagihans()
    {
        return $this->hasMany(TagihanSiswa::class, 'kategori_id');
    }
}

