<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            UPDATE employees SET ptkp_17_status_id = (
                SELECT p17.id
                FROM ptkp_statuses ps
                JOIN ptkp_17_statuses p17 ON ps.status = p17.status
                WHERE ps.id = employees.ptkp_status_id
            )
            WHERE ptkp_status_id IS NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('employees')->update(['ptkp_17_status_id' => null]);
    }
};
