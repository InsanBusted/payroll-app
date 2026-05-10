<x-app-layout>
    <x-slot name="title">Dashboard </x-slot>

    @if(Auth::user()->hasRole('staff'))

        {{-- ══════════════════════════════════════════════ --}}
        {{-- DASHBOARD STAFF — Sambutan + Shortcut         --}}
        {{-- ══════════════════════════════════════════════ --}}
        @php $emp = Auth::user()->employee; @endphp

        {{-- Hero greeting --}}
        <div class="bg-gradient-to-br from-indigo-500 to-violet-500 rounded-2xl p-8 mb-6 text-white shadow-lg shadow-indigo-200 flex items-center justify-between gap-6">
            <div>
                <p class="text-indigo-100 text-sm font-medium mb-1">Selamat datang 👋</p>
                <h1 class="text-3xl font-extrabold">{{ $emp?->nama ?? Auth::user()->name }}</h1>
                @if($emp)
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if($emp->jabatan)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white">{{ $emp->jabatan->nama }}</span>
                        @endif
                        @if($emp->area)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white">{{ $emp->area->nama }}</span>
                        @endif
                        @if($emp->ptkpStatus)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-white/20 text-white">PTKP: {{ $emp->ptkpStatus->status }}</span>
                        @endif
                    </div>
                @endif
            </div>
            <div class="w-20 h-20 rounded-2xl bg-white/20 flex items-center justify-center text-4xl font-extrabold text-white flex-shrink-0 hidden sm:flex">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>

        {{-- Shortcut cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <a href="{{ route('staff.kinerja') }}"
                class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-5 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-500 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform shadow-md shadow-indigo-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-base">Kinerja Saya</p>
                    <p class="text-sm text-slate-400 mt-0.5">Lihat detail pendapatan & potongan bulanan</p>
                </div>
                <svg class="w-5 h-5 text-slate-300 ml-auto group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>

            <a href="{{ route('profile.edit') }}"
                class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-5 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform shadow-md shadow-emerald-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-base">Profile Saya</p>
                    <p class="text-sm text-slate-400 mt-0.5">Edit akun & data karyawan</p>
                </div>
                <svg class="w-5 h-5 text-slate-300 ml-auto group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

    @else
        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Karyawan</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">{{ \App\Models\Employee::count() }}</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Data Kinerja</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">{{ \App\Models\EmployeeKinerja::count() }}</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Periode Tercatat</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">{{ \App\Models\EmployeeKinerja::distinct('periode')->count('periode') }}</p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-lg transition-all">
                <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total User</p>
                <p class="text-3xl font-extrabold text-slate-800 mt-1 mb-2">{{ \App\Models\User::count() }}</p>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-bold text-slate-800">Aksi Cepat</h2>
            </div>
            <div class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ([
                    ['Tambah Karyawan', 'M12 4v16m8-8H4', route('employees.index'), 'direktur'],
                    ['Import Kinerja',  'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12', route('kinerjas.index'), 'direktur'],
                    ['Kinerja Bulanan', 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', route('kinerjas.index'), null],
                    ['Setting Gaji',   'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', route('setting_gaji.index'), 'direktur'],
                ] as [$label, $path, $href, $hideForRole])
                    @if(!$hideForRole || !Auth::user()->hasRole($hideForRole))
                    <a href="{{ $href }}" class="flex flex-col items-center gap-3 py-5 rounded-xl bg-slate-50 border border-slate-200 hover:bg-indigo-50 hover:border-indigo-200 hover:-translate-y-0.5 transition-all">
                        <div class="w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-700 text-center">{{ $label }}</span>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>

    @endif

</x-app-layout>
