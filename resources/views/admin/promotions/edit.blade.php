@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.promotions.index') }}" class="text-emerald-600 font-semibold flex items-center mb-2 hover:text-emerald-700">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
    </a>
    <h2 class="text-3xl font-bold text-gray-900 font-['Merriweather_Sans']">Edit Promosi</h2>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul (Opsional)</label>
                    <input type="text" name="title" value="{{ $promotion->title }}"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Subjudul (Opsional)</label>
                    <textarea name="subtitle" rows="3"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">{{ $promotion->subtitle }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Link Tujuan (Opsional)</label>
                    <input type="text" name="link" value="{{ $promotion->link }}"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div class="space-y-6">
                {{-- Gambar Promosi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Promosi</label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center transition-all hover:border-emerald-500 overflow-hidden">
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="imageInput" accept="image/*">
                        <img id="previewImage" src="{{ asset('storage/' . $promotion->image) }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>
                </div>

                {{-- Background Image --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Background Image</label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center transition-all hover:border-blue-500 overflow-hidden">
                        <input type="file" name="background" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="bgInput" accept="image/*">
                        @if($promotion->background)
                            <img id="previewBg" src="{{ asset('storage/' . $promotion->background) }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <img id="previewBg" class="absolute inset-0 w-full h-full object-cover hidden">
                            <i class="fas fa-panorama text-2xl text-gray-300" id="placeholderBg"></i>
                        @endif
                    </div>
                </div>

                {{-- Background Video --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Background Video (Loop)</label>
                    <div class="relative group h-32 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center transition-all hover:border-purple-500 overflow-hidden">
                        <input type="file" name="video" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="videoInput" accept="video/*">
                        @if($promotion->video)
                            <div class="text-center text-emerald-600 font-bold" id="videoName">
                                <i class="fas fa-file-video text-2xl mb-1"></i>
                                <p class="text-xs">Video Terpasang</p>
                            </div>
                        @else
                            <div class="text-center text-gray-400" id="videoPlaceholder">
                                <i class="fas fa-video text-2xl mb-1"></i>
                                <p class="text-xs">Belum ada video</p>
                                <p class="text-[10px] text-emerald-600 mt-1 font-bold">Max: 5MB | Durasi: 15-30s</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-gray-100">
            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                Update Promosi
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    function setupPreview(inputId, previewId, placeholderId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const placeholder = placeholderId ? document.getElementById(placeholderId) : null;
        if (!input || !preview) return;
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }
    setupPreview('imageInput', 'previewImage');
    setupPreview('bgInput', 'previewBg', 'placeholderBg');

    document.getElementById('videoInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const container = this.parentElement;
            container.innerHTML = `
                <input type="file" name="video" class="absolute inset-0 opacity-0 cursor-pointer z-10" id="videoInput" accept="video/*">
                <div class="text-center text-emerald-600 font-bold">
                    <i class="fas fa-file-video text-2xl mb-1"></i>
                    <p class="text-xs">${file.name}</p>
                </div>`;
        }
    });
</script>
@endsection
@endsection
