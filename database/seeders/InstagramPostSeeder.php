<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstagramPost;

class InstagramPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $urls = [
            'https://www.instagram.com/p/DVFrF6MEZhM/?img_index=1',
            'https://www.instagram.com/p/DUR-WVuEUtM/?img_index=1',
            'https://www.instagram.com/p/DSblXVqEVIo/',
        ];

        foreach ($urls as $url) {
            InstagramPost::create([
                'post_url' => $url,
                'is_active' => true,
            ]);
        }
    }
}
