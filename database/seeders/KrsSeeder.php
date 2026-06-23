<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        $npm_list = DB::table('mahasiswa')->pluck('npm')->toArray();
        $kode_matakuliah_list = DB::table('matakuliah')->pluck('kode_matakuliah')->toArray();
 
        $inserted = [];
 
        for ($i = 0; $i < 15; $i++) {
            $npm             = $faker->randomElement($npm_list);
            $kode_matakuliah = $faker->randomElement($kode_matakuliah_list);
 
            $key = $npm . '_' . $kode_matakuliah;
            if (in_array($key, $inserted)) {
                continue;
            }
            $inserted[] = $key;
 
            DB::table('krs')->insert([
                'npm'             => $npm,
                'kode_matakuliah' => $kode_matakuliah,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
