@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900">Dashboard Utama</h2>
    <p class="text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}. Berikut adalah ringkasan statistik website Anda.</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                <i class="fas fa-users"></i>
            </div>
            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">+ Total</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Total Kunjungan</h3>
        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalVisits) }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">
                <i class="fas fa-user-clock"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Hari Ini</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Kunjungan Hari Ini</h3>
        <p class="text-2xl font-bold text-gray-900">{{ number_format($todayVisits) }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Total Berita</h3>
        <p class="text-2xl font-bold text-gray-900">{{ $totalNews }}</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl">
                <i class="fas fa-concierge-bell"></i>
            </div>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Layanan Aktif</h3>
        <p class="text-2xl font-bold text-gray-900">{{ $totalServices }}</p>
    </div>
</div>

<!-- Chart Section -->
<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-lg font-bold text-gray-900">Tren Kunjungan (7 Hari Terakhir)</h3>
        <div class="text-sm text-gray-500">
            <i class="fas fa-calendar-alt mr-1"></i> Data Real-time
        </div>
    </div>
    <div class="h-80">
        <canvas id="visitsChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('visitsChart').getContext('2d');
    const chartData = @json($chartData);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(d => d.date),
            datasets: [{
                label: 'Kunjungan',
                data: chartData.map(d => d.count),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10b981',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [5, 5], color: '#e5e7eb' },
                    ticks: { font: { family: 'Inter' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter' } }
                }
            }
        }
    });
</script>
@endsection
