<!DOCTYPE html>
<html lang="en">
<script>document.documentElement.setAttribute('data-theme', localStorage.getItem('troy-theme') || 'light');</script>
<head>
    <meta charset="utf-8">
    <title>TROY Perfumes – All Fragrances</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root{
            --bg:#050816;
            --bg-soft:#050b1f;
            --bg-elevated:#070f25;
            --primary:#22c55e;
            --primary-soft:rgba(34,197,94,0.14);
            --primary-strong:#16a34a;
            --accent:#38bdf8;
            --card:#050b18;
            --glass:rgba(15,23,42,0.65);
            --text-main:#e5f2ff;
            --text-muted:#9ca3af;
            --border-subtle:rgba(148,163,184,0.35);
            --danger:#ef4444;
            --warning:#eab308;
            --success:#22c55e;
            --card-radius:26px;
            --shadow-soft:0 18px 45px rgba(15,23,42,0.75);
            --shadow-main:0 22px 65px rgba(15,23,42,0.95);
        }

        *{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth;}
        body{
            font-family:'Poppins',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
            background:radial-gradient(circle at top, #172554 0, #020617 55%, #000 100%);
            background-attachment:fixed;
            color:var(--text-main);
            min-height:100vh;
            -webkit-font-smoothing:antialiased;
        }

        /* Simple Header */
        .header{
            position:sticky;
            top:0;
            z-index:20;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:1.2rem 4.5rem;
            background:linear-gradient(to bottom,rgba(2,6,23,0.96),rgba(2,6,23,0.85),transparent);
            backdrop-filter:blur(18px);
            border-bottom:1px solid rgba(148,163,184,0.2);
        }
        .logo{
            display:flex;
            align-items:center;
            gap:.75rem;
            text-decoration:none;
            color:var(--text-main);
        }
        .logo-img{
            width:60px;
            height:60px;
            border-radius:12px;
        }
        .logo-text{
            font-weight:900;
            letter-spacing:.15em;
            font-size:1.5rem;
        }
        .back-btn{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 20px;
            background:rgba(15,23,42,0.8);
            color:var(--text-main);
            text-decoration:none;
            border-radius:999px;
            border:1px solid rgba(148,163,184,0.4);
            transition:all 0.3s;
        }
        .back-btn:hover{
            background:rgba(30,41,59,0.8);
            border-color:var(--accent);
        }

        /* Page Title */
        .page-header{
            text-align:center;
            padding:3.5rem 2rem 2rem;
            animation: fadeInDown 0.6s ease-out;
        }
        @keyframes fadeInDown{
            from{opacity:0;transform:translateY(-15px);}
            to{opacity:1;transform:translateY(0);}
        }
        .page-title{
            font-size:2.8rem;
            font-weight:800;
            margin-bottom:0.6rem;
            background:linear-gradient(90deg,var(--primary),var(--accent));
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
            letter-spacing:-0.01em;
        }
        .page-subtitle{
            color:var(--text-muted);
            font-size:1.05rem;
            font-weight:400;
        }

        /* Perfume Grid */
        .container{
            max-width:1400px;
            margin:0 auto;
            padding:0 2rem 4rem;
        }
        .perfume-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:2.1rem;
        }
        /* ===== GAPSY CARD STYLE ===== */
        .gapsy-card{position:relative;width:100%;height:480px;background:linear-gradient(145deg,#1a1e2b,#2d2f3b);border-radius:32px;overflow:hidden;box-shadow:0 20px 30px -10px rgba(0,0,0,0.5);transition:transform .4s cubic-bezier(0.2,0.9,0.3,1),box-shadow .4s;border:1px solid rgba(148,163,184,0.2);margin:0 auto;}
        .gapsy-card:hover{transform:scale(1.02) translateY(-6px);box-shadow:0 30px 40px -12px rgba(0,0,0,0.7);border-color:rgba(34,197,94,0.3);}
        .gapsy-card-bg{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;opacity:.7;transition:transform .5s,opacity .3s;}
        .gapsy-card:hover .gapsy-card-bg{transform:scale(1.05);opacity:.5;}
        .gapsy-card-content{position:absolute;bottom:-30px;left:0;right:0;padding:2rem 1.8rem;background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.4) 70%,transparent 100%);color:#fff;transition:transform .4s;}
        .gapsy-card:hover .gapsy-card-content{transform:translateY(-5px);}
        .gapsy-card-category{font-size:.8rem;font-weight:400;text-transform:uppercase;letter-spacing:2px;color:#22c55e;margin-bottom:.5rem;opacity:.9;}
        .gapsy-card-title{font-size:2.2rem;font-weight:700;line-height:1.1;letter-spacing:-.02em;margin-bottom:.4rem;text-transform:uppercase;}
        .gapsy-card-price{font-size:1.2rem;font-weight:500;color:rgba(255,255,255,0.8);margin-bottom:1.2rem;}
        .gapsy-weather-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1rem;background:rgba(34,197,94,0.2);border:1px solid rgba(34,197,94,0.5);border-radius:40px;font-size:.8rem;color:#fff;margin-bottom:1.5rem;backdrop-filter:blur(4px);}
        .gapsy-actions{display:flex;gap:.8rem;opacity:0;transform:translateY(15px);transition:opacity .3s,transform .3s;flex-wrap:wrap;}
        .gapsy-card:hover .gapsy-actions{opacity:1;transform:translateY(0);}
        .gapsy-btn{padding:.7rem 1.4rem;border-radius:40px;font-weight:600;font-size:.85rem;text-transform:uppercase;letter-spacing:.5px;border:none;display:inline-flex;align-items:center;gap:.5rem;transition:all .2s;box-shadow:0 5px 15px rgba(0,0,0,0.3);cursor:pointer;}
        .gapsy-btn-primary{background:#fff;color:#1a1e2b;}
        .gapsy-btn-primary:hover{background:#f0f0f0;box-shadow:0 8px 20px rgba(34,197,94,0.4);}
        .gapsy-btn-secondary{background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);color:#fff;border:1px solid rgba(255,255,255,0.3);}
        .gapsy-btn-secondary:hover{background:rgba(255,255,255,0.25);border-color:var(--primary);}
        .gapsy-favorite{width:40px;height:40px;border-radius:50%;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.3);color:#f97316;display:flex;align-items:center;justify-content:center;transition:all .2s;cursor:pointer;}
        .gapsy-favorite.active{background:rgba(234,179,8,0.2);border-color:#eab308;color:#facc15;}
        .gapsy-favorite:hover{transform:scale(1.1);}
        .gapsy-badge{position:absolute;top:1rem;right:1rem;background:rgba(239,68,68,0.9);color:#fff;font-size:.7rem;font-weight:700;padding:.3rem .75rem;border-radius:999px;letter-spacing:.08em;text-transform:uppercase;z-index:2;}

        /* Empty State */
        .no-perfumes{
            text-align:center;
            padding:4rem 2rem;
            color:var(--text-muted);
        }
        .no-perfumes i{
            font-size:4rem;
            margin-bottom:1rem;
            opacity:0.5;
        }

        /* Loading */
        .loading{
            text-align:center;
            padding:4rem;
            color:var(--text-muted);
        }
        .loading i{
            font-size:2rem;
            animation:spin 1s linear infinite;
        }
        @keyframes spin{
            from{transform:rotate(0deg);}
            to{transform:rotate(360deg);}
        }

        /* Responsive */
        @media (max-width:768px){
            .header{padding:0.8rem 1.5rem;}
            .logo-text{font-size:1.2rem;}
            .page-title{font-size:2rem;}
            .container{padding:0 1rem 2rem;}
            .gapsy-card{height:420px;}
            .gapsy-card-title{font-size:1.8rem;}
        }
        @media (max-width:480px){
            .perfume-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
    @include('navbar')
    @include('cart')

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">All Fragrances</h1>
        <p class="page-subtitle">Explore our complete collection of premium perfumes</p>
    </div>

    <!-- Perfume Grid -->
    <div class="container">
        <div class="perfume-grid" id="perfumeGrid">
            <div class="loading">
                <i class="fas fa-spinner"></i>
                <p>Loading fragrances...</p>
            </div>
        </div>
    </div>

    <script>
        // Cart is managed by the shared cart component (cart.blade.php)
        // addToCart() is available globally via window.addToCart

        let favorites = [];
        try { favorites = JSON.parse(localStorage.getItem('troy-favorites')) || []; } catch(e) {}

        // Quick View - show perfume notes in toast
        function quickView(id) {
            const grid = document.getElementById('perfumeGrid');
            const card = grid.querySelector(`.gapsy-card[data-id="${id}"]`);
            if (card) {
                const name = card.querySelector('.gapsy-card-title').textContent;
                showToast(`${name} – View details coming soon`);
            }
        }

        function toggleFavorite(id, btn) {
            if (favorites.includes(id)) {
                favorites = favorites.filter(f => f !== id);
                btn.classList.remove('active');
            } else {
                favorites.push(id);
                btn.classList.add('active');
            }
            try { localStorage.setItem('troy-favorites', JSON.stringify(favorites)); } catch(e) {}
        }

        function getWeatherText(p) {
            if (p.weather) return p.weather;
            const temp = p.recommended_temperature || '';
            if (temp) return temp;
            return 'All weathers';
        }

        // Fetch and render perfumes
        async function loadPerfumes() {
            const perfumeGrid = document.getElementById('perfumeGrid');
            
            try {
                const response = await fetch('/api/perfumes');
                const data = await response.json();
                
                if (!data.success || !data.perfumes || data.perfumes.length === 0) {
                    perfumeGrid.innerHTML = `
                        <div class="no-perfumes">
                            <i class="fas fa-flask"></i>
                            <p>No perfumes available at the moment.</p>
                        </div>
                    `;
                    return;
                }

                perfumeGrid.innerHTML = data.perfumes.map(p => {
                    const images = p.images || [];
                    const imgSrc = images.length > 0 ? images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800';
                    const badgeText = Number(p.rating) >= 4.5 ? 'Top Rated' : (p.city ? p.city + ' Special' : '');
                    const weatherText = getWeatherText(p);
                    const oldPrice = p.oldPrice || Math.round(p.price * 1.3);
                    const isFavorite = favorites.includes(p.id);
                    const pJson = JSON.stringify(p).replace(/'/g, '&#39;');
                    return `
                    <div class="gapsy-card" data-id="${p.id}">
                        <img class="gapsy-card-bg" src="${imgSrc}" alt="${p.name}" loading="lazy">
                        ${badgeText ? `<div class="gapsy-badge">${badgeText}</div>` : ''}
                        <div class="gapsy-card-content">
                            <div class="gapsy-card-category">${p.category || p.city || 'TROY Collection'}</div>
                            <div class="gapsy-card-title">${p.name}</div>
                            <div class="gapsy-card-price">Rs ${Number(p.price).toLocaleString()} <span style="text-decoration:line-through;opacity:.5;font-size:.85rem;">Rs ${Number(oldPrice).toLocaleString()}</span></div>
                            <div class="gapsy-weather-badge"><i class="fas fa-cloud-sun"></i> Best for ${weatherText}</div>
                            <div class="gapsy-actions">
                                <button class="gapsy-btn gapsy-btn-primary" onclick='addToCart(${pJson}, this)'><i class="fas fa-bag-shopping"></i> Add to Cart</button>
                                <button class="gapsy-btn gapsy-btn-secondary" onclick="quickView(${p.id})">View <i class="fas fa-arrow-right"></i></button>
                                <button class="gapsy-favorite ${isFavorite ? 'active' : ''}" onclick="toggleFavorite(${p.id}, this)"><i class="fas fa-star"></i></button>
                            </div>
                        </div>
                    </div>
                `;
                }).join('');
                
            } catch (error) {
                console.error('Error loading perfumes:', error);
                perfumeGrid.innerHTML = `
                    <div class="no-perfumes">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Error loading perfumes. Please try again later.</p>
                    </div>
                `;
            }
        }

        // Load on page ready
        document.addEventListener('DOMContentLoaded', loadPerfumes);
    </script>
</body>
</html>
