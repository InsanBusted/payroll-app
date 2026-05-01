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

<div style="font-family: Arial, sans-serif; font-size: 11px; color: #1a1a2e; max-width: 680px; margin: 0 auto; padding: 32px 40px; background: #fff;">

    {{-- ══ Header ══ --}}
    <div style="text-align: center; margin-bottom: 20px;">
        <div style="font-size: 18px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; color: #1e3a5f;">
            Slip Gaji Karyawan
        </div>
        <div style="font-size: 13px; letter-spacing: 3px; text-transform: uppercase; color: #555; margin-top: 4px;">
            Periode {{ $periodeTeks }}
        </div>
    </div>
    <hr style="border: none; border-top: 3px solid #1e3a5f; margin: 10px 0 4px;">
    <hr style="border: none; border-top: 1px solid #1e3a5f; margin: 0 0 16px;">

    {{-- ══ Employee Info ══ --}}
    <table style="width: 100%; margin-bottom: 18px; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; vertical-align: top; padding: 2px 0; font-size: 11px; line-height: 1.8;">
                <span style="display: inline-block; width: 60px; font-weight: bold; color: #333;">Nama</span> : {{ $kinerja->employee->nama }}<br>
                <span style="display: inline-block; width: 60px; font-weight: bold; color: #333;">NIK</span> : {{ $kinerja->employee->nik }}<br>
                <span style="display: inline-block; width: 60px; font-weight: bold; color: #333;">Jabatan</span> : {{ $kinerja->employee->jabatan->nama ?? '-' }}
            </td>
            <td style="width: 50%; vertical-align: top; padding: 2px 0; font-size: 11px; line-height: 1.8;">
                <span style="display: inline-block; width: 60px; font-weight: bold; color: #333;">Periode</span> : {{ $periodeTeks }}<br>
                <span style="display: inline-block; width: 60px; font-weight: bold; color: #333;">Area</span> : {{ $kinerja->employee->area->nama ?? '-' }}
            </td>
        </tr>
    </table>

    {{-- ══ Pendapatan Table ══ --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <thead>
            <tr>
                <th style="width: 65%; background-color: #1e3a5f; color: #fff; padding: 7px 10px; text-align: left; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                    Komponen Pendapatan
                </th>
                <th style="background-color: #1e3a5f; color: #fff; padding: 7px 10px; text-align: right; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                    Nominal
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rincian['pendapatan'] as $key => $nominal)
                <tr style="{{ $loop->even ? 'background-color:#f8fafc;' : '' }}">
                    <td style="padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 11px;">
                        {{ $pendapatanLabels[$key] ?? ucwords(str_replace('_', ' ', $key)) }}
                    </td>
                    <td style="padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 11px; text-align: right; font-family: monospace;">
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td style="padding: 6px 10px; background-color: #e8edf5; font-weight: bold; color: #1e3a5f; border-top: 2px solid #1e3a5f; font-size: 11px;">
                    Total Pendapatan
                </td>
                <td style="padding: 6px 10px; background-color: #e8edf5; font-weight: bold; color: #1e3a5f; border-top: 2px solid #1e3a5f; font-size: 11px; text-align: right; font-family: monospace;">
                    Rp {{ number_format($kinerja->hitungTotalPendapatan(), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- ══ Potongan Table ══ --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <thead>
            <tr>
                <th style="width: 65%; background-color: #1e3a5f; color: #fff; padding: 7px 10px; text-align: left; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                    Komponen Potongan
                </th>
                <th style="background-color: #1e3a5f; color: #fff; padding: 7px 10px; text-align: right; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                    Nominal
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rincian['potongan'] as $key => $nominal)
                <tr style="{{ $loop->even ? 'background-color:#f8fafc;' : '' }}">
                    <td style="padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 11px;">
                        {{ $potonganLabels[$key] ?? ucwords(str_replace('_', ' ', $key)) }}
                    </td>
                    <td style="padding: 6px 10px; border-bottom: 1px solid #e5e7eb; font-size: 11px; text-align: right; font-family: monospace;">
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td style="padding: 6px 10px; background-color: #e8edf5; font-weight: bold; color: #1e3a5f; border-top: 2px solid #1e3a5f; font-size: 11px;">
                    Total Potongan
                </td>
                <td style="padding: 6px 10px; background-color: #e8edf5; font-weight: bold; color: #1e3a5f; border-top: 2px solid #1e3a5f; font-size: 11px; text-align: right; font-family: monospace;">
                    Rp {{ number_format($kinerja->hitungTotalPotongan(), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- ══ Gaji Bersih Banner ══ --}}
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="background-color: #1e3a5f; color: #fff; padding: 10px 14px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                Gaji Bersih Diterima
            </td>
            <td style="background-color: #1e3a5f; color: #fff; padding: 10px 14px; font-size: 15px; font-weight: bold; text-align: right; font-family: monospace;">
                Rp {{ number_format($kinerja->hitungGajiDiterimaList(), 0, ',', '.') }}
            </td>
        </tr>
    </table>

    {{-- ══ Tanda Tangan ══ --}}
    <table style="width: 100%; margin-top: 30px; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; text-align: center; vertical-align: top; padding: 0 10px;">
                <div style="color: #666; font-size: 10px; margin-bottom: 4px;">Dikeluarkan oleh,</div>
                <div style="height: 70px; display: flex; align-items: flex-end; justify-content: center; margin: 8px 0;">
                    @if ($kinerja->employee->signature_path)
                        <img src="{{ asset('storage/' . $kinerja->employee->signature_path) }}"
                             style="max-height: 65px; max-width: 140px; object-fit: contain;" alt="TTD HRD">
                    @endif
                </div>
                <div style="border-top: 1px solid #333; padding-top: 4px; font-weight: bold; font-size: 11px;">
                    {{ auth()->user()->name }}
                </div>
                <div style="font-size: 10px; color: #555; margin-top: 2px;">HRD / Admin</div>
            </td>
            <td style="width: 50%; text-align: center; vertical-align: top; padding: 0 10px;">
                <div style="color: #666; font-size: 10px; margin-bottom: 4px;">Diterima oleh,</div>
                <div style="height: 70px; display: flex; align-items: flex-end; justify-content: center; margin: 8px 0;">
                    @if ($kinerja->employee->signature_path)
                        <img src="{{ asset('storage/' . $kinerja->employee->signature_path) }}"
                             style="max-height: 65px; max-width: 140px; object-fit: contain;" alt="TTD Karyawan">
                    @endif
                </div>
                <div style="border-top: 1px solid #333; padding-top: 4px; font-weight: bold; font-size: 11px;">
                    {{ $kinerja->employee->nama }}
                </div>
                <div style="font-size: 10px; color: #555; margin-top: 2px;">Karyawan</div>
            </td>
        </tr>
    </table>

    {{-- ══ Footer Note ══ --}}
    <div style="margin-top: 24px; text-align: center; font-size: 9px; color: #999; border-top: 1px solid #e5e7eb; padding-top: 8px;">
        Slip gaji ini diterbitkan secara otomatis oleh sistem pada {{ $tanggal }}.
        Dokumen ini sah tanpa tanda tangan basah apabila dicetak dari sistem resmi.
    </div>

</div>
