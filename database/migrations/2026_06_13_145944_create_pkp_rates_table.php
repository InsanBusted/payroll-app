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
        Schema::create('pkp_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('start');
            $table->bigInteger('end')->nullable();
            $table->decimal('percent', 8, 4);
            $table->timestamps();
        });

        DB::table('pkp_rates')->insert([
            ['start' => 0, 'end' => 60000000, 'percent' => 0.05, 'created_at' => now(), 'updated_at' => now()],
            ['start' => 60000000, 'end' => 250000000, 'percent' => 0.15, 'created_at' => now(), 'updated_at' => now()],
            ['start' => 250000000, 'end' => 500000000, 'percent' => 0.25, 'created_at' => now(), 'updated_at' => now()],
            ['start' => 500000000, 'end' => 5000000000, 'percent' => 0.30, 'created_at' => now(), 'updated_at' => now()],
            ['start' => 5000000000, 'end' => null, 'percent' => 0.35, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkp_rates');
    }
};
