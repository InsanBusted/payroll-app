<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeKinerjaImport;
use App\Models\Employee;
use App\Models\EmployeeKinerja;
use App\Models\RekapPeriode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeKinerjaController extends Controller
{
    public function index(Request $request)
    {
        $search        = $request->input('search');
        $periodeDari   = $request->input('periode_dari');
        $periodeSampai = $request->input('periode_sampai');
        $sort          = $request->input('sort', 'periode_desc');

        $query = EmployeeKinerja::with('employee')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('employee', function ($eq) use ($search) {
                    $eq->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('nik', 'like', '%' . $search . '%');
                });
            });

        // Filter by periode range (format YYYY-MM)
        if ($periodeDari && $periodeSampai) {
            $query->whereBetween('periode', [$periodeDari, $periodeSampai]);
        } elseif ($periodeDari) {
            $query->where('periode', '>=', $periodeDari);
        } elseif ($periodeSampai) {
            $query->where('periode', '<=', $periodeSampai);
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

        // Daftar periode yang ada di DB untuk dropdown filter
        $availablePeriodes = EmployeeKinerja::select('periode')
            ->distinct()
            ->orderBy('periode', 'desc')
            ->pluck('periode');

        // Daftar periode yang sudah di-approve direktur
        $approvedPeriodes = RekapPeriode::where('is_approved', true)
            ->pluck('periode')
            ->toArray();

        return view('kinerjas.index', compact('kinerjas', 'employees', 'availablePeriodes', 'approvedPeriodes'));
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

        return back()->with('success', 'Data kinerja berhasil ditambahkan.');
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

        return back()->with('success', 'Data kinerja berhasil diperbarui.');
    }

    public function destroy(EmployeeKinerja $kinerja)
    {
        $kinerja->delete();

        return back()->with('success', 'Data kinerja berhasil dihapus.');
    }

    public function destroyPeriode(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:7',
        ]);

        $count = EmployeeKinerja::where('periode', $request->periode)->count();

        if ($count === 0) {
            return back()->with('warning', 'Tidak ada data kinerja pada periode tersebut.');
        }

        EmployeeKinerja::where('periode', $request->periode)->delete();

        return back()->with('success', "Berhasil menghapus {$count} data kinerja pada periode {$request->periode}.");
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

        // Auto-create rekap periode jika belum ada (jangan reset is_approved jika sudah ada)
        RekapPeriode::firstOrCreate(
            ['periode' => $request->periode],
            ['is_approved' => false]
        );

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
        // Cek apakah rekap periode ini sudah di-approve direktur
        $rekap = RekapPeriode::where('periode', $kinerja->periode)->first();

        if (!$rekap || !$rekap->is_approved) {
            return back()->with('error', 'Rekap periode ' . $kinerja->periode . ' belum disetujui oleh Direktur. Hubungi Direktur untuk melakukan approval terlebih dahulu.');
        }

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
        $periodeDari   = $request->input('periode_dari');
        $periodeSampai = $request->input('periode_sampai');

        $isHanyaDesember = false;
        if ($periodeDari && $periodeSampai && $periodeDari === $periodeSampai && str_ends_with($periodeDari, '-12')) {
            $isHanyaDesember = true;
        }

        

        $query = EmployeeKinerja::with(['employee.jabatan', 'employee.area', 'employee.ptkpStatus'])
            ->join('employees', 'employee_kinerjas.employee_id', '=', 'employees.id')
            ->orderBy('employees.nama', 'asc')
            ->select('employee_kinerjas.*');

        if ($periodeDari && $periodeSampai) {
            $query->whereBetween('periode', [$periodeDari, $periodeSampai]);
        } elseif ($periodeDari) {
            $query->where('periode', '>=', $periodeDari);
        } elseif ($periodeSampai) {
            $query->where('periode', '<=', $periodeSampai);
        }

        $rawKinerjas = $query->get();
        $setting     = \App\Models\SettingGaji::first();

        // Aggregate per employee: jumlahkan semua komponen gaji lintas periode
        $aggregatedMap = [];
        foreach ($rawKinerjas as $row) {
            $employeeId  = $row->employee_id;
            $rateHarian  = $row->rate_gaji_pokok ?? ($row->employee->jabatan->rate_gaji_pokok ?? 0);
            $gajiPokok   = $row->total_hadir * $rateHarian;

            $rateGroom   = $row->rate_tunjangan_groom ?? ($setting->rate_tunjangan_groom ?? 0);
            $rateSrp     = $row->rate_srp ?? ($setting->rate_srp ?? 0);
            $rateGrosir  = $row->rate_grosir ?? ($setting->rate_grosir ?? 0);
            $rateAkses   = $row->rate_aksesoris ?? ($setting->rate_aksesoris ?? 0);

            $jabatanNama = $row->employee->jabatan->nama ?? '';
            $isSales     = stripos($jabatanNama, 'sales') !== false
                        || stripos($jabatanNama, 'kepala toko') !== false;

            $nilaiGroom  = $row->tunjangan_groom * $rateGroom;
            $nilaiSrp    = $isSales ? $row->srp * $rateSrp : 0;
            $nilaiGrosir = $isSales ? $row->grosir * $rateGrosir : 0;
            $nilaiAkses  = $isSales ? $row->aksesoris * $rateAkses : 0;

            $rincian      = $row->rincianGajiList($employeeId);
            $bpjsPotongan = $rincian['potongan']['bpjstk'] ?? 0;
            $nilaiAbsensi = $rincian['potongan']['absensi'] ?? 0;

                $pph          = $row->hitunglistPph21($employeeId);
                $gajiB        = $row->hitungGajiDiterimaList();

            $bruto    = $gajiPokok + $nilaiGroom + $nilaiSrp + $nilaiGrosir + $nilaiAkses + $row->bonus;
            $fixBruto = $bruto - $nilaiAbsensi;

            if (!isset($aggregatedMap[$employeeId])) {
                $aggregatedMap[$employeeId] = [
                    'employee'     => $row->employee,
                    'isSales'      => $isSales,
                    'gajiPokok'    => 0,
                    'nilaiGroom'   => 0,
                    'nilaiSrp'     => 0,
                    'nilaiGrosir'  => 0,
                    'nilaiAkses'   => 0,
                    'bonus'        => 0,
                    'nilaiAbsensi' => 0,
                    'bpjsPotongan' => 0,
                    'pph'          => 0,
                    'fixBruto'     => 0,
                    'gajiB'        => 0,
                ];
            }

            $aggregatedMap[$employeeId]['gajiPokok']    += $gajiPokok;
            $aggregatedMap[$employeeId]['nilaiGroom']   += $nilaiGroom;
            $aggregatedMap[$employeeId]['nilaiSrp']     += $nilaiSrp;
            $aggregatedMap[$employeeId]['nilaiGrosir']  += $nilaiGrosir;
            $aggregatedMap[$employeeId]['nilaiAkses']   += $nilaiAkses;
            $aggregatedMap[$employeeId]['bonus']        += $row->bonus;
            $aggregatedMap[$employeeId]['nilaiAbsensi'] += $nilaiAbsensi;
            $aggregatedMap[$employeeId]['bpjsPotongan'] += $bpjsPotongan;
            $aggregatedMap[$employeeId]['pph']          += $pph;

// dd([
//     'pph_dari_function' => $pph,
//     'pph_di_aggregatedMap' => $aggregatedMap[$employeeId]['pph'],
// ]);
            $aggregatedMap[$employeeId]['fixBruto']     += $fixBruto;
            $aggregatedMap[$employeeId]['gajiB']        += $gajiB;
        }

        $aggregated = array_values($aggregatedMap);

        $filename = 'laporan-kinerja';
        if ($periodeDari || $periodeSampai) {
            $filename .= '-' . ($periodeDari ?? 'awal') . '-sd-' . ($periodeSampai ?? 'akhir');
        } else {
            $filename .= '-semua';
        }
        $filename .= '.pdf';

        $pdf = Pdf::loadView('kinerjas.kinerja-report-pdf', compact('aggregated', 'periodeDari', 'periodeSampai', 'setting'))
            ->setPaper('A4', 'landscape');

        return $pdf->download($filename);
    }
}
