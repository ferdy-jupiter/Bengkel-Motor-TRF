@extends('layouts.app')

@section('title', 'Tambah Mekanik')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Tambah Mekanik</h1>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('admin.mekaniks.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Spesialisasi</label>
                <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}" placeholder="Contoh: Mesin, Kelistrikan"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-oli-500 focus:border-oli-500">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="aktif" value="1" checked class="rounded border-slate-300">
                Mekanik aktif bertugas
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-oli-600 hover:bg-oli-700 text-white font-medium px-5 py-2 rounded-lg transition">
                    Simpan
                </button>
                <a href="{{ route('admin.mekaniks.index') }}" class="text-slate-500 hover:underline px-5 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
