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
    </style>
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
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-chart-line w-6"></i> Dashboard
                </a>
                <a href="{{ route('admin.promotions.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.promotions.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-ad w-6"></i> Promosi
                </a>
                <a href="{{ route('admin.news.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.news.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-newspaper w-6"></i> Berita
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.services.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-concierge-bell w-6"></i> Layanan
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.gallery.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-images w-6"></i> Galeri
                </a>
                <a href="{{ route('admin.doctors.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.doctors.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-user-md w-6"></i> Master Dokter
                </a>
                <a href="{{ route('admin.schedules.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.schedules.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-calendar-alt w-6"></i> Jadwal Dokter
                </a>
                <a href="{{ route('admin.instagram.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.instagram.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fab fa-instagram w-6"></i> Instagram
                </a>
                <a href="{{ route('admin.feedback.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.feedback.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-comment-dots w-6"></i> Kritik & Saran
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 rounded-lg font-['Merriweather_Sans'] {{ request()->routeIs('admin.settings.index') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-cog w-6"></i> Pengaturan
                </a>
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
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>
</html>
