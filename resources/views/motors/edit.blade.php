@extends('layouts.app')

@section('title', 'Edit Motor')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Edit Motor</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('motors.update', $motor) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Merk</label>
                <input type="text" name="merk" value="{{ old('merk', $motor->merk) }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label>
                <input type="text" name="tipe" value="{{ old('tipe', $motor->tipe) }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">No. Plat</label>
                <input type="text" name="no_plat" value="{{ old('no_plat', $motor->no_plat) }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun (opsional)</label>
                <input type="number" name="tahun" value="{{ old('tahun', $motor->tahun) }}"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-oli-600 hover:bg-oli-700 text-white font-medium px-5 py-2 rounded-lg transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('motors.index') }}" class="text-slate-500 hover:underline px-5 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
