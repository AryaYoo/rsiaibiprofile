<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@rsiaibi.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('adminrsiaibi15@'),
            ]
        );

        // Initial Settings
        $settings = [
            // Tentang Kami
            [
                'key' => 'about_title',
                'value' => 'RSIA IBI SURABAYA',
                'group' => 'about'
            ],
            [
                'key' => 'about_content',
                'value' => 'Rumah Sakit Ibu dan Anak (RSIA) IBI Surabaya adalah fasilitas kesehatan yang berlokasi di Jl. Dupak No. 15A Surabaya. Fokus utama rumah sakit ini adalah pada pelayanan kesehatan ibu dan anak, khususnya dalam mendukung proses persalinan baik secara normal maupun caesar. RSIA IBI memiliki status rumah sakit kelas C, dengan fasilitas yang meliputi ruang UGD 24 jam, ruang operasi, serta berbagai layanan kebidanan, kandungan, dan kesehatan anak.',
                'group' => 'about'
            ],
            [
                'key' => 'vision',
                'value' => 'Mewujudkan Rumah sakit Ibu dan Anak Ikatan Bidan Indonesia yang unggul dalam pelayanan yang profesional sebagai pilihan masyarakat Kota Surabaya dan sekitarnya.',
                'group' => 'about'
            ],
            [
                'key' => 'mission',
                'value' => json_encode([
                    'Mengembangkan pelayanan kesehatan ibu dan anak yang prima secara professional',
                    'Mengembangkan SDM secara profesional berwawasan IT melalui pendidikan dan pelatihan',
                    'Bekerjasama dengan pemerintah dan swasta dalam meningkatkan derajat kesehatan masyarakat kota surabaya dan sekitarnya melalui pelayanan kesehatan ibu dan anak secara paripurna'
                ]),
                'group' => 'about'
            ],
            // Kontak
            [
                'key' => 'address',
                'value' => 'Jl. Dupak No. 15A, Surabaya, Jawa Timur',
                'group' => 'contact'
            ],
            [
                'key' => 'phone_umum',
                'value' => '6285852963005',
                'group' => 'contact'
            ],
            [
                'key' => 'phone_bpjs',
                'value' => '6285876279000',
                'group' => 'contact'
            ],
            [
                'key' => 'email',
                'value' => 'info@rsiaibi.com',
                'group' => 'contact'
            ],
            // Berita Sidebar Ad
            [
                'key' => 'news_sidebar_ad',
                'value' => '<div class="p-4 bg-gray-100 rounded-lg text-center border-2 border-dashed border-gray-300">
                    <p class="text-gray-500 font-bold mb-0">Ruang Iklan & Kemitraan</p>
                    <p class="text-xs text-gray-400">Hubungi kami untuk info lebih lanjut</p>
                </div>',
                'group' => 'berita'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Initial Services
        $services = [
            // Medis & Keperawatan
            [
                'category' => 'medis',
                'title' => 'Layanan Gawat Darurat',
                'description' => 'Tindakan medis cepat dan tepat untuk kondisi darurat ibu dan anak, tersedia 24 jam dengan tenaga medis berpengalaman.',
                'icon' => 'fas fa-ambulance'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Rawat Inap',
                'description' => 'Fasilitas rawat inap yang nyaman dengan perawatan intensif oleh dokter dan perawat profesional untuk ibu dan anak.',
                'icon' => 'fas fa-bed'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Perawatan Khusus',
                'description' => 'Perawatan kesehatan khusus sesuai kebutuhan pasien, termasuk layanan penunjang dan terapi medis tertentu.',
                'icon' => 'fas fa-user-nurse'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Poli Rawat Jalan',
                'description' => 'Konsultasi dan pemeriksaan kesehatan rutin bersama dokter spesialis tanpa perlu rawat inap.',
                'icon' => 'fas fa-user-md'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Laboratorium',
                'description' => 'Pemeriksaan laboratorium lengkap dengan hasil akurat untuk mendukung diagnosis dan pengobatan.',
                'icon' => 'fas fa-flask'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Farmasi',
                'description' => 'Penyediaan obat-obatan resmi, aman, dan terpercaya, disertai konsultasi penggunaan obat dari apoteker.',
                'icon' => 'fas fa-pills'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Gizi',
                'description' => 'Konsultasi gizi untuk ibu dan anak dengan perencanaan diet seimbang guna mendukung tumbuh kembang yang optimal.',
                'icon' => 'fas fa-utensils'
            ],
            [
                'category' => 'medis',
                'title' => 'Layanan Rekam Medik',
                'description' => 'Pengelolaan data medis pasien secara rapi, aman, dan terintegrasi untuk menunjang pelayanan kesehatan yang efektif.',
                'icon' => 'fas fa-file-medical'
            ],

            // Administrasi
            [
                'category' => 'administrasi',
                'title' => 'Layanan Administrasi Perkantoran',
                'description' => 'Pengelolaan dokumen, surat-menyurat, dan kebutuhan administrasi untuk mendukung kelancaran operasional rumah sakit.',
                'icon' => 'fas fa-file-alt'
            ],
            [
                'category' => 'administrasi',
                'title' => 'Layanan Administrasi Keuangan',
                'description' => 'Pengaturan dan pencatatan transaksi keuangan secara transparan, akuntabel, dan sesuai prosedur.',
                'icon' => 'fas fa-money-bill-wave'
            ],
            [
                'category' => 'administrasi',
                'title' => 'Layanan Administrasi Rekam Medis',
                'description' => 'Penyimpanan dan pengelolaan data rekam medis pasien secara rapi, aman, dan mudah diakses.',
                'icon' => 'fas fa-folder-open'
            ],
            [
                'category' => 'administrasi',
                'title' => 'Layanan Konsultasi Gizi',
                'description' => 'Konsultasi gizi dengan tenaga ahli untuk mendukung pola makan sehat dan pemulihan pasien.',
                'icon' => 'fas fa-apple-alt'
            ],
            [
                'category' => 'administrasi',
                'title' => 'Layanan Ambulance',
                'description' => 'Fasilitas transportasi medis darurat yang cepat dan aman untuk kebutuhan pasien.',
                'icon' => 'fas fa-ambulance'
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }
}
