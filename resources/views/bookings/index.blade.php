@extends('layouts.app')

@section('title', 'Booking Servis Saya')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Booking Servis Saya</h1>
        <p class="text-slate-500 text-sm">Riwayat dan status booking servis motor kamu.</p>
    </div>
    <a href="{{ route('bookings.create') }}" class="bg-oli-600 hover:bg-oli-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Booking Servis
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @if($bookings->isEmpty())
        <p class="text-center text-slate-400 py-10 text-sm">Belum ada booking servis. <a href="{{ route('bookings.create') }}" class="text-oli-600 hover:underline">Booking sekarang</a></p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Motor</th>
                    <th class="px-5 py-3 font-medium">Layanan</th>
                    <th class="px-5 py-3 font-medium">Jadwal</th>
                    <th class="px-5 py-3 font-medium">Mekanik</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($bookings as $booking)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3">{{ $booking->motor->merk }} {{ $booking->motor->tipe }} <span class="text-slate-400">({{ $booking->motor->no_plat }})</span></td>
                        <td class="px-5 py-3">{{ $booking->layanan->nama }}</td>
                        <td class="px-5 py-3">{{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }}, {{ \Carbon\Carbon::parse($booking->jam_servis)->format('H:i') }}</td>
                        <td class="px-5 py-3">{{ $booking->mekanik->nama ?? '-' }}</td>
                        <td class="px-5 py-3"><x-status-badge :status="$booking->status" /></td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('bookings.show', $booking) }}" class="text-oli-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
