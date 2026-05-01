<?php

namespace App\Http\Controllers;

use App\Models\SettingGaji;
use Illuminate\Http\Request;

class SettingGajiController extends Controller
{
    public function index()
    {
        // Ambil setting gaji pertama, jika tidak ada, buat dengan nilai default
        $setting = SettingGaji::query()->first() ?? SettingGaji::create([
            'rate_gaji_pokok' => 30000,
            'rate_tunjangan_groom' => 10000,
            'rate_srp' => 30000,
            'rate_grosir' => 10000,
            'rate_aksesoris' => 5000,
            'potongan_bpjstk' => 50000,
            'potongan_absensi' => 10000,
            'bebas_bpjstk_bulan'   => 3,
        ]);

        return view('setting_gajis.index', compact('setting'));
    }

    public function update(Request $request, SettingGaji $settingGaji)
    {
        $request->validate([
            'rate_gaji_pokok' => 'required|integer|min:0',
            'rate_tunjangan_groom' => 'required|integer|min:0',
            'rate_srp' => 'required|integer|min:0',
            'rate_grosir' => 'required|integer|min:0',
            'rate_aksesoris' => 'required|integer|min:0',
            'potongan_bpjstk' => 'required|integer|min:0',
            'potongan_absensi' => 'required|integer|min:0',
            'bebas_bpjstk_bulan'   => 'required|integer|min:1',
        ]);

        $settingGaji->update($request->all());

        return back()->with('success', 'Setting Master Gaji berhasil diperbarui.');
    }
}
