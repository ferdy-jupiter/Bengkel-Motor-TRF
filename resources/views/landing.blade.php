<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRF - Bengkel Motor Racing</title>
    <meta name="description" content="Bengkel motor profesional TRF, ditangani mekanik berpengalaman di lintasan balap. Booking servis motor kamu sekarang!">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Oswald', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        race: { 50:'#fef2f2', 400:'#f87171', 500:'#e11d2e', 600:'#c11424', 700:'#9a0f1d', 900:'#450a0a' },
                        asphalt: { 800:'#1c1c1e', 900:'#121214', 950:'#0a0a0b' },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delay': 'float 6s ease-in-out 2s infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'slide-up': 'slideUp 0.6s ease-out forwards',
                        'fade-in': 'fadeIn 0.8s ease-out forwards',
                        'spin-slow': 'spin 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(40px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .checker {
            background-image:
                linear-gradient(45deg, #000 25%, transparent 25%), linear-gradient(-45deg, #000 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #000 75%), linear-gradient(-45deg, transparent 75%, #000 75%);
            background-size: 16px 16px;
            background-position: 0 0, 0 8px, 8px -8px, -8px 0px;
        }

        /* Particle canvas */
        #particles-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Cursor blink for typing */
        .cursor::after {
            content: '|';
            animation: blink 0.8s step-end infinite;
            color: #e11d2e;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Glowing effect for CTA */
        .glow-btn {
            position: relative;
            overflow: hidden;
        }
        .glow-btn::before {
            content: '';
            position: absolute;
            top: 50%; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: translateY(-50%) skewX(-20deg);
            transition: left 0.5s ease;
        }
        .glow-btn:hover::before {
            left: 150%;
        }

        /* Card hover with border glow */
        .service-card {
            transition: all 0.3s ease;
            position: relative;
        }
        .service-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(225, 29, 46, 0), rgba(225, 29, 46, 0));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            transition: background 0.3s ease;
            pointer-events: none;
        }
        .service-card:hover::before {
            background: linear-gradient(135deg, rgba(225, 29, 46, 0.8), rgba(225, 29, 46, 0.2));
        }
        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(225, 29, 46, 0.15);
        }

        /* Mobile menu transition */
        #mobile-menu {
            transition: max-height 0.35s ease, opacity 0.35s ease;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        #mobile-menu.open {
            max-height: 200px;
            opacity: 1;
        }

        /* Progress bar */
        #nprogress-bar {
            height: 3px;
            background: linear-gradient(90deg, #e11d2e, #f87171);
            position: fixed;
            top: 0; left: 0;
            z-index: 9999;
            transition: width 0.3s ease;
        }

        /* Stat counter */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* Ripple effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }
        .ripple-wave {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-anim 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple-anim {
            to { transform: scale(4); opacity: 0; }
        }

        /* Scroll to top btn */
        #scroll-top {
            transition: all 0.3s ease;
            transform: translateY(100px);
            opacity: 0;
        }
        #scroll-top.visible {
            transform: translateY(0);
            opacity: 1;
        }

        /* Nav backdrop */
        .nav-sticky {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(10, 10, 11, 0.85);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* Tooltip */
        [data-tooltip] {
            position: relative;
        }
        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) scale(0.8);
            background: rgba(30,30,30,0.95);
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.2s ease;
            transform-origin: bottom center;
        }
        [data-tooltip]:hover::after {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }

        /* Active nav indicator */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 50%;
            width: 0; height: 2px;
            background: #e11d2e;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after { width: 100%; }

        /* Typing text container */
        .typing-container {
            min-height: 4.5rem;
        }
        @media (min-width: 768px) {
            .typing-container { min-height: 5.5rem; }
        }
    </style>
</head>
<body class="bg-asphalt-950 text-white font-body overflow-x-hidden">

    <!-- Particle Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Progress Bar -->
    <div id="nprogress-bar" style="width: 0%"></div>

    <!-- Checker stripe top -->
    <div class="checker h-2 w-full opacity-90 relative z-10"></div>

    <!-- Navigation -->
    <nav id="navbar" class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="TRF Logo" class="h-10 w-10 object-contain transition-transform group-hover:scale-110"
                         onerror="this.style.display='none'; document.getElementById('logo-fallback').style.display='flex';">
                    <div id="logo-fallback" style="display:none;" class="h-10 w-10 rounded-full bg-race-600 items-center justify-center font-display font-bold text-base">TRF</div>
                </div>
                <span class="font-display font-semibold text-xl tracking-wide group-hover:text-race-400 transition-colors">Bengkel <span class="text-race-500">TRF</span></span>
            </a>

            <!-- Desktop nav links -->
            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="#layanan" class="nav-link text-white/70 hover:text-white transition-colors pb-1" id="nav-layanan">Layanan</a>
                <a href="#galeri" class="nav-link text-white/70 hover:text-white transition-colors pb-1" id="nav-galeri">Galeri</a>
                <div class="w-px h-4 bg-white/20"></div>
                <a href="{{ route('login') }}" class="px-4 py-1.5 rounded-lg border border-white/20 hover:bg-white/10 transition text-white/80 hover:text-white">Masuk</a>
                <a href="{{ route('register') }}" class="glow-btn ripple px-4 py-1.5 rounded-lg bg-race-600 hover:bg-race-500 transition font-medium" id="cta-daftar">Daftar</a>
            </div>

            <!-- Mobile menu button -->
            <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1.5 p-2 group" aria-label="Menu">
                <span class="w-6 h-0.5 bg-white transition-all group-aria-expanded:rotate-45 group-aria-expanded:translate-y-2" id="ham-line1"></span>
                <span class="w-6 h-0.5 bg-white transition-all group-aria-expanded:opacity-0" id="ham-line2"></span>
                <span class="w-6 h-0.5 bg-white transition-all group-aria-expanded:-rotate-45 group-aria-expanded:-translate-y-2" id="ham-line3"></span>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden bg-asphalt-900 border-t border-white/10">
            <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-1 text-sm">
                <a href="#layanan" class="px-3 py-2.5 rounded-lg hover:bg-white/5 transition text-white/80 hover:text-white" onclick="closeMobileMenu()">Layanan</a>
                <a href="#galeri" class="px-3 py-2.5 rounded-lg hover:bg-white/5 transition text-white/80 hover:text-white" onclick="closeMobileMenu()">Galeri</a>
                <hr class="border-white/10 my-1">
                <a href="{{ route('login') }}" class="px-3 py-2.5 rounded-lg hover:bg-white/5 transition text-white/80">Masuk</a>
                <a href="{{ route('register') }}" class="px-3 py-2.5 rounded-lg bg-race-600 hover:bg-race-500 transition font-medium text-center mt-1">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-4 pt-14 pb-20 grid md:grid-cols-2 gap-12 items-center relative z-10">
        <div>
            <p class="text-race-400 font-display tracking-widest text-xs mb-4 reveal" style="transition-delay: 0.1s">🏁 BENGKEL RESMI TIM BALAP</p>
            <h1 class="font-display font-bold text-5xl md:text-6xl leading-tight mb-5 reveal" style="transition-delay: 0.2s">
                TRF<span class="text-race-500">.</span><br>
                <span class="typing-container block">
                    <span id="typing-text" class="cursor"></span>
                </span>
            </h1>
            <p class="text-white/60 text-lg mb-8 max-w-md reveal" style="transition-delay: 0.4s">
                Ditangani mekanik berpengalaman di lintasan balap. Presisi, cepat, dan bisa diandalkan — booking servis motor kamu sekarang.
            </p>
            <div class="flex flex-wrap gap-3 reveal" style="transition-delay: 0.5s">
                <a href="{{ route('register') }}" id="hero-cta" class="glow-btn ripple inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-race-600 hover:bg-race-500 transition font-medium group">
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Booking Servis Sekarang
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-white/20 hover:bg-white/10 transition font-medium text-white/80 hover:text-white">
                    Sudah Punya Akun
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Trust badges -->
            <div class="flex flex-wrap gap-4 mt-8 reveal" style="transition-delay: 0.6s">
                <div class="flex items-center gap-2 text-white/50 text-xs" data-tooltip="Mekanik terlatih profesional">
                    <svg class="w-4 h-4 text-race-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Mekanik Bersertifikat
                </div>
                <div class="flex items-center gap-2 text-white/50 text-xs" data-tooltip="Garansi servis 30 hari">
                    <svg class="w-4 h-4 text-race-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Garansi Servis
                </div>
                <div class="flex items-center gap-2 text-white/50 text-xs" data-tooltip="Sparepart original dan bergaransi">
                    <svg class="w-4 h-4 text-race-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Sparepart Original
                </div>
            </div>
        </div>

        <div class="reveal-right">
            <!-- Hero image slot -->
           <div class="rounded-2xl overflow-hidden border border-white/10 mb-5 aspect-video bg-asphalt-900 relative group">
    <video src="{{ asset('videos/hero.mp4') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" autoplay muted loop playsinline
           onerror="this.style.display='none'"></video>
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-asphalt-950/50 to-transparent pointer-events-none"></div>
                <!-- Play button overlay (decorative) -->
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="w-16 h-16 rounded-full bg-race-600/80 backdrop-blur flex items-center justify-center">
                        <svg class="w-6 h-6 ml-1" fill="white" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Stats grid -->
            <div class="bg-asphalt-900 border border-white/10 rounded-2xl p-7">
                <p class="font-display text-xs tracking-widest text-race-400 mb-5">PRESTASI DI LINTASAN</p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="group cursor-default">
                        <p class="font-display font-bold text-4xl stat-number text-white group-hover:text-race-400 transition-colors" data-target="12">0</p>
                        <p class="text-white/50 text-xs mt-1">Juara balap regional</p>
                        <div class="mt-2 h-0.5 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-race-600 rounded-full stat-bar" style="width: 0%" data-width="80%"></div>
                        </div>
                    </div>
                    <div class="group cursor-default">
                        <p class="font-display font-bold text-4xl stat-number text-white group-hover:text-race-400 transition-colors" data-target="8">0</p>
                        <p class="text-white/50 text-xs mt-1">Tahun pengalaman</p>
                        <div class="mt-2 h-0.5 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-race-600 rounded-full stat-bar" style="width: 0%" data-width="60%"></div>
                        </div>
                    </div>
                    <div class="group cursor-default">
                        <p class="font-display font-bold text-4xl stat-number text-white group-hover:text-race-400 transition-colors" data-target="3">0</p>
                        <p class="text-white/50 text-xs mt-1">Kejuaraan nasional</p>
                        <div class="mt-2 h-0.5 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-race-600 rounded-full stat-bar" style="width: 0%" data-width="40%"></div>
                        </div>
                    </div>
                    <div class="group cursor-default">
                        <p class="font-display font-bold text-4xl stat-number text-white group-hover:text-race-400 transition-colors" data-target="500">0</p>
                        <p class="text-white/50 text-xs mt-1">Motor sudah diservis</p>
                        <div class="mt-2 h-0.5 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-race-600 rounded-full stat-bar" style="width: 0%" data-width="100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checker divider -->
    <section class="checker h-2 w-full opacity-90 relative z-10"></section>

    <!-- Layanan Section -->
    <section id="layanan" class="max-w-6xl mx-auto px-4 py-20 relative z-10">
        <div class="text-center mb-12 reveal">
            <p class="text-race-400 font-display tracking-widest text-xs mb-3">APA YANG KAMI TAWARKAN</p>
            <h2 class="font-display font-semibold text-3xl">Layanan Kami</h2>
            <p class="text-white/40 text-sm mt-2 max-w-xs mx-auto">Servis terbaik dengan standar lintasan balap untuk motor harianmu</p>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div class="service-card bg-asphalt-900 border border-white/10 rounded-xl p-6 cursor-pointer reveal" style="transition-delay: 0.1s">
                <div class="w-10 h-10 rounded-lg bg-race-900/40 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-race-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <p class="font-display font-medium text-lg mb-2">Bubut Cnc machine</p>
                <p class="text-white/50 text-sm">akurat, presisi, canggih.</p>
                <div class="mt-4 text-race-400 text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                    Booking <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
            <div class="service-card bg-asphalt-900 border border-white/10 rounded-xl p-6 cursor-pointer reveal" style="transition-delay: 0.2s">
                <div class="w-10 h-10 rounded-lg bg-race-900/40 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-race-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="font-display font-medium text-lg mb-2">Servis Ringan</p>
                <p class="text-white/50 text-sm">Cek rutin, setel rantai & rem.</p>
            </div>
            <div class="service-card bg-asphalt-900 border border-white/10 rounded-xl p-6 cursor-pointer reveal" style="transition-delay: 0.3s">
                <div class="w-10 h-10 rounded-lg bg-race-900/40 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-race-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                </div>
                <p class="font-display font-medium text-lg mb-2">Servis Berat</p>
                <p class="text-white/50 text-sm">Turun mesin, overhaul total.</p>
            </div>
           <div class="service-card bg-asphalt-900 border border-white/10 rounded-xl p-6 cursor-pointer reveal" style="transition-delay: 0.4s">
    <div class="w-10 h-10 rounded-lg bg-race-900/40 flex items-center justify-center mb-4">
        <svg class="w-5 h-5 text-race-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
    </div>
    <p class="font-display font-medium text-lg mb-2">Bore UP</p>
    <p class="text-white/50 text-sm">Tingkatkan performa & tenaga mesin motor kamu.</p>
</div>
        </div>

        <!-- CTA Banner -->
        <div class="mt-10 rounded-2xl border border-race-600/30 bg-gradient-to-r from-race-900/40 to-asphalt-900/60 p-8 flex flex-col sm:flex-row items-center justify-between gap-6 reveal">
            <div>
                <h3 class="font-display text-xl font-semibold">Siap booking servis?</h3>
                <p class="text-white/50 text-sm mt-1">Daftar gratis dan mulai booking dalam 2 menit.</p>
            </div>
            <a href="{{ route('register') }}" class="glow-btn ripple flex-shrink-0 px-6 py-3 rounded-xl bg-race-600 hover:bg-race-500 transition font-medium text-sm whitespace-nowrap">
                Mulai Sekarang →
            </a>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="max-w-6xl mx-auto px-4 py-16 relative z-10">
        <div class="text-center mb-10 reveal">
            <p class="text-race-400 font-display tracking-widest text-xs mb-3">DOKUMENTASI KAMI</p>
            <h2 class="font-display font-semibold text-3xl">Galeri</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="aspect-square rounded-xl overflow-hidden border border-white/10 bg-asphalt-900 relative group reveal" style="transition-delay: 0.1s">
                <img src="{{ asset('images/galeri-1.jpg') }}" alt="Galeri 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.style.display='none'">
                <div class="absolute inset-0 bg-race-600/0 group-hover:bg-race-600/10 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
            </div>
            <div class="aspect-square rounded-xl overflow-hidden border border-white/10 bg-asphalt-900 relative group reveal" style="transition-delay: 0.2s">
                <img src="{{ asset('images/galeri-2.jpg') }}" alt="Galeri 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.style.display='none'">
                <div class="absolute inset-0 bg-race-600/0 group-hover:bg-race-600/10 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
            </div>
            <div class="aspect-square rounded-xl overflow-hidden border border-white/10 bg-asphalt-900 relative group reveal" style="transition-delay: 0.3s">
                <img src="{{ asset('images/galeri-3.jpg') }}" alt="Galeri 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" onerror="this.style.display='none'">
                <div class="absolute inset-0 bg-race-600/0 group-hover:bg-race-600/10 transition-all duration-300 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="checker h-2 w-full opacity-90 relative z-10"></div>
    <footer class="border-t border-white/10 py-8 relative z-10">
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="TRF" class="h-6 w-6 rounded object-cover" onerror="this.style.display='none'">
                <p class="text-white/30 text-xs">© {{ date('Y') }} Bengkel TRF. Semua hak dilindungi.</p>
            </div>
            <div class="flex gap-4 text-xs text-white/30">
                <a href="{{ route('login') }}" class="hover:text-white/60 transition">Masuk</a>
                <a href="{{ route('register') }}" class="hover:text-white/60 transition">Daftar</a>
            </div>
        </div>
    </footer>

    <!-- Scroll to top button -->
    <button id="scroll-top" onclick="scrollToTop()"
        class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-race-600 hover:bg-race-500 flex items-center justify-center shadow-lg shadow-race-900/40 transition-all duration-300"
        aria-label="Kembali ke atas">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <script>
        // ===== PARTICLES =====
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        for (let i = 0; i < 35; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.3,
                vy: (Math.random() - 0.5) * 0.3,
                size: Math.random() * 1.5 + 0.5,
                opacity: Math.random() * 0.3 + 0.05,
                color: Math.random() > 0.7 ? '#e11d2e' : '#ffffff'
            });
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.globalAlpha = p.opacity;
                ctx.fill();
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
            });
            ctx.globalAlpha = 1;
            requestAnimationFrame(drawParticles);
        }
        drawParticles();

        // ===== TYPING EFFECT =====
        const texts = [
            'Servis kelas balap,',
            'untuk motor harianmu.',
            'Cepat & terpercaya.',
            'Presisi seperti di lintasan.'
        ];
        let textIdx = 0, charIdx = 0, isDeleting = false;
        const typingEl = document.getElementById('typing-text');

        function type() {
            const current = texts[textIdx];
            if (!isDeleting) {
                typingEl.textContent = current.substring(0, charIdx + 1);
                charIdx++;
                if (charIdx === current.length) {
                    isDeleting = true;
                    setTimeout(type, 1800);
                    return;
                }
            } else {
                typingEl.textContent = current.substring(0, charIdx - 1);
                charIdx--;
                if (charIdx === 0) {
                    isDeleting = false;
                    textIdx = (textIdx + 1) % texts.length;
                }
            }
            setTimeout(type, isDeleting ? 50 : 90);
        }
        setTimeout(type, 800);

        // ===== SCROLL REVEAL =====
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
            revealObserver.observe(el);
        });

        // Trigger hero reveals immediately
        setTimeout(() => {
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) el.classList.add('visible');
            });
        }, 100);

        // ===== COUNTER ANIMATION =====
        function animateCounter(el, target, suffix = '') {
            const duration = 2000;
            const start = performance.now();
            function update(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.floor(eased * target) + suffix;
                if (progress < 1) requestAnimationFrame(update);
                else el.textContent = target + suffix;
            }
            requestAnimationFrame(update);
        }

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.counted) {
                    entry.target.dataset.counted = true;
                    const target = parseInt(entry.target.dataset.target);
                    const suffix = entry.target.closest('[data-target]') ? '' : '+';
                    animateCounter(entry.target, target, target >= 100 ? '+' : (target === 3 ? '' : '+'));

                    // Animate progress bars
                    entry.target.closest('.group')?.querySelectorAll('.stat-bar').forEach(bar => {
                        setTimeout(() => {
                            bar.style.transition = 'width 2s ease';
                            bar.style.width = bar.dataset.width;
                        }, 200);
                    });
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.stat-number').forEach(el => counterObserver.observe(el));

        // Animate stat bars when stats are visible
        const statsSection = document.querySelector('.stat-bar');
        if (statsSection) {
            const barObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        document.querySelectorAll('.stat-bar').forEach(bar => {
                            setTimeout(() => {
                                bar.style.transition = 'width 2s ease';
                                bar.style.width = bar.dataset.width;
                            }, 300);
                        });
                        barObserver.disconnect();
                    }
                });
            }, { threshold: 0.3 });
            barObserver.observe(statsSection);
        }

        // ===== STICKY NAVBAR =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.add('nav-sticky');
            } else {
                navbar.classList.remove('nav-sticky');
            }

            // Scroll to top button
            const scrollBtn = document.getElementById('scroll-top');
            if (window.scrollY > 300) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        });

        // ===== MOBILE MENU =====
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        let menuOpen = false;

        mobileMenuBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;
            mobileMenu.classList.toggle('open', menuOpen);
            mobileMenuBtn.setAttribute('aria-expanded', menuOpen);
            document.getElementById('ham-line1').style.transform = menuOpen ? 'rotate(45deg) translate(5px, 5px)' : '';
            document.getElementById('ham-line2').style.opacity = menuOpen ? '0' : '1';
            document.getElementById('ham-line3').style.transform = menuOpen ? 'rotate(-45deg) translate(5px, -5px)' : '';
        });

        function closeMobileMenu() {
            menuOpen = false;
            mobileMenu.classList.remove('open');
            mobileMenuBtn.setAttribute('aria-expanded', false);
            document.getElementById('ham-line1').style.transform = '';
            document.getElementById('ham-line2').style.opacity = '1';
            document.getElementById('ham-line3').style.transform = '';
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const id = a.getAttribute('href').slice(1);
                const el = document.getElementById(id);
                if (el) {
                    e.preventDefault();
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // ===== RIPPLE EFFECT =====
        document.querySelectorAll('.ripple').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const size = Math.max(rect.width, rect.height);
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-wave');
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (x - size/2) + 'px';
                ripple.style.top = (y - size/2) + 'px';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 700);
            });
        });

        // ===== SCROLL TO TOP =====
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // ===== PROGRESS BAR ON LOAD =====
        const bar = document.getElementById('nprogress-bar');
        bar.style.width = '30%';
        setTimeout(() => { bar.style.width = '70%'; }, 300);
        window.addEventListener('load', () => {
            bar.style.width = '100%';
            setTimeout(() => { bar.style.opacity = '0'; }, 500);
        });

        // ===== SERVICE CARD CLICK → SCROLL TO TOP (booking) =====
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', () => {
                document.getElementById('hero-cta').scrollIntoView({ behavior: 'smooth', block: 'center' });
                document.getElementById('hero-cta').classList.add('animate-bounce');
                setTimeout(() => document.getElementById('hero-cta').classList.remove('animate-bounce'), 1500);
            });
        });
    </script>
    @include('components.chatbot')
</body>
</html>
