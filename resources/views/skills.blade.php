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
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Expertise</span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-main leading-tight">
                    Technical <span class="text-accent">Skills</span>
                </h1>
                <p class="text-body-lg text-muted mt-4 max-w-2xl">
                    A comprehensive breakdown of the technologies, frameworks, and tools I work with across the full stack.
                </p>
            </div>
        </div>
    </section>

    {{-- Skills Grid --}}
    <section class="relative pb-20 md:pb-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
            $categoryMeta = [
            'Frontend' => [
            'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />',
            'color' => '#3b82f6',
            'description' => 'Building responsive and interactive user interfaces',
            ],
            'Backend' => [
            'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />',
            'color' => '#22c55e',
            'description' => 'Server-side logic, databases, and API development',
            ],
            'AI & Machine Learning' => [
            'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />',
            'color' => '#a855f7',
            'description' => 'Computer vision, NLP, and model training',
            ],
            'DevOps & Tools' => [
            'icon' => '
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />',
            'color' => '#f97316',
            'description' => 'Cloud, CI/CD, version control, and development tooling',
            ],
            ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                @foreach($skills as $category => $items)
                @php
                $meta = $categoryMeta[$category] ?? ['icon' => '
                <circle cx="12" cy="12" r="3" />', 'color' => '#6b7280', 'description' => ''];
                $catIndex = array_search($category, array_keys($skills));
                @endphp
                <div class="skill-category-card subpage-reveal group"
                    data-reveal-delay="{{ $catIndex * 100 }}"
                    style="--card-accent: {{ $meta['color'] }}">

                    <div class="skill-card-glow"></div>

                    <div class="skill-card-inner">
                        {{-- Category Header --}}
                        <div class="flex items-start gap-3 mb-5">
                            <div class="skill-category-icon" style="--icon-color: {{ $meta['color'] }}">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $meta['icon'] !!}
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg md:text-xl font-bold text-main group-hover:text-accent transition-colors duration-300">
                                    {{ $category }}
                                </h2>
                                @if($meta['description'])
                                <p class="text-xs text-muted mt-0.5">{{ $meta['description'] }}</p>
                                @endif
                            </div>
                            <span class="ml-auto text-xs font-mono text-muted bg-surface/50 px-2 py-1 rounded-full">
                                {{ count($items) }}
                            </span>
                        </div>

                        {{-- Skills --}}
                        <div class="flex flex-wrap gap-2">
                            @foreach($items as $skill)
                            <span class="skill-tag" style="--tag-color: {{ $meta['color'] }}">
                                {{ $skill }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="subpage-reveal mt-20 md:mt-28 text-center" data-reveal-delay="200">
                <div class="subpage-cta-card">
                    <div class="skill-card-glow"></div>
                    <div class="skill-card-inner text-center py-10 md:py-14">
                        <h2 class="text-2xl md:text-4xl font-bold text-main mb-4">
                            Let's build something <span class="text-accent">together</span>
                        </h2>
                        <p class="text-muted text-sm md:text-base mb-8 max-w-lg mx-auto">
                            These skills are shaped by real-world projects. I'm always looking for new challenges and collaborations.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('home') }}#contact"
                                class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-accent text-white font-bold hover:bg-accent-hover transition-all duration-300 shadow-lg shadow-accent/25 hover:shadow-xl hover:shadow-accent/30 hover:scale-105 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Get In Touch
                            </a>
                            <a href="{{ route('certifications.index') }}"
                                class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-surface/50 border border-white/10 text-main font-bold hover:border-accent/30 transition-all duration-300 hover:scale-105 active:scale-95">
                                View Certifications
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

            // Scroll parallax for skill cards
            const cards = document.querySelectorAll('.skill-category-card');
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
        /* Reuse subpage hero system */
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
            background: rgba(34, 197, 94, 0.25);
            top: -15%;
            left: -5%;
        }

        .subpage-hero-blob-2 {
            width: 35vw;
            height: 35vw;
            max-width: 450px;
            max-height: 450px;
            background: rgba(249, 115, 22, 0.2);
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
       Skill Category Card
       ============================================ */
        .skill-category-card {
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

        :root:not(.dark) .skill-category-card {
            background: rgba(255, 255, 255, 0.7);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .skill-category-card:hover {
            transform: translateY(calc(var(--parallax-y, 0px) - 4px));
            border-color: rgba(var(--accent-rgb, 59, 130, 246), 0.2);
            box-shadow:
                0 20px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(var(--accent-rgb, 59, 130, 246), 0.08);
        }

        .skill-card-glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 10% 10%,
                    var(--card-accent, rgba(59, 130, 246, 0.12)) 0%,
                    transparent 55%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }

        .skill-category-card:hover .skill-card-glow,
        .subpage-cta-card:hover .skill-card-glow {
            opacity: 0.1;
        }

        .skill-card-inner {
            position: relative;
            z-index: 10;
            padding: 1.5rem;
        }

        @media (min-width: 768px) {
            .skill-card-inner {
                padding: 2rem;
            }
        }

        /* Category icon */
        .skill-category-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            color: var(--icon-color, var(--accent));
            background: color-mix(in srgb, var(--icon-color, var(--accent)) 10%, transparent);
            border: 1px solid color-mix(in srgb, var(--icon-color, var(--accent)) 20%, transparent);
            flex-shrink: 0;
        }

        /* Skill tags */
        .skill-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.85rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            background: rgba(var(--bg-secondary-rgb, 30, 30, 46), 0.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        :root:not(.dark) .skill-tag {
            background: rgba(255, 255, 255, 0.5);
            border-color: rgba(0, 0, 0, 0.06);
        }

        .skill-category-card:hover .skill-tag {
            border-color: color-mix(in srgb, var(--tag-color, var(--accent)) 25%, transparent);
            color: var(--tag-color, var(--accent));
            background: color-mix(in srgb, var(--tag-color, var(--accent)) 8%, transparent);
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

            .skill-category-card {
                transition: box-shadow 0.3s ease, border-color 0.3s ease;
                transform: none !important;
            }
        }
    </style>
</x-layout>