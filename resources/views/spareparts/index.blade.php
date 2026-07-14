@extends('layouts.app')

@section('title', 'Kelola Sparepart')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Kelola Sparepart</h1>
        <p class="text-slate-500 text-sm">Stok sparepart yang tersedia di bengkel.</p>
    </div>
    <a href="{{ route('admin.spareparts.create') }}" class="bg-oli-600 hover:bg-oli-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Tambah Sparepart
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @if($spareparts->isEmpty())
        <p class="text-center text-slate-400 py-10 text-sm">Belum ada sparepart.</p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Kode</th>
                    <th class="px-5 py-3 font-medium">Nama</th>
                    <th class="px-5 py-3 font-medium">Stok</th>
                    <th class="px-5 py-3 font-medium">Harga</th>
                    <th class="px-5 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($spareparts as $sparepart)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 text-slate-500">{{ $sparepart->kode }}</td>
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $sparepart->nama }}</td>
                        <td class="px-5 py-3">
                            <span class="{{ $sparepart->stok <= 5 ? 'text-red-600 font-semibold' : 'text-slate-700' }}">
                                {{ $sparepart->stok }}
                            </span>
                            @if($sparepart->stok <= 5)
                                <span class="text-xs text-red-500">(menipis)</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.spareparts.edit', $sparepart) }}" class="text-oli-600 hover:underline mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.spareparts.destroy', $sparepart) }}" class="inline" onsubmit="return confirm('Yakin hapus sparepart ini?')">
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
