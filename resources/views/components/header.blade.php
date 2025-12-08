@props(['activePage' => null])

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CFMKG2H8Y4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CFMKG2H8Y4');
</script>

<style>
    header.nav {
        position: sticky;
        top: 0;
        z-index: 40;
        backdrop-filter: blur(14px);
        background: rgba(3, 7, 17, 0.85);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .nav-content {
        height: 74px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .logo-mark {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: linear-gradient(140deg, var(--accent), var(--accent-2), var(--accent-3));
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .logo img {
        height: 200px;
        width: 200px;
        display: block;
    }

    .logo-copy span {
        display: block;
        font-size: 12px;
        color: var(--text-muted);
    }

    .nav-links {
        display: flex;
        gap: 28px;
        font-size: 14px;
        color: var(--text-muted);
    }

    .nav-actions {
        display: flex;
        gap: 12px;
    }

    .btn {
        border: none;
        border-radius: 999px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
    }

    .btn-outline {
        border: 1px solid rgba(255, 255, 255, 0.15);
        background: transparent;
        color: var(--text);
    }

    .btn-primary {
        background: linear-gradient(130deg, var(--accent), var(--accent-2));
        color: #fff;
        box-shadow: 0 15px 40px rgba(93, 107, 255, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 640px) {
        .nav-content {
            height: 74px;
            padding: 0 24px;
        }

        /* Mobile Menu Styles */
        .mobile-menu-btn {
            display: block;
            background: none;
            border: none;
            color: var(--text);
            cursor: pointer;
            padding: 8px;
        }

        .mobile-menu-container {
            display: none;
            position: absolute;
            top: 74px;
            left: 0;
            width: 100%;
            background: rgba(3, 7, 17, 0.98);
            backdrop-filter: blur(20px);
            padding: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            flex-direction: column;
            gap: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .mobile-menu-container.active {
            display: flex;
        }

        .nav-links {
            flex-direction: column;
            align-items: center;
            gap: 20px;
            font-size: 16px;
        }

        .nav-actions {
            flex-direction: column;
            width: 100%;
            gap: 16px;
        }

        .nav-actions .btn {
            width: 100%;
            text-align: center;
            justify-content: center;
        }
    }

    @media (min-width: 641px) {
        .mobile-menu-btn {
            display: none;
        }

        .mobile-menu-container {
            display: contents; /* Allows children to participate in parent flex layout */
        }
    }
</style>

<header class="nav">
    <div class="max nav-content">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('resumizo-logo-white.png') }}"
                     alt="Resumizo Logo"
                     class="h-10 w-auto">
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <button id="mobile-menu-btn" class="mobile-menu-btn" aria-label="Toggle menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        {{-- Mobile Menu Container --}}
        <div id="mobile-menu" class="mobile-menu-container">
            <nav class="nav-links">
                <a href="{{ url('/') }}#hero">How it works</a>
                <a href="{{ url('/') }}#themes">Themes</a>
                <a href="{{ url('/') }}#about">About</a>
                <a href="{{ url('/') }}#why">Why us</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ url('/') }}#contact">Contact</a>
            </nav>
            <div class="nav-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up free</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
            });

            // Close menu when clicking a link
            const links = mobileMenu.querySelectorAll('a');
            links.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                });
            });
        }
    });
</script>
