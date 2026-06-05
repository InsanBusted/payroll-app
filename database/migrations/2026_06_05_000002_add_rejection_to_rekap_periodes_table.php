<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rekap_periodes', function (Blueprint $table) {
            $table->boolean('is_rejected')->default(false)->after('is_approved');
            $table->foreignId('rejected_by')->nullable()->constrained('users')->nullOnDelete()->after('is_rejected');
            $table->timestamp('rejected_at')->nullable()->after('rejected_by');
            $table->text('catatan_tolak')->nullable()->after('rejected_at');
        });
    }

    public function down(): void
    {
        Schema::table('rekap_periodes', function (Blueprint $table) {
            $table->dropForeign(['rejected_by']);
            $table->dropColumn(['is_rejected', 'rejected_by', 'rejected_at', 'catatan_tolak']);
        });
    }
};
