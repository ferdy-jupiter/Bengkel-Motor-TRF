<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mekanik;
use App\Models\Motor;
use App\Models\Sparepart;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function customer()
    {
        $bookings = Booking::with(['motor', 'layanan', 'mekanik'])
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $totalMotor = Motor::where('user_id', Auth::id())->count();

        return view('dashboard.customer', compact('bookings', 'totalMotor'));
    }

    public function admin()
    {
        $bookingHariIni = Booking::whereDate('tanggal_servis', today())->count();
        $bookingPending = Booking::where('status', 'pending')->count();
        $bookingDikerjakan = Booking::where('status', 'dikerjakan')->count();
        $mekanikAktif = Mekanik::where('aktif', true)->count();
        $sparepartMenipis = Sparepart::where('stok', '<=', 5)->get();

        $bookingTerbaru = Booking::with(['user', 'motor', 'layanan', 'mekanik'])
            ->latest()
            ->take(8)
            ->get();

        return view('dashboard.admin', compact(
            'bookingHariIni', 'bookingPending', 'bookingDikerjakan',
            'mekanikAktif', 'sparepartMenipis', 'bookingTerbaru'
        ));
    }
}
