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
        Schema::table('rekap_periodes', function (Blueprint $table) {
            $table->boolean('is_draft')->default(true)->after('periode');
        });

        // Set is_draft to false for already approved or rejected periods
        DB::table('rekap_periodes')
            ->where('is_approved', true)
            ->orWhere('is_rejected', true)
            ->update(['is_draft' => false]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_periodes', function (Blueprint $table) {
            $table->dropColumn('is_draft');
        });
    }
};
