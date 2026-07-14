@extends('layouts.app')

@section('title', 'Booking Servis')

@section('styles')
<style>
    .form-step {
        transition: all 0.3s ease;
    }
    .field-focus-effect {
        transition: all 0.2s ease;
    }
    .field-focus-effect:focus {
        box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.1);
        border-color: #ea580c;
        transform: translateY(-1px);
    }
    .service-option {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .service-option:has(input:checked) {
        border-color: #ea580c;
        background-color: #fff7ed;
    }
    .service-option:hover {
        border-color: #ea580c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(194,65,12,0.12);
    }
    .submit-btn {
        position: relative;
        overflow: hidden;
    }
    .submit-btn::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }
    .submit-btn:hover::after {
        transform: translateX(100%);
    }
    .price-tag {
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="max-w-2xl">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-600 transition-colors">Dashboard</a>
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('bookings.index') }}" class="hover:text-slate-600 transition-colors">Booking</a>
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-600 font-medium">Booking Baru</span>
    </nav>

    <h1 class="text-2xl font-bold text-slate-800 mb-1">Booking Servis</h1>
    <p class="text-slate-500 text-sm mb-6">Isi formulir di bawah untuk menjadwalkan servis motormu.</p>

    @if($motors->isEmpty())
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 flex items-start gap-4">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="font-semibold text-amber-800">Motor belum terdaftar</p>
                <p class="text-amber-700 text-sm mt-1">Kamu perlu menambahkan motor terlebih dahulu sebelum bisa booking servis.</p>
                <a href="{{ route('motors.create') }}" class="inline-flex items-center gap-1.5 mt-3 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg text-sm font-medium transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Motor Sekarang
                </a>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <!-- Form header -->
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-oli-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 text-sm">Formulir Booking Servis</p>
                        <p class="text-xs text-slate-400">Semua field dengan * wajib diisi</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('bookings.store') }}" class="p-6 space-y-5" id="booking-form">
                @csrf

                <!-- Motor selection -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5" for="motor_id">
                        Pilih Motor <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="motor_id" id="motor_id" required onchange="previewMotor(this)"
                            class="field-focus-effect w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none bg-white appearance-none text-slate-700">
                            <option value="">-- Pilih motor --</option>
                            @foreach($motors as $motor)
                                <option value="{{ $motor->id }}"
                                    data-plat="{{ $motor->no_plat }}"
                                    {{ old('motor_id') == $motor->id ? 'selected' : '' }}>
                                    {{ $motor->merk }} {{ $motor->tipe }} ({{ $motor->no_plat }})
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <!-- Motor preview -->
                    <div id="motor-preview" class="hidden mt-2 px-3 py-2 bg-oli-50 border border-oli-100 rounded-lg text-xs text-oli-700 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span id="motor-preview-text"></span>
                    </div>
                </div>

                <!-- Layanan selection -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5" for="layanan_id">
                        Jenis Layanan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="layanan_id" id="layanan_id" required onchange="showPrice(this)"
                            class="field-focus-effect w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none bg-white appearance-none text-slate-700">
                            <option value="">-- Pilih layanan --</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}"
                                    data-harga="{{ $layanan->harga }}"
                                    {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}>
                                    {{ $layanan->nama }} — Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                        </div>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <!-- Price display -->
                    <div id="price-display" class="hidden mt-2 px-3 py-2 bg-emerald-50 border border-emerald-100 rounded-lg text-xs text-emerald-700 font-medium flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Estimasi biaya: <span id="price-amount" class="font-bold"></span>
                    </div>
                </div>

                <!-- Tanggal & Jam -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5" for="tanggal_servis">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" name="tanggal_servis" id="tanggal_servis"
                                value="{{ old('tanggal_servis') }}"
                                min="{{ date('Y-m-d') }}" required
                                class="field-focus-effect w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl focus:outline-none bg-white text-slate-700">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5" for="jam_servis">
                            Jam <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="time" name="jam_servis" id="jam_servis"
                                value="{{ old('jam_servis') }}" required
                                min="07:00" max="17:00"
                                class="field-focus-effect w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl focus:outline-none bg-white text-slate-700">
                            <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Jam operasional: 07.00 – 17.00</p>
                    </div>
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5" for="catatan">
                        Catatan <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <div class="relative">
                        <textarea name="catatan" id="catatan" rows="3"
                            placeholder="Contoh: motor bunyi kasar saat direm, atau ada keluhan khusus lainnya..."
                            onkeyup="updateCharCount(this)"
                            maxlength="500"
                            class="field-focus-effect w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none bg-white text-slate-700 resize-none">{{ old('catatan') }}</textarea>
                    </div>
                    <div class="flex justify-between mt-1">
                        <p class="text-xs text-slate-400">Keluhan atau catatan tambahan untuk mekanik</p>
                        <p class="text-xs text-slate-400"><span id="char-count">0</span>/500</p>
                    </div>
                </div>

                <!-- Summary box -->
                <div id="booking-summary" class="hidden bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm">
                    <p class="font-semibold text-slate-700 mb-2 text-xs uppercase tracking-wider">Ringkasan Booking</p>
                    <div class="space-y-1.5 text-slate-600">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Motor</span>
                            <span id="sum-motor" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Layanan</span>
                            <span id="sum-layanan" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Tanggal</span>
                            <span id="sum-tanggal" class="font-medium">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Jam</span>
                            <span id="sum-jam" class="font-medium">-</span>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center gap-3 pt-2 border-t border-slate-100">
                    <button type="submit" id="submit-btn"
                        class="submit-btn flex-1 sm:flex-none btn-ripple bg-oli-600 hover:bg-oli-700 text-white font-semibold px-6 py-3 rounded-xl transition-all hover:-translate-y-0.5 hover:shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Konfirmasi Booking
                    </button>
                    <a href="{{ route('bookings.index') }}" class="px-4 py-3 text-slate-500 hover:text-slate-700 text-sm transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Show price when service selected
    function showPrice(select) {
        const opt = select.options[select.selectedIndex];
        const priceDisplay = document.getElementById('price-display');
        const priceAmount = document.getElementById('price-amount');
        if (opt.dataset.harga) {
            const harga = parseInt(opt.dataset.harga);
            priceAmount.textContent = 'Rp ' + harga.toLocaleString('id-ID');
            priceDisplay.classList.remove('hidden');
            priceDisplay.style.animation = 'none';
            requestAnimationFrame(() => {
                priceDisplay.style.animation = 'slideDown 0.3s ease';
            });
        } else {
            priceDisplay.classList.add('hidden');
        }
        updateSummary();
    }

    // Preview motor selection
    function previewMotor(select) {
        const opt = select.options[select.selectedIndex];
        const preview = document.getElementById('motor-preview');
        const previewText = document.getElementById('motor-preview-text');
        if (opt.value) {
            previewText.textContent = `Plat nomor: ${opt.dataset.plat || '-'}`;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
        updateSummary();
    }

    // Char counter
    function updateCharCount(el) {
        document.getElementById('char-count').textContent = el.value.length;
    }

    // Update summary
    function updateSummary() {
        const motorSel = document.getElementById('motor_id');
        const layanSel = document.getElementById('layanan_id');
        const tgl = document.getElementById('tanggal_servis');
        const jam = document.getElementById('jam_servis');
        const summary = document.getElementById('booking-summary');

        const hasValues = motorSel.value && layanSel.value;
        summary.classList.toggle('hidden', !hasValues);

        if (hasValues) {
            document.getElementById('sum-motor').textContent = motorSel.options[motorSel.selectedIndex]?.text?.split(' (')[0] || '-';
            document.getElementById('sum-layanan').textContent = layanSel.options[layanSel.selectedIndex]?.text?.split(' —')[0] || '-';
            document.getElementById('sum-tanggal').textContent = tgl.value ? new Date(tgl.value + 'T00:00:00').toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-';
            document.getElementById('sum-jam').textContent = jam.value || '-';
        }
    }

    // Update summary on date/time change
    ['tanggal_servis', 'jam_servis'].forEach(id => {
        document.getElementById(id)?.addEventListener('change', updateSummary);
    });

    // Form submit with loading state
    document.getElementById('booking-form')?.addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');
        btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
        btn.disabled = true;
        btn.style.opacity = '0.8';
    });

    // Init char count
    const catatanEl = document.getElementById('catatan');
    if (catatanEl) document.getElementById('char-count').textContent = catatanEl.value.length;
</script>
<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
