@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.appointments.index') }}" class="text-gray-400 hover:text-gray-700 transition-colors">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Detail Janji Online</h2>
        <p class="text-gray-500 text-sm">ID #{{ $appointment->id }} — Diterima {{ $appointment->created_at->format('d M Y, H:i') }}</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-5 py-4 rounded-2xl mb-5 flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Detail Info --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Data Diri --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <h3 class="font-bold text-gray-800">Data Diri Pasien</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Nama Lengkap</p>
                    <p class="text-gray-900 font-semibold">{{ $appointment->nama }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">No. Telepon / HP</p>
                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $appointment->no_telp)) }}" target="_blank" class="text-emerald-600 font-bold hover:underline">
                        <i class="fab fa-whatsapp mr-1"></i>{{ $appointment->no_telp }}
                    </a>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Email</p>
                    <p class="text-gray-900 font-semibold">{{ $appointment->email ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Info Kunjungan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-hospital text-sm"></i>
                </div>
                <h3 class="font-bold text-gray-800">Informasi Kunjungan</h3>
            </div>
            <div class="p-6 grid grid-cols-1 gap-5">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Tujuan Poli</p>
                    <p class="text-gray-900 font-semibold">{{ $appointment->tujuan_poli }}</p>
                </div>
                @if($appointment->pesan)
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">Keluhan / Pesan</p>
                    <p class="text-gray-700 bg-gray-50 rounded-xl p-4 leading-relaxed text-sm">{{ $appointment->pesan }}</p>
                </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Sidebar: Status & Actions --}}
    <div class="space-y-5">

        {{-- Status Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-9 h-9 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-sm"></i>
                </div>
                <h3 class="font-bold text-gray-800">Status Janji</h3>
            </div>
            <div class="p-6">
                @php
                    $colors = [
                        'menunggu'     => 'bg-yellow-100 text-yellow-700',
                        'dikonfirmasi' => 'bg-emerald-100 text-emerald-700',
                        'dibatalkan'   => 'bg-red-100 text-red-700',
                    ];
                @endphp
                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold mb-4 {{ $colors[$appointment->status] ?? 'bg-gray-100 text-gray-600' }}">
                    {{ $appointment->status_label }}
                </span>

                <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" method="POST" class="space-y-3">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ubah Status</label>
                        <select name="status" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                            <option value="menunggu" {{ $appointment->status === 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                            <option value="dikonfirmasi" {{ $appointment->status === 'dikonfirmasi' ? 'selected' : '' }}>✅ Dikonfirmasi</option>
                            <option value="dibatalkan" {{ $appointment->status === 'dibatalkan' ? 'selected' : '' }}>❌ Dibatalkan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Catatan Admin</label>
                        <textarea name="catatan_admin" rows="3" placeholder="Catatan untuk internal..." class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 resize-none">{{ $appointment->catatan_admin }}</textarea>
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 text-white py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-700 transition-colors">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 space-y-3">
            <h3 class="font-bold text-gray-800 text-sm mb-3">Aksi Cepat</h3>
            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $appointment->no_telp)) }}" target="_blank" class="flex items-center gap-3 w-full bg-green-50 text-green-700 hover:bg-green-100 px-4 py-3 rounded-xl text-sm font-bold transition-colors">
                <i class="fab fa-whatsapp text-lg"></i> Hubungi via WhatsApp
            </a>
            @if($appointment->email)
            <a href="mailto:{{ $appointment->email }}" class="flex items-center gap-3 w-full bg-blue-50 text-blue-700 hover:bg-blue-100 px-4 py-3 rounded-xl text-sm font-bold transition-colors">
                <i class="fas fa-envelope text-lg"></i> Kirim Email
            </a>
            @endif
            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin menghapus data janji ini?')" class="flex items-center gap-3 w-full bg-red-50 text-red-600 hover:bg-red-100 px-4 py-3 rounded-xl text-sm font-bold transition-colors">
                    <i class="fas fa-trash-alt text-lg"></i> Hapus Data Janji
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
