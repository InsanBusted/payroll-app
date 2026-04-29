<x-app-layout>
    <x-slot name="title">Kinerja Karyawan</x-slot>

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

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Daftar Kinerja Bulanan</h2>
            <button onclick="openModal('create-modal')"
                class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kinerja
            </button>
        </div>

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
                            class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($kinerjas as $k)
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
                                <span class="bg-slate-100 px-2 py-0.5 rounded" title="SRP">{{ $k->srp }}</span>
                                /
                                <span class="bg-slate-100 px-2 py-0.5 rounded" title="Grosir">{{ $k->grosir }}</span>
                                /
                                <span class="bg-slate-100 px-2 py-0.5 rounded"
                                    title="Aksesoris">{{ $k->aksesoris }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">
                                Rp {{ number_format($k->hitungGajiDiterima(), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
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
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200"
        id="create-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Input Kinerja Bulanan</h3>
            <form method="POST" action="{{ route('kinerjas.store') }}">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Karyawan</label>
                        <select name="employee_id" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                            <option value="">— Pilih Karyawan —</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}"
                                    {{ old('employee_id') == $e->id ? 'selected' : '' }}>{{ $e->nama }}
                                    ({{ $e->nik }})</option>
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
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Point Tunj. Groom</label>
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

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="closeModal('create-modal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan
                        Kinerja</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200"
        id="edit-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-2xl shadow-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Kinerja Bulanan</h3>
            <form method="POST" id="edit-form" action="">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4 mb-6">
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

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="closeModal('edit-modal')"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan
                        Perubahan</button>
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
    </script>
</x-app-layout>
