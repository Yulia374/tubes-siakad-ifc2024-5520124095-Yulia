<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Jadwal;
use App\Models\Krs;

class JadwalLihatController extends Controller
{
    /**
     * Mahasiswa hanya bisa melihat (read-only) jadwal dari mata kuliah
     * yang sudah ia ambil di KRS miliknya sendiri.
     */
    public function index(Request $request)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_if(! $mahasiswa, 403, 'Akun Anda tidak terhubung dengan data mahasiswa manapun.');

        $kodeMkDiambil = Krs::where('npm', $mahasiswa->npm)->pluck('kode_matakuliah');

        $query = Jadwal::with(['matakuliah', 'dosen'])
            ->whereIn('kode_matakuliah', $kodeMkDiambil)
            ->where('kelas', $mahasiswa->kelas);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('hari', 'like', "%{$search}%")
                  ->orWhereHas('matakuliah', fn ($mk) => $mk->where('nama_matakuliah', 'like', "%{$search}%"))
                  ->orWhereHas('dosen', fn ($d) => $d->where('nama', 'like', "%{$search}%"));
            });
        }

        $semuaJadwal = $query->orderBy('hari')->orderBy('jam')->get();

        // Kelompokkan per mata kuliah, lalu paginate per kelompok (bukan per baris jadwal)
        // agar semua pilihan kelas dari 1 mata kuliah selalu tampil di halaman yang sama.
        $jadwalPerMatkul = $semuaJadwal->groupBy('kode_matakuliah');

        $perPage = 5;
        $page = $request->input('page', 1);
        $items = $jadwalPerMatkul->forPage($page, $perPage);

        $dataJadwal = new LengthAwarePaginator(
            $items,
            $jadwalPerMatkul->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('jadwal.mahasiswa-index', compact('dataJadwal'));
    }
}

