<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ter_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('ptkp_categories');
            $table->bigInteger('min_salary');
            $table->bigInteger('max_salary')->nullable();
            $table->decimal('rate', 8, 4); // 0.25
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ter_rates');
    }
};
