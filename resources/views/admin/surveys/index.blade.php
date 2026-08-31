@extends('layouts.admin')

@section('content')
<script>
    function printSurveyQR(title, url) {
        const printWindow = window.open('', '', 'width=600,height=650');
        const qrSrc = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(url);
        printWindow.document.write(
            '<html><head>' +
            '<title>Cetak QR Code - ' + title + '</title>' +
            '<style>' +
            'body { font-family: sans-serif; text-align: center; padding: 40px; }' +
            'h2 { color: #123524; margin-bottom: 8px; font-size: 22px; }' +
            'p { color: #666; margin-bottom: 24px; font-size: 14px; }' +
            'img { width: 260px; height: 260px; border: 12px solid #edf4eb; border-radius: 16px; }' +
            '.url { margin-top: 20px; font-size: 12px; color: #888; word-break: break-all; }' +
            '</style>' +
            '</head><body>' +
            '<h2>RSIA IBI SURABAYA</h2>' +
            '<p>Kuesioner: <strong>' + title + '</strong><br>Scan QR Code di bawah untuk mengisi survey</p>' +
            '<img src="' + qrSrc + '" />' +
            '<div class="url">' + url + '</div>' +
            '</body></html>'
        );
        printWindow.document.close();
        printWindow.focus();
        setTimeout(function() { printWindow.print(); printWindow.close(); }, 500);
    }
</script>

<div x-data="{ 
    addModal: false, 
    editModal: false, 
    editId: '', 
    editTitle: '', 
    editDesc: '',
    qrModal: false,
    qrTitle: '',
    qrUrl: '',
    copied: false,
    copyToClipboard() {
        navigator.clipboard.writeText(this.qrUrl);
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    },
    printQR() {
        printSurveyQR(this.qrTitle, this.qrUrl);
    }
}">
    <!-- Header & Floating Toggle Banner -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 font-['Merriweather_Sans']">Kuesioner / Survey</h2>
            <p class="text-gray-500 text-sm">Kelola survey kepuasan pasien, kritik & saran berupa kuesioner terstruktur.</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Toggle Floating Button Setting -->
            <form action="{{ route('admin.surveys.toggle-floating') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2.5 rounded-xl border text-sm font-semibold transition-all flex items-center gap-2 {{ ($showFloating == '1' || $showFloating === 'true' || $showFloating === true) ? 'bg-emerald-50 border-emerald-300 text-emerald-800 hover:bg-emerald-100' : 'bg-gray-100 border-gray-300 text-gray-600 hover:bg-gray-200' }}" title="Klik untuk mengubah status floating button survey di website publik">
                    <i class="fas {{ ($showFloating == '1' || $showFloating === 'true' || $showFloating === true) ? 'fa-toggle-on text-emerald-600 text-lg' : 'fa-toggle-off text-gray-400 text-lg' }}"></i>
                    <span>Floating Button: <strong>{{ ($showFloating == '1' || $showFloating === 'true' || $showFloating === true) ? 'Ditampilkan' : 'Disembunyikan' }}</strong></span>
                </button>
            </form>

            <button @click="addModal = true" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Kuesioner
            </button>
        </div>
    </div>

    <!-- Table List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Nama Kuesioner</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Jumlah Responden</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Tanggal Dibuat</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($surveys as $survey)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900">{{ $survey->title }}</div>
                        <div class="text-xs text-gray-500 truncate max-w-xs">{{ $survey->description ?? 'Tidak ada deskripsi' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.surveys.toggle', $survey) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-all {{ $survey->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $survey->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                {{ $survey->is_active ? 'Aktif' : 'Non-Aktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2.5 py-1 rounded-lg">
                            {{ $survey->responses_count }} Respon
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">
                        {{ $survey->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <!-- Generate QR Code -->
                            <button @click="qrTitle = '{{ addslashes($survey->title) }}'; qrUrl = '{{ route('compro.surveys.show', $survey) }}'; qrModal = true" class="text-purple-600 hover:bg-purple-50 p-2 rounded-lg transition-colors" title="Generate QR Code">
                                <i class="fas fa-qrcode text-sm"></i>
                            </button>

                            <!-- Pertanyaan -->
                            <a href="{{ route('admin.surveys.questions', $survey) }}" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Kelola Pertanyaan">
                                <i class="fas fa-list-ul text-sm"></i>
                            </a>

                            <!-- Insights -->
                            <a href="{{ route('admin.surveys.insights', $survey) }}" class="text-amber-600 hover:bg-amber-50 p-2 rounded-lg transition-colors" title="Lihat Grafik & Statistik">
                                <i class="fas fa-chart-pie text-sm"></i>
                            </a>

                            <!-- Export -->
                            <a href="{{ route('admin.surveys.export', $survey) }}" class="text-emerald-600 hover:bg-emerald-50 p-2 rounded-lg transition-colors" title="Export Excel / CSV">
                                <i class="fas fa-file-excel text-sm"></i>
                            </a>

                            <!-- Edit Info -->
                            <button @click="editId = '{{ $survey->id }}'; editTitle = '{{ addslashes($survey->title) }}'; editDesc = '{{ addslashes($survey->description) }}'; editModal = true" class="text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors" title="Edit Info">
                                <i class="fas fa-edit text-sm"></i>
                            </button>

                            <!-- Hapus -->
                            <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kuesioner ini beserta seluruh data di dalamnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus Kuesioner">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                        <i class="fas fa-poll text-4xl mb-4 block"></i>
                        Belum ada kuesioner. Klik tombol "Tambah Kuesioner" untuk membuat baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- QR Code Modal -->
    <div x-show="qrModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="qrModal" @click="qrModal = false" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="qrModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900 font-['Merriweather_Sans']" x-text="qrTitle"></h3>
                        <button @click="qrModal = false" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                    </div>
                    
                    <div class="p-4 bg-emerald-50 rounded-2xl inline-block mb-4 border border-emerald-100">
                        <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' + encodeURIComponent(qrUrl)" alt="QR Code Survey" class="w-48 h-48 rounded-xl">
                    </div>

                    <p class="text-xs text-gray-500 mb-3">Scan QR code ini untuk langsung membuka form kuesioner di smartphone.</p>

                    <!-- Link Copy Box -->
                    <div class="flex items-center gap-2 bg-gray-50 p-2 rounded-xl border border-gray-200 text-left mb-4">
                        <input type="text" :value="qrUrl" readonly class="bg-transparent border-0 text-xs text-gray-600 w-full outline-none font-mono">
                        <button @click="copyToClipboard()" class="px-3 py-1.5 bg-white hover:bg-gray-100 border rounded-lg text-xs font-bold text-gray-700 transition-colors flex-shrink-0">
                            <span x-text="copied ? 'Tersalin!' : 'Salin Link'"></span>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <a :href="'https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' + encodeURIComponent(qrUrl)" download="qr_code_survey.png" target="_blank" class="px-4 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-bold text-xs flex items-center justify-center gap-2">
                            <i class="fas fa-download"></i> Download QR
                        </a>
                        <button @click="printQR()" class="px-4 py-2.5 bg-gray-800 text-white rounded-xl hover:bg-gray-900 transition-colors font-bold text-xs flex items-center justify-center gap-2">
                            <i class="fas fa-print"></i> Cetak / Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div x-show="addModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="addModal" @click="addModal = false" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="addModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.surveys.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 font-['Merriweather_Sans']">Tambah Kuesioner Baru</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Kuesioner</label>
                                <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi (Opsional)</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                        <button type="button" @click="addModal = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-bold shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="editModal" @click="editModal = false" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="editModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="'{{ url('admienz/surveys') }}/' + editId" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-6 pt-6 pb-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 font-['Merriweather_Sans']">Edit Info Kuesioner</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Kuesioner</label>
                                <input type="text" name="title" x-model="editTitle" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi (Opsional)</label>
                                <textarea name="description" x-model="editDesc" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3">
                        <button type="button" @click="editModal = false" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-bold shadow-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
