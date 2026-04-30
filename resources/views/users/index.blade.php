<x-app-layout>
    <x-slot name="title">User Management</x-slot>

    {{-- Superadmin Banner --}}
    <div class="flex items-center gap-3 bg-gradient-to-r from-violet-600 to-indigo-600 text-white rounded-2xl px-6 py-4 mb-6 shadow-lg">
        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        <div>
            <p class="font-bold text-sm">Area Super Admin</p>
            <p class="text-white/70 text-xs">Halaman ini hanya dapat diakses oleh Super Admin. Kelola seluruh akun pengguna sistem di sini.</p>
        </div>
        <span class="ml-auto bg-white/20 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">Restricted</span>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total User</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $totalUser }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Dengan Role</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $linkedUser }}</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Tanpa Role</p>
                <p class="text-2xl font-extrabold text-slate-800">{{ $unlinkedUser }}</p>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800">Daftar User</h2>
            <button onclick="openModal('create-modal')"
                    class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah User
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">#</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">User</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Role</th>
                        <th class="text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Bergabung</th>
                        <th class="text-right text-[11px] font-semibold uppercase tracking-wider text-slate-400 px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    @php
                        $roleColors = [
                            'superadmin' => 'bg-violet-100 text-violet-700',
                            'admin'      => 'bg-indigo-100 text-indigo-700',
                            'finance'    => 'bg-emerald-100 text-emerald-700',
                            'employee'   => 'bg-amber-100 text-amber-700',
                        ];
                        $avatarGradients = [
                            'superadmin' => 'from-violet-500 to-violet-300',
                            'admin'      => 'from-indigo-500 to-indigo-300',
                            'finance'    => 'from-emerald-500 to-emerald-300',
                            'employee'   => 'from-amber-500 to-amber-300',
                        ];
                        $roleKey   = $user->role?->name ?? 'none';
                        $roleColor = $roleColors[$roleKey]    ?? 'bg-slate-100 text-slate-500';
                        $avatarGrad= $avatarGradients[$roleKey] ?? 'from-slate-400 to-slate-300';
                    @endphp
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-xs text-slate-400">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br {{ $avatarGrad }} flex items-center justify-center text-xs font-bold text-white flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                                        @if($user->role?->name === 'superadmin')
                                            <span class="text-[9px] font-bold bg-violet-100 text-violet-600 px-1.5 py-0.5 rounded uppercase">SA</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $roleColor }}">
                                    {{ $user->role->display_name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">No Role</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-1">
                            <button onclick="openEditModal({{ $user->id }},'{{ addslashes($user->name) }}','{{ $user->email }}','{{ $user->role_id }}')"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </button>
                            @if($user->id !== Auth::id())
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline"
                                  onsubmit="return confirm('Hapus user {{ addslashes($user->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-50 text-slate-400">Akun Anda</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-16 text-center text-slate-400 text-sm">Belum ada user.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 flex justify-end">{{ $users->links() }}</div>
        @endif
    </div>

    {{-- Create Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200" id="create-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-slate-800 mb-1">Tambah User Baru</h3>
            <p class="text-xs text-slate-400 mb-6">User baru akan segera bisa login setelah disimpan.</p>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama</label>
                        <input type="text" name="name" required placeholder="Nama Lengkap" value="{{ old('name') }}"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" required placeholder="user@email.com" value="{{ old('email') }}"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password</label>
                        <input type="password" name="password" required placeholder="Min. 6 karakter"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role</label>
                        <select name="role_id" class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— No Role —</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}" {{ old('role_id') == $r->id ? 'selected' : '' }}>{{ $r->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('create-modal')"
                            class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Buat User</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed inset-0 bg-slate-900/50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200" id="edit-modal">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Edit User</h3>
            <form method="POST" id="edit-form" action="">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama</label>
                        <input id="e-name" type="text" name="name" required
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email</label>
                        <input id="e-email" type="email" name="email" required
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Password Baru <span class="font-normal text-slate-400">(opsional)</span></label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role</label>
                        <select id="e-role" name="role_id"
                                class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            <option value="">— No Role —</option>
                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="closeModal('edit-modal')"
                            class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-semibold bg-indigo-500 text-white hover:bg-indigo-600 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id)  { document.getElementById(id).classList.remove('opacity-0','pointer-events-none'); }
        function closeModal(id) { document.getElementById(id).classList.add('opacity-0','pointer-events-none'); }
        document.querySelectorAll('[id$="-modal"]').forEach(m => m.addEventListener('click', e => { if(e.target===m) closeModal(m.id); }));
        function openEditModal(id, name, email, roleId) {
            document.getElementById('edit-form').action = '/users/' + id;
            document.getElementById('e-name').value  = name;
            document.getElementById('e-email').value = email;
            document.getElementById('e-role').value  = roleId;
            openModal('edit-modal');
        }
        @if ($errors->any()) openModal('create-modal'); @endif
    </script>
</x-app-layout>
