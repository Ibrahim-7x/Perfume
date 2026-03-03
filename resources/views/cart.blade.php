{{-- Shared Cart Component - included on every page --}}

<!-- Cart Styles -->
<style>
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
    .cart-thumb img{
        width:100%;
        height:100%;
        object-fit:cover;
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
    .cart-qty .qty-btn{
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
        color:var(--danger, #ef4444);
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
    .cart-actions .btn-outline{
        flex:1;
        padding:.65rem 1rem;
        border-radius:999px;
        border:1px solid rgba(148,163,184,0.65);
        background:transparent;
        color:var(--text-main);
        cursor:pointer;
        font-size:.85rem;
    }
    .cart-actions .btn-primary{
        flex:1;
        padding:.65rem 1rem;
        border-radius:999px;
        background:var(--primary, #22c55e);
        color:#022c22;
        border:none;
        cursor:pointer;
        font-size:.85rem;
        font-weight:600;
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
    @keyframes jet{
        0%{ opacity:1; transform:translate(0,0) scale(1) rotate(0deg); }
        50%{ opacity:1; transform:translate(calc(var(--jet-x) * 0.5), calc(var(--jet-y) * 0.5)) scale(0.7) rotate(-15deg); }
        100%{ opacity:0; transform:translate(var(--jet-x), var(--jet-y)) scale(0.2) rotate(-30deg); }
    }

    /* Toast */
    .cart-toast{
        position:fixed;
        bottom:20px;
        left:50%;
        transform:translateX(-50%) translateY(120%);
        padding:.9rem 1.3rem;
        border-radius:999px;
        background:rgba(15,23,42,0.96);
        border:1px solid rgba(148,163,184,0.4);
        color:var(--text-main, #e5f2ff);
        font-size:.85rem;
        display:flex;
        align-items:center;
        gap:.6rem;
        z-index:70;
        transition:.3s;
    }
    .cart-toast.active{
        transform:translateX(-50%) translateY(0);
    }

    /* Location share section in cart */
    .cart-location-share{
        margin:.6rem 0;
        padding:.6rem;
        border-radius:12px;
        border:1px solid rgba(148,163,184,0.15);
        background:rgba(15,23,42,0.4);
    }
    .cart-location-share .location-share-title{
        font-size:.82rem;
        font-weight:600;
        margin-bottom:.35rem;
    }
    .cart-location-share .location-share-details{
        font-size:.78rem;
        color:var(--text-muted, #9ca3af);
    }
</style>

<!-- Overlay + Cart Modal -->
<div class="overlay" id="cartOverlay"></div>
<div class="cart-modal" id="cartModal">
    <div class="cart-header">
        <h3 class="cart-title">Your Cart</h3>
        <button class="btn-outline" id="closeCart" style="flex:0 0 auto;width:auto;padding:.4rem .8rem;">Close</button>
    </div>
    <div class="cart-body" id="cartItems"></div>
    <div class="cart-footer">
        <div class="cart-total-row">
            <span>Total</span>
            <span id="cartTotalAmount">Rs 0</span>
        </div>
        <!-- Location sharing section in cart -->
        <div class="cart-location-share">
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
    <i class="fas fa-circle-check" style="color:#22c55e;"></i>
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

        cartItems.innerHTML = '';
        let total = 0;

        if (window.troyCart.length === 0) {
            cartItems.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--text-muted);">Your cart is empty</div>';
        } else {
            window.troyCart.forEach(item => {
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
                    window.troyCart = window.troyCart.filter(c => c.id !== item.id);
                    updateCartUI();
                });

                cartItems.appendChild(row);
            });
        }

        cartTotalAmount.textContent = 'Rs ' + total.toLocaleString();
        cartCount.textContent = window.troyCart.reduce((sum, i) => sum + i.quantity, 0);

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
