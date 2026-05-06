@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Master Dokter</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola data dokter dan tenaga medis</p>
    </div>
    <a href="{{ route('admin.doctors.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Dokter
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="p-4 font-semibold">Nama Dokter</th>
                    <th class="p-4 font-semibold">Spesialisasi</th>
                    <th class="p-4 font-semibold">Jumlah Jadwal</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($doctors as $doctor)
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        <div class="flex items-center">
                            @if($doctor->image)
                                <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3 border border-emerald-200">
                                    {{ substr($doctor->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="font-semibold text-gray-800">{{ $doctor->name }}</div>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">{{ $doctor->specialty }}</td>
                    <td class="p-4 text-gray-600">{{ $doctor->schedules_count ?? $doctor->schedules->count() }}</td>
                    <td class="p-4">
                        @if($doctor->is_active)
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">Aktif</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dokter ini? Semua jadwal terkait juga akan terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-user-md text-4xl text-gray-300 mb-3"></i>
                            <p>Belum ada data dokter yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
