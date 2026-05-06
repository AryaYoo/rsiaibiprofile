<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\News;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ComproController extends Controller
{
    public function index()
    {
        $services = Service::where('category', 'medis')->limit(6)->get();
        $promotions = \App\Models\Promotion::where('is_active', true)->orderBy('order')->get();
        
        $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $todayString = $hariIndo[date('w')];
        
        $todaySchedules = Schedule::with('doctor')
            ->where('day', 'like', "%{$todayString}%")
            ->where('is_active', true)
            ->orderBy('specialty')
            ->get();
            
        return view('welcome', compact('services', 'promotions', 'todaySchedules', 'todayString'));
    }

    public function tentang()
    {
        $aboutTitle = Setting::where('key', 'about_title')->value('value');
        $aboutContent = Setting::where('key', 'about_content')->value('value');
        $vision = Setting::where('key', 'vision')->value('value');
        $mission = json_decode(Setting::where('key', 'mission')->value('value'), true) ?? [];

        // Fetch schedules for the "Dokter Spesialis" section
        $rawSchedules = Schedule::with('doctor')
                            ->where('is_active', true)
                            ->get();
        
        $groupedSchedules = $rawSchedules->groupBy('doctor_id');
        
        // Extract unique specialties from doctors
        $specialties = Doctor::where('is_active', true)->pluck('specialty')->unique()->filter()->values();

        return view('compro.tentang', compact('aboutTitle', 'aboutContent', 'vision', 'mission', 'groupedSchedules', 'specialties'));
    }

    public function layanan()
    {
        $medis = Service::where('category', 'medis')->get();
        $administrasi = Service::where('category', 'administrasi')->get();
        
        // Fetch all active schedules and group them by Doctor
        $rawSchedules = Schedule::with('doctor')
                            ->where('is_active', true)
                            ->get();
                            
        // Group by Doctor ID so each doctor only has 1 card
        $groupedSchedules = $rawSchedules->groupBy('doctor_id');
        
        return view('compro.layanan', compact('medis', 'administrasi', 'groupedSchedules'));
    }

    public function berita()
    {
        $news = News::where('is_published', true)->latest()->paginate(9);
        $instagramPosts = \App\Models\InstagramPost::where('is_active', true)->latest()->get();
        return view('compro.berita', compact('news', 'instagramPosts'));
    }

    public function beritaDetail($slug)
    {
        $item = News::where('slug', $slug)->firstOrFail();
        $recommendations = News::where('id', '!=', $item->id)
                                ->where('is_published', true)
                                ->inRandomOrder()
                                ->limit(2)
                                ->get();
        $sidebarAd = Setting::where('key', 'news_sidebar_ad')->value('value');
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
