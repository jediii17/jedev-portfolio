<nav class="sticky top-0 z-50 w-full backdrop-blur-md bg-page/80 border-b border-surface" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-[900px] mx-auto px-6 h-16 flex items-center justify-between">

        <!-- Logo / Name -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl tracking-tight hover:text-accent transition-all group">
            <div class="w-8 h-8 text-primary group-hover:text-accent transition-colors">
                <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30 25V65C30 73.2843 36.7157 80 45 80" stroke="currentColor" stroke-linecap="round" stroke-width="12"></path>
                    <path d="M50 20V80H80" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                    <path d="M85 45C85 33.9543 76.0457 25 65 25" stroke="currentColor" stroke-linecap="round" stroke-width="12"></path>
                </svg>
            </div>
            <span class="mt-0.5">JLC</span>
        </a>

        <!-- Desktop Navigation & Actions -->
        <div class="hidden md:flex items-center gap-8">
            <div class="flex items-center gap-6 text-sm font-medium text-muted">
                <a href="#about" class="hover:text-accent transition-colors">About</a>
                <a href="#projects" class="hover:text-accent transition-colors">Projects</a>
                <a href="{{ route('certifications.index') }}" class="hover:text-accent transition-colors">Certifications</a>
                <a href="#skills" class="hover:text-accent transition-colors">Skills</a>
                <a href="#experience" class="hover:text-accent transition-colors">Experience</a>
                <a href="#contact" class="hover:text-accent transition-colors">Contact</a>
            </div>

            <div class="pl-6 border-l border-surface">
                <x-theme-toggle />
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="flex items-center gap-4 md:hidden">
            <x-theme-toggle />

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 -mr-2 text-muted hover:text-accent focus:outline-none">
                <span class="sr-only">Open menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.away="mobileMenuOpen = false"
        class="md:hidden absolute top-16 left-0 w-full bg-page border-b border-muted shadow-lg">
        <div class="flex flex-col p-4 space-y-4 text-center">
            <a href="#about" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">About</a>
            <a href="#projects" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">Projects</a>
            <a href="{{ route('certifications.index') }}" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">Certifications</a>
            <a href="#skills" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">Skills</a>
            <a href="#experience" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">Experience</a>
            <a href="#contact" @click="mobileMenuOpen = false" class="text-muted hover:text-accent font-medium p-2">Contact</a>
        </div>
    </div>
</nav>