<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|string|max:255',
            'type' => 'required|string|in:fulltime,parttime,freelance',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0|gte:salary_min',
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'day_to_day_tasks' => 'nullable|string',
            'requirements' => 'nullable|string',
            'apply_link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
        ], [
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
            'apply_link.url' => 'Tautan Google Form / lamaran harus berupa format URL valid.'
        ]);

        $career = new Career();
        $career->title = $validated['title'];
        $career->placement = $validated['placement'];
        $career->type = $validated['type'];
        $career->salary_min = $validated['salary_min'];
        $career->salary_max = $validated['salary_max'];
        $career->level = $validated['level'];
        $career->description = $validated['description'];
        $career->day_to_day_tasks = $validated['day_to_day_tasks'];
        $career->requirements = $validated['requirements'];
        $career->apply_link = $validated['apply_link'];
        $career->is_active = $request->has('is_active');
        $career->save();

        return redirect()->route('admin.careers.index')->with('success', 'Lowongan kerja berhasil diterbitkan!');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.form', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'placement' => 'required|string|max:255',
            'type' => 'required|string|in:fulltime,parttime,freelance',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0|gte:salary_min',
            'level' => 'required|string|max:255',
            'description' => 'required|string',
            'day_to_day_tasks' => 'nullable|string',
            'requirements' => 'nullable|string',
            'apply_link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
        ], [
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
            'apply_link.url' => 'Tautan Google Form / lamaran harus berupa format URL valid.'
        ]);

        $career->title = $validated['title'];
        $career->placement = $validated['placement'];
        $career->type = $validated['type'];
        $career->salary_min = $validated['salary_min'];
        $career->salary_max = $validated['salary_max'];
        $career->level = $validated['level'];
        $career->description = $validated['description'];
        $career->day_to_day_tasks = $validated['day_to_day_tasks'];
        $career->requirements = $validated['requirements'];
        $career->apply_link = $validated['apply_link'];
        $career->is_active = $request->has('is_active');
        $career->save();

        return redirect()->route('admin.careers.index')->with('success', 'Lowongan kerja berhasil diperbarui!');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Lowongan kerja berhasil dihapus!');
    }
}
