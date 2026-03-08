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
        top: 90px;
        right: 20px;
        width: 60px;
        height: 60px;
        z-index: 100;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.7);
        animation: stampCoinFlip 6s ease-in-out infinite;
        cursor: pointer;
        border: 2px solid gold;
    }
    
    .nabipak-stamp:hover {
        box-shadow: 0 0 35px rgba(255, 215, 0, 0.9);
    }

    /* LADIES STAMP */
    .ladies-stamp {
        position: fixed;
        top: 90px;
        left: 20px;
        width: 60px;
        height: 60px;
        z-index: 100;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(255, 105, 180, 0.7);
        animation: stampCoinFlip 6s ease-in-out infinite;
        cursor: pointer;
        border: 2px solid #ff69b4;
    }

    .ladies-stamp:hover {
        box-shadow: 0 0 35px rgba(255, 105, 180, 0.9);
    }

    /* COMING SOON MODAL */
    .coming-soon-modal {
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

    .coming-soon-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .coming-soon-content {
        background: radial-gradient(circle at top, #0f172a, #020617);
        border-radius: 28px;
        padding: 2.5rem;
        max-width: 500px;
        width: 90%;
        text-align: center;
        border: 2px solid rgba(255, 105, 180, 0.5);
        box-shadow: 0 0 40px rgba(255, 105, 180, 0.3);
        position: relative;
        animation: modalAppear 0.5s ease-out;
    }

    .coming-soon-content img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        border: 3px solid #ff69b4;
        box-shadow: 0 0 25px rgba(255, 105, 180, 0.5);
    }

    .coming-soon-content h2 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #ff69b4;
    }

    .coming-soon-content p {
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .coming-soon-close {
        background: linear-gradient(135deg, #ff69b4, #ff1493);
        color: #fff;
        border: none;
        padding: 0.7rem 2rem;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .coming-soon-close:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(255, 105, 180, 0.5);
    }

    @keyframes stampCoinFlip {
        0%   { transform: rotateY(0deg); }
        50%  { transform: rotateY(1080deg); }
        100% { transform: rotateY(1080deg); }
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
        width:56px;
        height:56px;
        border-radius:14px;
        border:1px solid rgba(34,197,94,0.4);
        object-fit:cover;
        transition:all 0.4s ease;
    }
    .header-scrolled .logo-img{
        width:42px;
        height:42px;
    }
    .logo-text{
        font-weight:900;
        letter-spacing:.15em;
        font-size:5rem;
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
    .tv-screen iframe,
    .tv-screen video {
        display: block;
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 14px; /* inner screen curve */
        object-fit: cover;
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
    .customer-experience{background:transparent;text-align:center;padding:5rem 2rem;}
    .this-week-video{
      position:relative;overflow:hidden;
      background:linear-gradient(145deg,#050c18 0%,#08142a 50%,#050c18 100%);
      border-radius:28px;padding:0;margin-bottom:3rem;
      border:1px solid rgba(192,132,252,0.15);
      box-shadow:0 40px 100px rgba(0,0,0,0.8),0 0 0 1px rgba(192,132,252,0.1);
    }
    .neon-sparkles{position:absolute;top:0;left:0;width:100%;height:100%;overflow:hidden;z-index:1;pointer-events:none;border-radius:28px;}
    .sparkle{position:absolute;background:#c084fc;border-radius:50%;box-shadow:0 0 8px #c084fc,0 0 16px #c084fc;animation:sparkleAnim 3s infinite linear;opacity:.5;}
    @keyframes sparkleAnim{0%,100%{transform:scale(1);opacity:.5;}50%{transform:scale(1.5);opacity:.9;}}
    .neon-glow{position:absolute;top:0;left:0;width:100%;height:100%;
      background:radial-gradient(ellipse 60% 50% at 10% 20%,rgba(192,132,252,0.08) 0%,transparent 55%),
                 radial-gradient(ellipse 50% 60% at 90% 80%,rgba(56,189,248,0.07) 0%,transparent 55%);
      z-index:1;pointer-events:none;}
    .this-week-content{position:relative;z-index:2;width:100%;}
    .current-video-container{
      display:grid;grid-template-columns:1.1fr 0.9fr;
      min-height:560px;width:100%;
    }
    .current-video-wrapper{
      position:relative;overflow:hidden;
      border-radius:28px 0 0 28px;
      width:100%;height:100%;min-height:560px;
      box-shadow:none;border:none;margin-bottom:0;
      transition:transform .4s cubic-bezier(0.2,0.9,0.3,1);
    }
    .current-video-wrapper:hover{transform:scale(1.01);}
    .experience-video-placeholder{
      width:100%;height:100%;min-height:560px;
      background:linear-gradient(135deg,#060e1c 0%,#0d1f3e 60%,#060e1c 100%);
      display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1.2rem;color:var(--text-muted);
    }
    .experience-video-placeholder i{font-size:5rem;color:rgba(192,132,252,0.4);filter:drop-shadow(0 0 20px rgba(192,132,252,0.3));}
    .current-video{width:100%;height:100%;min-height:560px;object-fit:cover;display:block;}
    .current-video-info{
      padding:3rem 2.5rem;
      background:linear-gradient(145deg,rgba(10,8,20,0.98),rgba(15,10,30,0.95));
      border-left:1px solid rgba(192,132,252,0.12);
      border-radius:0 28px 28px 0;
      display:flex;flex-direction:column;justify-content:center;gap:1.5rem;
      text-align:left;
    }
    .current-video-title{
      font-size:1.5rem;color:#f1f5ff;margin-bottom:0;
      display:flex;flex-direction:column;align-items:flex-start;gap:.6rem;
      text-shadow:none;flex-wrap:wrap;text-align:left;
    }
    .current-video-title .badge{
      background:linear-gradient(135deg,rgba(192,132,252,0.2),rgba(56,189,248,0.15));
      color:#c084fc;padding:.3rem .9rem;border-radius:999px;
      font-size:.7rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
      border:1px solid rgba(192,132,252,0.3);width:fit-content;
    }
    .current-video-description{
      color:rgba(241,245,255,0.55);line-height:1.75;
      font-size:.92rem;text-align:left;margin-bottom:0;
      border-left:3px solid rgba(192,132,252,0.4);padding-left:1rem;
    }
    .video-stats{
      display:flex;justify-content:flex-start;gap:1rem;
      margin-top:0;padding-top:1.5rem;
      border-top:1px solid rgba(255,255,255,0.06);flex-wrap:wrap;
    }
    .stat-item{
      display:flex;flex-direction:column;align-items:flex-start;
      flex:1;min-width:80px;padding:1rem 1.2rem;
      background:rgba(255,255,255,0.03);border-radius:14px;
      border:1px solid rgba(255,255,255,0.06);transition:all .3s;
    }
    .stat-item:hover{background:rgba(192,132,252,0.07);border-color:rgba(192,132,252,0.3);transform:translateY(-3px);}
    .stat-value{font-size:1.4rem;color:#c084fc;font-weight:800;text-shadow:none;display:flex;align-items:center;gap:.4rem;}
    .stat-label{font-size:.72rem;color:rgba(241,245,255,0.4);margin-top:.25rem;text-transform:uppercase;letter-spacing:.08em;}
    .stat-icon{font-size:1rem;}
    .share-container{display:flex;flex-direction:column;align-items:flex-start;gap:.75rem;margin-top:0;}
    .share-buttons{display:flex;justify-content:flex-start;gap:.5rem;flex-wrap:wrap;}
    .share-btn{
      background:rgba(255,255,255,0.04);color:rgba(241,245,255,0.7);
      border:1px solid rgba(255,255,255,0.1);padding:.45rem 1rem;
      border-radius:999px;transition:all .3s;display:flex;align-items:center;gap:.45rem;font-size:.8rem;
    }
    .share-btn:hover{border-color:rgba(192,132,252,0.5);transform:translateY(-2px);background:rgba(192,132,252,0.1);}
    .share-btn.facebook:hover{background:#1877F2;color:#fff;border-color:#1877F2;}
    .share-btn.twitter:hover{background:#1DA1F2;color:#fff;border-color:#1DA1F2;}
    .share-btn.whatsapp:hover{background:#25D366;color:#fff;border-color:#25D366;}
    .share-btn.link:hover{background:rgba(192,132,252,0.9);color:#fff;border-color:#c084fc;}
    .video-controls-experience{
      position:absolute;bottom:0;left:0;right:0;width:100%;
      background:linear-gradient(transparent,rgba(0,0,0,0.85));
      padding:2rem 1.5rem 1.2rem;display:flex;justify-content:flex-start;
      align-items:center;opacity:0;transition:all .4s;gap:1rem;
    }
    .current-video-wrapper:hover .video-controls-experience{opacity:1;}
    .video-btn-experience{
      background:rgba(192,132,252,0.85);color:#fff;border:none;
      border-radius:50%;width:42px;height:42px;display:flex;align-items:center;justify-content:center;
      transition:all .3s;backdrop-filter:blur(8px);
    }
    .video-btn-experience:hover{background:#c084fc;transform:scale(1.12);box-shadow:0 0 20px rgba(192,132,252,0.6);}
    .video-info-experience{color:rgba(255,255,255,0.8);font-size:.85rem;font-weight:500;}
    .video-volume-control{display:flex;align-items:center;gap:.5rem;margin-left:auto;}
    .video-volume-control i{color:rgba(192,132,252,0.8);}
    #volumeSlider{width:70px;height:4px;border-radius:3px;background:rgba(255,255,255,0.15);outline:none;-webkit-appearance:none;accent-color:#c084fc;}

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

    /* ========== REDESIGNED WEATHER SECTION (GAPSY) ========== */
    :root{
      --w-bg:#07080f;
      --w-surface:rgba(255,255,255,0.04);
      --w-border:rgba(255,255,255,0.08);
      --w-text:#f1f5ff;
      --w-muted:rgba(241,245,255,0.42);
      --w-accent1:#c084fc;
      --w-accent2:#38bdf8;
      --w-accent3:#4ade80;
      --w-accent4:#fb923c;
      --w-glow1:rgba(192,132,252,0.22);
      --w-glow2:rgba(56,189,248,0.18);
    }
    .weather-section{background:transparent;position:relative;}
    .weather-section.is-day  { --w-bg:#07080f; --w-surface:rgba(255,255,255,0.05); --w-border:rgba(255,255,255,0.09); --w-text:#f1f5ff; --w-muted:rgba(241,245,255,0.42); }
    .weather-section.is-night{ --w-bg:#02030a; --w-surface:rgba(20,20,60,0.18);    --w-border:rgba(99,102,241,0.18);  --w-text:#e8eeff; --w-muted:rgba(200,210,255,0.38); }
    .weather-section.is-morning { --w-bg:#05080f; --w-surface:rgba(251,191,36,0.05); --w-border:rgba(251,191,36,0.15); --w-text:#fffbeb; --w-muted:rgba(253,230,138,0.45); }
    .weather-section.is-evening { --w-bg:#07050f; --w-surface:rgba(192,132,252,0.06); --w-border:rgba(192,132,252,0.18); --w-text:#f5f0ff; --w-muted:rgba(216,180,254,0.45); }
    .weather-section { transition: background 1.6s ease, --w-bg 1.6s; }

    .weather-scene{transition:background 1.8s ease, box-shadow 1.8s ease;}
    .weather-scene.theme-day{
      background:linear-gradient(160deg,#061830 0%,#083d6b 45%,#0a4a5e 100%);
      box-shadow:0 0 0 1px rgba(56,189,248,0.4),0 40px 80px rgba(0,80,160,0.4);
    }
    .weather-scene.theme-day .weather-col-a{background:linear-gradient(135deg,rgba(56,189,248,0.1) 0%,transparent 60%);}
    .weather-scene.theme-day .w-temp-big{background:linear-gradient(135deg,#ffffff 30%,rgba(56,189,248,0.95) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .weather-scene.theme-day .w-scene-glow{background:radial-gradient(circle,rgba(56,189,248,0.18) 0%,transparent 70%);}
    .weather-scene.theme-morning{
      background:linear-gradient(160deg,#1a0e00 0%,#3d2800 40%,#2a1a00 100%);
      box-shadow:0 0 0 1px rgba(251,191,36,0.5),0 40px 80px rgba(180,100,0,0.3);
    }
    .weather-scene.theme-morning .weather-col-a{background:linear-gradient(135deg,rgba(251,191,36,0.1) 0%,transparent 60%);}
    .weather-scene.theme-morning .w-temp-big{background:linear-gradient(135deg,#ffffff 30%,rgba(251,191,36,0.95) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .weather-scene.theme-evening{
      background:linear-gradient(160deg,#1a0630 0%,#3d1060 40%,#2a0828 100%);
      box-shadow:0 0 0 1px rgba(192,132,252,0.5),0 40px 80px rgba(120,20,180,0.35);
    }
    .weather-scene.theme-evening .weather-col-a{background:linear-gradient(135deg,rgba(192,132,252,0.1) 0%,transparent 60%);}
    .weather-scene.theme-evening .w-temp-big{background:linear-gradient(135deg,#ffffff 30%,rgba(192,132,252,0.95) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .weather-scene.theme-night{
      background:linear-gradient(160deg,#010208 0%,#060818 50%,#020310 100%);
      box-shadow:0 0 0 1px rgba(99,102,241,0.45),0 40px 80px rgba(0,0,80,0.6);
    }
    .weather-scene.theme-night .weather-col-a{background:linear-gradient(135deg,rgba(99,102,241,0.08) 0%,transparent 60%);}
    .weather-scene.theme-night .w-temp-big{background:linear-gradient(135deg,#ffffff 30%,rgba(147,197,253,0.9) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}

    .weather-scene{
      position:relative;border-radius:28px;overflow:hidden;
      background:var(--w-bg);
      border:1px solid rgba(255,255,255,0.07);
      box-shadow:0 0 0 1px rgba(192,132,252,0.12),0 40px 80px rgba(0,0,0,0.7);
    }
    .weather-scene-bg{position:absolute;inset:0;transition:background 1.8s ease, opacity 1.4s ease;z-index:0;mix-blend-mode:screen;opacity:0.7;}
    .weather-scene-bg.clear-day  {background:radial-gradient(ellipse 80% 60% at 20% 10%,rgba(56,189,248,0.28) 0%,transparent 60%),radial-gradient(ellipse 60% 80% at 80% 90%,rgba(74,222,128,0.14) 0%,transparent 60%),radial-gradient(ellipse 100% 50% at 50% 0%,rgba(251,191,36,0.1) 0%,transparent 55%),var(--w-bg);}
    .weather-scene-bg.clear-night{background:radial-gradient(ellipse 70% 50% at 15% 15%,rgba(99,102,241,0.35) 0%,transparent 55%),radial-gradient(ellipse 50% 70% at 85% 85%,rgba(192,132,252,0.22) 0%,transparent 55%),radial-gradient(ellipse 80% 40% at 50% 100%,rgba(30,20,80,0.5) 0%,transparent 60%),var(--w-bg);}
    .weather-scene-bg.cloudy      {background:radial-gradient(ellipse 90% 60% at 50% 20%,rgba(100,116,139,0.2) 0%,transparent 60%),var(--w-bg);}
    .weather-scene-bg.rainy       {background:radial-gradient(ellipse 80% 60% at 30% 10%,rgba(56,189,248,0.14) 0%,transparent 55%),radial-gradient(ellipse 50% 50% at 70% 90%,rgba(30,58,138,0.25) 0%,transparent 55%),var(--w-bg);}
    .weather-scene-bg.snowy       {background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(186,230,253,0.12) 0%,transparent 55%),var(--w-bg);}
    .weather-scene-bg.foggy       {background:radial-gradient(ellipse 100% 60% at 50% 50%,rgba(148,163,184,0.12) 0%,transparent 60%),var(--w-bg);}
    .weather-scene-bg.storm       {background:radial-gradient(ellipse 70% 50% at 20% 20%,rgba(99,102,241,0.15) 0%,transparent 50%),radial-gradient(ellipse 60% 50% at 80% 80%,rgba(251,191,36,0.06) 0%,transparent 50%),var(--w-bg);}

    .weather-scene::before{
      content:'';position:absolute;
      width:500px;height:500px;border-radius:50%;
      background:radial-gradient(circle,rgba(192,132,252,0.12) 0%,transparent 70%);
      top:-150px;left:-100px;z-index:1;pointer-events:none;
    }
    .weather-scene::after{
      content:'';position:absolute;
      width:400px;height:400px;border-radius:50%;
      background:radial-gradient(circle,rgba(56,189,248,0.1) 0%,transparent 70%);
      bottom:-100px;right:-80px;z-index:1;pointer-events:none;
    }

    .weather-fx{position:absolute;inset:0;z-index:2;pointer-events:none;overflow:hidden;}
    .sun-ray{position:absolute;top:-30px;left:50%;width:2px;height:200px;background:linear-gradient(to bottom,rgba(251,191,36,0.3),transparent);transform-origin:bottom center;animation:sunRay 7s ease-in-out infinite;}
    @keyframes sunRay{0%,100%{opacity:.3;transform:translateX(-50%) rotate(var(--r)) scaleY(1);}50%{opacity:.7;transform:translateX(-50%) rotate(var(--r)) scaleY(1.2);}}
    .star-dot{position:absolute;border-radius:50%;background:#fff;animation:twinkle var(--td) ease-in-out infinite;}
    @keyframes twinkle{0%,100%{opacity:.15;transform:scale(1);}50%{opacity:.9;transform:scale(1.5);}}
    .rain-drop{position:absolute;top:-20px;width:1px;border-radius:2px;background:linear-gradient(to bottom,rgba(147,197,253,0.7),transparent);animation:rainFall var(--rd) linear infinite;}
    @keyframes rainFall{0%{transform:translateY(-20px) rotate(10deg);opacity:0;}5%{opacity:1;}100%{transform:translateY(105%) rotate(10deg);opacity:.3;}}
    .snow-flake{position:absolute;top:-20px;color:rgba(219,234,254,0.8);font-size:var(--sf);animation:snowFall var(--sd) linear infinite;}
    @keyframes snowFall{0%{transform:translateY(-20px) translateX(0) rotate(0deg);opacity:0;}8%{opacity:.9;}100%{transform:translateY(105%) translateX(var(--sx)) rotate(360deg);opacity:.4;}}
    .lightning{position:absolute;top:0;left:40%;width:2px;height:70px;background:linear-gradient(to bottom,#fff,#fbbf24,transparent);opacity:0;animation:lightning 5s ease-in-out infinite;}
    @keyframes lightning{0%,93%,100%{opacity:0;}94%,96%{opacity:1;}95%,97%{opacity:0;}}
    .cloud-layer{position:absolute;width:200%;top:8%;animation:cloudDrift var(--cd) linear infinite;display:flex;gap:80px;}
    .cloud-blob{background:rgba(255,255,255,var(--cop));border-radius:50px;height:35px;}
    @keyframes cloudDrift{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}

    .weather-panel{position:relative;z-index:3;display:grid;grid-template-columns:minmax(280px,1.2fr) 1px minmax(320px,1fr) 1px minmax(280px,1fr);min-height:580px;overflow:hidden;}
    .w-divider{background:linear-gradient(to bottom,transparent,rgba(255,255,255,0.08) 30%,rgba(255,255,255,0.08) 70%,transparent);align-self:stretch;flex-shrink:0;}

    .weather-col-a{
      padding:3rem 2.5rem;
      display:flex;flex-direction:column;justify-content:space-between;gap:1.8rem;
      background:linear-gradient(135deg,rgba(192,132,252,0.06) 0%,transparent 50%);
      min-width:0;overflow:hidden;
    }
    .weather-col-b{
      padding:2rem 1.5rem;
      display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem;
      min-width:0;overflow:hidden;
    }
    .weather-col-c{
      padding:3rem 2.2rem;
      display:flex;flex-direction:column;gap:1.2rem;
      background:linear-gradient(225deg,rgba(56,189,248,0.06) 0%,transparent 50%);
      min-width:0;overflow:hidden;
    }

    .w-temp-hero{display:flex;flex-direction:column;gap:.4rem;}
    .w-temp-big{
      font-size:10rem;font-weight:900;line-height:.85;
      letter-spacing:-.04em;
      background:linear-gradient(135deg,#ffffff 30%,rgba(192,132,252,0.9) 100%);
      -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
      transition:all .6s ease;
    }
    .w-city-name{font-size:2.1rem;font-weight:700;color:var(--w-text);letter-spacing:-.01em;}
    .w-local-time{font-size:.9rem;color:var(--w-muted);letter-spacing:.12em;text-transform:uppercase;margin-top:.1rem;}
    .w-condition-row{display:flex;align-items:center;gap:.6rem;margin-top:.5rem;}
    .w-cond-icon{font-size:1.3rem;transition:all .4s;}
    .w-cond-text{font-size:1.15rem;color:rgba(255,255,255,0.65);font-weight:500;}

    .w-metrics{display:flex;flex-wrap:wrap;gap:.45rem;}
    .w-metric{
      padding:.38rem .75rem;
      border-radius:6px;
      background:var(--w-surface);
      border:1px solid var(--w-border);
      display:flex;align-items:center;gap:.38rem;
      white-space:nowrap;transition:background .2s,border-color .2s;
    }
    .w-metric:hover{background:rgba(255,255,255,0.08);border-color:rgba(192,132,252,0.35);}
    .w-metric-icon{font-size:.75rem;}
    .w-metric-value{font-size:.82rem;font-weight:700;color:var(--w-text);}
    .w-metric-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.08em;color:var(--w-muted);}

    .w-tod-badge{display:inline-flex;align-items:center;gap:.4rem;padding:.28rem .8rem;border-radius:5px;font-size:.72rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;width:fit-content;margin-bottom:.6rem;}
    .w-tod-badge.morning  {background:rgba(251,191,36,0.1); color:#fbbf24;border:1px solid rgba(251,191,36,0.22);}
    .w-tod-badge.afternoon{background:rgba(74,222,128,0.1); color:#4ade80;border:1px solid rgba(74,222,128,0.22);}
    .w-tod-badge.evening  {background:rgba(192,132,252,0.1);color:#c084fc;border:1px solid rgba(192,132,252,0.22);}
    .w-tod-badge.night    {background:rgba(56,189,248,0.1); color:#38bdf8;border:1px solid rgba(56,189,248,0.22);}

    .w-intensity-block{background:var(--w-surface);border:1px solid var(--w-border);border-radius:10px;padding:.85rem 1rem;}
    .w-intensity-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.12em;color:var(--w-muted);margin-bottom:.5rem;}
    .w-intensity-track{height:4px;background:rgba(255,255,255,0.07);border-radius:999px;overflow:hidden;}
    .w-intensity-fill{height:100%;border-radius:999px;transition:width 1.4s cubic-bezier(.4,0,.2,1);background:linear-gradient(90deg,#4ade80,#38bdf8,#c084fc,#fb923c);}
    .w-intensity-ticks{display:flex;justify-content:space-between;margin-top:.4rem;}
    .w-intensity-tick{font-size:.58rem;color:rgba(255,255,255,0.22);}

    .w-insight-single{
      background:var(--w-surface);border-left:2px solid var(--w-accent3);
      padding:.8rem 1rem;font-size:.82rem;color:rgba(255,255,255,0.68);
      line-height:1.55;display:flex;align-items:flex-start;gap:.6rem;
    }
    .w-insight-single.blue  {border-left-color:var(--w-accent2);}
    .w-insight-single.purple{border-left-color:var(--w-accent1);}
    .w-insight-single.gold  {border-left-color:var(--w-accent4);}
    .w-insight-icon{font-size:.95rem;flex-shrink:0;margin-top:.1rem;}
    .w-insights-group{border:1px solid var(--w-border);border-radius:12px;overflow:hidden;}
    .w-insights-group .w-insight-single+.w-insight-single{border-top:1px solid var(--w-border);}

    .carousel-wrapper{width:100%;z-index:1;}
    .w-carousel-label{font-size:1.24rem;text-transform:uppercase;letter-spacing:.14em;color:var(--w-muted);text-align:center;}
    .city-carousel-container{
      perspective:1200px;
      width:100%;height:480px;
      display:flex;justify-content:center;align-items:center;
      position:relative;overflow:hidden;
    }
    .city-carousel{position:relative;width:256px;height:256px;transform-style:preserve-3d;animation:rotateCarousel 50s linear infinite;will-change:transform;backface-visibility:hidden;}
    .city-carousel:hover{animation-play-state:paused;}
    @keyframes rotateCarousel{0%{transform:rotateY(0deg);}25%{transform:rotateY(90deg);}50%{transform:rotateY(180deg);}75%{transform:rotateY(270deg);}100%{transform:rotateY(360deg);}}
    .carousel-item{
      position:absolute;width:256px;height:256px;border-radius:4px;overflow:hidden;
      box-shadow:0 18px 45px rgba(0,0,0,0.7);
      transition:all .5s cubic-bezier(0.25,0.46,0.45,0.94);backface-visibility:hidden;border:1.5px solid transparent;will-change:transform,box-shadow;
    }
    .carousel-item:hover{box-shadow:0 16px 40px rgba(192,132,252,0.5);border-color:#c084fc;z-index:99;}
    .carousel-item img{width:100%;height:100%;object-fit:cover;display:block;}
    .carousel-item .city-label{
      position:absolute;bottom:0;left:0;right:0;
      background:linear-gradient(to top,rgba(7,8,15,.95),transparent);
      color:#fff;padding:.7rem .5rem .4rem;
      font-weight:700;font-size:.72rem;text-align:center;
      opacity:0;transform:translateY(5px);transition:.2s;
      pointer-events:none;letter-spacing:.1em;text-transform:uppercase;
    }
    .carousel-item:hover .city-label{opacity:1;transform:translateY(0);}
    .carousel-item:nth-child(1){transform:rotateY(0deg)   translateZ(304px);}
    .carousel-item:nth-child(2){transform:rotateY(60deg)  translateZ(304px);}
    .carousel-item:nth-child(3){transform:rotateY(120deg) translateZ(304px);}
    .carousel-item:nth-child(4){transform:rotateY(180deg) translateZ(304px);}
    .carousel-item:nth-child(5){transform:rotateY(240deg) translateZ(304px);}
    .carousel-item:nth-child(6){transform:rotateY(300deg) translateZ(304px);}

    .w-rec-label{
      font-size:2.1rem;font-weight:700;text-transform:uppercase;letter-spacing:.14em;color:#ffffff;
      display:flex;align-items:center;justify-content:center;gap:.5rem;text-align:center;padding-left:15%;
    }
    .w-rec-label::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,rgba(192,132,252,0.3),transparent);}
    .w-perfume-hero{
      position:relative;border-radius:32px;overflow:hidden;
      height:480px;width:85%;margin-left:15%;
      box-shadow:0 20px 30px -10px rgba(0,0,0,0.5);
      transition:transform .4s cubic-bezier(0.2,0.9,0.3,1),box-shadow .4s;
      border:1px solid rgba(148,163,184,0.2);
    }
    .w-perfume-hero:hover{transform:scale(1.02) translateY(-5px);box-shadow:0 30px 50px -12px rgba(0,0,0,0.7);}
    .w-perfume-hero-img{position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;opacity:.72;transition:transform .5s,opacity .3s;}
    .w-perfume-hero:hover .w-perfume-hero-img{transform:scale(1.05);opacity:.55;}
    .w-perfume-hero-bg{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.4) 55%,transparent 100%);}
    .w-perfume-hero-body{position:absolute;bottom:0;left:0;right:0;z-index:2;padding:1.5rem 1.6rem;transition:transform .4s;}
    .w-perfume-hero:hover .w-perfume-hero-body{transform:translateY(-4px);}
    .w-perfume-hero-name{font-size:1.65rem;font-weight:700;color:#fff;letter-spacing:-.01em;line-height:1.1;margin-bottom:.3rem;text-transform:uppercase;}
    .w-perfume-hero-reason{font-size:.76rem;color:rgba(255,255,255,0.6);line-height:1.4;margin-bottom:.55rem;}
    .w-perfume-hero-tags{display:flex;flex-wrap:wrap;gap:.3rem;margin-bottom:.75rem;}
    .w-perfume-hero-tag{font-size:.64rem;padding:.18rem .55rem;border-radius:999px;background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.85);border:1px solid rgba(255,255,255,0.2);}
    .w-perfume-hero-footer{display:flex;align-items:center;gap:.7rem;}
    .w-perfume-hero-price{font-size:1.15rem;font-weight:800;color:#4ade80;letter-spacing:-.01em;}
    .w-perfume-hero-add{
      padding:.5rem 1.1rem;border-radius:999px;border:none;
      background:linear-gradient(135deg,#c084fc,#818cf8);
      color:#fff;font-weight:700;font-size:.78rem;
      display:inline-flex;align-items:center;gap:.38rem;transition:all .2s;
    }
    .w-perfume-hero-add:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(192,132,252,0.45);}

    .w-alts-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.12em;color:var(--w-muted);}
    .w-alts{display:grid;grid-template-columns:repeat(3,1fr);gap:.45rem;}
    .w-alt-chip{
      display:flex;flex-direction:column;align-items:center;gap:.3rem;
      padding:.55rem .35rem;border-radius:10px;
      background:var(--w-surface);border:1px solid var(--w-border);
      text-align:center;transition:all .2s;cursor:pointer;
    }
    .w-alt-chip:hover{background:rgba(192,132,252,0.1);border-color:rgba(192,132,252,0.4);}
    .w-alt-chip img{width:34px;height:34px;border-radius:6px;object-fit:cover;}
    .w-alt-chip-name{font-weight:600;color:rgba(255,255,255,0.8);font-size:.7rem;}
    .w-alt-chip-price{color:#4ade80;font-size:.65rem;font-weight:600;}

    .weather-bottom-bar{
      position:relative;z-index:3;
      padding:.9rem 2.8rem;
      border-top:1px solid rgba(255,255,255,0.06);
      display:flex;align-items:center;gap:1rem;flex-wrap:wrap;
      background:rgba(7,8,15,0.6);backdrop-filter:blur(16px);
    }
    .w-search-wrap{display:flex;gap:.4rem;flex:1;min-width:220px;}
    .w-search-input{
      flex:1;padding:.55rem .95rem;border-radius:8px;
      border:1px solid rgba(255,255,255,0.09);
      background:rgba(255,255,255,0.05);color:#fff;font-size:.82rem;outline:none;
      transition:border-color .2s;
    }
    .w-search-input::placeholder{color:rgba(255,255,255,0.28);}
    .w-search-input:focus{border-color:rgba(192,132,252,0.5);background:rgba(192,132,252,0.06);}
    .w-search-btn{
      padding:.55rem 1.1rem;border-radius:8px;border:none;
      background:linear-gradient(135deg,#c084fc,#818cf8);
      color:#fff;font-weight:700;font-size:.8rem;
      display:inline-flex;align-items:center;gap:.38rem;transition:.2s;
    }
    .w-search-btn:hover{transform:translateY(-1px);box-shadow:0 6px 18px rgba(192,132,252,0.4);}
    .w-refresh-btn{
      padding:.55rem .95rem;border-radius:8px;
      border:1px solid rgba(255,255,255,0.09);
      background:rgba(255,255,255,0.04);color:rgba(255,255,255,0.55);
      font-size:.8rem;display:inline-flex;align-items:center;gap:.38rem;transition:.2s;
    }
    .w-refresh-btn:hover{background:rgba(255,255,255,0.09);color:#fff;border-color:rgba(192,132,252,0.3);}
    .w-last-updated{font-size:.68rem;color:rgba(255,255,255,0.25);margin-left:auto;}

    .city-search-container{display:none;}
    .weather-perfume-card{display:none;}

    @media(max-width:1100px){
      .weather-panel{grid-template-columns:1fr 1px minmax(260px,.9fr) 1px minmax(240px,.85fr);}
      .w-temp-big{font-size:7.5rem;}
    }
    @media(max-width:860px){
      .weather-panel{grid-template-columns:1fr 1px 1fr;grid-template-rows:auto auto;}
      .weather-col-b{grid-column:1/-1;border-top:1px solid rgba(255,255,255,0.05);padding:2rem 1.5rem;}
      .w-divider:last-of-type{display:none;}
      .w-temp-big{font-size:6.5rem;}
      .city-carousel-container{height:500px;}
    }
    @media(max-width:600px){
      .weather-panel{grid-template-columns:1fr;}
      .w-divider{display:none;}
      .weather-col-a,.weather-col-b,.weather-col-c{padding:2rem 1.4rem;}
      .w-temp-big{font-size:5rem;}
      .city-carousel-container{height:460px;}
      .carousel-item{width:260px;height:260px;}
      .carousel-item:nth-child(1){transform:rotateY(0deg)   translateZ(300px);}
      .carousel-item:nth-child(2){transform:rotateY(60deg)  translateZ(300px);}
      .carousel-item:nth-child(3){transform:rotateY(120deg) translateZ(300px);}
      .carousel-item:nth-child(4){transform:rotateY(180deg) translateZ(300px);}
      .carousel-item:nth-child(5){transform:rotateY(240deg) translateZ(300px);}
      .carousel-item:nth-child(6){transform:rotateY(300deg) translateZ(300px);}
      .weather-bottom-bar{padding:.85rem 1.4rem;}
    }

    /* Featured Perfumes Grid – straight corners */
    .featured{
        background:var(--bg-soft);
    }
    .perfume-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
        gap:2.1rem;
    }
    /* View All Button */
    .view-all-container{text-align:center;margin-top:2.5rem;padding-bottom:1rem;}
    .view-all-btn{display:inline-flex;align-items:center;gap:10px;padding:14px 36px;background:linear-gradient(135deg,var(--primary),var(--primary-strong));color:#022c22;font-weight:600;font-size:1rem;border:none;border-radius:999px;cursor:pointer;text-decoration:none;transition:all .3s ease;}
    .view-all-btn:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(34,197,94,0.4);}
    .view-all-btn:hover i{transform:translateX(5px);}
    .view-all-btn i{transition:transform .3s ease;}
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
    .gapsy-btn{padding:.7rem 1.4rem;border-radius:40px;font-weight:600;font-size:.85rem;text-transform:uppercase;letter-spacing:.5px;border:none;display:inline-flex;align-items:center;gap:.5rem;transition:all .2s;box-shadow:0 5px 15px rgba(0,0,0,0.3);}
    .gapsy-btn-primary{background:#fff;color:#1a1e2b;}
    .gapsy-btn-primary:hover{background:#f0f0f0;box-shadow:0 8px 20px rgba(34,197,94,0.4);}
    .gapsy-btn-secondary{background:rgba(255,255,255,0.15);backdrop-filter:blur(10px);color:#fff;border:1px solid rgba(255,255,255,0.3);}
    .gapsy-btn-secondary:hover{background:rgba(255,255,255,0.25);border-color:var(--primary);}

    .gapsy-favorite{width:40px;height:40px;border-radius:50%;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.3);color:#f97316;display:flex;align-items:center;justify-content:center;transition:all .2s;}
    .gapsy-favorite.active{background:rgba(234,179,8,0.2);border-color:#eab308;color:#facc15;}
    .gapsy-favorite:hover{transform:scale(1.1);}
    .gapsy-badge{position:absolute;top:1rem;right:1rem;background:rgba(239,68,68,0.9);color:#fff;font-size:.7rem;font-weight:700;padding:.3rem .75rem;border-radius:999px;letter-spacing:.08em;text-transform:uppercase;z-index:2;}

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

    /* Cart styles provided by shared cart.blade.php partial */

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

    /* Animations & responsive (jet keyframes in shared cart.blade.php) */
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

    /* ===== LIGHT THEME OVERRIDES FOR CUSTOMER EXPERIENCE ===== */
    html[data-theme="light"] .customer-experience {
        background: transparent;
    }
    html[data-theme="light"] .this-week-video {
        background: transparent;
        border: none;
        box-shadow: none;
    }
    html[data-theme="light"] .neon-sparkles,
    html[data-theme="light"] .neon-glow {
        display: none;
    }
    html[data-theme="light"] .current-video-wrapper {
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    html[data-theme="light"] .current-video-wrapper:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
    }
    html[data-theme="light"] .current-video-info {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }
    html[data-theme="light"] .current-video-title {
        color: #1e293b;
        text-shadow: none;
    }
    html[data-theme="light"] .current-video-title .badge {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    html[data-theme="light"] .current-video-description {
        color: #475569;
    }
    html[data-theme="light"] .video-stats {
        border-top-color: #e2e8f0;
    }
    html[data-theme="light"] .stat-item {
        background: #f8fafc;
        border-color: #e2e8f0;
    }
    html[data-theme="light"] .stat-item:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
    }
    html[data-theme="light"] .stat-value {
        color: #3b82f6;
        text-shadow: none;
    }
    html[data-theme="light"] .stat-label {
        color: #64748b;
    }
    html[data-theme="light"] .share-btn {
        background: #f8fafc;
        color: #334155;
        border-color: #e2e8f0;
    }
    html[data-theme="light"] .share-btn:hover {
        background: #e2e8f0;
        border-color: #3b82f6;
    }
    html[data-theme="light"] .share-btn.link:hover {
        background: #3b82f6;
        color: #ffffff;
    }
    /* Light theme: guess who card */
    html[data-theme="light"] .guess-who-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    html[data-theme="light"] .guess-who-title {
        background: linear-gradient(135deg, #1e293b 30%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html[data-theme="light"] .guess-who-hint {
        color: #64748b;
    }
    html[data-theme="light"] .guess-who-hint strong {
        color: #1e293b;
    }
    html[data-theme="light"] .guess-who-clue {
        background: rgba(0, 0, 0, 0.03);
        border-color: #e2e8f0;
        color: #64748b;
    }
    html[data-theme="light"] .guess-who-right {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(59, 130, 246, 0.05));
        border-left-color: #e2e8f0;
    }
    /* Light theme: reviews */
    html[data-theme="light"] .reviews-header h3 {
        color: #1e293b;
        text-shadow: none;
    }
    html[data-theme="light"] .reviews-header p {
        color: #64748b;
    }
    html[data-theme="light"] .reviews-nav-arrow {
        border-color: #e2e8f0;
        background: #ffffff;
        color: #3b82f6;
        backdrop-filter: none;
    }
    html[data-theme="light"] .reviews-nav-arrow:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }
    html[data-theme="light"] .reviews-page-dot {
        background: #cbd5e1;
        border-color: #e2e8f0;
    }
    html[data-theme="light"] .reviews-page-dot.active {
        background: #3b82f6;
        box-shadow: 0 0 8px rgba(59, 130, 246, 0.4);
    }
    html[data-theme="light"] .review-card {
        background: #ffffff;
        border-color: #e2e8f0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }
    html[data-theme="light"] .review-card::before {
        background: linear-gradient(90deg, transparent, #3b82f6, transparent);
    }
    html[data-theme="light"] .review-card:hover {
        border-color: #3b82f6;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }
    html[data-theme="light"] .review-card.featured {
        border-color: #3b82f6;
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.12);
    }
    html[data-theme="light"] .review-avatar {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }
    html[data-theme="light"] .review-customer-name {
        color: #1e293b;
    }
    html[data-theme="light"] .review-customer-title {
        color: #64748b;
    }
    html[data-theme="light"] .review-featured-badge {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: #ffffff;
    }
    html[data-theme="light"] .review-text {
        color: #475569;
    }
    html[data-theme="light"] .review-footer {
        border-top-color: #e2e8f0;
    }
    html[data-theme="light"] .review-perfume {
        color: #3b82f6;
    }
    html[data-theme="light"] .review-date {
        color: #94a3b8;
    }
    html[data-theme="light"] .reviews-loading {
        color: #64748b;
    }
    html[data-theme="light"] .section.customer-experience .section-title {
        color: #1e293b;
    }
    html[data-theme="light"] .section.customer-experience .section-subtitle {
        color: #64748b;
    }

    /* ===========================================
       MOOD MATCH MODAL — PREMIUM REDESIGN
       =========================================== */
    .mood-match-modal{
      position:fixed;top:0;left:0;width:100%;height:100%;
      background:rgba(2,3,10,0.94);
      display:flex;align-items:center;justify-content:center;
      z-index:99999;opacity:0;visibility:hidden;
      transition:all .5s cubic-bezier(0.2,0.9,0.3,1);
      backdrop-filter:blur(22px);
    }
    .mood-match-modal.active{opacity:1;visibility:visible;}

    .mood-match-container{
      background:linear-gradient(145deg,#060710 0%,#0e0b20 55%,#060710 100%);
      border-radius:32px;width:96%;max-width:1180px;max-height:93vh;
      overflow:hidden;display:flex;flex-direction:column;
      border:1px solid rgba(192,132,252,0.2);
      box-shadow:0 0 0 1px rgba(192,132,252,0.07),0 60px 140px rgba(0,0,0,0.9),inset 0 1px 0 rgba(255,255,255,0.05);
      animation:modalSlideIn .45s cubic-bezier(0.2,0.9,0.3,1) both;
    }
    @keyframes modalSlideIn{from{transform:translateY(30px) scale(0.97);opacity:0;}to{transform:translateY(0) scale(1);opacity:1;}}

    .mood-match-header{
      padding:1.3rem 2rem;
      border-bottom:1px solid rgba(192,132,252,0.1);
      background:linear-gradient(90deg,rgba(192,132,252,0.08) 0%,rgba(99,102,241,0.04) 50%,transparent 100%);
      display:flex;justify-content:space-between;align-items:center;flex-shrink:0;
      position:relative;overflow:hidden;
    }
    .mood-match-header::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(192,132,252,0.4),transparent);}
    .mood-match-title{font-size:1.3rem;color:#f1f5ff;display:flex;align-items:center;gap:.7rem;font-weight:800;letter-spacing:-.02em;}
    .mood-match-title i{color:#c084fc;}
    .mm-ai-badge{font-size:.65rem;padding:.22rem .65rem;border-radius:999px;background:linear-gradient(135deg,rgba(192,132,252,0.2),rgba(99,102,241,0.15));border:1px solid rgba(192,132,252,0.3);color:#c084fc;font-weight:700;letter-spacing:.1em;text-transform:uppercase;}
    .close-mood-match{background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:rgba(241,245,255,0.4);width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all .25s;cursor:pointer;}
    .close-mood-match:hover{background:rgba(239,68,68,0.15);border-color:rgba(239,68,68,0.5);color:#f87171;transform:rotate(90deg);}

    .mood-match-content{display:grid;grid-template-columns:1fr 1.05fr;flex:1;overflow:auto;gap:0;}
    .mood-left-panel{padding:1.8rem 2rem;border-right:1px solid rgba(255,255,255,0.05);display:flex;flex-direction:column;gap:1.1rem;overflow-y:auto;}
    .mood-right-panel{padding:1.8rem 2rem;display:flex;flex-direction:column;gap:1.1rem;overflow-y:auto;background:linear-gradient(180deg,rgba(192,132,252,0.03) 0%,transparent 60%);}

    .mood-camera-container{
      position:relative;width:100%;height:250px;
      background:linear-gradient(135deg,#04060e,#080d1c);
      border-radius:20px;overflow:hidden;
      border:1px solid rgba(192,132,252,0.14);
      box-shadow:inset 0 0 50px rgba(0,0,0,0.7);
    }
    .mood-camera-container::before{
      content:'';position:absolute;inset:0;
      background:linear-gradient(135deg,rgba(192,132,252,0.06) 0%,transparent 50%);
      pointer-events:none;z-index:1;
    }
    .mood-camera-feed{width:100%;height:100%;object-fit:cover;display:none;}
    .mood-camera-placeholder{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.55rem;color:rgba(241,245,255,0.3);position:relative;z-index:2;}
    .mood-camera-placeholder i{font-size:3rem;color:rgba(192,132,252,0.3);margin-bottom:.2rem;}
    .mood-camera-placeholder p{font-size:.78rem;letter-spacing:.04em;}

    .mood-camera-scan{position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,transparent,rgba(192,132,252,0.8),transparent);animation:scanLine 2.5s ease-in-out infinite;z-index:5;display:none;}
    .mood-camera-container.scanning .mood-camera-scan{display:block;}
    @keyframes scanLine{0%{top:0;opacity:1;}100%{top:100%;opacity:0;}}

    .mood-camera-container::after{content:'';position:absolute;top:10px;left:10px;width:30px;height:30px;border-top:2px solid rgba(192,132,252,0.6);border-left:2px solid rgba(192,132,252,0.6);border-radius:2px 0 0 0;z-index:3;pointer-events:none;}

    .mood-camera-controls{display:flex;gap:.55rem;flex-wrap:wrap;}
    .mood-btn{padding:.58rem 1.1rem;border-radius:10px;border:none;font-size:.8rem;font-weight:700;display:inline-flex;align-items:center;gap:.4rem;transition:all .25s;font-family:inherit;cursor:pointer;letter-spacing:.01em;}
    .mood-btn-primary{background:linear-gradient(135deg,#22c55e,#16a34a);color:#022c22;box-shadow:0 4px 14px rgba(34,197,94,0.3);}
    .mood-btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(34,197,94,0.5);}
    .mood-btn-secondary{background:rgba(255,255,255,0.04);color:rgba(241,245,255,0.65);border:1px solid rgba(255,255,255,0.1);}
    .mood-btn-secondary:hover{border-color:rgba(192,132,252,0.45);color:#f1f5ff;background:rgba(192,132,252,0.06);}
    .mood-btn:disabled{opacity:.3;pointer-events:none;}

    .mood-upload-area{border:1.5px dashed rgba(192,132,252,0.25);border-radius:14px;padding:1.1rem;text-align:center;color:rgba(241,245,255,0.35);cursor:pointer;transition:all .3s;font-size:.82rem;background:rgba(192,132,252,0.02);}
    .mood-upload-area:hover{border-color:rgba(192,132,252,0.6);background:rgba(192,132,252,0.05);color:rgba(241,245,255,0.7);transform:translateY(-1px);}

    .mood-options-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:6px;}
    .mood-option-btn{
      padding:9px 5px;background:rgba(255,255,255,0.02);border-radius:12px;
      border:1px solid rgba(255,255,255,0.07);color:rgba(241,245,255,0.55);
      display:flex;flex-direction:column;align-items:center;gap:3px;
      font-size:.7rem;font-weight:600;transition:all .22s;cursor:pointer;
    }
    .mood-option-btn:hover{background:rgba(192,132,252,0.1);border-color:rgba(192,132,252,0.35);color:#e9d5ff;transform:translateY(-2px);}
    .mood-option-btn.active{background:rgba(192,132,252,0.18);border-color:#c084fc;color:#f1f5ff;box-shadow:0 4px 16px rgba(192,132,252,0.25);}
    .mood-option-btn .mood-emoji{font-size:1.5rem;filter:drop-shadow(0 2px 6px rgba(0,0,0,0.5));}

    .mood-mode-selector{display:flex;gap:5px;background:rgba(255,255,255,0.03);border-radius:12px;padding:4px;border:1px solid rgba(255,255,255,0.06);}
    .mood-mode-btn{flex:1;padding:.48rem .9rem;background:transparent;border-radius:9px;border:none;color:rgba(241,245,255,0.4);display:flex;align-items:center;justify-content:center;gap:5px;font-size:.78rem;font-weight:700;cursor:pointer;transition:all .25s;font-family:inherit;text-transform:uppercase;letter-spacing:.06em;}
    .mood-mode-btn.active{background:linear-gradient(135deg,rgba(192,132,252,0.2),rgba(99,102,241,0.15));color:#f1f5ff;box-shadow:0 2px 12px rgba(192,132,252,0.25);}
    .mood-analyze-btn{width:100%;justify-content:center;padding:.8rem;font-size:.88rem;letter-spacing:.02em;}
    .mood-option-btn{--mood-color:#c084fc;}
    .mood-option-btn:hover{box-shadow:0 4px 18px var(--mood-color,rgba(192,132,252,0.3));}
    .mood-option-btn.active{box-shadow:0 4px 20px var(--mood-color,rgba(192,132,252,0.3));border-color:var(--mood-color,#c084fc);}
    #moodPerfumeIcon{transition:all .4s;}

    .mood-aura-display{
      position:relative;text-align:center;padding:2rem 1rem 1.5rem;
      background:radial-gradient(ellipse 80% 80% at 50% 50%,rgba(192,132,252,0.08) 0%,transparent 70%);
      border-radius:22px;border:1px solid rgba(192,132,252,0.12);
      overflow:hidden;
    }
    .mood-aura-ring{
      position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
      width:120px;height:120px;border-radius:50%;
      border:1px solid rgba(192,132,252,0.15);
      animation:auraPulse 3s ease-in-out infinite;
      pointer-events:none;
    }
    .mood-aura-ring:nth-child(2){width:160px;height:160px;animation-delay:.6s;border-color:rgba(192,132,252,0.08);}
    .mood-aura-ring:nth-child(3){width:200px;height:200px;animation-delay:1.2s;border-color:rgba(192,132,252,0.04);}
    @keyframes auraPulse{0%,100%{transform:translate(-50%,-50%) scale(1);opacity:1;}50%{transform:translate(-50%,-50%) scale(1.08);opacity:.6;}}
    .mood-icon{font-size:3.8rem;position:relative;z-index:2;filter:drop-shadow(0 0 18px rgba(192,132,252,0.5));margin-bottom:.5rem;display:block;transition:all .4s;}
    .mood-text{font-size:1.35rem;font-weight:800;color:#f1f5ff;letter-spacing:-.02em;position:relative;z-index:2;}
    .mood-confidence{color:rgba(241,245,255,0.45);font-size:.82rem;margin-top:.3rem;position:relative;z-index:2;}

    .emotion-chart{display:flex;flex-direction:column;gap:.5rem;}
    .emotion-chart-title{font-size:.68rem;text-transform:uppercase;letter-spacing:.12em;color:rgba(241,245,255,0.3);margin-bottom:.2rem;}
    .emotion-bar-row{display:flex;align-items:center;gap:.65rem;}
    .emotion-label{font-size:.72rem;color:rgba(241,245,255,0.45);width:68px;text-align:right;font-weight:600;}
    .emotion-track{flex:1;height:5px;background:rgba(255,255,255,0.05);border-radius:999px;overflow:hidden;}
    .emotion-fill{height:100%;border-radius:999px;transition:width .7s cubic-bezier(0.2,0.9,0.3,1);}
    .emotion-pct{font-size:.7rem;color:rgba(241,245,255,0.35);width:30px;text-align:right;}

    .mood-perfume-recommendation{
      background:linear-gradient(145deg,rgba(192,132,252,0.08),rgba(34,197,94,0.04));
      border-radius:22px;padding:1.5rem;
      border:1px solid rgba(192,132,252,0.18);
      position:relative;overflow:hidden;
      box-shadow:0 8px 35px rgba(0,0,0,0.35),inset 0 1px 0 rgba(255,255,255,0.04);
    }
    .mood-perfume-recommendation::before{
      content:'';position:absolute;top:0;left:0;right:0;height:2px;
      background:linear-gradient(90deg,transparent,#c084fc,transparent);
    }
    .mood-perfume-header{display:flex;align-items:center;margin-bottom:1rem;gap:.85rem;}
    .mood-perfume-image{
      width:60px;height:60px;
      background:linear-gradient(135deg,rgba(192,132,252,0.18),rgba(34,197,94,0.08));
      border-radius:14px;display:flex;align-items:center;justify-content:center;
      font-size:1.7rem;color:#c084fc;border:1px solid rgba(192,132,252,0.25);flex-shrink:0;
      box-shadow:0 4px 16px rgba(192,132,252,0.2);
    }
    .mood-perfume-info h3{color:#f1f5ff;margin-bottom:3px;font-size:1.1rem;font-weight:800;}
    .mood-perfume-info p{color:rgba(241,245,255,0.45);font-size:.82rem;}
    .mood-perfume-desc{color:rgba(241,245,255,0.55);font-size:.86rem;line-height:1.65;border-left:3px solid rgba(192,132,252,0.4);padding-left:.85rem;margin:.4rem 0;}
    .mood-perfume-notes{display:flex;flex-wrap:wrap;gap:5px;margin-top:.6rem;}
    .mood-note-tag{background:rgba(255,255,255,0.04);padding:.22rem .6rem;border-radius:999px;font-size:.72rem;color:rgba(241,245,255,0.55);border:1px solid rgba(255,255,255,0.09);}

    .mood-traits{display:flex;flex-wrap:wrap;gap:.4rem;margin:.5rem 0;}
    .mood-trait{font-size:.7rem;padding:.2rem .6rem;border-radius:999px;font-weight:600;letter-spacing:.04em;}
    .mood-trait.purple{background:rgba(192,132,252,0.12);border:1px solid rgba(192,132,252,0.3);color:#c084fc;}
    .mood-trait.green{background:rgba(74,222,128,0.1);border:1px solid rgba(74,222,128,0.3);color:#4ade80;}
    .mood-trait.blue{background:rgba(56,189,248,0.1);border:1px solid rgba(56,189,248,0.3);color:#38bdf8;}

    /* ── GUESS WHO SECTION ── */
    .guess-who-card{
      position:relative;max-width:1300px;margin:0 auto;
      display:grid;grid-template-columns:1.2fr 0.8fr;
      background:linear-gradient(145deg,#06060f,#0d0a1e);
      border:1px solid rgba(192,132,252,0.2);border-radius:28px;
      overflow:hidden;box-shadow:0 40px 100px rgba(0,0,0,0.7),0 0 0 1px rgba(192,132,252,0.1);
    }
    .guess-who-glow{position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 80% 50%,rgba(192,132,252,0.1) 0%,transparent 60%);pointer-events:none;}
    .guess-who-left{padding:3.5rem;display:flex;flex-direction:column;gap:1.6rem;position:relative;z-index:2;}
    .guess-who-badge{display:inline-flex;align-items:center;gap:.4rem;padding:.3rem .9rem;border-radius:999px;background:rgba(192,132,252,0.12);border:1px solid rgba(192,132,252,0.3);color:#c084fc;font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;width:fit-content;}
    .guess-who-title{font-size:3.5rem;font-weight:900;background:linear-gradient(135deg,#fff 30%,#c084fc 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;line-height:1;margin:0;}
    .guess-who-hint{color:rgba(241,245,255,0.6);font-size:1rem;line-height:1.75;max-width:480px;}
    .guess-who-hint strong{color:rgba(241,245,255,0.9);}
    .guess-who-clues{display:flex;flex-wrap:wrap;gap:.6rem;}
    .guess-who-clue{display:flex;align-items:center;gap:.45rem;padding:.4rem .9rem;border-radius:999px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);color:rgba(241,245,255,0.6);font-size:.8rem;}
    .guess-who-clue i{color:#c084fc;font-size:.75rem;}
    .guess-who-countdown{display:flex;align-items:center;gap:.5rem;margin-top:.5rem;}
    .gw-count-block{display:flex;flex-direction:column;align-items:center;background:rgba(192,132,252,0.08);border:1px solid rgba(192,132,252,0.2);border-radius:12px;padding:.6rem 1rem;min-width:60px;}
    .gw-count-block span:first-child{font-size:1.8rem;font-weight:800;color:#c084fc;line-height:1;}
    .gw-count-block span:last-child{font-size:.6rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(241,245,255,0.35);margin-top:.2rem;}
    .gw-count-sep{font-size:1.6rem;font-weight:700;color:rgba(192,132,252,0.4);margin-bottom:.4rem;}
    .guess-who-right{display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,rgba(192,132,252,0.05),rgba(99,102,241,0.08));border-left:1px solid rgba(192,132,252,0.1);position:relative;z-index:2;}
    .guess-who-silhouette{display:flex;flex-direction:column;align-items:center;gap:1.2rem;padding:3rem 2rem;}
    .gw-silhouette-img{width:160px;height:160px;border-radius:50%;background:linear-gradient(135deg,rgba(192,132,252,0.15),rgba(99,102,241,0.2));border:2px solid rgba(192,132,252,0.25);display:flex;align-items:center;justify-content:center;box-shadow:0 0 60px rgba(192,132,252,0.2);animation:gwPulse 3s ease-in-out infinite;}
    .gw-silhouette-img i{font-size:5rem;color:rgba(192,132,252,0.4);}
    @keyframes gwPulse{0%,100%{box-shadow:0 0 40px rgba(192,132,252,0.15);}50%{box-shadow:0 0 80px rgba(192,132,252,0.35);}}
    .gw-org-pill{padding:.5rem 1.2rem;border-radius:999px;background:rgba(192,132,252,0.1);border:1px solid rgba(192,132,252,0.3);color:#c084fc;font-size:.82rem;font-weight:600;letter-spacing:.04em;}
    @media(max-width:768px){
      .guess-who-card{grid-template-columns:1fr;}
      .guess-who-right{border-left:none;border-top:1px solid rgba(192,132,252,0.1);}
    }

    @media(max-width:1024px){
        .hero{
            padding:3rem 2.2rem 2rem;
            grid-template-columns:1fr;
        }
        .section{padding:3.5rem 2.2rem;}
        .mood-match-container {
            width: 98%;
            max-height: 95vh;
        }
        .mood-match-content {
            grid-template-columns: 1fr;
        }
        .mood-options-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .current-video-container {
            grid-template-columns: 1fr;
        }
        .current-video-wrapper {
            border-radius: 28px 28px 0 0;
            min-height: 350px;
        }
        .current-video-info {
            border-radius: 0 0 28px 28px;
            border-left: none;
            border-top: 1px solid rgba(192,132,252,0.12);
        }
    }
    
    @media(max-width:768px){
        .header{padding:1rem 1.5rem;}
        .nav-links{display:none;}
        .mobile-menu-toggle { display: block; }
        .hero-title{font-size:3rem;}
        .section{padding:3.2rem 1.5rem;}
        .footer{padding:3rem 1.5rem 2rem;}
        .footer-content{
            grid-template-columns:1fr 1fr;
        }
        .mood-left-panel {
            border-right: none;
            border-bottom: 1px solid rgba(192,132,252,0.1);
        }
    }
    
    @media(max-width:768px){
        .gapsy-card{height:420px;}
        .gapsy-card-title{font-size:1.8rem;}
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

    /* ── PROMO TICKER ── */
    .promo-banner{background:linear-gradient(90deg,rgba(5,8,22,0.98),rgba(7,15,37,0.99));border-top:1px solid rgba(34,197,94,0.2);border-bottom:1px solid rgba(34,197,94,0.2);overflow:hidden;padding:.6rem 0;}
    .promo-ticker{overflow:hidden;white-space:nowrap;}
    .promo-track{display:inline-flex;animation:ticker 30s linear infinite;}
    .promo-track:hover{animation-play-state:paused;}
    .promo-item{font-size:.82rem;color:var(--text-muted);padding:0 2rem;white-space:nowrap;}
    .promo-item i{color:var(--primary);margin-right:.4rem;}
    @keyframes ticker{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}
    html[data-theme="light"] .promo-banner{background:linear-gradient(90deg,rgba(255,255,255,0.98),rgba(248,250,252,0.99));border-color:rgba(34,197,94,0.15);}

    /* ── PACKAGING SECTION ── */
    .pkg-section{padding:5rem 2rem;background:var(--bg);}
    .section-label-badge{display:inline-flex;align-items:center;gap:.5rem;font-size:.72rem;letter-spacing:.18em;text-transform:uppercase;color:var(--primary);margin-bottom:1rem;padding:.3rem .9rem;border:1px solid rgba(34,197,94,0.35);border-radius:999px;background:rgba(34,197,94,0.07);}
    .pkg-slider-wrapper{display:flex;align-items:center;gap:1rem;max-width:1000px;margin:0 auto;}
    .pkg-track-outer{flex:1;overflow:hidden;}
    .pkg-slider{display:flex;gap:1.5rem;width:fit-content;transition:transform .4s cubic-bezier(.4,0,.2,1);}
    .pkg-slide{flex:0 0 280px;}
    .pkg-img-box{border-radius:20px;overflow:hidden;border:1px solid var(--border-subtle);aspect-ratio:3/4;background:rgba(5,8,22,0.9);transition:border-color .3s,transform .3s,box-shadow .3s;cursor:pointer;}
    .pkg-img-box:hover{border-color:rgba(34,197,94,0.45);transform:translateY(-4px);box-shadow:0 20px 45px rgba(0,0,0,0.5);}
    .pkg-img-box img{width:100%;height:100%;object-fit:cover;display:block;}
    .pkg-placeholder{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.8rem;background:var(--pp,rgba(34,197,94,0.07));}
    .pkg-placeholder i{font-size:2.5rem;color:var(--text-muted);opacity:.4;}
    .pkg-placeholder span{font-size:.75rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);opacity:.4;}
    .pkg-caption{text-align:center;font-size:.8rem;color:var(--text-muted);margin-top:.75rem;letter-spacing:.04em;}
    .pkg-arrow{width:44px;height:44px;border-radius:50%;flex-shrink:0;border:1px solid var(--border-subtle);background:rgba(5,8,22,0.9);color:var(--text-muted);font-size:.9rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s;}
    .pkg-arrow:hover{border-color:var(--primary);color:var(--primary);}
    .pkg-dots{display:flex;justify-content:center;gap:.5rem;margin-top:1.5rem;}
    .pkg-dot{width:8px;height:8px;border-radius:50%;background:rgba(148,163,184,0.3);cursor:pointer;transition:.3s;}
    .pkg-dot.active{background:var(--primary);width:22px;border-radius:4px;}
    html[data-theme="light"] .pkg-section{background:#ffffff;}
    html[data-theme="light"] .pkg-img-box{background:#f8fafc;border-color:rgba(100,116,139,0.2);}
    html[data-theme="light"] .pkg-arrow{background:#fff;border-color:rgba(100,116,139,0.2);}

    /* ── DISCOUNT BAR ── */
    .discount-bar{position:fixed;top:0;left:0;right:0;z-index:99998;padding:.65rem 1.5rem;background:var(--db-bg,linear-gradient(90deg,#16a34a,#22c55e));box-shadow:0 4px 20px rgba(0,0,0,0.4);animation:discountSlideDown .4s ease-out;}
    @keyframes discountSlideDown{from{transform:translateY(-100%);}to{transform:translateY(0);}}
    .discount-bar-inner{display:flex;align-items:center;justify-content:center;gap:.8rem;max-width:900px;margin:0 auto;position:relative;}
    .discount-bar-icon{font-size:1rem;color:#022c22;}
    .discount-bar-text{font-size:.85rem;font-weight:600;color:#022c22;text-align:center;}
    .discount-bar-text strong{font-weight:800;}
    .discount-bar-close{position:absolute;right:0;top:50%;transform:translateY(-50%);background:rgba(0,0,0,0.15);border:none;color:#022c22;width:26px;height:26px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.8rem;transition:.2s;}
    .discount-bar-close:hover{background:rgba(0,0,0,0.3);}

    /* ── ADMIN PANEL ── */
    .admin-toggle{position:fixed;bottom:2rem;right:2rem;z-index:9997;width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,#16a34a,#22c55e);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#022c22;cursor:pointer;box-shadow:0 8px 25px rgba(22,163,74,0.5);transition:.3s;animation:adminPulse 3s ease-in-out infinite;}
    .admin-toggle:hover{transform:scale(1.08);}
    @keyframes adminPulse{0%,100%{box-shadow:0 8px 25px rgba(22,163,74,0.5);}50%{box-shadow:0 8px 35px rgba(22,163,74,0.8),0 0 0 8px rgba(34,197,94,0.1);}}
    .admin-panel{position:fixed;bottom:5.5rem;right:2rem;z-index:9997;width:360px;max-height:80vh;overflow-y:auto;background:rgba(7,15,37,0.98);border:1px solid rgba(34,197,94,0.35);border-radius:20px;box-shadow:0 24px 60px rgba(0,0,0,0.7);backdrop-filter:blur(20px);opacity:0;visibility:hidden;transform:translateY(12px) scale(.97);transition:.3s cubic-bezier(.4,0,.2,1);}
    .admin-panel.open{opacity:1;visibility:visible;transform:translateY(0) scale(1);}
    .admin-panel-header{display:flex;align-items:center;justify-content:space-between;padding:1.2rem 1.5rem;border-bottom:1px solid rgba(148,163,184,0.12);position:sticky;top:0;background:rgba(7,15,37,0.98);border-radius:20px 20px 0 0;}
    .admin-panel-title{font-size:.92rem;font-weight:700;color:var(--primary);display:flex;align-items:center;gap:.5rem;}
    .admin-close{background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:1rem;transition:.2s;}
    .admin-close:hover{color:var(--text-main);}
    .admin-panel-body{padding:1rem 1.5rem 1.5rem;display:flex;flex-direction:column;gap:1.2rem;}
    .admin-block{background:rgba(255,255,255,0.03);border:1px solid rgba(148,163,184,0.1);border-radius:14px;padding:1.2rem;}
    .admin-block-title{font-size:.8rem;font-weight:700;color:var(--text-main);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.9rem;display:flex;align-items:center;gap:.5rem;}
    .admin-block-title i{color:var(--primary);}
    .admin-row{display:flex;align-items:center;justify-content:space-between;}
    .admin-label{font-size:.82rem;color:var(--text-muted);}
    .admin-toggle-switch{position:relative;display:inline-block;width:44px;height:24px;}
    .admin-toggle-switch input{opacity:0;width:0;height:0;}
    .admin-slider-sw{position:absolute;inset:0;border-radius:999px;background:rgba(148,163,184,0.2);cursor:pointer;transition:.3s;}
    .admin-slider-sw::before{content:'';position:absolute;height:18px;width:18px;border-radius:50%;left:3px;bottom:3px;background:#fff;transition:.3s;}
    .admin-toggle-switch input:checked+.admin-slider-sw{background:var(--primary);}
    .admin-toggle-switch input:checked+.admin-slider-sw::before{transform:translateX(20px);}
    .admin-input{width:100%;padding:.55rem .8rem;border-radius:10px;border:1px solid rgba(148,163,184,0.2);background:rgba(255,255,255,0.04);color:var(--text-main);font-size:.82rem;font-family:'Poppins',sans-serif;outline:none;transition:.2s;}
    .admin-input:focus{border-color:var(--primary);}
    .admin-apply-btn{margin-top:1rem;width:100%;padding:.6rem;border-radius:10px;border:none;background:linear-gradient(135deg,#22c55e,#16a34a);color:#022c22;font-weight:700;font-size:.82rem;cursor:pointer;font-family:'Poppins',sans-serif;transition:.2s;}
    .admin-apply-btn:hover{opacity:.9;}
    .admin-colour-btn{padding:.35rem .8rem;border-radius:8px;border:2px solid transparent;color:#fff;font-size:.75rem;font-weight:600;cursor:pointer;transition:.2s;font-family:'Poppins',sans-serif;}
    .admin-colour-btn.active{border-color:#fff;}
    .admin-promo-msg{display:flex;align-items:center;justify-content:space-between;gap:.5rem;background:rgba(255,255,255,0.04);border-radius:8px;padding:.4rem .7rem;font-size:.78rem;color:var(--text-muted);}
    .admin-promo-del{background:none;border:none;color:rgba(239,68,68,0.6);cursor:pointer;font-size:.8rem;transition:.2s;}
    .admin-promo-del:hover{color:#ef4444;}
    .admin-pkg-row{display:flex;align-items:center;gap:.7rem;background:rgba(255,255,255,0.03);border-radius:10px;padding:.6rem .8rem;}
    .admin-pkg-label{flex:1;font-size:.8rem;color:var(--text-muted);}
    .admin-pkg-upload{padding:.35rem .75rem;border-radius:8px;border:1px solid rgba(34,197,94,0.4);background:rgba(34,197,94,0.07);color:var(--primary);font-size:.75rem;cursor:pointer;font-family:'Poppins',sans-serif;transition:.2s;}
    .admin-pkg-upload:hover{background:rgba(34,197,94,0.15);}
    html[data-theme="light"] .admin-panel{background:rgba(255,255,255,0.98);border-color:rgba(34,197,94,0.25);}
    html[data-theme="light"] .admin-panel-header{background:rgba(255,255,255,0.98);}
    html[data-theme="light"] .admin-block{background:rgba(0,0,0,0.02);border-color:rgba(100,116,139,0.12);}
    html[data-theme="light"] .admin-input{background:rgba(0,0,0,0.03);border-color:rgba(100,116,139,0.2);color:#1e293b;}
    html[data-theme="light"] .admin-promo-msg{background:rgba(0,0,0,0.03);}
    html[data-theme="light"] .admin-pkg-row{background:rgba(0,0,0,0.02);}
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

<!-- LADIES STAMP -->
<img alt="Ladies Collection - Coming Soon" class="ladies-stamp" id="ladiesStamp" src="/Ladies.png" title="Ladies Collection - Coming Soon"/>
<!-- COMING SOON MODAL -->
<div class="coming-soon-modal" id="comingSoonModal">
<div class="coming-soon-content">
<img alt="Ladies Collection" src="/Ladies.png"/>
<h2>Coming Soon</h2>
<p>Our exclusive Ladies Collection is on its way. Stay tuned for something truly special!</p>
<button class="coming-soon-close" id="closeComingSoon">Close</button>
</div>
</div>

<!-- NABI PAK SAW STAMP -->
<img alt="Nabi Pak SAW Stamp - TROY Perfumes Contribution" class="nabipak-stamp" id="nabiStamp" src="/PBUH.png" title="Nabi Pak SAW Stamp - Click for contribution details"/>
<!-- CONTRIBUTION POPUP -->
<div class="contribution-modal" id="contributionModal">
<div class="contribution-content">
<h2 class="contribution-title">Contribution in the Name of Allah</h2>
<p class="contribution-text">
                As part of our commitment, 2% of your order amount will be contributed in the name of Allah. 
                Please press the stamp of Nabi Pak SAW to confirm your contribution and proceed with checkout.
            </p>
<img alt="Nabi Pak SAW Stamp - Confirm Contribution" class="contribution-stamp" id="confirmContribution" src="/PBUH.png" title="Click to confirm contribution"/>
<p class="contribution-note">May Allah accept your contribution and bless you</p>
</div>
</div>

<!-- MOOD MATCH MODAL (Premium Redesign) -->
<div class="mood-match-modal" id="moodMatchModal">
    <div class="mood-match-container">

        <!-- Header -->
        <div class="mood-match-header">
            <h2 class="mood-match-title">
                <i class="fas fa-smile-beam"></i>
                TROY &mdash; Mood Match
                <span class="mm-ai-badge">✦ AI Powered</span>
            </h2>
            <button class="close-mood-match" id="closeMoodMatch" title="Close"><i class="fas fa-times"></i></button>
        </div>

        <!-- Two-column body -->
        <div class="mood-match-content">

            <!-- LEFT PANEL -->
            <div class="mood-left-panel">

                <!-- Camera / image area -->
                <div class="mood-camera-container" id="moodCameraBox">
                    <div class="mood-camera-scan" id="moodScanLine"></div>
                    <span style="position:absolute;bottom:10px;right:10px;width:28px;height:28px;border-bottom:2px solid rgba(192,132,252,0.5);border-right:2px solid rgba(192,132,252,0.5);border-radius:0 0 2px 0;z-index:3;pointer-events:none;"></span>
                    <div class="mood-camera-placeholder" id="moodCameraPlaceholder">
                        <div style="width:70px;height:70px;border-radius:50%;border:2px dashed rgba(192,132,252,0.3);display:flex;align-items:center;justify-content:center;margin-bottom:.5rem;">
                            <i class="fas fa-user" style="font-size:1.8rem;color:rgba(192,132,252,0.4);"></i>
                        </div>
                        <p style="font-weight:600;color:rgba(241,245,255,0.5);">Face Detection Ready</p>
                        <p style="font-size:.72rem;margin-top:.2rem;">Start camera or upload a photo</p>
                    </div>
                    <video id="moodCameraFeed" class="mood-camera-feed" autoplay playsinline></video>
                    <canvas id="moodPhotoCanvas" style="display:none;"></canvas>
                    <img id="moodCapturedImage" style="display:none;width:100%;height:100%;object-fit:cover;position:absolute;inset:0;" alt="Captured">
                </div>

                <!-- Controls row -->
                <div class="mood-camera-controls">
                    <button class="mood-btn mood-btn-primary" id="moodStartCameraBtn"><i class="fas fa-video"></i> Camera</button>
                    <button class="mood-btn mood-btn-secondary" id="moodCaptureBtn" disabled><i class="fas fa-camera"></i> Capture</button>
                    <button class="mood-btn mood-btn-secondary" id="moodResetBtn"><i class="fas fa-redo"></i> Reset</button>
                </div>

                <!-- Upload -->
                <div class="mood-upload-area" id="moodUploadArea">
                    <i class="fas fa-cloud-upload-alt" style="font-size:1.5rem;display:block;margin-bottom:.35rem;color:rgba(192,132,252,0.5);"></i>
                    <span style="font-weight:600;">Upload a photo</span>
                    <span style="font-size:.72rem;display:block;margin-top:.15rem;color:rgba(241,245,255,0.3);">JPG, PNG or WEBP</span>
                    <input type="file" id="moodImageUpload" accept="image/*" style="display:none;">
                </div>

                <!-- Analyze button -->
                <button class="mood-btn mood-btn-primary mood-analyze-btn" id="moodAnalyzeBtn" disabled>
                    <i class="fas fa-brain"></i> Analyze Mood with AI
                </button>

                <!-- Divider -->
                <div style="display:flex;align-items:center;gap:.6rem;">
                    <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
                    <span style="font-size:.68rem;color:rgba(241,245,255,0.25);text-transform:uppercase;letter-spacing:.1em;">or try a mood</span>
                    <div style="flex:1;height:1px;background:rgba(255,255,255,0.06);"></div>
                </div>

                <!-- Sample moods grid -->
                <div class="mood-options-grid" id="moodOptionsGrid"></div>

            </div>

            <!-- RIGHT PANEL -->
            <div class="mood-right-panel">

                <!-- Mode selector -->
                <div class="mood-mode-selector">
                    <div class="mood-mode-btn active" data-mode="simulation"><i class="fas fa-robot"></i> AI Simulation</div>
                    <div class="mood-mode-btn" data-mode="mood-match"><i class="fas fa-heart"></i> Mood Match</div>
                </div>

                <!-- Aura / mood result -->
                <div class="mood-aura-display" id="moodAuraDisplay">
                    <div class="mood-aura-ring"></div>
                    <div class="mood-aura-ring"></div>
                    <div class="mood-aura-ring"></div>
                    <span class="mood-icon" id="moodDisplayIcon" style="transition:transform .3s;">😊</span>
                    <div class="mood-text" id="moodDisplayText">Ready for Mood Analysis</div>
                    <div class="mood-confidence" id="moodDisplayConfidence">Take a photo or pick a mood below</div>
                </div>

                <!-- Personality traits -->
                <div class="mood-traits" id="moodTraits" style="display:none;">
                    <i class="fas fa-sparkles" style="font-size:.7rem;color:rgba(192,132,252,0.5);margin-right:.2rem;"></i>
                    <span class="mood-trait purple" id="trait1"></span>
                    <span class="mood-trait green"  id="trait2"></span>
                    <span class="mood-trait blue"   id="trait3"></span>
                </div>

                <!-- Emotion bars -->
                <div class="emotion-chart" id="moodEmotionChart">
                    <div class="emotion-chart-title">Emotion Analysis</div>
                </div>

                <!-- Perfume recommendation card -->
                <div class="mood-perfume-recommendation" id="moodPerfumeRecommendation">
                    <div class="mood-perfume-header">
                        <div class="mood-perfume-image" id="moodPerfumeIcon"><i class="fas fa-wind"></i></div>
                        <div class="mood-perfume-info" style="flex:1;">
                            <h3 id="recommendedPerfumeName">Royal Oud</h3>
                            <p id="recommendedPerfumeMatch">Your perfect scent match</p>
                        </div>
                    </div>
                    <p class="mood-perfume-desc" id="moodPerfumeDescription">Deep oud, sandalwood and amber. Made for those who command the room.</p>
                    <div class="mood-perfume-notes" id="moodPerfumeNotes">
                        <div class="mood-note-tag">Oud</div>
                        <div class="mood-note-tag">Sandalwood</div>
                        <div class="mood-note-tag">Amber</div>
                    </div>
                    <div style="margin-top:1.1rem;display:flex;gap:.6rem;align-items:center;">
                        <button class="mood-btn mood-btn-primary" id="moodAddToCart" style="flex:1;justify-content:center;">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button class="mood-btn mood-btn-secondary" onclick="closeMoodMatch()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Floating Particles -->
<div class="particles" id="particles"></div>
{{-- Jet icon now provided by cart partial --}}
@include('navbar')
@include('cart')
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
    <!-- TV SCREEN + VIDEO -->
    <div class="hero-video-container tv-screen" id="tvScreenContainer">
        <video id="tvScreenVideo" autoplay muted loop playsinline
               src="https://www.youtube.com/embed/5qap5aO4i9A"
               style="display:none;">
        </video>
        <iframe id="tvScreenIframe" 
                src="https://www.youtube.com/embed/5qap5aO4i9A?autoplay=1&mute=1&loop=1&playlist=5qap5aO4i9A&controls=0&showinfo=0&modestbranding=1" 
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

<!-- ── PROMO TICKER BANNER ── -->
<div class="promo-banner" id="promoBanner">
  <div class="promo-ticker">
    <div class="promo-track" id="promoTrack">
      <span class="promo-item"><i class="fas fa-tag"></i> Free shipping on orders above PKR 3,000 &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-gift"></i> Complimentary gift wrap on every order &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-star"></i> New arrivals — Summer 2026 Collection now live &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-truck"></i> Same-day delivery available in Lahore &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-tag"></i> Free shipping on orders above PKR 3,000 &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-gift"></i> Complimentary gift wrap on every order &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-star"></i> New arrivals — Summer 2026 Collection now live &nbsp;·&nbsp;</span>
      <span class="promo-item"><i class="fas fa-truck"></i> Same-day delivery available in Lahore &nbsp;·&nbsp;</span>
    </div>
  </div>
</div>

<section class="section promotions">
<div class="promotions-layout">
<!-- LEFT: Weather + perfumes -->
<div class="promotions-main">
<!-- Weather Section – GAPSY redesign -->
<section class="weather-section" id="weather">

    <!-- Section heading outside the card -->
    <div style="text-align:center;margin-bottom:1.8rem;padding-top:2.2rem;position:relative;">
        <h2 class="section-title" style="font-size:4.4rem;line-height:1.15;background:linear-gradient(135deg,#fff 40%,#c084fc 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.35rem;">Live Weather<br>Matched Fragrances</h2>
        <p style="color:rgba(241,245,255,0.42);font-size:.9rem;">Real-time conditions. Curated scents. Your city, your vibe.</p>
        <button class="w-refresh-btn" id="refreshWeather" style="position:absolute;right:0;top:50%;transform:translateY(-50%);"><i class="fas fa-sync-alt"></i> Refresh</button>
    </div>

    <div class="weather-scene" id="weatherScene">
        <div class="weather-scene-bg clear-day" id="weatherBg"></div>
        <div class="weather-fx" id="weatherFx"></div>

        <div class="weather-panel">

            <!-- COL A: Live data -->
            <div class="weather-col-a">
                <div class="w-temp-hero">
                    <span class="w-tod-badge morning" id="wTodBadge"><i class="fas fa-sun"></i>&nbsp;Morning</span>
                    <div class="w-temp-big" id="largeTempDisplay">--°</div>
                    <div class="w-city-name" id="cityNameLarge">Lahore</div>
                    <div class="w-local-time" id="wLocalTime">LOCAL TIME —</div>
                    <div class="w-condition-row">
                        <i class="fas fa-sun w-cond-icon" id="conditionIcon"></i>
                        <span class="w-cond-text" id="conditionText">Clear skies</span>
                    </div>

                    <div style="margin-top:4.5rem;padding:1.1rem 1.3rem;background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.4);border-radius:12px;line-height:1.7;max-width:80%;">
                        <p style="color:rgba(255,255,255,0.85);font-size:1.76rem;font-weight:700;letter-spacing:.01em;">Are you travelling abroad?</p>
                        <p style="color:rgba(255,255,255,0.45);font-size:1.64rem;margin-top:.25rem;">Enter city &amp; click search — we will find the right match for you.</p>
                    </div>
                </div>
            </div>

            <div class="w-divider"></div>

            <!-- COL B: 3D Carousel -->
            <div class="weather-col-b">
                <div class="w-carousel-label" id="carouselLabel">🌍 &nbsp;Explore Cities &mdash; Hover to Match</div>
                <div class="carousel-wrapper" id="carouselWrapper">
                    <div class="city-carousel-container">
                        <div class="city-carousel" id="cityCarousel"></div>
                    </div>
                </div>
                <!-- Searched city display -->
                <div id="searchedCityCard" style="display:none;flex-direction:column;align-items:center;justify-content:center;height:100%;gap:1.2rem;padding:2rem 1rem;text-align:center;">
                    <div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.14em;color:var(--w-muted);margin-bottom:.5rem;">📍 Searched City</div>
                    <div id="searchedCityImg" style="width:256px;height:256px;border-radius:0;overflow:hidden;box-shadow:0 12px 30px rgba(0,0,0,0.7);border:1.5px solid var(--primary);flex-shrink:0;position:relative;transition:all .3s;">
                        <img id="searchedCityPhoto" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:block;">
                        <div class="city-label" id="searchedCityLabel" style="opacity:1;transform:translateY(0);"></div>
                    </div>
                    <div id="searchedCityName" style="font-size:1.8rem;font-weight:800;color:var(--w-text);letter-spacing:-.01em;"></div>
                    <button onclick="document.getElementById('searchedCityCard').style.display='none';document.getElementById('carouselWrapper').style.display='block';document.getElementById('carouselLabel').style.display='block';this.style.display='none';" style="font-size:.75rem;padding:.4rem 1rem;border-radius:999px;border:1px solid rgba(255,255,255,0.2);background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.5);cursor:pointer;transition:.2s;">↩ Back to cities</button>
                </div>
            </div>

            <div class="w-divider"></div>

            <!-- COL C: Recommendation -->
            <div class="weather-col-c">
                <div class="w-rec-label">Recommended Perfume</div>

                <div class="w-perfume-hero" id="wPerfumeCard">
                    <img class="w-perfume-hero-img" id="wPerfumeImg"
                        src="https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=400"
                        alt="Recommended Perfume">
                    <div class="w-perfume-hero-bg"></div>
                    <div class="w-perfume-hero-body">
                        <div id="wPerfumeCategory" style="font-size:.72rem;font-weight:400;text-transform:uppercase;letter-spacing:2px;color:#4ade80;margin-bottom:.4rem;opacity:.9;">Oud &amp; Amber</div>
                        <div class="w-perfume-hero-name" id="wPerfumeName">Royal Oud</div>
                        <div class="w-perfume-hero-reason" id="wPerfumeReason">Deep and warming for cold nights</div>
                        <div class="w-perfume-hero-tags" id="wPerfumeTags">
                            <span class="w-perfume-hero-tag">Oud</span>
                            <span class="w-perfume-hero-tag">Amber</span>
                            <span class="w-perfume-hero-tag">Sandalwood</span>
                        </div>
                        <div class="w-perfume-hero-footer">
                            <span class="w-perfume-hero-price" id="wPerfumePrice">Rs 4,949</span>
                            <button class="w-perfume-hero-add" id="wAddToCart">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom search bar -->
        <div class="weather-bottom-bar">
            <div class="w-search-wrap">
                <input type="text" class="w-search-input" id="citySearchInput" placeholder="Search any city worldwide…">
                <button class="w-search-btn" id="citySearchBtn"><i class="fas fa-search"></i>&nbsp;Search</button>
            </div>
            <span class="w-last-updated" id="wUpdatedAt"></span>
        </div>
    </div>

    <!-- hidden legacy IDs -->
    <span id="matchMessage" style="display:none;"></span>
    <div id="weatherPerfumeRecommendation" style="display:none;"></div>
    <span id="weatherPerfumeName" style="display:none;"></span>
    <span id="weatherPerfumePrice" style="display:none;"></span>
    <span id="weatherPerfumeBadge" style="display:none;"></span>
    <img id="weatherPerfumeImg" style="display:none;" alt="">
</section>
<!-- Featured Perfumes -->
<section class="section featured" id="featured" style="padding-left:0;padding-right:0;padding-bottom:0;">
<h2 class="section-title" style="text-align:center;font-size:4.4rem;">Customer Crush</h2>
<p class="section-subtitle" style="text-align:center;margin-left:auto;margin-right:auto;font-size:1.05rem;">
                        Our most loved fragrances based on real customer favourites and ratings
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
                        <span class="badge">Featured This Week</span>
                        <span id="customer-name">Mark Chen</span> — <span id="customer-company">TechNova Solutions</span>
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
                    
                    <!-- Share Buttons -->
                    <div class="share-container">
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

    <!-- GUESS WHO SECTION -->
    <div class="guess-who-card">
        <div class="guess-who-glow"></div>

        <div class="guess-who-left">
            <div class="guess-who-badge">🎬 Coming Next</div>
            <h3 class="guess-who-title">Guess Who?</h3>
            <p class="guess-who-hint">A visionary leader from one of Pakistan's fastest-growing <strong>technology organisations</strong> sits down with TROY to reveal the scent behind their success story.</p>
            <div class="guess-who-clues">
                <div class="guess-who-clue"><i class="fas fa-building"></i> Tech industry</div>
                <div class="guess-who-clue"><i class="fas fa-map-marker-alt"></i> Lahore-based HQ</div>
                <div class="guess-who-clue"><i class="fas fa-users"></i> 500+ employees</div>
                <div class="guess-who-clue"><i class="fas fa-trophy"></i> Award-winning CEO</div>
            </div>
            <div class="guess-who-countdown" id="guessCountdown">
                <div class="gw-count-block"><span id="gwDays">00</span><span>Days</span></div>
                <div class="gw-count-sep">:</div>
                <div class="gw-count-block"><span id="gwHours">00</span><span>Hours</span></div>
                <div class="gw-count-sep">:</div>
                <div class="gw-count-block"><span id="gwMins">00</span><span>Mins</span></div>
                <div class="gw-count-sep">:</div>
                <div class="gw-count-block"><span id="gwSecs">00</span><span>Secs</span></div>
            </div>
        </div>

        <div class="guess-who-right">
            <div class="guess-who-silhouette">
                <div class="gw-silhouette-img">
                    <i class="fas fa-user-secret"></i>
                </div>
                <div class="gw-org-pill"><i class="fas fa-landmark"></i> &nbsp;Tech Organisation — Lahore</div>
                <p style="color:rgba(241,245,255,0.35);font-size:.78rem;margin-top:.75rem;letter-spacing:.05em;">Identity revealed on launch day</p>
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

<!-- ── PACKAGING GALLERY ── -->
<section class="section pkg-section" id="packaging">
  <div style="text-align:center;margin-bottom:3rem;">
    <div class="section-label-badge"><i class="fas fa-box-open"></i> Our Packaging</div>
    <h2 class="section-title" style="font-size:2.8rem;margin-bottom:.5rem;">Crafted to be kept</h2>
    <p style="color:var(--text-muted);font-size:.92rem;">Every box, bottle, and ribbon is designed as an experience in itself.</p>
  </div>
  <div class="pkg-slider-wrapper">
    <button class="pkg-arrow pkg-arrow--left" id="pkgPrev"><i class="fas fa-chevron-left"></i></button>
    <div class="pkg-track-outer">
      <div class="pkg-slider" id="pkgSlider">
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder"><i class="fas fa-box-open"></i><span>Signature Box</span></div></div><div class="pkg-caption">Signature Gift Box — Midnight Black</div></div>
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder" style="--pp:rgba(56,189,248,0.12);"><i class="fas fa-flask"></i><span>Bottle Design</span></div></div><div class="pkg-caption">Hand-cut Crystal Flacon</div></div>
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder" style="--pp:rgba(234,179,8,0.1);"><i class="fas fa-ribbon"></i><span>Gift Wrap</span></div></div><div class="pkg-caption">Luxury Satin Ribbon Wrap</div></div>
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder" style="--pp:rgba(167,139,250,0.1);"><i class="fas fa-certificate"></i><span>Wax Seal</span></div></div><div class="pkg-caption">Embossed TROY Wax Seal</div></div>
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder" style="--pp:rgba(34,197,94,0.1);"><i class="fas fa-bag-shopping"></i><span>Carry Bag</span></div></div><div class="pkg-caption">Premium Kraft Carry Bag</div></div>
        <div class="pkg-slide"><div class="pkg-img-box"><div class="pkg-placeholder" style="--pp:rgba(251,113,133,0.08);"><i class="fas fa-envelope-open-text"></i><span>Note Card</span></div></div><div class="pkg-caption">Personalised Message Card</div></div>
      </div>
    </div>
    <button class="pkg-arrow pkg-arrow--right" id="pkgNext"><i class="fas fa-chevron-right"></i></button>
  </div>
  <div class="pkg-dots" id="pkgDots"></div>
  <p style="text-align:center;font-size:.76rem;color:var(--text-muted);margin-top:1.2rem;font-style:italic;">
    <i class="fas fa-image" style="margin-right:.35rem;color:var(--primary);"></i>Upload real packaging photos via the Admin Panel (gear icon, bottom-right).
  </p>
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

<!-- ── DISCOUNT ANNOUNCEMENT BAR ── -->
<div class="discount-bar" id="discountBar" style="display:none;">
  <div class="discount-bar-inner">
    <span class="discount-bar-icon"><i class="fas fa-bolt"></i></span>
    <span class="discount-bar-text" id="discountBarText">🎉 LIMITED TIME: Use code <strong>TROY20</strong> for 20% off your entire order!</span>
    <button class="discount-bar-close" id="discountBarClose"><i class="fas fa-times"></i></button>
  </div>
</div>

<!-- ── ADMIN PANEL (visible only for admin role) ── -->
@role('admin')
<div class="admin-toggle" id="adminToggle" title="Admin Panel"><i class="fas fa-cog"></i></div>
<div class="admin-panel" id="adminPanel">
  <div class="admin-panel-header">
    <div class="admin-panel-title"><i class="fas fa-shield-halved"></i> TROY Admin Panel</div>
    <button class="admin-close" id="adminClose"><i class="fas fa-times"></i></button>
  </div>
  <div class="admin-panel-body">

    <div class="admin-block">
      <div class="admin-block-title"><i class="fas fa-bolt"></i> Discount Announcement</div>
      <div class="admin-row">
        <span class="admin-label">Show Bar</span>
        <label class="admin-toggle-switch">
          <input type="checkbox" id="discountToggle">
          <span class="admin-slider-sw"></span>
        </label>
      </div>
      <div class="admin-row" style="margin-top:.8rem;flex-direction:column;align-items:flex-start;gap:.5rem;">
        <span class="admin-label">Announcement Text</span>
        <input class="admin-input" id="discountText" type="text" value="🎉 LIMITED TIME: Use code TROY20 for 20% off your entire order!" placeholder="Enter discount message…"/>
      </div>
      <div class="admin-row" style="margin-top:.6rem;flex-direction:column;align-items:flex-start;gap:.5rem;">
        <span class="admin-label">Bar Colour</span>
        <div style="display:flex;gap:.6rem;flex-wrap:wrap;">
          <button class="admin-colour-btn active" data-colour="green" style="background:linear-gradient(90deg,#16a34a,#22c55e);">Green</button>
          <button class="admin-colour-btn" data-colour="blue" style="background:linear-gradient(90deg,#0369a1,#38bdf8);">Blue</button>
          <button class="admin-colour-btn" data-colour="gold" style="background:linear-gradient(90deg,#b45309,#eab308);">Gold</button>
          <button class="admin-colour-btn" data-colour="red" style="background:linear-gradient(90deg,#b91c1c,#ef4444);">Red</button>
        </div>
      </div>
      <button class="admin-apply-btn" id="applyDiscount">Apply Changes</button>
    </div>

    <div class="admin-block">
      <div class="admin-block-title"><i class="fas fa-bullhorn"></i> Promo Ticker Messages</div>
      <div id="promoMsgList" style="display:flex;flex-direction:column;gap:.5rem;margin-bottom:.8rem;"></div>
      <div style="display:flex;gap:.5rem;">
        <input class="admin-input" id="newPromoMsg" type="text" placeholder="Add new message…" style="flex:1;"/>
        <button class="admin-apply-btn" id="addPromoMsg" style="margin-top:0;padding:.5rem .9rem;white-space:nowrap;width:auto;">+ Add</button>
      </div>
    </div>

    <div class="admin-block">
      <div class="admin-block-title"><i class="fas fa-images"></i> Packaging Gallery</div>
      <p style="font-size:.78rem;color:var(--text-muted);margin-bottom:.8rem;line-height:1.6;">Upload images to replace placeholder slides.</p>
      <div id="pkgAdminList" style="display:flex;flex-direction:column;gap:.6rem;"></div>
    </div>

  </div>
</div>
@endrole

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
{{-- Cart overlay/modal/toast now provided by cart partial --}}

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
                
                // Update city name display
                const cityNameLargeEl = document.getElementById('cityNameLarge');
                if (cityNameLargeEl) {
                    cityNameLargeEl.textContent = userLocation.city || "Your Location";
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
/* === SMART WEATHER ENGINE === */
(function(){
    const cityCoords={
        'Lahore':{lat:31.5497,lon:74.3436},'Karachi':{lat:24.8607,lon:67.0011},
        'Islamabad':{lat:33.6844,lon:73.0479},'Dubai':{lat:25.2048,lon:55.2708},
        'London':{lat:51.5074,lon:-0.1278},'New York':{lat:40.7128,lon:-74.006},
        'Tokyo':{lat:35.6762,lon:139.6503},'Paris':{lat:48.8566,lon:2.3522}
    };

    function getCondition(code){
        if(code===0)return'Clear';if(code<=3)return'Partly cloudy';
        if(code<=48)return'Foggy';if(code<=57)return'Drizzle';
        if(code<=67)return'Rain';if(code<=77)return'Snow';
        if(code<=82)return'Rain showers';if(code<=86)return'Snow showers';
        if(code<=99)return'Thunderstorm';return'Clear';
    }

    function getIcon(cond,isNight){
        const c=cond.toLowerCase();
        if(c.includes('thunder'))return'fa-bolt';
        if(c.includes('snow'))return'fa-snowflake';
        if(c.includes('rain')||c.includes('drizzle'))return'fa-cloud-rain';
        if(c.includes('fog'))return'fa-smog';
        if(c.includes('cloud'))return'fa-cloud-sun';
        return isNight?'fa-moon':'fa-sun';
    }

    function getTimeOfDay(hour){
        if(hour>=5&&hour<12)return'morning';
        if(hour>=12&&hour<17)return'afternoon';
        if(hour>=17&&hour<21)return'evening';
        return'night';
    }
    function todLabel(tod){return{morning:'🌅 Morning',afternoon:'☀️ Afternoon',evening:'🌆 Evening',night:'🌙 Night'}[tod]||'🌙 Night';}
    function todIcon(tod){return{morning:'fa-sun',afternoon:'fa-sun',evening:'fa-cloud-sun',night:'fa-moon'}[tod]||'fa-moon';}

    function getSceneClass(cond,isNight){
        const c=cond.toLowerCase();
        if(c.includes('thunder'))return'storm';
        if(c.includes('snow'))return'snowy';
        if(c.includes('rain')||c.includes('drizzle'))return'rainy';
        if(c.includes('fog'))return'foggy';
        if(c.includes('cloud'))return'cloudy';
        return isNight?'clear-night':'clear-day';
    }

    function buildFX(scene,cond,isNight){
        const fx=document.getElementById('weatherFx');
        if(!fx)return;
        fx.innerHTML='';
        const c=cond.toLowerCase();

        if(scene==='clear-day'){
            for(let i=0;i<8;i++){
                const r=document.createElement('div');r.className='sun-ray';
                r.style.cssText=`--r:${i*45}deg;animation-delay:${i*0.4}s;left:50%;top:-30px;`;
                fx.appendChild(r);
            }
        }
        if(scene==='clear-night'){
            for(let i=0;i<40;i++){
                const s=document.createElement('div');s.className='star-dot';
                s.style.cssText=`--td:${1.5+Math.random()*3}s;width:${1+Math.random()*3}px;height:${1+Math.random()*3}px;left:${Math.random()*100}%;top:${Math.random()*70}%;animation-delay:${Math.random()*4}s;`;
                fx.appendChild(s);
            }
        }
        if(c.includes('rain')||c.includes('drizzle')){
            for(let i=0;i<60;i++){
                const d=document.createElement('div');d.className='rain-drop';
                d.style.cssText=`--rd:${0.5+Math.random()*0.8}s;height:${12+Math.random()*14}px;left:${Math.random()*100}%;animation-delay:${Math.random()*1}s;`;
                fx.appendChild(d);
            }
        }
        if(c.includes('snow')){
            for(let i=0;i<35;i++){
                const s=document.createElement('div');s.className='snow-flake';
                s.style.cssText=`--sd:${3+Math.random()*4}s;--sf:${8+Math.random()*10}px;--sx:${-40+Math.random()*80}px;left:${Math.random()*100}%;animation-delay:${Math.random()*4}s;`;
                s.textContent='❄';
                fx.appendChild(s);
            }
        }
        if(c.includes('thunder')){
            const l=document.createElement('div');l.className='lightning';fx.appendChild(l);
        }
        if(c.includes('cloud')){
            const cl=document.createElement('div');cl.className='cloud-layer';
            cl.style.cssText='--cd:40s;';
            for(let i=0;i<6;i++){
                const b=document.createElement('div');b.className='cloud-blob';
                b.style.cssText=`--cop:0.08;width:${180+Math.random()*120}px;margin-top:${Math.random()*30}px;`;
                cl.appendChild(b);
            }
            fx.appendChild(cl);
        }
    }

    function getInsight(cond,temp,humidity,wind){
        const c=cond.toLowerCase();
        if(temp>=35)return`Extreme heat at ${temp}°C — opt for ultra-light citrus or aquatic sprays that won't overpower.`;
        if(temp>=28&&humidity>70)return`Hot and humid conditions (${temp}°C, ${humidity}% RH) — heavier base notes survive better than top notes here.`;
        if(temp>=25)return`Warm and comfortable at ${temp}°C — fresh florals and light musks stay vibrant all day.`;
        if(temp>=15&&c.includes('rain'))return`Rainy day at ${temp}°C — moisture amplifies fragrance. Apply half your usual amount.`;
        if(temp>=15)return`Mild ${temp}°C weather — the ideal canvas for balanced, versatile everyday scents.`;
        if(temp>=5&&wind>20)return`Cold and windy at ${temp}°C — rich ouds and resins cut through the wind and last longer.`;
        if(temp>=5)return`Cool ${temp}°C — warm oriental bases project beautifully. Apply to inner wrists and neck.`;
        return`Bracing cold at ${temp}°C — heavy, intense scents like oud and amber are your best friends today.`;
    }

    function getWhy(cond,temp,humidity){
        const c=cond.toLowerCase();
        if(humidity>75)return`High humidity (${humidity}%) boosts sillage — go lighter on application to avoid overpowering.`;
        if(c.includes('rain'))return`Rain releases earthy petrichor notes — woody and green scents pair perfectly.`;
        if(temp>30)return`Heat volatilises top notes quickly. Base-heavy fragrances give the best longevity.`;
        if(temp<10)return`Cold slows evaporation — rich, dense base notes last hours longer than in summer.`;
        return`Balanced conditions allow all fragrance layers to express themselves naturally.`;
    }

    function getOccasion(tod,cond){
        const c=cond.toLowerCase();
        if(tod==='morning')return'Great for a fresh office start or brisk morning commute.';
        if(tod==='evening')return'Evening wear — confident and memorable for dinner or events.';
        if(c.includes('rain'))return'Cosy indoor occasions — café meetings or work-from-home days.';
        if(tod==='night')return'Late nights out, formal dinners, or a private evening in.';
        return'Versatile for casual outings, meetings and afternoon socialising.';
    }

    function getApplyTip(temp,humidity){
        if(humidity>70)return'Less is more today — 1–2 sprays on neck and wrist are plenty in humid air.';
        if(temp<10)return'Layer up: apply to clothes and exposed pulse points to help the scent project in cold air.';
        return'Classic pulse points — wrists, neck, behind ears — maximise warmth and longevity.';
    }

    function getIntensity(temp,humidity,cond){
        const c=cond.toLowerCase();
        if(c.includes('thunder')||c.includes('snow'))return 85;
        if(c.includes('rain'))return 40;
        if(temp>=32)return 25;
        if(temp>=22)return 50;
        if(temp>=12)return 70;
        return 90;
    }

    function feelsLike(temp,humidity,wind){
        if(temp>=27)return Math.round(temp+0.05*humidity);
        if(temp<=10&&wind>15)return Math.round(13.12+0.6215*temp-11.37*Math.pow(wind,0.16)+0.3965*temp*Math.pow(wind,0.16));
        return temp;
    }

    function applyWeather(city,temp,humidity,wind,condition,tzOffset,maxTemp){
        const now=new Date();
        const utcMs=now.getTime()+now.getTimezoneOffset()*60000;
        const cityLocalMs=utcMs+(tzOffset||0)*1000;
        const localDate=new Date(cityLocalMs);
        const hour=localDate.getHours();
        const tod=getTimeOfDay(hour);
        const isNight=(hour>=21||hour<5);
        const localTimeStr=localDate.toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'});
        const scene=getSceneClass(condition,isNight);

        const bg=document.getElementById('weatherBg');
        if(bg){bg.className='weather-scene-bg '+scene;}
        buildFX(scene,condition,isNight);

        const weatherSec=document.getElementById('weather');
        if(weatherSec){
            weatherSec.classList.remove('is-day','is-night','is-morning','is-evening');
            if(tod==='night')weatherSec.classList.add('is-night');
            else if(tod==='morning')weatherSec.classList.add('is-morning');
            else if(tod==='evening')weatherSec.classList.add('is-evening');
            else weatherSec.classList.add('is-day');
        }

        const weatherSceneEl=document.getElementById('weatherScene');
        if(weatherSceneEl){
            weatherSceneEl.classList.remove('theme-day','theme-morning','theme-evening','theme-night');
            const themeMap={morning:'theme-morning',afternoon:'theme-day',evening:'theme-evening',night:'theme-night'};
            weatherSceneEl.classList.add(themeMap[tod]||'theme-night');
        }

        const todBadge=document.getElementById('wTodBadge');
        if(todBadge){
            todBadge.className='w-tod-badge '+tod;
            todBadge.innerHTML=`<i class="fas ${todIcon(tod)}"></i> ${todLabel(tod).split(' ')[1]}`;
        }

        const tempEl=document.getElementById('largeTempDisplay');
        if(tempEl){tempEl.textContent=temp+'°';}

        const cityEl=document.getElementById('cityNameLarge');
        if(cityEl)cityEl.textContent=city;
        const timeEl=document.getElementById('wLocalTime');
        if(timeEl)timeEl.textContent='Local time '+localTimeStr;

        const condIcon=document.getElementById('conditionIcon');
        if(condIcon)condIcon.className='fas '+getIcon(condition,isNight)+' w-cond-icon';
        const condText=document.getElementById('conditionText');
        if(condText)condText.textContent=condition;

        const fl=feelsLike(temp,humidity,wind);
        const g=id=>document.getElementById(id);
        if(g('metricTemp'))g('metricTemp').textContent=temp+'°C';
        if(g('metricWind'))g('metricWind').textContent=wind+' km/h';
        if(g('metricHumidity'))g('metricHumidity').textContent=humidity+'%';
        if(g('metricFeelsLike'))g('metricFeelsLike').textContent=fl+'°C';
        if(g('metricMaxTemp'))g('metricMaxTemp').textContent=(maxTemp!=null?maxTemp:temp+4)+'°C';

        if(g('weatherRecommendation'))g('weatherRecommendation').textContent=getInsight(condition,temp,humidity,wind);
        if(g('wWhyText'))g('wWhyText').textContent=getWhy(condition,temp,humidity);
        if(g('wOccasionText'))g('wOccasionText').textContent=getOccasion(tod,condition);
        if(g('wApplyText'))g('wApplyText').textContent=getApplyTip(temp,humidity);

        const intensity=getIntensity(temp,humidity,condition);
        const fill=g('wIntensityFill');
        if(fill)fill.style.width=intensity+'%';

        if(g('wUpdatedAt'))g('wUpdatedAt').textContent='Updated '+new Date().toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'});

        if(window.updateWeatherPerfumeRecommendation)window.updateWeatherPerfumeRecommendation(temp,condition,tod);
    }

    async function fetchLiveWeather(city,customLat,customLon){
        let lat=customLat,lon=customLon;
        if(!lat||!lon){const c=cityCoords[city];if(!c)return;lat=c.lat;lon=c.lon;}
        try{
            const r=await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code&daily=temperature_2m_max&timezone=auto`);
            if(!r.ok)throw new Error();
            const d=await r.json();
            if(d.current){
                const tz=d.utc_offset_seconds||0;
                const maxTemp=d.daily&&d.daily.temperature_2m_max?Math.round(d.daily.temperature_2m_max[0]):null;
                applyWeather(city,Math.round(d.current.temperature_2m),d.current.relative_humidity_2m,Math.round(d.current.wind_speed_10m),getCondition(d.current.weather_code),tz,maxTemp);
            }
        }catch(e){applyWeather(city,28,60,12,'Clear',18000,34);}
    }

    function initWeather(){
        fetchLiveWeather('Lahore');
        const refresh=document.getElementById('refreshWeather');
        if(refresh)refresh.addEventListener('click',()=>{
            const city=document.getElementById('cityNameLarge').textContent||'Lahore';
            fetchLiveWeather(city);
        });

        const weatherSection=document.getElementById('weather');
        if(weatherSection&&'IntersectionObserver' in window){
            let lastRefresh=0;
            new IntersectionObserver((entries)=>{
                entries.forEach(entry=>{
                    if(entry.isIntersecting){
                        const now=Date.now();
                        if(now-lastRefresh>60000){
                            lastRefresh=now;
                            const city=document.getElementById('cityNameLarge').textContent||'Lahore';
                            fetchLiveWeather(city);
                        }
                    }
                });
            },{threshold:0.2}).observe(weatherSection);
        }
        const searchBtn=document.getElementById('citySearchBtn');
        const searchInput=document.getElementById('citySearchInput');
        if(searchBtn)searchBtn.addEventListener('click',()=>{
            const val=searchInput.value.trim();if(!val)return;
            fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(val)}&format=json&limit=1`)
                .then(r=>r.json())
                .then(data=>{
                    if(data&&data.length>0){
                        const cityName=data[0].display_name.split(',')[0];
                        const lat=parseFloat(data[0].lat);
                        const lon=parseFloat(data[0].lon);
                        fetchLiveWeather(cityName,lat,lon);

                        const carouselWrapper=document.getElementById('carouselWrapper');
                        const carouselLabel=document.getElementById('carouselLabel');
                        const cityCard=document.getElementById('searchedCityCard');
                        const cityNameEl=document.getElementById('searchedCityName');
                        const cityPhoto=document.getElementById('searchedCityPhoto');

                        if(carouselWrapper)carouselWrapper.style.display='none';
                        if(carouselLabel)carouselLabel.style.display='none';
                        if(cityNameEl)cityNameEl.textContent=cityName;

                        if(cityPhoto){
                            cityPhoto.alt=cityName;
                            fetch(`https://en.wikipedia.org/api/rest_v1/page/summary/${encodeURIComponent(cityName)}`)
                                .then(r=>r.json())
                                .then(wiki=>{
                                    if(wiki.thumbnail&&wiki.thumbnail.source){
                                        cityPhoto.src=wiki.thumbnail.source.replace(/\/\d+px-/,'/400px-');
                                    } else {
                                        cityPhoto.src=`https://source.unsplash.com/256x256/?${encodeURIComponent(cityName)},city`;
                                    }
                                })
                                .catch(()=>{
                                    cityPhoto.src=`https://source.unsplash.com/256x256/?${encodeURIComponent(cityName)},city`;
                                });
                        }

                        const labelEl=document.getElementById('searchedCityLabel');
                        if(labelEl)labelEl.textContent=cityName;

                        if(cityCard){cityCard.style.display='flex';}
                    }else if(typeof showToast==='function'){showToast('City not found. Try another name.');}
                }).catch(()=>{if(typeof showToast==='function')showToast('Could not fetch city data.');});
        });
        if(searchInput)searchInput.addEventListener('keydown',e=>{if(e.key==='Enter')searchBtn&&searchBtn.click();});
    }

    document.addEventListener('DOMContentLoaded',()=>setTimeout(initWeather,800));
    window.fetchLiveWeather=fetchLiveWeather;
})();
</script>

<script>
/* === 3D CITY CAROUSEL === */
(function(){
    const carouselCities=[
        {name:'Lahore',lat:31.5497,lon:74.3436,image:'https://images.pexels.com/photos/4064436/pexels-photo-4064436.jpeg?auto=compress&cs=tinysrgb&w=400'},
        {name:'Karachi',lat:24.8607,lon:67.0011,image:'https://images.pexels.com/photos/466685/pexels-photo-466685.jpeg?auto=compress&cs=tinysrgb&w=400'},
        {name:'Islamabad',lat:33.6844,lon:73.0479,image:'https://images.pexels.com/photos/2179018/pexels-photo-2179018.jpeg?auto=compress&cs=tinysrgb&w=400'},
        {name:'Dubai',lat:25.2048,lon:55.2708,image:'https://images.pexels.com/photos/290595/pexels-photo-290595.jpeg?auto=compress&cs=tinysrgb&w=400'},
        {name:'London',lat:51.5074,lon:-0.1278,image:'https://images.pexels.com/photos/460672/pexels-photo-460672.jpeg?auto=compress&cs=tinysrgb&w=400'},
        {name:'New York',lat:40.7128,lon:-74.006,image:'https://images.pexels.com/photos/802024/pexels-photo-802024.jpeg?auto=compress&cs=tinysrgb&w=400'}
    ];
    const carousel=document.getElementById('cityCarousel');
    if(!carousel)return;
    carouselCities.forEach(city=>{
        const item=document.createElement('div');
        item.className='carousel-item';
        item.dataset.city=city.name;
        item.dataset.lat=city.lat;
        item.dataset.lon=city.lon;
        item.innerHTML=`<img src="${city.image}" alt="${city.name}" loading="lazy"><div class="city-label">${city.name}</div>`;
        item.addEventListener('mouseenter',function(){
            const cn=document.getElementById('cityNameLarge');
            if(cn)cn.textContent=this.dataset.city;
            if(typeof window.fetchLiveWeather==='function')window.fetchLiveWeather(this.dataset.city,parseFloat(this.dataset.lat),parseFloat(this.dataset.lon));
            document.querySelectorAll('.carousel-item').forEach(el=>el.style.borderColor='transparent');
            this.style.borderColor='var(--primary)';
        });
        carousel.appendChild(item);
    });
    setTimeout(()=>{
        const first=document.querySelector('.carousel-item');
        if(first)first.dispatchEvent(new Event('mouseenter'));
    },1500);
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

        // PERFUME DATA (Loaded from admin display data)
        let perfumes = [];

        // Cart managed by shared cart.blade.php (uses window.troyCart)
        let favorites = [];

        // DOM refs (cart DOM refs managed by shared cart.blade.php)
        const perfumeGrid = document.getElementById('perfumeGrid');
        const toast = document.getElementById('cartToast') || document.getElementById('toast');
        const header = document.getElementById('header');
        const particlesContainer = document.getElementById('particles');
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
        const weatherPerfumeImg = document.getElementById('wPerfumeImg');
        const weatherPerfumeName = document.getElementById('wPerfumeName');
        const weatherPerfumePrice = document.getElementById('wPerfumePrice');
        const weatherPerfumeBadge = document.getElementById('wPerfumeCategory');

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
            const reasonEl = document.getElementById('wPerfumeReason');
            const tagsEl = document.getElementById('wPerfumeTags');
            if (perfume) {
                weatherPerfumeImg.src = perfume.images && perfume.images[0] ? perfume.images[0] : 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800';
                weatherPerfumeName.textContent = perfume.name;
                weatherPerfumePrice.textContent = `Rs ${perfume.price.toLocaleString()}`;
                weatherPerfumeBadge.textContent = `Recommended for ${temp}°C`;
                if (reasonEl) reasonEl.textContent = perfume.description ? perfume.description.substring(0, 60) : `Perfect for ${temp}°C weather`;
                if (tagsEl) tagsEl.innerHTML = (perfume.notes || []).map(n => `<span class="w-tag">${n}</span>`).join('');
            } else {
                weatherPerfumeImg.src = 'https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800';
                weatherPerfumeName.textContent = 'No match found';
                weatherPerfumePrice.textContent = '';
                weatherPerfumeBadge.textContent = 'Try a different city';
                if (reasonEl) reasonEl.textContent = 'Search a city to get a recommendation';
                if (tagsEl) tagsEl.innerHTML = '';
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
                        const tempEl = document.getElementById('largeTempDisplay');
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
                
                // Sync cart with shared cart component (already loaded by cart.blade.php)
                if (window.updateCartUI) window.updateCartUI();
                
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
            // Cart toggle/close/overlay/checkout listeners are handled by shared cart.blade.php
            // (shared cart detects contributionModal and shows it automatically)

            // Ladies stamp - Coming Soon modal
            const ladiesStamp = document.getElementById('ladiesStamp');
            const comingSoonModal = document.getElementById('comingSoonModal');
            const closeComingSoon = document.getElementById('closeComingSoon');
            if (ladiesStamp && comingSoonModal) {
                ladiesStamp.addEventListener('click', function() {
                    comingSoonModal.classList.add('active');
                });
            }
            if (closeComingSoon && comingSoonModal) {
                closeComingSoon.addEventListener('click', function() {
                    comingSoonModal.classList.remove('active');
                });
                comingSoonModal.addEventListener('click', function(e) {
                    if (e.target === comingSoonModal) {
                        comingSoonModal.classList.remove('active');
                    }
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

            // Limit to 5 perfumes on main page
            const PERFUME_LIMIT = 5;
            let displayPerfumes = perfumesToRender;
            let showViewAll = false;
            if (!isAllPerfumesPage && perfumesToRender.length > PERFUME_LIMIT) {
                displayPerfumes = perfumesToRender.slice(0, PERFUME_LIMIT);
                showViewAll = true;
            }

            displayPerfumes.forEach((p, idx) => {
                const isFavorite = favorites.includes(p.id);
                const images = p.images || ["https://images.pexels.com/photos/965981/pexels-photo-965981.jpeg?auto=compress&cs=tinysrgb&w=800"];
                const badgeText = Number(p.rating) >= 4.5 ? 'Top Rated' : (p.city ? p.city + ' Special' : '');
                const weatherText = p.weather || getTemperatureDisplay(p);
                const oldPriceVal = p.oldPrice || Math.round(p.price * 1.3);
                
                const card = document.createElement('div');
                card.className = 'gapsy-card';
                card.setAttribute('data-id', p.id);
                card.innerHTML = `
                    <img class="gapsy-card-bg" src="${images[0]}" alt="${p.name}" loading="lazy">
                    ${badgeText ? `<div class="gapsy-badge">${badgeText}</div>` : ''}
                    <div class="gapsy-card-content">
                        <div class="gapsy-card-category">${p.category || p.city || 'TROY Collection'}</div>
                        <div class="gapsy-card-title">${p.name}</div>
                        <div class="gapsy-card-price">Rs ${Number(p.price).toLocaleString()} <span style="text-decoration:line-through;opacity:.5;font-size:.85rem;">Rs ${Number(oldPriceVal).toLocaleString()}</span></div>
                        <div class="gapsy-weather-badge"><i class="fas fa-cloud-sun"></i> Best for ${weatherText}</div>
                        <div class="gapsy-actions">
                            <button class="gapsy-btn gapsy-btn-primary" onclick='addToCart(${JSON.stringify(p)}, this)'><i class="fas fa-bag-shopping"></i> Add to Cart</button>
                            <button class="gapsy-btn gapsy-btn-secondary" onclick="quickView(${p.id})">View <i class="fas fa-arrow-right"></i></button>
                            <button class="gapsy-favorite ${isFavorite ? 'active' : ''}" data-id="${p.id}" onclick="toggleFavorite(${p.id}, this)"><i class="fas fa-star"></i></button>
                        </div>
                    </div>
                `;

                perfumeGrid.appendChild(card);
            });

            // Show "View All" button if more perfumes exist
            const existingViewAll = document.querySelector('.view-all-container');
            if (existingViewAll) existingViewAll.remove();
            if (showViewAll) {
                const viewAllDiv = document.createElement('div');
                viewAllDiv.className = 'view-all-container';
                viewAllDiv.innerHTML = `<a href="/perfumes" class="view-all-btn">View All Perfumes <i class="fas fa-arrow-right"></i></a>`;
                perfumeGrid.parentNode.insertBefore(viewAllDiv, perfumeGrid.nextSibling);
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

        // Quick View - show perfume notes in toast
        window.quickView = function(id) {
            const p = perfumes.find(x => x.id === id);
            if (!p) return;
            const notes = p.notes || [];
            const noteNames = notes.map(n => typeof n === 'object' ? n.note_name : n);
            showToast(`${p.name} – ${noteNames.join(', ')}`);
        };

        // addToCart, animateJet — provided by shared cart.blade.php

        // updateCartUI, toggleCart, clearCart — provided by shared cart.blade.php

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
            window.troyCart.forEach(item => {
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
            window.clearCart();
            window.toggleCart();
        }
        // Override shared proceedToCheckout with customer-specific version
        window.proceedToCheckout = proceedToCheckout;

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
            // Delegate to shared cart toast if available
            if (window.showCartToast) {
                window.showCartToast(text);
                return;
            }
            if (!toast) return;
            
            const span = toast.querySelector('.toast-message') || toast.querySelector('.cart-toast-message');
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
(function(){
/* ─────────────────────────────────────────────
   MOOD & PERFUME DATA
───────────────────────────────────────────── */
const MOODS = [
  { emoji:'😊', label:'Happy',     id:3, color:'#facc15', glow:'rgba(250,204,21,0.35)',
    traits:['Radiant','Playful','Uplifting'], desc:'Your joyful energy calls for a burst of citrus and freshness.' },
  { emoji:'😌', label:'Calm',      id:4, color:'#a78bfa', glow:'rgba(167,139,250,0.35)',
    traits:['Serene','Balanced','Mindful'], desc:'Your peaceful state pairs beautifully with soft floral whispers.' },
  { emoji:'💪', label:'Confident', id:1, color:'#f97316', glow:'rgba(249,115,22,0.4)',
    traits:['Powerful','Decisive','Magnetic'], desc:'Your bold presence demands a scent as commanding as you are.' },
  { emoji:'🌙', label:'Romantic',  id:2, color:'#ec4899', glow:'rgba(236,72,153,0.4)',
    traits:['Passionate','Dreamy','Sensual'], desc:'Your romantic soul deserves a fragrance that lingers like a memory.' },
  { emoji:'❄️', label:'Cool',      id:6, color:'#38bdf8', glow:'rgba(56,189,248,0.4)',
    traits:['Effortless','Fresh','Modern'], desc:'Your cool composure is perfectly matched with clean aquatic clarity.' },
  { emoji:'🔥', label:'Bold',      id:5, color:'#ef4444', glow:'rgba(239,68,68,0.4)',
    traits:['Intense','Daring','Fearless'], desc:'Your fiery spirit needs a scent with serious depth and dark allure.' },
  { emoji:'🌸', label:'Fresh',     id:3, color:'#4ade80', glow:'rgba(74,222,128,0.35)',
    traits:['Light','Breezy','Natural'], desc:'Your vibrant freshness shines with crisp citrus and green notes.' },
  { emoji:'🎩', label:'Formal',    id:1, color:'#c084fc', glow:'rgba(192,132,252,0.4)',
    traits:['Refined','Elegant','Timeless'], desc:'Your sophisticated occasion deserves a scent of true prestige.' },
];

const PERFUMES = {
  1:{ name:'Royal Oud',      icon:'fas fa-crown',    notes:['Oud','Sandalwood','Amber','Vetiver'],
      desc:'A majestic blend of rare Arabian oud and warm sandalwood — the scent of authority and luxury.',
      price:'Rs 4,949' },
  2:{ name:'Midnight Elixir',icon:'fas fa-moon',     notes:['Musk','Rose','Patchouli','Bergamot'],
      desc:'Seductive oriental warmth wrapped in dark florals — made for nights that linger.',
      price:'Rs 5,499' },
  3:{ name:'Citrus Breeze',  icon:'fas fa-sun',      notes:['Lemon','Bergamot','Cedar','Neroli'],
      desc:'A radiant burst of sun-kissed citrus and airy woods — instant energy in a bottle.',
      price:'Rs 3,299' },
  4:{ name:'Rose Royale',    icon:'fas fa-spa',      notes:['Rose','Jasmine','White Musk','Sandalwood'],
      desc:'The timeless elegance of blooming roses elevated with silky musk and warmth.',
      price:'Rs 4,199' },
  5:{ name:'Dark Ember',     icon:'fas fa-fire',     notes:['Birch','Smoke','Amber','Leather'],
      desc:'Smouldering woodsmoke and rich amber — a bold statement for those who dare.',
      price:'Rs 5,799' },
  6:{ name:'Aqua Sport',     icon:'fas fa-water',    notes:['Sea Salt','Aqua','White Musk','Mint'],
      desc:'A cool ocean breeze distilled — effortless, clean, and endlessly refreshing.',
      price:'Rs 2,899' },
};

/* ─────────────────────────────────────────────
   HELPERS
───────────────────────────────────────────── */
const g = id => document.getElementById(id);

window.openMoodMatch  = () => g('moodMatchModal').classList.add('active');
window.closeMoodMatch = () => { g('moodMatchModal').classList.remove('active'); stopCamera(); };
g('closeMoodMatch').addEventListener('click', closeMoodMatch);

/* Mode toggle */
document.querySelectorAll('.mood-mode-btn').forEach(btn => {
  btn.addEventListener('click', function(){
    document.querySelectorAll('.mood-mode-btn').forEach(b=>b.classList.remove('active'));
    this.classList.add('active');
  });
});

/* ─────────────────────────────────────────────
   BUILD MOOD GRID
───────────────────────────────────────────── */
const grid = g('moodOptionsGrid');
MOODS.forEach(m => {
  const btn = document.createElement('button');
  btn.className = 'mood-option-btn';
  btn.innerHTML = `<span class="mood-emoji">${m.emoji}</span><span>${m.label}</span>`;
  btn.style.setProperty('--mood-color', m.color);
  btn.addEventListener('click', () => {
    document.querySelectorAll('.mood-option-btn').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    runAnalysis(m);
  });
  grid.appendChild(btn);
});

/* ─────────────────────────────────────────────
   ANALYSIS SEQUENCE
───────────────────────────────────────────── */
function runAnalysis(mood) {
  const analyzeBtn = g('moodAnalyzeBtn');
  const aura = g('moodAuraDisplay');

  // Phase 1: Scanning state
  g('moodDisplayIcon').textContent = '🔍';
  g('moodDisplayText').textContent = 'Scanning your mood…';
  g('moodDisplayConfidence').textContent = 'AI is reading your emotional signals';
  g('moodTraits').style.display = 'none';
  aura.style.setProperty('--aura-color', 'rgba(192,132,252,0.3)');

  // Scan line on camera box
  const box = g('moodCameraBox');
  if(box) box.classList.add('scanning');

  // Phase 2: Counting up bars dramatically
  const emotions = buildEmotions(mood);
  renderBarsAnimated(emotions, mood.color);

  // Phase 3: Reveal after 1.6s
  setTimeout(() => {
    if(box) box.classList.remove('scanning');
    revealMood(mood);
  }, 1600);
}

function buildEmotions(mood) {
  const keys = ['Happy','Calm','Bold','Romantic','Fresh','Confident'];
  const dominated = mood.label;
  return keys.map(k => ({
    label: k,
    pct: k === dominated ? Math.floor(Math.random()*12)+82
       : k === 'Calm'    ? Math.floor(Math.random()*25)+30
       : Math.floor(Math.random()*40)+8,
    color: k === dominated ? mood.color : null,
  }));
}

function renderBarsAnimated(emotions, accent) {
  const chart = g('moodEmotionChart');
  chart.innerHTML = '<div class="emotion-chart-title">Emotion Scan</div>';
  emotions.forEach(e => {
    const row = document.createElement('div');
    row.className = 'emotion-bar-row';
    const barColor = e.color || 'rgba(255,255,255,0.25)';
    row.innerHTML = `
      <span class="emotion-label">${e.label}</span>
      <div class="emotion-track">
        <div class="emotion-fill" style="width:0%;background:${barColor};"></div>
      </div>
      <span class="emotion-pct">${e.pct}%</span>`;
    chart.appendChild(row);
    // Animate width in after a tick
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        row.querySelector('.emotion-fill').style.width = e.pct + '%';
      });
    });
  });
}

function revealMood(mood) {
  const p = PERFUMES[mood.id];
  const aura = g('moodAuraDisplay');

  // Pulse aura to mood colour
  aura.style.setProperty('--aura-color', mood.glow);
  aura.style.background = `radial-gradient(ellipse 80% 80% at 50% 50%,${mood.glow} 0%,transparent 70%)`;

  // Update icon & text with pop animation
  const icon = g('moodDisplayIcon');
  icon.style.transform = 'scale(1.4)';
  icon.textContent = mood.emoji;
  setTimeout(()=>icon.style.transform='scale(1)', 300);

  g('moodDisplayText').textContent = mood.label + ' Mood Detected';
  g('moodDisplayConfidence').textContent = '✦ ' + mood.desc;

  // Traits
  const traitsEl = g('moodTraits');
  traitsEl.style.display = 'flex';
  const colors = ['purple','green','blue'];
  mood.traits.forEach((t,i) => {
    const el = g('trait'+(i+1));
    if(el){ el.textContent = t; el.className = 'mood-trait '+colors[i]; }
  });

  // Perfume card update
  g('recommendedPerfumeName').textContent = p.name;
  g('recommendedPerfumeMatch').textContent = mood.desc;
  g('moodPerfumeDescription').textContent = p.desc;
  g('moodPerfumeNotes').innerHTML = p.notes.map(n=>`<div class="mood-note-tag">${n}</div>`).join('');

  // Update perfume icon colour to mood colour
  const perfImg = document.querySelector('.mood-perfume-image');
  if(perfImg){
    perfImg.style.background = `linear-gradient(135deg,${mood.glow},rgba(34,197,94,0.08))`;
    perfImg.style.borderColor = mood.color;
    perfImg.style.color = mood.color;
    perfImg.innerHTML = `<i class="${p.icon}"></i>`;
  }

  // Price badge
  let priceBadge = g('moodPerfumePrice');
  if(!priceBadge){
    priceBadge = document.createElement('span');
    priceBadge.id = 'moodPerfumePrice';
    priceBadge.style.cssText='font-size:.8rem;font-weight:700;color:#4ade80;margin-left:auto;';
    document.querySelector('.mood-perfume-header').appendChild(priceBadge);
  }
  priceBadge.textContent = p.price;

  if(typeof showToast==='function') showToast(`${mood.emoji} ${mood.label} mood detected — ${p.name} is your perfect match!`);
}

/* ─────────────────────────────────────────────
   CAMERA
───────────────────────────────────────────── */
let stream = null;

g('moodStartCameraBtn').addEventListener('click', startCamera);
g('moodCaptureBtn').addEventListener('click', capturePhoto);
g('moodResetBtn').addEventListener('click', resetMood);
g('moodAnalyzeBtn').addEventListener('click', () => {
  const random = MOODS[Math.floor(Math.random()*MOODS.length)];
  runAnalysis(random);
});
g('moodUploadArea').addEventListener('click', () => g('moodImageUpload').click());
g('moodImageUpload').addEventListener('change', function(){
  if(this.files && this.files[0]){
    const reader = new FileReader();
    reader.onload = e => {
      g('moodCapturedImage').src = e.target.result;
      g('moodCapturedImage').style.display = 'block';
      g('moodCameraFeed').style.display = 'none';
      g('moodCameraPlaceholder').style.display = 'none';
      g('moodAnalyzeBtn').disabled = false;
    };
    reader.readAsDataURL(this.files[0]);
  }
});

async function startCamera(){
  try{
    stream = await navigator.mediaDevices.getUserMedia({video:true});
    const feed = g('moodCameraFeed');
    feed.srcObject = stream;
    feed.style.display = 'block';
    g('moodCameraPlaceholder').style.display = 'none';
    g('moodCaptureBtn').disabled = false;
    // Show scan line hint
    const box = g('moodCameraBox');
    if(box) box.classList.add('scanning');
    setTimeout(()=>{ if(box) box.classList.remove('scanning'); }, 3000);
  } catch(e){
    if(typeof showToast==='function') showToast('Camera access denied or unavailable');
  }
}

function capturePhoto(){
  const feed = g('moodCameraFeed');
  const canvas = g('moodPhotoCanvas');
  canvas.width = feed.videoWidth; canvas.height = feed.videoHeight;
  canvas.getContext('2d').drawImage(feed, 0, 0);
  g('moodCapturedImage').src = canvas.toDataURL('image/jpeg');
  g('moodCapturedImage').style.display = 'block';
  g('moodAnalyzeBtn').disabled = false;
  stopCamera();
}

function stopCamera(){
  if(stream){ stream.getTracks().forEach(t=>t.stop()); stream=null; }
  const box = g('moodCameraBox');
  if(box) box.classList.remove('scanning');
}

function resetMood(){
  stopCamera();
  g('moodCameraFeed').style.display = 'none';
  g('moodCapturedImage').style.display = 'none';
  g('moodCameraPlaceholder').style.display = 'flex';
  g('moodCaptureBtn').disabled = true;
  g('moodAnalyzeBtn').disabled = true;
  g('moodDisplayIcon').textContent = '😊';
  g('moodDisplayText').textContent = 'Ready for Mood Analysis';
  g('moodDisplayConfidence').textContent = 'Take a photo or pick a mood below';
  g('moodTraits').style.display = 'none';
  g('moodEmotionChart').innerHTML = '<div class="emotion-chart-title">Emotion Analysis</div>';
  const aura = g('moodAuraDisplay');
  if(aura) aura.style.background = '';
  document.querySelectorAll('.mood-option-btn').forEach(b=>b.classList.remove('active'));
}

g('moodAddToCart').addEventListener('click', () => {
  const name = g('recommendedPerfumeName').textContent;
  if(typeof showToast==='function') showToast('🛒 ' + name + ' added to your cart!');
  closeMoodMatch();
});

// Kick off with default state
resetMood();
})();
</script>

<script>
// Guess Who countdown — set your target reveal date here
(function(){
  const target=new Date('2025-04-01T12:00:00');
  function tick(){
    const now=new Date();
    const diff=target-now;
    if(diff<=0){
      document.getElementById('gwDays').textContent='00';
      document.getElementById('gwHours').textContent='00';
      document.getElementById('gwMins').textContent='00';
      document.getElementById('gwSecs').textContent='00';
      return;
    }
    const d=Math.floor(diff/86400000);
    const h=Math.floor((diff%86400000)/3600000);
    const m=Math.floor((diff%3600000)/60000);
    const s=Math.floor((diff%60000)/1000);
    document.getElementById('gwDays').textContent=String(d).padStart(2,'0');
    document.getElementById('gwHours').textContent=String(h).padStart(2,'0');
    document.getElementById('gwMins').textContent=String(m).padStart(2,'0');
    document.getElementById('gwSecs').textContent=String(s).padStart(2,'0');
  }
  tick();setInterval(tick,1000);
})();
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

<script>
// ===== LOAD ACTIVE TV VIDEO FROM DATABASE =====
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/tv-video/active')
            .then(r => r.json())
            .then(data => {
                if (data.video && data.video.url) {
                    const videoEl = document.getElementById('tvScreenVideo');
                    const iframeEl = document.getElementById('tvScreenIframe');
                    if (videoEl && iframeEl) {
                        // Hide iframe, show uploaded video
                        iframeEl.style.display = 'none';
                        videoEl.src = data.video.url;
                        videoEl.style.display = 'block';
                        videoEl.play().catch(() => {});
                    }
                }
                // If no active video, the YouTube iframe stays as fallback
            })
            .catch(() => {
                // On error, keep the YouTube fallback
                console.log('No active TV video found, using YouTube fallback.');
            });
    });
})();
</script>

<!-- ── ADMIN PANEL + DISCOUNT BAR + PROMO TICKER + PACKAGING JS ── -->
<script>
(function(){
  /* ── PACKAGING SLIDER ── */
  const pkgSlider=document.getElementById('pkgSlider');
  const pkgPrev=document.getElementById('pkgPrev');
  const pkgNext=document.getElementById('pkgNext');
  const pkgDots=document.getElementById('pkgDots');
  if(pkgSlider&&pkgPrev&&pkgNext&&pkgDots){
    const slides=pkgSlider.querySelectorAll('.pkg-slide');
    const slideW=280+24;
    let pkgIdx=0;
    const outer=pkgSlider.parentElement;
    function getVisible(){return Math.max(1,Math.floor(outer.offsetWidth/slideW));}
    function maxIdx(){return Math.max(0,slides.length-getVisible());}
    function moveTo(i){
      pkgIdx=Math.max(0,Math.min(i,maxIdx()));
      pkgSlider.style.transform='translateX(-'+pkgIdx*slideW+'px)';
      renderDots();
    }
    function renderDots(){
      pkgDots.innerHTML='';
      for(let i=0;i<=maxIdx();i++){
        const d=document.createElement('div');
        d.className='pkg-dot'+(i===pkgIdx?' active':'');
        d.addEventListener('click',()=>moveTo(i));
        pkgDots.appendChild(d);
      }
    }
    pkgPrev.addEventListener('click',()=>moveTo(pkgIdx-1));
    pkgNext.addEventListener('click',()=>moveTo(pkgIdx+1));
    renderDots();
  }

  /* ── ADMIN PANEL TOGGLE ── */
  const adminToggle=document.getElementById('adminToggle');
  const adminPanel=document.getElementById('adminPanel');
  const adminClose=document.getElementById('adminClose');
  if(adminToggle&&adminPanel){
    adminToggle.addEventListener('click',()=>adminPanel.classList.toggle('open'));
    if(adminClose) adminClose.addEventListener('click',()=>adminPanel.classList.remove('open'));
    document.addEventListener('click',e=>{
      if(!adminPanel.contains(e.target)&&e.target!==adminToggle&&!adminToggle.contains(e.target)) adminPanel.classList.remove('open');
    });
  }

  /* ── DISCOUNT BAR ── */
  const bar=document.getElementById('discountBar');
  const barTextEl=document.getElementById('discountBarText');
  const barClose=document.getElementById('discountBarClose');
  const discToggle=document.getElementById('discountToggle');
  const discTextInput=document.getElementById('discountText');
  const applyDiscountBtn=document.getElementById('applyDiscount');
  const colourBtns=document.querySelectorAll('.admin-colour-btn');
  const colourMap={green:'linear-gradient(90deg,#16a34a,#22c55e)',blue:'linear-gradient(90deg,#0369a1,#38bdf8)',gold:'linear-gradient(90deg,#b45309,#eab308)',red:'linear-gradient(90deg,#b91c1c,#ef4444)'};
  let chosenColour=colourMap.green;

  function showBar(show){
    if(!bar) return;
    bar.style.display=show?'block':'none';
    const hdr=document.querySelector('.header');
    if(hdr) hdr.style.top=show?'44px':'0';
  }

  if(colourBtns.length){
    colourBtns.forEach(btn=>{
      btn.addEventListener('click',()=>{
        colourBtns.forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        chosenColour=colourMap[btn.dataset.colour];
      });
    });
  }

  if(discToggle) discToggle.addEventListener('change',()=>showBar(discToggle.checked));

  if(barClose) barClose.addEventListener('click',()=>{
    showBar(false);
    if(discToggle) discToggle.checked=false;
  });

  if(applyDiscountBtn) applyDiscountBtn.addEventListener('click',()=>{
    if(barTextEl&&discTextInput) barTextEl.innerHTML=discTextInput.value;
    if(bar) bar.style.background=chosenColour;
    if(discToggle&&discToggle.checked) showBar(true);
  });

  /* ── PROMO TICKER EDITOR ── */
  const promoTrack=document.getElementById('promoTrack');
  const promoMsgList=document.getElementById('promoMsgList');
  const newPromoInput=document.getElementById('newPromoMsg');
  const addPromoBtn=document.getElementById('addPromoMsg');

  let promoMessages=[
    'Free shipping on orders above PKR 3,000',
    'Complimentary gift wrap on every order',
    'New arrivals — Summer 2026 Collection now live',
    'Same-day delivery available in Lahore'
  ];

  function renderPromoList(){
    if(!promoMsgList) return;
    promoMsgList.innerHTML='';
    promoMessages.forEach((msg,i)=>{
      const row=document.createElement('div');
      row.className='admin-promo-msg';
      row.innerHTML='<span style="flex:1;">'+msg+'</span><button class="admin-promo-del" data-i="'+i+'"><i class="fas fa-trash"></i></button>';
      row.querySelector('.admin-promo-del').addEventListener('click',()=>{
        promoMessages.splice(i,1);
        renderPromoList();
        updateTicker();
      });
      promoMsgList.appendChild(row);
    });
  }

  function updateTicker(){
    if(!promoTrack) return;
    const doubled=[...promoMessages,...promoMessages];
    promoTrack.innerHTML=doubled.map(m=>'<span class="promo-item"><i class="fas fa-tag"></i> '+m+' &nbsp;·&nbsp;</span>').join('');
  }

  if(addPromoBtn){
    addPromoBtn.addEventListener('click',()=>{
      if(!newPromoInput) return;
      const val=newPromoInput.value.trim();
      if(!val) return;
      promoMessages.push(val);
      newPromoInput.value='';
      renderPromoList();
      updateTicker();
    });
  }

  renderPromoList();

  /* ── PACKAGING ADMIN UPLOAD SLOTS ── */
  const pkgAdminList=document.getElementById('pkgAdminList');
  const pkgSlides2=document.querySelectorAll('.pkg-slide');
  if(pkgAdminList&&pkgSlides2.length){
    pkgSlides2.forEach((slide,i)=>{
      const caption=slide.querySelector('.pkg-caption');
      const row=document.createElement('div');
      row.className='admin-pkg-row';
      row.innerHTML='<span class="admin-pkg-label">'+(caption?caption.textContent:'Slide '+(i+1))+'</span><label class="admin-pkg-upload">📁 Upload<input type="file" accept="image/*" style="display:none;"/></label>';
      const fileInput=row.querySelector('input[type=file]');
      row.querySelector('.admin-pkg-upload').addEventListener('click',()=>fileInput.click());
      fileInput.addEventListener('change',()=>{
        if(!fileInput.files[0]) return;
        const url=URL.createObjectURL(fileInput.files[0]);
        const imgBox=slide.querySelector('.pkg-img-box');
        imgBox.innerHTML='<img src="'+url+'" style="width:100%;height:100%;object-fit:cover;display:block;" alt="Packaging"/>';
      });
      pkgAdminList.appendChild(row);
    });
  }
})();
</script>

</body>
</html>