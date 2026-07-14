@extends('layouts.app')

@section('title', 'Edit Sparepart')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Edit Sparepart</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('admin.spareparts.update', $sparepart) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode Sparepart</label>
                <input type="text" name="kode" value="{{ old('kode', $sparepart->kode) }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Sparepart</label>
                <input type="text" name="nama" value="{{ old('nama', $sparepart->nama) }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $sparepart->stok) }}" min="0" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', $sparepart->harga) }}" min="0" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-oli-600 hover:bg-oli-700 text-white font-medium px-5 py-2 rounded-lg transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.spareparts.index') }}" class="text-slate-500 hover:underline px-5 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
