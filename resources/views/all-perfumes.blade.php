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
            grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
            gap:1.8rem;
        }
        .perfume-card{
            background:var(--bg-elevated);
            border-radius:20px;
            border:1px solid rgba(148,163,184,0.2);
            box-shadow:0 4px 20px rgba(15,23,42,0.5);
            overflow:hidden;
            cursor:pointer;
            transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
            animation:fadeInUp 0.5s ease-out both;
        }
        @keyframes fadeInUp{
            from{opacity:0;transform:translateY(20px);}
            to{opacity:1;transform:translateY(0);}
        }
        .perfume-card:hover{
            transform:translateY(-8px) scale(1.01);
            box-shadow:0 20px 50px rgba(15,23,42,0.85);
            border-color:rgba(56,189,248,0.5);
        }
        .perfume-image{
            position:relative;
            height:250px;
            overflow:hidden;
        }
        .perfume-image-inner{
            width:100%;
            height:100%;
            transform-style:preserve-3d;
            transition:transform .7s cubic-bezier(0.4,0,0.2,1);
        }
        .perfume-image-front,
        .perfume-image-back{
            position:absolute;
            inset:0;
            backface-visibility:hidden;
        }
        .perfume-image-front img{
            width:100%;
            height:100%;
            object-fit:cover;
            transition:transform 0.6s cubic-bezier(0.4,0,0.2,1);
        }
        .perfume-card:hover .perfume-image-inner{
            transform:rotateY(180deg);
        }
        .perfume-card:hover .perfume-image-front img{
            transform:scale(1.06);
        }
        .perfume-image-back{
            transform:rotateY(180deg);
            padding:1.4rem;
            display:flex;
            flex-direction:column;
            justify-content:center;
            gap:.65rem;
            background:radial-gradient(circle at top,#0f172a,#020617);
        }
        .perfume-image-back h4{
            font-size:1rem;
            font-weight:700;
            color:var(--accent);
            margin-bottom:0.1rem;
        }
        .perfume-notes{
            display:flex;
            flex-wrap:wrap;
            gap:.35rem;
        }
        .note-tag{
            padding:.22rem .6rem;
            border-radius:999px;
            background:rgba(15,23,42,0.9);
            border:1px solid rgba(148,163,184,0.4);
            font-size:.72rem;
            color:var(--text-main);
        }
        .perfume-meta{
            font-size:.82rem;
            color:var(--text-muted);
        }
        .perfume-temperature-back{
            font-size:.82rem;
            color:var(--text-muted);
            display:flex;
            align-items:center;
            gap:0.3rem;
        }
        .perfume-temperature-back i{
            color:var(--accent);
        }
        .flip-instruction{
            font-size:.75rem;
            color:var(--text-muted);
            margin-top:.3rem;
        }
        .perfume-image::after{
            content:'';
            position:absolute;
            bottom:0;
            left:0;
            right:0;
            height:60px;
            background:linear-gradient(to top,var(--bg-elevated),transparent);
            pointer-events:none;
            z-index:1;
        }
        .perfume-badge{
            position:absolute;
            top:12px;
            left:12px;
            padding:.35rem .9rem;
            border-radius:999px;
            background:rgba(15,23,42,0.85);
            backdrop-filter:blur(8px);
            border:1px solid rgba(56,189,248,0.6);
            font-size:.72rem;
            font-weight:600;
            letter-spacing:0.03em;
            z-index:1;
        }
        .perfume-info{
            padding:1.2rem 1.4rem;
        }
        .perfume-title-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:0.4rem;
            gap:0.5rem;
        }
        .perfume-name{
            font-size:1.05rem;
            font-weight:600;
            line-height:1.3;
        }
        .perfume-price{
            font-size:1.05rem;
            font-weight:700;
            color:var(--primary);
            white-space:nowrap;
        }
        .perfume-desc{
            color:var(--text-muted);
            font-size:0.85rem;
            margin-bottom:1rem;
            line-height:1.55;
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }
        .perfume-actions{
            display:flex;
            gap:0.5rem;
        }
        .btn-buy,.btn-primary{
            flex:1;
            padding:10px;
            border-radius:10px;
            border:none;
            font-weight:600;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            transition:all 0.3s cubic-bezier(0.4,0,0.2,1);
            font-size:0.85rem;
        }
        .btn-buy{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:#022c22;
        }
        .btn-buy:hover{
            box-shadow:0 6px 20px rgba(34,197,94,0.4);
            transform:translateY(-1px);
        }
        .btn-primary{
            background:rgba(56,189,248,0.15);
            color:var(--accent);
            border:1px solid rgba(56,189,248,0.4);
        }
        .btn-primary:hover{
            background:rgba(56,189,248,0.25);
            transform:translateY(-1px);
        }

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
            .perfume-grid{grid-template-columns:repeat(2,1fr);gap:0.8rem;}
            .perfume-image{height:180px;}
            .perfume-info{padding:0.9rem 1rem;}
            .perfume-name{font-size:0.9rem;}
            .perfume-price{font-size:0.9rem;}
            .perfume-desc{font-size:0.78rem;}
            .btn-buy,.btn-primary{padding:8px;font-size:0.78rem;}
        }
        @media (max-width:480px){
            .perfume-grid{grid-template-columns:1fr;max-width:400px;margin:0 auto;}
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

        // Buy on WhatsApp
        function buyNow(perfume) {
            const message = `Hi TROY Perfumes! I'm interested in buying ${perfume.name} - Rs ${perfume.price.toLocaleString()}`;
            const whatsappUrl = `https://wa.me/923001234567?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
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
                    const notes = p.notes || [];
                    const temp = p.recommended_temperature || '';
                    return `
                    <div class="perfume-card">
                        <div class="perfume-image">
                            <div class="perfume-image-inner">
                                <div class="perfume-image-front">
                                    <img src="${imgSrc}" alt="${p.name}">
                                    <div class="perfume-badge">${Number(p.rating) >= 4.5 ? 'Top Rated' : p.city || 'Special'}</div>
                                </div>
                                <div class="perfume-image-back">
                                    <h4>Fragrance Details</h4>
                                    <div class="perfume-notes">
                                        ${notes.length > 0 ? notes.map(n => `<span class="note-tag">${n}</span>`).join('') : '<span class="note-tag">Premium Blend</span>'}
                                    </div>
                                    <div class="perfume-meta">
                                        ${p.city ? `City: ${p.city}` : ''}${p.rating ? ` · Rating: ${p.rating}` : ''}
                                    </div>
                                    ${temp ? `<div class="perfume-temperature-back"><i class="fas fa-thermometer-half"></i> ${temp}</div>` : ''}
                                    <p class="flip-instruction">Hover to flip back</p>
                                </div>
                            </div>
                        </div>
                        <div class="perfume-info">
                            <div class="perfume-title-row">
                                <h3 class="perfume-name">${p.name}</h3>
                                <div class="perfume-price">Rs ${p.price.toLocaleString()}</div>
                            </div>
                            <p class="perfume-desc">${p.description || 'Premium fragrance from TROY Perfumes'}</p>
                            <div class="perfume-actions">
                                <button class="btn-buy" onclick='buyNow(${JSON.stringify(p)})'>
                                    <i class="fab fa-whatsapp"></i> Buy
                                </button>
                                <button class="btn-primary" onclick='addToCart(${JSON.stringify(p)})'>
                                    <i class="fas fa-shopping-bag"></i> Add
                                </button>
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
