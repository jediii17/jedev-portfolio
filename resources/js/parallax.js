/**
 * Parallax Animation Controller v2
 * Enhanced with multi-layer parallax, gradient mesh, and accessibility
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { SplitText } from 'gsap/SplitText';
import Lenis from 'lenis';
import { initTypedHeadlines } from './typed-headline';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, SplitText);

// Lenis smooth scroll instance
let lenis;

// Check for reduced motion preference
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Initialize Lenis smooth scrolling
 */
export function initSmoothScroll() {
    // Skip smooth scroll if reduced motion is preferred
    if (prefersReducedMotion) {
        return null;
    }

    lenis = new Lenis({
        // Ultra-smooth parallax scrolling config
        lerp: 0.075, // Lower = smoother (0.05-0.1 range is silky)
        duration: 1.8, // Longer duration for more fluid feel
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // Exponential ease-out
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 0.8, // Reduce for smoother wheel scroll
        touchMultiplier: 1.5,
        syncTouch: true,
        touchInertiaMultiplier: 30,
        infinite: false,
    });

    // Connect Lenis to GSAP ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);

    // Keyboard Navigation
    initKeyboardNav();

    return lenis;
}

/**
 * Keyboard Navigation for Sections
 */
function initKeyboardNav() {
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();

            const sections = gsap.utils.toArray('.parallax-hero, .parallax-section, .split-slide');
            const scrollPos = lenis.scroll;

            if (e.key === 'ArrowDown') {
                const nextSection = sections.find(s => s.offsetTop > scrollPos + 10);
                if (nextSection) {
                    lenis.scrollTo(nextSection, { duration: 1.5 });
                }
            } else if (e.key === 'ArrowUp') {
                const prevSection = [...sections].reverse().find(s => s.offsetTop < scrollPos - 10);
                if (prevSection) {
                    lenis.scrollTo(prevSection, { duration: 1.5 });
                }
            }
        }
    });
}


/**
 * Initialize cursor-reactive gradient mesh background
 */
export function initGradientMesh() {
    const gradientEl = document.querySelector('.gradient-mesh');
    if (!gradientEl || prefersReducedMotion) return;

    const blobs = gradientEl.querySelectorAll('.gradient-blob');
    if (blobs.length === 0) return;

    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let targetX = mouseX;
    let targetY = mouseY;

    // Track mouse position
    document.addEventListener('mousemove', (e) => {
        targetX = e.clientX;
        targetY = e.clientY;
    });

    // Animate blobs with smooth following
    function animateBlobs() {
        // Smooth interpolation
        mouseX += (targetX - mouseX) * 0.05;
        mouseY += (targetY - mouseY) * 0.05;

        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;

        blobs.forEach((blob, i) => {
            // Each blob follows differently
            const offsetMultiplier = (i + 1) * 0.15;
            const xOffset = (mouseX - centerX) * offsetMultiplier;
            const yOffset = (mouseY - centerY) * offsetMultiplier;

            gsap.to(blob, {
                x: xOffset,
                y: yOffset,
                duration: 1,
                ease: 'power2.out',
            });
        });

        requestAnimationFrame(animateBlobs);
    }

    animateBlobs();
}

/**
 * Initialize multi-layer parallax hero
 */
export function initMultiLayerParallax() {
    if (prefersReducedMotion) return;

    const hero = document.querySelector('.parallax-hero');
    if (!hero) return;

    // Layer 1: Far background (slowest)
    const layer1 = hero.querySelector('[data-parallax-layer="1"]');
    if (layer1) {
        gsap.to(layer1, {
            yPercent: 30,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 1.5, // Smooth scrub delay for parallax
            },
        });
    }

    // Layer 2: Mid background
    const layer2 = hero.querySelector('[data-parallax-layer="2"]');
    if (layer2) {
        gsap.to(layer2, {
            yPercent: 50,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 1.2, // Slightly faster than layer1 for depth effect
            },
        });
    }

    // Layer 3: Foreground elements (fastest)
    const layer3 = hero.querySelector('[data-parallax-layer="3"]');
    if (layer3) {
        gsap.to(layer3, {
            yPercent: 70,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 0.8, // Fastest layer for foreground depth
            },
        });
    }

    // Fallback for single background
    const heroBg = hero.querySelector('.parallax-hero-bg');
    if (heroBg && !layer1 && !layer2 && !layer3) {
        gsap.to(heroBg, {
            yPercent: 50,
            ease: 'none',
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 1.5, // Smooth parallax scrub
            },
        });
    }
}

/**
 * Initialize hero section animations - Cinematic entrance sequence
 */
export function initHeroAnimations() {
    if (prefersReducedMotion) return;

    const hero = document.querySelector('.parallax-hero');
    if (!hero) return;

    // Master timeline for orchestrated entrance
    const tl = gsap.timeline({
        defaults: { ease: 'power4.out' },
        delay: 0.3, // Small delay after loader finishes
    });

    // 1. Profile image — scale up with elastic bounce
    const profile = hero.querySelector('.hero-profile');
    if (profile) {
        gsap.set(profile, { scale: 0, opacity: 0, rotation: -10 });
        tl.to(profile, {
            scale: 1,
            opacity: 1,
            rotation: 0,
            duration: 1.2,
            ease: 'elastic.out(1, 0.5)',
        }, 0);
    }

    // 2. "Available for hire" badge — slide in from left with fade
    const badge = hero.querySelector('.hero-subtitle:first-child');
    if (badge) {
        gsap.set(badge, { x: -60, opacity: 0, scale: 0.8 });
        tl.to(badge, {
            x: 0,
            opacity: 1,
            scale: 1,
            duration: 0.8,
            ease: 'back.out(1.7)',
        }, 0.2);
    }

    // 3. "Hi, I'm" title — sweep up with clip-path reveal
    const heroTitle = hero.querySelectorAll('.hero-title-line');
    heroTitle.forEach((line, i) => {
        gsap.set(line, {
            y: 120,
            opacity: 0,
            clipPath: 'inset(100% 0 0 0)',
        });
        tl.to(line, {
            y: 0,
            opacity: 1,
            clipPath: 'inset(0% 0 0 0)',
            duration: 1.2,
            ease: 'power4.out',
        }, 0.3 + i * 0.1);
    });

    // 4. Dynamic typed text container — fade in from right
    const typedDisplay = hero.querySelector('.text-display');
    if (typedDisplay) {
        gsap.set(typedDisplay, { x: 80, opacity: 0 });
        tl.to(typedDisplay, {
            x: 0,
            opacity: 1,
            duration: 1,
            ease: 'power3.out',
        }, 0.6);
    }

    // 5. Tagline subtitle — slide up
    const tagline = hero.querySelector('.hero-subtitle + .hero-title-line + .text-display + .hero-subtitle, p.hero-subtitle');
    const allSubtitles = hero.querySelectorAll('.hero-subtitle');
    allSubtitles.forEach((sub, i) => {
        // Skip the badge (first subtitle already animated)
        if (i === 0) return;
        gsap.set(sub, { y: 40, opacity: 0 });
        tl.to(sub, {
            y: 0,
            opacity: 1,
            duration: 0.9,
            ease: 'power3.out',
        }, 0.7 + i * 0.1);
    });

    // 6. Description paragraph — fade in
    const description = hero.querySelector('.max-w-2xl.hero-subtitle');
    if (description) {
        gsap.set(description, { y: 50, opacity: 0 });
        tl.to(description, {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: 'power3.out',
        }, 0.8);
    }

    // 7. CTA buttons — pop in with stagger
    const ctaButtons = hero.querySelectorAll('.hero-cta > a, .hero-cta > span');
    if (ctaButtons.length) {
        gsap.set(ctaButtons, { y: 40, opacity: 0, scale: 0.9 });
        tl.to(ctaButtons, {
            y: 0,
            opacity: 1,
            scale: 1,
            duration: 0.8,
            stagger: 0.15,
            ease: 'back.out(1.4)',
        }, 1.0);
    }

    // 8. Tech cards — cascade in with slight rotation
    const techCards = hero.querySelectorAll('.tech-card');
    if (techCards.length) {
        gsap.set(techCards, { y: 50, opacity: 0, scale: 0.85, rotation: -5 });
        tl.to(techCards, {
            y: 0,
            opacity: 1,
            scale: 1,
            rotation: 0,
            duration: 0.7,
            stagger: 0.08,
            ease: 'back.out(1.2)',
        }, 1.1);
    }

    // 9. Social links — fade up last
    const socialLinks = hero.querySelectorAll('.hero-cta:last-child a');
    if (socialLinks.length) {
        gsap.set(socialLinks, { y: 20, opacity: 0 });
        tl.to(socialLinks, {
            y: 0,
            opacity: 1,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
        }, 1.3);
    }

    // 10. "Core Stack" label
    const coreStackLabel = hero.querySelector('.hero-cta p');
    if (coreStackLabel) {
        gsap.set(coreStackLabel, { x: -30, opacity: 0 });
        tl.to(coreStackLabel, {
            x: 0,
            opacity: 1,
            duration: 0.6,
            ease: 'power2.out',
        }, 1.0);
    }

    // 11. Scroll indicator — fade in late with continuous float
    gsap.set('.scroll-indicator', { opacity: 0, y: -20 });
    tl.to('.scroll-indicator', {
        opacity: 0.6,
        y: 0,
        duration: 0.8,
        ease: 'power2.out',
        onComplete: () => {
            // Start continuous float animation after entrance
            gsap.to('.scroll-indicator', {
                y: 10,
                duration: 1.2,
                repeat: -1,
                yoyo: true,
                ease: 'power1.inOut',
            });
        }
    }, 1.6);

    // 12. Gradient blobs — scale in subtly
    const blobs = hero.querySelectorAll('.gradient-blob');
    if (blobs.length) {
        gsap.set(blobs, { scale: 0.3, opacity: 0 });
        tl.to(blobs, {
            scale: 1,
            opacity: 0.6,
            duration: 2,
            stagger: 0.2,
            ease: 'power2.out',
        }, 0);
    }
}

/**
 * Initialize section reveal animations
 */
export function initSectionAnimations() {
    if (prefersReducedMotion) return;

    // Fade up and scale animation for all sections
    gsap.utils.toArray('.parallax-section').forEach((section) => {
        const content = section.querySelector('.section-content');
        if (!content) return;

        gsap.fromTo(content,
            {
                y: 100,
                opacity: 0,
                scale: 0.95,
            },
            {
                y: 0,
                opacity: 1,
                scale: 1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 95%',
                    end: 'top 50%',
                    scrub: 2, // Smoother section reveals
                },
            }
        );
    });

    // Stagger animations for cards/items
    gsap.utils.toArray('.stagger-container').forEach((container) => {
        const items = container.querySelectorAll('.stagger-item');
        gsap.from(items, {
            y: 60,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: container,
                start: 'top 75%',
                toggleActions: 'play none none reverse',
            },
        });
    });
}

/**
 * Initialize parallax depth effects
 */
export function initParallaxLayers() {
    if (prefersReducedMotion) return;

    // Different parallax speeds for layered elements
    gsap.utils.toArray('[data-parallax]').forEach((element) => {
        const speed = parseFloat(element.dataset.parallax) || 0.1;

        gsap.to(element, {
            yPercent: speed * 100,
            ease: 'none',
            scrollTrigger: {
                trigger: element.closest('.parallax-section') || element,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1.5, // Smooth parallax layers
            },
        });
    });
}

/**
 * Initialize text split animations
 */
export function initTextAnimations() {
    if (prefersReducedMotion) return;

    gsap.utils.toArray('.split-text').forEach((text) => {
        const words = text.textContent.split(' ');
        text.innerHTML = words.map(word => `<span class="word-wrap"><span class="word">${word}</span></span>`).join(' ');

        gsap.from(text.querySelectorAll('.word'), {
            y: '100%',
            opacity: 0,
            duration: 0.6,
            stagger: 0.02,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: text,
                start: 'top 85%',
                toggleActions: 'play none none reverse',
            },
        });
    });
}

/**
 * Initialize navigation progress bar
 */
export function initNavProgress() {
    if (prefersReducedMotion) return;

    const progress = document.querySelector('.nav-progress');
    if (!progress) return;

    gsap.to(progress, {
        scaleX: 1,
        ease: 'none',
        scrollTrigger: {
            trigger: document.body,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.3,
        },
    });
}

/**
 * Initialize magnetic button effect
 */
export function initMagneticButtons() {
    if (prefersReducedMotion) return;

    const magneticBtns = document.querySelectorAll('.magnetic-btn');

    magneticBtns.forEach((btn) => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * 0.3,
                y: y * 0.3,
                duration: 0.3,
                ease: 'power2.out',
            });
        });

        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, {
                x: 0,
                y: 0,
                duration: 0.5,
                ease: 'elastic.out(1, 0.3)',
            });
        });
    });
}

/**
 * Initialize tech stack card animations
 */
export function initTechStackAnimations() {
    if (prefersReducedMotion) return;

    const techCards = document.querySelectorAll('.tech-card');

    techCards.forEach((card, i) => {
        // Floating animation
        gsap.to(card, {
            y: -5 + (i % 3) * 3,
            duration: 2 + (i % 2),
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
            delay: i * 0.1,
        });

        // Hover tilt effect
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;

            gsap.to(card, {
                rotateY: x * 10,
                rotateX: -y * 10,
                duration: 0.3,
                ease: 'power2.out',
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                rotateY: 0,
                rotateX: 0,
                duration: 0.5,
                ease: 'power2.out',
            });
        });
    });
}

/**
 * Handle smooth scroll to anchor links
 */
export function initAnchorLinks() {
    document.querySelectorAll('a[href*="#"]').forEach((anchor) => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');

            // Extract the fragment
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return;

            const targetId = href.substring(hashIndex);
            if (targetId === '#') return;

            // Robust same-page check
            const currentUrl = new URL(window.location.href);
            const targetUrl = new URL(anchor.href);

            // Normalize by removing hash and trailing slashes
            const normalize = (url) => {
                const u = new URL(url);
                u.hash = '';
                return u.toString().replace(/\/$/, '');
            };

            const isSamePage = normalize(currentUrl) === normalize(targetUrl);

            if (isSamePage) {
                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();

                    // Close mobile menu if open (Alpine.js data)
                    const navEl = document.querySelector('[x-data]');
                    if (navEl && navEl.__x) {
                        navEl.__x.$data.mobileMenuOpen = false;
                    }
                    // Also try Alpine.$data approach (Alpine v3)
                    const mobileMenu = anchor.closest('[x-data]');
                    if (mobileMenu) {
                        const alpineData = Alpine.$data(mobileMenu);
                        if (alpineData && typeof alpineData.closeMobileMenu === 'function') {
                            alpineData.closeMobileMenu();
                        }
                    }

                    // Restore body scroll
                    document.body.style.overflow = '';

                    // Small delay to let menu close animation start, then scroll
                    setTimeout(() => {
                        if (lenis) {
                            lenis.scrollTo(target, {
                                offset: -80,
                                duration: 1.5,
                            });
                        } else {
                            // Fallback for reduced motion or no Lenis
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }, 100);
                }
            }
            // If not same page, browser will naturally navigate to the URL
        });
    });
}

/**
 * Initialize all parallax animations
 */
export function initParallax() {
    // Wait for DOM and assets
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}

function init() {
    // Initialize smooth scrolling first
    initSmoothScroll();

    // Wait a tick for Lenis to be ready
    requestAnimationFrame(() => {
        initGradientMesh();
        initMultiLayerParallax();
        initHeroAnimations();
        initSectionAnimations();
        initParallaxLayers();
        initTextAnimations();
        initNavProgress();
        initMagneticButtons();
        initTechStackAnimations();
        initSplitParallax();
        initTextReveals();
        initAnchorLinks();
        initTypedHeadlines();
        initThemeSwitchAnimation();

        // Refresh ScrollTrigger after everything is set up
        ScrollTrigger.refresh();
    });
}

/**
 * Split-Section Parallax Images
 */
function initSplitParallax() {
    if (prefersReducedMotion) return;

    gsap.utils.toArray('.col-image-wrap').forEach((wrap) => {
        gsap.fromTo(wrap,
            { y: "-15vh" },
            {
                y: "15vh",
                ease: 'none',
                scrollTrigger: {
                    trigger: wrap.closest('.split-slide'),
                    scrub: 1.8, // Ultra-smooth split parallax
                    start: "top bottom",
                    end: "bottom top"
                }
            }
        );
    });
}

/**
 * Advanced Text Reveals with SplitText
 */
function initTextReveals() {
    if (prefersReducedMotion) return;

    const titles = gsap.utils.toArray('.text-reveal');

    titles.forEach(title => {
        // Clear previous splits if any (to prevent double wraps on re-init if ever called)
        const split = new SplitText(title, {
            type: 'lines, chars',
            linesClass: 'overflow-hidden line-parent'
        });

        gsap.from(split.chars, {
            y: "100%",
            opacity: 0,
            stagger: 0.02,
            duration: 1.2,
            ease: 'power4.out',
            scrollTrigger: {
                trigger: title,
                start: 'top 90%',
                toggleActions: 'play none none reverse'
            }
        });
    });
}


/**
 * Initialize Theme Switch Elastic Animation
 */
function initThemeSwitchAnimation() {
    if (prefersReducedMotion) return;

    const toggles = document.querySelectorAll('.theme-switch');
    if (toggles.length === 0) return;

    toggles.forEach(toggle => {
        const knob = toggle.querySelector('.switch-knob');
        const sunIcon = toggle.querySelector('.knob-sun');
        const moonIcon = toggle.querySelector('.knob-moon');
        const sunRays = toggle.querySelectorAll('.sun-rays line');

        if (!knob) return;

        // Calculate positions
        const switchWidth = 56;
        const knobSize = 24;
        const padding = 3;
        const travelDistance = switchWidth - knobSize - (padding * 2);

        let isAnimating = false;

        // Set initial position based on current theme
        const setInitialState = () => {
            const isDark = document.documentElement.classList.contains('dark');
            gsap.set(knob, { x: isDark ? travelDistance : 0 });
        };

        setInitialState();

        // Listen for clicks with elastic animation
        toggle.addEventListener('click', () => {
            if (isAnimating) return;
            isAnimating = true;

            // Get state BEFORE the toggle happens (Alpine toggles it immediately)
            const wasDark = !document.documentElement.classList.contains('dark');
            const targetX = wasDark ? 0 : travelDistance;

            // Create elastic switch animation timeline
            const tl = gsap.timeline({
                onComplete: () => {
                    isAnimating = false;
                    // Sync other toggles positions if they exist
                    toggles.forEach(other => {
                        if (other !== toggle) {
                            const otherKnob = other.querySelector('.switch-knob');
                            if (otherKnob) gsap.set(otherKnob, { x: targetX });
                        }
                    });
                }
            });

            // 1. Squish on press
            tl.to(knob, {
                scaleY: 0.8,
                scaleX: 1.15,
                duration: 0.08,
                ease: 'power2.in'
            })
                // 2. Stretch while moving
                .to(knob, {
                    scaleX: 1.5,
                    scaleY: 0.65,
                    duration: 0.12,
                    ease: 'power2.in'
                })
                // 3. Slide to target with elastic bounce
                .to(knob, {
                    x: targetX,
                    duration: 0.6,
                    ease: 'elastic.out(1, 0.4)'
                }, '-=0.08')
                // 4. Return to normal shape with elastic overshoot
                .to(knob, {
                    scaleX: 1,
                    scaleY: 1,
                    duration: 0.7,
                    ease: 'elastic.out(1.2, 0.35)'
                }, '-=0.5');

            // Animate icons
            if (wasDark) {
                // Going to light mode - show moon, hide sun
                tl.to(sunIcon, {
                    opacity: 0,
                    rotation: 90,
                    scale: 0.5,
                    duration: 0.3,
                    ease: 'power2.in'
                }, 0.1);
                tl.to(moonIcon, {
                    opacity: 1,
                    rotation: 0,
                    scale: 1,
                    duration: 0.5,
                    ease: 'elastic.out(1, 0.5)'
                }, 0.2);
                // Sun rays shrink
                tl.to(sunRays, {
                    scale: 0,
                    opacity: 0,
                    stagger: 0.02,
                    duration: 0.2,
                    ease: 'power2.in'
                }, 0);
            } else {
                // Going to dark mode - show sun, hide moon
                tl.to(moonIcon, {
                    opacity: 0,
                    rotation: -90,
                    scale: 0.5,
                    duration: 0.3,
                    ease: 'power2.in'
                }, 0.1);
                tl.to(sunIcon, {
                    opacity: 1,
                    rotation: 0,
                    scale: 1,
                    duration: 0.5,
                    ease: 'elastic.out(1, 0.5)'
                }, 0.2);
                // Sun rays burst out
                tl.fromTo(sunRays,
                    { scale: 0, opacity: 0 },
                    {
                        scale: 1,
                        opacity: 1,
                        stagger: 0.03,
                        duration: 0.5,
                        ease: 'elastic.out(1.2, 0.5)'
                    }, 0.3);
            }
        });

        // Hover effects
        toggle.addEventListener('mouseenter', () => {
            if (isAnimating) return;
            gsap.to(knob, {
                scale: 1.1,
                duration: 0.25,
                ease: 'elastic.out(1, 0.6)'
            });
        });

        toggle.addEventListener('mouseleave', () => {
            if (isAnimating) return;
            gsap.to(knob, {
                scale: 1,
                duration: 0.35,
                ease: 'elastic.out(1, 0.5)'
            });
        });

        // Pointer down squish
        toggle.addEventListener('pointerdown', () => {
            if (isAnimating) return;
            gsap.to(knob, {
                scaleY: 0.92,
                scaleX: 1.06,
                duration: 0.08,
                ease: 'power2.in'
            });
        });
    });
}


// Handle page visibility for performance
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        lenis?.stop();
    } else {
        lenis?.start();
    }
});

// Handle resize
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        ScrollTrigger.refresh();
    }, 250);
});

export default { initParallax };
