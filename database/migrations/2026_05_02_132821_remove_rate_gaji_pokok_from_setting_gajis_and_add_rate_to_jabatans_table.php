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
        // Hapus column dari setting_gajis
        Schema::table('setting_gajis', function (Blueprint $table) {
            $table->dropColumn('rate_gaji_pokok');
        });

        // Tambahkan ke tabel jabatans
        Schema::table('jabatans', function (Blueprint $table) {
            $table->integer('rate_gaji_pokok')
                ->default(30000)
                ->after('deskripsi')
                ->comment('Rate gaji pokok berdasarkan jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Balikin ke setting_gajis
        Schema::table('setting_gajis', function (Blueprint $table) {
            $table->integer('rate_gaji_pokok')
                ->default(30000)
                ->comment('Rate per hari hadir');
        });

        // Hapus dari jabatans
        Schema::table('jabatans', function (Blueprint $table) {
            $table->dropColumn('rate_gaji_pokok');
        });
    }
};
