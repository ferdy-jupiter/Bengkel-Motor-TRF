<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'motor_id', 'layanan_id', 'mekanik_id',
        'tanggal_servis', 'jam_servis', 'status', 'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class);
    }

    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'booking_sparepart')
            ->withPivot('qty', 'harga_saat_itu')
            ->withTimestamps();
    }

    public function totalBiaya(): float
    {
        $totalSparepart = $this->spareparts->sum(fn ($sp) => $sp->pivot->qty * $sp->pivot->harga_saat_itu);
        return $this->layanan->harga + $totalSparepart;
    }
}
