<?php

namespace App\Repositories\Interfaces;

interface ScheduleRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveSchedulesWithDoctors();
    public function getTodaySchedules($dayName);
}
