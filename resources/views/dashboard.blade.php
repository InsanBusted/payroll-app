<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Karyawan</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">120</p>
            <p class="text-xs font-medium text-emerald-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                +4 bulan ini
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Kehadiran Hari Ini</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">95</p>
            <p class="text-xs font-medium text-emerald-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                79.2% hadir
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Gaji Bulanan</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">Rp 152M</p>
            <p class="text-xs font-medium text-emerald-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                April 2026
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Slip Tertunda</p>
            <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">8</p>
            <p class="text-xs font-medium text-red-500 flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                Perlu persetujuan
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-bold text-slate-800">Aksi Cepat</h2>
            </div>
            <div class="p-6 grid grid-cols-2 gap-3">
                @foreach ([
                    ['Tambah Karyawan', 'M12 4v16m8-8H4'],
                    ['Import Gaji', 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12'],
                    ['Cetak Slip', 'M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z'],
                    ['Lihat Laporan', 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ] as [$label, $path])
                <a href="#" class="flex flex-col items-center gap-3 py-5 rounded-xl bg-slate-50 border border-slate-200 hover:bg-indigo-50 hover:border-indigo-200 hover:-translate-y-0.5 transition-all">
                    <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-slate-700 text-center">{{ $label }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Recent Activity --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">Aktivitas Terbaru</h2>
                <span class="text-xs text-slate-400">Hari ini</span>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach ([
                    ['bg-emerald-400', 'Slip gaji April 2026 dibuat', '09:15'],
                    ['bg-indigo-400',  'Karyawan baru Budi Santoso ditambahkan', '08:40'],
                    ['bg-amber-400',   'Import absensi 120 karyawan', '08:01'],
                    ['bg-emerald-400', 'Laporan Maret 2026 disetujui direktur', 'Kemarin'],
                    ['bg-indigo-400',  'Role Finance diberikan ke Dewi Lestari', 'Kemarin'],
                ] as [$dot, $text, $time])
                <div class="flex items-center gap-3 px-6 py-3.5">
                    <span class="w-2.5 h-2.5 rounded-full {{ $dot }} flex-shrink-0"></span>
                    <p class="text-sm text-slate-700 flex-1">{{ $text }}</p>
                    <span class="text-xs text-slate-400 whitespace-nowrap">{{ $time }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
