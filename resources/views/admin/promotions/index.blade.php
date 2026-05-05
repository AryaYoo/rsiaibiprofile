@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 font-['Merriweather_Sans']">Manajemen Promosi</h2>
        <p class="text-gray-500 mt-1">Kelola slider promo di halaman utama</p>
    </div>
    <a href="{{ route('admin.promotions.create') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Promo
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($promotions as $promo)
    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 group transition-all hover:shadow-xl">
        <div class="relative aspect-video overflow-hidden">
            <img src="{{ asset('storage/' . $promo->image) }}" alt="Promo" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-3">
                <a href="{{ route('admin.promotions.edit', $promo) }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-600 hover:bg-emerald-50 transition-colors">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.promotions.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promosi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 hover:bg-red-50 transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $promo->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                    {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>
        <div class="p-5">
            <h3 class="font-bold text-gray-900 truncate">{{ $promo->title ?? 'Tanpa Judul' }}</h3>
            <p class="text-sm text-gray-500 truncate mt-1">{{ $promo->subtitle ?? '-' }}</p>
            <div class="mt-4 flex items-center justify-between">
                <form action="{{ route('admin.promotions.toggle', $promo) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs font-semibold {{ $promo->is_active ? 'text-red-600 hover:text-red-700' : 'text-emerald-600 hover:text-emerald-700' }}">
                        {{ $promo->is_active ? 'Matikan' : 'Aktifkan' }}
                    </button>
                </form>
                <span class="text-xs text-gray-400">Order: {{ $promo->order }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
