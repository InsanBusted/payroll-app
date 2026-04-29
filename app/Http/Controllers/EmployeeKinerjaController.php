<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeKinerja;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $kinerjas = EmployeeKinerja::with('employee')
            ->orderBy('periode', 'desc')
            ->latest()
            ->paginate(10);
            
        $employees = Employee::orderBy('nama')->get();

        return view('kinerjas.index', compact('kinerjas', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'periode'         => [
                'required',
                'string',
                'max:7', // YYYY-MM
                Rule::unique('employee_kinerjas')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)
                                 ->where('periode', $request->periode);
                }),
            ],
            'total_hadir'     => 'required|integer|min:0',
            'tunjangan_groom' => 'required|integer|min:0',
            'srp'             => 'required|integer|min:0',
            'grosir'          => 'required|integer|min:0',
            'aksesoris'       => 'required|integer|min:0',
            'bonus'           => 'nullable|integer|min:0',
            'bpjstk'          => 'nullable|integer|min:0',
            'absensi'         => 'nullable|integer|min:0',
            'pph21'           => 'nullable|integer|min:0',
        ]);

        EmployeeKinerja::create([
            'employee_id'     => $request->employee_id,
            'periode'         => $request->periode,
            'total_hadir'     => $request->total_hadir,
            'tunjangan_groom' => $request->tunjangan_groom,
            'srp'             => $request->srp,
            'grosir'          => $request->grosir,
            'aksesoris'       => $request->aksesoris,
            'bonus'           => $request->bonus ?? 0,
            'bpjstk'          => $request->bpjstk ?? 0,
            'absensi'         => $request->absensi ?? 0,
            'pph21'           => $request->pph21 ?? 0,
        ]);

        return redirect()->route('kinerjas.index')
            ->with('success', 'Data kinerja berhasil ditambahkan.');
    }

    public function update(Request $request, EmployeeKinerja $kinerja)
    {
        $request->validate([
            'employee_id'     => 'required|exists:employees,id',
            'periode'         => [
                'required',
                'string',
                'max:7',
                Rule::unique('employee_kinerjas')->where(function ($query) use ($request) {
                    return $query->where('employee_id', $request->employee_id)
                                 ->where('periode', $request->periode);
                })->ignore($kinerja->id),
            ],
            'total_hadir'     => 'required|integer|min:0',
            'tunjangan_groom' => 'required|integer|min:0',
            'srp'             => 'required|integer|min:0',
            'grosir'          => 'required|integer|min:0',
            'aksesoris'       => 'required|integer|min:0',
            'bonus'           => 'nullable|integer|min:0',
            'bpjstk'          => 'nullable|integer|min:0',
            'absensi'         => 'nullable|integer|min:0',
            'pph21'           => 'nullable|integer|min:0',
        ]);

        $kinerja->update([
            'employee_id'     => $request->employee_id,
            'periode'         => $request->periode,
            'total_hadir'     => $request->total_hadir,
            'tunjangan_groom' => $request->tunjangan_groom,
            'srp'             => $request->srp,
            'grosir'          => $request->grosir,
            'aksesoris'       => $request->aksesoris,
            'bonus'           => $request->bonus ?? 0,
            'bpjstk'          => $request->bpjstk ?? 0,
            'absensi'         => $request->absensi ?? 0,
            'pph21'           => $request->pph21 ?? 0,
        ]);

        return redirect()->route('kinerjas.index')
            ->with('success', 'Data kinerja berhasil diperbarui.');
    }

    public function destroy(EmployeeKinerja $kinerja)
    {
        $kinerja->delete();

        return redirect()->route('kinerjas.index')
            ->with('success', 'Data kinerja berhasil dihapus.');
    }
}
