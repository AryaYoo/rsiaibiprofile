@extends('layouts.admin')

@section('content')
@php
    $isEdit = isset($career);
    $actionUrl = $isEdit ? route('admin.careers.update', $career) : route('admin.careers.store');
    $pageTitle = $isEdit ? 'Edit Lowongan Kerja' : 'Tambah Lowongan Baru';
@endphp

<div class="mb-8">
    <a href="{{ route('admin.careers.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 mb-2 inline-block">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="text-2xl font-bold text-gray-900">{{ $pageTitle }}</h2>
</div>

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <form action="{{ $actionUrl }}" method="POST" class="p-8 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Posisi / Judul Pekerjaan</label>
                <input type="text" name="title" value="{{ old('title', $career->title ?? '') }}" required
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: Perawat Kamar Bedah">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Penempatan</label>
                <input type="text" name="placement" value="{{ old('placement', $career->placement ?? 'Surabaya') }}" required
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: Surabaya">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kerja</label>
                <select name="type" required class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    <option value="fulltime" {{ old('type', $career->type ?? '') == 'fulltime' ? 'selected' : '' }}>Full Time</option>
                    <option value="parttime" {{ old('type', $career->type ?? '') == 'parttime' ? 'selected' : '' }}>Part Time</option>
                    <option value="freelance" {{ old('type', $career->type ?? '') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Level Jabatan</label>
                <input type="text" name="level" value="{{ old('level', $career->level ?? '') }}" required
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: Entry Level, Junior, Senior">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gaji Minimal (Opsional)</label>
                <input type="number" name="salary_min" value="{{ old('salary_min', $career->salary_min ?? '') }}" min="0"
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: 3000000">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gaji Maksimal (Opsional)</label>
                <input type="number" name="salary_max" value="{{ old('salary_max', $career->salary_max ?? '') }}" min="0"
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: 5000000">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tautan Pendaftaran / Google Form (Opsional)</label>
            <input type="url" name="apply_link" value="{{ old('apply_link', $career->apply_link ?? '') }}"
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                placeholder="Contoh: https://forms.gle/xxxx">
            <p class="text-xs text-gray-400 mt-1">Jika dikosongkan, tombol "Lamar" di web publik akan menampilkan info lamaran via email/kontak.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat Pekerjaan</label>
            <textarea name="description" rows="4" required
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                placeholder="Jelaskan ringkasan pekerjaan ini...">{{ old('description', $career->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tugas & Tanggung Jawab / Jobdesc (Opsional)</label>
            <textarea name="day_to_day_tasks" rows="6"
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                placeholder="Masukkan poin tugas & tanggung jawab... (gunakan baris baru untuk memisahkan poin)">{{ old('day_to_day_tasks', $career->day_to_day_tasks ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan / Kualifikasi (Opsional)</label>
            <textarea name="requirements" rows="6"
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                placeholder="Masukkan poin persyaratan kualifikasi... (gunakan baris baru untuk memisahkan poin)">{{ old('requirements', $career->requirements ?? '') }}</textarea>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" 
                {{ old('is_active', $career->is_active ?? true) ? 'checked' : '' }}
                class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
            <label for="is_active" class="ml-2 block text-sm font-semibold text-gray-700">Tampilkan lowongan ini ke publik</label>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <button type="submit" 
                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                {{ $isEdit ? 'Simpan Perubahan' : 'Terbitkan Lowongan' }}
            </button>
        </div>
    </form>
</div>
@endsection
