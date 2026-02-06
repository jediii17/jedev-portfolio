<x-layout>
    <div class="py-12 animate-fade-in-up">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h1 class="text-3xl font-bold text-primary">All Projects</h1>
                <p class="text-muted mt-2">A detailed collection of my work and contributions.</p>
            </div>
            <a href="{{ route('home') }}" class="text-sm font-medium text-muted hover:text-primary flex items-center gap-1 transition-colors">
                <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                Back to Home
            </a>
        </div>

        <div class="space-y-12">
            @foreach($projects as $project)
            <div class="bg-surface border border-surface rounded-lg p-8 shadow-sm group hover:border-accent/30 transition-all duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Project Info -->
                    <div class="lg:col-span-8">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <h2 class="text-2xl font-bold text-primary group-hover:text-accent transition-colors">
                                {{ $project['title'] }}
                            </h2>
                            @if(isset($project['year']))
                            <span class="px-2 py-0.5 text-xs font-mono bg-primary/10 text-primary rounded border border-primary/20">
                                {{ $project['year'] }}
                            </span>
                            @endif
                        </div>

                        <p class="text-muted leading-relaxed mb-6 italic">
                            {{ $project['description'] }}
                        </p>

                        @if(isset($project['contribution']))
                        <div class="space-y-3">
                            <h3 class="text-sm font-bold text-primary uppercase tracking-wider">Key Contributions</h3>
                            <ul class="space-y-2">
                                @foreach($project['contribution'] as $contribution)
                                <li class="flex items-start gap-2 text-sm text-muted">
                                    <svg class="w-4 h-4 text-accent mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $contribution }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!-- Tech Stack & Links -->
                    <div class="lg:col-span-4 lg:border-l lg:border-surface lg:pl-8">
                        <div class="mb-8">
                            <h3 class="text-sm font-bold text-primary uppercase tracking-wider mb-4">Technologies Used</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project['tech'] as $tech)
                                <span class="px-2 py-1 text-xs font-medium bg-surface-border text-muted rounded-md border border-surface transition-colors hover:border-accent/40">
                                    {{ $tech }}
                                </span>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-primary uppercase tracking-wider mb-4">Project Links</h3>
                            <div class="space-y-3">
                                <a href="#" class="flex items-center gap-2 text-sm text-muted hover:text-accent transition-colors p-2 rounded-md hover:bg-accent/5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Live Demo
                                </a>
                                <a href="#" class="flex items-center gap-2 text-sm text-muted hover:text-accent transition-colors p-2 rounded-md hover:bg-accent/5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.943 0-1.091.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.597 1.028 2.688 0 3.848-2.339 4.685-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                    </svg>
                                    View Repository
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-20 text-center py-12 border-t border-surface">
            <h2 class="text-2xl font-bold text-primary mb-4">Interested in working together?</h2>
            <p class="text-muted mb-8">I'm always open to discussing new projects and opportunities.</p>
            <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 px-8 py-3 bg-accent text-white font-bold rounded-lg hover:bg-accent-hover transition-all transform hover:-translate-y-1">
                Say Hello
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</x-layout>