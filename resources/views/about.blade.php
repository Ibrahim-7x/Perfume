<!DOCTYPE html>
<html lang="en">
<script>document.documentElement.setAttribute('data-theme', localStorage.getItem('troy-theme') || 'light');</script>
<head>
<meta charset="utf-8"/>
<title>About Us – TROY Perfumes</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html {
        scroll-behavior: smooth;
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: var(--bg);
        color: var(--text-main);
        line-height: 1.6;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }
    
    /* Header */
    .header{
        position:sticky;
        top:0;
        z-index:1000;
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:1.2rem 3rem;
        background:transparent;
        transition:all 0.4s ease;
    }
    .header-scrolled{
        background:rgba(2,6,23,0.98);
        backdrop-filter:blur(12px);
        box-shadow:0 4px 30px rgba(0,0,0,0.3);
        padding:1rem 3rem;
    }
    .logo{
        font-size:1.8rem;
        font-weight:700;
        color:var(--primary);
        text-decoration:none;
        display:flex;
        align-items:center;
        gap:0.5rem;
    }
    .nav-links{
        display:flex;
        gap:2.5rem;
    }
    .nav-link{
        color:var(--text-muted);
        text-decoration:none;
        font-weight:500;
        font-size:0.95rem;
        position:relative;
        transition:color 0.3s ease;
    }
    .nav-link::after{
        content:'';
        position:absolute;
        bottom:-4px;
        left:0;
        width:0;
        height:2px;
        background:var(--primary);
        transition:width 0.3s ease;
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
        gap:1rem;
    }
    .pill-badge{
        background:var(--primary-soft);
        color:var(--primary);
        padding:0.4rem 1rem;
        border-radius:20px;
        font-size:0.75rem;
        font-weight:600;
    }
    .btn-back {
        background: var(--primary);
        color: #022c22;
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background: var(--primary-strong);
        transform: translateY(-2px);
    }
    
    /* Hero Section */
    .about-hero {
        padding: 100px 3rem 70px;
        text-align: center;
        background: linear-gradient(180deg, var(--bg) 0%, var(--bg-soft) 50%, var(--bg) 100%);
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(34, 197, 94, 0.08) 0%, transparent 50%);
        pointer-events: none;
    }
    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--text-main) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -0.02em;
        animation: fadeInDown 0.7s ease-out;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .about-hero p {
        font-size: 1.15rem;
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out 0.2s both;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Section Styles */
    .section {
        padding: 70px 3rem;
    }
    .section-title {
        text-align: center;
        margin-bottom: 55px;
    }
    .section-title h2 {
        font-size: 2.4rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
        letter-spacing: -0.01em;
    }
    .section-title p {
        color: var(--text-muted);
        font-size: 1.05rem;
    }
    
    /* Story Section */
    .story-section {
        background: var(--bg-soft);
    }
    .story-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        max-width: 1200px;
        margin: 0 auto;
        align-items: center;
    }
    .story-content h3 {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    .story-content p {
        color: var(--text-muted);
        margin-bottom: 1.1rem;
        line-height: 1.85;
        font-size: 0.95rem;
    }
    .story-image {
        background: linear-gradient(135deg, var(--primary-soft) 0%, var(--bg-elevated) 100%);
        border-radius: var(--card-radius);
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-subtle);
    }
    .story-image i {
        font-size: 8rem;
        color: var(--primary);
        opacity: 0.5;
    }
    
    /* Values Section */
    .values-section {
        background: var(--bg);
    }
    .values-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .value-card {
        background: var(--card);
        padding: 2.2rem;
        border-radius: var(--card-radius);
        text-align: center;
        border: 1px solid rgba(148,163,184,0.2);
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .value-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary);
        box-shadow: 0 15px 40px rgba(34,197,94,0.12);
    }
    .value-icon {
        width: 70px;
        height: 70px;
        background: var(--primary-soft);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: transform 0.4s ease;
    }
    .value-card:hover .value-icon {
        transform: scale(1.1) rotate(5deg);
    }
    .value-icon i {
        font-size: 1.8rem;
        color: var(--primary);
    }
    .value-card h4 {
        font-size: 1.3rem;
        color: var(--text-main);
        margin-bottom: 1rem;
    }
    .value-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
    /* Team Section */
    .team-section {
        background: var(--bg-soft);
    }
    .team-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .team-card {
        background: var(--card);
        border-radius: var(--card-radius);
        overflow: hidden;
        border: 1px solid rgba(148,163,184,0.2);
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .team-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary);
        box-shadow: 0 15px 40px rgba(34,197,94,0.12);
    }
    .team-image {
        height: 250px;
        background: linear-gradient(135deg, var(--bg-elevated) 0%, var(--primary-soft) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .team-image i {
        font-size: 5rem;
        color: var(--text-muted);
        opacity: 0.5;
    }
    .team-info {
        padding: 1.5rem;
        text-align: center;
    }
    .team-info h4 {
        font-size: 1.2rem;
        color: var(--text-main);
        margin-bottom: 0.3rem;
    }
    .team-info p {
        color: var(--primary);
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, var(--bg-soft) 0%, var(--bg) 100%);
        padding: 90px 3rem;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        max-width: 1000px;
        margin: 0 auto;
        text-align: center;
    }
    .stat-item h3 {
        font-size: 3.2rem;
        color: var(--primary);
        font-weight: 800;
        letter-spacing: -0.02em;
    }
    .stat-item p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-top: 0.4rem;
        font-weight: 500;
    }
    
    /* Contact Section */
    .contact-section {
        background: var(--bg);
    }
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }
    .contact-card {
        background: var(--card);
        padding: 2.2rem;
        border-radius: var(--card-radius);
        text-align: center;
        border: 1px solid rgba(148,163,184,0.2);
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    .contact-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: 0 12px 35px rgba(34,197,94,0.1);
    }
    .contact-card i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }
    .contact-card:hover i {
        transform: scale(1.12);
    }
    .contact-card h4 {
        font-size: 1.2rem;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }
    .contact-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    /* Footer */
    .footer {
        background: var(--bg-soft);
        padding: 65px 3rem 35px;
        border-top: 1px solid rgba(148,163,184,0.2);
    }
    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 3rem;
        margin-bottom: 40px;
    }
    .footer-brand h3 {
        font-size: 1.8rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }
    .footer-brand p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }
    .footer-title {
        font-size: 1.1rem;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    .footer-links {
        list-style: none;
    }
    .footer-links li {
        margin-bottom: 0.8rem;
    }
    .footer-links a {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease, transform 0.3s ease;
        display: inline-block;
    }
    .footer-links a:hover {
        color: var(--primary);
        transform: translateX(3px);
    }
    .footer-bottom {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid var(--border-subtle);
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    /* Responsive */
    @media(max-width:1024px){
        .values-grid, .team-grid, .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .story-grid {
            grid-template-columns: 1fr;
        }
    }
    @media(max-width:768px){
        .header {
            padding: 1rem 1.5rem;
        }
        .nav-links {
            display: none;
        }
        .about-hero h1 {
            font-size: 2.5rem;
        }
        .values-grid, .team-grid, .stats-grid, .contact-grid {
            grid-template-columns: 1fr;
        }
        .footer-content {
            grid-template-columns: 1fr;
        }
        .section {
            padding: 40px 1.5rem;
        }
    }
</style>
</head>
<body>
@include('navbar')
@include('cart')

<!-- Hero Section -->
<section class="about-hero">
    <h1>About TROY Perfumes</h1>
    <p>Discover the art of fragrance with TROY – Where Luxury Meets Innovation</p>
</section>

<!-- Story Section -->
<section class="section story-section">
    <div class="story-grid">
        <div class="story-content">
            <h3>Our Story</h3>
            <p>Founded in 2020, TROY Perfumes was born from a passion for creating extraordinary scent experiences that transcend the ordinary. What started as a small boutique in the heart of the city has evolved into a premier destination for fragrance enthusiasts worldwide.</p>
            <p>Our name "TROY" represents the legendary city of ancient wonder – a place where dreams were crafted and legends were made. Similarly, we strive to craft unforgettable olfactory memories that become a part of your personal journey.</p>
            <p>At TROY, we believe that a fragrance is not just a scent – it's an expression of your personality, a memory in the making, and a statement of elegance. Our curated collection features the finest blends from renowned perfumers around the globe.</p>
        </div>
        <div class="story-image">
            <i class="fas fa-flask"></i>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section values-section">
    <div class="section-title">
        <h2>Our Core Values</h2>
        <p>The principles that guide everything we do</p>
    </div>
    <div class="values-grid">
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-gem"></i>
            </div>
            <h4>Quality First</h4>
            <p>We source only the finest ingredients from around the world, ensuring each fragrance meets our uncompromising standards of excellence.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <h4>Innovation</h4>
            <p>Our AI-powered mood matching technology revolutionizes how you discover new fragrances, making personalization accessible to everyone.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h4>Customer Focus</h4>
            <p>Your satisfaction is our priority. We dedicate ourselves to providing an exceptional shopping experience from start to finish.</p>
        </div>
        <div class="value-card">
            <div class="value-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h4>Sustainability</h4>
            <p>We are committed to eco-friendly practices, from sustainable sourcing to recyclable packaging, caring for our planet as much as we care for your scent.</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-item">
            <h3>50+</h3>
            <p>Premium Brands</p>
        </div>
        <div class="stat-item">
            <h3>1000+</h3>
            <p>Fragrance Variants</p>
        </div>
        <div class="stat-item">
            <h3>25K+</h3>
            <p>Happy Customers</p>
        </div>
        <div class="stat-item">
            <h3>15+</h3>
            <p>Countries Served</p>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section team-section">
    <div class="section-title">
        <h2>Meet Our Team</h2>
        <p>The passionate people behind TROY Perfumes</p>
    </div>
    <div class="team-grid">
        <div class="team-card">
            <div class="team-image">
                <i class="fas fa-user"></i>
            </div>
            <div class="team-info">
                <h4>Alexander Chen</h4>
                <p>CEO & Founder</p>
            </div>
        </div>
        <div class="team-card">
            <div class="team-image">
                <i class="fas fa-user"></i>
            </div>
            <div class="team-info">
                <h4>Sarah Mitchell</h4>
                <p>Head of Fragrance</p>
            </div>
        </div>
        <div class="team-card">
            <div class="team-image">
                <i class="fas fa-user"></i>
            </div>
            <div class="team-info">
                <h4>James Rodriguez</h4>
                <p>AI Technology Lead</p>
            </div>
        </div>
        <div class="team-card">
            <div class="team-image">
                <i class="fas fa-user"></i>
            </div>
            <div class="team-info">
                <h4>Emma Williams</h4>
                <p>Customer Experience</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section contact-section">
    <div class="section-title">
        <h2>Get In Touch</h2>
        <p>We'd love to hear from you</p>
    </div>
    <div class="contact-grid">
        <div class="contact-card">
            <i class="fas fa-map-marker-alt"></i>
            <h4>Visit Our Store</h4>
            <p>123 Fragrance Avenue<br>Beverly Hills, CA 90210</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-phone-alt"></i>
            <h4>Call Us</h4>
            <p>+1 (800) 555-TROY<br>Mon - Fri: 9AM - 8PM</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-envelope"></i>
            <h4>Email Us</h4>
            <p>hello@troyperfumes.com<br>support@troyperfumes.com</p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3><i class="fas fa-spray-can"></i> TROY</h3>
            <p>Your premier destination for luxury fragrances. Discover your signature scent with our AI-powered mood matching technology.</p>
        </div>
        <div>
            <h4 class="footer-title">Quick Links</h4>
            <ul class="footer-links">
                <li><a href="/">Home</a></li>
                <li><a href="/perfumes">All Perfumes</a></li>
                <li><a href="/about">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="footer-title">Customer Service</h4>
            <ul class="footer-links">
                <li><a href="#">Shipping & Returns</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>
        <div>
            <h4 class="footer-title">Follow Us</h4>
            <ul class="footer-links">
                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fab fa-youtube"></i> YouTube</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 TROY Perfumes. All rights reserved.</p>
    </div>
</footer>

<script>
    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if(window.scrollY > 40){
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });
</script>
</body>
</html>
