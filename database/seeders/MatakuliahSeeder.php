<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matakuliah = [
            ['kode_matakuliah' => 'MK000001', 'nama_matakuliah' => 'Pemrograman Web Lanjutan', 'sks' => 3],
            ['kode_matakuliah' => 'MK000002', 'nama_matakuliah' => 'Basis Data',               'sks' => 3],
            ['kode_matakuliah' => 'MK000003', 'nama_matakuliah' => 'Struktur Data',             'sks' => 3],
            ['kode_matakuliah' => 'MK000004', 'nama_matakuliah' => 'Jaringan Komputer',         'sks' => 2],
            ['kode_matakuliah' => 'MK000005', 'nama_matakuliah' => 'Multimedia',                'sks' => 3],
        ];
 
        foreach ($matakuliah as $mk) {
            DB::table('matakuliah')->insert([
                'kode_matakuliah' => $mk['kode_matakuliah'],
                'nama_matakuliah' => $mk['nama_matakuliah'],
                'sks'             => $mk['sks'],
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
