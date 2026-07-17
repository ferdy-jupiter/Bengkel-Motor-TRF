<div id="chatbot-widget" class="fixed bottom-5 right-5 z-50">

    {{-- Tombol pembuka --}}
    <button id="chatbot-toggle"
        class="w-14 h-14 rounded-full bg-race-600 hover:bg-race-500 shadow-lg flex items-center justify-center text-2xl transition-transform hover:scale-105">
        <span id="chatbot-icon-open">💬</span>
        <span id="chatbot-icon-close" style="display:none;">✕</span>
    </button>

    {{-- Jendela chat --}}
    <div id="chatbot-window" style="display:none; height: 420px;"
        class="absolute bottom-16 right-0 w-80 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden flex flex-col">

        <div class="bg-asphalt-900 text-white px-4 py-3">
            <p class="font-semibold text-sm">Asisten TRF 🏍️</p>
            <p class="text-xs text-white/60">Biasanya balas dalam sekejap</p>
        </div>

        <div id="chatbot-body" class="flex-1 overflow-y-auto p-3 space-y-2 bg-slate-50"></div>

        <div class="p-2 border-t border-slate-200 flex flex-wrap gap-1.5 bg-white">
            <button type="button"
                class="chatbot-quick text-xs bg-slate-100 hover:bg-slate-200 px-2.5 py-1 rounded-full text-slate-600"
                data-q="jam buka">Jam buka</button>
            <button type="button"
                class="chatbot-quick text-xs bg-slate-100 hover:bg-slate-200 px-2.5 py-1 rounded-full text-slate-600"
                data-q="harga servis">Harga servis</button>
            <button type="button"
                class="chatbot-quick text-xs bg-slate-100 hover:bg-slate-200 px-2.5 py-1 rounded-full text-slate-600"
                data-q="cara booking">Cara booking</button>
        </div>

        <form id="chatbot-form" class="p-2 border-t border-slate-200 flex gap-2 bg-white">
            <input id="chatbot-input" type="text" placeholder="Tulis pertanyaan..." autocomplete="off"
                class="flex-1 text-sm px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-race-500">
            <button type="submit"
                class="bg-race-600 hover:bg-race-500 text-white px-3 rounded-lg text-sm">Kirim</button>
        </form>
    </div>
</div>

<script>
    (function () {
        var isOpen = false;
        var toggleBtn = document.getElementById('chatbot-toggle');
        var windowEl = document.getElementById('chatbot-window');
        var iconOpen = document.getElementById('chatbot-icon-open');
        var iconClose = document.getElementById('chatbot-icon-close');
        var body = document.getElementById('chatbot-body');
        var form = document.getElementById('chatbot-form');
        var input = document.getElementById('chatbot-input');

        function addMessage(from, text) {
            var wrap = document.createElement('div');
            wrap.className = from === 'bot' ? 'flex justify-start' : 'flex justify-end';

            var bubble = document.createElement('div');
            bubble.className = (from === 'bot'
                ? 'bg-white border border-slate-200 text-slate-700'
                : 'bg-race-600 text-white') + ' px-3 py-2 rounded-xl text-sm max-w-[85%]';
            bubble.textContent = text;

            wrap.appendChild(bubble);
            body.appendChild(wrap);
            body.scrollTop = body.scrollHeight;
        }

        function getReply(text) {
            var t = text.toLowerCase();

            if (t.indexOf('jam') !== -1 || t.indexOf('buka') !== -1 || t.indexOf('tutup') !== -1) {
                return 'Bengkel TRF buka setiap hari Senin–Sabtu, jam 08.00–17.00 WITA. Hari Minggu libur ya!';
            }
            if (t.indexOf('harga') !== -1 || t.indexOf('biaya') !== -1 || t.indexOf('tarif') !== -1) {
                return 'Harga layanan mulai dari Rp50.000 sampai Rp500.000 tergantung jenis servisnya. Rincian lengkap bisa dilihat di halaman layanan setelah kamu login.';
            }
            if (t.indexOf('booking') !== -1 || t.indexOf('reservasi') !== -1 || t.indexOf('daftar servis') !== -1) {
                return 'Caranya gampang: 1) Daftar akun / login, 2) Tambahkan data motor kamu, 3) Buka menu Booking Servis, pilih layanan & jadwal, selesai!';
            }
            if (t.indexOf('lokasi') !== -1 || t.indexOf('alamat') !== -1 || t.indexOf('dimana') !== -1) {
                return 'Alamat bengkel TRF: Gambah Luar Muka, Kandangan, Hulu Sungai Selatan, Kalimantan Selatan 71291.';
            }
            if (t.indexOf('daftar') !== -1 || t.indexOf('akun') !== -1 || t.indexOf('registrasi') !== -1) {
                return 'Kamu bisa daftar akun gratis lewat tombol "Daftar" di halaman utama. Cukup isi nama, email, dan password.';
            }
            if (t.indexOf('mekanik') !== -1) {
                return 'Semua motor ditangani mekanik berpengalaman yang juga terjun di dunia balap, jadi soal kualitas nggak perlu diragukan 🏁';
            }
            if (t.indexOf('makasih') !== -1 || t.indexOf('terima kasih') !== -1) {
                return 'Sama-sama! Kalau ada pertanyaan lain, tanya aja lagi ya 😊';
            }
            if (t.indexOf('halo') !== -1 || t.indexOf('hai') !== -1 || t.indexOf('hi') !== -1) {
                return 'Halo juga! Ada yang bisa dibantu soal servis motor kamu?';
            }

            return 'Hmm, aku belum ngerti maksudnya. Coba tanya soal jam buka, harga servis, atau cara booking ya. Atau hubungi admin langsung untuk pertanyaan lebih detail.';
        }

        function sendMessage(text) {
            text = text.trim();
            if (!text) return;

            addMessage('user', text);
            input.value = '';

            setTimeout(function () {
                addMessage('bot', getReply(text));
            }, 400);
        }

        toggleBtn.addEventListener('click', function () {
            isOpen = !isOpen;
            windowEl.style.display = isOpen ? 'flex' : 'none';
            iconOpen.style.display = isOpen ? 'none' : 'inline';
            iconClose.style.display = isOpen ? 'inline' : 'none';
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            sendMessage(input.value);
        });

        document.querySelectorAll('.chatbot-quick').forEach(function (btn) {
            btn.addEventListener('click', function () {
                sendMessage(btn.getAttribute('data-q'));
            });
        });

        addMessage('bot', 'Halo! Aku asisten TRF 🏍️ Ada yang bisa dibantu soal servis motor?');
    })();
</script>