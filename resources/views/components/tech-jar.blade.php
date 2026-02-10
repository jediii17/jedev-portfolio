@props(['skills'])

{{-- Tech Stack Jar Section --}}
<section id="tech-stack" class="parallax-section tech-jar-section">
    <div class="parallax-section-content">
        <div class="section-content">
            {{-- Section Header --}}
            <div class="mb-6 text-center">
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">What I Work With</span>
                <h2 class="text-display text-main text-reveal">
                    Tech <span class="text-accent">Stack</span>
                </h2>
                <p class="text-body-lg text-muted max-w-lg mx-auto mt-4">
                    Scroll down and watch the blocks fall — grab and throw them around!
                </p>
            </div>

            {{-- Category Legend --}}
            <div class="flex flex-wrap justify-center gap-3 mb-6">
                @php
                $categoryColors = [
                'Frontend' => '#3b82f6',
                'Backend' => '#22c55e',
                'Frameworks' => '#a855f7',
                'DevOps & Cloud' => '#f97316',
                'Other' => '#ec4899',
                ];
                @endphp
                @foreach($categoryColors as $cat => $color)
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface/60 backdrop-blur-sm border border-white/5">
                    <span class="w-3 h-3 rounded-sm" @style(['background-color'=> $color])></span>
                    <span class="text-xs font-medium text-muted">{{ $cat }}</span>
                </div>
                @endforeach
            </div>

            {{-- Jar Container --}}
            <div id="tech-jar-container" class="tech-jar-wrapper">
                <canvas id="tech-jar-canvas"></canvas>

                {{-- Glass jar decorative elements --}}
                <div class="jar-glass-left"></div>
                <div class="jar-glass-right"></div>
                <div class="jar-glass-bottom"></div>
            </div>

            {{-- Hidden data for JS --}}
            <script id="tech-jar-data" type="application/json">
                @json($skills)
            </script>

            {{-- View All Link --}}
            <div class="text-center mt-8">
                <a href="{{ route('skills.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-accent/30 text-accent font-medium hover:bg-accent/10 transition-all duration-300 group">
                    View All Skills
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>