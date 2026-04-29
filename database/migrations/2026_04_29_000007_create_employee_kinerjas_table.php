<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            
            // Periode untuk pencatatan kinerja per bulan
            $table->string('periode', 7)->comment('Format: YYYY-MM');

            // Nilai Kinerja (Pengali)
            $table->integer('total_hadir')->default(0);
            $table->integer('tunjangan_groom')->default(0);
            $table->integer('srp')->default(0);
            $table->integer('grosir')->default(0);
            $table->integer('aksesoris')->default(0);
            $table->integer('bonus')->default(0)->comment('Bonus tambahan (Nominal)');
            
            // Potongan (Nominal atau jumlah, user bilang semua integer. Biasanya ini nominal yang diinput manual atau hasil hitungan)
            // Di sini saya asumsikan ini nominal atau frekuensi. User bilang: "untuk potongannya ada BPJSTK, Absensi, dan PPh21. semua nya dalam bentuk integer"
            $table->integer('bpjstk')->default(0);
            $table->integer('absensi')->default(0);
            $table->integer('pph21')->default(0);

            $table->timestamps();
            
            // Pastikan satu employee hanya punya satu kinerja per periode
            $table->unique(['employee_id', 'periode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_kinerjas');
    }
};
