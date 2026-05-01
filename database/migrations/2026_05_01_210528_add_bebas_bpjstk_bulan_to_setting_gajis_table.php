<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('setting_gajis', function (Blueprint $table) {
            $table->unsignedInteger('bebas_bpjstk_bulan')->default(3)->after('potongan_absensi');
        });
    }

    public function down(): void
    {
        Schema::table('setting_gajis', function (Blueprint $table) {
            $table->dropColumn('bebas_bpjstk_bulan');
        });
    }
};