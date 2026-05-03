<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->boolean('status_diterima')
                ->default(false)
                ->after('status_gaji')
                ->comment('false = belum dikonfirmasi staff, true = sudah diterima');
        });
    }

    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropColumn('status_diterima');
        });
    }
};