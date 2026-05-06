<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'image',
        'is_active',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
