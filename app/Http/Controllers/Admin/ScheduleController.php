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

    public function index()
    {
        $schedules = $this->scheduleService->getAllSchedules();
        return view('admin.schedules.index', compact('schedules'));
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
            'is_active' => 'boolean'
        ]);

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
            'is_active' => 'boolean'
        ]);

        $this->scheduleService->updateSchedule($id, $validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->scheduleService->deleteSchedule($id);
        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
