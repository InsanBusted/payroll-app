<x-app-layout>
    <x-slot name="title">Approval Rekap Kinerja</x-slot>

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

    {{-- Header desc --}}
    <div class="mb-6">
        @if ($isDirektur)
            <p class="text-sm text-slate-500">Daftar rekap kinerja karyawan yang telah diimport oleh Finance. Anda dapat menyetujui atau menolak rekap sebelum Finance melakukan konfirmasi transfer gaji.</p>
        @else
            <p class="text-sm text-slate-500">Daftar rekap kinerja karyawan per periode. Anda hanya dapat melihat status approval. Jika rekap ditolak, catatan alasan penolakan tersedia di halaman detail.</p>
        @endif
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Rekap</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $rekaps->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Sudah Disetujui</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $rekaps->where('is_approved', true)->count() }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Ditolak</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $rekaps->where('is_rejected', true)->count() }}</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
            </div>
            <h2 class="font-bold text-slate-800">Daftar Rekap Kinerja per Periode</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Periode</th>
                        <th class="text-center text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Jumlah Karyawan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Status</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Oleh</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Tanggal</th>
                        <th class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($rekaps as $rekap)
                        <tr class="hover:bg-slate-50 transition-colors {{ $rekap->is_rejected ? 'bg-red-50/40' : '' }}">
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $rekap->label }}
                                <span class="text-xs text-slate-400 font-normal ml-1">({{ $rekap->periode }})</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                    {{ $rekap->jumlah_karyawan }} karyawan
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($rekap->is_approved)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                        Disetujui
                                    </span>
                                @elseif ($rekap->is_rejected)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-50 text-red-700 text-xs font-semibold border border-red-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Menunggu Approval
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-sm">
                                @if ($rekap->is_approved)
                                    {{ $rekap->approvedBy?->name ?? '—' }}
                                @elseif ($rekap->is_rejected)
                                    {{ $rekap->rejectedBy?->name ?? '—' }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-sm">
                                @if ($rekap->is_approved)
                                    {{ $rekap->approved_at?->translatedFormat('d F Y') ?? '—' }}
                                @elseif ($rekap->is_rejected)
                                    {{ $rekap->rejected_at?->translatedFormat('d F Y') ?? '—' }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('rekap_periodes.show', $rekap) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">
                                Belum ada rekap periode yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
