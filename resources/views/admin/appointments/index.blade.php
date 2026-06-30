@extends('layouts.admin')

@section('content')
<div x-data="{ sopOpen: false, activeTab: 'alur' }">
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Janji Online</h2>
        <p class="text-gray-500">Kelola dan pantau semua pendaftaran janji online dari pasien.</p>
    </div>
    <div class="mt-4 md:mt-0">
        <button @click="sopOpen = true" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2 text-sm">
            <i class="fas fa-book-open"></i> SOP Janji Online
        </button>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-400 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-yellow-700 uppercase tracking-wide">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-900">{{ $totalMenunggu }}</p>
        </div>
    </div>
    <div class="bg-emerald-50 border border-emerald-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-emerald-700 uppercase tracking-wide">Dikonfirmasi</p>
            <p class="text-2xl font-bold text-emerald-900">{{ $totalDikonfirmasi }}</p>
        </div>
    </div>
    <div class="bg-red-50 border border-red-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-red-400 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-times-circle"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-red-700 uppercase tracking-wide">Dibatalkan</p>
            <p class="text-2xl font-bold text-red-900">{{ $totalDibatalkan }}</p>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Cari Nama / No. HP</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Status</label>
            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dikonfirmasi" {{ request('status') === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Poli</label>
            <select name="poli" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <option value="">Semua Poli</option>
                @foreach($poliList as $poli)
                    <option value="{{ $poli }}" {{ request('poli') === $poli ? 'selected' : '' }}>{{ $poli }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-5 py-4 rounded-2xl mb-5 flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">#</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pasien</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Tujuan Poli</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($appointments as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4 text-sm text-gray-400">{{ $appointments->firstItem() + $loop->index }}</td>
                <td class="px-5 py-4">
                    <div class="font-bold text-sm text-gray-900">{{ $item->nama }}</div>
                    @if($item->kode_pendaftaran)
                        <div class="text-[11px] font-bold text-emerald-700">{{ $item->kode_pendaftaran }}</div>
                    @endif
                    <div class="text-xs text-gray-400">{{ $item->no_telp }}</div>
                    @if($item->email)
                        <div class="text-xs text-gray-400">{{ $item->email }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="text-sm font-semibold text-gray-800">{{ $item->tujuan_poli }}</div>
                    @if($item->doctor)
                        <div class="text-xs text-gray-400">{{ $item->doctor->name }}</div>
                    @endif
                    @if($item->tanggal_kunjungan)
                        <div class="text-[11px] text-emerald-700 font-semibold mt-1"><i class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d/m/Y') }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    @php
                        $colors = [
                            'menunggu'     => 'bg-yellow-100 text-yellow-700',
                            'dikonfirmasi' => 'bg-emerald-100 text-emerald-700',
                            'dibatalkan'   => 'bg-red-100 text-red-700',
                        ];
                    @endphp
                    <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $colors[$item->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $item->status_label }}
                    </span>
                </td>
                <td class="px-5 py-4 text-center space-x-1">
                    <a href="{{ route('admin.appointments.show', $item) }}" class="inline-flex items-center justify-center w-8 h-8 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Lihat Detail">
                        <i class="fas fa-eye text-sm"></i>
                    </a>
                    <form action="{{ route('admin.appointments.destroy', $item) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus data janji ini?')" class="inline-flex items-center justify-center w-8 h-8 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                            <i class="fas fa-trash-alt text-sm"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                    <i class="fas fa-calendar-times text-5xl mb-4 block text-gray-200"></i>
                    <p class="font-semibold">Belum ada pendaftaran janji online.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $appointments->links() }}
</div>

<!-- SOP POPUP MODAL -->
<div x-show="sopOpen" 
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
     
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="sopOpen = false"></div>

    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[85vh] overflow-hidden flex flex-col z-10 border border-gray-100"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
             
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-emerald-50 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-book-reader text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">SOP Penanganan Janji Online</h3>
                        <p class="text-xs text-gray-500">Panduan Standard Operating Procedure untuk Front Office (FO)</p>
                    </div>
                </div>
                <button @click="sopOpen = false" class="text-gray-400 hover:text-gray-600 p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex border-b border-gray-100 bg-gray-50/50 px-6 py-2 gap-2">
                <button @click="activeTab = 'alur'" 
                        :class="activeTab === 'alur' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                    <i class="fas fa-route"></i> Alur Kerja
                </button>
                <button @click="activeTab = 'pesan'" 
                        :class="activeTab === 'pesan' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                    <i class="fab fa-whatsapp"></i> Template WA
                </button>
                <button @click="activeTab = 'dokter'" 
                        :class="activeTab === 'dokter' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                    <i class="fas fa-user-md"></i> Pergantian Dokter
                </button>
                <button @click="activeTab = 'kasus'" 
                        :class="activeTab === 'kasus' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i> Kasus Khusus
                </button>
            </div>

            <!-- Tab Contents (Scrollable) -->
            <div class="p-6 overflow-y-auto flex-1 text-sm text-gray-600 space-y-4 leading-relaxed">
                
                <!-- Tab: Alur Kerja -->
                <div x-show="activeTab === 'alur'" class="space-y-4">
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 text-emerald-800 flex gap-3 items-start">
                        <i class="fas fa-info-circle text-emerald-600 mt-0.5 text-base"></i>
                        <p class="text-xs">SOP ini dimulai segera setelah data booking masuk di admin panel. Lakukan pengecekan berkala (terutama saat pergantian shift atau pagi hari).</p>
                    </div>

                    <div class="relative pl-6 border-l-2 border-emerald-100 space-y-5">
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-sm"></div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">1. Cek Booking Masuk</h4>
                            <p class="text-xs text-gray-500">Buka menu <strong>Janji Online</strong>. Data baru akan berstatus <span class="bg-yellow-100 text-yellow-700 px-1.5 py-0.5 rounded text-[10px] font-bold">⏳ Menunggu</span>.</p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-sm"></div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">2. Periksa Detail Pendaftaran</h4>
                            <p class="text-xs text-gray-500">Klik tombol <strong>Lihat Detail</strong> (<i class="fas fa-eye"></i>) pada baris pasien untuk melihat data diri, hari, dan dokter tujuan.</p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-sm"></div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">3. Hubungi Pasien</h4>
                            <p class="text-xs text-gray-500">Klik tombol <strong>Hubungi via WhatsApp</strong> di panel <em>Aksi Cepat</em>. Kirim pesan konfirmasi sesuai template.</p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-emerald-500 border-4 border-white shadow-sm"></div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">4. Update Status & Catatan</h4>
                            <p class="text-xs text-gray-500">Setelah pasien konfirmasi, ubah status menjadi <span class="bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded text-[10px] font-bold">✅ Dikonfirmasi</span> (atau <span class="bg-red-100 text-red-700 px-1.5 py-0.5 rounded text-[10px] font-bold">❌ Dibatalkan</span> jika batal). Masukkan catatan admin bila perlu, lalu klik <strong>Simpan Perubahan</strong>.</p>
                        </div>
                    </div>
                </div>

                <!-- Tab: Template Pesan -->
                <div x-show="activeTab === 'pesan'" class="space-y-4" x-data="{ copied1: false, copied2: false }">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900 text-xs uppercase tracking-wider text-emerald-700">1. Template Konfirmasi (Jadwal OK)</span>
                            <button @click="navigator.clipboard.writeText($refs.temp1.innerText); copied1 = true; setTimeout(() => copied1 = false, 2000)"
                                    class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                                <i class="fas" :class="copied1 ? 'fa-check text-emerald-600' : 'fa-copy'"></i>
                                <span x-text="copied1 ? 'Tersalin!' : 'Salin Template'"></span>
                            </button>
                        </div>
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 font-mono text-xs text-slate-700 whitespace-pre-line leading-relaxed" x-ref="temp1">Halo Bapak/Ibu Pasien, saya petugas Front Office RSIA IBI Surabaya.

Mengonfirmasi pendaftaran janji online Anda:
- Kode Bukti: [KODE_BOOKING]
- Nama: [NAMA_PASIEN]
- Poli: [POLI_TUJUAN]
- Dokter: [NAMA_DOKTER]
- Tanggal Kunjungan: [TANGGAL_KUNJUNGAN]

Pendaftaran Anda telah kami konfirmasi di sistem. Silakan datang ke rumah sakit 15 menit sebelum jadwal dokter dimulai dan tunjukkan kode booking ini ke petugas Front Office. Terima kasih.</div>
                    </div>

                    <div class="space-y-3 pt-2">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900 text-xs uppercase tracking-wider text-amber-700">2. Template Reschedule (Dokter Batal Praktek)</span>
                            <button @click="navigator.clipboard.writeText($refs.temp2.innerText); copied2 = true; setTimeout(() => copied2 = false, 2000)"
                                    class="bg-amber-50 hover:bg-amber-100 text-amber-700 px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5">
                                <i class="fas" :class="copied2 ? 'fa-check text-amber-600' : 'fa-copy'"></i>
                                <span x-text="copied2 ? 'Tersalin!' : 'Salin Template'"></span>
                            </button>
                        </div>
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 font-mono text-xs text-slate-700 whitespace-pre-line leading-relaxed" x-ref="temp2">Halo Bapak/Ibu Pasien, saya petugas Front Office RSIA IBI Surabaya.

Terkait pendaftaran online Anda ([KODE_BOOKING]) untuk dr. [NAMA_DOKTER] pada tanggal [TANGGAL_AWAL], kami menginfokan bahwa dokter yang bersangkutan berhalangan praktek pada waktu tersebut.

Kami ingin menawarkan alternatif jadwal berikut:
Opsi A: Tetap periksa di Poli [POLI] dengan dokter pengganti dr. [DOKTER_PENGGANTI]
Opsi B: Reschedule dr. [NAMA_DOKTER] ke hari [HARI_BARU], [TANGGAL_BARU]

Mohon konfirmasi opsi mana yang Bapak/Ibu pilih. Terima kasih atas pengertiannya.</div>
                    </div>
                </div>

                <!-- Tab: Pergantian Dokter -->
                <div x-show="activeTab === 'dokter'" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-gray-100 rounded-2xl p-4 bg-slate-50/50">
                            <h4 class="font-bold text-gray-900 text-xs uppercase tracking-wider text-emerald-700 mb-2">🟢 Pilihan 1: Dokter Pengganti (Sama Hari)</h4>
                            <ul class="list-disc pl-4 space-y-2 text-xs">
                                <li>Pastikan dokter pengganti memiliki jadwal aktif di hari tersebut.</li>
                                <li>Hubungi pasien & tawarkan nama dokter pengganti.</li>
                                <li>Jika pasien setuju:
                                    <ul class="list-circle pl-4 mt-1 space-y-1">
                                        <li>Tulis di <strong>Catatan Admin</strong> (contoh: <em>"Dialihkan ke dr. [Nama Pengganti]"</em>).</li>
                                        <li>Ubah status pendaftaran ke <strong>Dikonfirmasi</strong>.</li>
                                        <li>Simpan perubahan.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="border border-gray-100 rounded-2xl p-4 bg-slate-50/50">
                            <h4 class="font-bold text-gray-900 text-xs uppercase tracking-wider text-amber-700 mb-2">🟡 Pilihan 2: Reschedule (Ganti Hari/Tanggal)</h4>
                            <ul class="list-disc pl-4 space-y-2 text-xs">
                                <li>Buka jadwal dokter untuk melihat hari operasional dokter bersangkutan berikutnya.</li>
                                <li>Hubungi pasien & tawarkan hari/tanggal baru.</li>
                                <li>Jika pasien setuju:
                                    <ul class="list-circle pl-4 mt-1 space-y-1">
                                        <li>Tulis tanggal reschedule di <strong>Catatan Admin</strong> (contoh: <em>"Reschedule ke tanggal dd/mm/yyyy"</em>).</li>
                                        <li>Ubah status pendaftaran ke <strong>Dikonfirmasi</strong> agar antrian tidak hangus.</li>
                                        <li>Simpan perubahan.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab: Kasus Khusus -->
                <div x-show="activeTab === 'kasus'" class="space-y-3 text-xs">
                    <div class="border border-red-100 rounded-2xl p-4 bg-red-50/30 space-y-2">
                        <h4 class="font-bold text-red-800 text-sm">❌ Pasien Menolak Alternatif / Batal Kunjungan</h4>
                        <p>Jika pasien memilih untuk membatalkan kunjungan karena dokter berhalangan atau alasan pribadi:</p>
                        <ol class="list-decimal pl-4 space-y-1">
                            <li>Ubah status janji menjadi <strong>Dibatalkan</strong>.</li>
                            <li>Tulis alasan pembatalan pada <strong>Catatan Admin</strong> (misal: <em>"Batal: Pasien tidak berkenan reschedule/dokter pengganti"</em>).</li>
                            <li>Klik <strong>Simpan Perubahan</strong> agar sistem mencatat history pembatalan.</li>
                        </ol>
                    </div>

                    <div class="border border-amber-100 rounded-2xl p-4 bg-amber-50/30 space-y-2">
                        <h4 class="font-bold text-amber-800 text-sm">📞 Pasien Tidak Merespon (No Response)</h4>
                        <p>Jika pasien tidak membalas chat WhatsApp atau telepon dalam kurun waktu <strong>1x24 jam</strong> (atau hingga H-1 jam kunjungan):</p>
                        <ol class="list-decimal pl-4 space-y-1">
                            <li>Biarkan status tetap <strong>Menunggu</strong> sementara waktu.</li>
                            <li>Hubungi via Email (bila dicantumkan).</li>
                            <li>Bila sudah mendekati jam operasional poli dan tetap tidak ada respon, ubah status menjadi <strong>Dibatalkan</strong> dengan catatan admin <em>"Dibatalkan otomatis: tidak merespon konfirmasi petugas"</em>.</li>
                        </ol>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button @click="sopOpen = false" class="bg-gray-900 hover:bg-gray-800 text-white font-bold px-5 py-2 rounded-xl text-xs transition-colors shadow-sm">
                    Tutup Panduan
                </button>
            </div>
    </div>
</div>
</div>
</div> {{-- Closing Alpine.js x-data wrapper --}}
@endsection
