<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->integer('lembur')
                ->default(0)
                ->after('total_hadir')
                ->comment('Jumlah jam lembur');

            $table->integer('rate_lembur')
                ->nullable()
                ->after('lembur')
                ->comment('Rate lembur per jam (snapshot dari jabatan)');
        });
    }

    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropColumn(['lembur', 'rate_lembur']);
        });
    }
};
