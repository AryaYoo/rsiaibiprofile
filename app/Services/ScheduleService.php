<?php

namespace App\Services;

use App\Repositories\Interfaces\ScheduleRepositoryInterface;

class ScheduleService
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepositoryInterface $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function getAllSchedules()
    {
        return $this->scheduleRepository->all();
    }

    public function storeSchedule(array $data)
    {
        return $this->scheduleRepository->create($data);
    }

    public function updateSchedule($id, array $data)
    {
        return $this->scheduleRepository->update($id, $data);
    }

    public function deleteSchedule($id)
    {
        return $this->scheduleRepository->delete($id);
    }

    public function getTodaySchedules($dayName)
    {
        return $this->scheduleRepository->getTodaySchedules($dayName);
    }

    public function getActiveSchedulesGroupedByDoctor()
    {
        return $this->scheduleRepository->getActiveSchedulesWithDoctors()->groupBy('doctor_id');
    }

    public function getScheduleById($id)
    {
        return $this->scheduleRepository->find($id);
    }
}
