@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.doctors.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center mb-2">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Dokter
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Tambah Dokter Baru</h2>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap Dokter</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Contoh: dr. Nama Dokter, Sp.OG" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" required>
            </div>

            <div class="space-y-2">
                <label for="specialty" class="block text-sm font-semibold text-gray-700">Spesialisasi</label>
                <input type="text" name="specialty" id="specialty" value="{{ old('specialty') }}" placeholder="Contoh: Poli Kandungan" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" required>
            </div>

            <div class="space-y-2">
                <label for="image" class="block text-sm font-semibold text-gray-700">Foto Dokter</label>
                <input type="file" name="image" id="image" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                <p class="text-xs text-gray-500 mt-1">Rekomendasi ukuran: 400x400px (1:1). Format: JPG, PNG. Maks 2MB.</p>
            </div>

            <div class="space-y-2">
                <label for="is_active" class="block text-sm font-semibold text-gray-700">Status Aktif</label>
                <select name="is_active" id="is_active" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-bold transition-all flex items-center shadow-md">
                <i class="fas fa-save mr-2"></i> Simpan Data Dokter
            </button>
        </div>
    </form>
</div>
@endsection
