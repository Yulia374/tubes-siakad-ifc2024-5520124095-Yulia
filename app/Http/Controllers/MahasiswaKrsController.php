<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Krs;
use App\Models\Matakuliah;

class MahasiswaKrsController extends Controller
{
    /**
     * Pastikan user yang login punya data mahasiswa terkait, lalu kembalikan NPM-nya.
     */
    private function npmAktif()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_if(! $mahasiswa, 403, 'Akun Anda tidak terhubung dengan data mahasiswa manapun. Hubungi admin.');

        return $mahasiswa->npm;
    }

    /**
     * Lihat daftar KRS milik sendiri.
     */
    public function index()
    {
        $npm = $this->npmAktif();

        $dataKrs  = Krs::with('matakuliah')->where('npm', $npm)->get();
        $totalSks = $dataKrs->sum(fn ($krs) => $krs->matakuliah->sks ?? 0);

        return view('krs.mahasiswa-index', compact('dataKrs', 'totalSks'));
    }

    /**
     * Form ambil mata kuliah baru.
     */
    public function create()
    {
        $npm = $this->npmAktif();

        $kodeSudahDiambil = Krs::where('npm', $npm)->pluck('kode_matakuliah');
        $matakuliah = Matakuliah::whereNotIn('kode_matakuliah', $kodeSudahDiambil)->get();

        return view('krs.mahasiswa-create', compact('matakuliah'));
    }

    /**
     * Simpan pengambilan mata kuliah (input KRS) untuk mahasiswa yang login.
     */
    public function store(Request $request)
    {
        $npm = $this->npmAktif();

        $validated = $request->validate(
            [
                'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            ],
            [
                'kode_matakuliah.required' => 'Matakuliah harus dipilih',
                'kode_matakuliah.exists'   => 'Matakuliah tidak ditemukan',
            ]
        );

        $sudahAmbil = Krs::where('npm', $npm)
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if ($sudahAmbil) {
            return back()->withErrors(['kode_matakuliah' => 'Anda sudah mengambil matakuliah ini sebelumnya.']);
        }

        Krs::create([
            'npm'             => $npm,
            'kode_matakuliah' => $validated['kode_matakuliah'],
        ]);

        return redirect()->route('krs.mahasiswa.index')->with('success', 'Matakuliah berhasil diambil dan ditambahkan ke KRS Anda');
    }

    /**
     * Drop (hapus) mata kuliah dari KRS milik sendiri.
     * Diberi pengecekan agar mahasiswa tidak bisa drop KRS milik orang lain.
     */
    public function destroy(string $id)
    {
        $npm = $this->npmAktif();

        $krs = Krs::where('id', $id)->where('npm', $npm)->firstOrFail();
        $krs->delete();

        return redirect()->route('krs.mahasiswa.index')->with('success', 'Matakuliah berhasil di-drop dari KRS Anda');
    }
}
