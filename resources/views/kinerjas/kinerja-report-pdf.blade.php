<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kinerja Karyawan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #1a1a2e;
            background: #fff;
        }

        .page {
            padding: 28px 32px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 18px;
            border-bottom: 3px solid #1e3a5f;
            padding-bottom: 12px;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #1e3a5f;
        }
        .header-subtitle {
            font-size: 11px;
            color: #555;
            margin-top: 3px;
            letter-spacing: 1px;
        }
        .header-meta {
            font-size: 9px;
            color: #888;
            margin-top: 6px;
        }

        /* ── Table ── */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead tr th {
            background-color: #1e3a5f;
            color: #ffffff;
            padding: 7px 6px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border: 1px solid #163050;
        }

        tbody tr td {
            padding: 5px 6px;
            font-size: 9px;
            border: 1px solid #dde3ed;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) td {
            background-color: #f4f7fb;
        }

        tbody tr:nth-child(odd) td {
            background-color: #ffffff;
        }

        .text-right  { text-align: right; }
        .text-center { text-align: center; }
        .text-left   { text-align: left; }

        .font-bold   { font-weight: bold; }

        .badge-transfer {
            display: inline-block;
            background: #d1fae5;
            color: #065f46;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-belum-transfer {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-diterima {
            display: inline-block;
            background: #e0e7ff;
            color: #3730a3;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-belum-diterima {
            display: inline-block;
            background: #ffe4e6;
            color: #be123c;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
        }

        /* ── Summary Row ── */
        .summary-row td {
            background-color: #e8edf5 !important;
            font-weight: bold;
            color: #1e3a5f;
            border-top: 2px solid #1e3a5f;
        }

        /* ── Calc Formula ── */
        .calc-formula {
            font-size: 7.5px;
            color: #6b7280;
            display: block;
            margin-top: 1px;
        }
        .calc-result {
            font-weight: bold;
            font-size: 9px;
        }
        .na-text {
            font-size: 8px;
            color: #cbd5e1;
            font-style: italic;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #aaa;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
        }

        /* ── Summary Box ── */
        .summary-box {
            margin-top: 16px;
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            padding: 10px 14px;
            background: #1e3a5f;
            color: #fff;
        }
        .summary-label {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
        }
        .summary-value {
            font-size: 13px;
            font-weight: bold;
            margin-top: 2px;
        }
        .summary-sep {
            display: table-cell;
            width: 1px;
            background: rgba(255,255,255,0.2);
        }
        .summary-item.amber {
            background: #b45309;
        }
        .summary-item.green {
            background: #14532d;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="header">
        <div class="header-title">Rekap Gaji Karyawan</div>
        @if ($periode)
            @php
                [$y, $m] = explode('-', $periode);
                $bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
                          'Juli','Agustus','September','Oktober','November','Desember'];
            @endphp
            <div class="header-subtitle">Periode: {{ $bulan[(int)$m] }} {{ $y }}</div>
        @else
            @php $y = null; $m = null; $bulan = []; @endphp
            <div class="header-subtitle">Semua Periode</div>
        @endif
        <div class="header-meta">Dicetak pada: {{ now()->translatedFormat('d F Y') }} WIB &nbsp;|&nbsp; Total Data: {{ count($kinerjas) }} karyawan</div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:2%">No</th>
                <th class="text-left"   style="width:5%">Periode</th>
                <th class="text-left"   style="width:10%">Nama Karyawan</th>
                <th class="text-center" style="width:5%">NIK</th>
                <th class="text-left"   style="width:8%">Jabatan</th>
                <th class="text-left"   style="width:5%">Area</th>
                <th class="text-center" style="width:3%">Hadir</th>
                <th class="text-right"  style="width:8%">Gaji Pokok</th>
                <th class="text-right"  style="width:8%">Tunj. Groom</th>
                <th class="text-right"  style="width:7%">SRP</th>
                <th class="text-right"  style="width:7%">Grosir</th>
                <th class="text-right"  style="width:7%">Aksesoris</th>
                <th class="text-right"  style="width:5%">Bonus</th>
                <th class="text-center" style="width:3%">Absensi</th>
                <th class="text-right"  style="width:6%">Pot. BPJS</th>
                <th class="text-right"  style="width:5%">PPh 21</th>
                <th class="text-right"  style="width:7%">Gaji Bersih</th>
                <th class="text-center" style="width:7%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGaji       = 0;
                $totalGajiPokok  = 0;
                $totalPph        = 0;
                $totalBpjs       = 0;
                $kinerjaCount    = count($kinerjas);
            @endphp
            @forelse ($kinerjas as $i => $row)
                @php
                    $gajiB      = $row->hitungGajiDiterimaList();
                    $pph        = $row->hitungListPph21($row->employee_id);
                    $rateHarian = $row->employee->jabatan->rate_gaji_pokok ?? 0;
                    $gajiPokok  = $row->total_hadir * $rateHarian;
                    $rincian    = $row->rincianGajiList($row->employee_id);
                    $bpjsPotongan = $rincian['potongan']['bpjstk'] ?? 0;

                    $totalGaji      += $gajiB;
                    $totalGajiPokok += $gajiPokok;
                    $totalPph       += $pph;
                    $totalBpjs      += $bpjsPotongan;

                    $rateGroom  = $setting->rate_tunjangan_groom ?? 0;
                    $rateSrp    = $setting->rate_srp ?? 0;
                    $rateGrosir = $setting->rate_grosir ?? 0;
                    $rateAkses  = $setting->rate_aksesoris ?? 0;

                    $nilaiGroom  = $row->tunjangan_groom * $rateGroom;
                    $isSales     = stripos($row->employee->jabatan->nama ?? '', 'sales') !== false
                                || stripos($row->employee->jabatan->nama ?? '', 'kepala toko') !== false;
                    $nilaiSrp    = $isSales ? $row->srp * $rateSrp : 0;
                    $nilaiGrosir = $isSales ? $row->grosir * $rateGrosir : 0;
                    $nilaiAkses  = $isSales ? $row->aksesoris * $rateAkses : 0;

                    $rowNum   = $i + 1;
                    $isLast   = ($rowNum === $kinerjaCount);
                    $isRowTen = ($rowNum % 10 === 0);
                @endphp
                <tr>
                    <td class="text-center">{{ $rowNum }}</td>
                    <td class="text-center">{{ $row->periode }}</td>
                    <td class="text-left font-bold">{{ $row->employee->nama ?? '-' }}</td>
                    <td class="text-center">{{ $row->employee->nik ?? '-' }}</td>
                    <td class="text-left">{{ $row->employee->jabatan->nama ?? '-' }}</td>
                    <td class="text-left">{{ $row->employee->area->nama ?? '-' }}</td>
                    <td class="text-center">{{ $row->total_hadir }}</td>
                    <td class="text-right">
                        <span class="calc-result">Rp {{ number_format($gajiPokok, 0, ',', '.') }}</span>
                        <span class="calc-formula">{{ $row->total_hadir }} &times; {{ number_format($rateHarian, 0, ',', '.') }}</span>
                    </td>
                    <td class="text-right">
                        <span class="calc-result">Rp {{ number_format($nilaiGroom, 0, ',', '.') }}</span>
                        <span class="calc-formula">{{ $row->tunjangan_groom }} &times; {{ number_format($rateGroom, 0, ',', '.') }}</span>
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($nilaiSrp, 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $row->srp }} &times; {{ number_format($rateSrp, 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($nilaiGrosir, 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $row->grosir }} &times; {{ number_format($rateGrosir, 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($nilaiAkses, 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $row->aksesoris }} &times; {{ number_format($rateAkses, 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($row->bonus, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $row->absensi }} hr</td>
                    <td class="text-right" style="color:#b45309;">Rp {{ number_format($bpjsPotongan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($pph, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($gajiB, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if (!$row->status_gaji)
                            <span class="badge-belum-transfer">Belum Transfer</span>
                        @elseif (!$row->status_diterima)
                            <span class="badge-belum-diterima">Belum Diterima</span>
                        @else
                            <span class="badge-diterima">Sudah Diterima</span>
                        @endif
                    </td>
                </tr>

                @if ($isRowTen && !$isLast)
                </tbody>
            </table>
            <div class="footer">Laporan ini diterbitkan secara otomatis oleh sistem payroll.</div>
        </div>
        <div style="page-break-after: always;"></div>
        <div class="page">
            <div class="header">
                <div class="header-title">Rekap Gaji Karyawan</div>
                <div class="header-subtitle">Periode: {{ $m ? $bulan[(int)$m] . ' ' . $y : 'Semua Periode' }}</div>
                <div class="header-meta">Dicetak pada: {{ now()->translatedFormat('d F Y') }} WIB &nbsp;|&nbsp; Total Data: {{ $kinerjaCount }} karyawan</div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width:2%">No</th>
                        <th class="text-left"   style="width:5%">Periode</th>
                        <th class="text-left"   style="width:10%">Nama Karyawan</th>
                        <th class="text-center" style="width:5%">NIK</th>
                        <th class="text-left"   style="width:8%">Jabatan</th>
                        <th class="text-left"   style="width:5%">Area</th>
                        <th class="text-center" style="width:3%">Hadir</th>
                        <th class="text-right"  style="width:8%">Gaji Pokok</th>
                        <th class="text-right"  style="width:8%">Tunj. Groom</th>
                        <th class="text-right"  style="width:7%">SRP</th>
                        <th class="text-right"  style="width:7%">Grosir</th>
                        <th class="text-right"  style="width:7%">Aksesoris</th>
                        <th class="text-right"  style="width:5%">Bonus</th>
                        <th class="text-center" style="width:3%">Absensi</th>
                        <th class="text-right"  style="width:6%">Pot. BPJS</th>
                        <th class="text-right"  style="width:5%">PPh 21</th>
                        <th class="text-right"  style="width:7%">Gaji Bersih</th>
                        <th class="text-center" style="width:7%">Status</th>
                    </tr>
                </thead>
                <tbody>
                @endif
            @empty
                <tr><td colspan="18" class="text-center" style="padding: 20px; color: #aaa;">Tidak ada data kinerja.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if (count($kinerjas) > 0)
        <div class="summary-box">
            <div class="summary-item">
                <div class="summary-label">Total Gaji Pokok</div>
                <div class="summary-value">Rp {{ number_format($totalGajiPokok, 0, ',', '.') }}</div>
            </div>
            <div class="summary-sep"></div>
            <div class="summary-item amber">
                <div class="summary-label">Total Potongan BPJS</div>
                <div class="summary-value">Rp {{ number_format($totalBpjs, 0, ',', '.') }}</div>
            </div>
            <div class="summary-sep"></div>
            <div class="summary-item amber">
                <div class="summary-label">Total PPh 21</div>
                <div class="summary-value">Rp {{ number_format($totalPph, 0, ',', '.') }}</div>
            </div>
            <div class="summary-sep"></div>
            <div class="summary-item green">
                <div class="summary-label">Total Gaji Bersih</div>
                <div class="summary-value">Rp {{ number_format($totalGaji, 0, ',', '.') }}</div>
            </div>
        </div>
    @endif

    <div class="footer">
        Laporan ini diterbitkan secara otomatis oleh sistem payroll.
        Dokumen ini sah tanpa tanda tangan basah apabila dicetak dari sistem resmi.
    </div>
</div>
</body>
</html>
