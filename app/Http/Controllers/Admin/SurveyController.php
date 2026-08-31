<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::withCount('responses')->latest()->get();
        return view('admin.surveys.index', compact('surveys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('admin.surveys.index')->with('success', 'Kuesioner berhasil dibuat.');
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $survey->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.surveys.index')->with('success', 'Kuesioner berhasil diubah.');
    }

    public function toggleStatus(Survey $survey)
    {
        $survey->update([
            'is_active' => !$survey->is_active,
        ]);

        return redirect()->route('admin.surveys.index')->with('success', 'Status kuesioner berhasil diperbarui.');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('admin.surveys.index')->with('success', 'Kuesioner berhasil dihapus.');
    }

    public function questions(Survey $survey)
    {
        $survey->load('questions');
        return view('admin.surveys.questions', compact('survey'));
    }

    public function storeQuestions(Request $request, Survey $survey)
    {
        $request->validate([
            'questions' => 'nullable|array',
            'questions.*.question_text' => 'required|string|max:255',
            'questions.*.question_type' => 'required|string|in:text,rating,multiple_choice',
            'questions.*.options' => 'nullable|string',
        ]);

        // Keep track of active question IDs to delete removed ones
        $activeIds = [];

        if ($request->has('questions')) {
            foreach ($request->questions as $index => $qData) {
                if (isset($qData['id']) && !empty($qData['id'])) {
                    $question = SurveyQuestion::findOrFail($qData['id']);
                    $question->update([
                        'question_text' => $qData['question_text'],
                        'question_type' => $qData['question_type'],
                        'options' => $qData['options'] ?? null,
                    ]);
                    $activeIds[] = $question->id;
                } else {
                    $newQ = $survey->questions()->create([
                        'question_text' => $qData['question_text'],
                        'question_type' => $qData['question_type'],
                        'options' => $qData['options'] ?? null,
                    ]);
                    $activeIds[] = $newQ->id;
                }
            }
        }

        // Delete questions that were removed
        $survey->questions()->whereNotIn('id', $activeIds)->delete();

        return redirect()->route('admin.surveys.index')->with('success', 'Pertanyaan kuesioner berhasil disimpan.');
    }

    public function insights(Survey $survey)
    {
        $survey->load(['questions.answers', 'responses.answers']);
        
        $questionsData = [];
        foreach ($survey->questions as $question) {
            $data = [
                'question' => $question,
                'total_answers' => $question->answers->count(),
            ];

            if ($question->question_type === 'rating') {
                $ratings = $question->answers->pluck('answer_value')->map(function ($val) {
                    return (int)$val;
                });
                $data['average'] = $ratings->count() > 0 ? round($ratings->average(), 2) : 0;
                $data['chart_data'] = [
                    '1' => $ratings->filter(fn($v) => $v === 1)->count(),
                    '2' => $ratings->filter(fn($v) => $v === 2)->count(),
                    '3' => $ratings->filter(fn($v) => $v === 3)->count(),
                    '4' => $ratings->filter(fn($v) => $v === 4)->count(),
                    '5' => $ratings->filter(fn($v) => $v === 5)->count(),
                ];
            } elseif ($question->question_type === 'multiple_choice') {
                $choices = $question->options_array;
                $answers = $question->answers->pluck('answer_value')->map(fn($v) => trim($v));
                
                $chartData = [];
                foreach ($choices as $choice) {
                    $chartData[$choice] = $answers->filter(fn($v) => $v === $choice)->count();
                }
                // Also track other answers not in predefined options
                $otherCount = $answers->filter(fn($v) => !in_array($v, $choices))->count();
                if ($otherCount > 0) {
                    $chartData['Lainnya'] = $otherCount;
                }
                $data['chart_data'] = $chartData;
            } else {
                // Text answers
                $data['text_answers'] = $question->answers->pluck('answer_value')->take(10)->toArray();
            }

            $questionsData[] = $data;
        }

        return view('admin.surveys.insights', compact('survey', 'questionsData'));
    }

    public function export(Survey $survey)
    {
        $survey->load(['questions', 'responses.answers']);

        $filename = 'survey_export_' . str_replace(' ', '_', strtolower($survey->title)) . '_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($survey) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Write Survey Info
            fputcsv($file, ['Kuesioner:', $survey->title]);
            fputcsv($file, ['Deskripsi:', $survey->description ?? '']);
            fputcsv($file, ['Tanggal Ekspor:', date('d/m/Y H:i')]);
            fputcsv($file, []); // Empty row

            // Build Header Row
            $header = ['No', 'Nama Responden', 'Email Responden', 'Tanggal Pengisian'];
            foreach ($survey->questions as $question) {
                $header[] = $question->question_text;
            }
            fputcsv($file, $header);

            // Write Data Rows
            foreach ($survey->responses as $index => $response) {
                $row = [
                    $index + 1,
                    $response->respondent_name ?? 'Anonim',
                    $response->respondent_email ?? '-',
                    $response->created_at->format('d/m/Y H:i'),
                ];

                foreach ($survey->questions as $question) {
                    $answer = $response->answers->where('survey_question_id', $question->id)->first();
                    $row[] = $answer ? $answer->answer_value : '';
                }

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
