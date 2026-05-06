<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\Gallery;
use App\Services\ScheduleService;
use App\Services\DoctorService;
use App\Services\NewsService;
use Illuminate\Http\Request;

class ComproController extends Controller
{
    protected $scheduleService;
    protected $doctorService;
    protected $newsService;

    public function __construct(
        ScheduleService $scheduleService, 
        DoctorService $doctorService,
        NewsService $newsService
    ) {
        $this->scheduleService = $scheduleService;
        $this->doctorService = $doctorService;
        $this->newsService = $newsService;
    }

    public function index()
    {
        $services = Service::where('category', 'medis')->limit(6)->get();
        $promotions = \App\Models\Promotion::where('is_active', true)->orderBy('order')->get();
        
        $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $todayString = $hariIndo[date('w')];
        
        $todaySchedules = $this->scheduleService->getTodaySchedules($todayString);

        $firstPromo = $promotions->first();
        $heroBg = $firstPromo && $firstPromo->background ? asset('storage/' . $firstPromo->background) : asset('images/hero-background.svg');
        $heroVideo = $firstPromo && $firstPromo->video ? asset('storage/' . $firstPromo->video) : null;
            
        return view('welcome', compact('services', 'promotions', 'todaySchedules', 'todayString', 'heroBg', 'heroVideo'));
    }

    public function tentang()
    {
        $aboutTitle = Setting::where('key', 'about_title')->value('value');
        $aboutContent = Setting::where('key', 'about_content')->value('value');
        $vision = Setting::where('key', 'vision')->value('value');
        $mission = json_decode(Setting::where('key', 'mission')->value('value'), true) ?? [];

        $groupedSchedules = $this->scheduleService->getActiveSchedulesGroupedByDoctor();
        $specialties = $this->doctorService->getActiveDoctors()->pluck('specialty')->unique()->filter()->values();

        return view('compro.tentang', compact('aboutTitle', 'aboutContent', 'vision', 'mission', 'groupedSchedules', 'specialties'));
    }

    public function layanan()
    {
        $medis = Service::where('category', 'medis')->get();
        $administrasi = Service::where('category', 'administrasi')->get();
        
        $groupedSchedules = $this->scheduleService->getActiveSchedulesGroupedByDoctor();
        
        return view('compro.layanan', compact('medis', 'administrasi', 'groupedSchedules'));
    }

    public function berita()
    {
        $news = $this->newsService->getPublishedNews();
        $instagramPosts = \App\Models\InstagramPost::where('is_active', true)->latest()->get();
        return view('compro.berita', compact('news', 'instagramPosts'));
    }

    public function beritaDetail($slug)
    {
        $item = $this->newsService->getNewsBySlug($slug);
        $recommendations = $this->newsService->getRecommendations($item->id);
        $sidebarAd = $this->newsService->getSidebarAd();
        
        return view('compro.berita-detail', compact('item', 'recommendations', 'sidebarAd'));
    }

    public function galeri()
    {
        $galleries = Gallery::latest()->get();
        return view('compro.galeri', compact('galleries'));
    }

    public function kontak()
    {
        $address = Setting::where('key', 'address')->value('value');
        $phoneUmum = Setting::where('key', 'phone_umum')->value('value');
        $phoneBpjs = Setting::where('key', 'phone_bpjs')->value('value');
        $email = Setting::where('key', 'email')->value('value');

        return view('compro.kontak', compact('address', 'phoneUmum', 'phoneBpjs', 'email'));
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Feedback::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih atas kritik dan saran Anda! Pesan telah kami terima.');
    }
}
