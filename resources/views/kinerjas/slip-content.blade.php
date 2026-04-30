@php
    $tanggal = now()->translatedFormat('d F Y');
@endphp

<h2 style="text-align:center;font-size:22px;font-weight:bold">
    SLIP GAJI KARYAWAN
</h2>

<hr>

<table width="100%" style="margin-top:20px">
    <tr>
        <td width="50%">
            Nama : {{ $kinerja->employee->nama }} <br>
            NIK : {{ $kinerja->employee->nik }} <br>
            Jabatan : {{ $kinerja->employee->jabatan->nama ?? '-' }}
        </td>

        <td width="50%">
            Periode : {{ $kinerja->periode }} <br>
            Area : {{ $kinerja->employee->area->nama ?? '-' }}
        </td>
    </tr>
</table>

<br>

<table width="100%" border="1" cellspacing="0" cellpadding="6">
    <tr>
        <th>Pendapatan</th>
        <th>Nominal</th>
    </tr>

    @foreach ($rincian['pendapatan'] as $label => $nominal)
        <tr>
            <td>{{ ucwords(str_replace('_', ' ', $label)) }}</td>
            <td>Rp {{ number_format($nominal, 0, ',', '.') }}</td>
        </tr>
    @endforeach

    <tr>
        <td><b>Total Pendapatan</b></td>
        <td><b>Rp {{ number_format($kinerja->hitungTotalPendapatan(), 0, ',', '.') }}</b></td>
    </tr>
</table>

<br>

<table width="100%" border="1" cellspacing="0" cellpadding="6">
    <tr>
        <th>Potongan</th>
        <th>Nominal</th>
    </tr>

    @foreach ($rincian['potongan'] as $label => $nominal)
        <tr>
            <td>{{ ucwords(str_replace('_', ' ', $label)) }}</td>
            <td>Rp {{ number_format($nominal, 0, ',', '.') }}</td>
        </tr>
    @endforeach

    <tr>
        <td><b>Total Potongan</b></td>
        <td><b>Rp {{ number_format($kinerja->hitungTotalPotongan(), 0, ',', '.') }}</b></td>
    </tr>

    <tr>
        <td><b>GAJI DITERIMA</b></td>
        <td><b>Rp {{ number_format($kinerja->hitungGajiDiterima(), 0, ',', '.') }}</b></td>
    </tr>

</table>

<br><br><br>

<table width="100%">
    <tr>

        <td align="center">
            Tanggal, {{ $tanggal }}
            <br><br><br><br>

            @if (auth()->user()->signature_path)
                <img src="{{ public_path('storage/' . auth()->user()->signature_path) }}" width="120">
            @endif

            <br>
            <b>HRD, {{ auth()->user()->name }}</b>
        </td>

        <td align="center">
            Mengetahui,
            <br><br><br><br>

            @if ($kinerja->employee->signature_path)
                <img src="{{ public_path('storage/' . $kinerja->employee->signature_path) }}" width="120">
            @endif

            <br>
            <b>{{ $kinerja->employee->nama }}</b>
        </td>

    </tr>
</table>
