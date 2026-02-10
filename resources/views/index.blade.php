<x-layout>
    {{-- Hero Section --}}
    <x-hero />

    {{-- Work Section (Projects + Skills) - Split Screen --}}
    <section id="work" class="split-slide">
        <div class="col-half col-content">
            <div>
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Featured Work</span>
                <h2 class="text-display text-main text-reveal">
                    Projects & <span class="text-accent">Skills</span>
                </h2>
                <div class="mt-8 text-body-lg text-muted max-w-md">
                    Building digital experiences with modern tools and a focus on performance and craft.
                </div>
            </div>
        </div>
        <div class="col-half bg-surface overflow-hidden">
            <div class="col-image-wrap">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070"
                    alt="Featured Project"
                    class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    {{-- Projects & Skills Content --}}
    <section class="parallax-section bg-page">
        <div class="parallax-section-content">
            <div class="section-content">

                {{-- Projects Grid --}}
                <div class="mb-20">
                    <div class="flex items-center justify-between mb-10">
                        <h3 class="text-headline text-main">Recent Projects</h3>
                        <a href="{{ route('projects.index') }}" class="text-accent hover:text-accent-hover font-medium flex items-center gap-2 transition-colors">
                            View All
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-container">
                        @php
                        $projectPhotos = [
                        'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=2031&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1558494949-ef010cbdcc48?q=80&w=2074&auto=format&fit=crop'
                        ];
                        @endphp
                        @foreach(array_slice($projects, 0, 4) as $index => $project)
                        <div class="project-card stagger-item group cursor-pointer" style="background-image: url('{{ $projectPhotos[$index] ?? $projectPhotos[0] }}'); background-size: cover; background-position: center;">
                            {{-- Project Card Content --}}
                            <div class="project-card-overlay"></div>
                            <div class="project-card-content">
                                <div class="flex items-start justify-between mb-4">
                                    <span class="text-xs font-medium text-accent uppercase tracking-wider">
                                        {{ $project['category'] ?? 'Web App' }}
                                    </span>
                                    <svg class="w-5 h-5 text-white/50 group-hover:text-accent group-hover:translate-x-1 group-hover:-translate-y-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                                    </svg>
                                </div>
                                <h4 class="text-title text-white mb-2 group-hover:text-accent transition-colors">{{ $project['title'] }}</h4>
                                <p class="text-sm text-white/60 line-clamp-2">{{ $project['description'] }}</p>

                                {{-- Tech Stack Tags --}}
                                @if(isset($project['tech']))
                                <div class="flex flex-wrap gap-2 mt-4">
                                    @foreach(array_slice($project['tech'] ?? [], 0, 3) as $tech)
                                    <span class="text-xs px-2 py-1 rounded-full bg-white/10 text-white/70">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tech Stack Jar Section --}}
    <x-tech-jar :skills="$skills" />

    {{-- Certifications Section --}}
    <x-certifications-preview :certifications="$certification" />

    {{-- Experience Section --}}
    <section id="experience" class="parallax-section" style="background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);">
        <div class="parallax-section-content">
            <div class="section-content">
                {{-- Section Header --}}
                <div class="mb-16 md:mb-24">
                    <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Career Path</span>
                    <h2 class="text-display text-main text-reveal">
                        Work <span class="text-accent">Experience</span>
                    </h2>
                </div>

                {{-- Experience Timeline --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
                    {{-- Timeline --}}
                    <div class="timeline-parallax">
                        <div class="timeline-line"></div>

                        @foreach($experience as $index => $item)
                        <div class="timeline-item active"
                            x-data="{ expanded: false }">
                            <div class="timeline-dot"></div>

                            <div class="space-y-2">
                                <span class="text-xs font-mono text-accent">{{ $item['period'] }}</span>
                                <h4 class="text-title text-main">{{ $item['role'] }}</h4>
                                <p class="text-body-lg text-muted">{{ $item['company'] }}</p>

                                @if(isset($item['description']))
                                <p class="text-sm text-muted/80 mt-4 leading-relaxed">
                                    {{ $item['description'] }}
                                </p>
                                @endif

                                @if(isset($item['technologies']))
                                <div class="flex flex-wrap gap-2 mt-4">
                                    @foreach($item['technologies'] as $tech)
                                    <span class="text-xs px-2 py-1 rounded bg-accent/10 text-accent">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Recommendations --}}
                    <div class="lg:sticky lg:top-24 h-fit">
                        <div class="parallax-card p-8">
                            <h3 class="text-lg font-bold text-main mb-8 flex items-center gap-3">
                                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                What People Say
                            </h3>

                            <div x-data="{ 
                                current: 0, 
                                items: {{ count($recommendations) }},
                                init() {
                                    setInterval(() => {
                                        this.current = (this.current + 1) % this.items;
                                    }, 5000);
                                }
                            }">
                                <div class="relative min-h-[180px]">
                                    @foreach($recommendations as $index => $rec)
                                    <div
                                        x-show="current === {{ $index }}"
                                        x-transition:enter="transition ease-out duration-500"
                                        x-transition:enter-start="opacity-0 translate-x-4"
                                        x-transition:enter-end="opacity-100 translate-x-0"
                                        x-transition:leave="transition ease-in duration-300 absolute inset-0"
                                        x-transition:leave-start="opacity-100 translate-x-0"
                                        x-transition:leave-end="opacity-0 -translate-x-4"
                                        class="w-full">
                                        <blockquote class="text-body-lg text-main/90 leading-relaxed italic mb-6">
                                            "{{ $rec['text'] }}"
                                        </blockquote>
                                        <div>
                                            <p class="font-bold text-main">{{ $rec['author'] }}</p>
                                            <p class="text-sm text-muted">{{ $rec['title'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- Pagination dots --}}
                                <div class="flex gap-2 mt-8">
                                    @foreach($recommendations as $index => $rec)
                                    <button
                                        @click="current = {{ $index }}"
                                        :class="current === {{ $index }} ? 'bg-accent' : 'bg-muted/30'"
                                        class="w-2 h-2 rounded-full transition-colors duration-300">
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="parallax-section contact-section">
        <div class="parallax-bg">
            <div class="parallax-bg-image" style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=2070&auto=format&fit=crop'); opacity: 0.1;"></div>
        </div>

        <div class="parallax-section-content">
            <div class="section-content text-center max-w-3xl mx-auto">
                {{-- Section Header --}}
                <div class="mb-12">
                    <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-6 block">Get In Touch</span>
                    <h2 class="text-display text-main mb-6 text-reveal">
                        Let's Build <span class="text-accent">Amazing</span>
                    </h2>
                    <p class="text-body-lg text-muted max-w-2xl mx-auto">
                        I'm currently available for full-time opportunities.
                        Whether you have a project in mind or just want to chat, I'd love to hear from you.
                    </p>
                </div>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <a href="mailto:jedidialemuel17@gmail.com" class="magnetic-btn">
                        <span class="relative z-10 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Me an Email
                        </span>
                    </a>

                    <span class="text-muted">or</span>

                    <a href="https://linkedin.com/in/jedidialemuelcruz" target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-surface text-main font-medium hover:border-accent hover:text-accent transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                        Connect on LinkedIn
                    </a>
                </div>

                {{-- Email Display --}}
                <div class="text-center">
                    <p class="text-sm text-muted mb-2">Email me directly at</p>
                    <a href="mailto:jedidialemuel17@gmail.com" class="text-2xl md:text-3xl font-bold text-accent hover:text-accent-hover transition-colors">
                        jedidialemuel17@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layout>