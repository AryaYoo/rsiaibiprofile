<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Riana Dewi',
                'date_info' => '5 bulan lalu',
                'rating' => 5,
                'content' => 'Pengalaman pertama opname di RSIA IBI Surabaya, pelayanan dan fasilitas sangat memuaskan. Dokter dan suster sangat berpengalaman di bidangnya.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Muhammad Lutfi',
                'date_info' => 'sebulan lalu',
                'rating' => 5,
                'content' => 'Penanganannya cepat, susternya ramah dan dokternya sangat sabar. Tempatnya bersih dan nyaman.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Fahri Mahendra',
                'date_info' => 'sebulan lalu',
                'rating' => 5,
                'content' => 'Fasilitasnya sangat bagus, kamar bersih, perawat & dokter sangat komunikatif dan perhatian.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Siti Rahma',
                'date_info' => '8 bulan lalu',
                'rating' => 5,
                'content' => 'MasyaAllah pelayanannya cepat dan ramah.. tempatnya bersih dan nyaman.. Terima kasih RSIA IBI Surabaya.',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
