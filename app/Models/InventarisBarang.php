<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisBarang extends Model
{
    use HasFactory;

    protected $table = 'inventaris_barangs';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_barang', // APE Luar, APE Dalam, Mebel, Elektronik, Buku & Media
        'jumlah_total',
        'satuan', // Unit, Set, Buah, Pcs
        'kondisi_baik',
        'kondisi_rusak_ringan',
        'kondisi_rusak_berat',
        'lokasi_penyimpanan',
        'sumber_pengadaan', // BOP PAUD, Infaq Wali Murid, Yayasan LP Ma'arif
        'tahun_pengadaan',
    ];
}

