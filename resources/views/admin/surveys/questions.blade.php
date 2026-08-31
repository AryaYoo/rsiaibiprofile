@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.surveys.index') }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold flex items-center gap-1.5 mb-4">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kuesioner
    </a>
    <h2 class="text-2xl font-bold text-gray-900 font-['Merriweather_Sans']">Kelola Pertanyaan</h2>
    <p class="text-gray-500 text-sm">Tambahkan, edit, atau hapus daftar pertanyaan untuk kuesioner: <strong class="text-gray-800">{{ $survey->title }}</strong></p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{ 
    questions: {{ json_encode($survey->questions) }} || []
}">
    <form action="{{ route('admin.surveys.questions.store', $survey) }}" method="POST">
        @csrf
        
        <!-- Questions Wrapper -->
        <div class="space-y-6">
            <template x-for="(question, index) in questions" :key="index">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 relative">
                    <!-- Delete Button -->
                    <button type="button" @click="questions.splice(index, 1)" class="absolute top-4 right-4 text-red-600 hover:bg-red-50 p-2 rounded-xl transition-colors" title="Hapus Pertanyaan">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                    <!-- Question ID (if exists) -->
                    <input type="hidden" :name="'questions[' + index + '][id]'" :value="question.id">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Question Text -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Teks Pertanyaan</label>
                            <input type="text" :name="'questions[' + index + '][question_text]'" x-model="question.question_text" required placeholder="Contoh: Bagaimana kepuasan Anda terhadap pelayanan kami?" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white">
                        </div>

                        <!-- Question Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Jawaban</label>
                            <select :name="'questions[' + index + '][question_type]'" x-model="question.question_type" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white">
                                <option value="text">Teks (Jawaban Bebas)</option>
                                <option value="rating">Rating (Nilai Skala 1 - 5)</option>
                                <option value="multiple_choice">Pilihan Ganda</option>
                            </select>
                        </div>
                    </div>

                    <!-- Multiple Choice Options -->
                    <div class="mt-4" x-show="question.question_type === 'multiple_choice'">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Opsi Jawaban (Pisahkan dengan koma)</label>
                        <input type="text" :name="'questions[' + index + '][options]'" x-model="question.options" placeholder="Contoh: Sangat Puas, Puas, Cukup, Kurang Puas" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none bg-white">
                        <p class="text-gray-400 text-xs mt-1">Gunakan pemisah tanda koma `,` untuk memisahkan setiap pilihan jawaban kuesioner.</p>
                    </div>
                </div>
            </template>

            <!-- No Questions Placeholder -->
            <div x-show="questions.length === 0" class="text-center py-12 text-gray-400 border-2 border-dashed border-gray-200 rounded-2xl">
                <i class="fas fa-question-circle text-4xl mb-3 block text-gray-300"></i>
                Belum ada pertanyaan. Silakan tambahkan pertanyaan baru.
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-between items-center border-t border-gray-100 pt-6">
            <button type="button" @click="questions.push({ question_text: '', question_type: 'text', options: '' })" class="px-4 py-2.5 border border-emerald-600 text-emerald-700 hover:bg-emerald-50 font-bold rounded-xl transition-all flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Pertanyaan Baru
            </button>
            
            <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-sm">
                Simpan Semua Pertanyaan
            </button>
        </div>
    </form>
</div>
@endsection
