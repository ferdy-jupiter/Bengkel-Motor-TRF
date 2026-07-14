@extends('layouts.app')

@section('title', 'Detail Booking')

@section('content')
<div class="max-w-2xl">
    <div class="flex justify-between items-start mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Detail Booking</h1>
        <x-status-badge :status="$booking->status" />
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-slate-500">Motor</p>
                <p class="font-medium text-slate-800">{{ $booking->motor->merk }} {{ $booking->motor->tipe }} ({{ $booking->motor->no_plat }})</p>
            </div>
            <div>
                <p class="text-slate-500">Customer</p>
                <p class="font-medium text-slate-800">{{ $booking->user->name }}</p>
            </div>
            <div>
                <p class="text-slate-500">Layanan</p>
                <p class="font-medium text-slate-800">{{ $booking->layanan->nama }}</p>
            </div>
            <div>
                <p class="text-slate-500">Mekanik</p>
                <p class="font-medium text-slate-800">{{ $booking->mekanik->nama ?? 'Belum ditugaskan' }}</p>
            </div>
            <div>
                <p class="text-slate-500">Jadwal</p>
                <p class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }}, {{ \Carbon\Carbon::parse($booking->jam_servis)->format('H:i') }}</p>
            </div>
            <div>
                <p class="text-slate-500">Estimasi Biaya Layanan</p>
                <p class="font-medium text-slate-800">Rp {{ number_format($booking->layanan->harga, 0, ',', '.') }}</p>
            </div>
        </div>

        @if($booking->catatan)
            <div class="text-sm border-t border-slate-100 pt-4">
                <p class="text-slate-500">Catatan</p>
                <p class="text-slate-700">{{ $booking->catatan }}</p>
            </div>
        @endif

        @if($booking->spareparts->isNotEmpty())
            <div class="border-t border-slate-100 pt-4">
                <p class="text-sm text-slate-500 mb-2">Sparepart Digunakan</p>
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-slate-100">
                        @foreach($booking->spareparts as $sp)
                            <tr>
                                <td class="py-1.5">{{ $sp->nama }}</td>
                                <td class="py-1.5 text-slate-500">{{ $sp->pivot->qty }} x Rp {{ number_format($sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                                <td class="py-1.5 text-right font-medium">Rp {{ number_format($sp->pivot->qty * $sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="border-t border-slate-100 pt-4 flex justify-between items-center">
            <p class="text-sm font-medium text-slate-700">Total Estimasi Biaya</p>
            <p class="text-lg font-bold text-oli-600">Rp {{ number_format($booking->totalBiaya(), 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="flex justify-between items-center mt-5">
    <a href="{{ auth()->user()->isAdmin() ? route('admin.bookings.index') : route('bookings.index') }}" class="text-sm text-slate-500 hover:underline">← Kembali</a>
    <a href="{{ route('bookings.invoice', $booking) }}" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        🖨️ Cetak Nota (PDF)
    </a>
</div>

</div>
@endsection
