<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran RSIA IBI</title>
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
            padding: 36px 40px 28px;
            text-align: center;
        }
        .header-logo {
            font-size: 22px;
            font-weight: 900;
            color: #d1f46b;
            letter-spacing: 1px;
        }
        .header-sub {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
            margin-top: 4px;
        }
        .header-icon {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto 12px;
            font-size: 26px;
        }
        .header-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: 800;
        }
        /* Kode Booking */
        .kode-section {
            background: #123524;
            padding: 18px 40px;
            text-align: center;
        }
        .kode-label {
            color: rgba(255,255,255,0.65);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .kode-value {
            color: #d1f46b;
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-top: 4px;
        }
        /* Body */
        .body {
            padding: 32px 40px;
        }
        .greeting {
            font-size: 16px;
            color: #1a2e1a;
            margin-bottom: 16px;
        }
        .body p {
            color: #3d4f3d;
            font-size: 14px;
            margin-bottom: 12px;
        }
        /* Detail Card */
        .detail-card {
            background: #f5f7f3;
            border: 1px solid #e4ebe2;
            border-radius: 12px;
            overflow: hidden;
            margin: 24px 0;
        }
        .detail-card-header {
            background: #edf4eb;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 800;
            color: #123524;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #e4ebe2;
        }
        .detail-row {
            display: flex;
            padding: 11px 20px;
            border-bottom: 1px solid #e4ebe2;
            align-items: flex-start;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label {
            width: 140px;
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
        }
        /* Alert Box */
        .alert-box {
            background: #edf4eb;
            border-left: 4px solid #3E7B27;
            border-radius: 0 10px 10px 0;
            padding: 14px 18px;
            margin: 24px 0;
        }
        .alert-box p {
            font-size: 13px;
            color: #1a4a1a;
            margin: 0;
        }
        .alert-box strong { color: #123524; }
        /* Steps */
        .steps-title {
            font-size: 14px;
            font-weight: 800;
            color: #123524;
            margin-bottom: 12px;
        }
        .step-item {
            display: flex;
            gap: 12px;
            margin-bottom: 10px;
            align-items: flex-start;
        }
        .step-num {
            width: 24px;
            height: 24px;
            background: #123524;
            color: #d1f46b;
            border-radius: 50%;
            font-size: 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .step-text {
            font-size: 13px;
            color: #3d4f3d;
            padding-top: 3px;
        }
        /* Footer */
        .footer {
            background: #f5f7f3;
            border-top: 1px solid #e4ebe2;
            padding: 24px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 12px;
            color: #5a6b5a;
            margin: 0;
            line-height: 1.7;
        }
        .footer-brand {
            font-weight: 800;
            color: #123524;
        }
        .footer-contact {
            margin-top: 8px;
            font-size: 12px;
            color: #5a6b5a;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <div class="header">
            <div class="header-logo">RSIA IBI</div>
            <div class="header-sub">Rumah Sakit Ibu & Anak</div>
            <div class="header-icon">✓</div>
            <div class="header-title">Pendaftaran Berhasil!</div>
        </div>

        <!-- Kode Pendaftaran -->
        <div class="kode-section">
            <div class="kode-label">Kode Bukti Pendaftaran</div>
            <div class="kode-value">{{ $appointment->kode_pendaftaran }}</div>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">Halo, <strong>{{ $appointment->nama }}</strong> 👋</p>
            <p>
                Terima kasih telah mendaftarkan kunjungan Anda ke <strong>RSIA IBI</strong>.
                Pendaftaran Anda telah berhasil diterima dan sedang dalam proses konfirmasi oleh tim kami.
            </p>

            <!-- Detail Kunjungan -->
            <div class="detail-card">
                <div class="detail-card-header">Ringkasan Pendaftaran</div>
                <div class="detail-row">
                    <span class="detail-label">Nama</span>
                    <span class="detail-value">{{ $appointment->nama }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">No. HP</span>
                    <span class="detail-value">{{ $appointment->no_telp }}</span>
                </div>
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
                <div class="detail-row">
                    <span class="detail-label">Tanggal Daftar</span>
                    <span class="detail-value">{{ $appointment->created_at->format('d/m/Y H:i') }} WIB</span>
                </div>
            </div>

            <!-- Alert -->
            <div class="alert-box">
                <p>
                    ⚠️ <strong>Penting:</strong> Tim Front Office kami akan segera menghubungi Anda melalui
                    <strong>WhatsApp atau telepon</strong> ke nomor <strong>{{ $appointment->no_telp }}</strong>
                    untuk konfirmasi jadwal. Harap pastikan nomor tersebut aktif.
                </p>
            </div>

            <!-- Langkah Selanjutnya -->
            <div class="steps-title">📋 Langkah Selanjutnya</div>

            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-text">Simpan email ini sebagai bukti pendaftaran Anda.</div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-text">Tunggu konfirmasi dari tim RSIA IBI melalui WhatsApp/telepon.</div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-text">
                    Datang ke RSIA IBI sesuai tanggal kunjungan yang telah didaftarkan dan
                    <strong>tunjukkan kode pendaftaran {{ $appointment->kode_pendaftaran }}</strong> kepada petugas.
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">4</div>
                <div class="step-text">Bawa kartu identitas (KTP/KK) dan dokumen medis yang relevan jika ada.</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-brand">RSIA IBI — Rumah Sakit Ibu & Anak</p>
            <p class="footer-contact">
                Jika ada pertanyaan, silakan hubungi kami.<br>
                Email ini dikirim otomatis, mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
