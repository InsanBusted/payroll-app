<x-app-layout>
    <x-slot name="title">Profile Saya</x-slot>

    {{-- Flash --}}
    @if (session('success'))
        <div id="flash-ok" class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-xl px-4 py-3">
            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('flash-ok').remove()" class="ml-auto text-emerald-400 hover:text-emerald-700 text-lg leading-none">&times;</button>
        </div>
    @endif

    {{-- Header Avatar --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-6 flex items-center gap-5">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-400 flex items-center justify-center text-2xl font-extrabold text-white flex-shrink-0 shadow">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-xl font-extrabold text-slate-800">{{ Auth::user()->name }}</h1>
            <p class="text-sm text-slate-400 mt-0.5">{{ Auth::user()->email }}</p>
            <span class="inline-flex mt-1.5 items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-100 text-indigo-700">
                {{ Auth::user()->role?->display_name ?? 'No Role' }}
            </span>
        </div>
        @if ($employee)
            <div class="ml-auto text-right hidden sm:block">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">NIK</p>
                <p class="font-mono font-bold text-slate-700 text-sm mt-0.5">{{ $employee->nik }}</p>
                <p class="text-xs text-slate-400">{{ $employee->jabatan?->nama ?? '—' }} · {{ $employee->area?->nama ?? '—' }}</p>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- ── Kolom Kiri: Akun ── --}}
        <div class="space-y-6">

            {{-- Edit Info Akun --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h2 class="font-bold text-slate-800 text-sm">Informasi Akun</h2>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" class="px-6 py-5 space-y-4">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex justify-end pt-1">
                        <button type="submit" class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Simpan Akun
                        </button>
                    </div>
                </form>
            </div>

            {{-- Ganti Password --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h2 class="font-bold text-slate-800 text-sm">Ganti Password</h2>
                </div>
                <form method="POST" action="{{ route('profile.password') }}" class="px-6 py-5 space-y-4">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password Lama</label>
                        <input type="password" name="current_password" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 transition">
                        @error('current_password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password Baru</label>
                        <input type="password" name="password" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 transition">
                        @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 transition">
                    </div>
                    <div class="flex justify-end pt-1">
                        <button type="submit" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            Ganti Password
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- ── Kolom Kanan: Data Karyawan (hanya non-superadmin) ── --}}
        @unless(Auth::user()->hasRole('superadmin'))
        <div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800 text-sm">Data Karyawan</h2>
                        @if (!$employee)
                            <p class="text-[11px] text-amber-500 font-medium mt-0.5">⚠ Belum ada data karyawan — isi form ini untuk membuatnya.</p>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.employee') }}" enctype="multipart/form-data" class="px-6 py-5 space-y-4">
                    @csrf

                    {{-- Identitas --}}
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2">Identitas</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $employee?->nama) }}" required
                                class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                            @error('nama')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Karyawan</label>
                            <input type="text" name="nik" value="{{ old('nik', $employee?->nik) }}" required
                                class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                            @error('nik')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jabatan</label>
                            <select name="jabatan_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                                <option value="">— Pilih Jabatan —</option>
                                @foreach ($jabatans as $j)
                                    <option value="{{ $j->id }}" {{ old('jabatan_id', $employee?->jabatan_id) == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Area</label>
                            <select name="area_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                                <option value="">— Pilih Area —</option>
                                @foreach ($areas as $a)
                                    <option value="{{ $a->id }}" {{ old('area_id', $employee?->area_id) == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Status PTKP</label>
                            <select name="ptkp_status_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                                <option value="">— Pilih Status PTKP —</option>
                                @foreach ($ptkpStatuses as $ps)
                                    <option value="{{ $ps->id }}" {{ old('ptkp_status_id', $employee?->ptkp_status_id) == $ps->id ? 'selected' : '' }}>{{ $ps->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Bank --}}
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mt-2">Informasi Bank</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Rekening</label>
                            <input type="text" name="no_rek_bank" value="{{ old('no_rek_bank', $employee?->no_rek_bank) }}"
                                class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Bank</label>
                            <select name="nama_bank" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 transition">
                                <option value="">— Pilih Bank —</option>
                                @foreach(['BCA','BNI','BRI','Mandiri','BTN','CIMB Niaga','Permata','Danamon'] as $bank)
                                    <option value="{{ $bank }}" {{ old('nama_bank', $employee?->nama_bank) == $bank ? 'selected' : '' }}>{{ $bank }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tanda Tangan --}}
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mt-2">Tanda Tangan Digital</p>
                    @if ($employee?->signature_path)
                        <div class="mb-2">
                            <p class="text-xs text-slate-500 mb-1.5">Tanda tangan saat ini:</p>
                            <img src="{{ Storage::url($employee->signature_path) }}" alt="TTD"
                                class="h-16 rounded-lg border border-slate-200 object-contain bg-slate-50 p-1">
                        </div>
                    @endif
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                            {{ $employee?->signature_path ? 'Ganti Tanda Tangan' : 'Upload Tanda Tangan' }}
                            <span class="font-normal text-slate-400">(PNG/JPG, maks 2MB)</span>
                        </label>
                        <input type="file" name="signature_path" accept="image/png,image/jpeg"
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition">
                        @error('signature_path')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $employee ? 'Perbarui Data Karyawan' : 'Buat Data Karyawan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8 flex flex-col items-center justify-center text-center gap-4 h-full">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-400 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-slate-700">Superadmin</p>
                    <p class="text-sm text-slate-400 mt-1">Akun ini tidak memiliki data karyawan.<br>Kelola data karyawan di menu <a href="{{ route('employees.index') }}" class="text-indigo-500 hover:underline font-semibold">Manajemen Karyawan</a>.</p>
                </div>
            </div>
        </div>
        @endunless

    </div>
</x-app-layout>
