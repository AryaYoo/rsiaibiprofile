<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Baru Masuk — RSIA IBI</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f7f3;
            color: #1a2e1a;
            line-height: 1.6;
        }
        .wrapper {
            max-width: 600px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(18, 53, 36, 0.10);
        }
        /* Header */
        .header {
            background: linear-gradient(135deg, #123524 0%, #3E7B27 100%);
            padding: 28px 40px;
        }
        .header-badge {
            display: inline-block;
            background: rgba(209, 244, 107, 0.2);
            border: 1px solid #d1f46b;
            color: #d1f46b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .header-title {
            color: #ffffff;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 4px;
        }
        .header-kode {
            color: #d1f46b;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 2px;
        }
        .header-time {
            color: rgba(255,255,255,0.65);
            font-size: 12px;
            margin-top: 6px;
        }
        /* Alert Banner */
        .alert-banner {
            background: #fff8e1;
            border-bottom: 2px solid #ffc107;
            padding: 14px 40px;
            font-size: 13px;
            color: #7a5800;
            font-weight: 600;
        }
        .alert-banner span { font-weight: 800; }
        /* Body */
        .body { padding: 28px 40px; }
        .section-title {
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #5a6b5a;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e4ebe2;
        }
        /* Detail Card */
        .detail-card {
            background: #f9fbf8;
            border: 1px solid #e4ebe2;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .detail-row {
            display: flex;
            padding: 11px 18px;
            border-bottom: 1px solid #e4ebe2;
            align-items: flex-start;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label {
            width: 150px;
            flex-shrink: 0;
            font-size: 12px;
            font-weight: 700;
            color: #5a6b5a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-top: 1px;
        }
        .detail-value {
            font-size: 14px;
            font-weight: 700;
            color: #123524;
            word-break: break-word;
        }
        /* Pesan Box */
        .pesan-box {
            background: #f5f7f3;
            border: 1px dashed #c5d9c0;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
        }
        .pesan-label {
            font-size: 12px;
            font-weight: 800;
            color: #5a6b5a;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .pesan-text {
            font-size: 14px;
            color: #2a3e2a;
            white-space: pre-line;
            line-height: 1.7;
        }
        /* CTA Button */
        .cta-section {
            text-align: center;
            margin: 8px 0 24px;
        }
        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #123524 0%, #3E7B27 100%);
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 800;
            padding: 14px 32px;
            border-radius: 10px;
            letter-spacing: 0.3px;
        }
        /* SOP Reminder */
        .sop-box {
            background: #edf4eb;
            border-left: 4px solid #3E7B27;
            border-radius: 0 10px 10px 0;
            padding: 14px 18px;
            margin-bottom: 0;
        }
        .sop-title {
            font-size: 13px;
            font-weight: 800;
            color: #123524;
            margin-bottom: 8px;
        }
        .sop-item {
            font-size: 13px;
            color: #2a4a2a;
            margin-bottom: 4px;
        }
        /* Footer */
        .footer {
            background: #f5f7f3;
            border-top: 1px solid #e4ebe2;
            padding: 20px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 12px;
            color: #5a6b5a;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="header-badge">🔔 Notifikasi Internal</div>
            <div class="header-title">Ada Booking Baru Masuk!</div>
            <div class="header-kode">{{ $appointment->kode_pendaftaran }}</div>
            <div class="header-time">Diterima: {{ $appointment->created_at->format('l, d/m/Y — H:i') }} WIB</div>
        </div>

        <!-- Alert Banner -->
        <div class="alert-banner">
            ⚡ <span>Segera tindak lanjuti</span> — Hubungi pasien untuk konfirmasi jadwal dan update status di sistem admin.
        </div>

        <!-- Body -->
        <div class="body">

            <!-- Data Pasien -->
            <div class="section-title">Data Pasien</div>
            <div class="detail-card">
                <div class="detail-row">
                    <span class="detail-label">Nama</span>
                    <span class="detail-value">{{ $appointment->nama }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">No. HP / WA</span>
                    <span class="detail-value">{{ $appointment->no_telp }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $appointment->email }}</span>
                </div>
            </div>

            <!-- Data Kunjungan -->
            <div class="section-title">Data Kunjungan</div>
            <div class="detail-card">
                <div class="detail-row">
                    <span class="detail-label">Tgl. Kunjungan</span>
                    <span class="detail-value">
                        {{ \Carbon\Carbon::parse($appointment->tanggal_kunjungan)->translatedFormat('l, d F Y') }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Poli</span>
                    <span class="detail-value">{{ $appointment->tujuan_poli }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Dokter</span>
                    <span class="detail-value">{{ $appointment->doctor?->name ?? '-' }}</span>
                </div>
                @if($appointment->jam_praktik || $appointment->sesi)
                <div class="detail-row">
                    <span class="detail-label">Jam Praktik</span>
                    <span class="detail-value">{{ $appointment->jam_praktik ?: $appointment->sesi }} WIB</span>
                </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">⏳ Menunggu Konfirmasi</span>
                </div>
            </div>

            <!-- Keluhan / Pesan Pasien -->
            <div class="pesan-box">
                <div class="pesan-label">💬 Keluhan / Pesan Pasien</div>
                <div class="pesan-text">{{ $appointment->pesan }}</div>
            </div>

            <!-- CTA -->
            <div class="cta-section">
                <a href="{{ url('/admin/appointments/' . $appointment->id) }}" class="cta-btn">
                    Buka Detail di Admin Panel →
                </a>
            </div>

            <!-- SOP Reminder -->
            <div class="sop-box">
                <div class="sop-title">📋 SOP Front Office</div>
                <div class="sop-item">1️⃣ Hubungi pasien via WhatsApp/telepon ke <strong>{{ $appointment->no_telp }}</strong> untuk konfirmasi.</div>
                <div class="sop-item">2️⃣ Update status booking menjadi <strong>Dikonfirmasi</strong> atau <strong>Dibatalkan</strong> di admin panel.</div>
                <div class="sop-item">3️⃣ Saat pasien tiba, verifikasi kode <strong>{{ $appointment->kode_pendaftaran }}</strong> dan daftarkan ke antrian poli.</div>
            </div>

        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem RSIA IBI. Jangan membalas email ini.</p>
        </div>
    </div>
</body>
</html>
