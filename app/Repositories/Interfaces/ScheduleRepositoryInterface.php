<?php

namespace App\Repositories\Interfaces;

interface ScheduleRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveSchedulesWithDoctors();
    public function getTodaySchedules($dayName);
    public function allFiltered($search = null, $specialty = null, $day = null, $status = null, $perPage = 50);
}
