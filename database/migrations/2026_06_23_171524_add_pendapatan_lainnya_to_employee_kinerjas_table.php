<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->integer('pendapatan_lainnya')
                ->default(0)
                ->after('bonus')
                ->comment('Pendapatan lainnya (nominal langsung)');
        });
    }

    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropColumn('pendapatan_lainnya');
        });
    }
};
