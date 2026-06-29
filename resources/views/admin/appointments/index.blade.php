@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Janji Online</h2>
    <p class="text-gray-500">Kelola dan pantau semua pendaftaran janji online dari pasien.</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-400 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-yellow-700 uppercase tracking-wide">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-900">{{ $totalMenunggu }}</p>
        </div>
    </div>
    <div class="bg-emerald-50 border border-emerald-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-emerald-700 uppercase tracking-wide">Dikonfirmasi</p>
            <p class="text-2xl font-bold text-emerald-900">{{ $totalDikonfirmasi }}</p>
        </div>
    </div>
    <div class="bg-red-50 border border-red-200 p-5 rounded-2xl flex items-center gap-4">
        <div class="w-12 h-12 bg-red-400 text-white rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-times-circle"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-red-700 uppercase tracking-wide">Dibatalkan</p>
            <p class="text-2xl font-bold text-red-900">{{ $totalDibatalkan }}</p>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Cari Nama / No. HP</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
        </div>
        <div class="min-w-[140px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Status</label>
            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="dikonfirmasi" {{ request('status') === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="min-w-[160px]">
            <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Poli</label>
            <select name="poli" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                <option value="">Semua Poli</option>
                @foreach($poliList as $poli)
                    <option value="{{ $poli }}" {{ request('poli') === $poli ? 'selected' : '' }}>{{ $poli }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">
                <i class="fas fa-search mr-1"></i> Filter
            </button>
            <a href="{{ route('admin.appointments.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-200 transition-colors">
                Reset
            </a>
        </div>
    </form>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-5 py-4 rounded-2xl mb-5 flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">#</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pasien</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Tujuan Poli</th>
                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                <th class="px-5 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($appointments as $item)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4 text-sm text-gray-400">{{ $appointments->firstItem() + $loop->index }}</td>
                <td class="px-5 py-4">
                    <div class="font-bold text-sm text-gray-900">{{ $item->nama }}</div>
                    @if($item->kode_pendaftaran)
                        <div class="text-[11px] font-bold text-emerald-700">{{ $item->kode_pendaftaran }}</div>
                    @endif
                    <div class="text-xs text-gray-400">{{ $item->no_telp }}</div>
                    @if($item->email)
                        <div class="text-xs text-gray-400">{{ $item->email }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <div class="text-sm font-semibold text-gray-800">{{ $item->tujuan_poli }}</div>
                    @if($item->doctor)
                        <div class="text-xs text-gray-400">{{ $item->doctor->name }}</div>
                    @endif
                    @if($item->tanggal_kunjungan)
                        <div class="text-[11px] text-emerald-700 font-semibold mt-1"><i class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($item->tanggal_kunjungan)->format('d/m/Y') }}</div>
                    @endif
                </td>
                <td class="px-5 py-4">
                    @php
                        $colors = [
                            'menunggu'     => 'bg-yellow-100 text-yellow-700',
                            'dikonfirmasi' => 'bg-emerald-100 text-emerald-700',
                            'dibatalkan'   => 'bg-red-100 text-red-700',
                        ];
                    @endphp
                    <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $colors[$item->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $item->status_label }}
                    </span>
                </td>
                <td class="px-5 py-4 text-center space-x-1">
                    <a href="{{ route('admin.appointments.show', $item) }}" class="inline-flex items-center justify-center w-8 h-8 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Lihat Detail">
                        <i class="fas fa-eye text-sm"></i>
                    </a>
                    <form action="{{ route('admin.appointments.destroy', $item) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus data janji ini?')" class="inline-flex items-center justify-center w-8 h-8 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                            <i class="fas fa-trash-alt text-sm"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                    <i class="fas fa-calendar-times text-5xl mb-4 block text-gray-200"></i>
                    <p class="font-semibold">Belum ada pendaftaran janji online.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $appointments->links() }}
</div>
@endsection
