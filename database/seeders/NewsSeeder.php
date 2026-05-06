<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'RSIA IBI Surabaya Resmikan Layanan USG 4 Dimensi Terbaru',
                'slug' => 'rsia-ibi-surabaya-resmikan-layanan-usg-4-dimensi-terbaru',
                'content' => 'Dalam upaya meningkatkan kualitas pelayanan bagi ibu hamil, RSIA IBI Surabaya kini menghadirkan teknologi USG 4 Dimensi terbaru yang memberikan gambaran janin lebih detail dan nyata. Layanan ini diharapkan dapat memberikan pengalaman tak terlupakan bagi orang tua dalam memantau tumbuh kembang calon buah hati.',
                'image' => null,
                'is_published' => true,
                'created_at' => now()->subDays(2),
            ],
            [
                'title' => 'Tips Menjaga Kesehatan Ibu dan Anak di Masa Pancaroba',
                'slug' => 'tips-menjaga-kesehatan-ibu-dan-anak-di-masa-pancaroba',
                'content' => 'Memasuki musim pancaroba, daya tahan tubuh ibu dan anak perlu mendapat perhatian ekstra. Dr. Spesialis Anak kami membagikan beberapa tips praktis seperti menjaga asupan nutrisi seimbang, hidrasi yang cukup, serta pentingnya istirahat yang berkualitas untuk mencegah berbagai penyakit musiman.',
                'image' => null,
                'is_published' => true,
                'created_at' => now()->subDays(5),
            ],
            [
                'title' => 'Seminar Kesehatan: Pentingnya Inisiasi Menyusu Dini (IMD)',
                'slug' => 'seminar-kesehatan-pentingnya-inisiasi-menyusu-dini-imd',
                'content' => 'RSIA IBI sukses menyelenggarakan seminar edukasi bagi calon ibu mengenai pentingnya Inisiasi Menyusu Dini (IMD). Seminar ini bertujuan memberikan pemahaman mendalam tentang manfaat kolostrum dan kedekatan emosional antara ibu dan bayi sejak menit pertama kelahiran.',
                'image' => null,
                'is_published' => true,
                'created_at' => now()->subDays(10),
            ],
        ];

        foreach ($news as $item) {
            \App\Models\News::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
