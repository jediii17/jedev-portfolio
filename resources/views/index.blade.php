<x-layout>

    <!-- Status Section -->
    <div class="py-3">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-page/10 border border-main/20 w-fit">
            <span class="w-2 h-2 rounded-full bg-green-600 animate-pulse"></span>
            <span class="text-xs font-bold text-main uppercase tracking-wider">Available for hire</span>
        </div>
    </div>

    <!-- Hero Section -->
    <x-hero />

    <!-- Bento Grid Section (Projects, Skills, Experience, Certs, Recs) -->
    <section id="work" class="py-12 animate-fade-in-up" style="animation-delay: 200ms;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Tech Stack (Top Left) -->
            <div id="skills" class="lg:col-span-8 bg-surface border border-surface rounded-sm p-4 shadow-xs">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-lg font-bold text-primary flex items-center gap-2">
                        Tech Stack
                    </h2>
                    <a href="{{ route('skills.index') }}" class="text-sm font-medium text-muted hover:text-primary flex items-center gap-1 transition-colors">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="space-y-8">
                    @foreach($skills as $category => $items)
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-primary/80 uppercase tracking-widest">{{ $category }}</h3>
                        <div class="flex flex-wrap gap-4">
                            @foreach($items as $skill)
                            <span class="text-sm font-medium text-muted hover:text-primary transition-colors cursor-default">
                                {{ $skill }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Experience (Right Side) -->
            <div id="experience" class="lg:col-span-4 lg:row-span-2 bg-surface border border-surface rounded-sm p-4 shadow-xs">
                <h2 class="text-lg font-bold text-primary mb-10">Experience</h2>

                <div class="relative space-y-10">
                    <!-- Vertical line -->
                    <div class="absolute left-[7px] top-2 bottom-2 w-[1.1px] bg-gray-300"></div>

                    @foreach($experience as $index => $item)
                    <div class="relative pl-10 group/exp py-2">
                        <!-- Box indicator -->
                        <div class="absolute left-0 top-3.5 w-[14px] h-[14px] border z-10 transition-all duration-300 
                            {{ $index === 0 
                                ? 'bg-main border-main' 
                                : 'bg-page border-gray-300 dark:border-gray-600 group-hover/exp:bg-main group-hover/exp:border-main' 
                            }}"></div>

                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <h3 class="text-xs font-bold text-primary leading-tight">{{ $item['role'] }}</h3>
                                <p class="text-xs text-muted mt-1">{{ $item['company'] }}</p>
                            </div>
                            <span class="text-xs font-mono text-muted whitespace-nowrap">{{ $item['period'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Projects (Middle Left) -->
            <div id="projects" class="lg:col-span-8 bg-surface border border-surface rounded-sm p-4 shadow-xs">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-lg font-bold text-primary">Recent Projects</h2>
                    <a href="{{ route('projects.index') }}" class="text-sm font-medium text-muted hover:text-primary flex items-center gap-1 transition-colors">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                    @foreach(array_slice($projects, 0, 4) as $project)
                    <div class="group">
                        <h3 class="text-sm font-bold text-primary group-hover:text-accent transition-colors">{{ $project['title'] }}</h3>
                        <p class="text-xs text-muted mt-2 line-clamp-2">{{ $project['description'] }}</p>
                        <div class="mt-4">

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Certifications (Bottom Left) -->
            <div class="lg:col-span-7 bg-surface border border-surface rounded-sm p-4 shadow-xs">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-lg font-bold text-primary">Recent Certifications</h2>
                    <a href="{{ route('certifications.index') }}" class="text-sm font-medium text-muted hover:text-primary flex items-center gap-1 transition-colors">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach($certification as $cert)
                    <a href="{{ $cert['link'] }}" target="_blank" class="block p-4 bg-surface border border-surface rounded-lg hover:border-accent/40 transition-all duration-300 group/cert">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-base font-bold text-primary group-hover/cert:text-accent transition-colors">{{ $cert['title'] }}</h3>
                                <p class="text-sm text-muted mt-1">{{ $cert['company'] }}</p>
                            </div>
                            <svg class="w-4 h-4 text-muted group-hover/cert:text-accent group-hover/cert:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Recommendations (Bottom Right) -->
            <div class="lg:col-span-5 bg-surface border border-surface rounded-sm p-4 shadow-xs">
                <h2 class="text-lg font-bold text-primary mb-8">Recommendations</h2>

                <div x-data="{ 
                    current: 0, 
                    items: {{ count($recommendations) }},
                    init() {
                        setInterval(() => {
                            this.current = (this.current + 1) % this.items;
                        }, 5000);
                    }
                }">
                    <div class="relative min-h-[160px]">
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
                            <p class="text-sm text-primary/90 leading-relaxed italic">
                                "{{ $rec['text'] }}"
                            </p>
                            <div class="mt-8">
                                <p class="text-sm font-bold text-primary">{{ $rec['author'] }}</p>
                                <p class="text-xs text-muted mt-1">{{ $rec['title'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination dots -->
                    <div class="flex gap-2 mt-8">
                        @foreach($recommendations as $index => $rec)
                        <button
                            @click="current = {{ $index }}"
                            :class="current === {{ $index }} ? 'bg-primary' : 'bg-muted/30'"
                            class="w-2 h-2 rounded-full transition-colors duration-300">
                        </button>
                        @endforeach
                        @for($i = count($recommendations); $i < 6; $i++)
                            <div class="w-2 h-2 rounded-full bg-muted/20">
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 md:py-24 animate-fade-in-up" style="animation-delay: 400ms;">
        <div class="bg-surface rounded-sm p-4 md:p-12 text-center border border-surface hover:border-accent transition-colors duration-300 shadow-xs">
            <h2 class="text-3xl font-bold text-main mb-4">Let's Work Together</h2>
            <p class="text-muted text-lg mb-8 max-w-2xl mx-auto">
                I'm currently available for new opportunities. Whether you have a question or just want to say hi, I'll try my best to get back to you!
            </p>

            <a href="mailto:jedidialemuel17@gmail.com" class="inline-flex items-center gap-2 px-8 py-4 rounded-lg bg-accent text-white font-medium hover:bg-accent-hover transition-all transform hover:-translate-y-1 shadow-lg shadow-(--accent)/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                Say Hello
            </a>
        </div>
    </section>

</x-layout>