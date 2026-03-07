<!-- Navbar Styles -->
<style>
    /* ===== LIGHT THEME OVERRIDES ===== */
    html[data-theme="light"] {
        --bg: #ffffff;
        --bg-soft: #ffffff;
        --bg-elevated: #ffffff;
        --card: #ffffff;
        --glass: rgba(255,255,255,0.85);
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-subtle: rgba(100,116,139,0.25);
        --shadow-soft: 0 8px 30px rgba(0,0,0,0.08);
        --shadow-main: 0 12px 40px rgba(0,0,0,0.1);
    }
    html[data-theme="light"] body {
        background: #ffffff !important;
        color: #1e293b !important;
    }
    html[data-theme="light"] .header {
        background: linear-gradient(to bottom, rgba(255,255,255,0.98), rgba(255,255,255,0.92), transparent) !important;
        border-bottom: 1px solid rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .header-scrolled {
        background: rgba(255,255,255,1) !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    html[data-theme="light"] .logo {
        color: #1e293b;
    }
    html[data-theme="light"] .nav-link {
        color: #64748b;
    }
    html[data-theme="light"] .nav-link:hover {
        color: #1e293b;
    }
    html[data-theme="light"] .cart-toggle {
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        color: #1e293b;
    }
    html[data-theme="light"] .mobile-nav {
        background: #ffffff;
    }
    html[data-theme="light"] .mobile-nav-link {
        color: #64748b;
        border-bottom-color: rgba(100,116,139,0.1);
    }
    html[data-theme="light"] .pill-badge {
        background: rgba(34,197,94,0.08);
    }
    html[data-theme="light"] .intro-overlay {
        background: rgba(255,255,255,0.95);
    }
    html[data-theme="light"] .brands-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .brands-section::before {
        background: linear-gradient(90deg, #ffffff 0%, transparent 100%);
    }
    html[data-theme="light"] .brands-section::after {
        background: linear-gradient(270deg, #ffffff 0%, transparent 100%);
    }
    html[data-theme="light"] .brand-card {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .location-content,
    html[data-theme="light"] .contribution-content {
        background: #ffffff;
    }
    html[data-theme="light"] .location-details,
    html[data-theme="light"] .location-share-section {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .location-btn-secondary {
        background: #ffffff;
        color: #1e293b;
        border-color: rgba(100,116,139,0.25);
    }
    html[data-theme="light"] .location-modal {
        background: rgba(255,255,255,0.97);
    }
    html[data-theme="light"] .contribution-modal {
        background: rgba(255,255,255,0.97);
    }
    /* Light theme: about page sections */
    html[data-theme="light"] .about-hero {
        background: #ffffff !important;
    }
    html[data-theme="light"] .story-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .values-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .team-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .stats-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .contact-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .footer {
        background: #ffffff !important;
    }
    html[data-theme="light"] .story-image {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .team-image {
        background: #ffffff;
    }
    /* Light theme: all-perfumes page */
    html[data-theme="light"] .perfume-card {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .perfume-card:hover {
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    }
    html[data-theme="light"] .perfume-badge {
        background: #ffffff;
    }
    html[data-theme="light"] .btn-primary {
        background: rgba(56,189,248,0.1);
    }
    html[data-theme="light"] .btn-primary:hover {
        background: rgba(56,189,248,0.2);
    }
    html[data-theme="light"] .back-btn {
        background: #ffffff;
        color: #1e293b;
        border-color: rgba(100,116,139,0.25);
    }
    /* Light theme: admin header */
    html[data-theme="light"] .admin-header {
        background: #ffffff !important;
        border-bottom-color: rgba(100,116,139,0.15);
    }
    /* Light theme: customer page hero/cards */
    html[data-theme="light"] .hero-card {
        background: #ffffff !important;
        box-shadow: 0 12px 35px rgba(0,0,0,0.06);
    }
    html[data-theme="light"] .hero-perfume-tag {
        background: #ffffff;
        color: #334155;
    }
    html[data-theme="light"] .tag-chip {
        background: #ffffff;
        border-color: rgba(100,116,139,0.2);
    }
    html[data-theme="light"] .tv-screen {
        border-color: #d1d5db;
        background: #ffffff;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.03), 0 4px 15px rgba(0,0,0,0.06);
    }
    /* Light theme: weather section */
    html[data-theme="light"] .weather-section {
        background: #ffffff !important;
    }
    html[data-theme="light"] .thermometer-fill {
        background: rgba(255,255,255,0.92);
    }
    /* Light theme: featured / sections */
    html[data-theme="light"] .featured {
        background: #ffffff !important;
    }
    html[data-theme="light"] .promotions {
        background: #ffffff !important;
    }
    html[data-theme="light"] .brand-video {
        background: #ffffff !important;
    }
    /* Light theme: footer */
    html[data-theme="light"] .footer {
        background: #ffffff !important;
        border-top-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .footer-bottom {
        border-top-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .social-link {
        border-color: rgba(100,116,139,0.3);
    }
    /* Light theme: mood match modal */
    html[data-theme="light"] .mood-match-modal {
        background: rgba(255,255,255,0.97);
    }
    html[data-theme="light"] .mood-match-container {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    html[data-theme="light"] .mood-camera-container {
        background: #ffffff;
    }
    html[data-theme="light"] .mood-btn-secondary {
        background: #ffffff;
        color: #1e293b;
        border-color: rgba(100,116,139,0.25);
    }
    /* Light theme: toast */
    html[data-theme="light"] .toast {
        background: #ffffff !important;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    /* Light theme: intro overlay */
    html[data-theme="light"] .intro-overlay {
        background: rgba(255,255,255,0.97) !important;
    }
    /* Light theme: value/contact cards */
    html[data-theme="light"] .value-card,
    html[data-theme="light"] .contact-card,
    html[data-theme="light"] .team-card {
        background: #ffffff;
        border-color: rgba(100,116,139,0.15);
    }
    /* Light theme: generic glass/dark overlays */
    html[data-theme="light"] .qty-btn {
        border-color: rgba(100,116,139,0.3);
    }
    html[data-theme="light"] .btn-outline {
        border-color: rgba(100,116,139,0.35);
    }
    /* Theme toggle button */
    .theme-toggle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 1px solid var(--border-subtle);
        background: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-main);
        font-size: 1.05rem;
        transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
    }
    .theme-toggle:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-soft);
        transform: rotate(15deg);
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
        -webkit-backdrop-filter:blur(18px);
        border-bottom:1px solid rgba(148,163,184,0.2);
        transition:all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .header-scrolled{
        background:rgba(2,6,23,0.98);
        box-shadow:0 8px 32px rgba(15,23,42,0.7);
        padding:0.7rem 4.5rem;
    }
    .logo{
        display:flex;
        align-items:center;
        gap:.75rem;
        text-decoration:none;
        color:var(--text-main);
        transition:opacity 0.3s ease;
    }
    .logo:hover{
        opacity:0.85;
    }
    .logo-img{
        width:70px;
        height:70px;
        border-radius:14px;
        animation: coinFlip 6s ease-in-out infinite;
    }
    @keyframes coinFlip {
        0%   { transform: rotateY(0deg); }
        25%  { transform: rotateY(1080deg); }
        50%  { transform: rotateY(1080deg); }
        100% { transform: rotateY(1080deg); }
    }
    .header-scrolled .logo-img{
        width:50px;
        height:50px;
    }
    .logo-text{
        font-weight:900;
        letter-spacing:.15em;
        font-size:1.8rem;
        transition:font-size 0.3s ease;
    }
    .header-scrolled .logo-text{
        font-size:1.5rem;
    }
    .nav-links{
        display:flex;
        gap:1.8rem;
        align-items:center;
    }
    .nav-link{
        color:var(--text-muted);
        text-decoration:none;
        font-size:.92rem;
        font-weight:500;
        position:relative;
        padding-bottom:.35rem;
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
        transition:width 0.35s cubic-bezier(0.4,0,0.2,1);
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
        padding:.35rem .85rem;
        border-radius:999px;
        background:rgba(34,197,94,0.1);
        border:1px solid rgba(34,197,94,0.5);
        font-size:.72rem;
        text-transform:uppercase;
        letter-spacing:.12em;
        color:var(--primary);
        font-weight:600;
        transition:all 0.3s ease;
    }
    .pill-badge:hover{
        background:rgba(34,197,94,0.18);
        border-color:rgba(34,197,94,0.8);
    }

    /* Cart button */
    .cart-toggle{
        position:relative;
        width:52px;
        height:52px;
        border-radius:999px;
        border:1px solid var(--border-subtle);
        background:rgba(15,23,42,0.85);
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        box-shadow:0 4px 20px rgba(15,23,42,0.5);
        color:var(--text-main);
        font-size:1.1rem;
        transition:all 0.35s cubic-bezier(0.4,0,0.2,1);
    }
    .cart-toggle:hover{
        border-color:var(--primary);
        box-shadow:0 6px 25px rgba(34,197,94,0.25);
        transform:translateY(-2px);
    }
    .cart-count{
        position:absolute;
        top:-6px;
        right:-6px;
        min-width:22px;
        height:22px;
        border-radius:999px;
        background:var(--danger);
        color:#fff;
        font-size:.65rem;
        font-weight:700;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:0 5px;
        box-shadow:0 2px 8px rgba(239,68,68,0.5);
    }

    /* Mobile menu toggle */
    .mobile-menu-toggle {
        display: none;
        width: 42px;
        height: 42px;
        background: none;
        border: 1px solid var(--border-subtle);
        border-radius: 10px;
        color: var(--text-main);
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        align-items: center;
        justify-content: center;
    }
    .mobile-menu-toggle:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .mobile-nav {
        display: none;
        position: fixed;
        top: 80px;
        left: 0;
        right: 0;
        background: rgba(2, 6, 23, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 1rem 1.5rem 1.5rem;
        z-index: 30;
        border-bottom: 1px solid rgba(148,163,184,0.2);
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .mobile-nav.active {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .mobile-nav-link {
        color: var(--text-muted);
        text-decoration: none;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        transition: all 0.25s ease;
        font-weight: 500;
    }
    .mobile-nav-link:hover {
        background: rgba(34,197,94,0.08);
        color: var(--text-main);
    }

    @media(max-width:768px){
        .header{padding:0.8rem 1.5rem;}
        .nav-links{display:none;}
        .mobile-menu-toggle { display: flex; }
        .header-actions { gap: 0.6rem; }
        .cart-toggle { width: 44px; height: 44px; font-size: 1rem; }
        .logo-img { width: 45px; height: 45px; }
        .logo-text { font-size: 1.4rem; }
    }
</style>

<!-- Header -->
<header class="header" id="header">
<a class="logo" href="/">
<img alt="TROY Perfumes Logo" class="logo-img" src="/troy.png"/>
<div class="logo-text">TROY</div>
</a>
<button class="mobile-menu-toggle" id="mobileMenuToggle">
<i class="fas fa-bars"></i>
</button>
<nav class="nav-links">
<a class="nav-link" href="/customer#featured">Perfumes</a>
<a class="nav-link" href="/customer#weather">Weather Match</a>
<a class="nav-link" href="/customer#customer-experience">Customer Experience</a>
<a class="nav-link" href="/customer#partner-brands">Partner Brands</a>
<a class="nav-link" href="/about">About Us</a>
<a class="nav-link" href="#" id="moodMatchLink">
    <i class="fas fa-smile-beam"></i> Mood Match
</a>
</nav>
<div class="mobile-nav" id="mobileNav">
<div class="mobile-nav-links">
<a class="mobile-nav-link" href="/customer#featured">Perfumes</a>
<a class="mobile-nav-link" href="/customer#weather">Weather Match</a>
<a class="mobile-nav-link" href="/customer#customer-experience">Customer Experience</a>
<a class="mobile-nav-link" href="/customer#partner-brands">Partner Brands</a>
<a class="mobile-nav-link" href="/about">About Us</a>
<a class="mobile-nav-link" href="#" id="mobileMoodMatchLink">
    <i class="fas fa-smile-beam"></i> Mood Match
</a>
<a class="mobile-nav-link" href="#" id="mobileThemeToggle" style="display:flex;align-items:center;gap:8px;">
    <i class="fas fa-sun" id="mobileThemeIcon"></i> Toggle Theme
</a>
</div>
</div>
<div class="header-actions">
<button class="theme-toggle" id="themeToggle" aria-label="Toggle theme" title="Toggle light/dark mode">
<i class="fas fa-sun" id="themeIcon"></i>
</button>
<span id="authButtons" style="display:none;">
    <a href="/login" class="btn-login" style="color: var(--text-main); text-decoration: none; padding: 8px 16px; margin-right: 10px;">
        <i class="fas fa-sign-in-alt"></i> Sign In
    </a>
    <a href="/register" class="btn-register" style="background: var(--primary); color: #022c22; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-weight: 600;">
        Register
    </a>
</span>
<span id="userMenu" style="display:none;">
    <a href="/profile" style="color: var(--text-main); text-decoration: none; padding: 8px 16px; margin-right: 10px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-user-circle"></i> <span id="userName"></span>
    </a>
    <a href="/admin-panel" id="adminLink" style="color: var(--accent); text-decoration: none; padding: 8px 16px; margin-right: 10px; display: none;">
        <i class="fas fa-cog"></i> Admin Panel
    </a>
    <form action="/logout" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="background: transparent; border: 1px solid var(--border-subtle); color: var(--text-muted); padding: 8px 16px; border-radius: 20px; cursor: pointer;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</span>
<button aria-label="Shopping Cart" class="cart-toggle" id="cartToggle">
<i class="fas fa-shopping-bag"></i>
<div class="cart-count">0</div>
</button>
</div>
</header>

<!-- Navbar JavaScript -->
<script>
// Check authentication status on page load
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/check-admin')
        .then(response => response.json())
        .then(data => {
            const authButtons = document.getElementById('authButtons');
            const userMenu = document.getElementById('userMenu');
            const userName = document.getElementById('userName');
            const adminLink = document.getElementById('adminLink');
            
            if (authButtons && userMenu) {
                if (data.isLoggedIn) {
                    // User is logged in
                    authButtons.style.display = 'none';
                    userMenu.style.display = 'flex';
                    if (userName) userName.textContent = data.user;
                    if (data.isAdmin && adminLink) {
                        adminLink.style.display = 'inline-block';
                    }
                } else {
                    // User is not logged in
                    authButtons.style.display = 'flex';
                    userMenu.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error('Error checking auth:', error);
        });
});

// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNav = document.getElementById('mobileNav');
    
    if (mobileMenuToggle && mobileNav) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileNav.classList.toggle('active');
        });
        
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
});

// Theme toggle functionality
(function() {
    function getTheme() {
        return localStorage.getItem('troy-theme') || 'light';
    }

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        // Update icons
        var icon = theme === 'dark' ? 'fa-moon' : 'fa-sun';
        var themeIcon = document.getElementById('themeIcon');
        var mobileThemeIcon = document.getElementById('mobileThemeIcon');
        if (themeIcon) { themeIcon.className = 'fas ' + icon; }
        if (mobileThemeIcon) { mobileThemeIcon.className = 'fas ' + icon; }
    }

    // Apply saved theme immediately
    applyTheme(getTheme());

    document.addEventListener('DOMContentLoaded', function() {
        applyTheme(getTheme());

        var themeToggle = document.getElementById('themeToggle');
        var mobileThemeToggle = document.getElementById('mobileThemeToggle');

        function toggleTheme(e) {
            if (e) e.preventDefault();
            var current = getTheme();
            var next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('troy-theme', next);
            applyTheme(next);
        }

        if (themeToggle) themeToggle.addEventListener('click', toggleTheme);
        if (mobileThemeToggle) mobileThemeToggle.addEventListener('click', toggleTheme);
    });
})();
</script>
