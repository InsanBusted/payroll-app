<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            // User yang mengkonfirmasi transfer gaji
            $table->foreignId('transferred_by')
                  ->nullable()
                  ->after('status_gaji')
                  ->constrained('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('employee_kinerjas', function (Blueprint $table) {
            $table->dropForeign(['transferred_by']);
            $table->dropColumn('transferred_by');
        });
    }
};
