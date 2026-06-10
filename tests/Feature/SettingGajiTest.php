<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\Pph21Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingGajiTest extends TestCase
{
    use RefreshDatabase;

    public function test_setting_gaji_page_displays_pph21_information(): void
    {
        $this->seed(Pph21Seeder::class);

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/setting-gaji');

        $response->assertOk();
        $response->assertViewHas('ptkpCategories');
        $response->assertSee('Informasi Penghitungan PPh21 (TER)');
        $response->assertSee('Kategori A');
        $response->assertSee('TK/0, TK/1, K/0');
    }
}
