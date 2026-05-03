<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Slip Gaji - {{ $kinerja->employee->nama }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            background: #fff;
            padding: 32px 40px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #1e3a5f;
        }
        .slip-title {
            font-size: 13px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #555;
            margin-top: 4px;
        }

        /* ── Divider ── */
        .divider-thick {
            border: none;
            border-top: 3px solid #1e3a5f;
            margin: 10px 0 4px;
        }
        .divider-thin {
            border: none;
            border-top: 1px solid #1e3a5f;
            margin: 0 0 16px;
        }

        /* ── Employee Info ── */
        .info-table {
            width: 100%;
            margin-bottom: 18px;
        }
        .info-table td {
            vertical-align: top;
            padding: 2px 0;
            width: 50%;
            font-size: 11px;
            line-height: 1.8;
        }
        .info-label {
            display: inline-block;
            width: 60px;
            font-weight: bold;
            color: #333;
        }

        /* ── Salary Tables ── */
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .salary-table th {
            background-color: #1e3a5f;
            color: #ffffff;
            padding: 7px 10px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .salary-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
        }
        .salary-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .salary-table .subtotal td {
            background-color: #e8edf5;
            font-weight: bold;
            color: #1e3a5f;
            border-top: 2px solid #1e3a5f;
        }
        .salary-table .grand-total td {
            background-color: #1e3a5f;
            color: #ffffff;
            font-weight: bold;
            font-size: 12px;
            border-top: 2px solid #0f2540;
        }
        .amount {
            text-align: right;
            font-family: 'DejaVu Sans Mono', monospace;
        }

        /* ── Net Salary Banner ── */
        .net-banner {
            background-color: #1e3a5f;
            color: #fff;
            padding: 10px 14px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .net-banner-label {
            display: table-cell;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            vertical-align: middle;
        }
        .net-banner-amount {
            display: table-cell;
            font-size: 15px;
            font-weight: bold;
            text-align: right;
            vertical-align: middle;
            font-family: 'DejaVu Sans Mono', monospace;
        }

        /* ── Signature ── */
        .signature-table {
            width: 100%;
            margin-top: 30px;
        }
        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }
        .signature-box {
            height: 70px;
            margin: 8px 0;
        }
        .signature-box img {
            max-height: 65px;
            max-width: 140px;
        }
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 4px;
            padding-top: 4px;
            font-weight: bold;
            font-size: 11px;
        }
        .sig-role {
            color: #666;
            font-size: 10px;
            margin-bottom: 4px;
        }

        /* ── Footer Note ── */
        .footer-note {
            margin-top: 24px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
        }
    </style>
</head>
<body>

@php
    [$y, $m] = explode('-', $kinerja->periode);
    $bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
              'Juli','Agustus','September','Oktober','November','Desember'];
    $periodeTeks = $bulan[(int)$m] . ' ' . $y;
    $tanggal = now()->translatedFormat('d F Y');

    $pendapatanLabels = [
        'gaji_pokok'          => 'Gaji Pokok',
        'tunjangan_kerapihan' => 'Tunjangan Kerapihan',
        'srp'                 => 'Nilai SRP',
        'grosir'              => 'Nilai Grosir',
        'aksesoris'           => 'Nilai Aksesoris',
        'bonus'               => 'Bonus',
    ];
    $potonganLabels = [
        'bpjstk'  => 'BPJS Tenaga Kerja',
        'absensi' => 'Potongan Absensi',
        'pph21'   => 'PPh 21',
    ];
@endphp

{{-- ══ Header ══ --}}
<div class="header">
    <div class="company-name">Slip Gaji Karyawan</div>
    <div class="slip-title">Periode {{ $periodeTeks }}</div>
</div>
<hr class="divider-thick">
<hr class="divider-thin">

{{-- ══ Employee Info ══ --}}
<table class="info-table">
    <tr>
        <td>
            <span class="info-label">Nama</span> : {{ $kinerja->employee->nama }}<br>
            <span class="info-label">NIK</span> : {{ $kinerja->employee->nik }}<br>
            <span class="info-label">Jabatan</span> : {{ $kinerja->employee->jabatan->nama ?? '-' }}
        </td>
        <td>
            <span class="info-label">Periode</span> : {{ $periodeTeks }}<br>
            <span class="info-label">Area</span> : {{ $kinerja->employee->area->nama ?? '-' }}
        </td>
    </tr>
</table>

{{-- ══ Pendapatan Table ══ --}}
<table class="salary-table">
    <thead>
        <tr>
            <th style="width:65%">Komponen Pendapatan</th>
            <th style="text-align:right">Nominal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rincian['pendapatan'] as $key => $nominal)
            <tr>
                <td>{{ $pendapatanLabels[$key] ?? ucwords(str_replace('_', ' ', $key)) }}</td>
                <td class="amount">Rp {{ number_format($nominal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr class="subtotal">
            <td>Total Pendapatan</td>
            <td class="amount">Rp {{ number_format($kinerja->hitungTotalPendapatan(), 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

{{-- ══ Potongan Table ══ --}}
<table class="salary-table">
    <thead>
        <tr>
            <th style="width:65%">Komponen Potongan</th>
            <th style="text-align:right">Nominal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rincian['potongan'] as $key => $nominal)
            <tr>
                <td>{{ $potonganLabels[$key] ?? ucwords(str_replace('_', ' ', $key)) }}</td>
                <td class="amount">Rp {{ number_format($nominal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr class="subtotal">
            <td>Total Potongan</td>
            <td class="amount">Rp {{ number_format($kinerja->hitungTotalPotongan(), 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

{{-- ══ Gaji Bersih Banner ══ --}}
<div class="net-banner">
    <span class="net-banner-label">Gaji Bersih Diterima</span>
    <span class="net-banner-amount">Rp {{ number_format($kinerja->hitungGajiDiterimaList(), 0, ',', '.') }}</span>
</div>

{{-- ══ Tanda Tangan ══ --}}
<table class="signature-table">
    <tr>
        @if ($kinerja->status_gaji)
        <td>
            <div class="sig-role">Dikeluarkan oleh,</div>
            <div class="signature-box">
                @if (auth()->user()->signature_path)
                    <img src="{{ public_path('storage/' . auth()->user()->signature_path) }}" alt="TTD HRD">
                @endif
            </div>
            <div class="signature-line">{{ $kinerja->transferredBy->name ?? auth()->user()->name }}</div>
            <div style="font-size:10px;color:#555;margin-top:2px;">{{ $kinerja->transferredBy?->employee?->jabatan?->nama ?? 'HRD / Admin' }}</div>
        </td>
        @endif
        @if ($kinerja->status_diterima)
        <td>
            <div class="sig-role">Diterima oleh,</div>
            <div class="signature-box">
                @if ($kinerja->employee->signature_path)
                    <img src="{{ public_path('storage/' . $kinerja->employee->signature_path) }}" alt="TTD Karyawan">
                @endif
            </div>
            <div class="signature-line">{{ $kinerja->employee->nama }}</div>
            <div style="font-size:10px;color:#555;margin-top:2px;">{{ $kinerja->employee?->jabatan?->nama ?? 'Karyawan' }}</div>
        </td>
        @endif
    </tr>
</table>

{{-- ══ Footer ══ --}}
<div class="footer-note">
    Slip gaji ini diterbitkan secara otomatis oleh sistem pada {{ $tanggal }}.
    Dokumen ini sah tanpa tanda tangan basah apabila dicetak dari sistem resmi.
</div>

</body>
</html>
