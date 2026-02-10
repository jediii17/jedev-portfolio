@props(['certifications'])

{{-- Certifications Preview Section --}}
<section id="certifications" class="parallax-section certs-section">
    <div class="parallax-section-content">
        <div class="section-content">
            {{-- Section Header --}}
            <div class="mb-12 md:mb-16 text-center">
                <span class="text-accent text-sm font-semibold uppercase tracking-widest mb-4 block">Credentials</span>
                <h2 class="text-display text-main text-reveal">
                    Certifications & <span class="text-accent">Badges</span>
                </h2>
            </div>

            {{-- Certification Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 stagger-container">
                @foreach(array_slice($certifications, 0, 4) as $index => $cert)
                <a href="{{ $cert['link'] }}" target="_blank" rel="noopener noreferrer"
                    class="cert-card stagger-item group"
                    style="--cert-delay: {{ $index * 0.1 }}s">

                    {{-- Animated gradient border --}}
                    <div class="cert-card-glow"></div>

                    {{-- Card Content --}}
                    <div class="cert-card-inner">
                        {{-- Top: Badge + Arrow --}}
                        <div class="flex items-start justify-between mb-5">
                            <div class="cert-badge-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <svg class="w-4 h-4 text-muted/40 group-hover:text-accent group-hover:translate-x-1 group-hover:-translate-y-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </div>

                        {{-- Title --}}
                        <h4 class="text-sm font-bold text-main group-hover:text-accent transition-colors duration-300 line-clamp-2 mb-3 leading-snug">
                            {{ $cert['title'] }}
                        </h4>

                        {{-- Company + Year --}}
                        <div class="flex items-center justify-between mt-auto">
                            <p class="text-xs text-muted/80 font-medium">{{ $cert['company'] }}</p>
                            @if(isset($cert['year']))
                            <span class="text-xs text-accent/60 font-mono">{{ $cert['year'] }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- View All CTA --}}
            <div class="text-center mt-25">
                <a href="{{ route('certifications.index') }}"
                    class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-accent/10 border border-accent/20 text-accent font-semibold hover:bg-accent hover:text-white transition-all duration-500 group">
                    <span>View All Certifications</span>
                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-accent/20 text-xs font-bold group-hover:bg-white/20 transition-colors">
                        {{ count($certifications) > 4 ? count($certifications) : '→' }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>