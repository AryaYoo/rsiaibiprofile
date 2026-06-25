<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_telp',
        'email',
        'tujuan_poli',
        'pesan',
        'status',
        'catatan_admin',
    ];

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'dikonfirmasi' => 'Dikonfirmasi',
            'dibatalkan'   => 'Dibatalkan',
            default        => 'Menunggu',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'dikonfirmasi' => 'emerald',
            'dibatalkan'   => 'red',
            default        => 'yellow',
        };
    }
}
