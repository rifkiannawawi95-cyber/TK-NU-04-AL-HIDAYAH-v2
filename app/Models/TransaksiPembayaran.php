<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembayarans';

    protected $fillable = [
        'no_transaksi',
        'tagihan_id',
        'siswa_id',
        'petugas_id',
        'tanggal_bayar',
        'nominal_bayar',
        'metode_bayar', // Tunai, Transfer BSI, QRIS
        'nama_penyetor',
        'catatan',
        'status_verifikasi', // Terverifikasi, Menunggu
    ];

    public function tagihan()
    {
        return $this->belongsTo(TagihanSiswa::class, 'tagihan_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}

