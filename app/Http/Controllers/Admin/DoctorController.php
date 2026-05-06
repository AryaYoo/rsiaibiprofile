<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        $this->doctorService->storeDoctor($validated, $request->file('image'));

        return redirect()->route('admin.doctors.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $doctor = $this->doctorService->getDoctorById($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean'
        ]);

        $this->doctorService->updateDoctor($id, $validated, $request->file('image'));

        return redirect()->route('admin.doctors.index')->with('success', 'Profil dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->doctorService->deleteDoctor($id);
        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
