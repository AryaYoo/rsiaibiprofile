<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\DoctorRepository;
use App\Repositories\Interfaces\ScheduleRepositoryInterface;
use App\Repositories\ScheduleRepository;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Repositories\NewsRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
