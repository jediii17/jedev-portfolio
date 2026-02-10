<div
    x-data="{
        x: 0,
        y: 0,
        targetX: 0,
        targetY: 0,
        show: false,
        hovering: false,
        clicking: false,
        prefersReducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        
        init() {
            // Skip cursor on touch devices or reduced motion
            if ('ontouchstart' in window || this.prefersReducedMotion) {
                return;
            }
            
            // Track mouse position
            window.addEventListener('mousemove', (e) => {
                this.targetX = e.clientX;
                this.targetY = e.clientY;
                this.show = true;
                
                // Check hover state
                const target = e.target;
                const isClickable = target.closest('a, button, [role=button], input, textarea, select, [data-cursor-hover]');
                this.hovering = !!isClickable;
            });
            
            // Track click state
            window.addEventListener('mousedown', () => { this.clicking = true; });
            window.addEventListener('mouseup', () => { this.clicking = false; });
            
            // Hide on touch or leave
            window.addEventListener('touchstart', () => { this.show = false; });
            document.body.addEventListener('mouseleave', () => { this.show = false; });
            document.body.addEventListener('mouseenter', () => { this.show = true; });
            
            // Smooth animation loop
            this.animate();
        },
        
        animate() {
            // Smooth interpolation (easing)
            const ease = 0.15;
            this.x += (this.targetX - this.x) * ease;
            this.y += (this.targetY - this.y) * ease;
            
            requestAnimationFrame(() => this.animate());
        }
    }"
    x-show="show && !prefersReducedMotion"
    x-cloak
    class="fixed pointer-events-none z-9999 inset-0 overflow-hidden hidden md:block"
    aria-hidden="true">

    {{-- Main cursor dot --}}
    <div
        class="cursor-dot"
        :class="{
            'cursor-hovering': hovering,
            'cursor-clicking': clicking
        }"
        :style="`transform: translate(${x - 6}px, ${y - 6}px)`">
    </div>

    {{-- Trailing ring --}}
    <div
        class="cursor-ring"
        :class="{
            'cursor-ring-hovering': hovering,
            'cursor-ring-clicking': clicking
        }"
        :style="`transform: translate(${x - 20}px, ${y - 20}px)`">
    </div>
</div>

<style>
    /* Custom cursor effect is additive; default cursor is preserved. */
    @media (pointer: fine) and (prefers-reduced-motion: no-preference) {
        /* Default cursor styles are not modified here */
    }

    .cursor-dot {
        position: absolute;
        width: 12px;
        height: 12px;
        background: var(--accent, #3b82f6);
        border-radius: 50%;
        transition: transform 0.15s ease, width 0.2s ease, height 0.2s ease, background 0.2s ease;
        will-change: transform;
    }

    .cursor-dot.cursor-hovering {
        width: 16px;
        height: 16px;
        background: var(--accent-hover, #60a5fa);
        transform: translate(-8px, -8px) !important;
    }

    .cursor-dot.cursor-clicking {
        transform: scale(0.8);
    }

    .cursor-ring {
        position: absolute;
        width: 40px;
        height: 40px;
        border: 1.5px solid var(--accent, #3b82f6);
        border-radius: 50%;
        opacity: 0.5;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275),
            width 0.2s ease,
            height 0.2s ease,
            opacity 0.2s ease,
            border-color 0.2s ease;
        will-change: transform;
    }

    .cursor-ring.cursor-ring-hovering {
        width: 60px;
        height: 60px;
        opacity: 0.8;
        border-color: var(--accent-hover, #60a5fa);
    }

    .cursor-ring.cursor-ring-clicking {
        width: 30px;
        height: 30px;
        opacity: 1;
    }
</style>