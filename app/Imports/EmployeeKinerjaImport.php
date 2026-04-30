<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\EmployeeKinerja;
use App\Models\PtkpStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Entry point import — hanya memproses sheet bernama "GAJI".
 */
class EmployeeKinerjaImport implements WithMultipleSheets
{
    protected string $periode;
    public int $importedCount = 0;
    public int $updatedCount  = 0;
    public int $skippedCount  = 0;
    public array $errors      = [];

    public function __construct(string $periode)
    {
        $this->periode = $periode;
    }

    public function sheets(): array
    {
        // Kunci array = nama sheet (case-sensitive). Library hanya memproses sheet ini.
        return [
            'GAJI' => new GajiSheetImport($this->periode, $this),
        ];
    }
}

/**
 * Processor untuk isi sheet "GAJI".
 * Counter & error ditulis balik ke objek parent agar bisa dibaca di controller.
 */
class GajiSheetImport implements ToCollection, WithHeadingRow
{
    protected string $periode;
    protected EmployeeKinerjaImport $parent;

    public function __construct(string $periode, EmployeeKinerjaImport $parent)
    {
        $this->periode = $periode;
        $this->parent  = $parent;
    }

    public function collection(Collection $rows): void
    {
        // Pre-load semua employee, index by NIK (lowercase + trim) agar cepat
        $employees = Employee::all()->keyBy(fn($e) => strtolower(trim((string) $e->nik)));

        // Pre-load semua ptkp_status, index by status string (uppercase + trim) agar cepat
        // Contoh key: "TK/0", "TK/1", "K/0", dst.
        $ptkpStatuses = PtkpStatus::all()->keyBy(fn($s) => strtoupper(trim((string) $s->status)));

        foreach ($rows as $index => $row) {
            $rowNum = $index + 2; // baris 1 = header

            // Ambil NIK dari kolom "NIK Karyawan"
            $nik = strtolower(trim((string) ($row['nik_karyawan'] ?? '')));

            if ($nik === '') {
                continue; // Lewati baris kosong
            }

            $employee = $employees->get($nik);

            if (!$employee) {
                $this->parent->errors[] = "Baris {$rowNum}: NIK '{$nik}' tidak ditemukan.";
                $this->parent->skippedCount++;
                continue;
            }

            $statusRaw = strtoupper(trim((string) ($row['status'] ?? '')));
            if ($statusRaw !== '') {
                $ptkpStatus = $ptkpStatuses->get($statusRaw);
                if ($ptkpStatus) {
                    $employee->update(['ptkp_status_id' => $ptkpStatus->id]);
                } else {
                    $this->parent->errors[] = "Baris {$rowNum}: Status PTKP '{$statusRaw}' tidak ditemukan di database.";
                }
            }

            // ── Simpan / update data kinerja ──
            $data = [
                'employee_id'     => $employee->id,
                'periode'         => $this->periode,
                'total_hadir'     => (int) ($row['total_hadir'] ?? 0),
                'tunjangan_groom' => (int) ($row['tunj_groom']  ?? $row['tunj__groom'] ?? 0),
                'srp'             => (int) ($row['srp']          ?? 0),
                'grosir'          => (int) ($row['grosir']       ?? 0),
                'aksesoris'       => (int) ($row['aksesoris']    ?? 0),
                'bonus'           => (int) ($row['bonus']        ?? 0),
                'bpjstk'          => 0,
                'absensi'         => (int) ($row['absensi']      ?? 0),
                'pph21'           => 0,
            ];

            $existing = EmployeeKinerja::query()
                ->where('employee_id', $employee->id)
                ->where('periode', $this->periode)
                ->first();

            if ($existing) {
                $existing->update($data);
                $this->parent->updatedCount++;
            } else {
                EmployeeKinerja::create($data);
                $this->parent->importedCount++;
            }
        }
    }
}
