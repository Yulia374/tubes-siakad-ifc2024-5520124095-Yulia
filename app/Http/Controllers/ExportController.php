<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KrsExport;
use App\Models\Krs;

class ExportController extends Controller
{
    /**
     * [ADMIN] Export seluruh data KRS ke PDF.
     */
    public function krsAllPdf()
    {
        $dataKrs = Krs::with(['mahasiswa', 'matakuliah'])->orderBy('npm')->get();

        $pdf = Pdf::loadView('export.krs-all-pdf', compact('dataKrs'))->setPaper('a4', 'portrait');

        return $pdf->download('rekap-krs-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * [ADMIN] Export seluruh data KRS ke Excel.
     */
    public function krsAllExcel()
    {
        return Excel::download(new KrsExport, 'rekap-krs-' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * [MAHASISWA] Export KRS milik sendiri ke PDF.
     */
    public function krsSayaPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        abort_if(! $mahasiswa, 403, 'Akun Anda tidak terhubung dengan data mahasiswa manapun.');

        $krsList  = Krs::with('matakuliah')->where('npm', $mahasiswa->npm)->get();
        $totalSks = $krsList->sum(fn ($krs) => $krs->matakuliah->sks ?? 0);

        $pdf = Pdf::loadView('export.krs-mahasiswa-pdf', compact('mahasiswa', 'krsList', 'totalSks'))->setPaper('a4', 'portrait');

        return $pdf->download('krs-' . $mahasiswa->npm . '.pdf');
    }
}
