<x-app-layout>
    <x-slot name="title">Manajemen Karyawan</x-slot>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Karyawan</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $totalEmployees }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Terhubung Akun</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $linkedEmployees }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Tanpa Akun</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $unlinkedEmployees }}</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Daftar Karyawan</h2>
            <button onclick="openModal('create-modal')"
                    class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah Karyawan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">#</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Karyawan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Jabatan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Area</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">No. Rekening</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Akun</th>
                        <th class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                @forelse ($employees as $emp)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-xs text-slate-400">{{ $loop->iteration + ($employees->currentPage() - 1) * $employees->perPage() }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-300 flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                                    {{ strtoupper(substr($emp->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $emp->nama }}</p>
                                    <p class="text-xs text-slate-400 font-mono">NIK: {{ $emp->nik }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if ($emp->jabatan)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">{{ $emp->jabatan->nama }}</span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($emp->area)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">{{ $emp->area->nama }}</span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($emp->no_rek_bank)
                                <p class="text-sm text-slate-700 font-mono">{{ $emp->no_rek_bank }}</p>
                                <p class="text-xs text-slate-400">{{ $emp->nama_bank }}</p>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($emp->user)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $emp->user->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-slate-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    Tidak ada
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                            <button onclick="openEditModal({{ $emp->id }},'{{ addslashes($emp->nik) }}','{{ addslashes($emp->nama) }}','{{ $emp->jabatan_id }}','{{ $emp->area_id }}','{{ addslashes($emp->no_rek_bank ?? '') }}','{{ addslashes($emp->nama_bank ?? '') }}','{{ $emp->user_id }}','{{ $emp->signature_path }}')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </button>
                            <form method="POST" action="{{ route('employees.destroy', $emp) }}" class="inline" onsubmit="return confirm('Hapus karyawan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-16 text-center text-slate-400 text-sm">Belum ada karyawan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($employees->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end">{{ $employees->links() }}</div>
        @endif
    </div>

    {{-- Create Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200" id="create-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Tambah Karyawan</h3>
            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                @csrf
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4">Data Pribadi</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama" required placeholder="Budi Santoso" value="{{ old('nama') }}"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Karyawan</label>
                        <input type="text" name="nik" required placeholder="EMP001" value="{{ old('nik') }}"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jabatan</label>
                        <select name="jabatan_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Jabatan —</option>
                            @foreach ($jabatans as $j)
                                <option value="{{ $j->id }}" {{ old('jabatan_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Area</label>
                        <select name="area_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Area —</option>
                            @foreach ($areas as $a)
                                <option value="{{ $a->id }}" {{ old('area_id') == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Informasi Bank</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Rekening Bank</label>
                        <input type="text" name="no_rek_bank" placeholder="1234567890" value="{{ old('no_rek_bank') }}"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Bank</label>
                        <select name="nama_bank" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Bank —</option>
                            @foreach(['BCA','BNI','BRI','Mandiri','BTN','CIMB Niaga','Permata','Danamon'] as $bank)
                                <option value="{{ $bank }}" {{ old('nama_bank') == $bank ? 'selected' : '' }}>{{ $bank }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Akun Pengguna</p>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hubungkan ke Akun User <span class="font-normal text-slate-400">(opsional)</span></label>
                    <select name="user_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                        <option value="">— Tidak Dihubungkan —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Hanya user yang belum memiliki data karyawan yang ditampilkan.</p>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Tanda Tangan Digital</p>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Upload Tanda Tangan <span class="font-normal text-slate-400">(PNG/JPG, maks 2MB)</span></label>
                    <input type="file" name="signature_path" accept="image/png,image/jpeg"
                           class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                    <p class="text-[11px] text-slate-400 mt-1">Digunakan untuk export slip gaji dan laporan PDF.</p>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('create-modal')" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200" id="edit-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Karyawan</h3>
            <form method="POST" id="edit-form" action="" enctype="multipart/form-data">
                @csrf @method('PUT')
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4">Data Pribadi</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input id="e-nama" type="text" name="nama" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Karyawan</label>
                        <input id="e-nik" type="text" name="nik" required class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jabatan</label>
                        <select id="e-jabatan" name="jabatan_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Jabatan —</option>
                            @foreach ($jabatans as $j)
                                <option value="{{ $j->id }}">{{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Area</label>
                        <select id="e-area" name="area_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Area —</option>
                            @foreach ($areas as $a)
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Informasi Bank</p>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Rekening Bank</label>
                        <input id="e-rek" type="text" name="no_rek_bank" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Bank</label>
                        <select id="e-bank" name="nama_bank" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— Pilih Bank —</option>
                            @foreach(['BCA','BNI','BRI','Mandiri','BTN','CIMB Niaga','Permata','Danamon'] as $bank)
                                <option value="{{ $bank }}">{{ $bank }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Akun Pengguna</p>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hubungkan ke Akun User</label>
                    <select id="e-user" name="user_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                        <option value="">— Tidak Dihubungkan —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 border-b border-slate-100 pb-2 mb-4 mt-2">Tanda Tangan Digital</p>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Upload Tanda Tangan Baru <span class="font-normal text-slate-400">(opsional — kosongkan jika tidak diubah)</span></label>
                    <div id="e-sig-preview" class="mb-2 hidden">
                        <img id="e-sig-img" src="" alt="Tanda Tangan" class="h-16 rounded-lg border border-slate-200 object-contain bg-slate-50 p-1">
                    </div>
                    <input type="file" name="signature_path" accept="image/png,image/jpeg"
                           class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-600 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('edit-modal')" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id)  { document.getElementById(id).classList.remove('opacity-0','pointer-events-none'); }
        function closeModal(id) { document.getElementById(id).classList.add('opacity-0','pointer-events-none'); }
        document.querySelectorAll('[id$="-modal"]').forEach(m => m.addEventListener('click', e => { if(e.target===m) closeModal(m.id); }));
        function openEditModal(id,nik,nama,jabatanId,areaId,noRek,namaBank,userId,sigPath){
            document.getElementById('edit-form').action='/employees/'+id;
            document.getElementById('e-nik').value=nik;
            document.getElementById('e-nama').value=nama;
            document.getElementById('e-jabatan').value=jabatanId;
            document.getElementById('e-area').value=areaId;
            document.getElementById('e-rek').value=noRek;
            document.getElementById('e-bank').value=namaBank;
            document.getElementById('e-user').value=userId;
            const prev=document.getElementById('e-sig-preview');
            const img=document.getElementById('e-sig-img');
            if(sigPath){ img.src='/storage/'+sigPath; prev.classList.remove('hidden'); }
            else { prev.classList.add('hidden'); }
            openModal('edit-modal');
        }
        @if ($errors->any()) openModal('create-modal'); @endif
    </script>
</x-app-layout>
