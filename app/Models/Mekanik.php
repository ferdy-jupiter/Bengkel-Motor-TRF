<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $fillable = ['nama', 'no_hp', 'spesialisasi', 'aktif'];

    protected function casts(): array
    {
        return ['aktif' => 'boolean'];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
