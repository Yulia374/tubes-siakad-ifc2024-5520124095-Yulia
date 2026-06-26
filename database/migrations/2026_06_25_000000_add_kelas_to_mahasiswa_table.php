<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Kelas mahasiswa (A/B/C/D), diisi setelah kolom nidn.
            // Default 'A' agar data lama yang sudah ada tidak NULL.
            $table->char('kelas', 1)->default('A')->after('nidn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('kelas');
        });
    }
};
