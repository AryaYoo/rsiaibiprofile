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
        'tanggal_kunjungan',
        'tujuan_poli',
        'doctor_id',
        'jam_praktik',
        'sesi',
        'kode_pendaftaran',
        'pesan',
        'status',
        'catatan_admin',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

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
