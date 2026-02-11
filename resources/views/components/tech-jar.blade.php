@props(['skills'])

{{-- Tech Stack Jar Section --}}
<section id="tech-stack" class="parallax-section border border-white/25 shadow-lg tech-jar-section mx-4 md:mx-10 rounded-3xl overflow-hidden bg-surface/50 dark:bg-surface/20">
    <div class="parallax-section-content">
        <div class="section-content">
            {{-- Section Header --}}
            <div class="mb-6 text-center">
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">What I Work With</span>
                <h2 class="text-display text-main text-reveal">
                    Tech <span class="text-accent">Stack</span>
                </h2>
            </div>

            {{-- Category Legend (Clickable) --}}
            <div id="tech-jar-legend" class="flex flex-wrap justify-center gap-3 mb-10">
                @php
                $categoryColors = [
                'Frontend' => '#3b82f6',
                'Backend' => '#22c55e',
                'AI & Machine Learning' => '#a855f7',
                'DevOps & Tools' => '#f97316',
                ];
                @endphp
                @foreach($categoryColors as $cat => $color)
                <button
                    type="button"
                    data-category="{{ $cat }}"
                    data-color="{{ $color }}"
                    class="tech-legend-btn flex items-center gap-2 px-4 py-2 rounded-full bg-surface/40 backdrop-blur-sm border border-white/10 cursor-pointer select-none transition-all duration-300">
                    <span class="tech-legend-dot inline-block w-2.5 h-2.5 rounded-full transition-all duration-300" style="background-color: {{ $color }}; box-shadow: 0 0 8px {{ $color }}40;"></span>
                    <span class="text-[10px] font-bold text-muted uppercase tracking-widest transition-colors duration-300">{{ $cat }}</span>
                </button>
                @endforeach
            </div>

            {{-- Jar Container --}}
            <div id="tech-jar-container" class="tech-jar-wrapper">
                <canvas id="tech-jar-canvas"></canvas>
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