<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->enum('status_karyawan', ['tetap', 'tidak_tetap'])
                ->default('tetap')
                ->after('join_date')
                ->comment('Status kepegawaian: tetap atau tidak tetap');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('status_karyawan');
        });
    }
};
