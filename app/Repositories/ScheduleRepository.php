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
