<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->integer('rate_lembur')
                ->default(0)
                ->after('rate_gaji_pokok')
                ->comment('Rate lembur per jam berdasarkan jabatan');
        });
    }

    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->dropColumn('rate_lembur');
        });
    }
};
