<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visit;
use App\Models\News;
use App\Models\Service;
use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVisits = Visit::count();
        $todayVisits = Visit::whereDate('created_at', Carbon::today())->count();
        
        $totalNews = News::count();
        $totalServices = Service::count();
        $totalGallery = Gallery::count();

        // Chart Data: Visits per day for the last 7 days
        $chartData = Visit::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalVisits', 
            'todayVisits', 
            'totalNews', 
            'totalServices', 
            'totalGallery',
            'chartData'
        ));
    }
}
