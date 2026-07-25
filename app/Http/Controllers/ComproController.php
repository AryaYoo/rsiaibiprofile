<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Career;
use App\Services\ScheduleService;
use App\Services\DoctorService;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmationMail;
use App\Mail\AppointmentNotificationMail;

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
        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('sort_order', 'asc')->latest()->get();
        
        $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $todayString = $hariIndo[date('w')];
        
        $todaySchedules = $this->scheduleService->getTodaySchedules($todayString);

        $firstPromo = $promotions->first();
        $heroBg = $firstPromo && $firstPromo->background ? asset('storage/' . $firstPromo->background) : asset('images/hero-background.svg');
        $heroVideo = $firstPromo && $firstPromo->video ? asset('storage/' . $firstPromo->video) : null;
            
        return view('welcome', compact('services', 'promotions', 'testimonials', 'todaySchedules', 'todayString', 'heroBg', 'heroVideo'));
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

    public function pendaftaran()
    {
        return view('compro.pendaftaran');
    }

    public function pendaftaranUmum()
    {
        $doctors = Doctor::with(['schedules' => function ($q) {
                $q->where('is_active', true);
            }])
            ->where('is_active', true)
            ->orderBy('specialty')
            ->orderBy('name')
            ->get();

        $poliList = $doctors->pluck('specialty')->unique()->filter()->values();

        return view('compro.pendaftaran-umum', compact('doctors', 'poliList'));
    }

    public function pendaftaranUmumStore(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'no_telp'           => 'required|string|max:20',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'tujuan_poli'       => [
                'required',
                'string',
                'max:255',
                Rule::exists('doctors', 'specialty')->where('is_active', true),
            ],
            'doctor_id'         => [
                'required',
                Rule::exists('doctors', 'id')->where(function ($query) use ($request) {
                    return $query->where('is_active', true)
                        ->where('specialty', $request->tujuan_poli);
                }),
            ],
            'pesan'             => 'required|string',
        ]);

        $appointment = Appointment::create($request->only([
            'nama', 'email', 'no_telp', 'tanggal_kunjungan', 'tujuan_poli', 'doctor_id', 'pesan',
        ]));

        $appointment->update([
            'kode_pendaftaran' => $this->generateKodePendaftaran($appointment),
        ]);

        $appointment->load('doctor');

        // Kirim email konfirmasi ke pasien
        try {
            Mail::to($appointment->email)
                ->send(new AppointmentConfirmationMail($appointment));
        } catch (\Throwable $e) {
            \Log::warning('Gagal kirim email konfirmasi ke pasien: ' . $e->getMessage());
        }

        // Kirim notifikasi ke Front Office / Admin
        $adminEmail = config('mail.admin_address');
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)
                    ->send(new AppointmentNotificationMail($appointment));
            } catch (\Throwable $e) {
                \Log::warning('Gagal kirim notifikasi ke admin: ' . $e->getMessage());
            }
        }

        return redirect()->route('compro.pendaftaran.umum')
            ->with('success', 'Pendaftaran janji Anda telah berhasil dikirim! Tim kami akan menghubungi Anda melalui WhatsApp atau email untuk konfirmasi jadwal.')
            ->with('appointment_receipt', [
                'kode'              => $appointment->kode_pendaftaran,
                'nama'              => $appointment->nama,
                'email'             => $appointment->email,
                'no_telp'           => $appointment->no_telp,
                'tanggal_kunjungan' => \Carbon\Carbon::parse($appointment->tanggal_kunjungan)->format('d/m/Y'),
                'tujuan_poli'       => $appointment->tujuan_poli,
                'dokter'            => $appointment->doctor?->name,
                'tanggal'           => $appointment->created_at->format('d/m/Y H:i'),
            ]);
    }

    public function pendaftaranBpjs()
    {
        return view('compro.pendaftaran-bpjs');
    }

    public function karir()
    {
        $careers = Career::where('is_active', true)->latest()->get();
        return view('compro.karir', compact('careers'));
    }

    public function karirDetail($id)
    {
        $career = Career::where('is_active', true)->findOrFail($id);
        return view('compro.karir-detail', compact('career'));
    }

    private function generateKodePendaftaran(Appointment $appointment): string
    {
        return 'IBI' . now()->format('ymd') . strtoupper(base_convert($appointment->id, 10, 36));
    }
}
