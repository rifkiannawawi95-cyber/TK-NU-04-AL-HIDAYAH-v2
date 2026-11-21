<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Testimoni::query();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        $search = $request->get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('peran', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $testimonis = $query->orderBy('is_approved', 'asc') // Pending first
                            ->orderBy('created_at', 'desc')
                            ->paginate(12)
                            ->withQueryString();

        $totalCount = Testimoni::count();
        $pendingCount = Testimoni::where('is_approved', false)->count();
        $approvedCount = Testimoni::where('is_approved', true)->count();

        return view('admin.testimoni.index', compact(
            'testimonis',
            'status',
            'search',
            'totalCount',
            'pendingCount',
            'approvedCount'
        ));
    }

    public function approve(Testimoni $testimoni)
    {
        $testimoni->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', "Testimoni dari {$testimoni->nama} telah disetujui dan kini tayang di website publik!");
    }

    public function reject(Testimoni $testimoni)
    {
        $testimoni->update([
            'is_approved' => false,
            'approved_at' => null,
        ]);

        return redirect()->back()->with('success', "Testimoni dari {$testimoni->nama} ditarik dari publik dan berstatus Menunggu Persetujuan.");
    }

    public function destroy(Testimoni $testimoni)
    {
        $nama = $testimoni->nama;
        $testimoni->delete();

        return redirect()->back()->with('success', "Testimoni dari {$nama} berhasil dihapus.");
    }
}
