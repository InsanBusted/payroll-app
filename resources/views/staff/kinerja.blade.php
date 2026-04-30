<x-app-layout>
    <x-slot name="title">Kinerja Saya</x-slot>

    @if (!$employee)
        {{-- Belum punya data karyawan --}}
        <div class="flex flex-col items-center justify-center py-24 gap-5">
            <div class="w-20 h-20 rounded-3xl bg-amber-50 text-amber-400 flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
            <div class="text-center">
                <h2 class="text-lg font-bold text-slate-700">Data karyawan belum tersedia</h2>
                <p class="text-sm text-slate-400 mt-1">Hubungi administrator untuk menautkan akun Anda ke data karyawan.</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                Lengkapi Profile
            </a>
        </div>
    @else

        {{-- Header Karyawan --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-400 flex items-center justify-center text-2xl font-extrabold text-white flex-shrink-0 shadow">
                    {{ strtoupper(substr($employee->nama, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h1 class="text-xl font-extrabold text-slate-800">{{ $employee->nama }}</h1>
                    <p class="text-sm text-slate-400 mt-0.5 font-mono">NIK: {{ $employee->nik }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if ($employee->jabatan)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">{{ $employee->jabatan->nama }}</span>
                        @endif
                        @if ($employee->area)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">{{ $employee->area->nama }}</span>
                        @endif
                        @if ($employee->ptkpStatus)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-violet-100 text-violet-700">PTKP: {{ $employee->ptkpStatus->status }}</span>
                        @endif
                    </div>
                </div>

                {{-- Filter Periode --}}
                @if ($periodes->isNotEmpty())
                    <form method="GET" action="{{ route('staff.kinerja') }}" class="flex-shrink-0">
                        @php
                            $bulan = ['','Januari','Februari','Maret','April','Mei','Juni',
                                      'Juli','Agustus','September','Oktober','November','Desember'];
                        @endphp
                        <label class="block text-[11px] font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Pilih Periode</label>
                        <div class="flex gap-2">
                            <select name="periode" onchange="this.form.submit()"
                                class="border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition min-w-[180px]">
                                @foreach ($periodes as $p)
                                    @php [$y, $m] = explode('-', $p); @endphp
                                    <option value="{{ $p }}" {{ $selected == $p ? 'selected' : '' }}>
                                        {{ $bulan[(int)$m] }} {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        @if (!$kinerja)
            {{-- Belum ada data periode ini --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-16 text-center text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="font-semibold text-slate-500">Belum ada data kinerja</p>
                <p class="text-sm mt-1">Data kinerja untuk periode ini belum tersedia.</p>
            </div>
        @else
            @php
                [$y, $m] = explode('-', $kinerja->periode);
                $namaBulan   = ['','Januari','Februari','Maret','April','Mei','Juni',
                                'Juli','Agustus','September','Oktober','November','Desember'][(int)$m];
                $periodeTeks     = $namaBulan . ' ' . $y;

                // Gunakan method resmi dari model — sudah pakai SettingGaji
                $rincian         = $kinerja->rincianGaji();
                $totalPendapatan = $kinerja->hitungTotalPendapatan();
                $totalPotongan   = $kinerja->hitungTotalPotongan();
                $gajiBersih      = $kinerja->hitungGajiDiterima();

                $pendapatan = $rincian['pendapatan'] ?? [];
                $potongan   = $rincian['potongan']   ?? [];
            @endphp

            {{-- Ringkasan Gaji --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                <div class="bg-gradient-to-br from-indigo-500 to-violet-500 rounded-2xl p-6 text-white shadow-lg shadow-indigo-200">
                    <p class="text-indigo-100 text-[11px] font-semibold uppercase tracking-wider">Gaji Bersih — {{ $periodeTeks }}</p>
                    <p class="text-3xl font-extrabold mt-2">Rp {{ number_format($gajiBersih, 0, ',', '.') }}</p>
                    <p class="text-indigo-200 text-xs mt-1">Setelah semua potongan</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-center">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Pendapatan</p>
                    <p class="text-2xl font-extrabold text-emerald-600 mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    <div class="mt-2 w-full bg-emerald-100 rounded-full h-1.5">
                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col justify-center">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Potongan</p>
                    <p class="text-2xl font-extrabold text-red-500 mt-1">Rp {{ number_format($totalPotongan, 0, ',', '.') }}</p>
                    <div class="mt-2 w-full bg-red-100 rounded-full h-1.5">
                        @php $pct = $totalPendapatan > 0 ? min(100, round($totalPotongan / $totalPendapatan * 100)) : 0; @endphp
                        <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Detail Pendapatan --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h2 class="font-bold text-slate-800 text-sm">Komponen Pendapatan</h2>
                    </div>
                    <div class="divide-y divide-slate-50">
                        @foreach ([
                            ['Gaji Pokok',        $pendapatan['gaji_pokok']          ?? 0],
                            ['Tunjangan Kerapihan',$pendapatan['tunjangan_kerapihan'] ?? 0],
                            ['SRP',               $pendapatan['srp']                 ?? 0],
                            ['Grosir',            $pendapatan['grosir']              ?? 0],
                            ['Aksesoris',         $pendapatan['aksesoris']           ?? 0],
                            ['Bonus',             $pendapatan['bonus']               ?? 0],
                        ] as [$label, $val])
                        <div class="flex items-center justify-between px-6 py-3.5">
                            <span class="text-sm text-slate-600">{{ $label }}</span>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($val, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between px-6 py-3.5 bg-emerald-50">
                            <span class="text-sm font-bold text-emerald-700">Total Pendapatan</span>
                            <span class="text-sm font-bold text-emerald-700">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Detail Potongan & Kehadiran --}}
                <div class="space-y-5">
                    {{-- Potongan --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                            </div>
                            <h2 class="font-bold text-slate-800 text-sm">Potongan</h2>
                        </div>
                        <div class="divide-y divide-slate-50">
                            @foreach ([
                                ['Absensi', $potongan['absensi'] ?? 0],
                                ['BPJS TK', $potongan['bpjstk'] ?? 0],
                                ['PPh 21',  $potongan['pph21']  ?? 0],
                            ] as [$label, $val])
                            <div class="flex items-center justify-between px-6 py-3.5">
                                <span class="text-sm text-slate-600">{{ $label }}</span>
                                <span class="text-sm font-semibold text-red-600">- Rp {{ number_format($val, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                            <div class="flex items-center justify-between px-6 py-3.5 bg-red-50">
                                <span class="text-sm font-bold text-red-600">Total Potongan</span>
                                <span class="text-sm font-bold text-red-600">- Rp {{ number_format($totalPotongan, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Kehadiran --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400 mb-4">Kehadiran</p>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-4xl font-extrabold text-slate-800">{{ $kinerja->total_hadir ?? 0 }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">hari hadir bulan {{ $periodeTeks }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

</x-app-layout>
