<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bengkel Motor') - TRF Sistem Servis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        oli: { 50:'#fff7ed', 100:'#ffedd5', 500:'#ea580c', 600:'#c2410c', 700:'#9a3412' },
                    },
                    animation: {
                        'slide-in-right': 'slideInRight 0.4s ease-out',
                        'slide-out-right': 'slideOutRight 0.3s ease-in',
                        'shake': 'shake 0.4s ease-in-out',
                        'ping-once': 'ping 1s ease-in-out 1',
                    },
                    keyframes: {
                        slideInRight: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideOutRight: {
                            '0%': { transform: 'translateX(0)', opacity: '1' },
                            '100%': { transform: 'translateX(110%)', opacity: '0' },
                        },
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '25%': { transform: 'translateX(-6px)' },
                            '75%': { transform: 'translateX(6px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Page transition */
        body { opacity: 0; animation: pageIn 0.3s ease forwards; }
        @keyframes pageIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Progress bar */
        #page-progress {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: linear-gradient(90deg, #c2410c, #ea580c, #fb923c);
            z-index: 9999;
            transition: width 0.3s ease, opacity 0.5s ease;
            box-shadow: 0 0 8px rgba(194, 65, 12, 0.5);
        }

        /* Toast notifications */
        #toast-container {
            position: fixed; top: 70px; right: 16px; z-index: 9998;
            display: flex; flex-direction: column; gap: 8px;
            pointer-events: none;
        }
        .toast {
            pointer-events: all;
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12), 0 1px 4px rgba(0,0,0,0.08);
            border-left: 4px solid transparent;
            min-width: 280px; max-width: 360px;
            animation: slideInRight 0.4s ease-out;
            position: relative;
            overflow: hidden;
        }
        .toast::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            height: 3px;
            background: currentColor;
            animation: toastProgress linear forwards;
        }
        .toast.success { border-left-color: #16a34a; color: #16a34a; }
        .toast.error { border-left-color: #dc2626; color: #dc2626; }
        .toast.info { border-left-color: #2563eb; color: #2563eb; }
        .toast.warning { border-left-color: #d97706; color: #d97706; }
        @keyframes toastProgress {
            from { width: 100%; }
            to { width: 0%; }
        }
        .toast.closing { animation: slideOutRight 0.3s ease-in forwards; }

        /* Active nav link */
        .nav-link-active {
            background-color: rgb(15 23 42 / 0.8) !important;
            color: #ea580c !important;
            position: relative;
        }
        .nav-link-active::after {
            content: '';
            position: absolute;
            bottom: 0; left: 12px; right: 12px;
            height: 2px;
            background: #ea580c;
            border-radius: 1px;
        }

        /* Hover nav link animation */
        .nav-item {
            position: relative;
            overflow: hidden;
        }
        .nav-item::before {
            content: '';
            position: absolute;
            bottom: 0; left: 50%;
            width: 0; height: 2px;
            background: #ea580c;
            transition: all 0.2s ease;
            transform: translateX(-50%);
        }
        .nav-item:hover::before { width: calc(100% - 24px); }

        /* Dropdown user menu */
        #user-dropdown {
            transform-origin: top right;
            transition: all 0.2s ease;
        }
        #user-dropdown.hidden {
            transform: scale(0.95);
            opacity: 0;
            pointer-events: none;
        }
        #user-dropdown:not(.hidden) {
            transform: scale(1);
            opacity: 1;
        }

        /* Mobile menu */
        #mobile-nav {
            transition: max-height 0.3s ease, opacity 0.3s ease;
            max-height: 0; opacity: 0; overflow: hidden;
        }
        #mobile-nav.open { max-height: 300px; opacity: 1; }

        /* Ripple */
        .btn-ripple { position: relative; overflow: hidden; }
        .ripple-circle {
            position: absolute; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: scale(0);
            animation: ripple-go 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple-go { to { transform: scale(4); opacity: 0; } }

        /* Card hover */
        .stat-card {
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        /* Row hover highlight */
        tbody tr {
            transition: background-color 0.15s ease;
        }

        /* Alert badge pulse */
        .badge-pulse {
            animation: pulseBadge 2s ease-in-out infinite;
        }
        @keyframes pulseBadge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
            50% { box-shadow: 0 0 0 6px rgba(245, 158, 11, 0); }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Focus visible */
        :focus-visible { outline: 2px solid #ea580c; outline-offset: 2px; }
    </style>

    @yield('styles')
</head>
<body class="bg-slate-100 min-h-screen font-sans antialiased">

    <!-- Page Progress Bar -->
    <div id="page-progress"></div>

    <!-- Toast Container -->
    <div id="toast-container" aria-live="polite"></div>
    @include('components.chatbot')

    <!-- Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo + nav links -->
                <div class="flex items-center gap-6">
                    <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                       class="flex items-center gap-2.5 font-bold text-lg tracking-tight hover:opacity-90 transition-opacity group">
                        <div class="relative">
                            <img src="{{ asset('images/logo.png') }}" alt="TRF" class="h-8 w-8 object-contain transition-transform group-hover:scale-110"
                                 onerror="this.style.display='none'">
                        </div>
                        <span class="text-white">TRF</span>
                        <span class="hidden sm:inline text-slate-500 text-xs font-normal tracking-widest">BENGKEL</span>
                    </a>

                    @auth
                        <div class="hidden md:flex items-center gap-1 text-sm">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Dashboard</a>
                                <a href="{{ route('admin.bookings.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.bookings.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Booking</a>
                                <a href="{{ route('admin.layanans.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.layanans.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Layanan</a>
                                <a href="{{ route('admin.mekaniks.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.mekaniks.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Mekanik</a>
                                <a href="{{ route('admin.spareparts.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.spareparts.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Sparepart</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Dashboard</a>
                                <a href="{{ route('motors.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('motors.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Motor Saya</a>
                                <a href="{{ route('bookings.index') }}" class="nav-item px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('bookings.*') ? 'nav-link-active' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">Booking Servis</a>
                            @endif
                        </div>
                    @endauth
                </div>

                <!-- Right side -->
                <div class="flex items-center gap-3">
                    @auth
                        <!-- User dropdown -->
                        <div class="relative" id="user-menu-wrapper">
                            <button id="user-menu-btn" onclick="toggleUserMenu()"
                                class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg hover:bg-slate-800 transition-colors text-sm group"
                                aria-expanded="false" aria-haspopup="true">
                                <!-- Avatar initials -->
                                <div class="w-7 h-7 rounded-full bg-oli-600 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden sm:block text-slate-300 group-hover:text-white transition-colors max-w-24 truncate">{{ auth()->user()->name }}</span>
                                <svg id="chevron-down" class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <!-- Dropdown -->
                            <div id="user-dropdown" class="hidden absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-1.5 text-sm text-slate-700">
                                <div class="px-4 py-2.5 border-b border-slate-100">
                                    <p class="font-semibold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-400 truncate mt-0.5">{{ auth()->user()->email }}</p>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                        Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        Dashboard
                                    </a>
                                    <a href="{{ route('bookings.create') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Booking Baru
                                    </a>
                                @endif
                                <div class="border-t border-slate-100 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 hover:bg-red-50 hover:text-red-600 transition-colors text-left">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile menu button -->
                        <button id="mobile-nav-btn" onclick="toggleMobileNav()" class="md:hidden p-2 rounded-lg hover:bg-slate-800 transition-colors" aria-label="Menu">
                            <svg class="w-5 h-5" id="ham-open" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            <svg class="w-5 h-5 hidden" id="ham-close" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile nav -->
        @auth
        <div id="mobile-nav" class="md:hidden border-t border-slate-800">
            <div class="max-w-6xl mx-auto px-4 py-2 space-y-0.5">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Dashboard</a>
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.bookings.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Booking</a>
                    <a href="{{ route('admin.layanans.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.layanans.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Layanan</a>
                    <a href="{{ route('admin.mekaniks.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.mekaniks.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Mekanik</a>
                    <a href="{{ route('admin.spareparts.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('admin.spareparts.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Sparepart</a>
                @else
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Dashboard</a>
                    <a href="{{ route('motors.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('motors.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Motor Saya</a>
                    <a href="{{ route('bookings.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm {{ request()->routeIs('bookings.*') ? 'bg-slate-800 text-oli-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">Booking Servis</a>
                @endif
            </div>
        </div>
        @endauth
    </nav>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">

        {{-- Toast dari session --}}
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('success')) }}', 'success'));
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', () => showToast('{{ addslashes(session('error')) }}', 'error'));
            </script>
        @endif

        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const msgs = @json($errors->all());
                    msgs.slice(0, 3).forEach((m, i) => setTimeout(() => showToast(m, 'error'), i * 200));
                });
            </script>
        @endif

        @yield('content')
    </main>

    <!-- Scroll to top button -->
    <button id="scroll-top-btn" onclick="window.scrollTo({top:0, behavior:'smooth'})"
        class="fixed bottom-6 right-6 z-50 w-10 h-10 rounded-full bg-oli-600 hover:bg-oli-700 text-white flex items-center justify-center shadow-lg transition-all duration-300 opacity-0 translate-y-4 pointer-events-none"
        aria-label="Kembali ke atas">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <script>
        // ===== PAGE PROGRESS BAR =====
        const progressBar = document.getElementById('page-progress');
        progressBar.style.width = '30%';
        setTimeout(() => { progressBar.style.width = '80%'; }, 200);
        window.addEventListener('load', () => {
            progressBar.style.width = '100%';
            setTimeout(() => { progressBar.style.opacity = '0'; }, 400);
        });

        // ===== TOAST SYSTEM =====
        const icons = {
            success: `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>`,
            error: `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>`,
            info: `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>`,
            warning: `<svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>`,
        };
        const textColors = { success: 'text-green-600', error: 'text-red-600', info: 'text-blue-600', warning: 'text-amber-600' };
        const durations = { success: 4000, error: 5000, info: 4000, warning: 4500 };

        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            const dur = durations[type] || 4000;
            toast.style.setProperty('--dur', dur + 'ms');
            toast.innerHTML = `
                <span class="${textColors[type]}">${icons[type] || ''}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-slate-800 text-sm leading-snug">${message}</p>
                </div>
                <button onclick="closeToast(this.parentElement)" class="text-slate-300 hover:text-slate-600 transition-colors flex-shrink-0 -mt-0.5 ml-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            toast.querySelector('::after');
            // Progress bar inside toast
            const prog = document.createElement('div');
            prog.style.cssText = `position:absolute;bottom:0;left:0;height:3px;background:currentColor;width:100%;border-radius:0 0 0 0;`;
            prog.style.transition = `width ${dur}ms linear`;
            toast.appendChild(prog);
            container.appendChild(toast);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => { prog.style.width = '0%'; });
            });
            setTimeout(() => closeToast(toast), dur);
        }

        function closeToast(el) {
            if (!el || el.classList.contains('closing')) return;
            el.classList.add('closing');
            setTimeout(() => el.remove(), 350);
        }

        // ===== USER DROPDOWN =====
        let dropdownOpen = false;
        function toggleUserMenu() {
            const dropdown = document.getElementById('user-dropdown');
            const chevron = document.getElementById('chevron-down');
            const btn = document.getElementById('user-menu-btn');
            dropdownOpen = !dropdownOpen;
            dropdown.classList.toggle('hidden', !dropdownOpen);
            chevron.style.transform = dropdownOpen ? 'rotate(180deg)' : '';
            btn.setAttribute('aria-expanded', dropdownOpen);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const wrapper = document.getElementById('user-menu-wrapper');
            if (wrapper && !wrapper.contains(e.target) && dropdownOpen) {
                toggleUserMenu();
            }
        });

        // ===== MOBILE NAV =====
        let mobileNavOpen = false;
        function toggleMobileNav() {
            mobileNavOpen = !mobileNavOpen;
            const nav = document.getElementById('mobile-nav');
            const open = document.getElementById('ham-open');
            const close = document.getElementById('ham-close');
            nav?.classList.toggle('open', mobileNavOpen);
            open?.classList.toggle('hidden', mobileNavOpen);
            close?.classList.toggle('hidden', !mobileNavOpen);
        }

        // ===== SCROLL TO TOP =====
        const scrollBtn = document.getElementById('scroll-top-btn');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollBtn.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                scrollBtn.classList.add('opacity-100', 'translate-y-0');
            } else {
                scrollBtn.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
                scrollBtn.classList.remove('opacity-100', 'translate-y-0');
            }
        });

        // ===== PAGE TRANSITIONS =====
        document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="mailto"]):not([href^="javascript"])').forEach(link => {
            const href = link.getAttribute('href');
            if (!href || href.startsWith('#')) return;
            link.addEventListener('click', (e) => {
                if (link.hostname !== window.location.hostname) return;
                const form = link.closest('form');
                if (form) return;
                e.preventDefault();
                document.body.style.opacity = '0';
                document.body.style.transition = 'opacity 0.2s ease';
                progressBar.style.opacity = '1';
                progressBar.style.width = '60%';
                setTimeout(() => { window.location.href = href; }, 200);
            });
        });

        // ===== RIPPLE EFFECT =====
        document.querySelectorAll('.btn-ripple').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const circle = document.createElement('span');
                circle.className = 'ripple-circle';
                circle.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX - rect.left - size/2}px;top:${e.clientY - rect.top - size/2}px`;
                this.appendChild(circle);
                setTimeout(() => circle.remove(), 600);
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
