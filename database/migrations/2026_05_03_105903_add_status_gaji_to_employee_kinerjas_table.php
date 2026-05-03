<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->boolean('status_gaji')
                ->default(false)
                ->after('pph21')
                ->comment('false = belum ditransfer, true = sudah ditransfer');
        });
    }

    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropColumn('status_gaji');
        });
    }
};