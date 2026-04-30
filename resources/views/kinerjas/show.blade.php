<x-app-layout>
    <x-slot name="title">Detail Kinerja — {{ $kinerja->employee->nama }}</x-slot>

    {{-- Back --}}
    <div class="mb-6">
        <a href="{{ route('kinerjas.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Kinerja
        </a>
    </div>

    {{-- Hero Card --}}
    <div
        class="bg-white rounded-2xl border border-slate-200 p-6 mb-5 flex flex-col sm:flex-row items-start sm:items-center gap-5">
        {{-- Avatar --}}
        <div
            class="w-11 h-11 rounded-full bg-indigo-100 flex items-center justify-center text-sm font-semibold text-indigo-700 flex-shrink-0">
            {{ strtoupper(substr($kinerja->employee->nama, 0, 1)) }}
        </div>

        {{-- Identity --}}
        <div class="flex-1 min-w-0">
            <p class="font-semibold text-slate-800 text-base truncate">{{ $kinerja->employee->nama }}</p>
            <p class="text-xs text-slate-400 font-mono mt-0.5">NIK: {{ $kinerja->employee->nik }}</p>
            <div class="flex flex-wrap gap-2 mt-2.5">
                @if ($kinerja->employee->jabatan)
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                        {{ $kinerja->employee->jabatan->nama }}
                    </span>
                @endif
                @if ($kinerja->employee->area)
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                        {{ $kinerja->employee->area->nama }}
                    </span>
                @endif
                @if ($kinerja->employee->ptkpStatus)
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-violet-100 text-violet-700">PTKP:
                        {{ $kinerja->employee->ptkpStatus->status }}</span>
                @endif
            </div>
        </div>

        {{-- Periode --}}
        <div class="flex-shrink-0 sm:text-right">
            @php
                [$y, $m] = explode('-', $kinerja->periode);
                $bulan = [
                    '',
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
            @endphp
            <p class="text-[10px] font-semibold uppercase tracking-widest text-slate-400 mb-1">Periode</p>
            <p class="text-2xl font-extrabold text-slate-800 leading-none">{{ $bulan[(int) $m] }}</p>
            <p class="text-sm text-slate-400 mt-1">{{ $y }}</p>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
            <div
                class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Pendapatan</p>
                <p class="text-xl font-extrabold text-emerald-600 mt-0.5 tabular-nums">
                    Rp {{ number_format($kinerja->hitungTotalPendapatan(), 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Total Potongan --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-11 h-11 rounded-2xl bg-red-50 text-red-400 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Potongan</p>
                <p class="text-xl font-extrabold text-red-500 mt-0.5 tabular-nums">
                    Rp {{ number_format($kinerja->hitungTotalPotongan(), 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- Gaji Diterima --}}
        <div class="bg-indigo-50 rounded-2xl border border-indigo-100 p-5 flex items-center gap-4">
            <div
                class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-indigo-500">Gaji Diterima</p>
                <p class="text-xl font-extrabold text-indigo-700 mt-0.5 tabular-nums">
                    Rp {{ number_format($kinerja->hitungGajiDiterima(), 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Detail Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-5">

        {{-- Parameter Kinerja --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-3.5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Parameter Kinerja</h3>
            </div>
            @php
                $params = [
                    ['label' => 'Total Hadir', 'value' => $kinerja->total_hadir . ' hari'],
                    [
                        'label' => 'Point Tunjangan Groom',
                        'value' => number_format($kinerja->tunjangan_groom, 0, ',', '.') . ' poin',
                    ],
                    ['label' => 'Point SRP', 'value' => number_format($kinerja->srp, 0, ',', '.') . ' poin'],
                    ['label' => 'Point Grosir', 'value' => number_format($kinerja->grosir, 0, ',', '.') . ' poin'],
                    [
                        'label' => 'Point Aksesoris',
                        'value' => number_format($kinerja->aksesoris, 0, ',', '.') . ' poin',
                    ],
                    ['label' => 'Bonus', 'value' => 'Rp ' . number_format($kinerja->bonus, 0, ',', '.')],
                    ['label' => 'Absen / Telat', 'value' => $kinerja->absensi . ' hari'],
                ];
            @endphp
            <div class="divide-y divide-slate-100">
                @foreach ($params as $p)
                    <div class="flex items-center justify-between px-6 py-3 hover:bg-slate-50 transition-colors">
                        <span class="text-sm text-slate-500">{{ $p['label'] }}</span>
                        <span class="text-sm font-semibold text-slate-800 tabular-nums">{{ $p['value'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Rincian Perhitungan --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-3.5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Rincian Perhitungan</h3>
            </div>

            @if (!empty($rincian))
                <div class="flex-1 px-6 py-5 space-y-5">
                    {{-- Pendapatan --}}
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 mb-3">Pendapatan</p>
                        @php
                            $pendapatanLabels = [
                                'gaji_pokok' => 'Gaji Pokok',
                                'tunjangan_kerapihan' => 'Tunjangan Kerapihan',
                                'srp' => 'Nilai SRP',
                                'grosir' => 'Nilai Grosir',
                                'aksesoris' => 'Nilai Aksesoris',
                                'bonus' => 'Bonus',
                            ];
                        @endphp
                        <div class="divide-y divide-slate-100">
                            @foreach ($rincian['pendapatan'] as $key => $nominal)
                                <div class="flex items-center justify-between py-2.5">
                                    <span class="text-sm text-slate-500">{{ $pendapatanLabels[$key] ?? $key }}</span>
                                    <span class="text-sm font-semibold text-emerald-600 tabular-nums">Rp
                                        {{ number_format($nominal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between py-2.5">
                                <span class="text-sm font-semibold text-slate-700">Subtotal Pendapatan</span>
                                <span class="text-sm font-bold text-emerald-600 tabular-nums">Rp
                                    {{ number_format($kinerja->hitungTotalPendapatan(), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Potongan --}}
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-red-500 mb-3">Potongan</p>
                        @php
                            $potonganLabels = [
                                'bpjstk' => 'BPJS TK',
                                'absensi' => 'Potongan Absensi',
                                'pph21' => 'PPh 21',
                            ];
                        @endphp
                        <div class="divide-y divide-slate-100">
                            @foreach ($rincian['potongan'] as $key => $nominal)
                                <div class="flex items-center justify-between py-2.5">
                                    <span class="text-sm text-slate-500">{{ $potonganLabels[$key] ?? $key }}</span>
                                    <span class="text-sm font-semibold text-red-500 tabular-nums">Rp
                                        {{ number_format($nominal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div class="flex items-center justify-between py-2.5">
                                <span class="text-sm font-semibold text-slate-700">Subtotal Potongan</span>
                                <span class="text-sm font-bold text-red-500 tabular-nums">Rp
                                    {{ number_format($kinerja->hitungTotalPotongan(), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gaji Bersih Footer --}}
                <div class="border-t border-slate-100 bg-slate-50 px-6 py-3.5 flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-700">Gaji Bersih Diterima</span>
                    <span class="text-base font-extrabold text-indigo-600 tabular-nums">
                        Rp {{ number_format($kinerja->hitungGajiDiterimaList(), 0, ',', '.') }}
                    </span>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center px-6 py-16 text-center">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-400">Setting gaji belum dikonfigurasi.</p>
                        <p class="text-xs text-slate-300 mt-1">Rincian tidak dapat ditampilkan.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Action Footer --}}
    <div class="bg-white rounded-2xl border border-slate-200 px-6 py-4 flex items-center justify-between">
        <a href="{{ route('kinerjas.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-slate-600 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none"
                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('kinerjas.slip', $kinerja->id) }}" target="_blank"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold hover:bg-emerald-100 transition-colors border border-emerald-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview Slip
            </a>
            <a href="{{ route('kinerjas.slip.download', $kinerja->id) }}"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-violet-50 text-violet-700 text-xs font-semibold hover:bg-violet-100 transition-colors border border-violet-100">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download PDF
            </a>
            <button
                onclick="openEditFromDetail({{ $kinerja->id }}, '{{ $kinerja->employee_id }}', '{{ $kinerja->periode }}', {{ $kinerja->total_hadir }}, {{ $kinerja->tunjangan_groom }}, {{ $kinerja->srp }}, {{ $kinerja->grosir }}, {{ $kinerja->aksesoris }}, {{ $kinerja->bonus }}, {{ $kinerja->bpjstk }}, {{ $kinerja->absensi }}, {{ $kinerja->pph21 }})"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Kinerja
            </button>
            <form method="POST" action="{{ route('kinerjas.destroy', $kinerja) }}"
                onsubmit="return confirm('Hapus data kinerja ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors border border-red-100 hover:border-red-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200"
        id="edit-modal-detail">
        <div class="bg-white rounded-2xl w-full max-w-2xl mx-4 shadow-2xl max-h-[90vh] overflow-y-auto">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-8 pt-6 pb-5 border-b border-slate-100">
                <h3 class="text-base font-bold text-slate-800">Edit Kinerja Bulanan</h3>
                <button type="button" onclick="closeDetailModal()"
                    class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" id="edit-form-detail" action="" class="px-8 py-6">
                @csrf @method('PUT')

                {{-- Karyawan + Periode --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Karyawan</label>
                        <input type="hidden" id="ed_employee" name="employee_id"
                            value="{{ $kinerja->employee_id }}">
                        <div
                            class="w-full border border-slate-200 bg-slate-50 rounded-xl px-4 py-2.5 text-sm text-slate-700 font-semibold">
                            {{ $kinerja->employee->nama }} <span
                                class="font-normal text-slate-400">({{ $kinerja->employee->nik }})</span>
                        </div>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Periode</label>
                        <input type="month" id="ed_periode" name="periode" required
                            value="{{ $kinerja->periode }}"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                </div>

                {{-- Parameter --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2">
                    {{-- Pendapatan --}}
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 border-b border-slate-100 pb-2 mb-5">
                            Parameter Pendapatan</p>
                        <div class="space-y-4">
                            @php
                                $incomeFields = [
                                    ['id' => 'ed_hadir', 'name' => 'total_hadir', 'label' => 'Total Hadir (Hari)'],
                                    ['id' => 'ed_groom', 'name' => 'tunjangan_groom', 'label' => 'Point Tunj. Groom'],
                                    ['id' => 'ed_srp', 'name' => 'srp', 'label' => 'Point SRP'],
                                    ['id' => 'ed_grosir', 'name' => 'grosir', 'label' => 'Point Grosir'],
                                    ['id' => 'ed_aksesoris', 'name' => 'aksesoris', 'label' => 'Point Aksesoris'],
                                    ['id' => 'ed_bonus', 'name' => 'bonus', 'label' => 'Bonus Nominal (Rp)'],
                                ];
                            @endphp
                            @foreach ($incomeFields as $f)
                                <div>
                                    <label for="{{ $f['id'] }}"
                                        class="block text-xs font-medium text-slate-600 mb-1.5">{{ $f['label'] }}</label>
                                    <input type="number" id="{{ $f['id'] }}" name="{{ $f['name'] }}"
                                        min="0"
                                        class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition tabular-nums">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Potongan --}}
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-red-500 border-b border-slate-100 pb-2 mb-5">
                            Parameter Potongan</p>
                        <div class="space-y-4">
                            <div>
                                <label for="ed_absensi" class="block text-xs font-medium text-slate-600 mb-1.5">Total
                                    Absen / Telat (Hari)</label>
                                <input type="number" id="ed_absensi" name="absensi" min="0"
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition tabular-nums">
                            </div>
                            <div>
                                <label for="ed_pph21" class="block text-xs font-medium text-slate-600 mb-1.5">PPh 21
                                    Nominal (Rp)</label>
                                <input type="number" id="ed_pph21" name="pph21" min="0"
                                    class="w-full border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition tabular-nums">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Actions --}}
                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
                    <button type="button" onclick="closeDetailModal()"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditFromDetail(id, empId, periode, hadir, groom, srp, grosir, akses, bonus, bpjstk, absensi, pph21) {
            document.getElementById('edit-form-detail').action = '/kinerjas/' + id;
            document.getElementById('ed_employee').value = empId;
            document.getElementById('ed_periode').value = periode;
            document.getElementById('ed_hadir').value = hadir;
            document.getElementById('ed_groom').value = groom;
            document.getElementById('ed_srp').value = srp;
            document.getElementById('ed_grosir').value = grosir;
            document.getElementById('ed_aksesoris').value = akses;
            document.getElementById('ed_bonus').value = bonus;
            document.getElementById('ed_absensi').value = absensi;
            document.getElementById('ed_pph21').value = pph21;
            const modal = document.getElementById('edit-modal-detail');
            modal.classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeDetailModal() {
            const modal = document.getElementById('edit-modal-detail');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        document.getElementById('edit-modal-detail').addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
    </script>

</x-app-layout>
