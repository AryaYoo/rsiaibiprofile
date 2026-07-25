<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'placement',
        'type',
        'salary_min',
        'salary_max',
        'level',
        'description',
        'day_to_day_tasks',
        'requirements',
        'apply_type',
        'apply_link',
        'contact_email',
        'contact_whatsapp',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'salary_min' => 'integer',
        'salary_max' => 'integer',
    ];
}
