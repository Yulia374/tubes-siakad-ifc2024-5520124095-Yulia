<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;

class DashboardController extends Controller
{
    /**
     * Dashboard untuk Admin: berisi ringkasan statistik seluruh data.
     */
    public function admin()
    {
        $totalDosen      = Dosen::count();
        $totalMahasiswa  = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();
        $totalJadwal     = Jadwal::count();
        $totalKrs        = Krs::count();

        $aktivitasTerbaru = Krs::with(['mahasiswa', 'matakuliah'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalMatakuliah',
            'totalJadwal',
            'totalKrs',
            'aktivitasTerbaru'
        ));
    }

    /**
     * Dashboard untuk Mahasiswa: ringkasan KRS & jadwal miliknya sendiri.
     */
    public function mahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $krsList = collect();
        $totalSks = 0;
        $jadwalHariIni = collect();

        if ($mahasiswa) {
            $krsList  = Krs::with('matakuliah')->where('npm', $mahasiswa->npm)->get();
            $totalSks = $krsList->sum(fn ($krs) => $krs->matakuliah->sks ?? 0);

            $kodeMkDiambil = $krsList->pluck('kode_matakuliah');
            $hariIni = now()->translatedFormat('l');

            $jadwalHariIni = Jadwal::with(['matakuliah', 'dosen'])
                ->whereIn('kode_matakuliah', $kodeMkDiambil)
                ->where('kelas', $mahasiswa->kelas)
                ->where('hari', $hariIni)
                ->orderBy('jam')
                ->get();
        }

        return view('dashboard.mahasiswa', compact('mahasiswa', 'krsList', 'totalSks', 'jadwalHariIni'));
    }
}
