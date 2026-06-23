<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Membuat akun admin default dan satu akun mahasiswa demo
     * (terhubung ke mahasiswa pertama dari MahasiswaSeeder) agar mudah didemokan.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'              => 'Administrator',
            'email'             => 'admin@siakad.ac.id',
            'password'          => Hash::make('admin123'),
            'role'              => 'admin',
            'npm'               => null,
            'email_verified_at' => now(),
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $npmPertama = DB::table('mahasiswa')->orderBy('npm')->value('npm');

        if ($npmPertama) {
            DB::table('users')->insert([
                'name'              => 'Mahasiswa Demo',
                'email'             => 'mahasiswa@siakad.ac.id',
                'password'          => Hash::make('mahasiswa123'),
                'role'              => 'mahasiswa',
                'npm'               => $npmPertama,
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
