<?php

namespace App\Http\Controllers;

use App\Models\EmployeeKinerja;
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
}
