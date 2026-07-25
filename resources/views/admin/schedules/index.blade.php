@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Jadwal Layanan</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola jadwal praktek dokter dan tenaga medis</p>
    </div>
    <a href="{{ route('admin.schedules.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors flex items-center shadow-md shadow-emerald-100">
        <i class="fas fa-plus mr-2"></i> Tambah Jadwal
    </a>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center text-sm font-medium">
        <i class="fas fa-check-circle mr-2 text-emerald-600"></i> {{ session('success') }}
    </div>
@endif

{{-- Search & Filter Section --}}
<form method="GET" action="{{ route('admin.schedules.index') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- Search Input --}}
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Cari Dokter / Jam</label>
            <div class="relative">
                <input type="text" name="search" id="admin-schedule-search" value="{{ $search ?? '' }}" placeholder="Cari nama / jam praktek..."
                    class="w-full pl-9 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none"
                    onkeyup="filterAdminSchedules()">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-xs"></i>
            </div>
        </div>

        {{-- Specialty Filter --}}
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Poliklinik / Layanan</label>
            <select name="specialty" id="admin-specialty-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none" onchange="this.form.submit()">
                <option value="">Semua Poliklinik</option>
                @foreach($specialties ?? [] as $spec)
                    <option value="{{ $spec }}" {{ ($specialty ?? '') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                @endforeach
            </select>
        </div>

        {{-- Day Filter --}}
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Hari Praktek</label>
            <select name="day" id="admin-day-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none" onchange="this.form.submit()">
                <option value="">Semua Hari</option>
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                    <option value="{{ $h }}" {{ ($day ?? '') == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
        </div>

        {{-- Status Filter & Reset --}}
        <div class="flex items-end gap-2">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select name="status" id="admin-status-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="1" {{ ($status ?? '') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ ($status ?? '') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            @if(!empty($search) || !empty($specialty) || !empty($day) || ($status !== null && $status !== ''))
                <a href="{{ route('admin.schedules.index') }}" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-sm font-medium transition-colors" title="Reset Filter">
                    <i class="fas fa-undo"></i> Reset
                </a>
            @endif
        </div>
    </div>
</form>

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
            <tbody class="text-sm divide-y divide-gray-200" id="schedules-table-body">
                @forelse($schedules as $schedule)
                <tr class="hover:bg-gray-50 schedule-row" 
                    data-name="{{ strtolower($schedule->doctor->name ?? '') }}"
                    data-specialty="{{ strtolower($schedule->doctor->specialty ?? '') }}"
                    data-day="{{ strtolower($schedule->day ?? '') }}"
                    data-time="{{ strtolower($schedule->time ?? '') }}">
                    <td class="p-4">
                        <div class="flex items-center">
                            @if($schedule->doctor->image)
                                <img src="{{ asset('storage/' . $schedule->doctor->image) }}" alt="{{ $schedule->doctor->name }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold mr-3 border border-emerald-200">
                                    {{ substr($schedule->doctor->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="font-semibold text-gray-800">{{ $schedule->doctor->name }}</div>
                        </div>
                    </td>
                    <td class="p-4 text-gray-600">{{ $schedule->doctor->specialty ?? '-' }}</td>
                    <td class="p-4 text-gray-600 font-medium">{{ $schedule->day }}</td>
                    <td class="p-4 text-gray-600">{{ $schedule->time }}</td>
                    <td class="p-4">
                        @if($schedule->is_active)
                            <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Tidak Aktif</span>
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
                            <p>Belum ada jadwal layanan yang cocok atau ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse

                <tr id="admin-no-results" style="display: none;">
                    <td colspan="6" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-search-minus text-4xl text-gray-300 mb-3"></i>
                            <p>Tidak ada jadwal dokter yang cocok dengan pencarian Anda.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    @if($schedules->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $schedules->links() }}
    </div>
    @endif
</div>

<script>
    function filterAdminSchedules() {
        const searchVal = (document.getElementById('admin-schedule-search')?.value || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.schedule-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            const specialty = row.getAttribute('data-specialty') || '';
            const day = row.getAttribute('data-day') || '';
            const time = row.getAttribute('data-time') || '';

            const match = !searchVal || name.includes(searchVal) || specialty.includes(searchVal) || day.includes(searchVal) || time.includes(searchVal);

            if (match) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRes = document.getElementById('admin-no-results');
        if (noRes) {
            noRes.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
        }
    }
</script>
@endsection

