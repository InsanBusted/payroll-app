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

        /* ── Tfoot ── */
        tfoot tr td {
            padding: 5px 6px;
            font-size: 9px;
            border: 1px solid #b8c4d6;
            vertical-align: middle;
        }

        /* Baris 1: total komponen */
        tfoot tr.tfoot-komponen td {
            background-color: #eef2f9;
            color: #1e3a5f;
            font-weight: bold;
            border-top: 2px solid #1e3a5f;
        }
        tfoot tr td.potongan {
            color: #b45309;
        }
        tfoot tr.tfoot-komponen td.label-cell {
            text-align: right;
            font-size: 8px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        /* Baris 2: ringkasan bruto - potongan = bersih */
        tfoot tr.tfoot-total td {
            background-color: #eef2f9;
            color: #1e3a5f;
            font-weight: bold;
            border-color: #b8c4d6;
        }
        tfoot tr.tfoot-total td.label-cell {
            text-align: right;
            font-size: 8px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }
        tfoot tr.tfoot-total td.bruto-cell {
            text-align: right;
            color: #1e3a5f;
        }
        tfoot tr.tfoot-total td.result-cell {
            text-align: right;
            color: #16a34a;
            font-size: 10px;
        }
        tfoot tr.tfoot-total td.empty-cell {
            background-color: #eef2f9;
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
        @php
            $bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
                      'Juli','Agustus','September','Oktober','November','Desember'];
            $labelPeriode = 'Semua Periode';
            if ($periodeDari && $periodeSampai) {
                [$yd, $md] = explode('-', $periodeDari);
                [$ys, $ms] = explode('-', $periodeSampai);
                $labelPeriode = $bulan[(int)$md] . ' ' . $yd . ' s/d ' . $bulan[(int)$ms] . ' ' . $ys;
            } elseif ($periodeDari) {
                [$yd, $md] = explode('-', $periodeDari);
                $labelPeriode = 'Mulai ' . $bulan[(int)$md] . ' ' . $yd;
            } elseif ($periodeSampai) {
                [$ys, $ms] = explode('-', $periodeSampai);
                $labelPeriode = 'Sampai ' . $bulan[(int)$ms] . ' ' . $ys;
            }
        @endphp
        <div class="header-subtitle">Periode: {{ $labelPeriode }}</div>
        <div class="header-meta">Dicetak pada: {{ now()->translatedFormat('d F Y') }} WIB &nbsp;|&nbsp; Total Karyawan: {{ count($aggregated) }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:2%">No</th>
                <th class="text-left"   style="width:12%">Nama Karyawan</th>
                <th class="text-center" style="width:5%">NIK</th>
                <th class="text-left"   style="width:9%">Jabatan</th>
                <th class="text-left"   style="width:6%">Area</th>
                <th class="text-center" style="width:3%">PTKP</th>
                <th class="text-right"  style="width:8%">Gaji Pokok</th>
                <th class="text-right"  style="width:7%">Tunj. Groom</th>
                <th class="text-right"  style="width:6%">SRP</th>
                <th class="text-right"  style="width:6%">Grosir</th>
                <th class="text-right"  style="width:6%">Aksesoris</th>
                <th class="text-right"  style="width:5%">Bonus</th>
                <th class="text-right"  style="width:5%">Absensi</th>
                <th class="text-right"  style="width:5%">Pot. BPJS</th>
                <th class="text-right"  style="width:5%">PPh 21</th>
                <th class="text-right"  style="width:7%">Gaji Bruto</th>
                <th class="text-right"  style="width:8%">Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGajiPokok  = 0;
                $totalGroom      = 0;
                $totalSrp        = 0;
                $totalGrosir     = 0;
                $totalAkses      = 0;
                $totalBonus      = 0;
                $totalAbsensi    = 0;
                $totalBpjs       = 0;
                $totalPph        = 0;
                $totalFixBruto   = 0;
                $totalGajiB      = 0;
                $rowCount        = count($aggregated);
            @endphp
            @forelse ($aggregated as $i => $agg)
                @php
                    $emp      = $agg['employee'];
                    $isSales  = $agg['isSales'];
                    $rowNum   = $i + 1;
                    $isLast   = ($rowNum === $rowCount);
                    $isRowTen = ($rowNum % 10 === 0);

                    $totalGajiPokok  += $agg['gajiPokok'];
                    $totalGroom      += $agg['nilaiGroom'];
                    $totalSrp        += $agg['nilaiSrp'];
                    $totalGrosir     += $agg['nilaiGrosir'];
                    $totalAkses      += $agg['nilaiAkses'];
                    $totalBonus      += $agg['bonus'];
                    $totalAbsensi    += $agg['nilaiAbsensi'];
                    $totalBpjs       += $agg['bpjsPotongan'];
                    $totalPph        += $agg['pph'];
                    $totalFixBruto   += $agg['fixBruto'];
                    $totalGajiB      += $agg['gajiB'];
                @endphp
                <tr>
                    <td class="text-center">{{ $rowNum }}</td>
                    <td class="text-left font-bold">{{ $emp->nama ?? '-' }}</td>
                    <td class="text-center">{{ $emp->nik ?? '-' }}</td>
                    <td class="text-left">{{ $emp->jabatan->nama ?? '-' }}</td>
                    <td class="text-left">{{ $emp->area->nama ?? '-' }}</td>
                    <td class="text-center">{{ $emp->ptkpStatus->status ?? '-' }}</td>
                    <td class="text-right">
                        <span class="calc-result">Rp {{ number_format($agg['gajiPokok'], 0, ',', '.') }}</span>
                        <span class="calc-formula">{{ $agg['totalHadir'] }} hr &times; {{ number_format($agg['rateHarian'], 0, ',', '.') }}</span>
                    </td>
                    <td class="text-right">
                        <span class="calc-result">Rp {{ number_format($agg['nilaiGroom'], 0, ',', '.') }}</span>
                        <span class="calc-formula">{{ $agg['rawGroom'] }} &times; {{ number_format($agg['rateGroom'], 0, ',', '.') }}</span>
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($agg['nilaiSrp'], 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $agg['rawSrp'] }} &times; {{ number_format($agg['rateSrp'], 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($agg['nilaiGrosir'], 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $agg['rawGrosir'] }} &times; {{ number_format($agg['rateGrosir'], 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if ($isSales)
                            <span class="calc-result">Rp {{ number_format($agg['nilaiAkses'], 0, ',', '.') }}</span>
                            <span class="calc-formula">{{ $agg['rawAkses'] }} &times; {{ number_format($agg['rateAkses'], 0, ',', '.') }}</span>
                        @else
                            <span class="na-text">Non Sales</span>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($agg['bonus'], 0, ',', '.') }}</td>
                    <td class="text-right" style="color:#b45309;">
                        <span class="calc-result">Rp {{ number_format($agg['nilaiAbsensi'], 0, ',', '.') }}</span>
                        <span class="calc-formula">{{ $agg['rawAbsensi'] }} hr</span>
                    </td>
                    <td class="text-right" style="color:#b45309;">Rp {{ number_format($agg['bpjsPotongan'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($agg['pph'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($agg['fixBruto'], 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($agg['gajiB'], 0, ',', '.') }}</td>
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
                <div class="header-subtitle">Periode: {{ $labelPeriode }}</div>
                <div class="header-meta">Dicetak pada: {{ now()->translatedFormat('d F Y') }} WIB &nbsp;|&nbsp; Total Karyawan: {{ $rowCount }}</div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width:2%">No</th>
                        <th class="text-left"   style="width:12%">Nama Karyawan</th>
                        <th class="text-center" style="width:5%">NIK</th>
                        <th class="text-left"   style="width:9%">Jabatan</th>
                        <th class="text-left"   style="width:6%">Area</th>
                        <th class="text-center" style="width:3%">PTKP</th>
                        <th class="text-right"  style="width:8%">Gaji Pokok</th>
                        <th class="text-right"  style="width:7%">Tunj. Groom</th>
                        <th class="text-right"  style="width:6%">SRP</th>
                        <th class="text-right"  style="width:6%">Grosir</th>
                        <th class="text-right"  style="width:6%">Aksesoris</th>
                        <th class="text-right"  style="width:5%">Bonus</th>
                        <th class="text-right"  style="width:5%">Absensi</th>
                        <th class="text-right"  style="width:5%">Pot. BPJS</th>
                        <th class="text-right"  style="width:5%">PPh 21</th>
                        <th class="text-right"  style="width:7%">Gaji Bruto</th>
                        <th class="text-right"  style="width:8%">Gaji Bersih</th>
                    </tr>
                </thead>
                <tbody>
                @endif
            @empty
                <tr><td colspan="17" class="text-center" style="padding: 20px; color: #aaa;">Tidak ada data kinerja.</td></tr>
            @endforelse
        </tbody>
        @if (count($aggregated) > 0)
        @php $totalPotongan = $totalBpjs + $totalPph; @endphp
        <tfoot>
            <tr class="tfoot-komponen">
                <td colspan="6" class="label-cell">Total per Komponen</td>
                <td class="text-right">Rp {{ number_format($totalGajiPokok, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalGroom, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalSrp, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalGrosir, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalAkses, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalBonus, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalAbsensi, 0, ',', '.') }}</td>
                <td class="text-right potongan">Rp {{ number_format($totalBpjs, 0, ',', '.') }}</td>
                <td class="text-right potongan">Rp {{ number_format($totalPph, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalFixBruto, 0, ',', '.') }}</td>
                <td class="text-right">-</td>
            </tr>
            <tr class="tfoot-total">
                <td colspan="6" class="label-cell">Ringkasan Total</td>
                <td colspan="7" class="text-right bruto-cell">
                    <span style="font-size: 7.5px; font-weight: normal; display: block; text-transform: uppercase; color: #4b5563; margin-bottom: 2px;">Total Bruto</span>
                    Rp {{ number_format($totalFixBruto, 0, ',', '.') }}
                </td>
                <td colspan="2" class="text-right potongan">
                    <span style="font-size: 7.5px; font-weight: normal; display: block; text-transform: uppercase; color: #b45309; margin-bottom: 2px;">Total Potongan</span>
                    Rp {{ number_format($totalPotongan, 0, ',', '.') }}
                </td>
                <td class="empty-cell"></td>
                <td class="result-cell">
                    <span style="font-size: 7.5px; font-weight: normal; display: block; text-transform: uppercase; color: #16a34a; margin-bottom: 2px;">Total Gaji Bersih</span>
                    Rp {{ number_format($totalGajiB, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        Laporan ini diterbitkan secara otomatis oleh sistem payroll.
        Dokumen ini sah tanpa tanda tangan basah apabila dicetak dari sistem resmi.
    </div>
</div>
</body>
</html>
