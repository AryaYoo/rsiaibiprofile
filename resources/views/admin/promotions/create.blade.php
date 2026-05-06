@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.promotions.index') }}" class="text-emerald-600 font-semibold flex items-center mb-2 hover:text-emerald-700">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
    </a>
    <h2 class="text-3xl font-bold text-gray-900 font-['Merriweather_Sans']">Tambah Promosi Baru</h2>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <form action="{{ route('admin.promotions.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Left: Text Fields --}}
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul (Opsional)</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                        placeholder="Contoh: Promo Spesial Persalinan">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Subjudul (Opsional)</label>
                    <textarea name="subtitle" rows="3"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                        placeholder="Deskripsi singkat promosi...">{{ old('subtitle') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Tujuan (Opsional)</label>
                    <input type="text" name="link" value="{{ old('link') }}"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                        placeholder="Contoh: https://wa.me/...">
                </div>
            </div>

            {{-- Right: Media Uploads --}}
            <div class="space-y-6">
                {{-- Gambar Promosi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar Promosi <span class="text-red-500">*</span>
                        <span class="text-xs text-gray-400 ml-1">(Slider box kanan hero)</span>
                    </label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-emerald-500 overflow-hidden">
                        <input type="file" name="image" required class="absolute inset-0 opacity-0 cursor-pointer z-10" id="imageInput" accept="image/*">
                        <img id="previewImage" class="absolute inset-0 w-full h-full object-cover hidden">
                        <div id="placeholderImage" class="text-center">
                            <i class="fas fa-image text-2xl text-gray-300 mb-1"></i>
                            <p class="text-xs text-gray-500">Upload Gambar Slider</p>
                        </div>
                    </div>
                </div>

                {{-- Background Hero --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Background Hero (Image)
                        <span class="text-xs text-gray-400 ml-1">(Latar belakang statis)</span>
                    </label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-blue-500 overflow-hidden">
                        <input type="file" name="background" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="bgInput" accept="image/*">
                        <img id="previewBg" class="absolute inset-0 w-full h-full object-cover hidden">
                        <div id="placeholderBg" class="text-center">
                            <i class="fas fa-panorama text-2xl text-gray-300 mb-1"></i>
                            <p class="text-xs text-gray-500">Upload Background Image</p>
                        </div>
                    </div>
                </div>

                {{-- Video Loop --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Background Hero (Video Loop)
                        <span class="text-xs text-emerald-600 font-bold ml-1">NEW</span>
                    </label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center transition-all hover:border-purple-500 overflow-hidden">
                        <input type="file" name="video" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="videoInput" accept="video/*">
                        <div id="videoMeta" class="absolute inset-0 bg-emerald-50 hidden flex flex-col items-center justify-center">
                            <i class="fas fa-file-video text-2xl text-emerald-500 mb-1"></i>
                            <p class="text-xs text-emerald-700 font-bold" id="videoName"></p>
                        </div>
                        <div id="placeholderVideo" class="text-center">
                            <i class="fas fa-video text-2xl text-gray-300 mb-1"></i>
                            <p class="text-xs text-gray-500">Upload Video Loop (MP4)</p>
                            <p class="text-[10px] text-emerald-600 mt-1 font-bold">Max: 5MB | Durasi: 15-30 detik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-gray-100">
            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                Simpan Promosi
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    function setupPreview(inputId, previewId, placeholderId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }
    setupPreview('imageInput', 'previewImage', 'placeholderImage');
    setupPreview('bgInput', 'previewBg', 'placeholderBg');

    // Video preview
    document.getElementById('videoInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            document.getElementById('videoMeta').classList.remove('hidden');
            document.getElementById('placeholderVideo').classList.add('hidden');
            document.getElementById('videoName').innerText = file.name;
        }
    });
</script>
@endsection
@endsection
