<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bengkel TRF') — Bengkel TRF</title>
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
                        race: { 50:'#fef2f2', 400:'#f87171', 500:'#e11d2e', 600:'#c2410c', 700:'#9a3412', 900:'#450a0a' },
                        asphalt: { 800:'#1c1c1e', 900:'#121214', 950:'#0a0a0b' },
                    },
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
        #particles-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }
        .glass-card {
            background: rgba(18, 18, 20, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .input-field {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            color: #fff;
            transition: border-color 0.2s, background 0.2s;
        }
        .input-field::placeholder { color: rgba(255,255,255,0.3); }
        .input-field:focus {
            outline: none;
            border-color: #e11d2e;
            background: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 3px rgba(225,29,46,0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #e11d2e, #c2410c);
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transform: translateY(-50%) skewX(-20deg);
            transition: left 0.4s ease;
        }
        .btn-primary:hover::before { left: 150%; }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(225,29,46,0.35); }
        label { color: rgba(255,255,255,0.7); }
        .link-accent { color: #f87171; }
        .link-accent:hover { color: #e11d2e; text-decoration: underline; }
    </style>
</head>
<body class="bg-asphalt-950 text-white font-body min-h-screen flex flex-col overflow-x-hidden">

    <!-- Particle Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Checker stripe top -->
    <div class="checker h-2 w-full opacity-90 relative z-10 flex-shrink-0"></div>

    <!-- Main content -->
    <div class="flex-1 flex items-center justify-center px-4 py-10 relative z-10">
        @yield('content')
    </div>

    <!-- Checker stripe bottom -->
    <div class="checker h-2 w-full opacity-90 relative z-10 flex-shrink-0"></div>

    <script>
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
        for (let i = 0; i < 30; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.25,
                vy: (Math.random() - 0.5) * 0.25,
                size: Math.random() * 1.5 + 0.4,
                opacity: Math.random() * 0.25 + 0.04,
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
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
            });
            ctx.globalAlpha = 1;
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
    </script>
</body>
</html>
