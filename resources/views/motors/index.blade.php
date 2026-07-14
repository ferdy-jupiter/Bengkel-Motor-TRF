@extends('layouts.app')

@section('title', 'Motor Saya')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Motor Saya</h1>
        <p class="text-slate-500 text-sm">Daftar motor yang terdaftar atas nama kamu.</p>
    </div>
    <a href="{{ route('motors.create') }}" class="bg-oli-600 hover:bg-oli-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Tambah Motor
    </a>
</div>

@if($motors->isEmpty())
    <div class="bg-white rounded-xl border border-slate-200 p-10 text-center">
        <p class="text-slate-400 text-sm">Belum ada motor terdaftar.</p>
        <a href="{{ route('motors.create') }}" class="text-oli-600 hover:underline text-sm font-medium mt-2 inline-block">Tambah motor pertama kamu</a>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($motors as $motor)
            <div class="bg-white rounded-xl border border-slate-200 p-5">
                <p class="font-semibold text-slate-800">{{ $motor->merk }} {{ $motor->tipe }}</p>
                <p class="text-sm text-slate-500 mt-1">Plat: {{ $motor->no_plat }}</p>
                @if($motor->tahun)
                    <p class="text-sm text-slate-500">Tahun: {{ $motor->tahun }}</p>
                @endif

                <div class="flex gap-3 mt-4 text-sm">
                    <a href="{{ route('motors.edit', $motor) }}" class="text-oli-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('motors.destroy', $motor) }}" onsubmit="return confirm('Yakin hapus motor ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
