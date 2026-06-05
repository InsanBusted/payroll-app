<?php

namespace App\Http\Controllers;

use App\Models\EmployeeKinerja;
use App\Models\RekapPeriode;
use App\Models\SettingGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapPeriodeController extends Controller
{
    /**
     * Daftar semua rekap periode — dapat diakses direktur & finance.
     */
    public function index()
    {
        // Sync: pastikan semua periode di employee_kinerjas sudah ada di rekap_periodes
        $periodesDiKinerja = EmployeeKinerja::select('periode')
            ->distinct()
            ->pluck('periode');

        foreach ($periodesDiKinerja as $periode) {
            RekapPeriode::firstOrCreate(
                ['periode' => $periode],
                ['is_approved' => false, 'is_rejected' => false]
            );
        }

        // Ambil semua rekap periode, urutkan terbaru
        $rekaps = RekapPeriode::orderBy('periode', 'desc')->get()->map(function ($rekap) {
            $rekap->jumlah_karyawan = EmployeeKinerja::where('periode', $rekap->periode)->count();
            return $rekap;
        });

        $isDirektur = Auth::user()->hasRole('direktur');

        return view('rekap_periodes.index', compact('rekaps', 'isDirektur'));
    }

    /**
     * Detail satu periode — dapat diakses direktur & finance.
     */
    public function show(RekapPeriode $rekapPeriode)
    {
        $kinerjas = EmployeeKinerja::with(['employee.jabatan', 'employee.area'])
            ->where('periode', $rekapPeriode->periode)
            ->join('employees', 'employee_kinerjas.employee_id', '=', 'employees.id')
            ->orderBy('employees.nama', 'asc')
            ->select('employee_kinerjas.*')
            ->get();

        $setting    = SettingGaji::first();
        $isDirektur = Auth::user()->hasRole('direktur');

        return view('rekap_periodes.show', compact('rekapPeriode', 'kinerjas', 'setting', 'isDirektur'));
    }

    /**
     * Approve rekap periode — hanya direktur.
     */
    public function approve(RekapPeriode $rekapPeriode)
    {
        if ($rekapPeriode->is_approved) {
            return back()->with('warning', 'Rekap periode ini sudah disetujui sebelumnya.');
        }

        $rekapPeriode->update([
            'is_approved'   => true,
            'approved_by'   => Auth::id(),
            'approved_at'   => now(),
            // reset penolakan jika sebelumnya ditolak
            'is_rejected'   => false,
            'rejected_by'   => null,
            'rejected_at'   => null,
            'catatan_tolak' => null,
        ]);

        return back()->with('success', "Rekap periode {$rekapPeriode->label} berhasil disetujui.");
    }

    /**
     * Tolak rekap periode dengan catatan — hanya direktur.
     */
    public function reject(Request $request, RekapPeriode $rekapPeriode)
    {
        $request->validate([
            'catatan_tolak' => 'required|string|max:1000',
        ], [
            'catatan_tolak.required' => 'Catatan penolakan wajib diisi.',
            'catatan_tolak.max'      => 'Catatan maksimal 1000 karakter.',
        ]);

        $rekapPeriode->update([
            'is_rejected'   => true,
            'rejected_by'   => Auth::id(),
            'rejected_at'   => now(),
            'catatan_tolak' => $request->catatan_tolak,
            // pastikan tidak dalam keadaan approved
            'is_approved'   => false,
            'approved_by'   => null,
            'approved_at'   => null,
        ]);

        return back()->with('success', "Rekap periode {$rekapPeriode->label} berhasil ditolak.");
    }
}
