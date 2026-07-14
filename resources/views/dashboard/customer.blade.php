@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header greeting dengan animasi -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                Halo, {{ auth()->user()->name }}
                <span class="text-2xl animate-wave inline-block" style="animation: wave 2s ease-in-out infinite;">👋</span>
            </h1>
            <p class="text-slate-500 mt-0.5 text-sm">Selamat datang — ini ringkasan aktivitas servis motormu.</p>
        </div>
        <a href="{{ route('bookings.create') }}" id="quick-booking-btn"
            class="btn-ripple flex items-center gap-2 px-4 py-2.5 bg-oli-600 hover:bg-oli-700 text-white rounded-xl text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Booking Baru
        </a>
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="stat-card bg-white rounded-2xl border border-slate-200 p-6 cursor-pointer group relative overflow-hidden"
             onclick="window.location.href='{{ route('motors.index') }}'">
            <!-- Background decoration -->
            <div class="absolute -right-4 -top-4 w-20 h-20 bg-oli-50 rounded-full opacity-60 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-oli-50 rounded-xl flex items-center justify-center group-hover:bg-oli-100 transition-colors">
                        <svg class="w-5 h-5 text-oli-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2.5 2.5M13 16H7m6 0h3.5l2-2.5V10l-3-4H13v10z"/></svg>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-oli-400 transition-all duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
                <p class="text-sm text-slate-500 mb-1">Motor Terdaftar</p>
                <p class="text-3xl font-bold text-slate-800 counter" data-target="{{ $totalMotor }}">0</p>
                <p class="text-xs text-oli-600 font-medium mt-2 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Kelola motor saya →
                </p>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl border border-slate-200 p-6 cursor-pointer group relative overflow-hidden"
             onclick="window.location.href='{{ route('bookings.index') }}'">
            <div class="absolute -right-4 -top-4 w-20 h-20 bg-blue-50 rounded-full opacity-60 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-400 transition-all duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
                <p class="text-sm text-slate-500 mb-1">Total Booking</p>
                <p class="text-3xl font-bold text-slate-800 counter" data-target="{{ $bookings->count() }}">0</p>
                <p class="text-xs text-blue-600 font-medium mt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    Lihat semua booking →
                </p>
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div class="grid grid-cols-3 gap-3">
        <a href="{{ route('motors.create') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 text-center group hover:-translate-y-0.5">
            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-4.5 h-4.5 text-slate-500 group-hover:text-oli-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors">Tambah Motor</span>
        </a>
        <a href="{{ route('bookings.create') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 text-center group hover:-translate-y-0.5">
            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-4.5 h-4.5 text-slate-500 group-hover:text-oli-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors">Booking Servis</span>
        </a>
        <a href="{{ route('bookings.index') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 text-center group hover:-translate-y-0.5">
            <div class="w-9 h-9 rounded-lg bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-4.5 h-4.5 text-slate-500 group-hover:text-oli-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors">Riwayat</span>
        </a>
    </div>

    <!-- Booking table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-slate-800">Booking Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">5 booking terakhir kamu</p>
            </div>
            <a href="{{ route('bookings.index') }}" class="text-sm text-oli-600 hover:text-oli-700 font-medium flex items-center gap-1 hover:gap-2 transition-all">
                Lihat semua <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($bookings->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center px-4">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-slate-500 text-sm font-medium">Belum ada booking servis</p>
                <p class="text-slate-400 text-xs mt-1 mb-4">Booking servis pertama kamu sekarang!</p>
                <a href="{{ route('bookings.create') }}" class="btn-ripple px-4 py-2 bg-oli-600 hover:bg-oli-700 text-white text-sm rounded-lg font-medium transition-all">
                    Booking Sekarang
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-left text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 font-medium">Motor</th>
                            <th class="px-6 py-3 font-medium">Layanan</th>
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($bookings as $i => $booking)
                            <tr class="hover:bg-slate-50 transition-colors cursor-pointer"
                                onclick="window.location.href='{{ route('bookings.show', $booking) }}'"
                                style="animation: fadeInRow 0.3s ease {{ $i * 0.05 }}s both">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 bg-oli-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-oli-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $booking->motor->merk }} {{ $booking->motor->tipe }}</p>
                                            <p class="text-xs text-slate-400">{{ $booking->motor->no_plat }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-slate-600">{{ $booking->layanan->nama }}</td>
                                <td class="px-6 py-3.5 text-slate-600">{{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-3.5">
                                    <x-status-badge :status="$booking->status" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(20deg); }
        75% { transform: rotate(-10deg); }
    }
    @keyframes fadeInRow {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .stat-card { transition: all 0.2s ease; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.08); }
</style>

@endsection

@section('scripts')
<script>
    // Animate counters
    document.querySelectorAll('.counter').forEach(el => {
        const target = parseInt(el.dataset.target) || 0;
        if (target === 0) { el.textContent = '0'; return; }
        const dur = 1200;
        const start = performance.now();
        function update(now) {
            const progress = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target);
            if (progress < 1) requestAnimationFrame(update);
            else el.textContent = target;
        }
        setTimeout(() => requestAnimationFrame(update), 300);
    });
</script>
@endsection
