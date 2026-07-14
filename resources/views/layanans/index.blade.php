@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Kelola Layanan</h1>
        <p class="text-slate-500 text-sm">Jenis layanan servis yang tersedia di bengkel.</p>
    </div>
    <a href="{{ route('admin.layanans.create') }}" class="bg-oli-600 hover:bg-oli-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Tambah Layanan
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @if($layanans->isEmpty())
        <p class="text-center text-slate-400 py-10 text-sm">Belum ada layanan.</p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Nama</th>
                    <th class="px-5 py-3 font-medium">Deskripsi</th>
                    <th class="px-5 py-3 font-medium">Harga</th>
                    <th class="px-5 py-3 font-medium">Estimasi</th>
                    <th class="px-5 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($layanans as $layanan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $layanan->nama }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $layanan->deskripsi ?? '-' }}</td>
                        <td class="px-5 py-3">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">{{ $layanan->estimasi_menit }} menit</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.layanans.edit', $layanan) }}" class="text-oli-600 hover:underline mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.layanans.destroy', $layanan) }}" class="inline" onsubmit="return confirm('Yakin hapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
