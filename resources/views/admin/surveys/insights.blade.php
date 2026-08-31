@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <a href="{{ route('admin.surveys.index') }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold flex items-center gap-1.5 mb-4">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kuesioner
        </a>
        <h2 class="text-2xl font-bold text-gray-900 font-['Merriweather_Sans']">Insight & Tanggapan</h2>
        <p class="text-gray-500 text-sm">Statistik respon dan analisis data kuesioner: <strong class="text-gray-800">{{ $survey->title }}</strong></p>
    </div>
    <a href="{{ route('admin.surveys.export', $survey) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
        <i class="fas fa-file-excel"></i> Export Excel (CSV)
    </a>
</div>

<!-- Overview Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $survey->responses->count() }}</div>
            <div class="text-gray-500 text-xs font-semibold">Total Responden</div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-question-circle"></i>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $survey->questions->count() }}</div>
            <div class="text-gray-500 text-xs font-semibold">Total Pertanyaan</div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl">
            <i class="fas fa-toggle-on"></i>
        </div>
        <div>
            <div class="text-2xl font-bold text-gray-900">{{ $survey->is_active ? 'Aktif' : 'Non-Aktif' }}</div>
            <div class="text-gray-500 text-xs font-semibold">Status Kuesioner</div>
        </div>
    </div>
</div>

<!-- Graphical insights -->
<div class="space-y-8 mb-12">
    <h3 class="text-lg font-bold text-gray-900 font-['Merriweather_Sans']">Visualisasi Grafik Pertanyaan</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($questionsData as $index => $qData)
            @if($qData['question']->question_type === 'rating' || $qData['question']->question_type === 'multiple_choice')
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h4 class="text-sm font-bold text-gray-800 mb-4">{{ $index + 1 }}. {{ $qData['question']->question_text }}</h4>
                    <div style="height: 240px; position: relative;">
                        <canvas id="chart-{{ $qData['question']->id }}"></canvas>
                    </div>
                </div>
            @else
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h4 class="text-sm font-bold text-gray-800 mb-4">{{ $index + 1 }}. {{ $qData['question']->question_text }}</h4>
                    <div class="space-y-2 max-h-[240px] overflow-y-auto pr-2">
                        @forelse($qData['text_answers'] as $textAns)
                            <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 text-xs text-gray-700">
                                "{{ $textAns }}"
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400 text-xs">
                                Belum ada jawaban tekstual.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<!-- Respondents details table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 font-['Merriweather_Sans']">Daftar Jawaban Responden</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-gray-500 uppercase text-xs">No</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-500 uppercase text-xs">Nama Responden</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-500 uppercase text-xs">Email</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-500 uppercase text-xs">Waktu Pengisian</th>
                    @foreach($survey->questions as $question)
                        <th class="px-6 py-4 text-left font-bold text-gray-500 uppercase text-xs max-w-xs truncate" title="{{ $question->question_text }}">
                            {{ $question->question_text }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($survey->responses as $resIndex => $response)
                <tr>
                    <td class="px-6 py-4 text-gray-500">{{ $resIndex + 1 }}</td>
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $response->respondent_name ?? 'Anonim' }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $response->respondent_email ?? '-' }}</td>
                    <td class="px-6 py-4 text-xs text-gray-500">{{ $response->created_at->format('d/m/Y H:i') }}</td>
                    @foreach($survey->questions as $question)
                        @php
                            $ans = $response->answers->where('survey_question_id', $question->id)->first();
                        @endphp
                        <td class="px-6 py-4 text-gray-700">
                            {{ $ans ? $ans->answer_value : '-' }}
                        </td>
                    @endforeach
                </tr>
                @empty
                <tr>
                    <td colspan="{{ 4 + $survey->questions->count() }}" class="px-6 py-10 text-center text-gray-400">
                        Belum ada responden yang mengisi kuesioner ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($questionsData as $qData)
            @if($qData['question']->question_type === 'rating')
                new Chart(document.getElementById('chart-{{ $qData['question']->id }}').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['★ 1', '★ 2', '★ 3', '★ 4', '★ 5'],
                        datasets: [{
                            label: 'Jumlah Respon',
                            data: [
                                {{ $qData['chart_data']['1'] }},
                                {{ $qData['chart_data']['2'] }},
                                {{ $qData['chart_data']['3'] }},
                                {{ $qData['chart_data']['4'] }},
                                {{ $qData['chart_data']['5'] }}
                            ],
                            backgroundColor: '#fbbf24',
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
            @elseif($qData['question']->question_type === 'multiple_choice')
                new Chart(document.getElementById('chart-{{ $qData['question']->id }}').getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($qData['chart_data'])) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($qData['chart_data'])) !!},
                            backgroundColor: [
                                '#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            @endif
        @endforeach
    });
</script>
@endsection
@endsection
