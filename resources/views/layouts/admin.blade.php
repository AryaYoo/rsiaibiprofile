<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - RSIA IBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Merriweather Sans', sans-serif; font-weight: 700; }
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-emerald-600 flex items-center">
                    <i class="fas fa-hospital-alt mr-2"></i> RSIA IBI
                </h1>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                {{-- Tanpa Dropdown --}}
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-line w-6"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.doctors.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.doctors.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-user-md w-6"></i> Master Dokter
                    </a>
                    <a href="{{ route('admin.schedules.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.schedules.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-calendar-alt w-6"></i> Jadwal Dokter
                    </a>
                    <a href="{{ route('admin.careers.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.careers.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-briefcase w-6"></i> Lowongan Kerja
                    </a>
                </div>

                {{-- Dropdown Website --}}
                <div x-data="{ open: {{ request()->routeIs('admin.promotions.*', 'admin.news.*', 'admin.services.*', 'admin.gallery.*', 'admin.instagram.*', 'admin.testimonials.*', 'admin.settings.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg font-['Merriweather_Sans'] text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none {{ request()->routeIs('admin.promotions.*', 'admin.news.*', 'admin.services.*', 'admin.gallery.*', 'admin.instagram.*', 'admin.testimonials.*', 'admin.settings.*') ? 'text-emerald-700 font-bold bg-emerald-50/50' : '' }}">
                        <span class="flex items-center"><i class="fas fa-globe w-6"></i> Website</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="pl-4 space-y-1" style="display: none;">
                        <a href="{{ route('admin.promotions.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.promotions.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-ad w-5 mr-2 text-xs"></i> Promosi
                        </a>
                        <a href="{{ route('admin.news.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.news.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-newspaper w-5 mr-2 text-xs"></i> Berita
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.services.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-concierge-bell w-5 mr-2 text-xs"></i> Layanan
                        </a>
                        <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.gallery.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-images w-5 mr-2 text-xs"></i> Galeri
                        </a>
                        <a href="{{ route('admin.instagram.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.instagram.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fab fa-instagram w-5 mr-2 text-xs"></i> Instagram
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.testimonials.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-quote-right w-5 mr-2 text-xs"></i> Testimoni
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.settings.index') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-cog w-5 mr-2 text-xs"></i> Pengaturan
                        </a>
                    </div>
                </div>

                {{-- Dropdown Pesan --}}
                <div x-data="{ open: {{ request()->routeIs('admin.appointments.*', 'admin.feedback.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 rounded-lg font-['Merriweather_Sans'] text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none {{ request()->routeIs('admin.appointments.*', 'admin.feedback.*') ? 'text-emerald-700 font-bold bg-emerald-50/50' : '' }}">
                        <span class="flex items-center"><i class="fas fa-envelope-open-text w-6"></i> Pesan</span>
                        <div class="flex items-center gap-2">
                            @php $pendingCount = \App\Models\Appointment::where('status','menunggu')->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="bg-yellow-400 text-yellow-900 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                            @endif
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </div>
                    </button>
                    <div x-show="open" x-transition.opacity.duration.200ms class="pl-4 space-y-1" style="display: none;">
                        <a href="{{ route('admin.appointments.index') }}" class="flex items-center justify-between px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.appointments.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <span class="flex items-center"><i class="fas fa-calendar-check w-5 mr-2 text-xs"></i> Janji Online</span>
                            @if($pendingCount > 0)
                                <span class="bg-yellow-400 text-yellow-900 text-[9px] font-bold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('admin.feedback.index') }}" class="flex items-center px-4 py-2 rounded-lg font-['Merriweather_Sans'] text-sm {{ request()->routeIs('admin.feedback.*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}">
                            <i class="fas fa-comment-dots w-5 mr-2 text-xs"></i> Kritik & Saran
                        </a>
                    </div>
                </div>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 p-4 flex justify-between items-center shadow-sm z-10">
                <button class="md:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold border border-emerald-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Scrollable Area -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: {!! json_encode(session('success')) !!},
                    confirmButtonColor: '#059669',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-bold'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: {!! json_encode(session('error')) !!},
                    confirmButtonColor: '#dc2626',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-bold'
                    }
                });
            @endif

            @if($errors->any())
                let errorMessages = '<ul style="text-align: left; margin: 0; padding-left: 1.2rem; font-size: 0.95rem; line-height: 1.6; color: #4b5563;">';
                @foreach($errors->all() as $error)
                    errorMessages += '<li style="margin-bottom: 6px;">{{ $error }}</li>';
                @endforeach
                errorMessages += '</ul>';

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan Data!',
                    html: '<div style="margin-top: 8px; margin-bottom: 8px;">Mohon periksa kembali inputan Anda:</div>' + errorMessages,
                    confirmButtonColor: '#dc2626',
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-6 py-2.5 rounded-xl font-bold'
                    }
                });
            @endif
        });
    </script>
    @yield('scripts')
</body>
</html>
