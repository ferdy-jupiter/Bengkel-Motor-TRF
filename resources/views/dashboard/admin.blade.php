@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Dashboard Admin</h1>
            <p class="text-slate-500 text-sm mt-0.5">
                Ringkasan operasional bengkel —
                <span class="font-medium text-slate-700" id="live-date"></span>
            </p>
        </div>
        <div class="flex items-center gap-2.5">
            <!-- Live indicator -->
            <div class="flex items-center gap-1.5 text-xs text-emerald-600 font-medium bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse inline-block"></span>
                Live
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="btn-ripple flex items-center gap-2 px-4 py-2.5 bg-oli-600 hover:bg-oli-700 text-white rounded-xl text-sm font-medium transition-all hover:-translate-y-0.5 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Semua Booking
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="stat-card bg-white rounded-2xl border border-slate-200 p-5 group cursor-default relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-slate-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-slate-200 transition-colors">
                    <svg class="w-4.5 h-4.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs text-slate-500 mb-1">Booking Hari Ini</p>
                <p class="text-3xl font-bold text-slate-800 counter" data-target="{{ $bookingHariIni }}">0</p>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl border border-amber-200 p-5 group cursor-default relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-amber-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-amber-200 transition-colors">
                    <svg class="w-4.5 h-4.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-xs text-amber-600 mb-1 font-medium">Menunggu Konfirmasi</p>
                <div class="flex items-end gap-2">
                    <p class="text-3xl font-bold text-amber-600 counter" data-target="{{ $bookingPending }}">0</p>
                    @if($bookingPending > 0)
                        <span class="badge-pulse w-2.5 h-2.5 rounded-full bg-amber-500 mb-2 flex-shrink-0"></span>
                    @endif
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl border border-oli-200 p-5 group cursor-default relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-oli-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-oli-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-oli-200 transition-colors">
                    <svg class="w-4.5 h-4.5 text-oli-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <p class="text-xs text-oli-600 mb-1 font-medium">Sedang Dikerjakan</p>
                <p class="text-3xl font-bold text-oli-600 counter" data-target="{{ $bookingDikerjakan }}">0</p>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl border border-emerald-200 p-5 group cursor-default relative overflow-hidden">
            <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center mb-3 group-hover:bg-emerald-200 transition-colors">
                    <svg class="w-4.5 h-4.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="text-xs text-emerald-600 mb-1 font-medium">Mekanik Aktif</p>
                <p class="text-3xl font-bold text-emerald-600 counter" data-target="{{ $mekanikAktif }}">0</p>
            </div>
        </div>
    </div>

    <!-- Sparepart Alert (jika ada) -->
    @if($sparepartMenipis->isNotEmpty())
        <div id="sparepart-alert" class="bg-red-50 border border-red-200 rounded-2xl p-5 relative"
             style="animation: slideDown 0.4s ease">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-red-800 text-sm">⚠️ Stok sparepart hampir habis (≤ 5 unit)</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($sparepartMenipis as $sp)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                {{ $sp->nama }} — sisa <strong>{{ $sp->stok }}</strong>
                            </span>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.spareparts.index') }}" class="text-xs text-red-600 font-medium hover:underline mt-2 inline-block">
                        Kelola sparepart →
                    </a>
                </div>
                <button onclick="dismissAlert()" class="text-red-300 hover:text-red-600 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Quick nav cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 group hover:-translate-y-1">
            <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-oli-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors text-center">Booking</span>
        </a>
        <a href="{{ route('admin.layanans.index') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 group hover:-translate-y-1">
            <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-oli-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors text-center">Layanan</span>
        </a>
        <a href="{{ route('admin.mekaniks.index') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 group hover:-translate-y-1">
            <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-oli-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors text-center">Mekanik</span>
        </a>
        <a href="{{ route('admin.spareparts.index') }}" class="flex flex-col items-center gap-2 p-4 bg-white rounded-xl border border-slate-200 hover:border-oli-200 hover:bg-oli-50/30 transition-all duration-200 group hover:-translate-y-1">
            <div class="w-10 h-10 rounded-xl bg-slate-100 group-hover:bg-oli-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-oli-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <span class="text-xs font-medium text-slate-600 group-hover:text-oli-700 transition-colors text-center">Sparepart</span>
        </a>
    </div>

    <!-- Booking Terbaru Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-slate-800">Booking Terbaru</h2>
                <p class="text-xs text-slate-400 mt-0.5">10 booking terakhir yang masuk</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-sm text-oli-600 hover:text-oli-700 font-medium flex items-center gap-1 hover:gap-2 transition-all">
                Lihat semua <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($bookingTerbaru->isEmpty())
            <div class="flex flex-col items-center justify-center py-14 text-center px-4">
                <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <p class="text-slate-500 text-sm font-medium">Belum ada booking masuk</p>
                <p class="text-slate-400 text-xs mt-1">Booking akan muncul di sini saat customer melakukan reservasi</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 text-left text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 font-medium">Customer</th>
                            <th class="px-6 py-3 font-medium">Motor</th>
                            <th class="px-6 py-3 font-medium">Layanan</th>
                            <th class="px-6 py-3 font-medium">Mekanik</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($bookingTerbaru as $i => $booking)
                            <tr class="hover:bg-slate-50 transition-colors"
                                style="animation: fadeInRow 0.3s ease {{ $i * 0.04 }}s both">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-oli-400 to-oli-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($booking->user->name, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-slate-800">{{ $booking->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-slate-600">{{ $booking->motor->merk }} {{ $booking->motor->tipe }}</td>
                                <td class="px-6 py-3.5 text-slate-600">{{ $booking->layanan->nama }}</td>
                                <td class="px-6 py-3.5 text-slate-600">
                                    @if($booking->mekanik)
                                        <span class="inline-flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 flex-shrink-0"></span>
                                            {{ $booking->mekanik->nama }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 italic text-xs">Belum ditugaskan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3.5"><x-status-badge :status="$booking->status" /></td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="{{ route('admin.bookings.edit', $booking) }}"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-100 hover:bg-oli-100 hover:text-oli-700 text-slate-600 rounded-lg text-xs font-medium transition-all hover:gap-2">
                                        Kelola
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
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
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInRow {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .stat-card { transition: all 0.2s ease; }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
    .badge-pulse { animation: pulseBadge 2s ease-in-out infinite; }
    @keyframes pulseBadge {
        0%, 100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.4); }
        50% { box-shadow: 0 0 0 6px rgba(245,158,11,0); }
    }
</style>
@endsection

@section('scripts')
<script>
    // Live date
    const dateEl = document.getElementById('live-date');
    function updateDate() {
        const now = new Date();
        const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
    }
    updateDate();
    setInterval(updateDate, 60000);

    // Counter animation
    document.querySelectorAll('.counter').forEach(el => {
        const target = parseInt(el.dataset.target) || 0;
        if (target === 0) { el.textContent = '0'; return; }
        const dur = 1000;
        const start = performance.now();
        function update(now) {
            const progress = Math.min((now - start) / dur, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target);
            if (progress < 1) requestAnimationFrame(update);
            else el.textContent = target;
        }
        setTimeout(() => requestAnimationFrame(update), 400);
    });

    // Dismiss sparepart alert
    function dismissAlert() {
        const alert = document.getElementById('sparepart-alert');
        if (alert) {
            alert.style.transition = 'all 0.3s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            alert.style.maxHeight = alert.offsetHeight + 'px';
            setTimeout(() => {
                alert.style.maxHeight = '0';
                alert.style.padding = '0';
                alert.style.marginBottom = '0';
            }, 250);
            setTimeout(() => alert.remove(), 500);
        }
    }
</script>
@endsection
