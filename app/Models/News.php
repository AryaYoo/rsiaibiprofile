<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $guarded = [];

    /**
     * Get the full URL for the news image with file verification and fallback.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/default-news.svg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $cleanPath = ltrim($this->image, '/');

        if (file_exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        return asset('images/default-news.svg');
    }
}
