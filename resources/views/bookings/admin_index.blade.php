@extends('layouts.app')

@section('title', 'Kelola Booking')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Kelola Booking</h1>
    <p class="text-slate-500 text-sm">Semua booking servis yang masuk dari customer.</p>
</div>

<div class="flex gap-2 mb-4 text-sm flex-wrap">
    <a href="{{ route('admin.bookings.index') }}" class="px-3 py-1.5 rounded-lg border {{ !request('status') ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-600 border-slate-200' }}">Semua</a>
    @foreach(['pending' => 'Menunggu', 'dikonfirmasi' => 'Dikonfirmasi', 'dikerjakan' => 'Dikerjakan', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $key => $label)
        <a href="{{ route('admin.bookings.index', ['status' => $key]) }}" class="px-3 py-1.5 rounded-lg border {{ request('status') === $key ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-600 border-slate-200' }}">{{ $label }}</a>
    @endforeach
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @if($bookings->isEmpty())
        <p class="text-center text-slate-400 py-10 text-sm">Tidak ada booking.</p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Customer</th>
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
                        <td class="px-5 py-3">{{ $booking->user->name }}</td>
                        <td class="px-5 py-3">{{ $booking->motor->merk }} {{ $booking->motor->tipe }}</td>
                        <td class="px-5 py-3">{{ $booking->layanan->nama }}</td>
                        <td class="px-5 py-3">{{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }}, {{ \Carbon\Carbon::parse($booking->jam_servis)->format('H:i') }}</td>
                        <td class="px-5 py-3">{{ $booking->mekanik->nama ?? '-' }}</td>
                        <td class="px-5 py-3"><x-status-badge :status="$booking->status" /></td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.bookings.edit', $booking) }}" class="text-oli-600 hover:underline">Kelola</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
