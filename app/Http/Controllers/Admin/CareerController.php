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
            'apply_type' => 'nullable|string|in:google_form,email',
            'apply_link' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_whatsapp' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ], [
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
            'contact_email.email' => 'Format email kontak tidak valid.'
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
        $career->apply_type = $validated['apply_type'] ?? null;
        $career->apply_link = $validated['apply_link'] ?? null;
        $career->contact_email = $validated['contact_email'] ?? null;
        $career->contact_whatsapp = $validated['contact_whatsapp'] ?? null;
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
            'apply_type' => 'nullable|string|in:google_form,email',
            'apply_link' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_whatsapp' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ], [
            'salary_max.gte' => 'Gaji maksimal harus lebih besar atau sama dengan gaji minimal.',
            'contact_email.email' => 'Format email kontak tidak valid.'
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
        $career->apply_type = $validated['apply_type'] ?? null;
        $career->apply_link = $validated['apply_link'] ?? null;
        $career->contact_email = $validated['contact_email'] ?? null;
        $career->contact_whatsapp = $validated['contact_whatsapp'] ?? null;
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
