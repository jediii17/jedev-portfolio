import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    base: './',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        cssMinify: 'lightningcss',
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor-physics': ['matter-js'],
                    'vendor-animation': ['gsap', 'gsap/ScrollTrigger', 'gsap/ScrollToPlugin', 'gsap/SplitText', 'lenis'],
                    'vendor-alpine': ['alpinejs'],
                },
            },
        },
    },
});
