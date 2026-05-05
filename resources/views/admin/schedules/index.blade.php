@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Jadwal Layanan</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola jadwal praktek dokter dan tenaga medis</p>
    </div>
    <a href="{{ route('admin.schedules.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Jadwal
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="p-4 font-semibold">Nama Dokter</th>
                    <th class="p-4 font-semibold">Poliklinik/Layanan</th>
                    <th class="p-4 font-semibold">Hari Praktek</th>
                    <th class="p-4 font-semibold">Jam Praktek</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($schedules as $schedule)
                <tr class="hover:bg-gray-50">
                    <td class="p-4">
                        <div class="flex items-center">
                            @if($schedule->image)
                                <img src="{{ asset('storage/' . $schedule->image) }}" alt="{{ $schedule->doctor_name }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3 border border-emerald-200">
                                    {{ substr($schedule->doctor_name, 0, 1) }}
                                </div>
                            @endif
                            <div class="font-semibold text-gray-800">{{ $schedule->doctor_name }}</div>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">{{ $schedule->specialty ?? '-' }}</td>
                    <td class="p-4 text-gray-600">{{ $schedule->day }}</td>
                    <td class="p-4 text-gray-600">{{ $schedule->time }}</td>
                    <td class="p-4">
                        @if($schedule->is_active)
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">Aktif</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
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
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                            <p>Belum ada jadwal layanan yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($schedules->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $schedules->links() }}
    </div>
    @endif
</div>
@endsection
