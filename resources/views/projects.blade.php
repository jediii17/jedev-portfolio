<x-layout>
    {{-- Hero Banner --}}
    <section class="subpage-hero relative overflow-hidden">
        {{-- Background Gradient Mesh --}}
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

            {{-- Title --}}
            <div class="subpage-reveal" data-reveal-delay="100">
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Portfolio</span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-main leading-tight">
                    All <span class="text-accent">Projects</span>
                </h1>
                <p class="text-body-lg text-muted mt-4 max-w-2xl">
                    A detailed collection of my work and contributions — from enterprise systems to AI-powered prototypes.
                </p>
            </div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="relative pb-20 md:pb-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8 md:space-y-12">
                @foreach($projects as $index => $project)
                <div class="project-detail-card subpage-reveal group"
                    data-reveal-delay="{{ $index * 80 }}"
                    style="--card-accent: {{ ['#3b82f6', '#22c55e', '#a855f7', '#f97316', '#ec4899', '#14b8a6', '#f59e0b', '#6366f1'][$index % 8] }}">

                    {{-- Glow effect --}}
                    <div class="project-detail-glow"></div>

                    <div class="project-detail-inner">
                        {{-- Header Section --}}
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-10 pb-10 border-b border-white/5">
                            <div class="space-y-2">
                                <h2 class="text-3xl md:text-5xl font-bold text-main tracking-tight group-hover:text-accent transition-colors duration-300">
                                    {{ $project['title'] }}
                                </h2>
                                <div class="flex items-center gap-3">
                                    @if(isset($project['category']))
                                    <span class="text-accent text-xs font-bold uppercase tracking-widest">{{ $project['category'] }}</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-white/20"></span>
                                    @endif
                                    @if(isset($project['year']))
                                    <span class="text-muted text-xs font-medium">{{ $project['year'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Content Grid --}}
                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                            {{-- Visual Side --}}
                            <div class="lg:col-span-5">
                                <div class="group/img relative overflow-hidden rounded-2xl border border-white/10 bg-surface shadow-2xl">
                                    @php
                                    $placeholderImage = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop';
                                    $imagePath = $project['image'] ?? $placeholderImage;
                                    $projectImage = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                                    ? $imagePath
                                    : asset('images/projects/' . $imagePath);
                                    @endphp
                                    <img src="{{ $projectImage }}"
                                        alt="{{ $project['title'] }}"
                                        class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-linear-to-t from-black/20 to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity duration-500"></div>
                                </div>

                                {{-- Tech Stack Tags --}}
                                <div class="mt-8">
                                    <h3 class="text-xs font-bold text-main uppercase tracking-widest mb-4 opacity-50">Built With</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project['tech'] as $tech)
                                        <span class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/5 text-[10px] font-bold text-muted uppercase tracking-wider group-hover:border-accent/20 group-hover:text-accent transition-all duration-300">
                                            {{ $tech }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Side --}}
                            <div class="lg:col-span-7 flex flex-col">
                                <div class="space-y-10">
                                    {{-- Description --}}
                                    <div class="prose prose-invert max-w-none">
                                        <p class="text-lg md:text-xl text-muted leading-relaxed font-light">
                                            {{ $project['description'] }}
                                        </p>
                                    </div>

                                    {{-- Contributions --}}
                                    @if(isset($project['contribution']))
                                    <div class="space-y-6 pt-6 border-t border-white/5">
                                        <h3 class="text-xs font-bold text-main uppercase tracking-widest flex items-center gap-3">
                                            <span class="w-8 h-px bg-accent"></span>
                                            Core Impact & Responsibility
                                        </h3>
                                        <ul class="grid grid-cols-1 gap-4">
                                            @foreach($project['contribution'] as $contribution)
                                            <li class="flex items-start gap-4 text-sm text-muted/80 group/item">
                                                <span class="mt-1.5 shrink-0 w-1.5 h-1.5 rounded-full bg-accent shadow-[0_0_8px_rgba(var(--accent-rgb),0.5)] group-hover/item:scale-150 transition-transform duration-300"></span>
                                                <span class="leading-relaxed">{{ $contribution }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- CTA Section --}}
            <div class="subpage-reveal mt-20 md:mt-28 text-center" data-reveal-delay="200">
                <div class="subpage-cta-card">
                    <div class="project-detail-glow"></div>
                    <div class="project-detail-inner text-center py-10 md:py-14">
                        <h2 class="text-2xl md:text-4xl font-bold text-main mb-4">
                            Interested in working <span class="text-accent">together</span>?
                        </h2>
                        <p class="text-muted text-sm md:text-base mb-8 max-w-lg mx-auto">
                            I'm always open to discussing new projects, creative ideas, and opportunities to be part of your vision.
                        </p>
                        <a href="{{ route('home') }}#contact"
                            class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-accent text-white font-bold hover:bg-accent-hover transition-all duration-300 shadow-lg shadow-accent/25 hover:shadow-xl hover:shadow-accent/30 hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Say Hello
                        </a>
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

            // Scroll parallax for project cards
            const cards = document.querySelectorAll('.project-detail-card');
            let ticking = false;

            function updateParallax() {
                const scrollY = window.scrollY;

                cards.forEach((card, i) => {
                    const rect = card.getBoundingClientRect();
                    const center = rect.top + rect.height / 2;
                    const viewCenter = window.innerHeight / 2;
                    const distance = (center - viewCenter) / window.innerHeight;

                    // Subtle vertical parallax shift
                    const yShift = distance * 15;
                    card.style.setProperty('--parallax-y', `${yShift}px`);
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
</x-layout>

<style>
    /* Shared subpage hero + reveal */
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
        background: rgba(59, 130, 246, 0.3);
        top: -15%;
        left: -5%;
    }

    .subpage-hero-blob-2 {
        width: 35vw;
        height: 35vw;
        max-width: 450px;
        max-height: 450px;
        background: rgba(139, 92, 246, 0.25);
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
       Project Detail Card
       ============================================ */
    .project-detail-card {
        position: relative;
        border-radius: 1.25rem;
        overflow: hidden;
        background: rgba(var(--bg-secondary-rgb, 30, 30, 46), 0.5);
        border: 1px solid rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(var(--parallax-y, 0px));
    }

    :root:not(.dark) .project-detail-card {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(0, 0, 0, 0.06);
    }

    .project-detail-card:hover {
        transform: translateY(calc(var(--parallax-y, 0px) - 6px));
        border-color: rgba(var(--accent-rgb, 59, 130, 246), 0.2);
        box-shadow:
            0 20px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(var(--accent-rgb, 59, 130, 246), 0.08);
    }

    .project-detail-glow {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 20% 10%, var(--card-accent, rgba(59, 130, 246, 0.12)) 0%, transparent 55%);
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
    }

    .project-detail-card:hover .project-detail-glow,
    .subpage-cta-card:hover .project-detail-glow {
        opacity: 0.1;
    }

    .project-detail-inner {
        position: relative;
        z-index: 10;
        padding: 1.5rem;
    }

    @media (min-width: 768px) {
        .project-detail-inner {
            padding: 2rem;
        }
    }

    @media (min-width: 1024px) {
        .project-detail-inner {
            padding: 2.5rem;
        }
    }

    .project-year-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 700;
        font-family: 'JetBrains Mono', 'Fira Code', monospace;
        color: var(--accent);
        background: rgba(var(--accent-rgb, 59, 130, 246), 0.08);
        border: 1px solid rgba(var(--accent-rgb, 59, 130, 246), 0.15);
        border-radius: 9999px;
        white-space: nowrap;
    }

    .project-tech-tag {
        display: inline-block;
        padding: 0.3rem 0.7rem;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--text-secondary);
        background: rgba(var(--accent-rgb, 59, 130, 246), 0.06);
        border: 1px solid rgba(var(--accent-rgb, 59, 130, 246), 0.1);
        border-radius: 9999px;
        transition: all 0.3s ease;
    }

    .project-detail-card:hover .project-tech-tag {
        background: rgba(var(--accent-rgb, 59, 130, 246), 0.12);
        border-color: rgba(var(--accent-rgb, 59, 130, 246), 0.2);
        color: var(--accent);
    }

    .project-link-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--text-secondary);
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }

    .project-link-btn:hover {
        color: var(--accent);
        background: rgba(var(--accent-rgb, 59, 130, 246), 0.06);
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

    /* Responsive & Reduced Motion */
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

        .project-detail-card {
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            transform: none !important;
        }
    }
</style>