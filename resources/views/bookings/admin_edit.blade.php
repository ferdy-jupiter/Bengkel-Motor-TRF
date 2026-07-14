@extends('layouts.app')

@section('title', 'Kelola Booking')

@section('content')
<div class="max-w-2xl">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Booking</h1>
            <p class="text-slate-500 text-sm">{{ $booking->user->name }} — {{ $booking->motor->merk }} {{ $booking->motor->tipe }} ({{ $booking->motor->no_plat }})</p>
        </div>
        <x-status-badge :status="$booking->status" />
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
        <h2 class="font-semibold text-slate-800 mb-4">Info Booking</h2>
        <div class="grid grid-cols-2 gap-4 text-sm mb-5">
            <div>
                <p class="text-slate-500">Layanan</p>
                <p class="font-medium text-slate-800">{{ $booking->layanan->nama }} — Rp {{ number_format($booking->layanan->harga, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-slate-500">Jadwal</p>
                <p class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($booking->tanggal_servis)->translatedFormat('d M Y') }}, {{ \Carbon\Carbon::parse($booking->jam_servis)->format('H:i') }}</p>
            </div>
            @if($booking->catatan)
                <div class="col-span-2">
                    <p class="text-slate-500">Catatan Customer</p>
                    <p class="text-slate-700">{{ $booking->catatan }}</p>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="space-y-4 border-t border-slate-100 pt-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Assign Mekanik</label>
                <select name="mekanik_id" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
                    <option value="">-- Belum ditugaskan --</option>
                    @foreach($mekaniks as $mekanik)
                        <option value="{{ $mekanik->id }}" {{ $booking->mekanik_id == $mekanik->id ? 'selected' : '' }}>{{ $mekanik->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
                    @foreach(['pending' => 'Menunggu', 'dikonfirmasi' => 'Dikonfirmasi', 'dikerjakan' => 'Dikerjakan', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $key => $label)
                        <option value="{{ $key }}" {{ $booking->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-oli-600 hover:bg-oli-700 text-white font-medium px-5 py-2 rounded-lg transition text-sm">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <h2 class="font-semibold text-slate-800 mb-4">Sparepart Digunakan</h2>

        @if($booking->spareparts->isEmpty())
            <p class="text-sm text-slate-400 mb-4">Belum ada sparepart yang digunakan.</p>
        @else
            <table class="w-full text-sm mb-5">
                <tbody class="divide-y divide-slate-100">
                    @foreach($booking->spareparts as $sp)
                        <tr>
                            <td class="py-2">{{ $sp->nama }}</td>
                            <td class="py-2 text-slate-500">{{ $sp->pivot->qty }} x Rp {{ number_format($sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                            <td class="py-2 text-right font-medium">Rp {{ number_format($sp->pivot->qty * $sp->pivot->harga_saat_itu, 0, ',', '.') }}</td>
                            <td class="py-2 text-right w-16">
                                <form method="POST" action="{{ route('admin.bookings.sparepart.remove', [$booking, $sp]) }}" onsubmit="return confirm('Hapus sparepart ini? Stok akan dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if($spareparts->isEmpty())
            <p class="text-xs text-slate-400">Semua stok sparepart sedang habis.</p>
        @else
            <form method="POST" action="{{ route('admin.bookings.sparepart.add', $booking) }}" class="flex gap-2 items-end border-t border-slate-100 pt-4">
                @csrf
                <div class="flex-1">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Tambah Sparepart</label>
                    <select name="sparepart_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
                        <option value="">-- Pilih sparepart --</option>
                        @foreach($spareparts as $sparepart)
                            <option value="{{ $sparepart->id }}">{{ $sparepart->nama }} (stok: {{ $sparepart->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-24">
                    <label class="block text-xs font-medium text-slate-700 mb-1">Qty</label>
                    <input type="number" name="qty" value="1" min="1" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                    Tambah
                </button>
            </form>
        @endif
    </div>

    <div class="mt-5 flex justify-between items-center">
    <a href="{{ route('admin.bookings.index') }}" class="text-sm text-slate-500 hover:underline">← Kembali ke daftar booking</a>
    <div class="flex items-center gap-4">
        <a href="{{ route('bookings.invoice', $booking) }}" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            🖨️ Cetak Nota (PDF)
        </a>
        <p class="text-sm font-medium text-slate-700">Total: <span class="text-oli-600 font-bold">Rp {{ number_format($booking->totalBiaya(), 0, ',', '.') }}</span></p>
    </div>
</div>
</div>
@endsection
