@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Layanan</h2>
        <p class="text-gray-500">Atur daftar layanan kesehatan yang tersedia di RSIA IBI.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Layanan
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Ikon/Foto</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Nama Layanan</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($services as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 object-cover rounded-lg">
                    @elseif($item->icon)
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                    @else
                        <div class="w-12 h-12 bg-gray-100 rounded-lg"></div>
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $item->title }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.services.edit', $item) }}" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.services.destroy', $item) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus layanan ini?')" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-gray-500">Belum ada layanan yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
