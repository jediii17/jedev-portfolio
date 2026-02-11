<x-layout>
    {{-- Hero Banner --}}
    <section class="subpage-hero relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="subpage-hero-blob subpage-hero-blob-1"></div>
            <div class="subpage-hero-blob subpage-hero-blob-2"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 md:pt-40 md:pb-24">
            {{-- Breadcrumb --}}
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-accent transition-colors mb-8 group subpage-reveal"
                data-reveal-delay="0">
                <svg class="w-4 h-4 rotate-180 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                Back to Home
            </a>

            <div class="subpage-reveal" data-reveal-delay="100">
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Credentials</span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-main leading-tight">
                    All <span class="text-accent">Certifications</span>
                </h1>
                <p class="text-body-lg text-muted mt-4 max-w-2xl">
                    A comprehensive list of my professional certifications and achievements — continuously expanding through courses and hands-on learning.
                </p>
            </div>
        </div>
    </section>

    {{-- Certifications Grid --}}
    <section class="relative pb-20 md:pb-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Stats Bar --}}
            <div class="subpage-reveal grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 md:mb-16" data-reveal-delay="150">
                @php
                $years = collect($certifications)->pluck('year')->unique()->sort()->reverse();
                $companies = collect($certifications)->pluck('company')->unique();
                @endphp
                <div class="cert-stat-card">
                    <span class="text-2xl md:text-3xl font-bold text-accent">{{ count($certifications) }}</span>
                    <span class="text-xs text-muted uppercase tracking-widest">Total Certs</span>
                </div>
                <div class="cert-stat-card">
                    <span class="text-2xl md:text-3xl font-bold text-accent">{{ $companies->count() }}</span>
                    <span class="text-xs text-muted uppercase tracking-widest">Issuers</span>
                </div>
                <div class="cert-stat-card">
                    <span class="text-2xl md:text-3xl font-bold text-accent">{{ $years->first() }}</span>
                    <span class="text-xs text-muted uppercase tracking-widest">Latest</span>
                </div>
                <div class="cert-stat-card">
                    <span class="text-2xl md:text-3xl font-bold text-accent">{{ $years->last() }}</span>
                    <span class="text-xs text-muted uppercase tracking-widest">Since</span>
                </div>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @foreach($certifications as $index => $cert)
                <a href="{{ $cert['link'] }}" target="_blank" rel="noopener noreferrer"
                    class="cert-card subpage-reveal group"
                    data-reveal-delay="{{ $index * 60 }}"
                    style="--card-accent: {{ ['#3b82f6', '#22c55e', '#a855f7', '#f97316', '#14b8a6', '#6366f1', '#ec4899', '#f59e0b', '#06b6d4', '#8b5cf6'][$index % 10] }}">

                    <div class="cert-card-glow"></div>

                    <div class="cert-card-inner">
                        <div class="flex justify-between items-start gap-4">
                            <div class="space-y-3 min-w-0 flex-1">
                                {{-- Meta --}}
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="cert-year-badge">{{ $cert['year'] }}</span>
                                    <span class="text-xs text-muted font-medium truncate">{{ $cert['company'] }}</span>
                                </div>

                                {{-- Title --}}
                                <h3 class="text-base md:text-lg font-bold text-main group-hover:text-accent transition-colors duration-300 leading-snug">
                                    {{ $cert['title'] }}
                                </h3>

                                {{-- View link --}}
                                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-muted group-hover:text-accent transition-colors">
                                    View Certificate
                                    <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>

                            {{-- External link icon --}}
                            <div class="p-2.5 rounded-xl bg-surface/50 text-muted group-hover:text-accent group-hover:bg-accent/10 transition-all duration-300 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="subpage-reveal mt-20 md:mt-28 text-center" data-reveal-delay="200">
                <div class="subpage-cta-card">
                    <div class="cert-card-glow"></div>
                    <div class="cert-card-inner text-center py-10 md:py-14">
                        <h2 class="text-2xl md:text-4xl font-bold text-main mb-4">
                            Continuous <span class="text-accent">Learning</span>
                        </h2>
                        <p class="text-muted text-sm md:text-base mb-8 max-w-lg mx-auto">
                            I'm constantly expanding my skill set through professional courses and certifications to stay at the forefront of technology.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('home') }}#contact"
                                class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-accent text-white font-bold hover:bg-accent-hover transition-all duration-300 shadow-lg shadow-accent/25 hover:shadow-xl hover:shadow-accent/30 hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Work With Me
                            </a>
                            <a href="{{ route('skills.index') }}"
                                class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-surface/50 border border-white/10 text-main font-bold hover:border-accent/30 transition-all duration-300 hover:scale-105 active:scale-95">
                                View My Skills
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.querySelectorAll('.subpage-reveal').forEach(el => {
                    el.style.opacity = '1';
                    el.style.transform = 'none';
                });
                return;
            }

            // Reveal on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = parseInt(entry.target.dataset.revealDelay || 0);
                        setTimeout(() => entry.target.classList.add('subpage-revealed'), delay);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -40px 0px'
            });

            document.querySelectorAll('.subpage-reveal').forEach(el => observer.observe(el));

            // Hero blob parallax
            const hero = document.querySelector('.subpage-hero');
            const blobs = document.querySelectorAll('.subpage-hero-blob');
            if (hero && blobs.length) {
                hero.addEventListener('mousemove', (e) => {
                    const rect = hero.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;
                    blobs.forEach((blob, i) => {
                        const factor = (i + 1) * 25;
                        blob.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
                    });
                });
            }

            // Scroll parallax for cards
            const cards = document.querySelectorAll('.cert-card');
            let ticking = false;

            function updateParallax() {
                cards.forEach(card => {
                    const rect = card.getBoundingClientRect();
                    const center = rect.top + rect.height / 2;
                    const viewCenter = window.innerHeight / 2;
                    const distance = (center - viewCenter) / window.innerHeight;
                    card.style.setProperty('--parallax-y', `${distance * 12}px`);
                });
                ticking = false;
            }
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }, {
                passive: true
            });
        });
    </script>
    @endpush

    <style>
        /* Shared subpage hero + reveal — same system as projects page */
        .subpage-hero {
            min-height: 50vh;
            display: flex;
            align-items: flex-end;
            background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
        }

        .subpage-hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            will-change: transform;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .subpage-hero-blob-1 {
            width: 40vw;
            height: 40vw;
            max-width: 500px;
            max-height: 500px;
            background: rgba(139, 92, 246, 0.3);
            top: -15%;
            left: -5%;
        }

        .subpage-hero-blob-2 {
            width: 35vw;
            height: 35vw;
            max-width: 450px;
            max-height: 450px;
            background: rgba(59, 130, 246, 0.25);
            bottom: -10%;
            right: -5%;
        }

        .subpage-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .subpage-revealed {
            opacity: 1;
            transform: translateY(0) !important;
        }

        /* ============================================
       Stats Cards
       ============================================ */
        .cert-stat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            padding: 1.25rem 1rem;
            border-radius: 1rem;
            background: rgba(var(--bg-secondary-rgb, 30, 30, 46), 0.5);
            border: 1px solid rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        :root:not(.dark) .cert-stat-card {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(0, 0, 0, 0.06);
        }

        /* ============================================
       Cert Card
       ============================================ */
        .cert-card {
            position: relative;
            border-radius: 1.25rem;
            overflow: hidden;
            background: rgba(var(--bg-secondary-rgb, 30, 30, 46), 0.5);
            border: 1px solid rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: translateY(var(--parallax-y, 0px));
            text-decoration: none;
        }

        :root:not(.dark) .cert-card {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .cert-card:hover {
            transform: translateY(calc(var(--parallax-y, 0px) - 6px));
            border-color: rgba(var(--accent-rgb, 59, 130, 246), 0.2);
            box-shadow:
                0 20px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(var(--accent-rgb, 59, 130, 246), 0.08);
        }

        .cert-card-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 20% 10%,
                    var(--card-accent, rgba(59, 130, 246, 0.12)) 0%,
                    transparent 55%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }

        .cert-card:hover .cert-card-glow,
        .subpage-cta-card:hover .cert-card-glow {
            opacity: 0.1;
        }

        .cert-card-inner {
            position: relative;
            z-index: 10;
            padding: 1.25rem;
        }

        @media (min-width: 768px) {
            .cert-card-inner {
                padding: 1.5rem;
            }
        }

        .cert-year-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            font-size: 0.65rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            color: var(--accent);
            background: rgba(var(--accent-rgb, 59, 130, 246), 0.08);
            border: 1px solid rgba(var(--accent-rgb, 59, 130, 246), 0.15);
            border-radius: 9999px;
            white-space: nowrap;
        }

        /* CTA card */
        .subpage-cta-card {
            position: relative;
            border-radius: 1.25rem;
            overflow: hidden;
            background: rgba(var(--bg-secondary-rgb, 30, 30, 46), 0.5);
            border: 1px solid rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        :root:not(.dark) .subpage-cta-card {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .subpage-cta-card:hover {
            border-color: rgba(var(--accent-rgb, 59, 130, 246), 0.15);
        }

        /* ============================================
       Responsive & Reduced Motion
       ============================================ */
        @media (max-width: 768px) {
            .subpage-hero {
                min-height: 40vh;
            }

            .subpage-hero-blob {
                opacity: 0.25;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .subpage-reveal {
                opacity: 1;
                transform: none;
                transition: none;
            }

            .subpage-hero-blob {
                transition: none;
            }

            .cert-card {
                transition: box-shadow 0.3s ease, border-color 0.3s ease;
                transform: none !important;
            }
        }
    </style>
</x-layout>