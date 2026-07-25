<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    protected $model;

    public function __construct(Schedule $schedule)
    {
        $this->model = $schedule;
    }

    public function all($perPage = 10)
    {
        return $this->model->with('doctor')->latest()->paginate($perPage);
    }

    public function allFiltered($search = null, $specialty = null, $day = null, $status = null, $perPage = 50)
    {
        $query = $this->model->with('doctor')->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('doctor', function($dq) use ($search) {
                    $dq->where('name', 'like', "%{$search}%")
                      ->orWhere('specialty', 'like', "%{$search}%");
                })->orWhere('day', 'like', "%{$search}%")
                  ->orWhere('time', 'like', "%{$search}%");
            });
        }

        if ($specialty) {
            $query->whereHas('doctor', function($dq) use ($specialty) {
                $dq->where('specialty', $specialty);
            });
        }

        if ($day) {
            $query->where('day', 'like', "%{$day}%");
        }

        if ($status !== null && $status !== '') {
            $query->where('is_active', $status == '1' || $status === 'active');
        }

        return $query->paginate($perPage)->appends(request()->query());
    }

    public function getActiveSchedulesWithDoctors()
    {
        return $this->model->with('doctor')
            ->where('is_active', true)
            ->get();
    }

    public function getTodaySchedules($dayName)
    {
        return $this->model->with('doctor')
            ->where('day', 'like', "%{$dayName}%")
            ->where('is_active', true)
            ->orderBy('doctor_id')
            ->get();
    }

    public function find($id)
    {
        return $this->model->with('doctor')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}
