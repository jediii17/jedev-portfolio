<nav class="nav-parallax"
    x-data="{ 
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 50;
            });
        },
        closeMobileMenu() {
            this.mobileMenuOpen = false;
        }
    }"
    x-effect="document.body.style.overflow = mobileMenuOpen ? 'hidden' : ''"
    :class="{ 'nav-scrolled': scrolled }"
    role="navigation"
    aria-label="Main navigation">

    {{-- Progress Bar --}}
    <div class="nav-progress" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">

        {{-- Logo / Name --}}
        <a href="{{ route('home') }}"
            class="flex items-center gap-3 font-bold text-xl tracking-tight hover:text-accent transition-all group z-10"
            aria-label="Home - JLC Portfolio">
            <div class="w-10 h-10 text-primary group-hover:text-accent transition-colors">
                <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M30 25V65C30 73.2843 36.7157 80 45 80" stroke="currentColor" stroke-linecap="round" stroke-width="12"></path>
                    <path d="M50 20V80H80" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                    <path d="M85 45C85 33.9543 76.0457 25 65 25" stroke="currentColor" stroke-linecap="round" stroke-width="12"></path>
                </svg>
            </div>
            <span class="hidden sm:inline">JLC</span>
        </a>

        {{-- Desktop Navigation --}}
        <div class="hidden md:flex items-center gap-6">
            <div class="flex items-center gap-6 text-sm font-medium text-muted" role="menubar">
                <a href="{{ route('home') }}#about" class="nav-link" role="menuitem">About</a>
                <a href="{{ route('home') }}#work" class="nav-link" role="menuitem">Work</a>
                <a href="{{ route('home') }}#experience" class="nav-link" role="menuitem">Experience</a>
                <a href="{{ route('home') }}#contact" class="nav-link" role="menuitem">Contact</a>
            </div>

            {{-- Separated Theme Toggle and CTA --}}
            <div class="flex items-center gap-3 pl-6 border-l border-surface">
                <x-theme-toggle />
            </div>

            <a href="{{ route('home') }}#contact"
                class="px-5 py-2.5 rounded-full bg-accent text-white text-sm font-semibold hover:bg-accent-hover transition-all hover:scale-105 shadow-lg shadow-accent/20"
                role="button">
                Hire Me
            </a>
        </div>

        {{-- Mobile Controls --}}
        <div class="flex items-center gap-3 md:hidden relative z-10">
            {{-- Theme Toggle (separated) --}}
            <x-theme-toggle />

            {{-- Hamburger Button --}}
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="relative w-10 h-10 flex items-center justify-center text-muted hover:text-accent focus:outline-none focus-visible:ring-2 focus-visible:ring-accent rounded-lg transition-colors"
                :aria-expanded="mobileMenuOpen"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu">
                <span class="sr-only" x-text="mobileMenuOpen ? 'Close menu' : 'Open menu'"></span>

                {{-- Animated Hamburger Icon --}}
                <div class="w-6 h-5 flex flex-col justify-between" aria-hidden="true">
                    <span
                        class="block h-0.5 bg-current transform transition-all duration-300 origin-center"
                        :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''">
                    </span>
                    <span
                        class="block h-0.5 bg-current transition-all duration-200"
                        :class="mobileMenuOpen ? 'opacity-0' : ''">
                    </span>
                    <span
                        class="block h-0.5 bg-current transform transition-all duration-300 origin-center"
                        :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''">
                    </span>
                </div>
            </button>
        </div>
    </div>

    {{-- Fullscreen Mobile Menu Overlay --}}
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        x-transition:enter="curtain-enter-active"
        x-transition:enter-start="curtain-enter-from"
        x-transition:enter-end="curtain-enter-to"
        x-transition:leave="curtain-leave-active"
        x-transition:leave-start="curtain-leave-from"
        x-transition:leave-end="curtain-leave-to"
        @keydown.escape.window="mobileMenuOpen = false"
        class="md:hidden fixed inset-0 top-16 bg-page/98 backdrop-blur-2xl z-300 origin-top overflow-hidden"
        data-lenis-prevent
        role="dialog"
        aria-modal="true"
        aria-label="Navigation menu">

        <div class="h-full flex flex-col justify-center items-center px-6 py-12">
            <nav class="flex flex-col items-center gap-8 text-center" role="menu">
                <a href="{{ route('home') }}#about"
                    @click="closeMobileMenu()"
                    data-close-mobile-menu
                    class="text-4xl font-bold text-main hover:text-accent transition-all duration-300"
                    :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    style="transition-delay: 200ms"
                    role="menuitem"
                    tabindex="0">
                    About
                </a>
                <a href="{{ route('home') }}#work"
                    @click="closeMobileMenu()"
                    data-close-mobile-menu
                    class="text-4xl font-bold text-main hover:text-accent transition-all duration-300"
                    :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    style="transition-delay: 300ms"
                    role="menuitem"
                    tabindex="0">
                    Work
                </a>
                <a href="{{ route('home') }}#experience"
                    @click="closeMobileMenu()"
                    data-close-mobile-menu
                    class="text-4xl font-bold text-main hover:text-accent transition-all duration-300"
                    :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    style="transition-delay: 400ms"
                    role="menuitem"
                    tabindex="0">
                    Experience
                </a>
                <a href="{{ route('home') }}#contact"
                    @click="closeMobileMenu()"
                    data-close-mobile-menu
                    class="text-4xl font-bold text-main hover:text-accent transition-all duration-300"
                    :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                    style="transition-delay: 500ms"
                    role="menuitem"
                    tabindex="0">
                    Contact
                </a>
            </nav>

            {{-- Mobile CTA --}}
            <div class="mt-16 transition-all duration-300"
                :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                style="transition-delay: 600ms">
                <a href="{{ route('home') }}#contact"
                    @click="closeMobileMenu()"
                    class="inline-flex items-center gap-3 px-10 py-5 rounded-full bg-accent text-white text-xl font-bold hover:bg-accent-hover transition-all shadow-xl shadow-accent/30 active:scale-95"
                    role="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hire Me
                </a>
            </div>

            {{-- Social Links --}}
            <div class="mt-16 flex items-center gap-8 transition-all duration-300"
                :class="mobileMenuOpen ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                style="transition-delay: 700ms">
                <a href="https://github.com/jediii17" target="_blank" rel="noopener noreferrer"
                    class="text-muted hover:text-accent transition-colors p-3" aria-label="GitHub">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.943 0-1.091.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.597 1.028 2.688 0 3.848-2.339 4.685-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://linkedin.com/in/jedidialemuelcruz" target="_blank" rel="noopener noreferrer"
                    class="text-muted hover:text-accent transition-colors p-3" aria-label="LinkedIn">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        position: relative;
        padding: 0.5rem 0;
        transition: color 0.2s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--accent);
        transition: width 0.3s ease;
    }

    .nav-link:hover {
        color: var(--text-primary);
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link:focus-visible {
        outline: 2px solid var(--accent);
        outline-offset: 4px;
        border-radius: 2px;
    }

    .nav-scrolled {
        background: rgba(var(--bg-primary-rgb), 0.95) !important;
    }

    /* Curtain Transition Styles */
    .curtain-enter-active {
        transition: clip-path 0.7s cubic-bezier(0.85, 0, 0.15, 1);
        will-change: clip-path;
    }

    .curtain-enter-from {
        clip-path: inset(0 0 100% 0);
    }

    .curtain-enter-to {
        clip-path: inset(0 0 0 0);
    }

    .curtain-leave-active {
        transition: clip-path 0.5s cubic-bezier(0.85, 0, 0.15, 1);
        will-change: clip-path;
    }

    .curtain-leave-from {
        clip-path: inset(0 0 0 0);
    }

    .curtain-leave-to {
        clip-path: inset(0 0 100% 0);
    }

    /* Custom scrollbar for mobile menu if content overflows */
    #mobile-menu {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    #mobile-menu::-webkit-scrollbar {
        display: none;
    }
</style>