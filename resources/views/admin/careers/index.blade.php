@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Lowongan Kerja</h2>
        <p class="text-gray-500">Atur daftar lowongan pekerjaan yang aktif untuk publik di RSIA IBI.</p>
    </div>
    <a href="{{ route('admin.careers.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Lowongan
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Posisi</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Penempatan</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Tipe / Level</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Estimasi Gaji</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($careers as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="font-bold text-gray-900">{{ $item->title }}</div>
                    <div class="text-xs text-gray-400">Dibuat: {{ $item->created_at->format('d/m/Y') }}</div>
                </td>
                <td class="px-6 py-4 text-gray-700">{{ $item->placement }}</td>
                <td class="px-6 py-4">
                    <span class="inline-block px-2 py-1 text-xs bg-emerald-50 text-emerald-700 rounded-md font-semibold mr-1">{{ ucfirst($item->type) }}</span>
                    <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-md font-semibold">{{ $item->level }}</span>
                </td>
                <td class="px-6 py-4 text-gray-700">
                    @if($item->salary_min !== null || $item->salary_max !== null)
                        @if($item->salary_min !== null && $item->salary_max !== null)
                            Rp{{ number_format($item->salary_min/1000000, 1, ',', '') }}jt - Rp{{ number_format($item->salary_max/1000000, 1, ',', '') }}jt
                        @elseif($item->salary_min !== null)
                            >= Rp{{ number_format($item->salary_min/1000000, 1, ',', '') }}jt
                        @else
                            <= Rp{{ number_format($item->salary_max/1000000, 1, ',', '') }}jt
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($item->is_active)
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    @else
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Non-Aktif
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.careers.edit', $item) }}" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.careers.destroy', $item) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus lowongan pekerjaan ini?')" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada lowongan pekerjaan yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
