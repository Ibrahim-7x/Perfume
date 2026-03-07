{{-- Shared Cart Component - included on every page --}}

<!-- Cart Styles -->
<style>
    /* ===== OVERLAY ===== */
    .overlay{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.6);
        backdrop-filter:blur(6px);
        -webkit-backdrop-filter:blur(6px);
        opacity:0;
        visibility:hidden;
        transition:all .35s cubic-bezier(.4,0,.2,1);
        z-index:40;
    }
    .overlay.active{
        opacity:1;
        visibility:visible;
    }

    /* ===== CART MODAL ===== */
    .cart-modal{
        position:fixed;
        top:0;
        right:-440px;
        width:400px;
        max-width:95vw;
        height:100%;
        background:linear-gradient(165deg, #0b1120 0%, #020617 40%, #0a0f1f 100%);
        border-left:1px solid rgba(148,163,184,0.12);
        box-shadow:-30px 0 80px rgba(0,0,0,0.6);
        padding:0;
        z-index:50;
        transition:right .4s cubic-bezier(.32,.72,0,1);
        display:flex;
        flex-direction:column;
        overflow:hidden;
    }
    .cart-modal.open{
        right:0;
    }

    /* ===== CART HEADER ===== */
    .cart-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:1.4rem 1.6rem 1rem;
        background:linear-gradient(180deg, rgba(15,23,42,0.5) 0%, transparent 100%);
        border-bottom:1px solid rgba(148,163,184,0.08);
    }
    .cart-title{
        font-size:1.15rem;
        font-weight:700;
        letter-spacing:.04em;
        display:flex;
        align-items:center;
        gap:.6rem;
    }
    .cart-title-icon{
        width:32px;
        height:32px;
        border-radius:10px;
        background:linear-gradient(135deg, rgba(34,197,94,0.15), rgba(56,189,248,0.15));
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:.95rem;
    }
    .cart-title-count{
        font-size:.72rem;
        font-weight:600;
        background:linear-gradient(135deg,#22c55e,#38bdf8);
        color:#022c22;
        padding:.15rem .55rem;
        border-radius:999px;
        margin-left:.3rem;
    }
    .cart-close-btn{
        width:36px;
        height:36px;
        border-radius:10px;
        border:1px solid rgba(148,163,184,0.15);
        background:rgba(148,163,184,0.06);
        color:var(--text-muted, #94a3b8);
        cursor:pointer;
        font-size:1rem;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:all .25s ease;
    }
    .cart-close-btn:hover{
        background:rgba(239,68,68,0.12);
        border-color:rgba(239,68,68,0.3);
        color:#ef4444;
        transform:rotate(90deg);
    }

    /* ===== CART BODY ===== */
    .cart-body{
        flex:1;
        overflow-y:auto;
        padding:.6rem 1.2rem;
        scroll-behavior:smooth;
    }
    /* Custom scrollbar */
    .cart-body::-webkit-scrollbar{
        width:4px;
    }
    .cart-body::-webkit-scrollbar-track{
        background:transparent;
    }
    .cart-body::-webkit-scrollbar-thumb{
        background:rgba(148,163,184,0.2);
        border-radius:999px;
    }
    .cart-body::-webkit-scrollbar-thumb:hover{
        background:rgba(148,163,184,0.35);
    }

    /* ===== EMPTY STATE ===== */
    .cart-empty{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        padding:3rem 1rem;
        text-align:center;
        gap:.8rem;
    }
    .cart-empty-icon{
        width:72px;
        height:72px;
        border-radius:50%;
        background:linear-gradient(135deg, rgba(148,163,184,0.08), rgba(148,163,184,0.04));
        border:1px dashed rgba(148,163,184,0.2);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:1.8rem;
        margin-bottom:.4rem;
        animation:emptyBounce 3s ease-in-out infinite;
    }
    @keyframes emptyBounce{
        0%,100%{ transform:translateY(0); }
        50%{ transform:translateY(-8px); }
    }
    .cart-empty-title{
        font-size:.95rem;
        font-weight:600;
        color:var(--text-main, #e2e8f0);
    }
    .cart-empty-sub{
        font-size:.78rem;
        color:var(--text-muted, #64748b);
        max-width:200px;
        line-height:1.5;
    }

    /* ===== CART ITEM ===== */
    .cart-item{
        display:flex;
        gap:.9rem;
        align-items:stretch;
        padding:.85rem;
        margin-bottom:.6rem;
        border-radius:14px;
        background:rgba(148,163,184,0.04);
        border:1px solid rgba(148,163,184,0.08);
        transition:all .3s cubic-bezier(.4,0,.2,1);
        position:relative;
        overflow:hidden;
    }
    .cart-item::before{
        content:'';
        position:absolute;
        inset:0;
        border-radius:14px;
        background:linear-gradient(135deg, rgba(34,197,94,0.04), rgba(56,189,248,0.04));
        opacity:0;
        transition:opacity .3s ease;
        pointer-events:none;
    }
    .cart-item:hover{
        border-color:rgba(148,163,184,0.18);
        transform:translateX(-2px);
        box-shadow:4px 4px 20px rgba(0,0,0,0.15);
    }
    .cart-item:hover::before{
        opacity:1;
    }

    /* Thumbnail */
    .cart-thumb{
        width:68px;
        height:80px;
        border-radius:11px;
        overflow:hidden;
        flex-shrink:0;
        position:relative;
        background:rgba(15,23,42,0.5);
        box-shadow:0 4px 12px rgba(0,0,0,0.2);
    }
    .cart-thumb img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:transform .4s ease;
    }
    .cart-item:hover .cart-thumb img{
        transform:scale(1.08);
    }

    /* Item info */
    .cart-info{
        flex:1;
        font-size:.82rem;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
        min-width:0;
    }
    .cart-name{
        font-weight:600;
        font-size:.85rem;
        letter-spacing:.015em;
        line-height:1.3;
        color:var(--text-main, #e2e8f0);
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
    .cart-meta{
        color:var(--text-muted, #64748b);
        font-size:.76rem;
        margin-top:.15rem;
        display:flex;
        align-items:center;
        gap:.35rem;
    }
    .cart-meta .cart-price-each{
        color:#22c55e;
        font-weight:600;
    }
    .cart-item-line-total{
        font-size:.78rem;
        font-weight:700;
        color:var(--text-main, #e2e8f0);
        margin-top:.2rem;
    }

    /* Quantity controls */
    .cart-qty{
        display:flex;
        align-items:center;
        gap:.25rem;
        margin-top:.35rem;
    }
    .cart-qty .qty-btn{
        width:26px;
        height:26px;
        border-radius:8px;
        border:1px solid rgba(148,163,184,0.2);
        background:rgba(148,163,184,0.06);
        color:var(--text-main, #e2e8f0);
        cursor:pointer;
        font-size:.85rem;
        font-weight:600;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:all .2s ease;
        line-height:1;
    }
    .cart-qty .qty-btn:hover{
        background:rgba(34,197,94,0.15);
        border-color:rgba(34,197,94,0.4);
        color:#22c55e;
    }
    .cart-qty .qty-btn:active{
        transform:scale(0.9);
    }
    .cart-qty .qty-value{
        min-width:28px;
        text-align:center;
        font-weight:700;
        font-size:.85rem;
    }
    .remove-item{
        border:none;
        background:none;
        color:var(--text-muted, #64748b);
        cursor:pointer;
        font-size:.72rem;
        margin-left:auto;
        padding:.3rem .5rem;
        border-radius:6px;
        transition:all .2s ease;
        display:flex;
        align-items:center;
        gap:.3rem;
    }
    .remove-item:hover{
        background:rgba(239,68,68,0.1);
        color:#ef4444;
    }

    /* ===== CART FOOTER ===== */
    .cart-footer{
        border-top:1px solid rgba(148,163,184,0.1);
        padding:1rem 1.4rem 1.3rem;
        background:linear-gradient(0deg, rgba(15,23,42,0.4) 0%, transparent 100%);
    }
    .cart-summary{
        display:flex;
        flex-direction:column;
        gap:.4rem;
        margin-bottom:.8rem;
    }
    .cart-summary-row{
        display:flex;
        justify-content:space-between;
        font-size:.8rem;
        color:var(--text-muted, #94a3b8);
    }
    .cart-total-row{
        display:flex;
        justify-content:space-between;
        font-size:1.05rem;
        font-weight:700;
        padding-top:.5rem;
        border-top:1px dashed rgba(148,163,184,0.12);
        color:var(--text-main, #e2e8f0);
    }
    .cart-total-row #cartTotalAmount{
        background:linear-gradient(135deg,#22c55e,#38bdf8);
        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;
        background-clip:text;
    }

    /* Location share section */
    .cart-location-share{
        margin:.7rem 0;
        padding:.7rem .8rem;
        border-radius:12px;
        border:1px solid rgba(148,163,184,0.1);
        background:rgba(148,163,184,0.04);
        transition:all .3s ease;
    }
    .cart-location-share:hover{
        border-color:rgba(148,163,184,0.18);
    }
    .cart-location-share .location-share-title{
        font-size:.8rem;
        font-weight:600;
        margin-bottom:.3rem;
        display:flex;
        align-items:center;
        gap:.4rem;
    }
    .cart-location-share .location-share-details{
        font-size:.75rem;
        color:var(--text-muted, #94a3b8);
    }

    /* Action buttons */
    .cart-actions{
        display:flex;
        gap:.5rem;
    }
    .cart-actions .btn-outline{
        flex:0.6;
        padding:.7rem .8rem;
        border-radius:12px;
        border:1px solid rgba(148,163,184,0.2);
        background:transparent;
        color:var(--text-muted, #94a3b8);
        cursor:pointer;
        font-size:.82rem;
        font-weight:500;
        transition:all .25s ease;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:.35rem;
    }
    .cart-actions .btn-outline:hover{
        border-color:rgba(239,68,68,0.3);
        color:#ef4444;
        background:rgba(239,68,68,0.06);
    }
    .cart-actions .btn-primary{
        flex:1;
        padding:.75rem 1rem;
        border-radius:12px;
        background:linear-gradient(135deg,#22c55e 0%,#16a34a 100%);
        color:#fff;
        border:none;
        cursor:pointer;
        font-size:.85rem;
        font-weight:700;
        letter-spacing:.02em;
        transition:all .3s cubic-bezier(.4,0,.2,1);
        display:flex;
        align-items:center;
        justify-content:center;
        gap:.45rem;
        box-shadow:0 4px 15px rgba(34,197,94,0.3);
        position:relative;
        overflow:hidden;
    }
    .cart-actions .btn-primary::before{
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 50%);
        opacity:0;
        transition:opacity .3s ease;
    }
    .cart-actions .btn-primary:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 25px rgba(34,197,94,0.4);
    }
    .cart-actions .btn-primary:hover::before{
        opacity:1;
    }
    .cart-actions .btn-primary:active{
        transform:translateY(0);
    }

    /* ===== JET ANIMATION ===== */
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
    @keyframes jet{
        0%{ opacity:1; transform:translate(0,0) scale(1) rotate(0deg); }
        50%{ opacity:1; transform:translate(calc(var(--jet-x) * 0.5), calc(var(--jet-y) * 0.5)) scale(0.7) rotate(-15deg); }
        100%{ opacity:0; transform:translate(var(--jet-x), var(--jet-y)) scale(0.2) rotate(-30deg); }
    }

    /* ===== TOAST ===== */
    .cart-toast{
        position:fixed;
        bottom:24px;
        left:50%;
        transform:translateX(-50%) translateY(120%);
        padding:.8rem 1.4rem;
        border-radius:14px;
        background:rgba(15,23,42,0.95);
        backdrop-filter:blur(12px);
        -webkit-backdrop-filter:blur(12px);
        border:1px solid rgba(148,163,184,0.15);
        color:var(--text-main, #e5f2ff);
        font-size:.83rem;
        font-weight:500;
        display:flex;
        align-items:center;
        gap:.6rem;
        z-index:70;
        transition:all .4s cubic-bezier(.32,.72,0,1);
        box-shadow:0 12px 40px rgba(0,0,0,0.4);
    }
    .cart-toast.active{
        transform:translateX(-50%) translateY(0);
    }
    .cart-toast .toast-icon{
        width:22px;
        height:22px;
        border-radius:50%;
        background:rgba(34,197,94,0.15);
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }

    /* ===== ITEM SLIDE-IN ANIMATION ===== */
    @keyframes cartItemSlide{
        from{ opacity:0; transform:translateX(20px); }
        to{ opacity:1; transform:translateX(0); }
    }
    .cart-item{
        animation:cartItemSlide .3s cubic-bezier(.4,0,.2,1) forwards;
    }

    /* ===== LIGHT THEME ===== */
    html[data-theme="light"] .cart-modal{
        background:linear-gradient(165deg, #ffffff 0%, #f8fafc 40%, #f1f5f9 100%) !important;
        border-left-color:rgba(100,116,139,0.12);
        box-shadow:-20px 0 60px rgba(0,0,0,0.08);
    }
    html[data-theme="light"] .cart-header{
        background:linear-gradient(180deg, rgba(248,250,252,0.8) 0%, transparent 100%);
        border-bottom-color:rgba(100,116,139,0.1);
    }
    html[data-theme="light"] .cart-title-icon{
        background:linear-gradient(135deg, rgba(34,197,94,0.1), rgba(56,189,248,0.1));
    }
    html[data-theme="light"] .cart-item{
        background:rgba(255,255,255,0.7);
        border-color:rgba(100,116,139,0.1);
    }
    html[data-theme="light"] .cart-item:hover{
        background:rgba(255,255,255,0.9);
        border-color:rgba(100,116,139,0.2);
        box-shadow:4px 4px 20px rgba(0,0,0,0.06);
    }
    html[data-theme="light"] .cart-thumb{
        background:#f1f5f9;
        box-shadow:0 4px 12px rgba(0,0,0,0.06);
    }
    html[data-theme="light"] .cart-qty .qty-btn{
        border-color:rgba(100,116,139,0.2);
        background:rgba(100,116,139,0.05);
    }
    html[data-theme="light"] .cart-footer{
        border-top-color:rgba(100,116,139,0.1);
        background:linear-gradient(0deg, rgba(248,250,252,0.6) 0%, transparent 100%);
    }
    html[data-theme="light"] .cart-total-row{
        border-top-color:rgba(100,116,139,0.12);
    }
    html[data-theme="light"] .cart-location-share{
        background:rgba(100,116,139,0.04);
        border-color:rgba(100,116,139,0.1);
    }
    html[data-theme="light"] .cart-actions .btn-outline{
        border-color:rgba(100,116,139,0.25);
        color:#64748b;
    }
    html[data-theme="light"] .cart-close-btn{
        border-color:rgba(100,116,139,0.15);
        background:rgba(100,116,139,0.05);
    }
    html[data-theme="light"] .cart-toast{
        background:rgba(255,255,255,0.95) !important;
        border-color:rgba(100,116,139,0.15);
        box-shadow:0 12px 40px rgba(0,0,0,0.1);
        color:#1e293b;
    }
    html[data-theme="light"] .cart-empty-icon{
        background:linear-gradient(135deg, rgba(100,116,139,0.06), rgba(100,116,139,0.03));
        border-color:rgba(100,116,139,0.2);
    }
    html[data-theme="light"] .overlay{
        background:rgba(0,0,0,0.3);
    }
</style>

<!-- Overlay + Cart Modal -->
<div class="overlay" id="cartOverlay"></div>
<div class="cart-modal" id="cartModal">
    <div class="cart-header">
        <h3 class="cart-title">
            <span class="cart-title-icon"><i class="fas fa-bag-shopping"></i></span>
            Shopping Bag
            <span class="cart-title-count" id="cartHeaderCount">0</span>
        </h3>
        <button class="cart-close-btn" id="closeCart" aria-label="Close cart">
            <i class="fas fa-xmark"></i>
        </button>
    </div>
    <div class="cart-body" id="cartItems"></div>
    <div class="cart-footer">
        <div class="cart-summary">
            <div class="cart-summary-row">
                <span>Subtotal</span>
                <span id="cartSubtotal">Rs 0</span>
            </div>
            <div class="cart-summary-row">
                <span>Delivery</span>
                <span style="color:#22c55e;font-weight:600;">Free</span>
            </div>
        </div>
        <div class="cart-total-row">
            <span>Total</span>
            <span id="cartTotalAmount">Rs 0</span>
        </div>
        <!-- Location sharing section in cart -->
        <div class="cart-location-share">
            <div class="location-share-title">
                <i class="fas fa-map-marker-alt" style="color:#22c55e;"></i> Delivery Location
            </div>
            <div class="location-share-details" id="cartLocationDetails">
                <span id="cartLocationText">Allow location access for precise delivery</span>
                <button class="btn-ghost" id="updateLocationBtn" style="margin-top: 8px; padding: 5px 10px; font-size: 0.78rem;">
                    <i class="fas fa-location-dot"></i> Update Location
                </button>
            </div>
        </div>
        <div class="cart-actions">
            <button class="btn-outline" onclick="clearCart()">
                <i class="fas fa-trash-can"></i> Clear
            </button>
            <button class="btn-primary" id="cartCheckoutBtn">
                <i class="fab fa-whatsapp"></i> Checkout via WhatsApp
            </button>
        </div>
    </div>
</div>

<!-- Jet used for add-to-cart animation -->
<div class="jet-icon" id="jetIcon">
    <img alt="Cart Animation Jet" src="https://cdn.pixabay.com/photo/2016/03/31/20/26/plane-1295660_1280.png"/>
</div>

<!-- Toast -->
<div class="cart-toast" id="cartToast">
    <span class="toast-icon"><i class="fas fa-check" style="color:#22c55e;font-size:.65rem;"></i></span>
    <span class="cart-toast-message">Added to cart</span>
</div>

<!-- Cart JavaScript -->
<script>
(function() {
    // ===== CART STATE =====
    window.troyCart = window.troyCart || [];

    // Load cart from localStorage
    try {
        const savedCart = localStorage.getItem('troy-cart');
        if (savedCart) {
            window.troyCart = JSON.parse(savedCart);
        }
    } catch (e) {
        console.error('Error loading cart:', e);
    }

    // ===== DOM REFS =====
    const cartItems = document.getElementById('cartItems');
    const cartTotalAmount = document.getElementById('cartTotalAmount');
    const cartCount = document.querySelector('.cart-count');
    const cartModal = document.getElementById('cartModal');
    const cartToggle = document.getElementById('cartToggle');
    const closeCartBtn = document.getElementById('closeCart');
    const overlay = document.getElementById('cartOverlay');
    // Also support the old "overlay" id for backward compatibility
    const overlayLegacy = document.getElementById('overlay');
    const cartCheckoutBtn = document.getElementById('cartCheckoutBtn');
    const cartToast = document.getElementById('cartToast');
    const jetIcon = document.getElementById('jetIcon');

    // ===== TOGGLE CART =====
    function toggleCart() {
        if (cartModal) cartModal.classList.toggle('open');
        if (overlay) overlay.classList.toggle('active');
        if (overlayLegacy && overlayLegacy !== overlay) overlayLegacy.classList.toggle('active');
        // Close any mobile nav
        const mobileNav = document.getElementById('mobileNav');
        if (mobileNav) mobileNav.classList.remove('active');
    }
    window.toggleCart = toggleCart;

    // ===== ADD TO CART =====
    function addToCart(perfume, sourceButton) {
        if (!perfume) {
            console.error('Perfume not found');
            return;
        }
        const id = perfume.id;
        const existing = window.troyCart.find(item => item.id === id);
        if (existing) {
            existing.quantity += 1;
        } else {
            window.troyCart.push({ ...perfume, quantity: 1 });
        }
        updateCartUI();
        animateJet(sourceButton || null);
        showCartToast(perfume.name ? `${perfume.name} added to cart` : 'Added to cart');
    }
    window.addToCart = addToCart;

    // ===== JET ANIMATION =====
    function animateJet(sourceButton) {
        if (!sourceButton || !jetIcon || !cartToggle) return;
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

    // ===== UPDATE CART UI =====
    function updateCartUI() {
        if (!cartItems || !cartTotalAmount || !cartCount) return;

        const cartHeaderCount = document.getElementById('cartHeaderCount');
        const cartSubtotal = document.getElementById('cartSubtotal');
        cartItems.innerHTML = '';
        let total = 0;
        const totalQty = window.troyCart.reduce((sum, i) => sum + i.quantity, 0);

        if (window.troyCart.length === 0) {
            cartItems.innerHTML = `
                <div class="cart-empty">
                    <div class="cart-empty-icon"><i class="fas fa-bag-shopping"></i></div>
                    <div class="cart-empty-title">Your bag is empty</div>
                    <div class="cart-empty-sub">Discover our exquisite collection and add your favourites</div>
                </div>`;
        } else {
            window.troyCart.forEach((item, idx) => {
                const line = item.price * item.quantity;
                total += line;
                const imgSrc = item.images ? item.images[0] : item.image;
                const safeName = (item.name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');

                const row = document.createElement('div');
                row.className = 'cart-item';
                row.style.animationDelay = (idx * 0.06) + 's';
                row.innerHTML = `
                    <div class="cart-thumb">
                        <img src="${imgSrc}" alt="${safeName}">
                    </div>
                    <div class="cart-info">
                        <div class="cart-name">${safeName}</div>
                        <div class="cart-meta">
                            <span class="cart-price-each">Rs ${item.price.toLocaleString()}</span>
                            <span>× ${item.quantity}</span>
                        </div>
                        <div class="cart-item-line-total">Rs ${line.toLocaleString()}</div>
                        <div style="display:flex;align-items:center;gap:.3rem;margin-top:.25rem;">
                            <div class="cart-qty">
                                <button class="qty-btn" data-action="minus" aria-label="Decrease quantity">−</button>
                                <span class="qty-value">${item.quantity}</span>
                                <button class="qty-btn" data-action="plus" aria-label="Increase quantity">+</button>
                            </div>
                            <button class="remove-item" aria-label="Remove item">
                                <i class="fas fa-trash-can" style="font-size:.65rem;"></i> Remove
                            </button>
                        </div>
                    </div>
                `;
                const minusBtn = row.querySelector('[data-action="minus"]');
                const plusBtn = row.querySelector('[data-action="plus"]');
                const removeBtn = row.querySelector('.remove-item');

                minusBtn.addEventListener('click', () => {
                    if (item.quantity > 1) {
                        item.quantity--;
                    } else {
                        window.troyCart = window.troyCart.filter(c => c.id !== item.id);
                    }
                    updateCartUI();
                });
                plusBtn.addEventListener('click', () => {
                    item.quantity++;
                    updateCartUI();
                });
                removeBtn.addEventListener('click', () => {
                    row.style.transition = 'all .3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(30px)';
                    setTimeout(() => {
                        window.troyCart = window.troyCart.filter(c => c.id !== item.id);
                        updateCartUI();
                    }, 280);
                });

                cartItems.appendChild(row);
            });
        }

        cartTotalAmount.textContent = 'Rs ' + total.toLocaleString();
        if (cartSubtotal) cartSubtotal.textContent = 'Rs ' + total.toLocaleString();
        cartCount.textContent = totalQty;
        if (cartHeaderCount) cartHeaderCount.textContent = totalQty;

        // Save cart to localStorage
        try {
            localStorage.setItem('troy-cart', JSON.stringify(window.troyCart));
        } catch (e) {
            console.error('Error saving cart:', e);
        }
    }
    window.updateCartUI = updateCartUI;

    // ===== CLEAR CART =====
    function clearCart() {
        window.troyCart = [];
        updateCartUI();
        showCartToast('Cart cleared');
    }
    window.clearCart = clearCart;

    // ===== TOAST =====
    function showCartToast(text) {
        if (!cartToast) return;
        const span = cartToast.querySelector('.cart-toast-message');
        if (span) span.textContent = text;
        cartToast.classList.add('active');
        setTimeout(() => {
            if (cartToast) cartToast.classList.remove('active');
        }, 2800);
    }
    window.showCartToast = showCartToast;
    // Also expose as showToast for backward compatibility
    if (typeof window.showToast === 'undefined') {
        window.showToast = showCartToast;
    }

    // ===== CHECKOUT =====
    function proceedToCheckout() {
        if (window.troyCart.length === 0) {
            showCartToast('Your cart is empty!');
            return;
        }

        let message = '🛒 *TROY PERFUMES ORDER* 🛒%0a%0a';

        // Add location if available
        if (window.userLocation && window.userLocation.city) {
            message += '📍 *CUSTOMER LOCATION DETAILS:*%0a';
            message += `🏙️ *City:* ${window.userLocation.city}%0a`;
            message += `🗺️ *Address:* ${window.userLocation.address || 'Not specified'}%0a`;
            message += `📮 *Pin Code:* ${window.userLocation.pinCode || 'N/A'}%0a`;
            if (window.userLocation.latitude && window.userLocation.longitude) {
                message += `🌍 *Coordinates:* ${window.userLocation.latitude.toFixed(6)}, ${window.userLocation.longitude.toFixed(6)}%0a`;
            }
            message += '%0a';
        }

        message += '📦 *ORDER ITEMS:*%0a';
        let total = 0;
        window.troyCart.forEach((item, i) => {
            const line = item.price * item.quantity;
            total += line;
            message += `${i + 1}. ${item.name} — Rs ${item.price.toLocaleString()} x ${item.quantity} = Rs ${line.toLocaleString()}%0a`;
        });
        message += `%0a💰 *Total: Rs ${total.toLocaleString()}*%0a`;

        const whatsappUrl = `https://wa.me/923001234567?text=${message}`;
        window.open(whatsappUrl, '_blank');
    }
    window.proceedToCheckout = proceedToCheckout;

    // ===== EVENT LISTENERS =====
    document.addEventListener('DOMContentLoaded', function() {
        // Initial UI update
        updateCartUI();

        // Cart toggle events
        if (cartToggle) cartToggle.addEventListener('click', toggleCart);
        if (closeCartBtn) closeCartBtn.addEventListener('click', toggleCart);
        if (overlay) overlay.addEventListener('click', toggleCart);
        if (overlayLegacy && overlayLegacy !== overlay) overlayLegacy.addEventListener('click', toggleCart);

        // Checkout button
        if (cartCheckoutBtn) {
            cartCheckoutBtn.addEventListener('click', function() {
                if (window.troyCart.length === 0) {
                    showCartToast('Your cart is empty!');
                    return;
                }
                // If page has contribution modal, show it; otherwise direct checkout
                const contributionModal = document.getElementById('contributionModal');
                if (contributionModal) {
                    contributionModal.classList.add('active');
                } else {
                    proceedToCheckout();
                }
            });
        }
    });
})();
</script>
