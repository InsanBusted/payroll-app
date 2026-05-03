<?php

namespace App\Exports;

use App\Models\EmployeeKinerja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeeKinerjaExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle,
    WithStyles
{
    public function __construct(protected ?string $periode = null) {}

    public function collection()
    {
        $query = EmployeeKinerja::with(['employee.jabatan', 'employee.area'])
            ->when($this->periode, fn($q) => $q->where('periode', $this->periode))
            ->orderBy('periode', 'desc');

        // join untuk ordering nama
        $query->join('employees', 'employee_kinerjas.employee_id', '=', 'employees.id')
              ->orderBy('employees.nama', 'asc')
              ->select('employee_kinerjas.*');

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Periode',
            'Nama Karyawan',
            'NIK',
            'Jabatan',
            'Area',
            'Total Hadir',
            'Tunjangan Groom',
            'SRP',
            'Grosir',
            'Aksesoris',
            'Bonus',
            'Absensi (Hari)',
            'PPh 21',
            'Gaji Bersih',
            'Status Transfer',
            'Status Diterima',
        ];
    }

    public function map($row): array
    {
        return [
            $row->periode,
            $row->employee->nama ?? '-',
            $row->employee->nik ?? '-',
            $row->employee->jabatan->nama ?? '-',
            $row->employee->area->nama ?? '-',
            $row->total_hadir,
            $row->tunjangan_groom,
            $row->srp,
            $row->grosir,
            $row->aksesoris,
            $row->bonus,
            $row->absensi,
            $row->hitungListPph21($row->employee_id),
            $row->hitungGajiDiterimaList(),
            $row->status_gaji ? 'Sudah Transfer' : 'Belum Transfer',
            $row->status_diterima ? 'Sudah Diterima' : 'Belum Diterima',
        ];
    }

    public function title(): string
    {
        return $this->periode
            ? 'Kinerja ' . $this->periode
            : 'Semua Kinerja';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
