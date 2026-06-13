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
        Schema::create('ptkp_17_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->unique();
            $table->bigInteger('ptkp_setahun');
            $table->timestamps();
        });

        DB::table('ptkp_17_statuses')->insert([
            ['status' => 'TK/0', 'ptkp_setahun' => 54000000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'TK/1', 'ptkp_setahun' => 58500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'TK/2', 'ptkp_setahun' => 63000000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'TK/3', 'ptkp_setahun' => 67500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/0',  'ptkp_setahun' => 58500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/1',  'ptkp_setahun' => 63000000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/2',  'ptkp_setahun' => 67500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/3',  'ptkp_setahun' => 72000000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/I/0', 'ptkp_setahun' => 112500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/I/1', 'ptkp_setahun' => 117000000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/I/2', 'ptkp_setahun' => 121500000, 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'K/I/3', 'ptkp_setahun' => 126000000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ptkp_17_statuses');
    }
};
