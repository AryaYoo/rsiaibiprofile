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

    public function getAllSchedules($perPage = 10)
    {
        return $this->scheduleRepository->all($perPage);
    }

    public function getFilteredSchedules($search = null, $specialty = null, $day = null, $status = null, $perPage = 50)
    {
        return $this->scheduleRepository->allFiltered($search, $specialty, $day, $status, $perPage);
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
        $dayOrder = [
            'senin'  => 1,
            'selasa' => 2,
            'rabu'   => 3,
            'kamis'  => 4,
            'jumat'  => 5,
            'sabtu'  => 6,
            'minggu' => 7,
        ];

        return $this->scheduleRepository->getActiveSchedulesWithDoctors()
            ->filter(fn($s) => $s->doctor && $s->doctor->is_active)
            ->groupBy('doctor_id')
            ->map(function ($schedules) use ($dayOrder) {
                return $schedules->sort(function ($a, $b) use ($dayOrder) {
                    $dayA = $dayOrder[strtolower(trim($a->day))] ?? 99;
                    $dayB = $dayOrder[strtolower(trim($b->day))] ?? 99;

                    if ($dayA !== $dayB) {
                        return $dayA <=> $dayB;
                    }

                    // Extract starting time for clean comparison
                    preg_match('/(\d{1,2})[.:](\d{2})/', $a->time, $matchA);
                    preg_match('/(\d{1,2})[.:](\d{2})/', $b->time, $matchB);

                    $timeA = $matchA ? sprintf('%02d:%02d', (int)$matchA[1], (int)$matchA[2]) : $a->time;
                    $timeB = $matchB ? sprintf('%02d:%02d', (int)$matchB[1], (int)$matchB[2]) : $b->time;

                    return strcmp($timeA, $timeB);
                })->values();
            });
    }

    public function getScheduleById($id)
    {
        return $this->scheduleRepository->find($id);
    }
}
