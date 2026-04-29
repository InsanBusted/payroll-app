<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setting_gajis', function (Blueprint $table) {
            $table->id();
            $table->integer('rate_gaji_pokok')->default(30000)->comment('Rate per hari hadir');
            $table->integer('rate_tunjangan_groom')->default(10000)->comment('Rate per point tunjangan groom');
            $table->integer('rate_srp')->default(30000)->comment('Rate per point SRP');
            $table->integer('rate_grosir')->default(10000)->comment('Rate per point Grosir');
            $table->integer('rate_aksesoris')->default(5000)->comment('Rate per point Aksesoris');
            $table->integer('potongan_bpjstk')->default(50000)->comment('Potongan tetap BPJSTK');
            $table->integer('potongan_absensi')->default(10000)->comment('Potongan per hari absen/telat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setting_gajis');
    }
};
