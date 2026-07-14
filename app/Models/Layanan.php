<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'harga', 'estimasi_menit'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
