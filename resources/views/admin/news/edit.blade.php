@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.news.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 mb-2 inline-block">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="text-2xl font-bold text-gray-900">Ubah Berita</h2>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
            <input type="text" name="title" value="{{ $news->title }}" required
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Utama</label>
            @if($news->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $news->image) }}" class="w-48 h-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                </div>
            @endif
            <input type="file" name="image" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p class="mt-2 text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita</label>
            <textarea name="content" rows="12" required
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">{{ $news->content }}</textarea>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <button type="submit" 
                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
