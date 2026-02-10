import './bootstrap';
import Alpine from 'alpinejs';
import { initParallax } from './parallax';
import { initTechJar } from './tech-jar';

import.meta.glob([
    './assets/images/**',
]);

window.Alpine = Alpine;

Alpine.store('theme', {
    isDark: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

    init() {
        this.applyTheme();
    },

    toggle() {
        this.isDark = !this.isDark;
        localStorage.theme = this.isDark ? 'dark' : 'light';
        this.applyTheme();
    },

    applyTheme() {
        if (this.isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});

Alpine.start();

// Initialize parallax animations
initParallax();

// Initialize tech jar physics
initTechJar();
