<?php

namespace App\Http\Controllers;

use App\Models\EmployeeKinerja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffKinerjaController extends Controller
{
    /**
     * Tampilkan daftar kinerja milik staff yang sedang login.
     */
    public function index(Request $request)
    {
        $user     = Auth::user();
        $employee = $user->employee;

        if (!$employee) {
            return view('staff.kinerja', [
                'employee' => null,
                'kinerjas' => collect(),
                'selected' => null,
            ]);
        }

        // Ambil semua periode yang tersedia untuk karyawan ini
        $periodes = EmployeeKinerja::query()->where('employee_id', $employee->id)
            ->orderByDesc('periode')
            ->pluck('periode');

        // Pilih periode dari request atau default ke terbaru
        $selected = $request->input('periode', $periodes->first());

        $kinerja = null;
        if ($selected) {
            $kinerja = EmployeeKinerja::query()->where('employee_id', $employee->id)
                ->where('periode', $selected)
                ->first();
        }

        return view('staff.kinerja', compact('employee', 'periodes', 'selected', 'kinerja'));
    }

    /**
     * Preview slip gaji milik staff yang sedang login.
     * Validasi: kinerja harus milik employee yang login.
     */
    public function slip($id)
    {
        $employee = Auth::user()->employee;

        $kinerja = EmployeeKinerja::with([
            'employee',
            'employee.jabatan',
            'employee.area',
            'employee.ptkpStatus',
        ])->where('employee_id', $employee?->id)
            ->findOrFail($id);

        $rincian = $kinerja->rincianGaji();

        return view('kinerjas.slip-preview', compact('kinerja', 'rincian'));
    }

    /**
     * Download PDF slip gaji milik staff yang sedang login.
     * Validasi: kinerja harus milik employee yang login.
     */
    public function downloadSlip($id)
    {
        $employee = Auth::user()->employee;

        $kinerja = EmployeeKinerja::with([
            'employee',
            'employee.jabatan',
            'employee.area',
            'employee.ptkpStatus',
        ])->where('employee_id', $employee?->id)
            ->findOrFail($id);

        $rincian = $kinerja->rincianGaji();

        $pdf = Pdf::loadView('kinerjas.slip-pdf', compact('kinerja', 'rincian'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Slip-Gaji-' . $kinerja->employee->nama . '-' . $kinerja->periode . '.pdf');
    }
}
