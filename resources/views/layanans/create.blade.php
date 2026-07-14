@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Tambah Layanan</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('admin.layanans.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Layanan</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Ganti Oli" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi (opsional)</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Estimasi Durasi (menit)</label>
                <input type="number" name="estimasi_menit" value="{{ old('estimasi_menit', 30) }}" min="1" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-oli-600 hover:bg-oli-700 text-white font-medium px-5 py-2 rounded-lg transition">
                    Simpan
                </button>
                <a href="{{ route('admin.layanans.index') }}" class="text-slate-500 hover:underline px-5 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
