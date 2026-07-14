@extends('layouts.app')

@section('title', 'Kelola Mekanik')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Kelola Mekanik</h1>
        <p class="text-slate-500 text-sm">Daftar mekanik yang bertugas di bengkel.</p>
    </div>
    <a href="{{ route('admin.mekaniks.create') }}" class="bg-oli-600 hover:bg-oli-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Tambah Mekanik
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    @if($mekaniks->isEmpty())
        <p class="text-center text-slate-400 py-10 text-sm">Belum ada mekanik.</p>
    @else
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-5 py-3 font-medium">Nama</th>
                    <th class="px-5 py-3 font-medium">No. HP</th>
                    <th class="px-5 py-3 font-medium">Spesialisasi</th>
                    <th class="px-5 py-3 font-medium">Status</th>
                    <th class="px-5 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($mekaniks as $mekanik)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $mekanik->nama }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $mekanik->no_hp ?? '-' }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $mekanik->spesialisasi ?? '-' }}</td>
                        <td class="px-5 py-3">
                            @if($mekanik->aktif)
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">Aktif</span>
                            @else
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500 border border-slate-200">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.mekaniks.edit', $mekanik) }}" class="text-oli-600 hover:underline mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.mekaniks.destroy', $mekanik) }}" class="inline" onsubmit="return confirm('Yakin hapus mekanik ini?')">
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
