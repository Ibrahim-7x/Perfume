<!DOCTYPE html>
<html lang="en">
<script>document.documentElement.setAttribute('data-theme', localStorage.getItem('troy-theme') || 'light');</script>
<head>
<meta charset="utf-8"/>
<title>TROY Perfumes – Customer View</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
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

    /* BRANDS MARQUEE SECTION */
    .brands-section {
        padding: 30px 0;
        background: linear-gradient(180deg, var(--bg) 0%, var(--bg-soft) 50%, var(--bg) 100%);
        overflow: hidden;
        position: relative;
    }

    .brands-section::before,
    .brands-section::after {
        content: '';
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .brands-section::before {
        left: 0;
        background: linear-gradient(90deg, var(--bg) 0%, transparent 100%);
    }

    .brands-section::after {
        right: 0;
        background: linear-gradient(270deg, var(--bg) 0%, transparent 100%);
    }

    .brands-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .brands-title h2 {
        font-size: 2rem;
        color: var(--text-main);
        margin-bottom: 10px;
    }

    .brands-title p {
        color: var(--text-muted);
        font-size: 1rem;
    }

    .brands-marquee {
        display: flex;
        width: fit-content;
        animation: scroll 30s linear infinite;
    }

    .brands-marquee:hover {
        animation-play-state: paused;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .brand-card {
        flex-shrink: 0;
        width: 180px;
        height: 100px;
        margin: 0 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-elevated);
        border-radius: 16px;
        border: 1px solid rgba(148,163,184,0.2);
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        cursor: pointer;
    }

    .brand-card:hover {
        transform: scale(1.06) translateY(-3px);
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(34, 197, 94, 0.15);
    }

    .brand-card img {
        max-width: 120px;
        max-height: 60px;
        object-fit: contain;
        filter: grayscale(0.2);
        transition: filter 0.3s ease;
    }

    .brand-card:hover img {
        filter: grayscale(0);
    }

    .brand-card .brand-name {
        color: var(--text-main);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Duplicate brands for seamless loop */
    .brands-marquee-inner {
        display: flex;
    }

    /* POWERED BY JAZZ WATERMARK */
    .powered-by-jazz {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        opacity: 0.5;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .powered-by-jazz:hover {
        opacity: 0.8;
    }

    .powered-by-jazz-text {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .powered-by-jazz-logo {
        width: 24px;
        height: 24px;
        background: linear-gradient(135deg, #106ebe 0%, #ff6b00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 0.6rem;
    }

    /* Adjust footer padding to account for watermark */
    .footer {
        padding-bottom: 80px;
    }

    *{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth}
    body{
        font-family:'Poppins',system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
        background:radial-gradient(circle at top, #172554 0, #020617 55%, #000 100%);
        color:var(--text-main);
        min-height:100vh;
        overflow-x:hidden;
        -webkit-font-smoothing:antialiased;
        -moz-osx-font-smoothing:grayscale;
    }

    /* LOCATION PERMISSION MODAL */
    .location-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(5, 8, 22, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
    }

    .location-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .location-content {
        background: radial-gradient(circle at top left, var(--bg-elevated), var(--bg));
        border-radius: var(--card-radius);
        padding: 2.5rem;
        max-width: 500px;
        width: 90%;
        text-align: center;
        border: 2px solid rgba(56, 189, 248, 0.5);
        box-shadow: 0 0 40px rgba(56, 189, 248, 0.3);
        position: relative;
        animation: modalAppear 0.5s ease-out;
    }

    .location-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .location-text {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .location-icon {
        font-size: 4rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .location-details {
        background: rgba(15, 23, 42, 0.6);
        border-radius: 15px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        border: 1px solid rgba(56, 189, 248, 0.2);
        text-align: left;
    }

    .location-detail {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .location-detail i {
        color: var(--primary);
        width: 20px;
    }

    .location-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .location-btn {
        padding: 12px 24px;
        border-radius: 999px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .location-btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-strong));
        color: #022c22;
    }

    .location-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
    }

    .location-btn-secondary {
        background: rgba(15, 23, 42, 0.8);
        color: var(--text-main);
        border: 1px solid rgba(148, 163, 184, 0.4);
    }

    .location-btn-secondary:hover {
        background: rgba(30, 41, 59, 0.8);
        border-color: var(--accent);
    }

    /* Location display in WhatsApp share */
    .location-share-section {
        background: rgba(15, 23, 42, 0.6);
        border-radius: 15px;
        padding: 1rem;
        margin: 1rem 0;
        border: 1px solid rgba(56, 189, 248, 0.2);
    }

    .location-share-title {
        color: var(--accent);
        font-size: 1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .location-share-details {
        font-size: 0.9rem;
        color: var(--text-main);
        line-height: 1.5;
    }

    /* NABI PAK SAW STAMP */
    .nabipak-stamp {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 70px;
        height: 70px;
        z-index: 100;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.7);
        animation: stampSpin 6s linear infinite;
        cursor: pointer;
        transition: transform 0.3s;
        border: 2px solid gold;
    }
    
    .nabipak-stamp:hover {
        transform: scale(1.1);
        animation-duration: 3s;
        box-shadow: 0 0 25px rgba(255, 215, 0, 0.9);
    }
    
    @keyframes stampSpin {
        0% { transform: rotateY(0deg); }
        100% { transform: rotateY(360deg); }
    }
    
    /* CONTRIBUTION POPUP MODAL */
    .contribution-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        backdrop-filter: blur(10px);
    }
    
    .contribution-modal.active {
        opacity: 1;
        visibility: visible;
    }
    
    .contribution-content {
        background: radial-gradient(circle at top, #0f172a, #020617);
        border-radius: 28px;
        padding: 2.5rem;
        max-width: 500px;
        width: 90%;
        text-align: center;
        border: 2px solid rgba(255, 215, 0, 0.5);
        box-shadow: 0 0 40px rgba(255, 215, 0, 0.3);
        position: relative;
        animation: modalAppear 0.5s ease-out;
    }
    
    @keyframes modalAppear {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .contribution-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: #eab308;
    }
    
    .contribution-text {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .contribution-stamp {
        width: 150px;
        height: 150px;
        margin: 1.5rem auto;
        border-radius: 50%;
        box-shadow: 0 0 25px rgba(255, 215, 0, 0.7);
        cursor: pointer;
        transition: all 0.3s;
        animation: stampPulse 2s infinite alternate;
        border: 3px solid gold;
    }
    
    .contribution-stamp:hover {
        transform: scale(1.1);
        box-shadow: 0 0 35px rgba(255, 215, 0, 0.9);
    }
    
    @keyframes stampPulse {
        0% { transform: scale(1); }
        100% { transform: scale(1.05); }
    }
    
    .contribution-note {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-top: 1rem;
        font-style: italic;
    }

    /* Intro overlay */
    .intro-overlay {
        position: fixed;
        inset: 0;
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99999;
        overflow: hidden;
        pointer-events: none;
    }
    .intro-overlay-inner{
        text-align:center;
        animation:fadeInScale 1.2s ease-out forwards;
    }
    .intro-overlay-logo{
    width: 300px;
    max-width: 80vw;
    height: auto;
    }
    .intro-overlay-text{
    font-size: 2rem;
    font-weight: 400;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    }
    @keyframes fadeInScale{
        from{opacity:0;transform:scale(.8);}
        to{opacity:1;transform:scale(1);}
    }
    @keyframes fadeOutOverlay{
        from{opacity:1;}
        to{opacity:0;visibility:hidden;}
    }
    .intro-overlay.hide{
        animation:fadeOutOverlay 0.8s forwards;
    }
    img{max-width:100%;display:block}
    button{font-family:inherit}

    /* Waving transparent curtain */
    .intro-overlay::before {
        content: "";
        position: absolute;
        top: 0;
        left: -15%;
        width: 130%;
        height: 100%;
        background: rgba(255,255,255,0.15);
        filter: blur(25px);
        animation: curtainWave 4s ease-in-out infinite;
        transform-origin: center;
    }

    @keyframes curtainWave {
        0%   { transform: skewX(0deg) translateX(0px); }
        50%  { transform: skewX(6deg) translateX(25px); }
        100% { transform: skewX(0deg) translateX(0px); }
    }

    /* COIN FLIP ANIMATION */
    .intro-overlay-logo {
        width: 850px;
        height: auto;
        z-index: 3;
        animation: coinFlip 4s ease-in-out infinite;
    }

    @keyframes coinFlip {
        0%   { transform: rotateY(0deg); }
        50%  { transform: rotateY(180deg); }
        100% { transform: rotateY(360deg); }
    }

    /* BLUE PARTICLES */
    .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: rgba(80,150,255,0.9);
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(80,150,255,0.9);
        animation: floatUp 5s linear infinite;
    }

    @keyframes floatUp {
        0% { transform: translateY(20vh) scale(1); opacity: 1; }
        100% { transform: translateY(-100vh) scale(0.2); opacity: 0; }
    }

    img{max-width:100%;display:block}
    button{font-family:inherit}

    /* Floating background particles */
    .particles{
        position:fixed;
        inset:0;
        overflow:hidden;
        pointer-events:none;
        z-index:-1;
    }
    .particle-bg{
        position:absolute;
        border-radius:999px;
        background:radial-gradient(circle,rgba(56,189,248,0.9),transparent 70%);
        opacity:0;
        animation:floatParticle 18s linear infinite;
    }

    /* Header */
    .header{
        position:sticky;
        top:0;
        z-index:20;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:1rem 4.5rem;
        background:linear-gradient(to bottom,rgba(2,6,23,0.96),rgba(2,6,23,0.85),transparent);
        backdrop-filter:blur(18px);
        border-bottom:1px solid rgba(148,163,184,0.15);
        transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .header-scrolled{
        background:rgba(2,6,23,0.98);
        box-shadow:0 18px 45px rgba(15,23,42,0.9);
        padding-top:0.6rem;
        padding-bottom:0.6rem;
    }
    .logo{
        display:flex;
        align-items:center;
        gap:.75rem;
        text-decoration:none;
        color:var(--text-main);
    }
    .logo-img{
        width:70px;
        height:70px;
        border-radius:16px;
        transition:all 0.4s ease;
    }
    .header-scrolled .logo-img{
        width:50px;
        height:50px;
    }
    .logo-text{
        font-weight:900;
        letter-spacing:.15em;
        font-size:2.05rem;
    }
    .nav-links{
        display:flex;
        gap:1.8rem;
        align-items:center;
    }
    .nav-link{
        color:var(--text-muted);
        text-decoration:none;
        font-size:.95rem;
        font-weight:500;
        position:relative;
        padding-bottom:.25rem;
        transition:color 0.3s ease;
    }
    .nav-link::after{
        content:'';
        position:absolute;
        left:0;
        bottom:0;
        width:0;
        height:2px;
        background:linear-gradient(90deg,#22c55e,#38bdf8);
        border-radius:999px;
        transition:.3s;
    }
    .nav-link:hover{
        color:var(--text-main);
    }
    .nav-link:hover::after{
        width:100%;
    }
    .header-actions{
        display:flex;
        align-items:center;
        gap:.9rem;
    }
    .pill-badge{
        padding:.35rem .8rem;
        border-radius:999px;
        background:rgba(34,197,94,0.1);
        border:1px solid rgba(34,197,94,0.7);
        font-size:.7rem;
        text-transform:uppercase;
        letter-spacing:.12em;
        color:var(--primary);
    }

    /* Cart button */
    .cart-toggle{
        position:relative;
        width:52px;
        height:52px;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.3);
        background:rgba(15,23,42,0.95);
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        box-shadow:0 8px 25px rgba(15,23,42,0.6);
        color:var(--text-main);
        transition:all 0.3s ease;
    }
    .cart-toggle:hover{
        border-color:var(--primary);
        background:rgba(34,197,94,0.1);
        transform:translateY(-2px);
    }
    .cart-count{
        position:absolute;
        top:-4px;
        right:-4px;
        min-width:22px;
        height:22px;
        border-radius:999px;
        background:var(--danger);
        color:#fff;
        font-size:.65rem;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:0 4px;
        box-shadow:0 0 0 2px #020617;
    }

    /* Hero */
    .hero{
        padding:3.5rem 4.5rem 2.5rem;
        display:grid;
        grid-template-columns:minmax(0,1.6fr) minmax(0,1.1fr);
        gap:3rem;
        align-items:center;
    }
    .hero-title{
        font-size:4.2rem;
        line-height:1.05;
        letter-spacing:-0.01em;
        font-weight:800;
        margin-bottom:1rem;
    }
    .hero-gradient{
        background:linear-gradient(120deg,#e5e7eb,#a5f3fc,#bbf7d0);
        -webkit-background-clip:text;
        color:transparent;
    }
    .hero-subtitle{
        color:var(--text-muted);
        max-width:520px;
        margin-bottom:1.6rem;
        font-size:1.05rem;
        line-height:1.7;
    }
    .hero-tags{
        display:flex;
        flex-wrap:wrap;
        gap:.75rem;
        margin-bottom:2rem;
    }
    .tag-chip{
        padding:.35rem .9rem;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.35);
        font-size:.75rem;
        color:var(--text-muted);
        backdrop-filter:blur(10px);
        background:rgba(15,23,42,0.6);
    }
    .hero-cta{
        display:flex;
        align-items:center;
        gap:1rem;
        margin-bottom:1.5rem;
    }
    .btn-primary{
        padding:.75rem 1.6rem;
        border-radius:999px;
        border:none;
        background:linear-gradient(135deg,#22c55e,#16a34a);
        color:#022c22;
        font-weight:600;
        cursor:pointer;
        box-shadow:0 12px 30px rgba(22,163,74,0.4);
        display:inline-flex;
        align-items:center;
        gap:.5rem;
        font-size:.92rem;
        transition:all 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    .btn-primary:hover{
        transform:translateY(-3px);
        box-shadow:0 16px 40px rgba(22,163,74,0.55);
    }
    .btn-ghost{
        padding:.85rem 1.4rem;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.4);
        background:rgba(15,23,42,0.7);
        color:var(--text-main);
        cursor:pointer;
        font-size:.85rem;
        display:inline-flex;
        align-items:center;
        gap:.45rem;
    }
    .hero-metrics{
        display:flex;
        gap:1.5rem;
        flex-wrap:wrap;
        font-size:.85rem;
        color:var(--text-muted);
    }
    .metric-pill{
        padding:.65rem 1rem;
        border-radius:999px;
        background:rgba(15,23,42,0.85);
        border:1px solid rgba(148,163,184,0.35);
        display:flex;
        align-items:center;
        gap:.35rem;
    }
    .hero-video-container {
        position: relative;
        height: 260px;
        border-radius: 24px;
        overflow: hidden;
        margin-bottom: 1.4rem;
    }

    .hero-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.04);
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,0.2) 0%,
            rgba(0,0,0,0.4) 100%
        );
    }

    .hero-perfume-tag {
        position: absolute;
        top: 14px;
        left: 14px;
        padding: .3rem .9rem;
        border-radius: 999px;
        background: rgba(15,23,42,0.78);
        border: 1px solid rgba(56,189,248,0.7);
        color: #e0f2fe;
        font-size: .72rem;
        z-index: 2;
    }

    .hero-perfume-glow {
        position: absolute;
        inset: auto -80px -120px;
        background: radial-gradient(circle, rgba(34,197,94,0.5), transparent 60%);
        opacity: .8;
        mix-blend-mode: screen;
        z-index: 1;
    }
    .hero-visual{
        position:relative;
    }
    .hero-card{
        background:radial-gradient(circle at top left,#1e293b,#020617);
        border-radius:32px;
        padding:1.8rem;
        box-shadow:var(--shadow-main);
        border:1px solid rgba(148,163,184,0.35);
        position:relative;
        overflow:hidden;
    }
    /* TV screen styling */
    .tv-screen {
        border: 6px solid #2a2a2a;
        border-radius: 20px;
        background: #0a0a0a;
        box-shadow: 
            inset 0 0 20px rgba(0,0,0,0.8),
            0 0 0 2px #4a4a4a,
            0 10px 30px rgba(0,0,0,0.7);
        overflow: hidden;
        position: relative;
    }
    .tv-screen iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 14px; /* inner screen curve */
    }
    /* optional antenna effect (pure css) */
    .tv-screen::before {
        content: "";
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 12px;
        background: #3a3a3a;
        border-radius: 4px 4px 0 0;
        z-index: 5;
    }
    .tv-screen::after {
        content: "";
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        width: 10px;
        height: 18px;
        background: #555;
        border-radius: 2px;
        z-index: 4;
    }
    .hero-perfume-img{
        height:260px;
        border-radius:24px;
        overflow:hidden;
        position:relative;
        margin-bottom:1.4rem;
    }
    .hero-perfume-img img{
        width:100%;
        height:100%;
        object-fit:cover;
        transform:scale(1.04);
    }
    .hero-perfume-tag{
        position:absolute;
        top:14px;
        left:14px;
        padding:.3rem .9rem;
        border-radius:999px;
        background:rgba(15,23,42,0.78);
        border:1px solid rgba(56,189,248,0.7);
        color:#e0f2fe;
        font-size:.72rem;
    }
    .hero-perfume-glow{
        position:absolute;
        inset:auto -80px -120px;
        background:radial-gradient(circle,rgba(34,197,94,0.5),transparent 60%);
        opacity:.8;
        mix-blend-mode:screen;
    }

    /* Section base */
    .section{
        padding:4rem 4.5rem;
        position:relative;
    }
    .section-title{
        font-size:2.3rem;
        margin-bottom:.5rem;
    }
    .section-subtitle{
        color:var(--text-muted);
        margin-bottom:2.1rem;
        max-width:620px;
    }

    /* PROMOTIONS layout removed */
    .promotions{
        background:var(--bg);
    }
    .promotions-layout{
        display:block;
    }

    /* Brand Video - TEXT REMOVED */
    .brand-video{
        background:var(--bg-soft);
        position:relative;
    }
    .video-container{
        max-width:1100px;
        margin:0 auto;
        border-radius:var(--card-radius);
        overflow:hidden;
        box-shadow:var(--shadow-main);
        position:relative;
    }
    .video-container video{
        width:100%;
        display:block;
    }
    .video-overlay{
        position:absolute;
        inset:0;
        background:rgba(0,0,0,0.3);
        display:flex;
        align-items:center;
        justify-content:center;
        opacity:0;
        transition:opacity .4s;
    }
    .video-overlay:hover{opacity:1}
    .play-btn{
        width:90px;
        height:90px;
        border-radius:999px;
        background:rgba(255,255,255,0.95);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:2.2rem;
        cursor:pointer;
        box-shadow:0 10px 30px rgba(0,0,0,0.5);
        transition:.3s;
        color:#020617;
    }
    .play-btn.small{
        width:60px;
        height:60px;
        font-size:1.6rem;
    }
    .video-controls{
        position:absolute;
        bottom:20px;
        left:22px;
        display:flex;
        gap:.6rem;
    }
    .video-control-btn{
        width:42px;
        height:42px;
        border-radius:999px;
        border:none;
        background:rgba(0,0,0,0.75);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        font-size:1.05rem;
    }
    .logo-watermark{
        position:absolute;
        bottom:20px;
        right:20px;
        width:48px;
        height:48px;
        opacity:.8;
    }

    /* CUSTOMER EXPERIENCE SECTION (REPLACING BRAND VIDEOS) */
    .customer-experience {
        background:var(--bg);
        text-align: center;
    }
    
    /* THIS WEEK'S CUSTOMER VIDEO SECTION - WITH NEON BACKGROUND */
    .this-week-video {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, 
            rgba(0, 10, 20, 0.95) 0%, 
            rgba(0, 30, 60, 0.9) 50%, 
            rgba(0, 10, 20, 0.95) 100%);
        border-radius: var(--card-radius);
        padding: 3rem 2.5rem;
        margin-bottom: 3rem;
        border: 1px solid rgba(56, 189, 248, 0.3);
        box-shadow: var(--shadow-main);
    }
    
    /* Neon Sparkling Background Effect */
    .neon-sparkles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
        pointer-events: none;
        border-radius: var(--card-radius);
    }
    
    .sparkle {
        position: absolute;
        background: #00f3ff;
        border-radius: 50%;
        box-shadow: 0 0 10px #00f3ff, 0 0 20px #00f3ff;
        animation: sparkle 3s infinite linear;
        opacity: 0.7;
    }
    
    @keyframes sparkle {
        0%, 100% {
            transform: scale(1);
            opacity: 0.7;
        }
        50% {
            transform: scale(1.5);
            opacity: 1;
        }
    }
    
    .neon-glow {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 30%, rgba(0, 243, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(157, 0, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(0, 243, 255, 0.05) 0%, transparent 50%);
        z-index: 1;
        pointer-events: none;
        border-radius: var(--card-radius);
    }
    
    .this-week-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    
    .current-video-container {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    
    .current-video-wrapper {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 
            0 0 20px rgba(0, 243, 255, 0.3),
            0 0 40px rgba(157, 0, 255, 0.2),
            0 20px 50px rgba(0, 0, 0, 0.7);
        border: 2px solid #00f3ff;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        width: 100%;
        max-width: 800px;
    }
    
    .current-video-wrapper:hover {
        box-shadow: 
            0 0 30px rgba(0, 243, 255, 0.5),
            0 0 60px rgba(157, 0, 255, 0.3),
            0 25px 60px rgba(0, 0, 0, 0.8);
        transform: translateY(-5px);
    }
    
    .current-video {
        width: 100%;
        height: 500px;
        object-fit: cover;
        display: block;
    }
    
    .current-video-info {
        background: rgba(0, 20, 40, 0.8);
        padding: 30px;
        border-radius: 15px;
        border: 1px solid rgba(0, 243, 255, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .current-video-title {
        font-size: 1.8rem;
        color: #00f3ff;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        text-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        flex-wrap: wrap;
        text-align: center;
    }
    
    .current-video-title .badge {
        background: linear-gradient(135deg, #00f3ff, #9d00ff);
        color: #050816;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
    }
    
    .current-video-description {
        color: var(--text-main);
        line-height: 1.7;
        margin-bottom: 20px;
        text-align: center;
    }
    
    /* Enhanced Social Stats */
    .video-stats {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid rgba(0, 243, 255, 0.2);
        flex-wrap: wrap;
    }
    
    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        max-width: 200px;
        padding: 15px;
        background: rgba(0, 30, 60, 0.5);
        border-radius: 10px;
        border: 1px solid rgba(0, 243, 255, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .stat-item:hover {
        background: rgba(0, 40, 80, 0.7);
        border-color: #00f3ff;
        transform: translateY(-3px);
    }
    
    .stat-value {
        font-size: 1.8rem;
        color: #00f3ff;
        font-weight: 700;
        text-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: var(--text-main);
        margin-top: 5px;
        opacity: 0.9;
    }
    
    .stat-icon {
        font-size: 1.2rem;
    }
    
    .share-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }
    
    .share-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .share-btn {
        background: rgba(0, 30, 60, 0.7);
        color: var(--text-main);
        border: 1px solid rgba(0, 243, 255, 0.3);
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    
    .share-btn:hover {
        background: rgba(0, 40, 80, 0.9);
        border-color: #00f3ff;
        transform: translateY(-2px);
    }
    
    .share-btn.facebook:hover {
        background: #1877F2;
        color: white;
    }
    
    .share-btn.twitter:hover {
        background: #1DA1F2;
        color: white;
    }
    
    .share-btn.whatsapp:hover {
        background: #25D366;
        color: white;
    }
    
    .share-btn.link:hover {
        background: #00f3ff;
        color: #050816;
    }
    
    /* Video controls */
    .video-controls-experience {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: all 0.3s ease;
        gap: 20px;
    }
    
    .current-video-wrapper:hover .video-controls-experience {
        opacity: 1;
    }
    
    .video-btn-experience {
        background: rgba(0, 243, 255, 0.8);
        color: #050816;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .video-btn-experience:hover {
        background: #00f3ff;
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(0, 243, 255, 0.8);
    }
    
    .video-info-experience {
        color: var(--text-main);
        font-size: 0.9rem;
    }

    /* Volume control */
    .video-volume-control {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 10px;
    }

    .video-volume-control i {
        color: #00f3ff;
        font-size: 1rem;
    }

    #volumeSlider {
        width: 80px;
        height: 6px;
        border-radius: 3px;
        background: rgba(255, 255, 255, 0.2);
        outline: none;
        -webkit-appearance: none;
    }

    #volumeSlider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #00f3ff;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0, 243, 255, 0.8);
    }

    /* ========== CUSTOMER REVIEWS SECTION ========== */
    .reviews-section {
        margin-top: 3rem;
        padding: 2rem 0;
    }

    .reviews-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .reviews-header h3 {
        font-size: 2rem;
        color: #00f3ff;
        margin-bottom: 8px;
        text-shadow: 0 0 10px rgba(0,243,255,0.4);
    }

    .reviews-header p {
        color: var(--text-muted);
        font-size: 1rem;
    }

    .reviews-slider-wrapper {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        overflow: hidden;
    }

    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease;
    }

    .reviews-grid.sliding-out {
        opacity: 0;
        transform: translateX(-60px);
    }

    .reviews-grid.sliding-in {
        opacity: 0;
        transform: translateX(60px);
    }

    .reviews-nav-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 2rem auto 0;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        border: 2px solid rgba(0, 243, 255, 0.4);
        background: rgba(0, 20, 40, 0.7);
        color: #00f3ff;
        font-size: 1.3rem;
        cursor: pointer;
        transition: all 0.35s ease;
        backdrop-filter: blur(8px);
    }

    .reviews-nav-arrow:hover {
        background: rgba(0, 243, 255, 0.15);
        border-color: #00f3ff;
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.35);
        transform: scale(1.1);
    }

    .reviews-nav-arrow:active {
        transform: scale(0.95);
    }

    .reviews-page-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 1rem;
    }

    .reviews-page-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(0, 243, 255, 0.2);
        border: 1px solid rgba(0, 243, 255, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .reviews-page-dot.active {
        background: #00f3ff;
        box-shadow: 0 0 8px rgba(0, 243, 255, 0.6);
        transform: scale(1.3);
    }

    .review-card {
        background: linear-gradient(145deg, rgba(0, 20, 40, 0.9), rgba(5, 11, 30, 0.95));
        border-radius: 18px;
        padding: 1.8rem;
        border: 1px solid rgba(0, 243, 255, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-align: left;
    }

    .review-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #00f3ff, transparent);
        opacity: 0;
        transition: opacity 0.4s;
    }

    .review-card:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 243, 255, 0.4);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5), 0 0 20px rgba(0, 243, 255, 0.1);
    }

    .review-card:hover::before {
        opacity: 1;
    }

    .review-card.featured {
        border-color: rgba(0, 243, 255, 0.35);
        box-shadow: 0 0 15px rgba(0, 243, 255, 0.08);
    }

    .review-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 1rem;
    }

    .review-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #00f3ff, #9d00ff);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        color: #050816;
        flex-shrink: 0;
        box-shadow: 0 0 12px rgba(0, 243, 255, 0.3);
    }

    .review-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .review-customer-info {
        flex: 1;
        min-width: 0;
    }

    .review-customer-name {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--text-main);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .review-customer-title {
        font-size: 0.82rem;
        color: var(--text-muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .review-featured-badge {
        background: linear-gradient(135deg, #00f3ff, #9d00ff);
        color: #050816;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
    }

    .review-stars {
        display: flex;
        gap: 3px;
        margin-bottom: 0.8rem;
    }

    .review-stars i {
        color: #eab308;
        font-size: 0.9rem;
    }

    .review-stars i.empty {
        color: rgba(234, 179, 8, 0.25);
    }

    .review-text {
        color: var(--text-main);
        font-size: 0.92rem;
        line-height: 1.65;
        margin-bottom: 1rem;
        opacity: 0.92;
    }

    .review-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.8rem;
        border-top: 1px solid rgba(148, 163, 184, 0.12);
    }

    .review-perfume {
        font-size: 0.8rem;
        color: #00f3ff;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .review-perfume i {
        font-size: 0.75rem;
    }

    .review-date {
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    .reviews-loading {
        text-align: center;
        padding: 3rem 0;
        color: var(--text-muted);
    }

    .reviews-loading i {
        font-size: 2rem;
        color: #00f3ff;
        margin-bottom: 1rem;
        display: block;
        animation: spin 1.5s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .reviews-empty {
        text-align: center;
        padding: 3rem 0;
        color: var(--text-muted);
    }

    .reviews-empty i {
        font-size: 3rem;
        color: rgba(0, 243, 255, 0.3);
        margin-bottom: 1rem;
        display: block;
    }

    @media (max-width: 1024px) {
        .reviews-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .reviews-grid {
            grid-template-columns: 1fr;
        }

        .reviews-header h3 {
            font-size: 1.5rem;
        }
    }

    /* ========== REDESIGNED WEATHER SECTION ========== */
    .weather-section{
        background:transparent;
        position:relative;
    }
    .weather-container{
        max-width:100%;                /* full width inside section */
        margin:0;
        display:flex;
        gap:3rem;
        background:var(--bg-elevated);
        border-radius:var(--card-radius);
        padding:2.5rem 3rem;
        border:1px solid rgba(148,163,184,0.32);
        box-shadow:var(--shadow-soft);
        position:relative;
        overflow:hidden;
        backdrop-filter:blur(12px);
    }
    .weather-container:before{
        content:'';
        position:absolute;
        inset:-60%;
        background:radial-gradient(circle,rgba(56,189,248,0.12),transparent 70%);
        animation:rotate 24s linear infinite;
        pointer-events:none;
    }
    .weather-visual{
        flex:1;
        display:flex;
        flex-direction:column;
        align-items:center;
        z-index:1;
        justify-content:center;
    }
    .thermometer{
        width:35px;
        height:180px;
        border-radius:18px;
        background:linear-gradient(to top,#22c55e,#eab308,#f97316,#ef4444);
        position:relative;
        overflow:hidden;
        margin-bottom:1.4rem;
    }
    .thermometer-fill{
        position:absolute;
        inset:auto 0 0;
        background:rgba(15,23,42,0.92);
        transition:height 1.1s;
    }
    .thermometer-bulb{
        width:58px;
        height:58px;
        border-radius:999px;
        background:radial-gradient(circle,#ef4444,#b91c1c);
        margin-top:-12px;
        box-shadow:0 0 22px rgba(248,113,113,0.75);
    }
    .temp-display{
        margin-top:1.1rem;
        font-size:2.4rem;
        font-weight:600;
        line-height:1;
    }
    .temp-label{
        font-size:1.2rem;
        color:var(--text-main);
        margin-bottom:0.5rem;
    }
    .weather-icon-container{
        font-size:3rem;
        margin-top:0.5rem;
    }
    .weather-condition{
        font-size:1rem;
        color:var(--text-muted);
    }

    .weather-info{
        flex:1.5;
        z-index:1;
    }
    .weather-title{
        font-size:1.8rem;
        margin-bottom:1rem;
    }
    .weather-desc{
        color:var(--text-muted);
        margin-bottom:1.8rem;
        font-size:1rem;
        line-height:1.5;
    }
    .weather-details{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        gap:1rem;
        margin-bottom:2rem;
        background:rgba(15,23,42,0.6);
        border-radius:20px;
        padding:1.2rem 1.5rem;
        border:1px solid rgba(56,189,248,0.2);
    }
    .weather-detail{
        display:flex;
        align-items:center;
        gap:0.8rem;
        font-size:0.95rem;
    }
    .weather-detail i{
        color:var(--primary);
        width:20px;
    }
    .city-selector{
        display:flex;
        flex-wrap:wrap;
        gap:0.6rem;
        margin-bottom:1.5rem;
    }
    .city-btn{
        padding:0.5rem 1.2rem;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.4);
        background:rgba(15,23,42,0.8);
        color:var(--text-muted);
        font-size:0.85rem;
        cursor:pointer;
        transition:0.2s;
    }
    .city-btn.active{
        background:linear-gradient(135deg,#22c55e,#38bdf8);
        color:#022c22;
        border-color:transparent;
    }

    /* City search bar */
    .city-search-container {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom:1.8rem;
    }
    .city-search-input {
        flex: 1;
        padding: 0.8rem 1.2rem;
        border-radius: 999px;
        border: 1px solid rgba(148,163,184,0.5);
        background: rgba(15,23,42,0.8);
        color: var(--text-main);
        font-size: 0.95rem;
        outline: none;
    }
    .city-search-input::placeholder {
        color: var(--text-muted);
    }
    .city-search-btn {
        padding: 0.8rem 1.8rem;
        border-radius: 999px;
        border: none;
        background: linear-gradient(135deg, var(--primary), var(--primary-strong));
        color: #022c22;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: 0.3s;
    }
    .city-search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34,197,94,0.4);
    }

    /* Weather Perfume Recommendation Card */
    .weather-perfume-card {
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(56,189,248,0.15));
        border-radius: 20px;
        border: 1px solid rgba(56,189,248,0.4);
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
    }
    .weather-perfume-card:hover {
        border-color: var(--primary);
        background: rgba(34,197,94,0.2);
    }
    .weather-perfume-img {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        object-fit: cover;
        border: 2px solid rgba(56,189,248,0.5);
    }
    .weather-perfume-info {
        flex: 1;
    }
    .weather-perfume-name {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.3rem;
    }
    .weather-perfume-price {
        color: var(--primary);
        font-size: 1.1rem;
        font-weight:500;
        margin-bottom:0.2rem;
    }
    .weather-perfume-badge {
        font-size: 0.85rem;
        color: var(--accent);
        background: rgba(56,189,248,0.15);
        padding: 0.3rem 1rem;
        border-radius: 20px;
        display: inline-block;
    }

    /* Featured Perfumes Grid – straight corners */
    .featured{
        background:var(--bg-soft);
    }
    .perfume-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
        gap:2.1rem;
    }
    
    /* Limited grid for customer page (4-5 items) */
    .perfume-grid.limit-5 {
        grid-template-columns: repeat(5, 1fr);
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Responsive: 4 columns on medium screens */
    @media (max-width: 1200px) {
        .perfume-grid.limit-5 {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* Responsive: 3 columns on smaller screens */
    @media (max-width: 900px) {
        .perfume-grid.limit-5 {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    /* Responsive: 2 columns on mobile */
    @media (max-width: 600px) {
        .perfume-grid.limit-5 {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    /* View All Button */
    .view-all-container {
        text-align: center;
        margin-top: 2rem;
        padding-bottom: 1rem;
    }
    
    .view-all-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 36px;
        background: linear-gradient(135deg, var(--primary), var(--primary-strong));
        color: #022c22;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        border-radius: 999px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .view-all-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(34, 197, 94, 0.4);
    }
    
    .view-all-btn i {
        transition: transform 0.3s ease;
    }
    
    .view-all-btn:hover i {
        transform: translateX(5px);
    }
    .perfume-card{
        background:var(--bg-elevated);
        border-radius:0;
        border:1px solid rgba(148,163,184,0.25);
        box-shadow:var(--shadow-soft);
        overflow:hidden;
        cursor:pointer;
        transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .perfume-card:hover{
        transform:translateY(-8px) scale(1.01);
        box-shadow:0 22px 55px rgba(15,23,42,0.9);
        border-color:rgba(56,189,248,0.6);
    }
    .perfume-image{
        position:relative;
        height:240px;
        overflow:hidden;
    }
    .perfume-image-inner{
        width:100%;
        height:100%;
        transform-style:preserve-3d;
        transition:transform .7s;
    }
    .perfume-image-front,
    .perfume-image-back{
        position:absolute;
        inset:0;
        backface-visibility:hidden;
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
    .perfume-card:hover .perfume-image-inner{
        transform:rotateY(180deg);
    }
    .perfume-image-front img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition: transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s ease;
    }
    .perfume-card:hover .perfume-image-front img{
        transform:scale(1.06);
    }
    .perfume-image-front img.flipped {
        transform: scale(1.05);
        opacity: 0.9;
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
    .perfume-logo{
        position:absolute;
        bottom:10px;
        right:10px;
        width:30px;
        height:30px;
        border-radius:999px;
        padding:6px;
        background:rgba(15,23,42,0.85);
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
    }
    .flip-instruction{
        font-size:.75rem;
        color:var(--text-muted);
        margin-top:.3rem;
    }
    .perfume-info{
        padding:1.5rem 1.6rem 1.6rem;
    }
    .perfume-name{
        font-size:1.1rem;
        margin-bottom:.2rem;
    }
    .perfume-desc{
        font-size:.86rem;
        color:var(--text-muted);
        margin-bottom:.75rem;
    }
    .perfume-price{
        font-size:1rem;
        font-weight:600;
        margin-bottom:1rem;
    }
    /* temperature styling */
    .perfume-temperature {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .perfume-temperature i {
        color: var(--accent);
    }
    .perfume-actions{
        display:flex;
        align-items:center;
        gap:.6rem;
        flex-wrap:wrap;
    }
    .btn-favorite{
        width:40px;
        height:40px;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.7);
        background:rgba(15,23,42,0.92);
        color:#f97316;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
    }
    .btn-favorite.active{
        background:rgba(234,179,8,0.15);
        border-color:#eab308;
        color:#facc15;
    }

    /* Beautiful Buy Now button (matching Add to Cart style) */
    .btn-buy {
        padding:.75rem 1.6rem;
        border-radius:999px;
        border:none;
        background:linear-gradient(135deg, #25D366, #128C7E);
        color:#fff;
        font-weight:600;
        cursor:pointer;
        box-shadow:0 18px 40px rgba(37, 211, 102, 0.3);
        display:inline-flex;
        align-items:center;
        gap:.5rem;
        font-size:.92rem;
        transition:all 0.3s ease;
        text-decoration:none;
    }
    .btn-buy:hover {
        transform:translateY(-2px);
        box-shadow:0 20px 60px rgba(37, 211, 102, 0.5);
    }

    /* Perfume detail modal */
    .perfume-modal{
        position:fixed;
        inset:0;
        background:rgba(15,23,42,0.85);
        display:flex;
        align-items:center;
        justify-content:center;
        z-index:60;
    }
    .perfume-modal-content{
        max-width:900px;
        width:100%;
        background:radial-gradient(circle at top,#020617,#000);
        border-radius:28px;
        padding:2.2rem;
        border:1px solid rgba(148,163,184,0.4);
        box-shadow:0 30px 80px rgba(0,0,0,0.9);
        position:relative;
    }
    .close-perfume-modal{
        position:absolute;
        top:14px;
        right:14px;
        width:34px;
        height:34px;
        border-radius:999px;
        border:none;
        background:rgba(15,23,42,0.9);
        color:var(--text-main);
        cursor:pointer;
    }

    /* Cart modal + overlay */
    .overlay{
        position:fixed;
        inset:0;
        background:rgba(15,23,42,0.78);
        opacity:0;
        visibility:hidden;
        transition:.3s;
        z-index:40;
    }
    .overlay.active{
        opacity:1;
        visibility:visible;
    }
    .cart-modal{
        position:fixed;
        top:0;
        right:-420px;
        width:380px;
        max-width:95vw;
        height:100%;
        background:#020617;
        border-left:1px solid rgba(148,163,184,0.35);
        box-shadow:-22px 0 55px rgba(0,0,0,0.85);
        padding:1.6rem 1.4rem;
        z-index:50;
        transition:right .3s;
        display:flex;
        flex-direction:column;
    }
    .cart-modal.open{
        right:0;
    }
    .cart-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin-bottom:1.1rem;
    }
    .cart-title{
        font-size:1.2rem;
    }
    .cart-body{
        flex:1;
        overflow-y:auto;
        padding-right:.2rem;
    }
    .cart-item{
        display:flex;
        gap:.8rem;
        align-items:flex-start;
        padding:.9rem .1rem;
        border-bottom:1px solid rgba(31,41,55,0.8);
    }
    .cart-thumb{
        width:60px;
        height:76px;
        border-radius:12px;
        overflow:hidden;
        background:#020617;
    }
    .cart-info{
        flex:1;
        font-size:.8rem;
    }
    .cart-name{
        margin-bottom:.1rem;
    }
    .cart-meta{
        color:var(--text-muted);
        margin-bottom:.25rem;
    }
    .cart-qty{
        display:flex;
        align-items:center;
        gap:.35rem;
    }
    .qty-btn{
        width:22px;
        height:22px;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.5);
        background:transparent;
        color:var(--text-main);
        cursor:pointer;
        font-size:.85rem;
    }
    .remove-item{
        border:none;
        background:transparent;
        color:var(--danger);
        cursor:pointer;
        font-size:.8rem;
        margin-left:auto;
    }
    .cart-footer{
        border-top:1px solid rgba(31,41,55,0.9);
        padding-top:.9rem;
        margin-top:.4rem;
    }
    .cart-total-row{
        display:flex;
        justify-content:space-between;
        margin-bottom:.8rem;
        font-size:.93rem;
    }
    .cart-actions{
        display:flex;
        gap:.6rem;
    }
    .btn-outline{
        flex:1;
        padding:.65rem 1rem;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.65);
        background:transparent;
        color:var(--text-main);
        cursor:pointer;
        font-size:.85rem;
    }

    /* Jet animation on Add to Cart */
    .jet-icon{
        position:fixed;
        width:70px;
        height:70px;
        pointer-events:none;
        z-index:999;
        opacity:0;
    }
    .jet-icon img{
        width:100%;
        height:100%;
        object-fit:contain;
    }
    .jet-animate{
        animation:jet 0.8s forwards ease-out;
    }

    /* Toast */
    .toast{
        position:fixed;
        bottom:20px;
        left:50%;
        transform:translateX(-50%) translateY(120%);
        padding:.9rem 1.3rem;
        border-radius:999px;
        background:rgba(15,23,42,0.96);
        border:1px solid rgba(148,163,184,0.4);
        color:var(--text-main);
        font-size:.85rem;
        display:flex;
        align-items:center;
        gap:.6rem;
        z-index:70;
        transition:.3s;
    }
    .toast.active{
        transform:translateX(-50%) translateY(0);
    }

    /* Footer */
    .footer{
        background:#020617;
        border-top:1px solid rgba(148,163,184,0.15);
        padding:3.5rem 4.5rem 2rem;
    }
    .footer-content{
        display:grid;
        grid-template-columns:2.2fr 1.2fr 1.2fr 1.6fr;
        gap:2.4rem;
        margin-bottom:2rem;
    }
    .footer-logo{
        width:60px;
        height:60px;
        margin-bottom:.9rem;
    }
    .footer-column h3{
        margin-bottom:.8rem;
        font-weight:600;
    }
    .footer-links{
        list-style:none;
        display:flex;
        flex-direction:column;
        gap:.5rem;
        font-size:.9rem;
    }
    .footer-links a{
        color:var(--text-muted);
        text-decoration:none;
        transition:color 0.3s ease, transform 0.3s ease;
        display:inline-block;
    }
    .footer-links a:hover{
        color:var(--primary);
        transform:translateX(3px);
    }
    .social-links{
        display:flex;
        gap:.6rem;
    }
    .social-link{
        width:34px;
        height:34px;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.4);
        display:flex;
        align-items:center;
        justify-content:center;
        color:var(--text-muted);
        text-decoration:none;
        font-size:.85rem;
        transition:all 0.3s ease;
    }
    .social-link:hover{
        border-color:var(--primary);
        color:var(--primary);
        transform:translateY(-2px);
    }
    .footer-bottom{
        border-top:1px solid rgba(15,23,42,0.85);
        padding-top:1rem;
        font-size:.8rem;
        color:var(--text-muted);
        text-align:center;
    }

    /* Animations & responsive */
    @keyframes jet{
        0%{transform:translate(0,0) scale(1);opacity:1}
        100%{transform:translate(var(--jet-x),var(--jet-y)) scale(0.1);opacity:0}
    }
    @keyframes floatParticle{
        0%{transform:translateY(100vh) translateX(0);opacity:0}
        10%,90%{opacity:1}
        100%{transform:translateY(-120px) translateX(120px);opacity:0}
    }
    @keyframes rotate{
        0%{transform:rotate(0)}
        100%{transform:rotate(360deg)}
    }
    @keyframes float{
        0%,100%{transform:translateY(0)}
        50%{transform:translateY(-12px)}
    }

    /* Enhanced perfume card styles */
    .perfume-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.5rem;
    }

    .perfume-meta {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 0.75rem;
    }

    /* Mobile menu toggle */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        color: var(--text-main);
        font-size: 1.5rem;
        cursor: pointer;
    }

    .mobile-nav {
        display: none;
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        background: rgba(2, 6, 23, 0.98);
        backdrop-filter: blur(20px);
        padding: 1.5rem;
        z-index: 30;
        border-bottom: 1px solid rgba(148,163,184,0.2);
    }

    .mobile-nav.active {
        display: block;
    }

    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .mobile-nav-link {
        color: var(--text-muted);
        text-decoration: none;
        padding: 0.8rem 0;
        border-bottom: 1px solid rgba(148,163,184,0.1);
    }

    /* HIDE PERFUME LOGO BADGES WITHOUT CHANGING LAYOUT */
    .perfume-logo{display:none !important; visibility:hidden !important;}

    /* Center the section title and subtitle in customer experience */
    .section.customer-experience .section-title,
    .section.customer-experience .section-subtitle {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    /* Ensure the neon background covers full width */
    .neon-sparkles,
    .neon-glow {
        width: 100%;
        left: 0;
        border-radius: var(--card-radius);
    }

    /* ===========================================
       MOOD MATCH MODAL - FACE DETECTION INTEGRATION
       =========================================== */
    .mood-match-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(5, 8, 22, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
    }

    .mood-match-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .mood-match-container {
        background: radial-gradient(circle at top left, var(--bg-elevated), var(--bg));
        border-radius: var(--card-radius);
        width: 95%;
        max-width: 1400px;
        height: 90vh;
        max-height: 900px;
        overflow: hidden;
        box-shadow: var(--shadow-main);
        border: 1px solid rgba(56, 189, 248, 0.3);
        display: flex;
        flex-direction: column;
    }

    .mood-match-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(56, 189, 248, 0.2);
        background: rgba(7, 15, 37, 0.8);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mood-match-title {
        font-size: 1.8rem;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mood-match-title i {
        color: var(--primary);
    }

    .close-mood-match {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: var(--danger);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }

    .close-mood-match:hover {
        background: rgba(239, 68, 68, 0.2);
        transform: rotate(90deg);
    }

    .mood-match-content {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    .mood-left-panel, .mood-right-panel {
        flex: 1;
        padding: 2rem;
        overflow-y: auto;
    }

    .mood-left-panel {
        border-right: 1px solid rgba(56, 189, 248, 0.1);
    }

    /* Camera section styling */
    .mood-camera-container {
        width: 100%;
        height: 300px;
        background: linear-gradient(145deg, #1e293b, #0f172a);
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(34, 197, 94, 0.3);
    }

    .mood-camera-feed {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .mood-camera-placeholder {
        text-align: center;
        color: var(--text-main);
        padding: 20px;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .mood-camera-placeholder i {
        font-size: 4rem;
        margin-bottom: 15px;
        color: var(--primary);
        opacity: 0.7;
    }

    .mood-permission-request {
        background: rgba(34, 197, 94, 0.1);
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
        text-align: center;
        max-width: 80%;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .mood-camera-controls {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .mood-btn {
        padding: 12px 24px;
        border-radius: 999px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .mood-btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-strong));
        color: #022c22;
    }

    .mood-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
    }

    .mood-btn-secondary {
        background: rgba(15, 23, 42, 0.8);
        color: var(--text-main);
        border: 1px solid rgba(148, 163, 184, 0.4);
    }

    .mood-btn-secondary:hover {
        background: rgba(30, 41, 59, 0.8);
        border-color: var(--accent);
    }

    .mood-upload-area {
        text-align: center;
        padding: 25px;
        border: 2px dashed rgba(56, 189, 248, 0.5);
        border-radius: 15px;
        margin-top: 20px;
        background: rgba(56, 189, 248, 0.05);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mood-upload-area:hover {
        background: rgba(56, 189, 248, 0.1);
        border-color: var(--accent);
    }

    .mood-upload-area i {
        font-size: 2.5rem;
        color: var(--accent);
        margin-bottom: 10px;
    }

    /* Mood analysis display */
    .mood-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
        padding: 25px;
        background: rgba(15, 23, 42, 0.6);
        border-radius: 20px;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .mood-icon {
        font-size: 5rem;
        margin-bottom: 15px;
    }

    .mood-text {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--text-main);
        text-align: center;
    }

    .mood-confidence {
        font-size: 1.1rem;
        color: var(--accent);
        background: rgba(56, 189, 248, 0.1);
        padding: 5px 15px;
        border-radius: 20px;
    }

    /* Emotion chart */
    .emotion-chart {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }

    .emotion-bar {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .emotion-label {
        width: 100px;
        font-size: 0.9rem;
        color: var(--text-main);
    }

    .emotion-progress {
        flex: 1;
        height: 12px;
        background: rgba(15, 23, 42, 0.8);
        border-radius: 6px;
        overflow: hidden;
    }

    .emotion-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 6px;
        transition: width 0.8s ease;
    }

    .emotion-value {
        width: 45px;
        text-align: right;
        font-size: 0.9rem;
        color: var(--text-main);
    }

    /* Perfume recommendation card */
    .mood-perfume-recommendation {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(56, 189, 248, 0.1));
        border-radius: 20px;
        padding: 25px;
        margin-top: 25px;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .mood-perfume-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        gap: 15px;
    }

    .mood-perfume-image {
        width: 80px;
        height: 80px;
        background: rgba(15, 23, 42, 0.8);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary);
        border: 1px solid rgba(34, 197, 94, 0.5);
    }

    .mood-perfume-info h3 {
        color: var(--text-main);
        margin-bottom: 5px;
        font-size: 1.4rem;
    }

    .mood-perfume-info p {
        color: var(--text-muted);
    }

    .mood-perfume-notes {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .mood-note-tag {
        background: rgba(15, 23, 42, 0.9);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        color: var(--text-main);
        border: 1px solid rgba(148, 163, 184, 0.4);
    }

    /* Mood options */
    .mood-simulation-controls {
        margin-top: 25px;
    }

    .mood-options-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 15px;
    }

    .mood-option-btn {
        padding: 12px;
        background: rgba(15, 23, 42, 0.7);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        border: 1px solid rgba(148, 163, 184, 0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .mood-option-btn:hover {
        background: rgba(34, 197, 94, 0.2);
        border-color: var(--primary);
        transform: translateY(-3px);
    }

    .mood-option-btn.active {
        background: rgba(34, 197, 94, 0.3);
        border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(34, 197, 94, 0.2);
    }

    .mood-option-emoji {
        font-size: 1.5rem;
    }

    .mood-option-text {
        font-size: 0.8rem;
        color: var(--text-main);
    }

    /* Mode selector */
    .mood-mode-selector {
        display: flex;
        gap: 10px;
        margin: 20px 0;
        flex-wrap: wrap;
    }

    .mood-mode-btn {
        padding: 10px 20px;
        background: rgba(15, 23, 42, 0.7);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid rgba(148, 163, 184, 0.3);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .mood-mode-btn:hover {
        background: rgba(56, 189, 248, 0.2);
        color: var(--text-main);
    }

    .mood-mode-btn.active {
        background: rgba(34, 197, 94, 0.3);
        border-color: var(--primary);
        color: var(--text-main);
    }

    /* Captured image */
    .mood-captured-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
        border-radius: 10px;
    }

    /* Loading state */
    .mood-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        color: var(--accent);
        font-size: 1.2rem;
    }

    .mood-loading i {
        margin-right: 10px;
        animation: rotate 1s linear infinite;
    }

    @media(max-width:1024px){
        .hero{
            padding:3rem 2.2rem 2rem;
            grid-template-columns:1fr;
        }
        .section{padding:3.5rem 2.2rem;}
        .weather-container{
            flex-direction:column;
            padding:2rem;
        }
        .mood-match-container {
            width: 98%;
            height: 95vh;
        }
        .mood-options-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media(max-width:768px){
        .header{padding:1rem 1.5rem;}
        .nav-links{display:none;}
        .mobile-menu-toggle { display: block; }
        .hero-title{font-size:3rem;}
        .section{padding:3.2rem 1.5rem;}
        .weather-details{
            grid-template-columns:1fr;
        }
        .footer{padding:3rem 1.5rem 2rem;}
        .footer-content{
            grid-template-columns:1fr 1fr;
        }
        .mood-match-content {
            flex-direction: column;
            overflow-y: auto;
        }
        .mood-left-panel, .mood-right-panel {
            flex: none;
            height: auto;
            overflow: visible;
        }
        .mood-left-panel {
            border-right: none;
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
        }
    }
    
    @media(max-width:480px){
        .hero-title{font-size:2.4rem;}
        .perfume-grid{grid-template-columns:1fr;}
        .footer-content{
            grid-template-columns:1fr;
        }
        .mood-options-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>
<!-- LOCATION PERMISSION MODAL -->
<div class="location-modal" id="locationModal">
    <div class="location-content">
        <div class="location-icon">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <h2 class="location-title">Share Your Location</h2>
        <p class="location-text">
            To provide you with accurate weather-based perfume recommendations and share your exact location with TROY Perfumes, please allow location access.
        </p>
        
        <div class="location-details">
            <div class="location-detail">
                <i class="fas fa-city"></i>
                <span id="locationCity">City: Detecting...</span>
            </div>
            <div class="location-detail">
                <i class="fas fa-map-pin"></i>
                <span id="locationAddress">Address: Detecting...</span>
            </div>
            <div class="location-detail">
                <i class="fas fa-location-dot"></i>
                <span id="locationCoordinates">Coordinates: Detecting...</span>
            </div>
        </div>
        
        <div class="location-buttons">
            <button class="location-btn location-btn-primary" id="allowLocation">
                <i class="fas fa-check-circle"></i> Allow Location
            </button>
            <button class="location-btn location-btn-secondary" id="skipLocation">
                <i class="fas fa-times-circle"></i> Skip for Now
            </button>
        </div>
        
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 1.5rem;">
            <i class="fas fa-info-circle"></i> Your location helps us provide personalized perfume recommendations based on local weather.
        </p>
    </div>
</div>

</div>

<!-- NABI PAK SAW STAMP -->
<img alt="Nabi Pak SAW Stamp - TROY Perfumes Contribution" class="nabipak-stamp" id="nabiStamp" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Islamic_star_and_crescent.svg/1200px-Islamic_star_and_crescent.svg.png" title="Nabi Pak SAW Stamp - Click for contribution details"/>
<!-- CONTRIBUTION POPUP -->
<div class="contribution-modal" id="contributionModal">
<div class="contribution-content">
<h2 class="contribution-title">Contribution in the Name of Allah</h2>
<p class="contribution-text">
                As part of our commitment, 2% of your order amount will be contributed in the name of Allah. 
                Please press the stamp of Nabi Pak SAW to confirm your contribution and proceed with checkout.
            </p>
<img alt="Nabi Pak SAW Stamp - Confirm Contribution" class="contribution-stamp" id="confirmContribution" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Islamic_star_and_crescent.svg/1200px-Islamic_star_and_crescent.svg.png" title="Click to confirm contribution"/>
<p class="contribution-note">May Allah accept your contribution and bless you</p>
</div>
</div>

<!-- MOOD MATCH MODAL (title updated) -->
<div class="mood-match-modal" id="moodMatchModal">
    <div class="mood-match-container">
        <div class="mood-match-header">
            <h2 class="mood-match-title">
                <i class="fas fa-smile-beam"></i> TROY – Your Heart Mood Match
            </h2>
            <button class="close-mood-match" id="closeMoodMatch">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mood-match-content">
            <!-- Left Panel: Camera & Controls -->
            <div class="mood-left-panel">
                <div class="mood-camera-container">
                    <div class="mood-camera-placeholder" id="moodCameraPlaceholder">
                        <i class="fas fa-user-circle"></i>
                        <p>Camera access required for mood detection</p>
                        <div class="mood-permission-request" id="moodPermissionRequest">
                            <p>Allow camera access to analyze your mood and find your perfect TROY perfume</p>
                            <button class="mood-btn mood-btn-primary" id="moodRequestPermissionBtn">
                                <i class="fas fa-camera"></i> Allow Camera Access
                            </button>
                        </div>
                    </div>
                    <video id="moodCameraFeed" class="mood-camera-feed" autoplay></video>
                    <canvas id="moodPhotoCanvas" style="display:none;"></canvas>
                    <img id="moodCapturedImage" class="mood-captured-image" alt="Captured or uploaded image">
                </div>
                
                <div class="mood-camera-controls">
                    <button class="mood-btn mood-btn-primary" id="moodStartCameraBtn">
                        <i class="fas fa-video"></i> Start Camera
                    </button>
                    <button class="mood-btn mood-btn-secondary" id="moodCaptureBtn" disabled>
                        <i class="fas fa-camera"></i> Capture Photo
                    </button>
                    <button class="mood-btn mood-btn-secondary" id="moodResetBtn">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>
                
                <div class="mood-upload-area" id="moodUploadArea">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click here or drag & drop to upload an image</p>
                    <p style="font-size: 0.9rem; color: var(--text-muted); margin-top: 5px;">
                        <i class="fas fa-info-circle"></i> Alternative to camera capture
                    </p>
                    <input type="file" id="moodImageUpload" accept="image/*" style="display:none;">
                </div>
                
                <div class="mood-camera-controls" style="margin-top: 20px;">
                    <button class="mood-btn mood-btn-primary" id="moodAnalyzeBtn" disabled>
                        <i class="fas fa-brain"></i> Analyze Mood with AI
                    </button>
                </div>
                
                <div class="mood-simulation-controls">
                    <p style="color: var(--text-main); margin-bottom: 10px; font-size: 0.9rem;">
                        <i class="fas fa-flask"></i> Test with sample moods:
                    </p>
                    <div class="mood-options-grid" id="moodOptionsGrid">
                        <!-- Mood options will be added by JavaScript -->
                    </div>
                </div>
            </div>
            
            <!-- Right Panel: Analysis & Recommendation -->
            <div class="mood-right-panel">
                <div class="mood-mode-selector">
                    <div class="mood-mode-btn active" data-mode="simulation">
                        <i class="fas fa-robot"></i> AI Simulation
                    </div>
                    <div class="mood-mode-btn" data-mode="mood-match">
                        <i class="fas fa-heart"></i> Mood Match
                    </div>
                    <div class="mood-mode-btn" data-mode="azure">
                        <i class="fab fa-microsoft"></i> Azure AI
                    </div>
                </div>
                
                <div class="mood-display">
                    <div class="mood-icon" id="moodDisplayIcon">😊</div>
                    <div class="mood-text" id="moodDisplayText">Ready for Mood Analysis</div>
                    <div class="mood-confidence" id="moodDisplayConfidence">Awaiting your photo</div>
                </div>
                
                <div class="emotion-chart" id="moodEmotionChart">
                    <!-- Emotion bars will be inserted here -->
                </div>
                
                <div class="mood-perfume-recommendation" id="moodPerfumeRecommendation">
                    <div class="mood-perfume-header">
                        <div class="mood-perfume-image">
                            <i class="fas fa-wind"></i>
                        </div>
                        <div class="mood-perfume-info">
                            <h3 id="recommendedPerfumeName">Royal Oud</h3>
                            <p id="recommendedPerfumeMatch">Perfect for your confident mood</p>
                        </div>
                    </div>
                    <div class="mood-perfume-details">
                        <p id="moodPerfumeDescription">Deep oud, sandalwood and amber with a citrus opening. Perfect for confident and sophisticated occasions.</p>
                        <div class="mood-perfume-notes" id="moodPerfumeNotes">
                            <div class="mood-note-tag">Oud</div>
                            <div class="mood-note-tag">Sandalwood</div>
                            <div class="mood-note-tag">Amber</div>
                            <div class="mood-note-tag">Citrus</div>
                        </div>
                    </div>
                    <div style="margin-top: 20px; display: flex; gap: 10px;">
                        <button class="mood-btn mood-btn-primary" id="moodAddToCartBtn" style="flex:1;">
                            <i class="fas fa-shopping-bag"></i> Add to Cart (Rs 4,949)
                        </button>
                        <button class="mood-btn mood-btn-secondary" id="moodViewDetailsBtn" style="flex:1;">
                            <i class="fas fa-info-circle"></i> View Details
                        </button>
                    </div>
                </div>
                
                <div style="margin-top: 30px; padding: 20px; background: rgba(15, 23, 42, 0.5); border-radius: 15px;">
                    <h4 style="color: var(--primary); margin-bottom: 10px;">
                        <i class="fas fa-lightbulb"></i> How Mood Matching Works
                    </h4>
                    <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                        Our AI analyzes facial expressions to detect emotions, then matches your mood with the perfect TROY perfume. 
                        Each mood corresponds to specific scent profiles that enhance your emotional state.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Particles -->
<div class="particles" id="particles"></div>
<!-- Jet used for add-to-cart animation -->
<div class="jet-icon" id="jetIcon">
<img alt="Cart Animation Jet" src="https://cdn.pixabay.com/photo/2016/03/31/20/26/plane-1295660_1280.png"/>
</div>
@include('navbar')
<!-- HERO (simplified – only video and tag) -->
<section class="hero">
<div>
<h1 class="hero-title">
<span class="hero-gradient">TROY Perfumes</span><br/>
                Weather-Matched Luxury Scents
            </h1>
<p class="hero-subtitle">
                Discover long-lasting impressions curated by city, weather and your mood. Every bottle inspired by niche blends at accessible impressions pricing.
            </p>
<div class="hero-tags">
<span class="tag-chip"><i class="fas fa-wind"></i>  AI weather engine</span>
<span class="tag-chip"><i class="fas fa-star"></i>  4.9/5 average rating</span>
<span class="tag-chip"><i class="fas fa-mosque"></i>  2% served in name of Allah</span>
<span class="tag-chip"><i class="fas fa-smile-beam"></i>  Mood-based matching</span>
<span class="tag-chip"><i class="fas fa-map-marker-alt"></i>  Location-based delivery</span>
</div>
<div class="hero-cta">
<button class="btn-primary" onclick="scrollToSection('#featured')">
                    Shop Recommended
                    <i class="fas fa-arrow-right"></i>
</button>
<button class="btn-ghost" onclick="scrollToSection('#customer-experience')">
                    Watch Experiences
                    <i class="fas fa-play-circle"></i>
</button>
<button class="btn-ghost" onclick="openMoodMatch()">
                    <i class="fas fa-smile-beam"></i> Match by Mood
</button>
</div>
<div class="hero-metrics">
<div class="metric-pill"><i class="fas fa-bottle-droplet"></i> Over 50+ impressions</div>
<div class="metric-pill"><i class="fas fa-clock"></i> Up to 10–12 hrs hold</div>
<div class="metric-pill"><i class="fas fa-location-dot"></i> Tailored to London, Dubai, Lahore, Karachi &amp; more</div>
<div class="metric-pill"><i class="fas fa-map-pin"></i> Pin-point location delivery</div>
</div>
</div>
<div class="hero-visual">
<div class="hero-card">
    <!-- TV SCREEN + YOUTUBE VIDEO -->
    <div class="hero-video-container tv-screen">
        <iframe src="https://www.youtube.com/embed/5qap5aO4i9A?autoplay=1&mute=1&loop=1&playlist=5qap5aO4i9A&controls=0&showinfo=0&modestbranding=1" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
        </iframe>
    </div>
    <div class="hero-perfume-tag">Bestseller · Royal Oud</div>
    <div class="hero-perfume-glow"></div>
</div>
<!-- All detailed perfume info (rating, notes, price) removed as requested -->
</div>
</section>
<div class="perfume-lab-container" style="margin-top: 2rem;">
<button class="perfume-lab-btn" onclick="openPerfumeLab()">
<i class="fas fa-flask"></i>
<span class="btn-text">TROY Perfume Lab</span>
<i class="fas fa-arrow-right"></i>
</button>
</div>

<!-- PROMOTIONS + WEATHER + PERFUMES LAYOUT -->
<section class="section promotions">
<div class="promotions-layout">
<!-- LEFT: Weather + perfumes -->
<div class="promotions-main">
<!-- Weather Section (redesigned) -->
<section class="weather-section" id="weather">
<h2 class="section-title">Live Weather-Matched Fragrances</h2>
<div class="weather-container">
    <!-- Left column -->
    <div class="weather-visual">
        <div class="thermometer">
            <div class="thermometer-fill" id="thermometerFill" style="height:40%;"></div>
        </div>
        <div class="thermometer-bulb"></div>
        <div class="temp-display" id="tempDisplay">Loading...</div>
        <div class="temp-label" id="tempLabel">Lahore</div>
        <div class="weather-icon-container" id="weatherIcon"></div>
        <div class="weather-condition" id="weatherCondition"></div>
    </div>

    <!-- Right column -->
    <div class="weather-info">
        <h2 class="weather-title">Find Your Perfect Scent</h2>
        <p class="weather-desc" id="weatherRecommendation">Fetching live weather data...</p>

        <!-- Weather details grid -->
        <div class="weather-details">
            <div class="weather-detail"><i class="fas fa-wind"></i> <span id="windSpeed">Wind: -- km/h</span></div>
            <div class="weather-detail"><i class="fas fa-tint"></i> <span id="humidity">Humidity: --%</span></div>
            <div class="weather-detail"><i class="fas fa-temperature-half"></i> <span id="feelsLike">Feels like: --°C</span></div>
            <div class="weather-detail"><i class="fas fa-map-marker-alt"></i> <span id="userLocation">Location: Allow access</span></div>
        </div>

        <!-- City selector -->
        <div class="city-selector">
            <button class="city-btn active" data-city="Lahore" data-lat="31.5497" data-lon="74.3436">Lahore</button>
            <button class="city-btn" data-city="Karachi" data-lat="24.8607" data-lon="67.0011">Karachi</button>
            <button class="city-btn" data-city="Islamabad" data-lat="33.6844" data-lon="73.0479">Islamabad</button>
            <button class="city-btn" data-city="Dubai" data-lat="25.2048" data-lon="55.2708">Dubai</button>
            <button class="city-btn" data-city="London" data-lat="51.5074" data-lon="-0.1278">London</button>
            <button class="city-btn" id="myLocationBtn">
                <i class="fas fa-location-dot"></i> My Location
            </button>
        </div>

        <!-- City search input -->
        <div class="city-search-container">
            <input type="text" class="city-search-input" id="citySearchInput" placeholder="Enter any city name (e.g., New York, Tokyo)">
            <button class="city-search-btn" id="citySearchBtn"><i class="fas fa-search"></i> Get Recommendation</button>
        </div>

        <p class="section-subtitle" style="margin-top:0; margin-bottom:1rem;">
            Our intelligent engine recommends perfumes based on your local live weather. Switch cities or search to see real-time weather-based suggestions.
        </p>
        <!-- Refresh button -->
        <button class="btn-ghost" id="refreshWeather" style="margin-bottom: 1.8rem; padding: 0.5rem 1rem;">
            <i class="fas fa-sync-alt"></i> Refresh Weather
        </button>

        <!-- Weather-based perfume recommendation card -->
        <div id="weatherPerfumeRecommendation" class="weather-perfume-card">
            <img src="https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Perfume" class="weather-perfume-img" id="weatherPerfumeImg">
            <div class="weather-perfume-info">
                <div class="weather-perfume-name" id="weatherPerfumeName">Royal Oud</div>
                <div class="weather-perfume-price" id="weatherPerfumePrice">Rs 4,949</div>
                <span class="weather-perfume-badge" id="weatherPerfumeBadge">Recommended for today</span>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Featured Perfumes -->
<section class="section featured" id="featured" style="padding-left:0;padding-right:0;padding-bottom:0;">
<h2 class="section-title">CUSTOMER CRUSH</h2>
<p class="section-subtitle">
                        Our most loved fragrances based on real customer favorites and ratings
                    </p>
<div class="perfume-grid" id="perfumeGrid">
    <!-- Perfumes will be loaded here -->
</div>
</section>
</div>
</div>
</section>
<!-- CUSTOMER EXPERIENCE SECTION (REPLACING BRAND VIDEOS) -->
<section class="section customer-experience" id="customer-experience">
<h2 class="section-title">Customer Experience</h2>
<p class="section-subtitle">
            Exclusive interviews and testimonials from our premium customers. Discover how TROY Perfumes enhance their daily lives.
        </p>
    
    <!-- THIS WEEK'S CUSTOMER VIDEO SECTION WITH NEON BACKGROUND -->
    <div class="this-week-video" id="current-video">
        <!-- Neon Sparkling Background -->
        <div class="neon-sparkles" id="sparkles-container"></div>
        <div class="neon-glow"></div>
        
        <div class="this-week-content">
            <div class="current-video-container">
                <div class="current-video-wrapper">
                    <video class="current-video" autoplay loop preload="metadata">
                        <source src="Autonomous.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="video-controls-experience">
                        <span class="video-info-experience">
                            <span id="current-video-title">CEO Spotlight: Tech Giant Executive</span>
                        </span>
                        <button class="video-btn-experience" id="playPauseBtn">
                            <i class="fas fa-pause"></i>
                        </button>
                        <div class="video-volume-control">
                            <i class="fas fa-volume-up"></i>
                            <input type="range" id="volumeSlider" min="0" max="1" step="0.1" value="0.7">
                        </div>
                    </div>
                </div>
                
                <div class="current-video-info">
                    <h3 class="current-video-title">
                        <span id="customer-name">Mark Chen</span> - <span id="customer-company">TechNova Solutions</span>
                        <span class="badge">Featured This Week</span>
                    </h3>
                    <p class="current-video-description" id="current-video-description">
                        Exclusive interview with Mark Chen, CTO of TechNova Solutions, sharing how our Midnight Elixir 
                        fragrance has become an integral part of his leadership style and business meetings.
                    </p>
                    
                    <div class="video-stats">
                        <div class="stat-item" id="views-stat">
                            <div class="stat-value">
                                <i class="fas fa-eye stat-icon"></i>
                                <span id="view-count">15,842</span>
                            </div>
                            <div class="stat-label">Total Views</div>
                        </div>
                        <div class="stat-item" id="likes-stat">
                            <div class="stat-value">
                                <i class="fas fa-heart stat-icon"></i>
                                <span id="like-count">2,847</span>
                            </div>
                            <div class="stat-label">Likes</div>
                        </div>
                        <div class="stat-item" id="shares-stat">
                            <div class="stat-value">
                                <i class="fas fa-share-alt stat-icon"></i>
                                <span id="share-count">1,429</span>
                            </div>
                            <div class="stat-label">Shares</div>
                        </div>
                    </div>
                    
                    <!-- Share Buttons for All Users -->
                    <div class="share-container">
                        <p style="color: var(--text-main); margin-bottom: 10px; font-size: 0.9rem;">
                            <i class="fas fa-share"></i> Share this video:
                        </p>
                        <div class="share-buttons">
                            <button class="share-btn facebook" data-platform="facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </button>
                            <button class="share-btn twitter" data-platform="twitter">
                                <i class="fab fa-twitter"></i> Twitter
                            </button>
                            <button class="share-btn whatsapp" data-platform="whatsapp" id="whatsappLocationShare">
                                <i class="fab fa-whatsapp"></i> Share with Location
                            </button>
                            <button class="share-btn link" id="copy-link-btn">
                                <i class="fas fa-link"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CUSTOMER REVIEWS FROM DATABASE -->
    <div class="reviews-section" id="customer-reviews">
        <div class="reviews-header">
            <h3><i class="fas fa-star"></i> What Our Customers Say</h3>
            <p>Real reviews from our valued customers</p>
        </div>
        <div class="reviews-slider-wrapper">
            <div class="reviews-grid" id="reviews-grid">
                <div class="reviews-loading" id="reviews-loading">
                    <i class="fas fa-spinner"></i>
                    <p>Loading reviews...</p>
                </div>
            </div>
        </div>
        <button class="reviews-nav-arrow" id="reviews-next-arrow" style="display:none;" title="Next reviews">
            <i class="fas fa-arrow-right"></i>
        </button>
        <div class="reviews-page-dots" id="reviews-page-dots"></div>
    </div>
</section>

<!-- PARTNER BRANDS MARQUEE SECTION -->
<section class="brands-section" id="partner-brands">
    <div class="brands-title">
        <h2>Our Partner Brands</h2>
        <p>Trusted by world's finest fragrance houses</p>
    </div>
    <div class="brands-marquee">
        <div class="brands-marquee-inner">
            <!-- Brand 1 -->
            <div class="brand-card">
                <span class="brand-name">CHANEL</span>
            </div>
            <!-- Brand 2 -->
            <div class="brand-card">
                <span class="brand-name">DIOR</span>
            </div>
            <!-- Brand 3 -->
            <div class="brand-card">
                <span class="brand-name">GUCCI</span>
            </div>
            <!-- Brand 4 -->
            <div class="brand-card">
                <span class="brand-name">TOM FORD</span>
            </div>
            <!-- Brand 5 -->
            <div class="brand-card">
                <span class="brand-name">VERSACE</span>
            </div>
            <!-- Brand 6 -->
            <div class="brand-card">
                <span class="brand-name">PRADA</span>
            </div>
            <!-- Brand 7 -->
            <div class="brand-card">
                <span class="brand-name">YSL</span>
            </div>
            <!-- Brand 8 -->
            <div class="brand-card">
                <span class="brand-name">JO MALONE</span>
            </div>
            <!-- Brand 9 -->
            <div class="brand-card">
                <span class="brand-name">ARMANI</span>
            </div>
            <!-- Brand 10 -->
            <div class="brand-card">
                <span class="brand-name">BURBERRY</span>
            </div>
            <!-- DUPLICATE BRANDS FOR SEAMLESS LOOP -->
            <!-- Brand 1 -->
            <div class="brand-card">
                <span class="brand-name">CHANEL</span>
            </div>
            <!-- Brand 2 -->
            <div class="brand-card">
                <span class="brand-name">DIOR</span>
            </div>
            <!-- Brand 3 -->
            <div class="brand-card">
                <span class="brand-name">GUCCI</span>
            </div>
            <!-- Brand 4 -->
            <div class="brand-card">
                <span class="brand-name">TOM FORD</span>
            </div>
            <!-- Brand 5 -->
            <div class="brand-card">
                <span class="brand-name">VERSACE</span>
            </div>
            <!-- Brand 6 -->
            <div class="brand-card">
                <span class="brand-name">PRADA</span>
            </div>
            <!-- Brand 7 -->
            <div class="brand-card">
                <span class="brand-name">YSL</span>
            </div>
            <!-- Brand 8 -->
            <div class="brand-card">
                <span class="brand-name">JO MALONE</span>
            </div>
            <!-- Brand 9 -->
            <div class="brand-card">
                <span class="brand-name">ARMANI</span>
            </div>
            <!-- Brand 10 -->
            <div class="brand-card">
                <span class="brand-name">BURBERRY</span>
            </div>
        </div>
    </div>
</section>

<!-- POWERED BY JAZZ WATERMARK -->
<div class="powered-by-jazz">
    <div class="powered-by-jazz-text">
        <span>Powered by</span>
        <div class="powered-by-jazz-logo">JAZZ</div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
<div class="footer-content">
<div class="footer-column">
<img alt="TROY Perfumes Logo" class="footer-logo" id="footerLogo" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTMwIDBDMTMuNDMxIDAgMCAxMy40MzEgMCAzMFMxMy40MzEgNjAgMzAgNjBTNjAgNDYuNTY5IDYwIDMwUzMwIDAgMzAgMFoiIGZpbGw9IiMyMmM1NSIvPgo8cGF0aCBkPSJNMjIgMjJIMTdWMzdIMjJWMjJaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMzggMjJIMzJWMzdIMzhWMjJaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNNDUgMzdIMzhWNDVIMzhWMzdaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4="/>
<h3>TROY Perfumes</h3>
<p style="color:var(--text-muted);margin-bottom:1.2rem;">
                    Luxury impressions crafted with precision and passion. Designed for Pakistani weather and routines.
                </p>
<div class="social-links">
<a aria-label="Facebook" class="social-link" href="#"><i class="fab fa-facebook-f"></i></a>
<a aria-label="Instagram" class="social-link" href="#"><i class="fab fa-instagram"></i></a>
<a aria-label="YouTube" class="social-link" href="#"><i class="fab fa-youtube"></i></a>
</div>
</div>
<div class="footer-column">
<h3>Shop</h3>
<ul class="footer-links">
<li><a href="#">Bestsellers</a></li>
<li><a href="#">Seasonal Collection</a></li>
<li><a href="#">Gift Sets</a></li>
<li><a href="#">Oud &amp; Amber</a></li>
<li><a href="#">Fresh &amp; Citrus</a></li>
<li><a href="#" onclick="openMoodMatch()">Mood Match</a></li>
</ul>
</div>
<div class="footer-column">
<h3>Help</h3>
<ul class="footer-links">
<li><a href="#">WhatsApp Support</a></li>
<li><a href="#">Shipping &amp; Returns</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">Store Locator</a></li>
<li><a href="#">Privacy Policy</a></li>
</ul>
</div>
<div class="footer-column">
<h3>Newsletter</h3>
<p style="color:var(--text-muted);margin-bottom:1rem;">
                    Subscribe for new drops, flash sales and VIP early access.
                </p>
<form id="newsletterForm" style="display:flex;gap:10px;">
<input placeholder="Your email" required="" style="
                        flex:1;
                        padding:12px 18px;
                        border-radius:30px;
                        border:1px solid rgba(148,163,184,0.5);
                        background:var(--bg-elevated);
                        color:var(--text-main);
                        outline:none;
                        font-size:.95rem;
                    " type="email"/>
<button style="
                        padding:12px 24px;
                        border-radius:30px;
                        background:var(--primary);
                        color:#022c22;
                        border:none;
                        cursor:pointer;
                        font-weight:600;
                        transition:all .3s;
                    " type="submit">Subscribe</button>
</form>
</div>
</div>
<div class="footer-bottom">
<p>© 2025 TROY Perfumes. All rights reserved. | 2% of your amount will be served in name of Allah.</p>
<p style="margin-top: 0.5rem; font-size: 0.75rem;">
    <i class="fas fa-map-marker-alt"></i> Share your location for precise delivery and weather-based recommendations
</p>
</div>
</footer>
<!-- OVERLAY + CART -->
<div class="overlay" id="overlay"></div>
<div class="cart-modal" id="cartModal">
<div class="cart-header">
<h3 class="cart-title">Your Cart</h3>
<button class="close-cart btn-outline" id="closeCart" style="flex:0 0 auto;width:auto;padding:.4rem .8rem;">Close</button>
</div>
<div class="cart-body" id="cartItems"></div>
<div class="cart-footer">
<div class="cart-total-row">
<span>Total</span>
<span id="cartTotalAmount">Rs 0</span>
</div>
<!-- Location sharing section in cart -->
<div class="location-share-section">
    <div class="location-share-title">
        <i class="fas fa-map-marker-alt"></i> Delivery Location
    </div>
    <div class="location-share-details" id="cartLocationDetails">
        <span id="cartLocationText">Allow location access for precise delivery</span>
        <button class="btn-ghost" id="updateLocationBtn" style="margin-top: 10px; padding: 5px 10px; font-size: 0.8rem;">
            <i class="fas fa-location-dot"></i> Update Location
        </button>
    </div>
</div>
<div class="cart-actions">
<button class="btn-outline" onclick="clearCart()">Clear Cart</button>
<button class="btn-primary" id="checkoutBtn" style="flex:1;">
<i class="fab fa-whatsapp"></i> Checkout with Location
                </button>
</div>
</div>
</div>
<!-- Toast -->
<div class="toast" id="toast">
<i class="fas fa-circle-check" style="color:#22c55e;"></i>
<span class="toast-message">Added to cart</span>
</div>

<!-- SCRIPTS (unchanged – same as original) -->
<script>
/* === LOCATION MANAGEMENT SYSTEM === */
(function() {
    // User location data
    let userLocation = {
        latitude: null,
        longitude: null,
        city: null,
        address: null,
        pinCode: null,
        country: null,
        timestamp: null,
        accuracy: null
    };

    // DOM Elements
    const locationModal = document.getElementById('locationModal');
    const allowLocationBtn = document.getElementById('allowLocation');
    const skipLocationBtn = document.getElementById('skipLocation');
    const myLocationBtn = document.getElementById('myLocationBtn');
    const userLocationElement = document.getElementById('userLocation');
    const updateLocationBtn = document.getElementById('updateLocationBtn');
    const cartLocationText = document.getElementById('cartLocationText');
    const cartLocationDetails = document.getElementById('cartLocationDetails');
    const locationCityElement = document.getElementById('locationCity');
    const locationAddressElement = document.getElementById('locationAddress');
    const locationCoordinatesElement = document.getElementById('locationCoordinates');
    const whatsappLocationShare = document.getElementById('whatsappLocationShare');

    // Initialize location system
    function initLocationSystem() {
        // Check if location is already saved
        const savedLocation = localStorage.getItem('troy-user-location');
        if (savedLocation) {
            userLocation = JSON.parse(savedLocation);
            updateLocationUI();
        } else {
            // Show location modal after 3 seconds
            setTimeout(() => {
                if (!localStorage.getItem('troy-location-skipped')) {
                    locationModal.classList.add('active');
                }
            }, 3000);
        }

        // Setup event listeners
        setupLocationEventListeners();
    }

    function setupLocationEventListeners() {
        // Allow location button
        if (allowLocationBtn) {
            allowLocationBtn.addEventListener('click', requestUserLocation);
        }

        // Skip location button
        if (skipLocationBtn) {
            skipLocationBtn.addEventListener('click', () => {
                locationModal.classList.remove('active');
                localStorage.setItem('troy-location-skipped', 'true');
                showToast('You can enable location later in cart or settings');
            });
        }

        // My Location button in weather section
        if (myLocationBtn) {
            myLocationBtn.addEventListener('click', () => {
                locationModal.classList.add('active');
            });
        }

        // Update location button in cart
        if (updateLocationBtn) {
            updateLocationBtn.addEventListener('click', () => {
                locationModal.classList.add('active');
            });
        }

        // WhatsApp location share button
        if (whatsappLocationShare) {
            whatsappLocationShare.addEventListener('click', shareVideoWithLocation);
        }

        // Close modal when clicking outside
        locationModal.addEventListener('click', function(e) {
            if (e.target === locationModal) {
                locationModal.classList.remove('active');
            }
        });
    }

    async function requestUserLocation() {
        if (!navigator.geolocation) {
            alert("Geolocation is not supported by your browser");
            return;
        }

        allowLocationBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Getting Location...';
        allowLocationBtn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            async function(position) {
                // Save coordinates
                userLocation.latitude = position.coords.latitude;
                userLocation.longitude = position.coords.longitude;
                userLocation.accuracy = position.coords.accuracy;
                userLocation.timestamp = new Date().toISOString();

                // Get address from coordinates
                await getAddressFromCoordinates(
                    position.coords.latitude,
                    position.coords.longitude
                );

                // Save to localStorage
                localStorage.setItem('troy-user-location', JSON.stringify(userLocation));
                localStorage.removeItem('troy-location-skipped');

                // Update UI
                updateLocationUI();

                // Close modal
                locationModal.classList.remove('active');

                // Show success message
                showToast('Location saved successfully!');

                // Update weather for user's location
                updateWeatherForUserLocation();

                // Reset button
                allowLocationBtn.innerHTML = '<i class="fas fa-check-circle"></i> Allow Location';
                allowLocationBtn.disabled = false;
            },
            function(error) {
                console.error("Error getting location:", error);
                
                let errorMessage = "Unable to get your location. ";
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage += "You denied the request for Geolocation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage += "Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        errorMessage += "The request to get your location timed out.";
                        break;
                    default:
                        errorMessage += "An unknown error occurred.";
                        break;
                }
                
                alert(errorMessage);
                
                // Reset button
                allowLocationBtn.innerHTML = '<i class="fas fa-check-circle"></i> Allow Location';
                allowLocationBtn.disabled = false;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    async function getAddressFromCoordinates(lat, lon) {
        try {
            // Use Nominatim OpenStreetMap API for reverse geocoding
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`
            );
            
            if (!response.ok) {
                throw new Error('Reverse geocoding failed');
            }
            
            const data = await response.json();
            
            if (data.address) {
                // Extract address components
                const address = data.address;
                
                // Determine city
                if (address.city) {
                    userLocation.city = address.city;
                } else if (address.town) {
                    userLocation.city = address.town;
                } else if (address.village) {
                    userLocation.city = address.village;
                } else if (address.municipality) {
                    userLocation.city = address.municipality;
                } else if (address.county) {
                    userLocation.city = address.county;
                }
                
                // Get full address
                userLocation.address = data.display_name || "Address not available";
                
                // Get pin code
                userLocation.pinCode = address.postcode || "N/A";
                
                // Get country
                userLocation.country = address.country || "Unknown";
                
                // Update modal display
                if (locationCityElement) {
                    locationCityElement.textContent = `City: ${userLocation.city || 'Not detected'}`;
                }
                if (locationAddressElement) {
                    locationAddressElement.textContent = `Address: ${userLocation.address.substring(0, 50)}...`;
                }
                if (locationCoordinatesElement) {
                    locationCoordinatesElement.textContent = `Coordinates: ${lat.toFixed(6)}, ${lon.toFixed(6)}`;
                }
            }
        } catch (error) {
            console.error('Reverse geocoding error:', error);
            
            // Fallback: Use city from browser's timezone or IP
            userLocation.city = guessCityFromTimezone();
            userLocation.address = `Approximate location: ${userLocation.city}`;
            userLocation.pinCode = "N/A";
            userLocation.country = "Unknown";
            
            // Update modal with limited info
            if (locationCityElement) {
                locationCityElement.textContent = `City: ${userLocation.city}`;
            }
            if (locationAddressElement) {
                locationAddressElement.textContent = `Address: Approximate location detected`;
            }
            if (locationCoordinatesElement) {
                locationCoordinatesElement.textContent = `Coordinates: ${lat.toFixed(6)}, ${lon.toFixed(6)}`;
            }
        }
    }

    function guessCityFromTimezone() {
        // Try to guess city from timezone
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (timezone) {
            const parts = timezone.split('/');
            if (parts.length > 1) {
                return parts[1].replace('_', ' ');
            }
        }
        return "Your City";
    }

    function updateLocationUI() {
        // Update weather section
        if (userLocationElement) {
            if (userLocation.city) {
                userLocationElement.innerHTML = `<i class="fas fa-map-marker-alt"></i> Location: ${userLocation.city}`;
                userLocationElement.style.color = 'var(--primary)';
            } else {
                userLocationElement.innerHTML = `<i class="fas fa-map-marker-alt"></i> Location: Allow access`;
                userLocationElement.style.color = 'var(--text-muted)';
            }
        }

        // Update cart location
        if (cartLocationText) {
            if (userLocation.city) {
                cartLocationText.innerHTML = `
                    <div style="margin-bottom: 5px;">
                        <strong><i class="fas fa-city"></i> ${userLocation.city}</strong>
                    </div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">
                        ${userLocation.address ? userLocation.address.substring(0, 60) + '...' : 'Full address available'}
                    </div>
                    <div style="font-size: 0.75rem; color: var(--accent); margin-top: 5px;">
                        <i class="fas fa-map-pin"></i> Pin: ${userLocation.pinCode}
                    </div>
                `;
            } else {
                cartLocationText.textContent = 'Allow location access for precise delivery';
            }
        }

        // Update my location button
        if (myLocationBtn) {
            if (userLocation.city) {
                myLocationBtn.innerHTML = `<i class="fas fa-location-dot"></i> ${userLocation.city}`;
                myLocationBtn.classList.add('active');
            }
        }
    }

    function updateWeatherForUserLocation() {
        if (userLocation.latitude && userLocation.longitude) {
            // Call the existing weather function with user's coordinates
            if (typeof window.fetchLiveWeather === 'function') {
                // Create a custom city object for user's location
                const userCity = {
                    name: userLocation.city || "Your Location",
                    lat: userLocation.latitude,
                    lon: userLocation.longitude
                };
                
                // Update active city button
                document.querySelectorAll('.city-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Create a temporary active state for my location
                if (myLocationBtn) {
                    myLocationBtn.classList.add('active');
                }
                
                // Update temperature display
                if (document.getElementById('tempLabel')) {
                    document.getElementById('tempLabel').textContent = userLocation.city || "Your Location";
                }
                
                // Fetch weather for user's location
                window.fetchLiveWeather(userCity.name, userCity.lat, userCity.lon);
            }
        }
    }

    function shareVideoWithLocation() {
        const currentUrl = window.location.href.split('#')[0] + '#customer-experience';
        const customerName = document.getElementById('customer-name')?.textContent || 'Mark Chen';
        const customerCompany = document.getElementById('customer-company')?.textContent || 'TechNova Solutions';
        
        let locationText = "";
        if (userLocation.city) {
            locationText = `📍 *My Location:* ${userLocation.city}, ${userLocation.country}
📮 *Pin Code:* ${userLocation.pinCode}
🗺️ *Coordinates:* ${userLocation.latitude?.toFixed(4)}, ${userLocation.longitude?.toFixed(4)}
🏠 *Address:* ${userLocation.address?.substring(0, 80)}...

`;
        } else {
            locationText = "📍 *My Location:* Not shared (Allow location access for precise delivery)\n\n";
        }
        
        const text = `Check out this exclusive interview with ${customerName} from ${customerCompany} on TROY Perfumes!

${locationText}🎥 *Video Link:* ${currentUrl}

#TROYPerfumes #CustomerExperience #LuxuryScents`;
        
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
        window.open(whatsappUrl, '_blank');
        
        // Update share count
        const shareCountElement = document.getElementById('share-count');
        if (shareCountElement) {
            const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
            shareCountElement.textContent = (currentShares + 1).toLocaleString();
        }
    }

    // Get formatted location for WhatsApp messages
    function getFormattedLocation() {
        if (!userLocation.city) {
            return "Location: Not specified (Please allow location access for better service)";
        }
        
        return `📍 *Customer Location Details:*
🏙️ *City:* ${userLocation.city}
🗺️ *Address:* ${userLocation.address}
📮 *Pin Code:* ${userLocation.pinCode}
🌍 *Country:* ${userLocation.country}
📡 *Coordinates:* ${userLocation.latitude?.toFixed(6)}, ${userLocation.longitude?.toFixed(6)}
⏰ *Detected:* ${new Date(userLocation.timestamp).toLocaleString()}`;
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(initLocationSystem, 1000);
    });

    // Make functions available globally
    window.userLocation = userLocation;
    window.getFormattedLocation = getFormattedLocation;
    window.updateUserLocation = requestUserLocation;
    window.shareVideoWithLocation = shareVideoWithLocation;
})();
</script>

<script>
/* === SIMPLIFIED WORKING WEATHER SYSTEM === */
(function() {
    const cityWeatherData = {
        "Lahore": { 
            temp: 24, 
            condition: "mild", 
            recommendation: "Balanced scents with citrus + woods or light oud work best.",
            humidity: 45,
            wind: 12,
            feelsLike: 25
        },
        "Karachi": { 
            temp: 30, 
            condition: "warm", 
            recommendation: "Fresh, aquatic and citrus scents that feel cooling in humidity.",
            humidity: 65,
            wind: 18,
            feelsLike: 32
        },
        "Islamabad": { 
            temp: 20, 
            condition: "cool", 
            recommendation: "Warm, spicy and amber scents feel very cozy in this weather.",
            humidity: 40,
            wind: 10,
            feelsLike: 19
        },
        "Dubai": { 
            temp: 34, 
            condition: "hot", 
            recommendation: "Light but strong projecting fresh scents that survive heat.",
            humidity: 50,
            wind: 15,
            feelsLike: 36
        },
        "London": { 
            temp: 15, 
            condition: "cool", 
            recommendation: "Rich woods, ambers and sweet gourmands for cooler climate.",
            humidity: 70,
            wind: 20,
            feelsLike: 14
        }
    };

    const cityCoords = {
        "Lahore": { lat: 31.5497, lon: 74.3436 },
        "Karachi": { lat: 24.8607, lon: 67.0011 },
        "Islamabad": { lat: 33.6844, lon: 73.0479 },
        "Dubai": { lat: 25.2048, lon: 55.2708 },
        "London": { lat: 51.5074, lon: -0.1278 }
    };

    let tempDisplay, thermometerFill, weatherRecommendation, tempLabel;
    let windSpeedEl, humidityEl, feelsLikeEl;
    let cityButtons, weatherIconContainer, weatherConditionEl;
    let refreshButton;
    let citySearchBtn, citySearchInput;

    function initWeather() {
        tempDisplay = document.getElementById('tempDisplay');
        thermometerFill = document.getElementById('thermometerFill');
        weatherRecommendation = document.getElementById('weatherRecommendation');
        tempLabel = document.getElementById('tempLabel');
        
        windSpeedEl = document.getElementById('windSpeed');
        humidityEl = document.getElementById('humidity');
        feelsLikeEl = document.getElementById('feelsLike');
        
        cityButtons = document.querySelectorAll('.city-btn');
        weatherIconContainer = document.getElementById('weatherIcon');
        weatherConditionEl = document.getElementById('weatherCondition');
        refreshButton = document.getElementById('refreshWeather');
        citySearchBtn = document.getElementById('citySearchBtn');
        citySearchInput = document.getElementById('citySearchInput');
        
        const defaultCity = "Lahore";
        updateCityWeather(defaultCity);
        setupEventListeners();
        fetchLiveWeather(defaultCity);
    }

    function setupEventListeners() {
        cityButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const city = this.dataset.city;
                const lat = this.dataset.lat;
                const lon = this.dataset.lon;
                
                cityButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                updateCityWeather(city);
                fetchLiveWeather(city);
            });
        });
        
        if (refreshButton) {
            refreshButton.addEventListener('click', function() {
                const activeCity = document.querySelector('.city-btn.active');
                if (activeCity) {
                    const city = activeCity.dataset.city;
                    fetchLiveWeather(city);
                    
                    if (tempDisplay) tempDisplay.textContent = "Loading...";
                    if (weatherRecommendation) weatherRecommendation.textContent = "Fetching live weather data...";
                    if (refreshButton) refreshButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
                    
                    setTimeout(() => {
                        if (refreshButton) refreshButton.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh Weather';
                    }, 2000);
                }
            });
        }

        // City search button
        if (citySearchBtn) {
            citySearchBtn.addEventListener('click', function() {
                const cityName = citySearchInput.value.trim();
                if (!cityName) {
                    alert('Please enter a city name');
                    return;
                }
                // Geocode city name to coordinates using Nominatim
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityName)}&limit=1`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const lat = parseFloat(data[0].lat);
                            const lon = parseFloat(data[0].lon);
                            const displayName = data[0].display_name.split(',')[0]; // simple city name
                            // Update active city button (remove active from others)
                            cityButtons.forEach(b => b.classList.remove('active'));
                            // Add a temporary class or just update label
                            tempLabel.textContent = displayName;
                            // Fetch weather using coordinates
                            fetchLiveWeather(displayName, lat, lon);
                        } else {
                            alert('City not found. Please try another name.');
                        }
                    })
                    .catch(err => {
                        console.error('Geocoding error:', err);
                        alert('Could not fetch city data. Please try again.');
                    });
            });
        }
    }

    function updateCityWeather(city) {
        const weather = cityWeatherData[city];
        if (!weather) return;
        
        if (tempDisplay) tempDisplay.textContent = weather.temp + '°C';
        if (tempLabel) tempLabel.textContent = city;
        
        if (thermometerFill) {
            let heightPercent = 100 - ((weather.temp / 40) * 100);
            if (heightPercent < 5) heightPercent = 5;
            if (heightPercent > 95) heightPercent = 95;
            thermometerFill.style.height = heightPercent + '%';
        }
        
        if (weatherRecommendation) {
            weatherRecommendation.textContent = `In ${city}'s ${weather.condition} ${weather.temp}°C, ${weather.recommendation}`;
        }
        
        if (windSpeedEl) windSpeedEl.textContent = `Wind: ${weather.wind} km/h`;
        if (humidityEl) humidityEl.textContent = `Humidity: ${weather.humidity}%`;
        if (feelsLikeEl) feelsLikeEl.textContent = `Feels like: ${weather.feelsLike}°C`;
        
        updateWeatherIcon(weather.condition, weather.temp);
        // After updating weather, also update perfume recommendation
        if (window.updateWeatherPerfumeRecommendation) {
            window.updateWeatherPerfumeRecommendation(weather.temp);
        }
    }

    async function fetchLiveWeather(city, customLat, customLon) {
        let lat, lon;
        
        if (customLat && customLon) {
            lat = customLat;
            lon = customLon;
        } else {
            const coords = cityCoords[city];
            if (!coords) {
                console.log(`No coordinates found for ${city}`);
                return;
            }
            lat = coords.lat;
            lon = coords.lon;
        }
        
        try {
            const apiUrl = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code&timezone=auto`;
            
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.current) {
                const liveTemp = Math.round(data.current.temperature_2m);
                const liveHumidity = data.current.relative_humidity_2m;
                const liveWind = Math.round(data.current.wind_speed_10m);
                const feelsLike = calculateFeelsLike(liveTemp, liveHumidity, liveWind);
                const condition = getWeatherCondition(data.current.weather_code);
                
                if (tempDisplay) tempDisplay.textContent = liveTemp + '°C';
                if (tempLabel) tempLabel.textContent = city;
                
                if (thermometerFill) {
                    let heightPercent = 100 - ((liveTemp / 40) * 100);
                    if (heightPercent < 5) heightPercent = 5;
                    if (heightPercent > 95) heightPercent = 95;
                    thermometerFill.style.height = heightPercent + '%';
                }
                
                if (weatherRecommendation) {
                    const recommendation = getRecommendation(condition, liveTemp);
                    weatherRecommendation.textContent = `In ${city}'s ${condition.toLowerCase()} ${liveTemp}°C, ${recommendation}`;
                }
                
                if (windSpeedEl) windSpeedEl.textContent = `Wind: ${liveWind} km/h`;
                if (humidityEl) humidityEl.textContent = `Humidity: ${liveHumidity}%`;
                if (feelsLikeEl) feelsLikeEl.textContent = `Feels like: ${feelsLike}°C`;
                
                updateWeatherIcon(condition, liveTemp);
                
                // Update perfume recommendation card based on temperature
                if (window.updateWeatherPerfumeRecommendation) {
                    window.updateWeatherPerfumeRecommendation(liveTemp);
                }
                
                console.log(`Live weather updated for ${city}: ${liveTemp}°C`);
            }
        } catch (error) {
            console.log(`Using fallback data for ${city}:`, error.message);
            updateCityWeather(city);
        }
    }

    function calculateFeelsLike(temp, humidity, wind) {
        if (temp >= 27) {
            const feelsLike = temp + 0.05 * humidity;
            return Math.round(feelsLike);
        } else if (temp <= 10 && wind > 15) {
            const feelsLike = 13.12 + 0.6215 * temp - 11.37 * Math.pow(wind, 0.16) + 0.3965 * temp * Math.pow(wind, 0.16);
            return Math.round(feelsLike);
        }
        return temp;
    }

    function getWeatherCondition(weatherCode) {
        if (weatherCode === 0) return "Clear";
        if (weatherCode <= 3) return "Partly cloudy";
        if (weatherCode <= 48) return "Foggy";
        if (weatherCode <= 57) return "Drizzle";
        if (weatherCode <= 67) return "Rain";
        if (weatherCode <= 77) return "Snow";
        if (weatherCode <= 82) return "Rain showers";
        if (weatherCode <= 86) return "Snow showers";
        if (weatherCode <= 99) return "Thunderstorm";
        return "Clear";
    }

    function getRecommendation(condition, temp) {
        if (temp >= 30) {
            return "Perfect for light, fresh fragrances that stay vibrant in the heat.";
        } else if (temp >= 20) {
            return "Ideal for versatile scents that work from day to evening.";
        } else if (temp >= 10) {
            return "Great for warm, cozy fragrances that embrace the cooler air.";
        } else {
            return "Best for rich, intense scents that project well in cold weather.";
        }
    }

    function updateWeatherIcon(condition, temp) {
        if (!weatherIconContainer || !weatherConditionEl) return;
        
        let iconClass = "fas fa-sun";
        let conditionText = condition;
        
        if (condition.includes("Clear")) {
            iconClass = temp > 25 ? "fas fa-sun" : "fas fa-sun";
        } else if (condition.includes("cloud")) {
            iconClass = "fas fa-cloud";
        } else if (condition.includes("Rain") || condition.includes("Drizzle")) {
            iconClass = "fas fa-cloud-rain";
        } else if (condition.includes("Snow")) {
            iconClass = "fas fa-snowflake";
        } else if (condition.includes("Thunderstorm")) {
            iconClass = "fas fa-bolt";
        } else if (condition.includes("Fog")) {
            iconClass = "fas fa-smog";
        }
        
        weatherIconContainer.innerHTML = `<i class="${iconClass}"></i>`;
        weatherConditionEl.textContent = conditionText;
        
        if (temp >= 30) {
            weatherIconContainer.style.color = "#f97316";
        } else if (temp >= 20) {
            weatherIconContainer.style.color = "#eab308";
        } else if (temp >= 10) {
            weatherIconContainer.style.color = "#38bdf8";
        } else {
            weatherIconContainer.style.color = "#60a5fa";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(initWeather, 1000);
    });

    // Make fetchLiveWeather globally available for location system
    window.fetchLiveWeather = fetchLiveWeather;
})();
</script>

<script>
        /*****************************************************************
         * TROY Customer View - SYNCHRONIZED WITH ADMIN PANEL
         * No hardcoded default perfumes – only admin data is shown.
         *****************************************************************/

        // ========== ONE-TIME CLEANUP OF OLD PERFUME DATA ==========
        (function() {
            const CLEANUP_FLAG = 'troy-customer-perfume-cleanup-v1';
            if (!localStorage.getItem(CLEANUP_FLAG)) {
                // List of known keys that might contain perfume data
                const keysToRemove = [
                    'troy-display-perfumes',
                    'troy-perfumes',
                    'troy-perfume-data',
                    'troy-products',
                    'troy-perfume-list',
                    'troy-default-perfumes'
                ];
                keysToRemove.forEach(key => localStorage.removeItem(key));
                
                // Also remove any key containing "perfume" (case-insensitive)
                for (let i = localStorage.length - 1; i >= 0; i--) {
                    const key = localStorage.key(i);
                    if (key && key.toLowerCase().includes('perfume') && !key.includes('cleanup')) {
                        localStorage.removeItem(key);
                    }
                }
                
                localStorage.setItem(CLEANUP_FLAG, 'true');
                console.log('All existing perfume data cleared from localStorage');
            }
        })();

        // Page type detection - set to true for /perfumes page, false for /customer
        const isAllPerfumesPage = window.location.pathname === '/perfumes' || window.location.pathname === '/all-perfumes';
        
        // Limit count for customer page
        const PERFUME_LIMIT = 5;

        // PERFUME DATA (Loaded from admin display data)
        let perfumes = [];

        // Cart
        let cart = [];
        let favorites = [];

        // DOM refs
        const perfumeGrid = document.getElementById('perfumeGrid');
        const cartItems = document.getElementById('cartItems');
        const cartTotalAmount = document.getElementById('cartTotalAmount');
        const cartCount = document.querySelector('.cart-count');
        const cartModal = document.getElementById('cartModal');
        const cartToggle = document.getElementById('cartToggle');
        const closeCart = document.getElementById('closeCart');
        const overlay = document.getElementById('overlay');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const toast = document.getElementById('toast');
        const header = document.getElementById('header');
        const particlesContainer = document.getElementById('particles');
        const jetIcon = document.getElementById('jetIcon');
        const nabiStamp = document.getElementById('nabiStamp');
        const contributionModal = document.getElementById('contributionModal');
        const confirmContribution = document.getElementById('confirmContribution');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileNav = document.getElementById('mobileNav');
        const newsletterForm = document.getElementById('newsletterForm');
        const videoWatermark = document.getElementById('videoWatermark');
        const footerLogo = document.getElementById('footerLogo');

        // Hero section elements (no longer used but kept to avoid errors)
        const heroPerfumeName = document.getElementById('heroPerfumeName');
        const heroPerfumeRating = document.getElementById('heroPerfumeRating');
        const heroPerfumeReviews = document.getElementById('heroPerfumeReviews');
        const heroPerfumePrice = document.getElementById('heroPerfumePrice');
        const heroNote1 = document.getElementById('heroNote1');
        const heroNote2 = document.getElementById('heroNote2');
        const heroNote3 = document.getElementById('heroNote3');

        // Mood Match Modal elements
        const moodMatchModal = document.getElementById('moodMatchModal');
        const moodMatchLink = document.getElementById('moodMatchLink');
        const mobileMoodMatchLink = document.getElementById('mobileMoodMatchLink');
        const closeMoodMatch = document.getElementById('closeMoodMatch');

        // Location system
        let userLocation = window.userLocation || {
            city: null,
            address: null,
            pinCode: null,
            latitude: null,
            longitude: null
        };

        // Weather perfume card elements
        const weatherPerfumeImg = document.getElementById('weatherPerfumeImg');
        const weatherPerfumeName = document.getElementById('weatherPerfumeName');
        const weatherPerfumePrice = document.getElementById('weatherPerfumePrice');
        const weatherPerfumeBadge = document.getElementById('weatherPerfumeBadge');

        // Helper function to get temperature display for a perfume
        function getTemperatureDisplay(p) {
            if (p.recommendedTemperature) return p.recommendedTemperature;
            // fallback based on weather array
            if (p.weather && Array.isArray(p.weather)) {
                if (p.weather.includes('hot')) return 'Above 30°C';
                if (p.weather.includes('warm')) return '20-30°C';
                if (p.weather.includes('mild')) return '15-25°C';
                if (p.weather.includes('cool')) return '10-20°C';
                if (p.weather.includes('cold')) return 'Below 10°C';
            }
            return 'All weathers';
        }

        // Parse temperature range like "Below 21°C", "20-30°C", "Above 30°C"
        function parseTemperatureRange(rangeStr) {
            if (!rangeStr) return null;
            rangeStr = rangeStr.replace(/\s+/g, '').toLowerCase();
            let min = -Infinity, max = Infinity;
            if (rangeStr.includes('-')) {
                const parts = rangeStr.split('-');
                if (parts.length === 2) {
                    min = parseFloat(parts[0]) || -Infinity;
                    max = parseFloat(parts[1]) || Infinity;
                }
            } else if (rangeStr.includes('below') || rangeStr.includes('<')) {
                const num = parseFloat(rangeStr) || parseFloat(rangeStr.split('below')[1]) || parseFloat(rangeStr.split('<')[1]);
                if (!isNaN(num)) max = num;
            } else if (rangeStr.includes('above') || rangeStr.includes('>') || rangeStr.includes('+')) {
                const num = parseFloat(rangeStr) || parseFloat(rangeStr.split('above')[1]) || parseFloat(rangeStr.split('>')[1]) || parseFloat(rangeStr.split('+')[0]);
                if (!isNaN(num)) min = num;
            } else {
                const num = parseFloat(rangeStr);
                if (!isNaN(num)) { min = num; max = num; }
            }
            return { min, max };
        }

        // Find a perfume whose recommended temperature range includes the given temperature
        function findPerfumeByTemperature(temp) {
            if (!perfumes || perfumes.length === 0) return null;
            for (let p of perfumes) {
                if (p.recommendedTemperature) {
                    const range = parseTemperatureRange(p.recommendedTemperature);
                    if (range && temp >= range.min && temp <= range.max) {
                        return p;
                    }
                }
            }
            return null;
        }

        // Update the weather perfume card
        function updateWeatherPerfumeCard(temp) {
            if (!weatherPerfumeImg || !weatherPerfumeName || !weatherPerfumePrice || !weatherPerfumeBadge) return;
            const perfume = findPerfumeByTemperature(temp);
            if (perfume) {
                weatherPerfumeImg.src = perfume.images && perfume.images[0] ? perfume.images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800';
                weatherPerfumeName.textContent = perfume.name;
                weatherPerfumePrice.textContent = `Rs ${perfume.price.toLocaleString()}`;
                weatherPerfumeBadge.textContent = `Recommended for ${temp}°C`;
            } else {
                weatherPerfumeImg.src = 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800';
                weatherPerfumeName.textContent = 'No match found';
                weatherPerfumePrice.textContent = '';
                weatherPerfumeBadge.textContent = 'Try a different city';
            }
        }

        // Make it globally accessible
        window.updateWeatherPerfumeRecommendation = updateWeatherPerfumeCard;

        // Helper functions
        function scrollToSection(selector) {
            const element = document.querySelector(selector);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
                mobileNav.classList.remove('active');
            }
        }

        function openMoodMatch() {
            moodMatchModal.classList.add('active');
            mobileNav.classList.remove('active');
        }

        function closeMoodMatchModal() {
            moodMatchModal.classList.remove('active');
        }

        function loadAdminData() {
            try {
                // Fetch perfumes from database API
                console.log('Fetching perfumes from API...');
                fetch('/api/perfumes')
                    .then(response => {
                        console.log('API Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('API Response data:', data);
                        if (data.success && data.perfumes && data.perfumes.length > 0) {
                            console.log('Found ' + data.perfumes.length + ' perfumes');
                            perfumes = data.perfumes.map(p => ({
                                id: p.id,
                                name: p.name || "Untitled Perfume",
                                price: p.price || 0,
                                images: p.images && p.images.length > 0 ? p.images : ["https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800"],
                                description: p.description || "A premium fragrance for all occasions.",
                                notes: p.notes || ["Fragrance", "Premium"],
                                weather: ["mild", "warm"],
                                cities: p.city ? [p.city] : ["Lahore", "Karachi"],
                                rating: p.rating || 4.5,
                                city: p.city || "Lahore",
                                moods: ["neutral"],
                                recommendedTemperature: p.recommended_temperature || getTemperatureDisplay(p),
                                createdAt: new Date().toISOString()
                            }));
                            
                            // Store in localStorage for offline use
                            localStorage.setItem('troy-display-perfumes', JSON.stringify(perfumes));
                            
                            // Update hero section with first perfume
                            if (perfumes.length > 0 && heroPerfumeName) {
                                updateHeroSection(perfumes[0]);
                            }
                        } else {
                            // Fallback to localStorage
                            loadFromLocalStorage();
                        }
                        
                        // After perfumes are loaded, update weather recommendation
                        const tempEl = document.getElementById('tempDisplay');
                        if (tempEl) {
                            let tempText = tempEl.textContent;
                            let temp = parseInt(tempText) || 24;
                            updateWeatherPerfumeCard(temp);
                        }
                        
                        console.log('Calling renderPerfumes with ' + perfumes.length + ' perfumes');
                        renderPerfumes(perfumes);
                    })
                    .catch(error => {
                        console.error('Error fetching from API:', error);
                        // Fallback to localStorage
                        loadFromLocalStorage();
                    });
                
                // Load cart from localStorage
                const savedCart = localStorage.getItem('troy-cart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                    updateCartUI();
                }
                
                // Load favorites from localStorage
                const savedFavorites = localStorage.getItem('troy-favorites');
                if (savedFavorites) {
                    favorites = JSON.parse(savedFavorites);
                }
                
                // Load images from admin display data
                loadWebsiteImages();
                
                // Load user location
                const savedLocation = localStorage.getItem('troy-user-location');
                if (savedLocation) {
                    userLocation = JSON.parse(savedLocation);
                }
                
            } catch (error) {
                console.error('Error loading admin data:', error);
                loadFromLocalStorage();
            }
        }
        
        function loadFromLocalStorage() {
            // Fallback: Load perfumes from localStorage
            const storedPerfumes = localStorage.getItem('troy-display-perfumes');
            if (storedPerfumes) {
                const adminPerfumes = JSON.parse(storedPerfumes);
                if (Array.isArray(adminPerfumes) && adminPerfumes.length > 0) {
                    perfumes = adminPerfumes;
                    if (perfumes.length > 0 && heroPerfumeName) {
                        updateHeroSection(perfumes[0]);
                    }
                }
            }
            renderPerfumes(perfumes);
        }

        function updateHeroSection(perfume) {
            // This function is now optional – we keep it but it won't be used because hero section elements are removed.
            if (!perfume || !heroPerfumeName) return;
            
            heroPerfumeName.textContent = perfume.name;
            heroPerfumeRating.textContent = perfume.rating || "4.9";
            heroPerfumeReviews.textContent = "320+";
            heroPerfumePrice.textContent = `Rs ${perfume.price.toLocaleString()}`;
            
            if (perfume.notes && perfume.notes.length >= 3) {
                heroNote1.textContent = perfume.notes[0];
                heroNote2.textContent = `${perfume.notes[1]} · ${perfume.notes[2]}`;
                heroNote3.textContent = perfume.notes.length > 3 ? `${perfume.notes[3]} · ${perfume.notes[4] || 'Musk'}` : 'Amber · Musk';
            }
            
            const heroTag = document.querySelector('.hero-perfume-tag');
            if (heroTag) {
                heroTag.textContent = `Bestseller · ${perfume.city || 'Lahore'}`;
            }
        }

        function loadWebsiteImages() {
            try {
                const storedImages = localStorage.getItem('troy-display-images');
                if (!storedImages) return;
                
                const imageData = JSON.parse(storedImages);
                
                // Update logo
                if (imageData.logo && imageData.logo.src) {
                    const logoImg = document.querySelector('.logo img');
                    if (logoImg) {
                        logoImg.src = imageData.logo.src;
                        logoImg.alt = imageData.logo.alt || 'TROY Logo';
                    }
                    
                    // Update footer logo
                    if (footerLogo) {
                        footerLogo.src = imageData.logo.src;
                        footerLogo.alt = imageData.logo.alt || 'TROY Logo';
                    }
                    
                    // Update video watermark
                    if (videoWatermark) {
                        videoWatermark.src = imageData.logo.src;
                        videoWatermark.alt = imageData.logo.alt || 'TROY Logo';
                    }
                }
                
                // Update hero image (if present)
                if (imageData.hero && imageData.hero.src) {
                    const heroImg = document.querySelector('.hero-perfume-img img');
                    if (heroImg) {
                        heroImg.src = imageData.hero.src;
                        heroImg.alt = imageData.hero.alt || 'TROY Hero Image';
                    }
                }
                
            } catch (e) {
                console.error('Error loading website images:', e);
            }
        }

        function createParticles() {
            if (!particlesContainer) return;
            
            const count = 45;
            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle-bg');
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = (Math.random() * 100) + '%';
                particle.style.animationDelay = (Math.random() * 18) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        function handleScroll() {
            if(window.scrollY > 40){
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        }

        function setupEventListeners() {
            // Cart toggle
            cartToggle.addEventListener('click', toggleCart);
            closeCart.addEventListener('click', toggleCart);
            overlay.addEventListener('click', toggleCart);
            
            // Checkout with contribution modal
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function() {
                    if(cart.length === 0){
                        showToast('Your cart is empty!');
                        return;
                    }
                    contributionModal.classList.add('active');
                });
            }

            // Contribution modal
            if (nabiStamp) {
                nabiStamp.addEventListener('click', function() {
                    contributionModal.classList.add('active');
                });
            }
            
            if (confirmContribution) {
                confirmContribution.addEventListener('click', function() {
                    contributionModal.classList.remove('active');
                    proceedToCheckout();
                });
            }
            
            // Close modal when clicking outside
            contributionModal.addEventListener('click', function(e) {
                if (e.target === contributionModal) {
                    contributionModal.classList.remove('active');
                }
            });

            // Mood Match modal
            if (moodMatchLink) {
                moodMatchLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    openMoodMatch();
                });
            }
            
            if (mobileMoodMatchLink) {
                mobileMoodMatchLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    openMoodMatch();
                });
            }
            
            if (closeMoodMatch) {
                closeMoodMatch.addEventListener('click', closeMoodMatchModal);
            }
            
            // Close mood match modal when clicking outside
            moodMatchModal.addEventListener('click', function(e) {
                if (e.target === moodMatchModal) {
                    closeMoodMatchModal();
                }
            });

            // Mobile menu toggle
            if (mobileMenuToggle && mobileNav) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileNav.classList.toggle('active');
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (mobileNav.classList.contains('active') && 
                        !mobileNav.contains(e.target) && 
                        !mobileMenuToggle.contains(e.target)) {
                        mobileNav.classList.remove('active');
                    }
                });
                
                // Close mobile menu when clicking a link
                mobileNav.querySelectorAll('.mobile-nav-link').forEach(link => {
                    link.addEventListener('click', function() {
                        mobileNav.classList.remove('active');
                    });
                });
            }

            // Newsletter form
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('input[type="email"]').value;
                    if (email && email.includes('@')) {
                        showToast('Thank you for subscribing!');
                        this.reset();
                    } else {
                        showToast('Please enter a valid email address.');
                    }
                });
            }

            // Event delegation for Buy Now and Add to Cart buttons
            document.addEventListener('click', function(e) {
                // Handle Buy Now buttons
                if (e.target.closest('.btn-buy')) {
                    e.preventDefault();
                    e.stopPropagation();
                    const button = e.target.closest('.btn-buy');
                    const id = parseInt(button.getAttribute('data-id'));
                    if (id) buyNow(id);
                }
                
                // Handle Add to Cart buttons
                if (e.target.closest('.btn-primary') && !e.target.closest('.btn-buy')) {
                    e.preventDefault();
                    e.stopPropagation();
                    const button = e.target.closest('.btn-primary');
                    const id = parseInt(button.getAttribute('data-id'));
                    if (id) addToCart(id, button);
                }
                
                // Handle Favorite buttons
                if (e.target.closest('.btn-favorite')) {
                    e.preventDefault();
                    e.stopPropagation();
                    const button = e.target.closest('.btn-favorite');
                    const id = parseInt(button.getAttribute('data-id'));
                    if (id) toggleFavorite(id, button);
                }
            });
        }

        // Load perfumes for selected city
        function loadPerfumesForCity(city) {
            // Show all perfumes (no filtering for simplicity)
            renderPerfumes(perfumes);
        }

        function renderPerfumes(perfumesToRender) {
            console.log('renderPerfumes called with:', perfumesToRender);
            if (!perfumeGrid) {
                console.error('perfumeGrid element not found!');
                return;
            }
            console.log('perfumeGrid found, rendering...');
            
            perfumeGrid.innerHTML = '';

            if (!perfumesToRender || perfumesToRender.length === 0) {
                perfumeGrid.innerHTML = '<div class="no-perfumes" style="text-align: center; padding: 2rem; color: var(--text-muted);">No perfumes found. Please check admin panel.</div>';
                return;
            }

            // Limit perfumes on customer page (not on /perfumes page)
            let limitedPerfumes = perfumesToRender;
            let showViewAllButton = false;
            
            if (!isAllPerfumesPage && perfumesToRender.length > PERFUME_LIMIT) {
                limitedPerfumes = perfumesToRender.slice(0, PERFUME_LIMIT);
                showViewAllButton = true;
                // Add CSS class to limit grid to 5 items
                perfumeGrid.classList.add('limit-5');
            } else {
                perfumeGrid.classList.remove('limit-5');
            }

            limitedPerfumes.forEach((p, idx) => {
                const isFavorite = favorites.includes(p.id);
                const images = p.images || ["https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800"];
                const tempDisplay = getTemperatureDisplay(p);
                
                const card = document.createElement('div');
                card.className = 'perfume-card';
                card.innerHTML = `
                    <div class="perfume-image">
                        <div class="perfume-image-inner">
                            <div class="perfume-image-front">
                                <img src="${images[0]}" alt="${p.name} - TROY Perfume" data-img-index="0">
                                <div class="perfume-badge">${Number(p.rating) >= 4.5 ? 'Top rated' : p.city || 'City special'}</div>
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHZpZXdCb3g9IjAgMCAzMCAzMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE1IDBDNi43MTcgMCAwIDYuNzE3IDAgMTVTMTAuNzE3IDMwIDE1IDMwUzMwIDIzLjI4MyAzMCAxNVMxNSAwIDE1IDBaIiBmaWxsPSIjMjJjNTUiLz4KPHBhdGggZD0iTTExIDExSDhWMTlIMTBWMTFaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMTkgMTFIMTZWMTlIMTlWMTFaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMjIgMTlIMTlWMjJIMTlWMTlaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4=" alt="TROY Logo" class="perfume-logo">
                            </div>
                            <div class="perfume-image-back">
                                <h4>Fragrance Details</h4>
                                <div class="perfume-notes">
                                    ${p.notes ? p.notes.map(n => `<span class="note-tag">${n}</span>`).join('') : ''}
                                </div>
                                <div class="perfume-meta">
                                    ${p.city ? `City: ${p.city}` : ''}${p.rating ? ` · Rating: ${p.rating}` : ''}
                                </div>
                                <p class="flip-instruction">Hover to flip back</p>
                            </div>
                        </div>
                    </div>
                    <div class="perfume-info">
                        <div class="perfume-title-row">
                            <h3 class="perfume-name">${p.name}</h3>
                            <div class="perfume-price">Rs ${p.price.toLocaleString()}</div>
                        </div>
                        <p class="perfume-desc">${p.description || ''}</p>
                        <!-- Temperature info line -->
                        <div class="perfume-temperature">
                            <i class="fas fa-thermometer-half"></i> ${tempDisplay}
                        </div>
                        <div class="perfume-actions">
                            <button class="btn-buy" onclick='buyNow(${JSON.stringify(p)})'>
                                <i class="fab fa-whatsapp"></i> Buy
                            </button>
                            <button class="btn-primary" onclick='addToCart(${JSON.stringify(p)})'>
                                <i class="fas fa-shopping-bag"></i> Add
                            </button>
                            <button class="btn-favorite ${isFavorite ? 'active' : ''}" data-id="${p.id}">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                // Add image flip functionality if multiple images exist
                const imageInner = card.querySelector('.perfume-image-inner');
                const frontImage = card.querySelector('.perfume-image-front img');
                
                if (images.length > 1) {
                    imageInner.dataset.imgIndex = "0";
                    imageInner.dataset.img0 = images[0];
                    imageInner.dataset.img1 = images[1];

                    card.addEventListener("mouseenter", () => {
                        imageInner.dataset.imgIndex = "1";
                        frontImage.src = imageInner.dataset.img1;
                        frontImage.classList.add("flipped");
                    });
                    
                    card.addEventListener("mouseleave", () => {
                        imageInner.dataset.imgIndex = "0";
                        frontImage.src = imageInner.dataset.img0;
                        frontImage.classList.remove("flipped");
                    });
                }

                perfumeGrid.appendChild(card);
            });
            
            // Add "View All" button if there are more perfumes
            // First, remove any existing "View All" button to prevent duplicates
            const existingViewAll = document.querySelector('.view-all-container');
            if (existingViewAll) {
                existingViewAll.remove();
            }
            if (showViewAllButton) {
                const viewAllContainer = document.createElement('div');
                viewAllContainer.className = 'view-all-container';
                viewAllContainer.innerHTML = `
                    <a href="/perfumes" class="view-all-btn">
                        View All Perfumes
                        <i class="fas fa-arrow-right"></i>
                    </a>
                `;
                perfumeGrid.parentNode.insertBefore(viewAllContainer, perfumeGrid.nextSibling);
            }
        }

        function toggleFavorite(id, button) {
            if(favorites.includes(id)){
                favorites = favorites.filter(f => f !== id);
                button.classList.remove('active');
            }else{
                favorites.push(id);
                button.classList.add('active');
            }
            // Save favorites to localStorage
            try {
                localStorage.setItem('troy-favorites', JSON.stringify(favorites));
            } catch (e) {
                console.error('Error saving favorites:', e);
            }
        }

        function addToCart(perfume, sourceButton = null) {
            if(!perfume) {
                console.error('Perfume not found');
                return;
            }

            const id = perfume.id;
            const existing = cart.find(item => item.id === id);
            if(existing){
                existing.quantity += 1;
            }else{
                cart.push({ ...perfume, quantity:1 });
            }
            updateCartUI();
            animateJet(sourceButton);
            showToast(`${perfume.name} added to cart`);
        }

        function animateJet(sourceButton) {
            if(!sourceButton || !jetIcon) return;

            const btnRect = sourceButton.getBoundingClientRect();
            const cartRect = cartToggle.getBoundingClientRect();

            const startX = btnRect.left + btnRect.width / 2;
            const startY = btnRect.top + btnRect.height / 2;

            const endX = cartRect.left + cartRect.width / 2;
            const endY = cartRect.top + cartRect.height / 2;

            const deltaX = endX - startX;
            const deltaY = endY - startY;

            jetIcon.style.left = startX + 'px';
            jetIcon.style.top = startY + 'px';
            jetIcon.style.setProperty('--jet-x', deltaX + 'px');
            jetIcon.style.setProperty('--jet-y', deltaY + 'px');

            jetIcon.classList.remove('jet-animate');
            void jetIcon.offsetWidth;
            jetIcon.classList.add('jet-animate');
        }

        function updateCartUI() {
            if (!cartItems || !cartTotalAmount || !cartCount) return;
            
            cartItems.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                cartItems.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--text-muted);">Your cart is empty</div>';
            } else {
                cart.forEach(item => {
                    const line = item.price * item.quantity;
                    total += line;

                    const row = document.createElement('div');
                    row.className = 'cart-item';
                    row.innerHTML = `
                        <div class="cart-thumb">
                            <img src="${item.images ? item.images[0] : item.image}" alt="${item.name}">
                        </div>
                        <div class="cart-info">
                            <div class="cart-name">${item.name}</div>
                            <div class="cart-meta">Rs ${item.price.toLocaleString()} x ${item.quantity}</div>
                            <div class="cart-qty">
                                <button class="qty-btn" data-action="minus">-</button>
                                <span>${item.quantity}</span>
                                <button class="qty-btn" data-action="plus">+</button>
                                <button class="remove-item">Remove</button>
                            </div>
                        </div>
                    `;
                    const minusBtn = row.querySelector('[data-action="minus"]');
                    const plusBtn = row.querySelector('[data-action="plus"]');
                    const removeBtn = row.querySelector('.remove-item');

                    minusBtn.addEventListener('click', () => {
                        if(item.quantity > 1){
                            item.quantity--;
                        }else{
                            cart = cart.filter(c => c.id !== item.id);
                        }
                        updateCartUI();
                    });
                    plusBtn.addEventListener('click', () => {
                        item.quantity++;
                        updateCartUI();
                    });
                    removeBtn.addEventListener('click', () => {
                        cart = cart.filter(c => c.id !== item.id);
                        updateCartUI();
                    });

                    cartItems.appendChild(row);
                });
            }

            cartTotalAmount.textContent = 'Rs ' + total.toLocaleString();
            cartCount.textContent = cart.reduce((sum, i) => sum + i.quantity, 0);
            
            // Save cart to localStorage
            try {
                localStorage.setItem('troy-cart', JSON.stringify(cart));
            } catch (e) {
                console.error('Error saving cart:', e);
            }
        }

        function toggleCart() {
            if (cartModal) cartModal.classList.toggle('open');
            if (overlay) overlay.classList.toggle('active');
            if (mobileNav) mobileNav.classList.remove('active');
        }

        function clearCart() {
            cart = [];
            updateCartUI();
            showToast('Cart cleared');
        }

        function getCurrentCity() {
            // Try to use user's location first
            if (userLocation && userLocation.city) {
                return userLocation.city;
            }
            
            // Fallback to selected city in weather widget
            const activeCity = document.querySelector('.city-btn.active');
            return activeCity ? activeCity.dataset.city : 'Lahore';
        }

        function proceedToCheckout() {
            const city = getCurrentCity();
            let message = '🛒 *TROY PERFUMES ORDER* 🛒%0a%0a';
            
            // Add location section if available
            if (userLocation && userLocation.city) {
                message += '📍 *CUSTOMER LOCATION DETAILS:*%0a';
                message += `🏙️ *City:* ${userLocation.city}%0a`;
                message += `🗺️ *Address:* ${userLocation.address || 'Not specified'}%0a`;
                message += `📮 *Pin Code:* ${userLocation.pinCode || 'N/A'}%0a`;
                if (userLocation.latitude && userLocation.longitude) {
                    message += `🌍 *Coordinates:* ${userLocation.latitude.toFixed(6)}, ${userLocation.longitude.toFixed(6)}%0a`;
                }
                message += '%0a';
            } else {
                message += `📍 *Customer City:* ${city}%0a`;
                message += '*Note:* Location not shared. Allow location access for precise delivery.%0a%0a';
            }
            
            message += '📦 *ORDER DETAILS:*%0a';
            message += '────────────────────%0a';

            let total = 0;
            cart.forEach(item => {
                const line = item.price * item.quantity;
                total += line;
                message += `• ${item.name} x ${item.quantity} = Rs ${line.toLocaleString()}%0a`;
            });
            
            message += '%0a';
            message += `💰 *Subtotal:* Rs ${total.toLocaleString()}%0a`;
            message += `🤲 *Contribution (2%):* Rs ${Math.round(total * 0.02).toLocaleString()}%0a`;
            message += `💳 *Total Amount:* Rs ${(total + Math.round(total * 0.02)).toLocaleString()}%0a%0a`;
            
            message += '📞 *Contact for delivery:* 0314-0063717%0a';
            message += '⏰ *Delivery Time:* 3-5 business days%0a';
            message += '🚚 *Free delivery* on orders above Rs 5,000%0a%0a';
            
            message += '🙏 *Note:* 2% of order value will be contributed in the name of Allah.%0a';
            message += 'Thank you for choosing TROY Perfumes! 🌹';

            const url = `https://wa.me/923140063717?text=${message}`;
            window.open(url, '_blank');
            showToast('Order sent on WhatsApp with location details');
            clearCart();
            toggleCart();
        }

        function buyNow(perfume) {
            if(!perfume) {
                console.error('Perfume not found');
                return;
            }

            const id = perfume.id;
            const city = getCurrentCity();
            let message = '🛒 *TROY PERFUMES - BUY NOW* 🛒%0a%0a';
            
            // Add location section if available
            if (userLocation && userLocation.city) {
                message += '📍 *CUSTOMER LOCATION DETAILS:*%0a';
                message += `🏙️ *City:* ${userLocation.city}%0a`;
                message += `🗺️ *Address:* ${userLocation.address || 'Not specified'}%0a`;
                message += `📮 *Pin Code:* ${userLocation.pinCode || 'N/A'}%0a`;
                if (userLocation.latitude && userLocation.longitude) {
                    message += `🌍 *Coordinates:* ${userLocation.latitude.toFixed(6)}, ${userLocation.longitude.toFixed(6)}%0a`;
                }
                message += '%0a';
            } else {
                message += `📍 *Customer City:* ${city}%0a`;
                message += '*Note:* Location not shared. Allow location access for precise delivery.%0a%0a';
            }
            
            message += '📦 *PRODUCT DETAILS:*%0a';
            message += '────────────────────%0a';
            message += `• ${perfume.name} x 1 = Rs ${perfume.price.toLocaleString()}%0a%0a`;
            
            message += `💰 *Subtotal:* Rs ${perfume.price.toLocaleString()}%0a`;
            message += `🤲 *Contribution (2%):* Rs ${Math.round(perfume.price * 0.02).toLocaleString()}%0a`;
            message += `💳 *Total Amount:* Rs ${(perfume.price + Math.round(perfume.price * 0.02)).toLocaleString()}%0a%0a`;
            
            message += '📞 *Contact for delivery:* 0314-0063717%0a';
            message += '⏰ *Delivery Time:* 3-5 business days%0a';
            message += '🚚 *Free delivery* on orders above Rs 5,000%0a%0a';
            
            message += '🙏 *Note:* 2% of order value will be contributed in the name of Allah.%0a';
            message += 'Thank you for choosing TROY Perfumes! 🌹';

            const url = `https://wa.me/923140063717?text=${message}`;
            window.open(url, '_blank');
            showToast(`Order for ${perfume.name} sent on WhatsApp`);
        }

        function showToast(text) {
            if (!toast) return;
            
            const span = toast.querySelector('.toast-message');
            if (span) span.textContent = text;
            toast.classList.add('active');
            setTimeout(() => {
                if (toast) toast.classList.remove('active');
            }, 2800);
        }

        // Check authentication status
        function checkAuthStatus() {
            fetch('/api/user')
                .then(response => response.json())
                .then(data => {
                    if (data.authenticated) {
                        isLoggedIn = true;
                        currentUser = data.user;
                        updateAuthUI(true, data.user);
                    } else {
                        isLoggedIn = false;
                        currentUser = null;
                        updateAuthUI(false);
                    }
                })
                .catch(() => {
                    isLoggedIn = false;
                    updateAuthUI(false);
                });
        }

        function updateAuthUI(loggedIn, user = null) {
            const loginBtn = document.getElementById('loginBtn');
            const registerBtn = document.getElementById('registerBtn');
            const userMenu = document.getElementById('userMenu');
            
            if (loggedIn && user) {
                if (loginBtn) loginBtn.style.display = 'none';
                if (registerBtn) registerBtn.style.display = 'none';
                if (userMenu) {
                    userMenu.style.display = 'flex';
                    const userNameEl = userMenu.querySelector('.user-name');
                    if (userNameEl) userNameEl.textContent = user.name;
                }
            } else {
                if (loginBtn) loginBtn.style.display = 'flex';
                if (registerBtn) registerBtn.style.display = 'flex';
                if (userMenu) userMenu.style.display = 'none';
            }
        }

        function logout() {
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                isLoggedIn = false;
                currentUser = null;
                updateAuthUI(false);
                showToast('Logged out successfully!');
            });
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', () => {
            // Check authentication status
            checkAuthStatus();
            
            // Load data from admin panel first
            loadAdminData();
            
            // Then initialize the page with the loaded data
            loadPerfumesForCity('Lahore');
            setupEventListeners();
            createParticles();
            window.addEventListener('scroll', handleScroll);
            
            // Set initial scroll state
            handleScroll();
            
            // Initialize Mood Match system
            initializeMoodMatch();
            
            // Check for admin data updates periodically (every 5 seconds)
            setInterval(() => {
                loadAdminData();
            }, 5000);
        });
    </script>

<!-- CUSTOMER EXPERIENCE JAVASCRIPT -->
<script>
        // ========== NEON SPARKLING BACKGROUND ==========
        function createSparkles() {
            const container = document.getElementById('sparkles-container');
            if (!container) return;
            
            const sparkleCount = 30;
            
            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                
                const size = Math.random() * 6 + 2;
                sparkle.style.width = `${size}px`;
                sparkle.style.height = `${size}px`;
                sparkle.style.left = `${Math.random() * 100}%`;
                sparkle.style.top = `${Math.random() * 100}%`;
                
                sparkle.style.animationDelay = `${Math.random() * 3}s`;
                sparkle.style.animationDuration = `${Math.random() * 2 + 2}s`;
                
                const colors = ['#00f3ff', '#9d00ff', '#00ff9d', '#ff009d'];
                sparkle.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                container.appendChild(sparkle);
            }
        }
        
        // ========== AUTO-INCREMENTING STATS ==========
        function autoIncrementStats() {
            setInterval(() => {
                const viewIncrement = Math.floor(Math.random() * 10) + 5;
                const viewCountElement = document.getElementById('view-count');
                if (viewCountElement) {
                    const currentViews = parseInt(viewCountElement.textContent.replace(/,/g, '')) || 15842;
                    viewCountElement.textContent = (currentViews + viewIncrement).toLocaleString();
                }
                
                if (Math.random() > 0.7) {
                    const likeIncrement = Math.floor(Math.random() * 3) + 1;
                    const likeCountElement = document.getElementById('like-count');
                    if (likeCountElement) {
                        const currentLikes = parseInt(likeCountElement.textContent.replace(/,/g, '')) || 2847;
                        likeCountElement.textContent = (currentLikes + likeIncrement).toLocaleString();
                        
                        const likesStat = document.getElementById('likes-stat');
                        if (likesStat) {
                            likesStat.style.transform = 'scale(1.1)';
                            setTimeout(() => {
                                likesStat.style.transform = 'scale(1)';
                            }, 300);
                        }
                    }
                }
                
                if (Math.random() > 0.9) {
                    const shareIncrement = Math.floor(Math.random() * 2) + 1;
                    const shareCountElement = document.getElementById('share-count');
                    if (shareCountElement) {
                        const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
                        shareCountElement.textContent = (currentShares + shareIncrement).toLocaleString();
                    }
                }
            }, 10000);
        }
        
        // ========== SHARE FUNCTIONALITY FOR ALL USERS ==========
        function setupShareButtons() {
            const shareButtons = document.querySelectorAll('.share-btn');
            const copyLinkBtn = document.getElementById('copy-link-btn');
            const currentUrl = window.location.href.split('#')[0] + '#customer-experience';
            
            // Facebook Share
            const facebookBtn = document.querySelector('.share-btn.facebook');
            if (facebookBtn) {
                facebookBtn.addEventListener('click', function() {
                    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`;
                    window.open(facebookUrl, '_blank', 'width=600,height=400');
                    
                    const shareCountElement = document.getElementById('share-count');
                    if (shareCountElement) {
                        const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
                        shareCountElement.textContent = (currentShares + 1).toLocaleString();
                    }
                });
            }
            
            // Twitter Share
            const twitterBtn = document.querySelector('.share-btn.twitter');
            if (twitterBtn) {
                twitterBtn.addEventListener('click', function() {
                    const customerName = document.getElementById('customer-name')?.textContent || 'Mark Chen';
                    const customerCompany = document.getElementById('customer-company')?.textContent || 'TechNova Solutions';
                    const text = `Check out this exclusive interview with ${customerName} from ${customerCompany} on TROY Perfumes!`;
                    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(currentUrl)}`;
                    window.open(twitterUrl, '_blank', 'width=600,height=400');
                    
                    const shareCountElement = document.getElementById('share-count');
                    if (shareCountElement) {
                        const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
                        shareCountElement.textContent = (currentShares + 1).toLocaleString();
                    }
                });
            }
            
            // WhatsApp Share (updated to include location)
            const whatsappBtn = document.querySelector('.share-btn.whatsapp');
            if (whatsappBtn) {
                whatsappBtn.addEventListener('click', function() {
                    // Use the global location sharing function
                    if (typeof window.shareVideoWithLocation === 'function') {
                        window.shareVideoWithLocation();
                    } else {
                        // Fallback if function not available
                        const text = `Check out this exclusive interview on TROY Perfumes: ${currentUrl}`;
                        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
                        window.open(whatsappUrl, '_blank');
                        
                        const shareCountElement = document.getElementById('share-count');
                        if (shareCountElement) {
                            const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
                            shareCountElement.textContent = (currentShares + 1).toLocaleString();
                        }
                    }
                });
            }
            
            // Copy Link
            if (copyLinkBtn) {
                copyLinkBtn.addEventListener('click', function() {
                    navigator.clipboard.writeText(currentUrl).then(() => {
                        const originalText = copyLinkBtn.innerHTML;
                        copyLinkBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                        copyLinkBtn.style.background = '#4CAF50';
                        copyLinkBtn.style.color = 'white';
                        
                        const shareCountElement = document.getElementById('share-count');
                        if (shareCountElement) {
                            const currentShares = parseInt(shareCountElement.textContent.replace(/,/g, '')) || 1429;
                            shareCountElement.textContent = (currentShares + 1).toLocaleString();
                        }
                        
                        setTimeout(() => {
                            copyLinkBtn.innerHTML = originalText;
                            copyLinkBtn.style.background = '';
                            copyLinkBtn.style.color = '';
                        }, 2000);
                    });
                });
            }
            
            // Like button functionality
            const likesStat = document.getElementById('likes-stat');
            if (likesStat) {
                likesStat.addEventListener('click', function() {
                    if (!this.classList.contains('liked')) {
                        this.classList.add('liked');
                        const likeCountElement = document.getElementById('like-count');
                        if (likeCountElement) {
                            const currentLikes = parseInt(likeCountElement.textContent.replace(/,/g, '')) || 2847;
                            likeCountElement.textContent = (currentLikes + 1).toLocaleString();
                        }
                        
                        this.style.transform = 'scale(1.2)';
                        this.style.background = 'rgba(255, 0, 0, 0.2)';
                        
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                            this.style.background = '';
                        }, 500);
                    }
                });
            }
        }
        
        // ========== AUDIO CONTROLS FOR CUSTOMER VIDEO ==========
        function setupAudioControls() {
            const video = document.querySelector('.current-video');
            const playPauseBtn = document.getElementById('playPauseBtn');
            const volumeSlider = document.getElementById('volumeSlider');

            if (!video || !playPauseBtn) return;

            video.volume = 0.7;

            playPauseBtn.addEventListener('click', function() {
                if (video.paused) {
                    video.play();
                    this.innerHTML = '<i class="fas fa-pause"></i>';
                } else {
                    video.pause();
                    this.innerHTML = '<i class="fas fa-play"></i>';
                }
            });

            if (volumeSlider) {
                volumeSlider.addEventListener('input', function() {
                    video.volume = this.value;
                    const icon = this.previousElementSibling;
                    if (this.value == 0) {
                        icon.className = 'fas fa-volume-mute';
                    } else if (this.value < 0.5) {
                        icon.className = 'fas fa-volume-down';
                    } else {
                        icon.className = 'fas fa-volume-up';
                    }
                });
            }

            video.addEventListener('play', function() {
                playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            });

            video.addEventListener('pause', function() {
                playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            });

            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    console.log("Autoplay prevented, waiting for user interaction.");
                    playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
                });
            }
        }
        
        // ========== LOAD CUSTOMER REVIEWS FROM DATABASE ==========
        let allReviews = [];
        let currentReviewPage = 0;
        const REVIEWS_PER_PAGE = 3;

        function loadCustomerReviews() {
            const grid = document.getElementById('reviews-grid');
            const loading = document.getElementById('reviews-loading');
            if (!grid) return;

            fetch('/api/reviews')
                .then(res => res.json())
                .then(data => {
                    if (loading) loading.remove();

                    if (!data.success || !data.reviews || data.reviews.length === 0) {
                        grid.innerHTML = `
                            <div class="reviews-empty" style="grid-column:1/-1">
                                <i class="fas fa-comment-slash"></i>
                                <p>No reviews yet. Be the first to share your experience!</p>
                            </div>`;
                        return;
                    }

                    allReviews = data.reviews;
                    currentReviewPage = 0;
                    renderReviewPage(currentReviewPage);
                    setupReviewNavigation();
                })
                .catch(err => {
                    console.error('Error loading reviews:', err);
                    if (loading) loading.remove();
                    grid.innerHTML = `
                        <div class="reviews-empty" style="grid-column:1/-1">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Unable to load reviews right now.</p>
                        </div>`;
                });
        }

        function getTotalPages() {
            return Math.ceil(allReviews.length / REVIEWS_PER_PAGE);
        }

        function renderReviewPage(page) {
            const grid = document.getElementById('reviews-grid');
            if (!grid) return;

            const start = page * REVIEWS_PER_PAGE;
            const pageReviews = allReviews.slice(start, start + REVIEWS_PER_PAGE);

            grid.innerHTML = '';
            pageReviews.forEach(review => {
                grid.appendChild(createReviewCard(review));
            });

            updatePageDots(page);
        }

        function slideToPage(newPage) {
            const grid = document.getElementById('reviews-grid');
            if (!grid || newPage === currentReviewPage) return;

            // Slide out current cards
            grid.classList.add('sliding-out');

            setTimeout(() => {
                currentReviewPage = newPage;
                renderReviewPage(currentReviewPage);

                grid.classList.remove('sliding-out');
                grid.classList.add('sliding-in');

                // Force reflow then slide in
                requestAnimationFrame(() => {
                    requestAnimationFrame(() => {
                        grid.classList.remove('sliding-in');
                    });
                });
            }, 350);
        }

        function setupReviewNavigation() {
            const arrow = document.getElementById('reviews-next-arrow');
            const dotsContainer = document.getElementById('reviews-page-dots');
            const totalPages = getTotalPages();

            if (totalPages <= 1) {
                if (arrow) arrow.style.display = 'none';
                if (dotsContainer) dotsContainer.style.display = 'none';
                return;
            }

            // Show arrow
            if (arrow) {
                arrow.style.display = 'flex';
                arrow.onclick = () => {
                    const nextPage = (currentReviewPage + 1) % totalPages;
                    slideToPage(nextPage);
                };
            }

            // Build page dots
            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement('span');
                    dot.className = 'reviews-page-dot' + (i === 0 ? ' active' : '');
                    dot.addEventListener('click', () => slideToPage(i));
                    dotsContainer.appendChild(dot);
                }
            }
        }

        function updatePageDots(activePage) {
            const dots = document.querySelectorAll('.reviews-page-dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === activePage);
            });
        }

        function createReviewCard(review) {
            const card = document.createElement('div');
            card.className = 'review-card' + (review.is_featured ? ' featured' : '');

            // Avatar: image or initials
            let avatarContent;
            if (review.avatar) {
                avatarContent = `<img src="${review.avatar}" alt="${review.customer_name}">`;
            } else {
                const initials = review.customer_name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
                avatarContent = initials;
            }

            // Stars
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                stars += `<i class="fas fa-star ${i > review.rating ? 'empty' : ''}"></i>`;
            }

            const featuredBadge = review.is_featured
                ? '<span class="review-featured-badge">Featured</span>'
                : '';

            const perfumeTag = review.perfume_purchased
                ? `<span class="review-perfume"><i class="fas fa-spray-can"></i> ${review.perfume_purchased}</span>`
                : '';

            card.innerHTML = `
                <div class="review-card-header">
                    <div class="review-avatar">${avatarContent}</div>
                    <div class="review-customer-info">
                        <div class="review-customer-name">${review.customer_name}</div>
                        <div class="review-customer-title">${review.customer_title || ''}</div>
                    </div>
                    ${featuredBadge}
                </div>
                <div class="review-stars">${stars}</div>
                <p class="review-text">${review.review}</p>
                <div class="review-footer">
                    ${perfumeTag}
                    <span class="review-date">${review.created_at}</span>
                </div>
            `;

            return card;
        }

        // ========== INITIALIZATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            createSparkles();
            autoIncrementStats();
            setupShareButtons();
            setupAudioControls();
            loadCustomerReviews();
        });
    </script>

<!-- MOOD MATCH JAVASCRIPT (UPDATED) -->
<script>
        // Mood data for TROY Perfumes – now only provides display names and icons (no hardcoded perfume)
        const moodData = {
            happy:     { icon: "😊", name: "Happy & Joyful",      confidence: "94%" },
            energetic: { icon: "⚡", name: "Energetic & Dynamic", confidence: "88%" },
            calm:      { icon: "😌", name: "Calm & Serene",       confidence: "92%" },
            romantic:  { icon: "😍", name: "Romantic & Dreamy",   confidence: "85%" },
            confident: { icon: "😎", name: "Confident & Bold",    confidence: "90%" },
            neutral:   { icon: "😐", name: "Neutral & Balanced",  confidence: "82%" },
            surprised: { icon: "😲", name: "Surprised & Alert",   confidence: "79%" },
            sad:       { icon: "😢", name: "Sad & Melancholic",   confidence: "76%" }
        };

        // Mood Match System Variables
        let moodCameraStream = null;
        let moodHasImage = false;
        let currentMoodMode = 'simulation';
        let currentDetectedMood = 'confident';
        let recommendedPerfume = null;

        // DOM Elements for Mood Match
        const moodStartCameraBtn = document.getElementById('moodStartCameraBtn');
        const moodCaptureBtn = document.getElementById('moodCaptureBtn');
        const moodResetBtn = document.getElementById('moodResetBtn');
        const moodAnalyzeBtn = document.getElementById('moodAnalyzeBtn');
        const moodRequestPermissionBtn = document.getElementById('moodRequestPermissionBtn');
        const moodCameraFeed = document.getElementById('moodCameraFeed');
        const moodCameraPlaceholder = document.getElementById('moodCameraPlaceholder');
        const moodCapturedImage = document.getElementById('moodCapturedImage');
        const moodImageUpload = document.getElementById('moodImageUpload');
        const moodUploadArea = document.getElementById('moodUploadArea');
        const moodDisplayIcon = document.getElementById('moodDisplayIcon');
        const moodDisplayText = document.getElementById('moodDisplayText');
        const moodDisplayConfidence = document.getElementById('moodDisplayConfidence');
        const moodEmotionChart = document.getElementById('moodEmotionChart');
        const moodPerfumeDescription = document.getElementById('moodPerfumeDescription');
        const moodPerfumeNotes = document.getElementById('moodPerfumeNotes');
        const recommendedPerfumeName = document.getElementById('recommendedPerfumeName');
        const recommendedPerfumeMatch = document.getElementById('recommendedPerfumeMatch');
        const moodAddToCartBtn = document.getElementById('moodAddToCartBtn');
        const moodViewDetailsBtn = document.getElementById('moodViewDetailsBtn');
        const moodOptionsGrid = document.getElementById('moodOptionsGrid');
        const moodModeButtons = document.querySelectorAll('.mood-mode-btn');

        // Initialize Mood Match System
        function initializeMoodMatch() {
            setupMoodOptions();
            setupMoodEventListeners();
            setupModeButtons();
            // Set default recommendation (if perfumes exist)
            setTimeout(() => {
                updateMoodDisplay('confident');
                updateMoodPerfumeRecommendation('confident');
            }, 100);
        }

        // Build the sample mood buttons
        function setupMoodOptions() {
            moodOptionsGrid.innerHTML = '';
            Object.keys(moodData).forEach(moodKey => {
                const mood = moodData[moodKey];
                const optionBtn = document.createElement('div');
                optionBtn.className = 'mood-option-btn';
                optionBtn.dataset.mood = moodKey;
                optionBtn.innerHTML = `
                    <div class="mood-option-emoji">${mood.icon}</div>
                    <div class="mood-option-text">${mood.name.split(' ')[0]}</div>
                `;
                optionBtn.addEventListener('click', () => {
                    document.querySelectorAll('.mood-option-btn').forEach(btn => btn.classList.remove('active'));
                    optionBtn.classList.add('active');
                    updateMoodDisplay(moodKey);
                    updateMoodPerfumeRecommendation(moodKey);
                    if (moodHasImage) moodAnalyzeBtn.disabled = false;
                });
                moodOptionsGrid.appendChild(optionBtn);
            });
            document.querySelector('.mood-option-btn[data-mood="confident"]').classList.add('active');
        }

        // Update the displayed mood info (icon, name, confidence)
        function updateMoodDisplay(moodKey) {
            const mood = moodData[moodKey];
            if (!mood) return;
            moodDisplayIcon.textContent = mood.icon;
            moodDisplayText.textContent = mood.name;
            moodDisplayConfidence.textContent = `Confidence: ${mood.confidence}`;
            document.querySelectorAll('.mood-option-btn').forEach(btn => {
                if (btn.dataset.mood === moodKey) btn.classList.add('active');
                else btn.classList.remove('active');
            });
        }

        // Find a perfume that matches the given mood (using the `moods` array from admin data)
        function findPerfumeByMood(moodKey) {
            if (!window.perfumes || window.perfumes.length === 0) return null;
            // Try to find a perfume that has this mood in its moods array
            let matched = window.perfumes.find(p => p.moods && p.moods.includes(moodKey));
            if (matched) return matched;
            // Fallback: return the first perfume
            return window.perfumes[0];
        }

        // Update the recommendation card with details from the matched perfume
        function updateMoodPerfumeRecommendation(moodKey) {
            const perfume = findPerfumeByMood(moodKey);
            if (!perfume) {
                // No perfumes at all – show placeholder
                recommendedPerfumeName.textContent = "No perfumes available";
                recommendedPerfumeMatch.textContent = "Please add perfumes in admin";
                moodPerfumeDescription.textContent = "";
                moodPerfumeNotes.innerHTML = "";
                moodAddToCartBtn.innerHTML = `<i class="fas fa-shopping-bag"></i> Add to Cart (Rs 0)`;
                return;
            }

            recommendedPerfume = perfume;
            currentDetectedMood = moodKey;

            // Populate the card
            recommendedPerfumeName.textContent = perfume.name;
            recommendedPerfumeMatch.textContent = `Perfect for your ${moodData[moodKey]?.name || moodKey} mood`;

            const desc = perfume.description || "A premium fragrance that matches your mood.";
            moodPerfumeDescription.textContent = desc;

            // Fill notes
            const notesContainer = document.getElementById('moodPerfumeNotes');
            if (notesContainer) {
                notesContainer.innerHTML = '';
                (perfume.notes || []).forEach(note => {
                    const tag = document.createElement('div');
                    tag.className = 'mood-note-tag';
                    tag.textContent = note;
                    notesContainer.appendChild(tag);
                });
            }

            // Update Add to Cart button with correct price
            moodAddToCartBtn.innerHTML = `<i class="fas fa-shopping-bag"></i> Add to Cart (Rs ${perfume.price.toLocaleString()})`;

            // Create an emotion chart (simulated)
            createMoodEmotionChart(moodKey);
        }

        // (Keep all other functions exactly as they were: camera, upload, analysis, reset, etc.)
        function setupMoodEventListeners() {
            // Camera controls
            moodStartCameraBtn.addEventListener('click', startMoodCamera);
            moodCaptureBtn.addEventListener('click', captureMoodPhoto);
            moodResetBtn.addEventListener('click', resetMoodSystem);
            moodAnalyzeBtn.addEventListener('click', analyzeMood);
            moodRequestPermissionBtn.addEventListener('click', requestMoodCameraPermission);
            
            // Image upload
            moodUploadArea.addEventListener('click', () => {
                moodImageUpload.click();
            });
            
            moodImageUpload.addEventListener('change', handleMoodImageUpload);
            
            // Drag and drop
            moodUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                moodUploadArea.style.backgroundColor = 'rgba(56, 189, 248, 0.15)';
                moodUploadArea.style.borderColor = 'var(--accent)';
            });
            
            moodUploadArea.addEventListener('dragleave', () => {
                moodUploadArea.style.backgroundColor = 'rgba(56, 189, 248, 0.05)';
                moodUploadArea.style.borderColor = 'rgba(56, 189, 248, 0.5)';
            });
            
            moodUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                moodUploadArea.style.backgroundColor = 'rgba(56, 189, 248, 0.05)';
                moodUploadArea.style.borderColor = 'rgba(56, 189, 248, 0.5)';
                
                if (e.dataTransfer.files.length) {
                    moodImageUpload.files = e.dataTransfer.files;
                    handleMoodImageUpload({ target: { files: e.dataTransfer.files } });
                }
            });
            
            // Add to cart button
            moodAddToCartBtn.addEventListener('click', () => {
                if (recommendedPerfume) {
                    if (recommendedPerfume && typeof window.addToCart === 'function') {
                        window.addToCart(recommendedPerfume, moodAddToCartBtn);
                        showToast(`${recommendedPerfume.name} added to cart from mood match!`);
                    }
                }
            });
            
            // View details button
            moodViewDetailsBtn.addEventListener('click', () => {
                if (recommendedPerfume) {
                    closeMoodMatchModal();
                    const perfumeElement = document.querySelector(`[data-id="${recommendedPerfume.id}"]`);
                    if (perfumeElement) {
                        perfumeElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        perfumeElement.style.boxShadow = '0 0 30px rgba(34, 197, 94, 0.5)';
                        setTimeout(() => {
                            perfumeElement.style.boxShadow = '';
                        }, 3000);
                    }
                }
            });
        }

        function setupModeButtons() {
            moodModeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    moodModeButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentMoodMode = this.dataset.mode;
                    if (currentMoodMode === 'simulation') {
                        moodAnalyzeBtn.innerHTML = '<i class="fas fa-robot"></i> Analyze Mood (Simulation)';
                    } else if (currentMoodMode === 'mood-match') {
                        moodAnalyzeBtn.innerHTML = '<i class="fas fa-heart"></i> Match My Mood';
                    } else if (currentMoodMode === 'azure') {
                        moodAnalyzeBtn.innerHTML = '<i class="fab fa-microsoft"></i> Analyze with Azure AI';
                    }
                });
            });
        }

        async function requestMoodCameraPermission() {
            try {
                moodCameraStream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'user',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                });
                showMoodCameraPreview();
            } catch (err) {
                console.error("Error accessing camera:", err);
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    alert("Camera permission denied. You can still upload images for mood analysis.");
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    alert("No camera found on your device. Please upload an image instead.");
                } else {
                    alert("Could not access camera. Please check your device permissions or upload an image.");
                }
            }
        }

        function startMoodCamera() {
            if (moodCameraStream) {
                return;
            }
            requestMoodCameraPermission();
        }

        function showMoodCameraPreview() {
            if (!moodCameraStream) return;
            moodCameraFeed.srcObject = moodCameraStream;
            moodCameraFeed.style.display = 'block';
            moodCameraPlaceholder.style.display = 'none';
            moodCapturedImage.style.display = 'none';
            moodCaptureBtn.disabled = false;
            moodStartCameraBtn.innerHTML = '<i class="fas fa-video"></i> Camera Active';
            moodStartCameraBtn.classList.add('mood-btn-primary');
            moodHasImage = false;
            moodAnalyzeBtn.disabled = true;
        }

        function captureMoodPhoto() {
            if (!moodCameraStream) return;
            const canvas = document.getElementById('moodPhotoCanvas');
            canvas.width = moodCameraFeed.videoWidth;
            canvas.height = moodCameraFeed.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(moodCameraFeed, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/png');
            moodCapturedImage.src = imageData;
            moodCapturedImage.style.display = 'block';
            moodCameraFeed.style.display = 'none';
            moodCameraPlaceholder.style.display = 'none';
            stopMoodCamera();
            moodHasImage = true;
            moodAnalyzeBtn.disabled = false;
        }

        function stopMoodCamera() {
            if (moodCameraStream) {
                moodCameraStream.getTracks().forEach(track => track.stop());
                moodCameraStream = null;
            }
            moodCameraFeed.style.display = 'none';
            moodStartCameraBtn.innerHTML = '<i class="fas fa-video"></i> Start Camera';
        }

        function handleMoodImageUpload(event) {
            const file = event.target.files[0];
            if (!file) return;
            stopMoodCamera();
            if (!file.type.match('image.*')) {
                alert('Please select an image file (JPEG, PNG, etc.)');
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('Please select an image smaller than 5MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                moodCapturedImage.src = e.target.result;
                moodCapturedImage.style.display = 'block';
                moodCameraFeed.style.display = 'none';
                moodCameraPlaceholder.style.display = 'none';
                moodHasImage = true;
                moodAnalyzeBtn.disabled = false;
            };
            reader.onerror = function() {
                alert('Error reading file. Please try another image.');
            };
            reader.readAsDataURL(file);
        }

        async function analyzeMood() {
            if (!moodHasImage) {
                alert('Please capture or upload an image first');
                return;
            }
            moodAnalyzeBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Analyzing...';
            moodAnalyzeBtn.disabled = true;
            moodStartCameraBtn.disabled = true;
            moodCaptureBtn.disabled = true;
            
            setTimeout(async () => {
                let detectedMood;
                if (currentMoodMode === 'azure' || currentMoodMode === 'mood-match') {
                    detectedMood = simulateMoodDetection();
                } else if (currentMoodMode === 'simulation') {
                    const activeMoodOption = document.querySelector('.mood-option-btn.active');
                    detectedMood = activeMoodOption ? activeMoodOption.dataset.mood : 'confident';
                }
                currentDetectedMood = detectedMood;
                updateMoodDisplay(detectedMood);
                updateMoodPerfumeRecommendation(detectedMood);
                createMoodEmotionChart(detectedMood);
                moodAnalyzeBtn.innerHTML = '<i class="fas fa-brain"></i> Analyze Mood';
                moodAnalyzeBtn.disabled = false;
                moodStartCameraBtn.disabled = false;
            }, 1500);
        }

        function simulateMoodDetection() {
            const moods = ['happy', 'calm', 'neutral', 'confident', 'energetic', 'romantic', 'surprised', 'sad'];
            const weights = [0.25, 0.20, 0.15, 0.15, 0.10, 0.08, 0.05, 0.02];
            let random = Math.random();
            let cumulativeWeight = 0;
            for (let i = 0; i < moods.length; i++) {
                cumulativeWeight += weights[i];
                if (random <= cumulativeWeight) {
                    return moods[i];
                }
            }
            return 'confident';
        }

        function createMoodEmotionChart(moodKey) {
            moodEmotionChart.innerHTML = '<h4 style="color: var(--text-main); margin-bottom: 15px;">Emotion Analysis</h4>';
            const emotions = ['happiness', 'calmness', 'energy', 'surprise', 'neutral', 'sadness'];
            const scores = {};
            emotions.forEach(emotion => { scores[emotion] = Math.random() * 0.3; });
            if (moodKey === 'happy') {
                scores['happiness'] = 0.7 + Math.random() * 0.2;
            } else if (moodKey === 'calm') {
                scores['calmness'] = 0.7 + Math.random() * 0.2;
            } else if (moodKey === 'energetic') {
                scores['energy'] = 0.7 + Math.random() * 0.2;
            } else if (moodKey === 'surprised') {
                scores['surprise'] = 0.7 + Math.random() * 0.2;
            } else if (moodKey === 'sad') {
                scores['sadness'] = 0.6 + Math.random() * 0.2;
            } else if (moodKey === 'neutral') {
                scores['neutral'] = 0.7 + Math.random() * 0.2;
            } else if (moodKey === 'confident') {
                scores['happiness'] = 0.4 + Math.random() * 0.2;
                scores['calmness'] = 0.4 + Math.random() * 0.2;
            } else if (moodKey === 'romantic') {
                scores['happiness'] = 0.5 + Math.random() * 0.2;
                scores['calmness'] = 0.5 + Math.random() * 0.2;
            }
            let sum = Object.values(scores).reduce((a, b) => a + b, 0);
            emotions.forEach(emotion => {
                scores[emotion] = scores[emotion] / sum;
            });
            emotions.forEach(emotion => {
                const percentage = Math.round(scores[emotion] * 100);
                const emotionBar = document.createElement('div');
                emotionBar.className = 'emotion-bar';
                const emotionLabel = document.createElement('div');
                emotionLabel.className = 'emotion-label';
                emotionLabel.textContent = emotion.charAt(0).toUpperCase() + emotion.slice(1);
                const emotionProgress = document.createElement('div');
                emotionProgress.className = 'emotion-progress';
                const emotionFill = document.createElement('div');
                emotionFill.className = 'emotion-fill';
                emotionFill.style.width = `${percentage}%`;
                if (emotion === 'happiness') emotionFill.style.background = 'var(--primary)';
                else if (emotion === 'calmness') emotionFill.style.background = 'var(--accent)';
                else if (emotion === 'energy') emotionFill.style.background = '#eab308';
                else if (emotion === 'surprise') emotionFill.style.background = '#f97316';
                else if (emotion === 'sadness') emotionFill.style.background = '#8b5cf6';
                else emotionFill.style.background = '#6b7280';
                const emotionValue = document.createElement('div');
                emotionValue.className = 'emotion-value';
                emotionValue.textContent = `${percentage}%`;
                emotionProgress.appendChild(emotionFill);
                emotionBar.appendChild(emotionLabel);
                emotionBar.appendChild(emotionProgress);
                emotionBar.appendChild(emotionValue);
                moodEmotionChart.appendChild(emotionBar);
            });
        }

        function resetMoodSystem() {
            stopMoodCamera();
            moodCameraFeed.style.display = 'none';
            moodCapturedImage.style.display = 'none';
            moodCameraPlaceholder.style.display = 'block';
            moodStartCameraBtn.innerHTML = '<i class="fas fa-video"></i> Start Camera';
            moodStartCameraBtn.disabled = false;
            moodCaptureBtn.disabled = true;
            moodAnalyzeBtn.disabled = true;
            moodAnalyzeBtn.innerHTML = '<i class="fas fa-brain"></i> Analyze Mood';
            moodDisplayIcon.textContent = "😊";
            moodDisplayText.textContent = "Ready for Mood Analysis";
            moodDisplayConfidence.textContent = "Awaiting your photo";
            moodEmotionChart.innerHTML = '';
            moodImageUpload.value = '';
            moodHasImage = false;
            currentDetectedMood = 'confident';
            recommendedPerfume = null;
            document.querySelectorAll('.mood-option-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector('.mood-option-btn[data-mood="confident"]').classList.add('active');
            updateMoodDisplay('confident');
            updateMoodPerfumeRecommendation('confident');
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initializeMoodMatch();
        });
    </script>

<script>
/* === Weather Smart Enhancements (JS-only, no layout/CSS changes) === */
(function(){
  const TTL = 10 * 60 * 1000; // 10 minutes
  const CACHE_KEY = 'troy-weather-cache-v1';
  const SAFE_DEFAULT = { temp: 26, condition: 'Clear', humidity: 45, wind: 8, feelsLike: 27 };

  function readCache(city){
    try{
      const raw = localStorage.getItem(CACHE_KEY);
      if(!raw) return null;
      const obj = JSON.parse(raw);
      if(!obj[city]) return null;
      if(Date.now() - obj[city].ts > TTL) return null;
      return obj[city].data;
    }catch(e){ return null; }
  }
  function writeCache(city, data){
    try{
      const raw = localStorage.getItem(CACHE_KEY);
      const obj = raw ? JSON.parse(raw) : {};
      obj[city] = { ts: Date.now(), data };
      localStorage.setItem(CACHE_KEY, JSON.stringify(obj));
    }catch(e){}
  }

  // Patch updateCityWeather to use cache → api → safe default
  const _updateCityWeather = window.updateCityWeather;
  if(typeof _updateCityWeather === 'function'){
    window.updateCityWeather = async function(city){
      const cached = readCache(city);
      if(cached){
        try{
          window.renderWeatherFromData(city, cached);
          return;
        }catch(e){}
      }
      try{
        const data = await _updateCityWeather(city);
        if(data){ writeCache(city, data); }
        return data;
      }catch(e){
        window.renderWeatherFromData(city, SAFE_DEFAULT);
        return SAFE_DEFAULT;
      }
    }
  }

  // Renderer (uses existing IDs only)
  window.renderWeatherFromData = function(city, d){
    try{
      document.getElementById('tempLabel').textContent = city;
      document.getElementById('tempDisplay').textContent = Math.round(d.temp) + '°C';
      document.getElementById('windSpeed').textContent = 'Wind: ' + (d.wind||SAFE_DEFAULT.wind) + 'km/h';
      document.getElementById('humidity').textContent = 'Humidity: ' + (d.humidity||SAFE_DEFAULT.humidity) + '%';
      document.getElementById('feelsLike').textContent = 'Feels like: ' + (d.feelsLike||SAFE_DEFAULT.feelsLike) + '°C';
      if(window.updateWeatherIcon){
        window.updateWeatherIcon(d.condition||SAFE_DEFAULT.condition, d.temp||SAFE_DEFAULT.temp);
      }
      if(window.getRecommendation){
        document.getElementById('weatherRecommendation').textContent =
          window.getRecommendation(d.condition||SAFE_DEFAULT.condition, d.temp||SAFE_DEFAULT.temp);
      }
    }catch(e){}
  };

  // Perfume mapping by temperature (JS-only hook)
  window.mapPerfumesByTemp = function(temp){
    if(!Array.isArray(window.perfumes)) return;
    let tag = temp>=30?'fresh':temp>=20?'versatile':temp>=10?'warm':'intense';
    window.perfumes.forEach(p=>p._weatherTag = tag);
  };
})();

<script>

function loadPerfumes(){
   // existing code
}

/* REAL-TIME SYNC LISTENER */
window.addEventListener("storage", function(event) {
    if (event.key === "perfumes") {
        loadPerfumes();
    }
});

</script>
</script>
</body>
</html>