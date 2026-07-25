<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ScheduleService;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;
    protected $doctorService;

    public function __construct(ScheduleService $scheduleService, DoctorService $doctorService)
    {
        $this->scheduleService = $scheduleService;
        $this->doctorService = $doctorService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $specialty = $request->query('specialty');
        $day = $request->query('day');
        $status = $request->query('status');

        $schedules = $this->scheduleService->getFilteredSchedules($search, $specialty, $day, $status);
        $doctors = $this->doctorService->getAllDoctors();
        $specialties = $doctors->pluck('specialty')->filter()->unique()->values();

        return view('admin.schedules.index', compact('schedules', 'specialties', 'search', 'specialty', 'day', 'status'));
    }

    public function create()
    {
        $doctors = $this->doctorService->getActiveDoctors();
        return view('admin.schedules.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $this->scheduleService->storeSchedule($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = $this->scheduleService->getScheduleById($id);
        $doctors = $this->doctorService->getActiveDoctors();
        return view('admin.schedules.edit', compact('schedule', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $this->scheduleService->updateSchedule($id, $validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->scheduleService->deleteSchedule($id);
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
