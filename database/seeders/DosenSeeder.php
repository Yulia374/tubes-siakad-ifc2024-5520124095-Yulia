<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        $nidn_list = [];
 
        for ($i = 0; $i < 10; $i++) {
            $nidn = $faker->unique()->numerify('##########');
            $nidn_list[] = $nidn;
 
            DB::table('dosen')->insert([
                'nidn'       => $nidn,
                'nama'       => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
