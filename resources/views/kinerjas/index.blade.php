<x-app-layout>
    <x-slot name="title">Kinerja Karyawan</x-slot>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div id="flash-success"
            class="mb-4 flex items-start gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('flash-success').remove()"
                class="ml-auto text-emerald-400 hover:text-emerald-700">&times;</button>
        </div>
    @endif
    @if (session('warning'))
        <div id="flash-warning"
            class="mb-4 flex items-start gap-3 bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-amber-500" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
            <span>{{ session('warning') }}</span>
            <button onclick="document.getElementById('flash-warning').remove()"
                class="ml-auto text-amber-400 hover:text-amber-700">&times;</button>
        </div>
    @endif
    @if ($errors->any())
        <div
            class="mb-4 flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4 shadow-sm">
            <div
                class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Data Kinerja</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $kinerjas->total() }}</p>
            </div>
        </div>
    </div>

    {{-- Import Excel Card (Khusus Finance) --}}
    @if (auth()->user()->role->name === 'finance')
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800 text-sm">Import Data Kinerja dari Excel</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Upload file Excel (.xlsx / .xls) dengan kolom: NIK
                        Karyawan,
                        Total Hadir, Tunj. Groom, SRP, GROSIR, AKSESORIS, BONUS, Absensi</p>
                </div>
            </div>
            <div class="px-4 sm:px-6 py-5">
                <form method="POST" action="{{ route('kinerjas.import') }}" enctype="multipart/form-data"
                    id="import-form" class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
                    @csrf

                    {{-- Periode Bulan & Tahun --}}
                    <div class="w-full sm:w-auto flex-shrink-0">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Periode</label>
                        <input type="month" name="periode" required value="{{ date('Y-m') }}"
                            class="w-full sm:w-auto border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition min-w-[180px]">
                    </div>

                    {{-- Upload File --}}
                    <div class="flex-1 w-full">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">File Excel</label>
                        <div class="relative">
                            <input type="file" name="file" id="excel-file" accept=".xlsx,.xls,.csv" required
                                onchange="updateFileName(this)"
                                class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            <div id="file-label"
                                class="flex items-center gap-3 border border-dashed border-slate-300 rounded-xl px-4 py-2.5 text-sm text-slate-500 hover:border-emerald-400 hover:bg-emerald-50 transition-colors cursor-pointer w-full">
                                <svg class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span id="file-name-text" class="truncate">Klik untuk pilih file Excel...</span>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="w-full sm:w-auto flex-shrink-0">
                        <button type="submit"
                            class="w-full sm:w-auto justify-center inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors shadow-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Import Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div
            class="px-4 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-slate-800 text-center sm:text-left">Daftar Kinerja Bulanan</h2>
            <div class="flex flex-wrap items-center justify-center sm:justify-end gap-2">
                <a href="{{ route('kinerjas.export', array_filter(['periode' => request('periode')])) }}"
                    class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export Excel{{ request('periode') ? ' (' . request('periode') . ')' : '' }}
                </a>
                @if (auth()->user()->role->name === 'finance')
                    <button onclick="openModal('delete-periode-modal')"
                        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus per Periode
                    </button>
                    <button onclick="openModal('create-modal')"
                        class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Manual
                    </button>
                @endif
            </div>
        </div>

        {{-- Filter Bar --}}
        <form method="GET" action="{{ route('kinerjas.index') }}"
            class="px-4 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row gap-3 items-start sm:items-end flex-wrap">

            {{-- Search --}}
            <div class="flex-1 w-full sm:w-auto min-w-[200px]">
                <label class="block text-[11px] font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Cari Nama
                    / NIK</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nama atau NIK karyawan..."
                        class="w-full pl-9 pr-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                </div>
            </div>

            {{-- Filter Periode --}}
            <div class="w-full sm:w-auto flex-shrink-0">
                <label
                    class="block text-[11px] font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Periode</label>
                <select name="periode"
                    class="w-full sm:w-auto border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition min-w-[170px]">
                    <option value="">— Semua Periode —</option>
                    @foreach ($availablePeriodes as $p)
                        @php
                            [$y, $m] = explode('-', $p);
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
                        <option value="{{ $p }}" {{ request('periode') == $p ? 'selected' : '' }}>
                            {{ $bulan[(int) $m] }} {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Sort --}}
            <div class="w-full sm:w-auto flex-shrink-0">
                <label
                    class="block text-[11px] font-semibold uppercase tracking-wider text-slate-400 mb-1.5">Urutkan</label>
                <select name="sort"
                    class="w-full sm:w-auto border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition min-w-[170px]">
                    <option value="periode_desc"
                        {{ request('sort', 'periode_desc') == 'periode_desc' ? 'selected' : '' }}>Periode Terbaru
                    </option>
                    <option value="periode_asc" {{ request('sort') == 'periode_asc' ? 'selected' : '' }}>Periode
                        Terlama</option>
                    <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A → Z
                    </option>
                    <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z → A
                    </option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="w-full sm:w-auto flex gap-2 flex-shrink-0">
                <button type="submit"
                    class="w-full sm:w-auto justify-center inline-flex items-center gap-1.5 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>
                    Filter
                </button>
                @if (request('search') || request('periode') || request('sort'))
                    <a href="{{ route('kinerjas.index') }}"
                        class="w-full sm:w-auto justify-center inline-flex items-center gap-1.5 border border-slate-300 text-slate-600 text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-slate-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Result info --}}
        @if (request('search') || request('periode'))
            <div class="px-6 py-2 bg-indigo-50 border-b border-indigo-100 text-xs text-indigo-700 font-medium">
                Menampilkan {{ $kinerjas->total() }} hasil
                @if (request('search'))
                    untuk <strong>"{{ request('search') }}"</strong>
                @endif
                @if (request('periode'))
                    @php
                        [$y, $m] = explode('-', request('periode'));
                        $bl = [
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
                    periode <strong>{{ $bl[(int) $m] }} {{ $y }}</strong>
                @endif
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Periode</th>
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Karyawan</th>
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Hadir</th>
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Groom/SRP/Grs/Aks</th>
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Gaji Bersih</th>
                        <th
                            class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Status
                        </th>
                        <th
                            class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($kinerjas as $k)
                        {{-- @php
                            dd($k->employee);
                        @endphp --}}

                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-slate-700 whitespace-nowrap">{{ $k->periode }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-800">{{ $k->employee->nama }}</p>
                                <p class="text-xs text-slate-400">{{ $k->employee->nik }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-bold">{{ $k->total_hadir }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500 whitespace-nowrap space-x-1">
                                <span class="bg-slate-100 px-2 py-0.5 rounded"
                                    title="Tunjangan Groom">{{ $k->tunjangan_groom }}</span> /
                                <span class="bg-slate-100 px-2 py-0.5 rounded"
                                    title="SRP">{{ $k->srp }}</span>
                                /
                                <span class="bg-slate-100 px-2 py-0.5 rounded"
                                    title="Grosir">{{ $k->grosir }}</span>
                                /
                                <span class="bg-slate-100 px-2 py-0.5 rounded"
                                    title="Aksesoris">{{ $k->aksesoris }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">
                                Rp {{ number_format($k->hitungGajiDiterimaList(), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="space-y-1">

                                    {{-- Status Transfer --}}
                                    @if ($k->status_gaji)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-semibold">
                                            Sudah Transfer
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 text-xs font-semibold">
                                            Belum Transfer
                                        </span>
                                    @endif

                                    {{-- Status Diterima --}}
                                    @if ($k->status_diterima)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                            Sudah Diterima
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-semibold">
                                            Belum Diterima
                                        </span>
                                    @endif

                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                                <a href="{{ route('kinerjas.show', $k) }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 text-slate-600 text-xs font-semibold hover:bg-slate-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                                @if (auth()->user()->role->name === 'finance')
                                    <button
                                        onclick="openEditModal({{ $k->id }}, '{{ $k->employee_id }}', '{{ $k->periode }}', {{ $k->total_hadir }}, {{ $k->tunjangan_groom }}, {{ $k->srp }}, {{ $k->grosir }}, {{ $k->aksesoris }}, {{ $k->bonus }}, {{ $k->bpjstk }}, {{ $k->absensi }}, {{ $k->pph21 }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('kinerjas.destroy', $k) }}" class="inline"
                                        onsubmit="return confirm('Hapus data kinerja ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                                {{-- Finance konfirmasi transfer --}}
                                @if (auth()->user()->role->name === 'finance' && !$k->status_gaji)
                                    <form method="POST" action="{{ route('kinerjas.transfer', $k) }}"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold hover:bg-emerald-100 transition-colors">
                                            Sudah Transfer
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">Belum ada data
                                kinerja.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($kinerjas->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end">{{ $kinerjas->links() }}</div>
        @endif
    </div>

    {{-- Create Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200 p-4"
        id="create-modal">
        <div class="bg-white rounded-2xl p-5 sm:p-8 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Input Kinerja Bulanan</h3>
            <form method="POST" action="{{ route('kinerjas.store') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Karyawan</label>
                        <select name="employee_id" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                            <option value="">— Pilih Karyawan —</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}"
                                    {{ old('employee_id') == $e->id ? 'selected' : '' }}>{{ $e->nama }}
                                    ({{ $e->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Periode <span
                                class="font-normal text-slate-400">(YYYY-MM)</span></label>
                        <input type="month" name="periode" required value="{{ old('periode', date('Y-m')) }}"
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Point Pendapatan --}}
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-indigo-500 border-b border-indigo-100 pb-2 mb-4">
                            Parameter Pendapatan</p>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Total Hadir
                                    (Hari)</label>
                                <input type="number" name="total_hadir" required min="0"
                                    value="{{ old('total_hadir', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Point Tunj.
                                    Groom</label>
                                <input type="number" name="tunjangan_groom" required min="0"
                                    value="{{ old('tunjangan_groom', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Point SRP</label>
                                <input type="number" name="srp" required min="0"
                                    value="{{ old('srp', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Point Grosir</label>
                                <input type="number" name="grosir" required min="0"
                                    value="{{ old('grosir', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Point Aksesoris</label>
                                <input type="number" name="aksesoris" required min="0"
                                    value="{{ old('aksesoris', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Bonus Nominal
                                    (Rp)</label>
                                <input type="number" name="bonus" min="0" value="{{ old('bonus', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                        </div>
                    </div>

                    {{-- Point Potongan --}}
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-red-500 border-b border-red-100 pb-2 mb-4">
                            Parameter Potongan</p>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Total Absen/Telat
                                    (Hari)</label>
                                <input type="number" name="absensi" min="0" value="{{ old('absensi', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">PPh 21 Nominal
                                    (Rp)</label>
                                <input type="number" name="pph21" min="0" value="{{ old('pph21', 0) }}"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-8">
                    <button type="button" onclick="closeModal('create-modal')"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan
                        Kinerja</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200 p-4"
        id="edit-modal">
        <div class="bg-white rounded-2xl p-5 sm:p-8 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Kinerja Bulanan</h3>
            <form method="POST" id="edit-form" action="">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Karyawan</label>
                        <select id="e_employee" name="employee_id" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}">{{ $e->nama }} ({{ $e->nik }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Periode</label>
                        <input type="month" id="e_periode" name="periode" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-indigo-500 border-b border-indigo-100 pb-2 mb-4">
                            Parameter Pendapatan</p>
                        <div class="space-y-4">
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Total
                                    Hadir</label><input type="number" id="e_hadir" name="total_hadir" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Point Tunj.
                                    Groom</label><input type="number" id="e_groom" name="tunjangan_groom" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Point SRP</label><input
                                    type="number" id="e_srp" name="srp" required min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Point
                                    Grosir</label><input type="number" id="e_grosir" name="grosir" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Point
                                    Aksesoris</label><input type="number" id="e_aksesoris" name="aksesoris" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Bonus
                                    Nominal</label><input type="number" id="e_bonus" name="bonus"
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                        </div>
                    </div>
                    <div>
                        <p
                            class="text-[10px] font-bold uppercase tracking-widest text-red-500 border-b border-red-100 pb-2 mb-4">
                            Parameter Potongan</p>
                        <div class="space-y-4">
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">Total Absen/Telat
                                    (Hari)</label><input type="number" id="e_absensi" name="absensi" min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                            <div><label class="block text-xs font-semibold text-slate-700 mb-1">PPh 21 Nominal
                                    (Rp)</label><input type="number" id="e_pph21" name="pph21" min="0"
                                    class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm"></div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-8">
                    <button type="button" onclick="closeModal('edit-modal')"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Periode Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200 p-4"
        id="delete-periode-modal">
        <div class="bg-white rounded-2xl p-5 sm:p-8 w-full max-w-md shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Hapus Data Kinerja per Periode</h3>
            <form method="POST" action="{{ route('kinerjas.destroyPeriode') }}">
                @csrf @method('DELETE')
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Periode</label>
                    <select name="periode" id="delete-periode-select" required
                        class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition" placeholder="— Pilih Periode —">
                        <option value="">— Pilih Periode —</option>
                        @foreach ($availablePeriodes as $p)
                            @php
                                [$y, $m] = explode('-', $p);
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
                            <option value="{{ $p }}" {{ request('periode') == $p ? 'selected' : '' }}>
                                {{ $bulan[(int) $m] }} {{ $y }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-slate-500">Semua data kinerja pada periode yang dipilih akan dihapus secara permanen.</p>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-8">
                    <button type="button" onclick="closeModal('delete-periode-modal')"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus SEMUA data pada periode ini? Aksi ini tidak dapat dibatalkan.')"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold bg-red-500 text-white hover:bg-red-600 transition">Hapus Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('opacity-0', 'pointer-events-none');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('opacity-0', 'pointer-events-none');
        }
        document.querySelectorAll('[id$="-modal"]').forEach(m => m.addEventListener('click', e => {
            if (e.target === m) closeModal(m.id);
        }));

        function openEditModal(id, empId, periode, hadir, groom, srp, grosir, akses, bonus, absensi, pph21) {
            document.getElementById('edit-form').action = '/kinerjas/' + id;
            document.getElementById('e_employee').value = empId;
            document.getElementById('e_periode').value = periode;
            document.getElementById('e_hadir').value = hadir;
            document.getElementById('e_groom').value = groom;
            document.getElementById('e_srp').value = srp;
            document.getElementById('e_grosir').value = grosir;
            document.getElementById('e_aksesoris').value = akses;
            document.getElementById('e_bonus').value = bonus;
            document.getElementById('e_absensi').value = absensi;
            document.getElementById('e_pph21').value = pph21;
            openModal('edit-modal');
        }
        @if ($errors->any())
            openModal('create-modal');
        @endif

        // Update label nama file yang dipilih
        function updateFileName(input) {
            const label = document.getElementById('file-name-text');
            if (input.files && input.files[0]) {
                label.textContent = input.files[0].name;
                label.classList.add('text-emerald-700', 'font-semibold');
            } else {
                label.textContent = 'Klik untuk pilih file Excel...';
                label.classList.remove('text-emerald-700', 'font-semibold');
            }
        }
    </script>
    
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#delete-periode-select', {
                create: false,
                sortField: {
                    field: "text",
                    direction: "desc"
                }
            });
        });
    </script>

</x-app-layout>
