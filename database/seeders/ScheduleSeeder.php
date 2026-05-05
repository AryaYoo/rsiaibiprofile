<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'doctor_name' => 'dr. Budi Santoso, Sp.A',
                'specialty' => 'Poli Anak',
                'day' => 'Senin',
                'time' => '08:00 - 12:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Siti Aminah, Sp.OG',
                'specialty' => 'Poli Kandungan',
                'day' => 'Selasa',
                'time' => '09:00 - 13:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Andi Pratama, Sp.PD',
                'specialty' => 'Poli Penyakit Dalam',
                'day' => 'Rabu',
                'time' => '10:00 - 14:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Rina Mulyani, Sp.M',
                'specialty' => 'Poli Mata',
                'day' => 'Kamis',
                'time' => '08:00 - 11:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Hendra Wijaya, Sp.B',
                'specialty' => 'Poli Bedah',
                'day' => 'Jumat',
                'time' => '13:00 - 16:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Ratna Sari, Sp.KK',
                'specialty' => 'Poli Kulit & Kelamin',
                'day' => 'Sabtu',
                'time' => '09:00 - 12:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Joko Susanto, Sp.THT',
                'specialty' => 'Poli THT',
                'day' => 'Minggu',
                'time' => '10:00 - 12:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Anita Larasati, Sp.A',
                'specialty' => 'Poli Anak',
                'day' => 'Senin',
                'time' => '13:00 - 16:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Dwi Putra, Sp.OG',
                'specialty' => 'Poli Kandungan',
                'day' => 'Kamis',
                'time' => '14:00 - 17:00',
                'is_active' => true,
            ],
            [
                'doctor_name' => 'dr. Maya Indah, Sp.PD',
                'specialty' => 'Poli Penyakit Dalam',
                'day' => 'Jumat',
                'time' => '08:00 - 12:00',
                'is_active' => true,
            ]
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
