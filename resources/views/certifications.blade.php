<x-layout>
    <div class="py-12 px-20 animate-fade-in-up">
        <div class="flex items-center justify-between py-12">
            <div>
                <h1 class="text-3xl font-bold text-primary">All Certifications</h1>
                <p class="text-muted mt-2">A comprehensive list of my professional certifications and achievements.</p>
            </div>
            <a href="{{ route('home') }}" class="text-sm font-medium text-muted hover:text-primary flex items-center gap-1 transition-colors">
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                Back to Homet
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($certifications as $cert)
            <a href="{{ $cert['link'] }}" target="_blank" class="group block bg-surface border border-surface rounded-lg p-6 hover:border-accent/40 hover:bg-accent/5 transition-all duration-300 transform hover:-translate-y-1 shadow-sm">
                <div class="flex justify-between items-start gap-4">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 text-[10px] font-mono font-bold uppercase tracking-wider bg-accent/10 text-accent rounded border border-accent/20">
                                {{ $cert['year'] }}
                            </span>
                            <span class="text-xs text-muted font-medium">{{ $cert['company'] }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-primary group-hover:text-accent transition-colors leading-tight">
                            {{ $cert['title'] }}
                        </h3>
                    </div>
                    <div class="p-2 rounded-full bg-secondary text-muted group-hover:text-accent group-hover:bg-accent/10 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-20 text-center py-12 border-t border-surface">
            <h2 class="text-2xl font-bold text-primary mb-4">Continuous Learning</h2>
            <p class="text-muted mb-8 max-w-xl mx-auto">
                I am constantly expanding my skill set through professional courses and certifications to stay at the forefront of technology.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-8 py-3 bg-accent text-white font-bold rounded-lg hover:bg-accent-hover transition-all transform hover:-translate-y-1">
                    Work With Me
                </a>
                <a href="{{ route('skills.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-surface border border-surface text-primary font-bold rounded-lg hover:bg-secondary transition-all transform hover:-translate-y-1">
                    View My Skills
                </a>
            </div>
        </div>
    </div>
</x-layout>