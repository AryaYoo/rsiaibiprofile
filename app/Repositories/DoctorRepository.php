<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Repositories\Interfaces\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    protected $model;

    public function __construct(Doctor $doctor)
    {
        $this->model = $doctor;
    }

    public function all($perPage = null)
    {
        if ($perPage) {
            return $this->model->withCount('schedules')->latest()->paginate($perPage);
        }
        return $this->model->withCount('schedules')->latest()->get();
    }

    public function getActiveDoctors()
    {
        return $this->model->where('is_active', true)->orderBy('name')->get();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        return $record->delete();
    }
}
