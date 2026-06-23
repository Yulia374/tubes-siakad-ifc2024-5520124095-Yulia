<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KrsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * Ambil seluruh data KRS beserta relasinya.
     */
    public function collection()
    {
        return Krs::with(['mahasiswa', 'matakuliah'])->orderBy('npm')->get();
    }

    /**
     * Judul kolom pada file Excel.
     */
    public function headings(): array
    {
        return [
            'No',
            'NPM',
            'Nama Mahasiswa',
            'Kode Mata Kuliah',
            'Nama Mata Kuliah',
            'SKS',
            'Tanggal Diambil',
        ];
    }

    /**
     * Mapping setiap baris data KRS menjadi baris Excel.
     */
    public function map($krs): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $krs->npm,
            $krs->mahasiswa->nama ?? '-',
            $krs->kode_matakuliah,
            $krs->matakuliah->nama_matakuliah ?? '-',
            $krs->matakuliah->sks ?? '-',
            $krs->created_at->translatedFormat('d F Y'),
        ];
    }

    /**
     * Styling sederhana: header bold + center.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 11],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}
