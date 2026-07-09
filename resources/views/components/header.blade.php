@props(['activePage' => null])

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CFMKG2H8Y4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CFMKG2H8Y4');
</script>

<header class="nav">
    <div class="max nav-content">
        <div class="logo">
            <x-brand-logo />
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
                <a href="{{ url('/') }}#features">Features</a>
                <a href="{{ url('/') }}#how">How it works</a>
                <a href="{{ url('/') }}#themes">Templates</a>
                <a href="{{ url('/resume-templates') }}">Resume guides</a>
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="{{ url('/') }}#pricing">Pricing</a>
            </nav>
            <div class="nav-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                    <a href="{{ route('register') }}    " class="btn btn-primary">
    Sign up free
</a>
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
