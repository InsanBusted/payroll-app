<x-app-layout>
    <x-slot name="title">Setting Master Gaji</x-slot>

    <div class="mb-6 bg-white p-8 rounded-2xl border border-slate-200 shadow-sm max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Master Parameter Gaji</h2>
                <p class="text-sm text-slate-500 mt-1">Ubah nilai default (rate) yang akan digunakan untuk mengalikan
                    poin kinerja karyawan.</p>
            </div>
        </div>

        <form action="{{ route('setting_gaji.update', $setting->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- PENDAPATAN --}}
                <div>
                    <h3
                        class="text-xs font-bold uppercase tracking-widest text-indigo-500 mb-4 border-b border-indigo-100 pb-2">
                        Rate Pendapatan</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate Tunj. Kerapihan (Per
                                Groom)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="rate_tunjangan_groom"
                                    value="{{ $setting->rate_tunjangan_groom }}" required min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate SRP (Per
                                Point)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="rate_srp" value="{{ $setting->rate_srp }}" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate Grosir (Per
                                Point)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="rate_grosir" value="{{ $setting->rate_grosir }}" required
                                    min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rate Aksesoris (Per
                                Point)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="rate_aksesoris" value="{{ $setting->rate_aksesoris }}"
                                    required min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- POTONGAN --}}
                <div>
                    <h3
                        class="text-xs font-bold uppercase tracking-widest text-red-500 mb-4 border-b border-red-100 pb-2">
                        Rate Potongan</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Potongan BPJSTK (Nominal
                                Pengali)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="potongan_bpjstk" value="{{ $setting->potongan_bpjstk }}"
                                    required min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Potongan Absensi (Per
                                Hari)</label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-sm font-semibold text-slate-400">Rp</span>
                                <input type="number" name="potongan_absensi" value="{{ $setting->potongan_absensi }}"
                                    required min="0"
                                    class="w-full border border-slate-300 rounded-xl pl-10 pr-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Bebas BPJSTK (Masa Kerja &lt; X Bulan)
                            </label>
                            <div class="relative">
                                <input type="number" name="bebas_bpjstk_bulan"
                                    value="{{ $setting->bebas_bpjstk_bulan }}" required min="1"
                                    class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition">
                                <span
                                    class="absolute right-3.5 top-2.5 text-sm font-semibold text-slate-400">Bulan</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">
                                Karyawan dengan masa kerja kurang dari nilai ini tidak dikenakan potongan BPJSTK.
                            </p>
                        </div>

                    </div>

                    <div class="mt-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <p class="text-xs text-slate-500 leading-relaxed font-medium">
                            <span class="text-indigo-500 font-bold">Catatan:</span><br>
                            Nilai PPh21 tidak disetting di sini, melainkan diinput langsung pada kinerja per karyawan
                            karena nilainya berbeda tergantung PTKP.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-bold px-6 py-3 rounded-xl transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
