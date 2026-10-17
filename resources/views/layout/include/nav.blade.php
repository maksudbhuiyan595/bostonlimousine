<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
:root {
    --brand-gold: #B9924B;
    --brand-gold-dark: #987535;
    --brand-dark: #121824;
    --brand-white: #FFFFFF;
    --nav-height: 85px;
    --nav-height-mobile: 72px;
}

body {
    padding-top: var(--nav-height) !important;
}
@media (max-width: 991.98px) {
    body {
        padding-top: var(--nav-height-mobile) !important;
    }
}

/* Base Navbar */
.nav-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: var(--brand-dark) !important;
    height: var(--nav-height) !important;
    display: flex;
    align-items: center;
    z-index: 1030;
    border-bottom: 1px solid rgba(185, 146, 75, 0.25);
    transition: background 0.3s ease, box-shadow 0.3s ease;
}

.nav-bar.is-scrolled {
    background: rgba(18, 24, 36, 0.98) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.45) !important;
}

.logo-wrapper .logo-img {
    height: 55px;
    width: auto;
    object-fit: contain;
}

/* ========================================================
   DESKTOP NAVIGATION (>= 992px)
======================================================== */
@media (min-width: 992px) {
    .desktop-nav-wrap {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    .desktop-nav-list {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 6px;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .desk-nav-link {
        color: var(--brand-white) !important;
        font-weight: 500;
        font-size: 0.93rem;
        padding: 8px 12px !important;
        transition: color 0.3s ease;
        position: relative;
        white-space: nowrap;
        text-decoration: none !important;
    }
    .desk-nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--brand-gold);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s cubic-bezier(0.86, 0, 0.07, 1);
    }
    .desk-nav-link:hover::after,
    .desk-nav-link.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    .desk-nav-link:hover,
    .desk-nav-link.active {
        color: var(--brand-gold) !important;
    }
    .mobile-drawer-box,
    .mobile-drawer-overlay {
        display: none !important;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    .desk-nav-link { font-size: 0.82rem; padding: 6px 6px !important; }
    .desktop-call-btn { padding: 7px 14px !important; font-size: 0.82rem !important; }
    .logo-wrapper .logo-img { height: 48px; }
}

/* ========================================================
   MOBILE NAVBAR (< 992px)
======================================================== */
@media (max-width: 991.98px) {
    .nav-bar {
        height: var(--nav-height-mobile) !important;
    }
    .nav-bar .logo-img {
        height: 44px;
    }
    .desktop-nav-wrap {
        display: none !important;
    }
}

/* ========================================================
   STANDALONE MOBILE DRAWER (PURE CSS & ZERO CONFLICT)
======================================================== */
.mobile-drawer-box {
    position: fixed;
    top: 0;
    right: -100%;
    width: 82%;
    max-width: 320px;
    height: 100vh;
    height: 100dvh;
    background: #0f1622 !important;
    z-index: 2147483647 !important;
    display: flex;
    flex-direction: column;
    box-shadow: -8px 0 30px rgba(0, 0, 0, 0.85);
    transition: right 0.3s ease-in-out;
    overflow-y: auto;
}

.mobile-drawer-box.is-open {
    right: 0 !important;
}

.mobile-drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid rgba(185, 146, 75, 0.25);
    background: #080c14;
    position: sticky;
    top: 0;
    z-index: 2;
}

.mobile-drawer-nav {
    list-style: none;
    padding: 15px 12px;
    margin: 0;
}

.mobile-drawer-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    margin-bottom: 3px;
}

.mobile-nav-click {
    color: #ffffff !important;
    font-size: 1.05rem !important;
    padding: 14px 16px !important;
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none !important;
    cursor: pointer !important;
    background: transparent;
    border: none;
    width: 100%;
    text-align: left;
}

.mobile-nav-click.active {
    color: var(--brand-gold) !important;
    background: rgba(185, 146, 75, 0.15) !important;
    border-left: 3px solid var(--brand-gold);
}

.mobile-drawer-footer {
    padding: 20px;
    margin-top: auto;
    background: #080c14;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}

/* Standalone Overlay */
.mobile-drawer-overlay {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.65);
    z-index: 2147483640 !important;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.mobile-drawer-overlay.is-open {
    opacity: 1;
    visibility: visible;
}

/* Buttons */
.premium-toggler {
    background: transparent;
    color: var(--brand-gold) !important;
    border: 1px solid rgba(185, 146, 75, 0.45) !important;
    border-radius: 8px;
    padding: 6px 11px;
    font-size: 1.15rem;
    cursor: pointer;
}

.mobile-phone-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: #FFFFFF !important;
    padding: 7px 14px;
    border-radius: 50px;
    text-decoration: none !important;
    font-size: 0.78rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.desktop-call-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: #FFFFFF !important;
    padding: 9px 20px;
    border-radius: 50px;
    text-decoration: none !important;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.close-menu-btn {
    background: transparent;
    border: 1px solid var(--brand-gold);
    color: var(--brand-gold);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
</style>

<!-- MAIN NAVBAR -->
<header class="container-fluid nav-bar px-0 px-lg-4" id="mainNavbar">
    <div class="container-xxl h-100">
        <div class="d-flex justify-content-between align-items-center h-100 w-100">

            <a href="{{ url('/') }}" class="navbar-brand p-0 m-0">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/logo.png') }}" alt="Logan Airport Transfer" class="logo-img">
                </div>
            </a>

            <!-- Mobile Buttons -->
            <div class="d-flex align-items-center gap-2 d-lg-none">
                <a href="tel:+18577772125" class="mobile-phone-btn" aria-label="Call directly">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>
                <button type="button" class="premium-toggler" id="openMobileDrawerBtn" aria-label="Open menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Desktop Menu Structure -->
            <div class="desktop-nav-wrap">
                <ul class="desktop-nav-list mx-auto">
                    <li><a href="{{ route('home') }}" class="desk-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('reservation') }}" class="desk-nav-link {{ request()->routeIs('reservation') ? 'active' : '' }}">Reservation</a></li>
                    <li><a href="{{ route('minivan') }}" class="desk-nav-link {{ request()->routeIs('minivan') ? 'active' : '' }}">Minivan</a></li>
                    <li><a href="{{ route('long.distance') }}" class="desk-nav-link {{ request()->routeIs('long.distance') ? 'active' : '' }}">Long Distance</a></li>
                    <li><a href="{{ route('child.seat') }}" class="desk-nav-link {{ request()->routeIs('child.seat') ? 'active' : '' }}">Child Seat</a></li>
                    <li><a href="{{ route('services') }}" class="desk-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
                    <li><a href="{{ route('blogs') }}" class="desk-nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}">Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="desk-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>

                <a href="tel:+18577772125" class="desktop-call-btn">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- STANDALONE MOBILE DRAWER (HEADER-ER BAIRE RAKHA HOYECHE) -->
<div class="mobile-drawer-box" id="pureMobileDrawer">
    <div class="mobile-drawer-header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="34">
        <button type="button" class="close-menu-btn" id="closeMobileDrawerBtn" aria-label="Close menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <ul class="mobile-drawer-nav">
        <li class="mobile-drawer-item">
            <a href="{{ route('home') }}" class="mobile-nav-click {{ request()->routeIs('home') ? 'active' : '' }}">
                <span>Home</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('reservation') }}" class="mobile-nav-click {{ request()->routeIs('reservation') ? 'active' : '' }}">
                <span>Reservation</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('minivan') }}" class="mobile-nav-click {{ request()->routeIs('minivan') ? 'active' : '' }}">
                <span>Minivan</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('long.distance') }}" class="mobile-nav-click {{ request()->routeIs('long.distance') ? 'active' : '' }}">
                <span>Long Distance</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('child.seat') }}" class="mobile-nav-click {{ request()->routeIs('child.seat') ? 'active' : '' }}">
                <span>Child Seat</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('services') }}" class="mobile-nav-click {{ request()->routeIs('services') ? 'active' : '' }}">
                <span>Services</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('blogs') }}" class="mobile-nav-click {{ request()->routeIs('blogs') ? 'active' : '' }}">
                <span>Blogs</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
        <li class="mobile-drawer-item">
            <a href="{{ route('contact') }}" class="mobile-nav-click {{ request()->routeIs('contact') ? 'active' : '' }}">
                <span>Contact</span>
                <i class="fas fa-chevron-right text-muted small"></i>
            </a>
        </li>
    </ul>

    <div class="mobile-drawer-footer">
        <a href="tel:+18577772125" class="desktop-call-btn w-100 justify-content-center">
            <i class="fas fa-phone-alt"></i>
            <span>Call: 857-777-2125</span>
        </a>
    </div>
</div>

<!-- BACKDROP OVERLAY -->
<div class="mobile-drawer-overlay" id="pureDrawerOverlay"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const openBtn = document.getElementById('openMobileDrawerBtn');
    const closeBtn = document.getElementById('closeMobileDrawerBtn');
    const drawer = document.getElementById('pureMobileDrawer');
    const overlay = document.getElementById('pureDrawerOverlay');

    // Scroll Effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 20) {
            navbar.classList.add('is-scrolled');
        } else {
            navbar.classList.remove('is-scrolled');
        }
    }, { passive: true });

    // Open Drawer
    function openDrawer() {
        drawer.classList.add('is-open');
        overlay.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    // Close Drawer
    function closeDrawer() {
        drawer.classList.remove('is-open');
        overlay.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    if (openBtn) {
        openBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            openDrawer();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeDrawer();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            closeDrawer();
        });
    }

    // DIRECT LINK NAVIGATION - PURE NATIVE JS
    const mobileLinks = drawer.querySelectorAll('.mobile-nav-click');
    mobileLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const url = this.getAttribute('href');
            if (url && url !== '#' && !url.startsWith('javascript:')) {
                e.preventDefault();
                e.stopPropagation();
                window.location.assign(url);
            }
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDrawer();
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            closeDrawer();
        }
    });
});
</script>
