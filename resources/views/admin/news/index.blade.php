@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Berita</h2>
        <p class="text-gray-500">Buat, ubah, dan hapus berita atau artikel kesehatan.</p>
    </div>
    <a href="{{ route('admin.news.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Berita
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Gambar</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Judul</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Tanggal</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($news as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-16 h-10 object-cover rounded-lg border border-gray-200">
                    @else
                        <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">No Image</div>
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $item->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.news.edit', $item) }}" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus berita ini?')" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada berita yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($news->hasPages())
    <div class="p-6 border-t border-gray-100">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
