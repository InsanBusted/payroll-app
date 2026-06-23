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
                            Nilai PPh21 dihitung otomatis oleh sistem menggunakan Tarif TER sesuai dengan PMK No 168 tahun 2023
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

    {{-- INFORMASI PENGHITUNGAN PPH21 --}}
    <div class="mt-8 mb-12 bg-white p-8 rounded-2xl border border-slate-200 shadow-sm max-w-4xl mx-auto" x-data="{ activeCategory: 'A' }">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 14l2-2 4 4m0-7l-2 2-4-4M3 12h18" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Informasi Penghitungan PPh21 (TER)</h2>
                <p class="text-sm text-slate-500 mt-1">Panduan logika perhitungan PPh21 dan tabel Tarif Efektif Rata-rata (TER) berdasarkan kategori PTKP.</p>
            </div>
        </div>

        {{-- METODE PERHITUNGAN --}}
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/60 mb-8">
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                Logika Perhitungan (Sesuai Kinerja Karyawan)
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Langkah 1 -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">1</div>
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Hitung Pendapatan Kotor</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Total Pendapatan kotor dihitung dari akumulasi pendapatan dikurangi potongan absensi:
                        </p>
                        <ul class="text-[11px] text-slate-600 mt-2 space-y-1 list-disc pl-4 font-medium">
                            <li>Gaji Pokok (Hadir × Rate Jabatan)</li>
                            <li>Tunjangan Grooming</li>
                            <li>SRP, Grosir, Aksesoris (Kategori Sales)</li>
                            <li>Bonus tambahan</li>
                            <li class="text-red-500 font-semibold">DIKURANGI: Potongan Absensi (Absen × Rate Potongan)</li>
                        </ul>
                    </div>
                </div>

                <!-- Langkah 2 -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">2</div>
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tentukan Kategori PTKP</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Karyawan dicocokkan ke kategori berdasarkan Status PTKP:
                        </p>
                        <div class="mt-3 space-y-2">
                            @foreach($ptkpCategories as $cat)
                                <div class="text-[11px] flex justify-between items-center bg-slate-50 p-1.5 rounded border border-slate-200/60 font-medium">
                                    <span class="font-bold text-indigo-600">Kategori {{ $cat->code }}</span>
                                    <span class="text-slate-500 text-[10px]">{{ $cat->description }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Langkah 3 -->
                <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm mb-3">3</div>
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Terapkan Tarif TER</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Mencari persentase tarif pajak (%) berdasarkan rentang Pendapatan Kotor pada kategori PTKP karyawan.
                        </p>
                        <div class="mt-4 p-2.5 bg-emerald-50 border border-emerald-100 rounded-lg text-center">
                            <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider block mb-1">Rumus Akhir</span>
                            <span class="text-xs font-bold text-emerald-600">Pendapatan Kotor × Tarif TER (%)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL TARIF TER --}}
        <div>
            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                Tabel Referensi Tarif Efektif Rata-rata (TER)
            </h3>

            <!-- Tab Buttons -->
            <div class="flex border-b border-slate-200 mb-6">
                @foreach($ptkpCategories as $cat)
                    <button type="button"
                        @click="activeCategory = '{{ $cat->code }}'"
                        class="px-5 py-3 text-xs font-bold uppercase tracking-wider border-b-2 transition-all"
                        :class="activeCategory === '{{ $cat->code }}' 
                            ? 'border-indigo-500 text-indigo-600 bg-indigo-50/40' 
                            : 'border-transparent text-slate-500 hover:text-slate-800 hover:bg-slate-50'"
                    >
                        Kategori {{ $cat->code }}
                    </button>
                @endforeach
            </div>

            <!-- Tab Contents -->
            @foreach($ptkpCategories as $cat)
                <div x-show="activeCategory === '{{ $cat->code }}'" class="space-y-4" style="display: none;" x-cloak>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 bg-indigo-50/50 p-4 rounded-xl border border-indigo-100/80">
                        <div>
                            <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Kategori {{ $cat->code }}</span>
                            <p class="text-xs text-slate-600 mt-0.5">Mencakup status PTKP karyawan: <span class="font-bold text-slate-800">{{ $cat->description }}</span></p>
                        </div>
                        <span class="text-[11px] font-medium px-2.5 py-1 bg-white text-indigo-600 rounded-full border border-indigo-200 shadow-sm self-start sm:self-center font-bold">
                            {{ count($cat->terRates) }} Baris Tarif
                        </span>
                    </div>

                    <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                        <div class="max-h-96 overflow-y-auto">
                            <table class="w-full text-left border-collapse text-xs">
                                <thead>
                                    <tr class="bg-slate-50 text-slate-700 border-b border-slate-200 font-bold sticky top-0">
                                        <th class="py-3 px-4 w-16 text-center">No</th>
                                        <th class="py-3 px-4">Rentang Pendapatan Bruto Bulanan</th>
                                        <th class="py-3 px-4 text-right w-32">Tarif TER</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                                    @forelse($cat->terRates as $index => $rate)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 text-center text-slate-400">{{ $index + 1 }}</td>
                                            <td class="py-2.5 px-4">
                                                @if($rate->min_salary == 0)
                                                    Sampai dengan Rp{{ number_format($rate->max_salary, 0, ',', '.') }}
                                                @elseif(is_null($rate->max_salary))
                                                    Di atas Rp{{ number_format($rate->min_salary - 1, 0, ',', '.') }}
                                                @else
                                                    Lebih dari Rp{{ number_format($rate->min_salary - 1, 0, ',', '.') }} s.d. Rp{{ number_format($rate->max_salary, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td class="py-2.5 px-4 text-right font-bold text-slate-800">
                                                {{ number_format($rate->rate, 2, ',', '.') }}%
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 text-center text-slate-400 font-normal">Tidak ada data tarif TER untuk kategori ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
