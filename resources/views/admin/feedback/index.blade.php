@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Kritik & Saran</h2>
    <p class="text-gray-500">Baca dan kelola pesan dari pengunjung website.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pengirim</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Subjek / Pesan</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($feedbacks as $item)
            <tr class="{{ $item->is_read ? 'bg-white' : 'bg-emerald-50/30' }}">
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $item->name }}</div>
                    <div class="text-xs text-gray-500">{{ $item->email }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-semibold text-gray-800">{{ $item->subject ?? '(Tanpa Subjek)' }}</div>
                    <div class="text-xs text-gray-500 truncate max-w-xs">{{ $item->message }}</div>
                </td>
                <td class="px-6 py-4 text-xs text-gray-500">
                    {{ $item->created_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $item->is_read ? 'bg-gray-100 text-gray-500' : 'bg-emerald-100 text-emerald-700' }}">
                        {{ $item->is_read ? 'Dibaca' : 'Baru' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('admin.feedback.show', $item) }}" class="text-emerald-600 hover:text-emerald-900 transition-colors p-2">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('admin.feedback.destroy', $item) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus pesan ini?')" class="text-red-600 hover:text-red-900 transition-colors p-2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-4 block"></i>
                    Belum ada kritik atau saran masuk.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $feedbacks->links() }}
</div>
@endsection
