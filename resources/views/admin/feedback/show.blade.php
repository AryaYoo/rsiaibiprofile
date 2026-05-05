@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Detail Pesan</h2>
        <p class="text-gray-500">Kritik dan saran dari {{ $feedback->name }}</p>
    </div>
    <a href="{{ route('admin.feedback.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-all font-semibold text-sm">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ $feedback->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $feedback->email ?? 'Tidak ada email' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">{{ $feedback->created_at->format('d F Y') }}</p>
                    <p class="text-xs text-gray-400">{{ $feedback->created_at->format('H:i') }}</p>
                </div>
            </div>

            <div class="mb-8">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Subjek</span>
                <p class="text-gray-800 font-bold text-lg">{{ $feedback->subject ?? '(Tanpa Subjek)' }}</p>
            </div>

            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Pesan</span>
                <div class="bg-gray-50 p-6 rounded-2xl text-gray-700 leading-relaxed whitespace-pre-wrap text-base border border-gray-100">
                    {{ $feedback->message }}
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-end">
            <form action="{{ route('admin.feedback.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 font-bold text-sm hover:text-red-800 transition-all">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
