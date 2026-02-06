<div
    x-data="{ loading: true }"
    x-init="window.addEventListener('load', () => { setTimeout(() => loading = false, 2000) })"
    :class="{ 'loader-hidden': !loading }"
    class="loader-overlay">
    <div class="flex flex-col items-center gap-6">
        <!-- Animated Logo -->
        <div class="w-24 h-24 text-primary animate-logo-pulse">
            <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path class="animate-path-draw" d="M30 25V65C30 73.2843 36.7157 80 45 80" stroke="currentColor" stroke-linecap="round" stroke-width="8"></path>
                <path class="animate-path-draw" d="M50 20V80H80" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="8" style="animation-delay: 0.2s;"></path>
                <path class="animate-path-draw" d="M85 45C85 33.9543 76.0457 25 65 25" stroke="currentColor" stroke-linecap="round" stroke-width="8" style="animation-delay: 0.4s;"></path>
            </svg>
        </div>

        <!-- Loading Text -->
        <div class="flex items-center gap-1">
            <span class="text-xs font-bold tracking-[0.3em] uppercase text-primary/40 animate-pulse">Initializing</span>
        </div>
    </div>
</div>