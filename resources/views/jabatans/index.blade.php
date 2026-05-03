<x-app-layout>
    <x-slot name="title">Master Jabatan</x-slot>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Jabatan</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $jabatans->count() }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Karyawan</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $jabatans->sum('employees_count') }}</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Daftar Jabatan</h2>

            <button onclick="openModal('create-modal')"
                class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Jabatan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">#</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Jabatan</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Gaji Pokok</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Deskripsi</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Karyawan</th>
                        <th class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($jabatans as $jabatan)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-xs text-slate-400">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-300 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-[18px] h-[18px] text-white" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>

                                    <span class="font-semibold text-slate-800">{{ $jabatan->nama }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-xs text-slate-400">
                                Rp {{ number_format($jabatan->rate_gaji_pokok, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-xs text-slate-400 max-w-[220px]">
                                {{ $jabatan->deskripsi ?? '—' }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                    {{ $jabatan->employees_count }} karyawan
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right space-x-1">
                                <button
                                    onclick="openEditModal(
                                        {{ $jabatan->id }},
                                        '{{ addslashes($jabatan->nama) }}',
                                        '{{ addslashes($jabatan->deskripsi ?? '') }}',
                                        '{{ $jabatan->rate_gaji_pokok }}'
                                    )"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>

                                <form method="POST" action="{{ route('jabatans.destroy', $jabatan) }}" class="inline"
                                    onsubmit="return confirm('Hapus jabatan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        {{ $jabatan->employees_count > 0 ? 'disabled' : '' }}
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors disabled:opacity-40 disabled:cursor-not-allowed">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">
                                Belum ada jabatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- CREATE MODAL --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200"
        id="create-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Tambah Jabatan</h3>

            <form method="POST" action="{{ route('jabatans.store') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Jabatan</label>
                        <input type="text" name="nama" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate Gaji Pokok</label>
                        <input type="number" name="rate_gaji_pokok" required value="30000"
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('create-modal')"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200"
        id="edit-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit Jabatan</h3>

            <form method="POST" id="edit-form">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Jabatan</label>
                        <input id="e-nama" type="text" name="nama" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate Gaji Pokok</label>
                        <input id="e-rate" type="number" name="rate_gaji_pokok" required
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea id="e-desc" name="deskripsi" rows="3"
                            class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('edit-modal')"
                        class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white">
                        Simpan
                    </button>
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

        function openEditModal(id, nama, deskripsi, rate) {
            document.getElementById('edit-form').action = '/jabatans/' + id;
            document.getElementById('e-nama').value = nama;
            document.getElementById('e-desc').value = deskripsi;
            document.getElementById('e-rate').value = rate;
            openModal('edit-modal');
        }

        document.querySelectorAll('[id$="-modal"]').forEach(m => {
            m.addEventListener('click', e => {
                if (e.target === m) closeModal(m.id);
            });
        });
    </script>
</x-app-layout>