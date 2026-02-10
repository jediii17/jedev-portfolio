<section class="parallax-hero pt-24 md:pt-28" id="about">
    {{-- Multi-layer Parallax Background --}}
    <div class="parallax-bg">
        {{-- Layer 1: Far background (slowest) --}}
        <div class="parallax-bg-image"
            data-parallax-layer="1"
            style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop'); filter: brightness(0.3) blur(2px);">
        </div>

        {{-- Layer 2: Mid layer --}}
        <div class="parallax-bg-image"
            data-parallax-layer="2"
            style="background-image: url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop'); opacity: 0.4; mix-blend-mode: overlay;">
        </div>
    </div>

    {{-- Animated Gradient Mesh --}}
    <div class="gradient-mesh" aria-hidden="true">
        <div class="gradient-blob gradient-blob-1"></div>
        <div class="gradient-blob gradient-blob-2"></div>
        <div class="gradient-blob gradient-blob-3"></div>
    </div>

    {{-- Gradient Overlay --}}
    <div class="parallax-overlay overlay-gradient-dark"></div>

    {{-- Floating hero particles --}}
    <div class="hero-particles" aria-hidden="true">
        <span class="hero-particle hero-particle-1" data-parallax="-0.12">{ }</span>
        <span class="hero-particle hero-particle-2" data-parallax="0.08">
            <>
        </span>
        <span class="hero-particle hero-particle-3" data-parallax="-0.18">//</span>
        <span class="hero-particle hero-particle-4" data-parallax="0.14">01</span>
        <span class="hero-particle hero-particle-5" data-parallax="-0.06">( )</span>
        <span class="hero-particle hero-particle-6" data-parallax="0.1">::</span>
        <span class="hero-particle hero-particle-7" data-parallax="-0.15">&&</span>
        <span class="hero-particle hero-particle-8" data-parallax="0.05">=></span>
    </div>

    {{-- Hero Content --}}
    <div class="hero-content pl-2 pr-4 md:pl-2 md:pr-2 lg:pl-2 lg:pr-2">
        <div class="flex flex-col gap-6 md:gap-10 w-full">

            {{-- Profile + Title --}}
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-10 w-full">
                {{-- Profile Image --}}
                <div class="hero-profile"
                    x-data="{ hovered: false }"
                    @mouseenter="hovered = true"
                    @mouseleave="hovered = false"
                    @click="hovered = !hovered"
                    data-cursor-hover>
                    <img
                        :src="hovered 
                            ? '{{ Vite::asset('resources/js/assets/images/jed.png') }}'
                            : '{{ Vite::asset('resources/js/assets/images/profile.png') }}'"
                        alt="Jedidia Lemuel B. Cruz"
                        class="w-full h-full object-cover transition-all duration-500"
                        :class="hovered ? 'scale-105' : 'scale-100'">
                </div>

                {{-- Name & Title with Typed Effect --}}
                <div class="flex flex-col gap-4 flex-1 min-w-0 w-full">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 backdrop-blur-sm border border-white/10 w-fit hero-subtitle">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse" aria-hidden="true"></span>
                        <span class="text-xs font-semibold text-white/90 uppercase tracking-wider">Available for hire</span>
                    </div>

                    {{-- Static greeting --}}
                    <h1 class="text-5xl font-bold text-white hero-title-line">
                        Hi, I'm
                    </h1>

                    {{-- Dynamic role text below - reserves space for longest phrase --}}
                    <div class="text-display text-accent" style="min-height: 1.2em; position: relative;">
                        {{-- Hidden text to reserve width for longest phrase --}}
                        <span class="invisible" aria-hidden="true">Full-Stack Developer</span>
                        {{-- Typed text overlaid on top --}}
                        <span
                            data-typed
                            data-typed-phrases="Jedidia Lemuel|Software Engineer|AI Explorer|Full-Stack Developer"
                            data-type-speed="100"
                            data-delete-speed="60"
                            data-pause-duration="2500"
                            aria-label="Software Engineer, AI Explorer, Full-Stack Developer"
                            class="inline-block"
                            style="position: absolute; left: 0; top: 0;">
                        </span>
                    </div>

                    <p class="text-title text-white/70 hero-subtitle">
                        Building the future, one line at a time.
                    </p>
                </div>
            </div>

            {{-- Description --}}
            <div class="max-w-2xl hero-subtitle">
                <p class="text-body-lg text-white/60 leading-relaxed">
                    Developing web applications, passionate about clean architecture, AI integration, and building products that make a difference.
                </p>
            </div>

            {{-- CTAs --}}
            <div class="flex flex-wrap items-center gap-4 hero-cta">
                <a href="#contact" class="magnetic-btn" data-cursor-hover>
                    <span class="relative z-10 flex items-center gap-2">
                        Let's Work Together
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m6 17 5-5-5-5" />
                            <path d="m13 17 5-5-5-5" />
                        </svg>
                    </span>
                </a>

                <a href="{{ asset('assets/resume.pdf') }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-white/20 text-white font-medium hover:bg-white/10 hover:border-white/40 transition-all duration-300"
                    data-cursor-hover>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 15V3" />
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <path d="m7 10 5 5 5-5" />
                    </svg>
                    Resume
                </a>
            </div>

            {{-- Core Technologies - Animated Cards --}}
            <div class="pt-6 hero-cta">
                <p class="text-xs uppercase tracking-widest text-white/40 mb-6 font-semibold">Core Stack</p>
                <div class="flex flex-wrap gap-4 stagger-container" x-data="{}">
                    @php
                    $techs = [
                    ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'fab-laravel'],
                    ['name' => 'Vue.js', 'color' => '#42b883', 'icon' => 'tni-vue'],
                    ['name' => 'Tailwind', 'color' => '#38bdf8', 'icon' => 'fileicon-tailwind'],
                    ['name' => 'PHP', 'color' => '#777bb4', 'icon' => 'fab-php'],
                    ['name' => 'JavaScript', 'color' => '#f0db4f', 'icon' => 'fab-js'],
                    ['name' => 'MySQL', 'color' => '#4479a1', 'icon' => 'si-mysql'],
                    ];
                    @endphp
                    @foreach($techs as $index => $tech)
                    <div class="tech-card stagger-item"
                        :style="'--accent-color: {{ $tech['color'] }}; animation-delay: {{ $index * 0.1 }}s;'"
                        data-cursor-hover>
                        <div class="tech-card-glow" :style="'background: {{ $tech['color'] }};'"></div>
                        <div class="tech-card-content">
                            <x-dynamic-component :component="$tech['icon']" class="w-5 h-5" :style="'color: ' . $tech['color'] . ';'" />
                            <span class="text-white/90 text-sm font-medium">{{ $tech['name'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Social Links --}}
            <div class="flex items-center gap-6 pt-4 hero-cta">
                <a href="https://github.com/jediii17" target="_blank" rel="noopener noreferrer"
                    class="text-white/40 hover:text-white transition-colors p-2"
                    aria-label="GitHub Profile"
                    data-cursor-hover>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.943 0-1.091.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.597 1.028 2.688 0 3.848-2.339 4.685-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://linkedin.com/in/jedidialemuelcruz" target="_blank" rel="noopener noreferrer"
                    class="text-white/40 hover:text-white transition-colors p-2"
                    aria-label="LinkedIn Profile"
                    data-cursor-hover>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="mailto:jedidialemuel17@gmail.com"
                    class="text-white/40 hover:text-white transition-colors p-2"
                    aria-label="Send Email"
                    data-cursor-hover>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <a href="#work" class="scroll-indicator" aria-label="Scroll to Work section">
        <span class="text-xs uppercase tracking-widest font-medium">Scroll</span>
        <div class="scroll-indicator-mouse">
            <div class="scroll-indicator-wheel"></div>
        </div>
    </a>
</section>

<style>
    /* Hero floating particles */
    .hero-particles {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 3;
    }

    .hero-particle {
        position: absolute;
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        font-weight: 700;
        color: rgba(59, 130, 246, 0.12);
        font-size: clamp(1rem, 3vw, 2.5rem);
        will-change: transform;
    }

    .hero-particle-1 {
        top: 12%;
        left: 8%;
        animation: hero-drift-a 9s ease-in-out infinite;
    }

    .hero-particle-2 {
        top: 22%;
        right: 12%;
        animation: hero-drift-b 11s ease-in-out infinite 1s;
    }

    .hero-particle-3 {
        bottom: 35%;
        left: 5%;
        animation: hero-drift-a 13s ease-in-out infinite 2s;
    }

    .hero-particle-4 {
        top: 55%;
        right: 6%;
        animation: hero-drift-b 10s ease-in-out infinite 0.5s;
    }

    .hero-particle-5 {
        bottom: 18%;
        left: 55%;
        animation: hero-drift-a 8s ease-in-out infinite 3s;
    }

    .hero-particle-6 {
        top: 35%;
        left: 40%;
        animation: hero-drift-b 12s ease-in-out infinite 1.5s;
    }

    .hero-particle-7 {
        bottom: 25%;
        right: 20%;
        animation: hero-drift-a 10s ease-in-out infinite 2.5s;
    }

    .hero-particle-8 {
        top: 8%;
        left: 65%;
        animation: hero-drift-b 14s ease-in-out infinite 4s;
    }

    @keyframes hero-drift-a {

        0%,
        100% {
            transform: translateY(0) rotate(0deg) scale(1);
        }

        33% {
            transform: translateY(-15px) rotate(5deg) scale(1.05);
        }

        66% {
            transform: translateY(10px) rotate(-3deg) scale(0.95);
        }
    }

    @keyframes hero-drift-b {

        0%,
        100% {
            transform: translateY(0) rotate(0deg) scale(1);
        }

        50% {
            transform: translateY(18px) rotate(-8deg) scale(1.08);
        }
    }

    @media (max-width: 768px) {
        .hero-particle {
            display: none;
        }
    }

    /* Gradient Mesh */
    .gradient-mesh {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 2;
    }

    .gradient-blob {
        position: absolute;
        width: 50vw;
        height: 50vw;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.6;
        will-change: transform;
    }

    .gradient-blob-1 {
        background: rgba(59, 130, 246, 0.4);
        top: -20%;
        left: -10%;
    }

    .gradient-blob-2 {
        background: rgba(139, 92, 246, 0.4);
        top: 30%;
        right: -20%;
    }

    .gradient-blob-3 {
        background: rgba(236, 72, 153, 0.3);
        bottom: -10%;
        left: 30%;
    }

    /* Tech Cards */
    .tech-card {
        position: relative;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        perspective: 1000px;
    }

    .tech-card:hover {
        border-color: var(--accent-color, rgba(255, 255, 255, 0.2));
        transform: translateY(-4px);
    }

    .tech-card-glow {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
        filter: blur(20px);
    }

    .tech-card:hover .tech-card-glow {
        opacity: 0.15;
    }

    .tech-card-content {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.25rem;
        z-index: 1;
    }

    /* Scroll Indicator */
    .scroll-indicator-mouse {
        width: 24px;
        height: 40px;
        border: 2px solid currentColor;
        border-radius: 12px;
        position: relative;
        display: flex;
        justify-content: center;
        padding-top: 6px;
    }

    .scroll-indicator-wheel {
        width: 4px;
        height: 8px;
        background: currentColor;
        border-radius: 2px;
        animation: scrollBounce 1.5s ease-in-out infinite;
    }

    @keyframes scrollBounce {

        0%,
        100% {
            transform: translateY(0);
            opacity: 1;
        }

        50% {
            transform: translateY(8px);
            opacity: 0.5;
        }
    }

    /* Typed cursor */
    .typed-cursor {
        display: inline-block;
        margin-left: 2px;
        animation: blink 1s infinite;
        color: var(--accent);
        font-weight: 300;
    }

    @keyframes blink {

        0%,
        50% {
            opacity: 1;
        }

        51%,
        100% {
            opacity: 0;
        }
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .gradient-blob {
            animation: none !important;
        }

        .scroll-indicator-wheel {
            animation: none;
        }

        .typed-cursor {
            animation: none;
            opacity: 1;
        }
    }
</style>