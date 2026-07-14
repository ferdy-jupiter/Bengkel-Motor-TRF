@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<div class="w-full max-w-sm">

    {{-- Brand Logo --}}
    <div class="text-center mb-8">
        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3 group">
            <div class="relative">
                <img src="{{ asset('images/logo.png') }}" alt="Bengkel TRF Logo"
                     class="h-20 w-20 object-cover rounded-xl border border-white/10 shadow-lg shadow-race-900/40 transition-transform duration-300 group-hover:scale-105"
                     onerror="this.style.display='none'; document.getElementById('logo-fb-login').style.display='flex';">
                <div id="logo-fb-login" style="display:none;"
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
        <p class="text-white/50 text-sm mt-4">Masuk ke akun kamu</p>
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

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="email@kamu.com"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" required
                    placeholder="••••••••"
                    class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <label class="flex items-center gap-2 text-sm text-white/50 cursor-pointer select-none">
                <input type="checkbox" name="remember"
                    class="rounded border-white/20 bg-white/5 text-race-500 focus:ring-race-500">
                Ingat saya
            </label>

            <button type="submit" class="btn-primary w-full text-white font-display font-semibold tracking-wider py-3 rounded-xl text-sm uppercase">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-white/40 mt-5">
            Belum punya akun?
            <a href="{{ route('register') }}" class="link-accent font-medium ml-1">Daftar</a>
        </p>
    </div>

    {{-- Back to landing --}}
    <p class="text-center text-xs text-white/25 mt-5">
        <a href="{{ url('/') }}" class="hover:text-white/50 transition">← Kembali ke beranda</a>
    </p>

    <p class="text-center text-xs text-white/20 mt-2">
        Demo admin: admin@bengkel.test / password
    </p>
</div>
@endsection
