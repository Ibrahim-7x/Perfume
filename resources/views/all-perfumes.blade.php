<!DOCTYPE html>
<html lang="en">
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
        body{
            font-family:'Poppins',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
            background:radial-gradient(circle at top, #172554 0, #020617 55%, #000 100%);
            color:var(--text-main);
            min-height:100vh;
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
            padding:3rem 2rem 2rem;
        }
        .page-title{
            font-size:2.5rem;
            font-weight:700;
            margin-bottom:0.5rem;
            background:linear-gradient(90deg,var(--primary),var(--accent));
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            background-clip:text;
        }
        .page-subtitle{
            color:var(--text-muted);
            font-size:1.1rem;
        }

        /* Perfume Grid */
        .container{
            max-width:1400px;
            margin:0 auto;
            padding:0 2rem 4rem;
        }
        .perfume-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
            gap:2rem;
        }
        .perfume-card{
            background:var(--bg-elevated);
            border-radius:16px;
            border:1px solid rgba(148,163,184,0.33);
            box-shadow:var(--shadow-soft);
            overflow:hidden;
            cursor:pointer;
            transition:transform .32s, box-shadow .32s, border-color .32s;
        }
        .perfume-card:hover{
            transform:translateY(-6px);
            box-shadow:0 22px 60px rgba(15,23,42,0.95);
            border-color:rgba(56,189,248,0.7);
        }
        .perfume-image{
            position:relative;
            height:240px;
            overflow:hidden;
        }
        .perfume-image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .perfume-badge{
            position:absolute;
            top:12px;
            left:12px;
            padding:.3rem .8rem;
            border-radius:999px;
            background:rgba(15,23,42,0.8);
            border:1px solid rgba(56,189,248,0.75);
            font-size:.72rem;
        }
        .perfume-info{
            padding:1.2rem;
        }
        .perfume-title-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:0.5rem;
        }
        .perfume-name{
            font-size:1.1rem;
            font-weight:600;
        }
        .perfume-price{
            font-size:1.1rem;
            font-weight:700;
            color:var(--primary);
        }
        .perfume-desc{
            color:var(--text-muted);
            font-size:0.9rem;
            margin-bottom:1rem;
            line-height:1.5;
        }
        .perfume-actions{
            display:flex;
            gap:0.5rem;
        }
        .btn-buy,.btn-primary{
            flex:1;
            padding:10px;
            border-radius:8px;
            border:none;
            font-weight:600;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            transition:all 0.3s;
            font-size:0.85rem;
        }
        .btn-buy{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:#022c22;
        }
        .btn-buy:hover{
            box-shadow:0 6px 20px rgba(34,197,94,0.4);
        }
        .btn-primary{
            background:rgba(56,189,248,0.2);
            color:var(--accent);
            border:1px solid rgba(56,189,248,0.5);
        }
        .btn-primary:hover{
            background:rgba(56,189,248,0.3);
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
            .header{padding:1rem 1.5rem;}
            .logo-text{font-size:1.2rem;}
            .page-title{font-size:1.8rem;}
            .container{padding:0 1rem 2rem;}
            .perfume-grid{grid-template-columns:repeat(2,1fr);gap:1rem;}
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="/customer" class="logo">
            <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTMwIDBDMTMuNDM4IDAgMCAxMy40MzggMCAzMHMxMy40MzggMzAgMzAgMzBzMzAtMTMuNDM4IDMwLTMwUzQ2LjU2MiAwIDMwIDBaIiBmaWxsPSIjMjJjNTUiLz4KPHBhdGggZD0iTTIyIDIySDI0VjQ4SDIyVjIyWiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTM4IDIySDQwVjQ4SDM4VjIyWiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTQ0IDQ4SDIwVjQ0SDIweiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+" alt="TROY" class="logo-img">
            <span class="logo-text">TROY</span>
        </a>
        <a href="/customer" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
    </header>

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
        // Cart management
        let cart = [];
        
        // Load cart from localStorage
        try {
            const savedCart = localStorage.getItem('troy-cart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
            }
        } catch (e) {
            console.error('Error loading cart:', e);
        }

        // Save cart to localStorage
        function saveCart() {
            try {
                localStorage.setItem('troy-cart', JSON.stringify(cart));
            } catch (e) {
                console.error('Error saving cart:', e);
            }
        }

        // Add to cart
        function addToCart(perfume) {
            const existing = cart.find(item => item.id === perfume.id);
            if (existing) {
                existing.quantity++;
            } else {
                cart.push({...perfume, quantity: 1});
            }
            saveCart();
            alert(`${perfume.name} added to cart!`);
        }

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

                perfumeGrid.innerHTML = data.perfumes.map(p => `
                    <div class="perfume-card">
                        <div class="perfume-image">
                            <img src="${p.images && p.images[0] ? p.images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800'}" 
                                 alt="${p.name}">
                            <div class="perfume-badge">${Number(p.rating) >= 4.5 ? 'Top Rated' : p.city || 'Special'}</div>
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
                `).join('');
                
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
