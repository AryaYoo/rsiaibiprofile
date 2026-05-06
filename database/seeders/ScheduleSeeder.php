<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Schedule::truncate();
        Doctor::truncate();

        // --- MASTER DOKTER ---
        $doctorsData = [
            [
                'name' => 'dr. Muhammad Dwinanda Junaedi, Sp.OG',
                'specialty' => 'Kandungan',
            ],
            [
                'name' => 'dr. Jemmy Tlogo, Sp.OG',
                'specialty' => 'Kandungan',
            ],
            [
                'name' => 'dr. Hermanto Tri Joewono, Sp.OG',
                'specialty' => 'Kandungan',
            ],
            [
                'name' => 'dr. Marsianto, Sp.OG',
                'specialty' => 'Kandungan',
            ],
            [
                'name' => 'dr. Heri Slamet Santoso, Sp.OG',
                'specialty' => 'Kandungan',
            ],
            [
                'name' => 'dr. Alivia Rizky Nuriyanto, Sp.A',
                'specialty' => 'Anak',
            ],
            [
                'name' => 'dr. Satrio Boediman, Sp.A',
                'specialty' => 'Anak',
            ],
            [
                'name' => 'dr. Michael Septian Sihombing, Sp.A',
                'specialty' => 'Anak',
            ],
            [
                'name' => 'dr. Eko Oktiawan Wicaksono, Sp.PD',
                'specialty' => 'Penyakit Dalam',
            ],
        ];

        $doctors = [];
        foreach ($doctorsData as $data) {
            $doctors[$data['name']] = Doctor::create($data);
        }

        // --- JADWAL DOKTER ---
        $schedules = [];
        $monFri = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // dr. Muhammad Dwinanda Junaedi, Sp.OG
        foreach ($monFri as $day) {
            $schedules[] = ['doctor_id' => $doctors['dr. Muhammad Dwinanda Junaedi, Sp.OG']->id, 'day' => $day, 'time' => '13.00 - 15.00', 'is_active' => true];
        }
        $schedules[] = ['doctor_id' => $doctors['dr. Muhammad Dwinanda Junaedi, Sp.OG']->id, 'day' => 'Sabtu', 'time' => '13.00 - 14.00 (Umum)', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Muhammad Dwinanda Junaedi, Sp.OG']->id, 'day' => 'Minggu', 'time' => '13.00 - 14.00 (Umum)', 'is_active' => true];

        // dr. Jemmy Tlogo, Sp.OG
        foreach ($monFri as $day) {
            $schedules[] = ['doctor_id' => $doctors['dr. Jemmy Tlogo, Sp.OG']->id, 'day' => $day, 'time' => '20.00 - 22.00', 'is_active' => true];
        }

        // dr. Hermanto Tri Joewono, Sp.OG
        foreach (['Rabu', 'Kamis', 'Jumat'] as $day) {
            $schedules[] = ['doctor_id' => $doctors['dr. Hermanto Tri Joewono, Sp.OG']->id, 'day' => $day, 'time' => '18.30 - 19.30', 'is_active' => true];
        }

        // dr. Marsianto, Sp.OG
        foreach (['Sabtu', 'Minggu'] as $day) {
            $schedules[] = ['doctor_id' => $doctors['dr. Marsianto, Sp.OG']->id, 'day' => $day, 'time' => '18.00 - Selesai', 'is_active' => true];
        }

        // dr. Heri Slamet Santoso, Sp.OG
        $schedules[] = ['doctor_id' => $doctors['dr. Heri Slamet Santoso, Sp.OG']->id, 'day' => 'Selasa', 'time' => '15.00 - 18.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Heri Slamet Santoso, Sp.OG']->id, 'day' => 'Kamis', 'time' => '15.00 - 18.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Heri Slamet Santoso, Sp.OG']->id, 'day' => 'Sabtu', 'time' => '09.00 - 11.00', 'is_active' => true];

        // dr. Alivia Rizky Nuriyanto, Sp.A
        foreach (['Selasa', 'Kamis', 'Jumat'] as $day) {
            $schedules[] = ['doctor_id' => $doctors['dr. Alivia Rizky Nuriyanto, Sp.A']->id, 'day' => $day, 'time' => '10.30 - 12.30', 'is_active' => true];
        }
        $schedules[] = ['doctor_id' => $doctors['dr. Alivia Rizky Nuriyanto, Sp.A']->id, 'day' => 'Sabtu', 'time' => '08.00 - 10.00', 'is_active' => true];

        // dr. Satrio Boediman, Sp.A
        $schedules[] = ['doctor_id' => $doctors['dr. Satrio Boediman, Sp.A']->id, 'day' => 'Senin', 'time' => '12.30 - 13.30', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Satrio Boediman, Sp.A']->id, 'day' => 'Selasa', 'time' => '19.00 - 21.00 (Umum)', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Satrio Boediman, Sp.A']->id, 'day' => 'Rabu', 'time' => '12.30 - 13.30', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Satrio Boediman, Sp.A']->id, 'day' => 'Kamis', 'time' => '19.00 - 21.00 (Umum)', 'is_active' => true];

        // dr. Michael Septian Sihombing, Sp.A
        $schedules[] = ['doctor_id' => $doctors['dr. Michael Septian Sihombing, Sp.A']->id, 'day' => 'Senin', 'time' => '16.00 - 18.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Michael Septian Sihombing, Sp.A']->id, 'day' => 'Rabu', 'time' => '17.00 - 19.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Michael Septian Sihombing, Sp.A']->id, 'day' => 'Jumat', 'time' => '16.00 - 18.00', 'is_active' => true];

        // dr. Eko Oktiawan Wicaksono, Sp.PD
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Senin', 'time' => '19.00 - 21.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Selasa', 'time' => '13.00 - 15.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Rabu', 'time' => '16.00 - 18.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Kamis', 'time' => '13.00 - 15.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Jumat', 'time' => '14.00 - 16.00', 'is_active' => true];
        $schedules[] = ['doctor_id' => $doctors['dr. Eko Oktiawan Wicaksono, Sp.PD']->id, 'day' => 'Sabtu', 'time' => '11.00 - 14.00', 'is_active' => true];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
