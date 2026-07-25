@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Kelola Testimoni Pasien</h2>
        <p class="text-gray-500">Atur ulasan & testimoni "Apa Kata Mereka Tentang RSIA IBI?" di beranda publik.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Testimoni
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center">
        <i class="fas fa-check-circle mr-2 text-emerald-600"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Nama / Penulis</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Rating</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Isi Testimoni</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Waktu / Info</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-700 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($testimonials as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($item->avatar)
                            <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm">
                                {{ strtoupper(substr($item->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-gray-900">{{ $item->name }}</div>
                            <div class="text-xs text-gray-400">Urutan: {{ $item->sort_order }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex text-amber-400 text-sm">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $item->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-700 max-w-xs">
                    <p class="text-sm line-clamp-2" title="{{ $item->content }}">"{{ $item->content }}"</p>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ $item->date_info ?? '-' }}
                </td>
                <td class="px-6 py-4">
                    @if($item->is_active)
                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    @else
                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Non-Aktif
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.testimonials.edit', $item) }}" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus testimoni ini?')" class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada testimoni pasien yang ditambahkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
