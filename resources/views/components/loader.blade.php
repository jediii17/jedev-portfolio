<div
    x-data="loaderController"
    x-init="init()"
    x-show="loading"
    x-transition:leave="transition ease-in-out duration-700"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-full"
    class="loader-overlay"
    role="progressbar"
    :aria-valuenow="Math.round(progress)"
    aria-valuemin="0"
    aria-valuemax="100"
    aria-label="Loading portfolio">

    <div class="flex flex-col items-center gap-8">
        {{-- Animated Logo --}}
        <div class="relative">
            {{-- Glow effect --}}
            <div class="absolute inset-0 blur-2xl bg-accent/30 rounded-full scale-150 animate-pulse"
                x-show="!prefersReducedMotion"></div>

            {{-- Logo SVG --}}
            <div class="relative w-24 h-24 text-primary"
                :class="{ 'animate-logo-pulse': !prefersReducedMotion }">
                <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <path
                        class="loader-path"
                        :class="{ 'animate-path-draw': !prefersReducedMotion }"
                        d="M30 25V65C30 73.2843 36.7157 80 45 80"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="8"
                        style="--delay: 0s">
                    </path>
                    <path
                        class="loader-path"
                        :class="{ 'animate-path-draw': !prefersReducedMotion }"
                        d="M50 20V80H80"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="8"
                        style="--delay: 0.2s">
                    </path>
                    <path
                        class="loader-path"
                        :class="{ 'animate-path-draw': !prefersReducedMotion }"
                        d="M85 45C85 33.9543 76.0457 25 65 25"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-width="8"
                        style="--delay: 0.4s">
                    </path>
                </svg>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="w-48 h-1 bg-surface rounded-full overflow-hidden">
            <div
                class="h-full bg-linear-to-r from-accent to-accent-hover rounded-full transition-all duration-300 ease-out"
                :style="`width: ${progress}%`">
            </div>
        </div>

        {{-- Loading Text --}}
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold tracking-[0.3em] uppercase text-muted">
                Loading
            </span>
            <span class="text-xs font-bold text-accent" x-text="`${Math.round(progress)}%`"></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('loaderController', () => ({
            loading: true,
            progress: 0,
            prefersReducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
            startTime: null,

            init() {
                this.startTime = Date.now();
                var duration = this.prefersReducedMotion ? 500 : 1500;
                var self = this;

                function updateProgress() {
                    var elapsed = Date.now() - self.startTime;
                    self.progress = Math.min(100, (elapsed / duration) * 100);

                    if (self.progress < 100) {
                        requestAnimationFrame(updateProgress);
                    }
                }

                updateProgress();

                function hideLoader() {
                    if (!self.loading) return; // Already hidden
                    self.loading = false;
                    // Dispatch event after the leave transition completes (~700ms)
                    setTimeout(function() {
                        window.dispatchEvent(new CustomEvent('loader:hidden'));
                    }, 750);
                }

                // Hide loader when page is ready
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        hideLoader();
                    }, self.prefersReducedMotion ? 200 : duration + 300);
                });

                // Fallback: hide after max time
                setTimeout(function() {
                    hideLoader();
                }, this.prefersReducedMotion ? 500 : 3000);
            }
        }));
    });
</script>

<style>
    .loader-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--bg-primary);
    }

    .loader-path {
        stroke-dasharray: 200;
        stroke-dashoffset: 200;
    }

    .animate-path-draw {
        animation: pathDraw 1.5s ease-out forwards;
        animation-delay: var(--delay, 0s);
    }

    @keyframes pathDraw {
        from {
            stroke-dashoffset: 200;
        }

        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes logoPulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    .animate-logo-pulse {
        animation: logoPulse 2s ease-in-out infinite;
    }

    /* Respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .loader-path {
            stroke-dashoffset: 0;
        }

        .animate-path-draw,
        .animate-logo-pulse {
            animation: none;
        }
    }
</style>