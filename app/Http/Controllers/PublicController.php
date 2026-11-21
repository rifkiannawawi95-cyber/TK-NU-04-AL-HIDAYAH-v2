<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\KalenderAkademik;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Tampilan Beranda Utama (Landing Page)
     */
    public function home()
    {
        $totalSiswa = Siswa::where('is_active', true)->count();
        if ($totalSiswa === 0) {
            $totalSiswa = Siswa::count() ?: 72;
        }

        $totalGuru = Guru::where(function ($q) {
            $q->where('is_active', true)->orWhere('is_active', 1)->orWhereNull('is_active');
        })->count();
        if ($totalGuru === 0) {
            $totalGuru = Guru::count() ?: 8;
        }

        $totalPrestasi = Prestasi::count() ?: 5;
        $totalAcara = Acara::count() ?: 12;

        $acaras = Acara::orderBy('tanggal', 'desc')->take(3)->get();
        $prestasis = Prestasi::orderBy('tanggal', 'desc')->take(6)->get();
        $galeris = Galeri::latest()->take(6)->get();
        $kalenders = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->take(4)->get();
        $gurus = Guru::where(function ($q) {
            $q->where('is_active', true)->orWhere('is_active', 1)->orWhereNull('is_active');
        })->take(4)->get();
        $testimonis = Testimoni::approved()->take(6)->get();

        return view('public.home', compact(
            'totalSiswa',
            'totalGuru',
            'totalPrestasi',
            'totalAcara',
            'acaras',
            'prestasis',
            'galeris',
            'kalenders',
            'gurus',
            'testimonis'
        ));
    }

    public function profil()
    {
        $gurus = Guru::where(function ($q) {
            $q->where('is_active', true)->orWhere('is_active', 1)->orWhereNull('is_active');
        })->get();
        return view('public.profil', compact('gurus'));
    }

    public function acara()
    {
        $acaras = Acara::orderBy('tanggal', 'desc')->paginate(9);
        return view('public.acara', compact('acaras'));
    }

    public function prestasi()
    {
        $prestasis = Prestasi::orderBy('tanggal', 'desc')->paginate(9);
        return view('public.prestasi', compact('prestasis'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('public.galeri', compact('galeris'));
    }

    public function kalender()
    {
        $kalenders = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();
        return view('public.kalender', compact('kalenders'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }

    /**
     * Simpan komentar / testimoni dari wali santri di website publik.
     * Masuk ke status pending (menunggu persetujuan admin).
     */
    public function storeTestimoni(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'peran' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'pesan' => 'required|string|min:5|max:1000',
        ], [
            'nama.required' => 'Mohon isi nama Ayah / Bunda.',
            'peran.required' => 'Pilih peran atau hubungan dengan santri.',
            'rating.required' => 'Pilih rating kepuasan bintang.',
            'pesan.required' => 'Tuliskan kesan atau pesan pengalaman Anda.',
            'pesan.min' => 'Pesan minimal 5 karakter.',
            'pesan.max' => 'Pesan maksimal 1000 karakter.',
        ]);

        Testimoni::create([
            'nama' => strip_tags(trim($validated['nama'])),
            'peran' => strip_tags(trim($validated['peran'])),
            'rating' => (int) $validated['rating'],
            'pesan' => strip_tags(trim($validated['pesan'])),
            'is_approved' => false,
        ]);

        return redirect()->to(url()->previous() . '#testimoni')
            ->with('testimoni_success', 'Terima kasih banyak Ayah / Bunda! Komentar & ulasan Anda telah kami terima dan akan segera ditampilkan di website setelah disetujui oleh Administrator sekolah.');
    }
}
