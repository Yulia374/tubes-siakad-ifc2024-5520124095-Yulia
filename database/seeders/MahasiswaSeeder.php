<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        $nidn_list = DB::table('dosen')->pluck('nidn')->toArray();
 
        for ($i = 0; $i < 10; $i++) {
            DB::table('mahasiswa')->insert([
                'npm'        => $faker->unique()->numerify('##########'),
                'nidn'       => $faker->randomElement($nidn_list),
                'nama'       => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
