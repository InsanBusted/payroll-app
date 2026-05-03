<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeKinerjaImport;
use App\Exports\EmployeeKinerjaExport;
use App\Models\Employee;
use App\Models\EmployeeKinerja;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $periode = $request->input('periode');
        $sort    = $request->input('sort', 'periode_desc');

        $query = EmployeeKinerja::with('employee')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('employee', function ($eq) use ($search) {
                    $eq->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%');
                });
            });

        // Filter by periode (format YYYY-MM)
        if ($periode) {
            $query->where('periode', $periode);
        }

        // Sort
        match ($sort) {
            'periode_asc'  => $query->orderBy('periode', 'asc'),
            'nama_asc'     => $query->join('employees', 'employee_kinerjas.employee_id', '=', 'employees.id')
                ->orderBy('employees.nama', 'asc')
                ->select('employee_kinerjas.*'),
            'nama_desc'    => $query->join('employees', 'employee_kinerjas.employee_id', '=', 'employees.id')
                ->orderBy('employees.nama', 'desc')
                ->select('employee_kinerjas.*'),
            default        => $query->orderBy('periode', 'desc'),
        };

        $kinerjas  = $query->paginate(10)->withQueryString();
        $employees = Employee::with('jabatan')->orderBy('nama', 'asc')->get();
        // dd($employees);

        // Daftar periode yang ada di DB untuk dropdown filter
        $availablePeriodes = EmployeeKinerja::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode');

        return view('kinerjas.index', compact('kinerjas', 'employees', 'availablePeriodes'));
    }

    public function show(EmployeeKinerja $kinerja)
    {
        $kinerja->load('employee.jabatan', 'employee.area');
        $rincian = $kinerja->rincianGajiList($kinerja->employee_id);

        return view('kinerjas.show', compact('kinerja', 'rincian'));
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
        $kinerja->delete($kinerja->id);

        return redirect()->route('kinerjas.index')
            ->with('success', 'Data kinerja berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:7',
            'file'    => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ], [
            'file.required' => 'File Excel wajib diunggah.',
            'file.mimes'    => 'Format file harus .xlsx, .xls, atau .csv.',
            'periode.required' => 'Periode wajib dipilih.',
        ]);

        $import = new EmployeeKinerjaImport($request->periode);
        Excel::import($import, $request->file('file'));

        $msg = "Import selesai: {$import->importedCount} data baru, {$import->updatedCount} diperbarui, {$import->skippedCount} dilewati.";

        if (!empty($import->errors)) {
            $errorList = implode(' | ', array_slice($import->errors, 0, 5));
            return redirect()->route('kinerjas.index')
                ->with('warning', $msg . ' Peringatan: ' . $errorList);
        }

        return redirect()->route('kinerjas.index')->with('success', $msg);
    }

    public function slip($id)
    {
        $kinerja = EmployeeKinerja::with([
            'employee',
            'employee.jabatan',
            'employee.area'
        ])->findOrFail($id);

        $rincian = $kinerja->rincianGajiList($kinerja->employee_id);

        return view('kinerjas.slip-preview', compact('kinerja', 'rincian'));
    }

    public function downloadSlip($id)
    {
        $kinerja = EmployeeKinerja::with([
            'employee',
            'employee.jabatan',
            'employee.area'
        ])->findOrFail($id);

        $rincian = $kinerja->rincianGajiList($kinerja->employee_id);

        $pdf = Pdf::loadView('kinerjas.slip-pdf', compact('kinerja', 'rincian'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Slip-Gaji-' . $kinerja->employee->nama . '.pdf');
    }


    public function transfer(EmployeeKinerja $kinerja)
    {
        $kinerja->update([
            'status_gaji'    => true,
            'transferred_by' => \Illuminate\Support\Facades\Auth::id(),
        ]);

        return back()->with('success', 'Gaji berhasil ditandai sudah ditransfer.');
    }

    public function terima(EmployeeKinerja $kinerja)
    {
        $kinerja->update([
            'status_diterima' => true
        ]);

        return back()->with('success', 'Gaji berhasil dikonfirmasi diterima.');
    }

    public function export(Request $request)
    {
        $periode = $request->input('periode');

        $filename = $periode
            ? 'laporan-kinerja-' . $periode . '.xlsx'
            : 'laporan-kinerja-semua.xlsx';

        return Excel::download(new EmployeeKinerjaExport($periode), $filename);
    }
}
