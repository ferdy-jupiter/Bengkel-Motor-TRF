<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = ['kode', 'nama', 'stok', 'harga'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_sparepart')
            ->withPivot('qty', 'harga_saat_itu')
            ->withTimestamps();
    }
}
