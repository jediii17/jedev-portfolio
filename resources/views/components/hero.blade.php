<section id="about" class="min-h-[80vh] flex flex-col justify-center animate-fade-in-up">
    <div class="space-y-8">
        <!-- Profile Image -->
        <div class="flex items-center gap-6">
            <div class="relative w-32 h-32 md:w-40 md:h-40">
                <img src="{{ asset('images/jed.png') }}" alt="Jedidia Lemuel B. Cruz" class=" rounded-m object-cover shadow-xl border-4 border-surface w-full h-full">
                <div class="absolute inset-0 rounded-full bg-accent mix-blend-overlay opacity-10"></div>
            </div>

            <div>
                <h1 class="text-lg md:text-5xl font-bold tracking-tight text-main">
                    Jedidia Lemuel Cruz
                </h1>
                <h3 class="flex items-center gap-2 text-sm md:text-xl font-medium text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin">
                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                        <circle cx="12" cy="10" r="3" />
                    </svg> Santa Rosa City, Laguna
                </h3>
                <h2 class="text-md md:text-xl font-medium text-accent">
                    Software Engineer
                </h2>
            </div>
        </div>

        <!-- Text Content -->
        <div class="space-y-4 max-w-2xl">
            <p class="text-lg leading-relaxed text-muted">
                I’m a Software Engineer specializing in JavaScript and Laravel-based PHP development,
                working on projects that include backend systems, APIs, and web platforms. Lately,
                I’ve been exploring AI and expanding my knowledge in the world of intelligent systems.
            </p>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap gap-4 pt-4">
            <a href="#contact" class="flex items-center justify-center gap-2 h-12 px-6 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-bold transition-all shadow-lg shadow-blue-500/25 hover:-translate-y-0.5">
                <span>Get in touch</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-corner-right-down-icon lucide-corner-right-down">
                    <path d="m10 15 5 5 5-5" />
                    <path d="M4 4h7a4 4 0 0 1 4 4v12" />
                </svg>
            </a>

            <a href="{{ asset('assets/resume.pdf') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 rounded-lg border border-surface text-main font-medium hover:border-accent hover:text-accent transition-all transform hover:-translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download">
                    <path d="M12 15V3" />
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <path d="m7 10 5 5 5-5" />
                </svg>
                <span>Download Resume</span>
            </a>
        </div>

        <!-- Tech Stack Chips -->
        <div class="pt-3">
            <p class="text-xs uppercase tracking-wider text-slate-500 mb-4 font-semibold">Core Technologies</p>
            <div class="flex flex-wrap gap-3">
                <!-- Chip Items -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-fab-laravel class="w-6 h-6 text-[#FF2D20]" />
                    <span>Laravel</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-tni-vue class="w-6 h-6 text-[#42b883]" />
                    <span>Vue JS</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-fileicon-tailwind class="w-6 h-6 text-[#38bdf8]" />
                    <span>Tailwind CSS</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-fab-php class="w-6 h-6 text-[#777bb4]" />
                    <span>PHP</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-fab-js class="w-6 h-6 text-[#f0db4f]" />
                    <span>JavaScript</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-main bg-surface/50 border border-surface text-sm font-medium hover:border-accent/50 transition-colors cursor-default">
                    <x-si-mysql class="w-6 h-6 text-[#adb2b2]" />
                    <span>MySQL</span>
                </div>
            </div>
        </div>

        <!-- Social Proof -->
        <div class="flex gap-6 pt-2 text-muted">
            <a href="https://github.com/jediii17" target="_blank" class="hover:text-main transition-colors" aria-label="GitHub">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.943 0-1.091.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.597 1.028 2.688 0 3.848-2.339 4.685-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="https://linkedin.com/in/jedidialemuelcruz" target="_blank" class="hover:text-main transition-colors" aria-label="LinkedIn">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                </svg>
            </a>
            <a href="mailto:jedidialemuel17@gmail.com" class="hover:text-main transition-colors" aria-label="Email">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </a>
        </div>
    </div>
</section>