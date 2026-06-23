<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        $kode_matakuliah_list = DB::table('matakuliah')->pluck('kode_matakuliah')->toArray();
        $nidn_list            = DB::table('dosen')->pluck('nidn')->toArray();
 
        $hari_list  = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $kelas_list = ['A', 'B', 'C', 'D'];
 
        for ($i = 0; $i < 10; $i++) {
            DB::table('jadwal')->insert([
                'kode_matakuliah' => $faker->randomElement($kode_matakuliah_list),
                'nidn'            => $faker->randomElement($nidn_list),
                'kelas'           => $faker->randomElement($kelas_list),
                'hari'            => $faker->randomElement($hari_list),
                'jam'             => $faker->dateTimeBetween('2024-01-01 07:00:00', '2024-12-31 17:00:00'),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
