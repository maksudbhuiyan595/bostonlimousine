<div class="container-fluid nav-bar sticky-top px-0 px-lg-4 shadow-lg" id="mainNavbar">
    <div class="container h-100">
        <nav class="navbar navbar-expand-lg p-0 h-100">
            <a href="{{ url('/') }}" class="navbar-brand p-0 premium-logo">
                <div class="logo-wrapper">
                    <img src="{{ asset('images/logo.png') }}" alt="Boston Limousine" height="80" class="logo-img" id="mainLogo">
                </div>
            </a>

            <div class="d-flex align-items-center gap-2 d-lg-none">
                <a href="tel:+18577772125" class="mobile-phone-btn">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>
                <button class="navbar-toggler premium-toggler" type="button" id="customMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="navbar-collapse-custom" id="navbarCollapse">
                <div class="mobile-menu-header d-lg-none">
                    <div class="menu-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="55">
                    </div>
                    <button class="close-menu-btn" id="closeMenuBtn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="navbar-nav mx-auto py-3 py-lg-0 gap-lg-2">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reservation') }}" class="nav-link {{ request()->routeIs('reservation') ? 'active' : '' }}">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Minivan</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Long Distance</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Child Seat</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Blogs</a></li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>

                <a href="tel:+18577772125" class="desktop-call-btn d-none d-lg-flex">
                    <i class="fas fa-phone-alt"></i>
                    <span>857-777-2125</span>
                </a>
            </div>
        </nav>
    </div>
</div>

<style>
:root {
    --brand-gold: #C5A059;
    --brand-gold-dark: #A8883E;
    --brand-gold-light: #D4B87A;
    --brand-dark: #1A1A1A;
    --brand-white: #FFFFFF;
    --nav-height: 90px;
    --nav-scrolled-height: 75px;
}

/* Base Navbar Styles */
.nav-bar {
    background: var(--brand-white) !important;
    border-bottom: 2px solid var(--brand-gold);
    height: var(--nav-height);
    display: flex;
    align-items: center;
    z-index: 1030;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* --- SCROLLED STATE (Animation) --- */
.nav-bar.is-scrolled {
    height: var(--nav-scrolled-height) !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px); /* Modern frosted glass effect */
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    position: fixed;
    top: 0;
    width: 100%;
    animation: navSlideDown 0.5s ease;
}

@keyframes navSlideDown {
    from { transform: translateY(-100%); }
    to { transform: translateY(0); }
}

.nav-bar.is-scrolled .logo-img {
    height: 60px; /* Shrink logo slightly */
}

/* Desktop Navigation */
@media (min-width: 992px) {
    .navbar-collapse-custom {
        display: flex !important;
        justify-content: space-between;
        width: 100%;
    }
    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .nav-link {
        color: var(--brand-dark);
        font-weight: 600;
        padding: 8px 15px;
        transition: all 0.3s ease;
        position: relative;
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
        transition: transform 0.4s cubic-bezier(0.86, 0, 0.07, 1);
    }
    .nav-link:hover::after, .nav-link.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }
    .nav-link:hover, .nav-link.active {
        color: var(--brand-gold) !important;
    }
}

/* Mobile Menu Styles */
@media (max-width: 991.98px) {
    .nav-bar { height: 80px; }

    .navbar-collapse-custom {
        position: fixed;
        top: 100%;
        left: 0;
        width: 100%;
        height: 100vh;
        background: rgba(26, 26, 26, 0.98);
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        z-index: 9999;
        display: flex !important;
        flex-direction: column;
        opacity: 0;
        visibility: hidden;
    }
    .navbar-collapse-custom.show {
        top: 0;
        opacity: 1;
        visibility: visible;
    }
    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid rgba(197, 160, 89, 0.2);
    }
    .navbar-nav .nav-item {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }
    .navbar-collapse-custom.show .navbar-nav .nav-item {
        opacity: 1;
        transform: translateY(0);
    }
    /* Staggered Delay for Menu Items */
    .navbar-collapse-custom.show .navbar-nav .nav-item:nth-child(1) { transition-delay: 0.1s; }
    .navbar-collapse-custom.show .navbar-nav .nav-item:nth-child(2) { transition-delay: 0.15s; }
    .navbar-collapse-custom.show .navbar-nav .nav-item:nth-child(3) { transition-delay: 0.2s; }
    .navbar-collapse-custom.show .navbar-nav .nav-item:nth-child(4) { transition-delay: 0.25s; }
    .navbar-collapse-custom.show .navbar-nav .nav-item:nth-child(5) { transition-delay: 0.3s; }

    .nav-link { color: white !important; font-size: 1.2rem; padding: 15px 25px !important; }
}

/* UI Elements */
.premium-toggler { color: var(--brand-gold) !important; border: 1px solid rgba(197, 160, 89, 0.4) !important; }
.mobile-phone-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: white; padding: 8px 16px; border-radius: 50px; text-decoration: none; font-size: 0.8rem; font-weight: bold;
    display: flex; align-items: center; gap: 5px;
}
.desktop-call-btn {
    background: linear-gradient(135deg, var(--brand-gold), var(--brand-gold-dark));
    color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: bold;
    display: flex; align-items: center; gap: 10px; transition: 0.3s;
}
.desktop-call-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(197, 160, 89, 0.4); color: white; }

.close-menu-btn {
    background: transparent; border: 1px solid var(--brand-gold); color: var(--brand-gold);
    width: 40px; height: 40px; border-radius: 50%; transition: 0.3s;
}
.close-menu-btn:hover { transform: rotate(90deg); background: var(--brand-gold); color: white; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    const customToggler = document.getElementById('customMenuBtn');
    const closeBtn = document.getElementById('closeMenuBtn');
    const menu = document.getElementById('navbarCollapse');

    // 1. SCROLL ANIMATION LOGIC
    window.addEventListener('scroll', function() {
        if (window.scrollY > 80) {
            navbar.classList.add('is-scrolled');
        } else {
            navbar.classList.remove('is-scrolled');
        }
    });

    // 2. MOBILE MENU LOGIC
    function openMenu() {
        menu.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (customToggler) customToggler.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    // Close menu when clicking a link
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) setTimeout(closeMenu, 150);
        });
    });

    // ESC key support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
});
</script>
