@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Kelola Feed Instagram</h2>
    <p class="text-gray-500">Kelola tautan postingan Instagram yang akan ditampilkan di halaman Berita.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Add Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Tambah Post Baru</h3>
            <form action="{{ route('admin.instagram.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL Postingan Instagram</label>
                    <input type="url" name="post_url" required placeholder="https://www.instagram.com/p/..." class="block w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    <p class="mt-1 text-xs text-gray-400 italic">Pastikan URL adalah URL publik postingan.</p>
                </div>
                <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                    Simpan Tautan
                </button>
            </form>
        </div>
    </div>

    <!-- Posts List -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Preview / URL</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-6 py-4">
                            <a href="{{ $post->post_url }}" target="_blank" class="text-emerald-600 hover:underline text-sm truncate block max-w-xs">
                                {{ $post->post_url }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.instagram.update', $post) }}" method="POST">
                                @csrf @method('PUT')
                                <button type="submit" class="px-3 py-1 rounded-full text-xs font-bold {{ $post->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $post->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.instagram.destroy', $post) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus post ini?')" class="text-red-600 hover:text-red-900 transition-colors p-2">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-400">
                            Belum ada tautan Instagram.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
