<?php

namespace App\Repositories\Interfaces;

interface DoctorRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveDoctors();
}
