<div
    x-data="{
        x: 0,
        y: 0,
        show: false,
        hovering: false,
        particles: [],
        init() {
            window.addEventListener('mousemove', (e) => {
                this.x = e.clientX;
                this.y = e.clientY;
                this.show = true;

                // Check active hover state
                const target = e.target;
                const isClickable = target.closest('a, button, [role=button], input, textarea, select');
                this.hovering = !!isClickable;

                // Add glitter particles on move
                if (Math.random() > 0.7) { // 30% chance per move event
                    this.particles.push({
                        id: Date.now() + Math.random(),
                        x: this.x + (Math.random() - 0.5) * 40, // Random spread
                        y: this.y + (Math.random() - 0.5) * 40,
                        size: Math.random() * 3 + 1, // Random size 1-4px
                        opacity: 1,
                        createdAt: Date.now()
                    });
                }

                // Cleanup old particles
                this.particles = this.particles.filter(p => Date.now() - p.createdAt < 600);
            });

            // Animation loop for fading particles
            const animate = () => {
                this.particles.forEach(p => {
                    p.opacity -= 0.04; 
                    p.y += 0.5; // Slight drift down
                });
                requestAnimationFrame(animate);
            };
            requestAnimationFrame(animate);

            window.addEventListener('touchstart', () => { this.show = false; });
            document.body.addEventListener('mouseleave', () => { this.show = false; });
            document.body.addEventListener('mouseenter', () => { this.show = true; });
        }
    }"
    x-show="show"
    x-cloak
    class="fixed pointer-events-none z-9999 inset-0 overflow-hidden hidden md:block">


    <!-- Glitter Particles -->
    <template x-for="particle in particles" :key="particle.id">
        <div
            class="absolute rounded-full bg-accent shadow-[0_0_4px_var(--color-accent)]"
            :style="`
                left: ${particle.x}px; 
                top: ${particle.y}px;
                width: ${particle.size}px; 
                height: ${particle.size}px;
                opacity: ${particle.opacity};
                transform: translate(-50%, -50%);
            `"></div>
    </template>
</div>