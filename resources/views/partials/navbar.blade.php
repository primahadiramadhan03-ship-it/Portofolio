<!-- Navigation -->
<nav>
    <div class="logo">&lt;/&gt; {{ $user->name ?? 'Prima' }}</div>
    
    <ul class="nav-links">
        <li><a href="{{ url('/#home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/#about') }}">About</a></li>
        <li><a href="{{ url('/#skills') }}">Skills</a></li>
        <li><a href="{{ url('/#portfolio') }}">Portfolio</a></li>
        <li><a href="{{ url('/#contact') }}">Contact</a></li>
        @auth
            <li><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-color);"><i class="fas fa-cog"></i> Admin</a></li>
        @endauth
    </ul>

    @php
        $navGithub = $contact->link_github ?? ($user->link_github ?? '');
        if ($navGithub && !\Illuminate\Support\Str::startsWith($navGithub, ['http://', 'https://'])) {
            $navGithub = 'https://' . $navGithub;
        }

        $navLinkedin = $contact->link_linkedin ?? '';
        if ($navLinkedin && !\Illuminate\Support\Str::startsWith($navLinkedin, ['http://', 'https://'])) {
            $navLinkedin = 'https://' . $navLinkedin;
        }

        $navInstagram = $contact->link_instagram ?? '';
        if ($navInstagram && !\Illuminate\Support\Str::startsWith($navInstagram, ['http://', 'https://'])) {
            $navInstagram = 'https://' . $navInstagram;
        }
    @endphp

    <div class="nav-icons">
        @if($navGithub)
            <a href="{{ $navGithub }}" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
        @endif
        @if($navLinkedin)
            <a href="{{ $navLinkedin }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        @endif
        @if($navInstagram)
            <a href="{{ $navInstagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        @endif
    </div>

    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <ul>
        <li><a href="{{ url('/#home') }}">Home</a></li>
        <li><a href="{{ url('/#about') }}">About</a></li>
        <li><a href="{{ url('/#skills') }}">Skills</a></li>
        <li><a href="{{ url('/#portfolio') }}">Portfolio</a></li>
        <li><a href="{{ url('/#contact') }}">Contact</a></li>
        @auth
            <li><a href="{{ route('admin.dashboard') }}" style="color: var(--primary-color);"><i class="fas fa-cog"></i> Admin Panel</a></li>
        @endauth
    </ul>
    @if($navGithub || $navLinkedin || $navInstagram)
        <div class="mobile-social" style="display: flex; gap: 15px; padding: 15px 10px 5px; border-top: 1px solid var(--border-color); margin-top: 10px;">
            @if($navGithub)
                <a href="{{ $navGithub }}" target="_blank" title="GitHub" style="color: var(--text-secondary); font-size: 18px;"><i class="fab fa-github"></i></a>
            @endif
            @if($navLinkedin)
                <a href="{{ $navLinkedin }}" target="_blank" title="LinkedIn" style="color: var(--text-secondary); font-size: 18px;"><i class="fab fa-linkedin-in"></i></a>
            @endif
            @if($navInstagram)
                <a href="{{ $navInstagram }}" target="_blank" title="Instagram" style="color: var(--text-secondary); font-size: 18px;"><i class="fab fa-instagram"></i></a>
            @endif
        </div>
    @endif
</div>

<style>
    /* Navigation Styles */
    nav {
        position: fixed;
        top: 0;
        width: 100%;
        padding: 20px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        background: rgba(10, 14, 23, 0.95);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--border-color);
    }

    .logo {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .nav-links {
        display: flex;
        gap: 40px;
        list-style: none;
        align-items: center;
    }

    .nav-links a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: var(--primary-color);
    }

    .nav-icons {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .nav-icons a {
        color: var(--text-secondary);
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .nav-icons a:hover {
        color: var(--primary-color);
    }

    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        color: var(--text-primary);
        font-size: 24px;
        cursor: pointer;
    }

    /* Mobile Menu Styles */
    .mobile-menu {
        display: none;
        position: fixed;
        top: 65px;
        left: 0;
        right: 0;
        background: var(--bg-card);
        border-bottom: 1px solid var(--border-color);
        padding: 20px;
        z-index: 999;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .mobile-menu.active {
        display: block;
    }

    .mobile-menu ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mobile-menu a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 15px;
        display: block;
        padding: 10px 12px;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .mobile-menu a:hover {
        color: var(--primary-color);
        background: rgba(0, 212, 170, 0.1);
    }

    @media (max-width: 768px) {
        nav {
            padding: 16px 20px;
        }

        .nav-links {
            display: none;
        }

        .nav-icons {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
        }
    }

    @media (max-width: 480px) {
        nav {
            padding: 14px 16px;
        }

        .logo {
            font-size: 19px;
        }
    }
</style>

<script>
    // Mobile Menu Toggle Logic
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });
    }

    // Close mobile menu when a link is clicked
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
        });
    });
</script>
