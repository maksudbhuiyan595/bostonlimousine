<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --brand-gold: #C5A059;
    --brand-gold-dark: #A8883E;
    --brand-gold-light: #D4B87A;
    --brand-dark: #1A1A1A;
    --brand-white: #FFFFFF;
    --nav-height: 90px;
    --nav-height-mobile: 75px;
}

/* নেভবারের ফিক্সড পজিশনের কারণে কনটেন্ট নিচে নামানো */
body {
    padding-top: var(--nav-height);
}
@media (max-width: 991.98px) {
    body {
        padding-top: var(--nav-height-mobile);
    }
}

/* Base Navbar Styles */
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
    transition: background 0.3s ease, box-shadow 0.3s ease, height 0.3s ease;
}

/* Scrolled State */
.nav-bar.is-scrolled {
    background: rgba(26, 26, 26, 0.96) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4) !important;
}

.logo-wrapper .logo-img {
    height: 65px;
    width: auto;
    object-fit: contain;
    transition: height 0.3s ease;
}

/* Desktop Navigation (>= 992px) */
@media (min-width: 992px) {
    .navbar-collapse-custom {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 0;
    }
    .nav-link {
        color: var(--brand-white) !important;
        font-weight: 500;
        padding: 8px 12px;
        transition: color 0.3s ease;
        position: relative;
        white-space: nowrap;
    }
    .nav-link::after {
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
    .nav-link:hover::after,
    .nav-link.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    .nav-link:hover,
    .nav-link.active {
        color: var(--brand-gold) !important;
    }
}

/* ল্যাপটপ ও মিডিয়াম ডেস্কটপ অপটিমাইজেশন (992px - 1199px) */
@media (min-width: 992px) and (max-width: 1199.98px) {
    .nav-link {
        font-size: 0.8rem;
        padding: 6px 5px !important;
    }
    .desktop-call-btn {
        padding: 7px 12px !important;
        font-size: 0.8rem !important;
        gap: 5px;
    }
    .logo-wrapper .logo-img {
        height: 52px;
    }
}

/* Mobile & Tablet Styles (< 992px) */
@media (max-width: 991.98px) {
    .nav-bar,
    .nav-bar.is-scrolled {
        height: var(--nav-height-mobile) !important;
    }
    .nav-bar .logo-img,
    .nav-bar.is-scrolled .logo-img {
        height: 48px;
    }

    .navbar-collapse-custom {
        position: fixed;
        top: 0;
        right: -100%;
        width: 85%;
        max-width: 360px;
        height: 100vh;
        height: 100dvh;
        background: #141414;
        transition: right 0.35s cubic-bezier(0.23, 1, 0.32, 1);
        z-index: 9999;
        display: flex !important;
        flex-direction: column;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.6);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    .navbar-collapse-custom.show {
        right: 0;
    }

    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid rgba(197, 160, 89, 0.2);
        background: #0f0f0f;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .navbar-nav {
        padding: 15px 12px !important;
    }

    .navbar-nav .nav-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-size: 1rem;
        padding: 12px 14px !important;
        display: block;
        font-weight: 500;
    }

    .nav-link.active,
    .nav-link:hover {
        color: var(--brand-gold) !important;
        background: rgba(197, 160, 89, 0.08);
        border-radius: 6px;
    }

    .mobile-call-wrapper {
        padding: 20px;
        margin-top: auto;
    }
}

/* ব্যাকড্রপ ওভারলে */
.menu-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.65);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.menu-backdrop.show {
    opacity: 1;
    visibility: visible;
}

/* বাটন ও ইন্টারেক্টিভ এলিমেন্ট */
.premium-toggler {
    background: transparent;
    color: var(--brand-gold) !important;
    border: 1px solid rgba(197, 160, 89, 0.4) !important;
    border-radius: 8px;
    padding: 7px 11px;
    font-size: 1.15rem;
    cursor: pointer;
}
.mobile-phone-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: #FFFFFF !important;
    padding: 7px 14px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 0.78rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
}
.desktop-call-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: #FFFFFF !important;
    padding: 9px 18px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    transition: 0.3s;
}
.desktop-call-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(197, 160, 89, 0.4);
    color: #FFFFFF !important;
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
    transition: 0.3s;
}
.close-menu-btn:hover {
    transform: rotate(90deg);
    background: var(--brand-gold);
    color: white;
}
</style>

<!-- MAIN NAVBAR -->
<header class="container-fluid nav-bar px-0 px-lg-4" id="mainNavbar">
    <div class="container-xxl h-100">
        <nav class="navbar navbar-expand-lg p-0 h-100">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="navbar-brand p-0 premium-logo">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/logo.png') }}" alt="Boston Limousine" class="logo-img" id="mainLogo">
                </div>
            </a>

            <!-- Mobile Buttons (Phone & Hamburger) -->
            <div class="d-flex align-items-center gap-2 d-lg-none">
                <a href="tel:+18577772125" class="mobile-phone-btn" aria-label="Call directly">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>
                <button class="navbar-toggler premium-toggler" type="button" id="customMenuBtn" aria-expanded="false" aria-label="Open menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Navbar Menu List -->
            <div class="navbar-collapse-custom" id="navbarCollapse">
                <div class="mobile-menu-header d-lg-none">
                    <div class="menu-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="38">
                    </div>
                    <button class="close-menu-btn" id="closeMenuBtn" aria-label="Close menu">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservation') }}" class="nav-link {{ request()->routeIs('reservation') ? 'active' : '' }}">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('minivan') }}" class="nav-link {{ request()->routeIs('minivan') ? 'active' : '' }}">Minivan</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('long.distance') }}" class="nav-link {{ request()->routeIs('long.distance') ? 'active' : '' }}">Long Distance</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('child.seat') }}" class="nav-link {{ request()->routeIs('child.seat') ? 'active' : '' }}">Child Seat</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blogs') }}" class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                    </li>
                </ul>

                <!-- Desktop Call Button -->
                <a href="tel:+18577772125" class="desktop-call-btn d-none d-lg-flex">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>

                <!-- Mobile Inside Drawer Call Button -->
                <div class="mobile-call-wrapper d-lg-none">
                    <a href="tel:+18577772125" class="desktop-call-btn w-100 justify-content-center">
                        <i class="fas fa-phone-alt"></i>
                        <span>Call: 857-777-2125</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Mobile Overlay Backdrop -->
<div class="menu-backdrop" id="menuBackdrop"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const customToggler = document.getElementById('customMenuBtn');
    const closeBtn = document.getElementById('closeMenuBtn');
    const menu = document.getElementById('navbarCollapse');
    const backdrop = document.getElementById('menuBackdrop');

    // 1. Scroll Effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 30) {
            navbar.classList.add('is-scrolled');
        } else {
            navbar.classList.remove('is-scrolled');
        }
    }, { passive: true });

    // 2. Open / Close Menu Logic
    function openMenu() {
        menu.classList.add('show');
        backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
        if (customToggler) customToggler.setAttribute('aria-expanded', 'true');
    }

    function closeMenu() {
        menu.classList.remove('show');
        backdrop.classList.remove('show');
        document.body.style.overflow = '';
        if (customToggler) customToggler.setAttribute('aria-expanded', 'false');
    }

    if (customToggler) customToggler.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (backdrop) backdrop.addEventListener('click', closeMenu);

    // Close menu when clicking link
    document.querySelectorAll('.navbar-collapse-custom .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) closeMenu();
        });
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });

    // Reset overflow on desktop resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            closeMenu();
        }
    });
});
</script>
