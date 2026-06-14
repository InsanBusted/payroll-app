<x-app-layout>
    <x-slot name="title">Detail Rekap {{ $rekapPeriode->label }}</x-slot>

    {{-- Flash --}}
    @if (session('success'))
        <div id="flash-success"
            class="mb-4 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-emerald-400 hover:text-emerald-700">&times;</button>
        </div>
    @endif
    @if (session('warning'))
        <div id="flash-warning"
            class="mb-4 flex items-start gap-3 bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
            <span>{{ session('warning') }}</span>
            <button onclick="document.getElementById('flash-warning').remove()" class="ml-auto text-amber-400 hover:text-amber-700">&times;</button>
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ route('rekap_periodes.index') }}" class="hover:text-indigo-600 transition-colors font-medium">Approval Rekap</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-slate-700 font-semibold">{{ $rekapPeriode->label }}</span>
    </div>

    {{-- Banner catatan penolakan untuk Finance --}}
    @if (!$isDirektur && $rekapPeriode->is_rejected)
        <div class="mb-6 flex items-start gap-4 bg-red-50 border border-red-200 rounded-2xl px-6 py-5">
            <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-red-800 text-sm mb-1">Rekap Ini Ditolak oleh Direktur</p>
                <p class="text-xs text-red-600 mb-3">
                    Ditolak oleh <strong>{{ $rekapPeriode->rejectedBy?->name }}</strong>
                    pada {{ $rekapPeriode->rejected_at?->translatedFormat('d F Y, H:i') }}
                </p>
                <div class="bg-white border border-red-200 rounded-xl px-4 py-3">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-red-400 mb-1">Catatan Penolakan:</p>
                    <p class="text-sm text-red-800 leading-relaxed">{{ $rekapPeriode->catatan_tolak }}</p>
                </div>
                <p class="text-xs text-red-500 mt-3">Silakan lakukan perbaikan dan re-import data jika diperlukan, lalu hubungi Direktur untuk approval ulang.</p>
            </div>
        </div>
    @endif

    {{-- Header Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-800">Rekap Periode: {{ $rekapPeriode->label }}</h2>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $kinerjas->count() }} karyawan terdaftar pada periode ini</p>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-wrap justify-end">
                {{-- Status Badge --}}
                @if ($rekapPeriode->is_draft)
                    <div class="text-right">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-sm font-bold border border-slate-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Draft
                        </span>
                    </div>
                    @if (!$isDirektur)
                        <form method="POST" action="{{ route('rekap_periodes.submit', $rekapPeriode) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin rekap periode {{ $rekapPeriode->label }} sudah siap untuk di-approve/reject oleh Direktur?')"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-bold transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                                Siap Approve (Kirim ke Direktur)
                            </button>
                        </form>
                    @endif

                @elseif ($rekapPeriode->is_approved)
                    <div class="text-right">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-bold border border-emerald-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sudah Disetujui
                        </span>
                        <p class="text-xs text-slate-400 mt-1 text-right">
                            oleh <strong>{{ $rekapPeriode->approvedBy?->name }}</strong>
                            pada {{ $rekapPeriode->approved_at?->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>
                    {{-- Direktur bisa tolak meski sudah approve (untuk revisi) --}}
                    @if ($isDirektur)
                        <button onclick="openRejectModal()"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 text-sm font-semibold transition-colors border border-red-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batalkan & Tolak
                        </button>
                    @endif

                @elseif ($rekapPeriode->is_rejected)
                    <div class="text-right">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-50 text-red-700 text-sm font-bold border border-red-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Ditolak
                        </span>
                        <p class="text-xs text-slate-400 mt-1 text-right">
                            oleh <strong>{{ $rekapPeriode->rejectedBy?->name }}</strong>
                            pada {{ $rekapPeriode->rejected_at?->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>
                    {{-- Direktur bisa approve ulang setelah ditolak --}}
                    @if ($isDirektur)
                        <form method="POST" action="{{ route('rekap_periodes.approve', $rekapPeriode) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                onclick="return confirm('Setujui rekap periode {{ $rekapPeriode->label }}?')"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-bold transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve Ulang
                            </button>
                        </form>
                    @endif

                @else
                    {{-- Menunggu — tampilkan tombol aksi jika direktur --}}
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 text-amber-700 text-sm font-bold border border-amber-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Menunggu Approval
                    </span>
                    @if ($isDirektur)
                        <form method="POST" action="{{ route('rekap_periodes.approve', $rekapPeriode) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menyetujui rekap periode {{ $rekapPeriode->label }}? Finance akan dapat melakukan konfirmasi transfer setelah ini.')"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-bold transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Approve Rekap Ini
                            </button>
                        </form>
                        <button onclick="openRejectModal()"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 text-sm font-semibold transition-colors border border-red-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Tolak
                        </button>
                    @endif
                @endif
            </div>
        </div>

        {{-- Catatan penolakan (khusus direktur melihat, di dalam header card) --}}
        @if ($isDirektur && $rekapPeriode->is_rejected && $rekapPeriode->catatan_tolak)
            <div class="mt-4 bg-red-50 border border-red-200 rounded-xl px-4 py-3">
                <p class="text-[11px] font-bold uppercase tracking-wider text-red-400 mb-1">Catatan Penolakan Sebelumnya:</p>
                <p class="text-sm text-red-800">{{ $rekapPeriode->catatan_tolak }}</p>
            </div>
        @endif
    </div>

    {{-- Tabel Kinerja Karyawan --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-800">Rincian Karyawan — {{ $rekapPeriode->label }}</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Karyawan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Jabatan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Area</th>
                        <th class="text-center text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Hadir</th>
                        <th class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Gaji Bersih</th>
                        <th class="text-center text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Status Transfer</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $totalGaji = 0; @endphp
                    @forelse ($kinerjas as $k)
                        @php
                            $gajiB = $k->hitungGajiDiterimaList();
                            $totalGaji += $gajiB;
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $k->employee->nama ?? '-' }}</p>
                                <p class="text-xs text-slate-400">{{ $k->employee->nik ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $k->employee->jabatan->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $k->employee->area->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-bold">{{ $k->total_hadir }}</span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-emerald-600 whitespace-nowrap">
                                Rp {{ number_format($gajiB, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if (!$k->status_gaji)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 text-xs font-semibold">Belum Transfer</span>
                                @elseif (!$k->status_diterima)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-rose-50 text-rose-700 text-xs font-semibold border border-rose-100">Belum Diterima</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-700 text-xs font-semibold">Sudah Diterima</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">Belum ada data kinerja untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($kinerjas->count() > 0)
                    <tfoot>
                        <tr class="bg-slate-50 border-t-2 border-slate-200">
                            <td colspan="4" class="px-6 py-3 text-sm font-bold text-slate-700">Total Gaji Bersih</td>
                            <td class="px-6 py-3 text-right font-extrabold text-emerald-600 whitespace-nowrap">
                                Rp {{ number_format($totalGaji, 0, ',', '.') }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Back button --}}
    <div class="mt-6">
        <a href="{{ route('rekap_periodes.index') }}"
            class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-800 transition-colors font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Rekap
        </a>
    </div>

    {{-- Modal Tolak — hanya direktur --}}
    @if ($isDirektur)
        <div id="reject-modal"
            class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200 p-4">
            <div class="bg-white rounded-2xl p-6 sm:p-8 w-full max-w-lg shadow-2xl">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Tolak Rekap Periode</h3>
                        <p class="text-xs text-slate-500">{{ $rekapPeriode->label }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('rekap_periodes.reject', $rekapPeriode) }}">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-slate-700 mb-2">
                            Catatan / Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="catatan_tolak" rows="4" required maxlength="1000"
                            placeholder="Tuliskan alasan penolakan rekap ini, agar Finance dapat melakukan perbaikan..."
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition resize-none">{{ old('catatan_tolak') }}</textarea>
                        <p class="text-xs text-slate-400 mt-1">Catatan ini akan ditampilkan kepada Finance.</p>
                    </div>
                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button type="button" onclick="closeRejectModal()"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold bg-red-500 hover:bg-red-600 text-white transition shadow-sm">
                            Tolak Rekap Ini
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openRejectModal() {
                document.getElementById('reject-modal').classList.remove('opacity-0', 'pointer-events-none');
            }
            function closeRejectModal() {
                document.getElementById('reject-modal').classList.add('opacity-0', 'pointer-events-none');
            }
            document.getElementById('reject-modal').addEventListener('click', function(e) {
                if (e.target === this) closeRejectModal();
            });
            @if ($errors->has('catatan_tolak'))
                openRejectModal();
            @endif
        </script>
    @endif
</x-app-layout>
