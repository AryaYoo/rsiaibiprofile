@extends('layouts.admin')

@section('content')
@php
    $isEdit = isset($testimonial);
    $actionUrl = $isEdit ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store');
    $pageTitle = $isEdit ? 'Edit Testimoni' : 'Tambah Testimoni Baru';
@endphp

<div class="mb-8">
    <a href="{{ route('admin.testimonials.index') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 mb-2 inline-block">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Testimoni
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

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ $actionUrl }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pasien / Pengunjung</label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: Riana Dewi atau Ri** d** Ha*******">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Informasi Waktu / Subtitle (Opsional)</label>
                <input type="text" name="date_info" value="{{ old('date_info', $testimonial->date_info ?? 'sebulan lalu') }}"
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="Contoh: 5 bulan lalu, sebulan lalu">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Penilaian / Rating Bintang</label>
                <select name="rating" required class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                    <option value="5" {{ old('rating', $testimonial->rating ?? 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                    <option value="4" {{ old('rating', $testimonial->rating ?? 5) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                    <option value="3" {{ old('rating', $testimonial->rating ?? 5) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                    <option value="2" {{ old('rating', $testimonial->rating ?? 5) == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang)</option>
                    <option value="1" {{ old('rating', $testimonial->rating ?? 5) == 1 ? 'selected' : '' }}>⭐ (1 Bintang)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Urutan Tampil (Sort Order)</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" min="0"
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                    placeholder="0">
                <p class="text-xs text-gray-400 mt-1">Angka lebih kecil akan ditampilkan lebih awal.</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Testimoni / Ulasan</label>
            <textarea name="content" rows="4" required
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                placeholder="Tulis ulasan/testimoni pasien...">{{ old('content', $testimonial->content ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto / Avatar Pasien (Opsional)</label>
            @if($isEdit && $testimonial->avatar)
                <div class="mb-3 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                    <span class="text-xs text-gray-500">Foto saat ini</span>
                </div>
            @endif
            <input type="file" name="avatar" accept="image/*"
                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none transition-all text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB. Jika tidak diunggah, avatar inisial nama akan dipakai.</p>
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_active" id="is_active" value="1" 
                {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
            <label for="is_active" class="ml-2 block text-sm font-semibold text-gray-700">Tampilkan testimoni ini di web publik</label>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <button type="submit" 
                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Testimoni' }}
            </button>
        </div>
    </form>
</div>
@endsection
