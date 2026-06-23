<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class KrsController extends Controller
{
    /**
     * Halaman khusus Admin: melihat seluruh data KRS semua mahasiswa.
     */
    public function index(Request $request)
    {
        $query = Krs::with(['mahasiswa', 'matakuliah']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', fn ($m) => $m->where('nama', 'like', "%{$search}%"))
                  ->orWhereHas('matakuliah', fn ($mk) => $mk->where('nama_matakuliah', 'like', "%{$search}%"));
            });
        }

        $dataKrs = $query->orderBy('id', 'asc')->get();
        return view('krs.index', compact('dataKrs'));
    }

    public function show(string $id)
    {
        $detailKrs = Krs::with(['mahasiswa', 'matakuliah'])->findOrFail($id);
        return view('krs.detail', compact('detailKrs'));
    }

    /**
     * Admin tetap dapat menghapus KRS jika diperlukan (misal data salah input).
     */
    public function destroy(string $id)
    {
        $krs = Krs::findOrFail($id);
        $krs->delete();
        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus');
    }
}