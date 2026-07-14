@extends('layouts.guest')

@section('title', 'Daftar')

@section('content')
<div class="w-full max-w-sm">

    {{-- Brand Logo --}}
    <div class="text-center mb-8">
        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3 group">
            <div class="relative">
                <img src="{{ asset('images/logo.png') }}" alt="Bengkel TRF Logo"
                     class="h-20 w-20 object-cover rounded-xl border border-white/10 shadow-lg shadow-race-900/40 transition-transform duration-300 group-hover:scale-105"
                     onerror="this.style.display='none'; document.getElementById('logo-fb-reg').style.display='flex';">
                <div id="logo-fb-reg" style="display:none;"
                     class="h-20 w-20 rounded-xl bg-race-600 items-center justify-center font-display font-bold text-2xl border border-white/10">
                    TRF
                </div>
            </div>
            <div>
                <h1 class="font-display font-semibold text-2xl tracking-wide leading-none">
                    Bengkel <span class="text-race-500">TRF</span>
                </h1>
                <p class="text-white/40 text-xs font-body tracking-widest uppercase mt-0.5">Thor·Thor Racing Factory</p>
            </div>
        </a>
        <p class="text-white/50 text-sm mt-4">Buat akun baru</p>
    </div>

    {{-- Card --}}
    <div class="glass-card rounded-2xl p-6">

        @if($errors->any())
            <div class="mb-5 bg-race-500/10 border border-race-500/30 text-race-400 px-4 py-3 rounded-xl text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="Nama kamu"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    placeholder="email@kamu.com"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">No. HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" required
                    placeholder="••••••••"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    placeholder="••••••••"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <button type="submit" class="btn-primary w-full text-white font-display font-semibold tracking-wider py-3 rounded-xl text-sm uppercase">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-white/40 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="link-accent font-medium ml-1">Masuk</a>
        </p>
    </div>

    {{-- Back to landing --}}
    <p class="text-center text-xs text-white/25 mt-5">
        <a href="{{ url('/') }}" class="hover:text-white/50 transition">← Kembali ke beranda</a>
    </p>
</div>
@endsection
