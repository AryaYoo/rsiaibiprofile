@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Pengaturan Website</h2>
    <p class="text-gray-500">Kelola informasi statis seperti Visi, Misi, dan Kontak.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8">
        @csrf
        
        @foreach($settings as $group => $items)
            <div class="mb-10 last:mb-0">
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-2 border-b border-gray-100 capitalize">
                    Bagian: {{ $group }}
                </h3>
                
                <div class="space-y-6">
                    @foreach($items as $item)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ str_replace('_', ' ', $item->key) }}
                            </label>
                            
                            @if(strlen($item->value) > 100)
                                <textarea name="{{ $item->key }}" rows="4" 
                                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">{{ $item->value }}</textarea>
                            @else
                                <input type="text" name="{{ $item->key }}" value="{{ $item->value }}"
                                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="pt-6 border-t border-gray-100">
            <button type="submit" 
                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all transform active:scale-95">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
