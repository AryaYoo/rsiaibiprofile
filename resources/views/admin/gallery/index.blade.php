@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Kelola Galeri</h2>
    <p class="text-gray-500">Unggah dan kelola foto kegiatan atau fasilitas rumah sakit.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Upload Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Tambah Foto Baru</h3>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul/Keterangan (Opsional)</label>
                    <input type="text" name="title" class="block w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Foto</label>
                    <input type="file" name="image" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                    Unggah Foto
                </button>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="lg:col-span-2">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @forelse($galleries as $item)
            <div class="group relative bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-40 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus foto ini?')" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
                @if($item->title)
                    <div class="p-2 text-xs text-gray-600 truncate text-center">{{ $item->title }}</div>
                @endif
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-2xl border border-dashed border-gray-300 text-gray-400">
                <i class="fas fa-images text-4xl mb-4 block"></i>
                Belum ada foto di galeri.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
