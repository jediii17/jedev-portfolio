{{-- Elastic Switch Theme Toggle with Sun/Moon Morphing --}}
<label
    class="theme-switch"
    @click="$store.theme.toggle()"
    role="switch"
    :aria-checked="$store.theme.isDark"
    aria-label="Toggle Dark Mode"
    tabindex="0"
    @keydown.enter="$store.theme.toggle()"
    @keydown.space.prevent="$store.theme.toggle()"
    data-cursor-hover>

    {{-- Switch Track --}}
    <div class="switch-track">
        {{-- Morphing Knob with Sun/Moon Icon --}}
        <div class="switch-knob">
            {{-- Sun Icon (visible in dark mode - knob on right) --}}
            <svg class="knob-icon knob-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"></circle>
                <g class="sun-rays">
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="6.34" x2="19.78" y2="4.93"></line>
                </g>
            </svg>

            {{-- Moon Icon (visible in light mode - knob on left) --}}
            <svg class="knob-icon knob-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </div>
    </div>
</label>

<style>
    .theme-switch {
        --switch-width: 56px;
        --switch-height: 30px;
        --knob-size: 24px;
        --switch-padding: 3px;
        --track-light: #cbd5e1;
        --track-dark: #334155;
        --knob-bg: #ffffff;

        position: relative;
        display: inline-flex;
        cursor: pointer;
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }

    .theme-switch:focus-visible .switch-track {
        box-shadow: 0 0 0 3px var(--accent);
    }

    .switch-track {
        position: relative;
        width: var(--switch-width);
        height: var(--switch-height);
        background: var(--track-light);
        border-radius: 9999px;
        transition: background 0.4s ease;
        overflow: visible;
    }

    .dark .switch-track {
        background: var(--track-dark);
    }

    /* Switch knob */
    .switch-knob {
        position: absolute;
        top: var(--switch-padding);
        left: var(--switch-padding);
        width: var(--knob-size);
        height: var(--knob-size);
        border-radius: 50%;
        background: var(--knob-bg);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2), 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        will-change: transform;
        /* Initial position handled by JS */
    }

    /* Icons inside knob */
    .knob-icon {
        position: absolute;
        width: 16px;
        height: 16px;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .knob-sun {
        color: #f59e0b;
    }

    .knob-moon {
        color: #3b82f6;
    }

    /* Dark mode: show sun, hide moon (knob slides right) */
    .dark .knob-sun {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }

    .dark .knob-moon {
        opacity: 0;
        transform: rotate(-90deg) scale(0.5);
    }

    /* Light mode: show moon, hide sun (knob slides left) */
    :root:not(.dark) .knob-sun {
        opacity: 0;
        transform: rotate(90deg) scale(0.5);
    }

    :root:not(.dark) .knob-moon {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }

    /* Sun rays animation */
    .sun-rays line {
        transform-origin: center;
        /* Remove CSS transition here as it conflicts with JS animation and causes "stuck" rays */
    }

    .dark .sun-rays line {
        opacity: 1;
        transform: scale(1);
    }

    :root:not(.dark) .sun-rays line {
        opacity: 0;
        transform: scale(0);
    }

    /* Hover effect */
    .theme-switch:hover .switch-knob {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25), 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {

        .switch-track,
        .switch-knob,
        .knob-icon,
        .sun-rays line {
            transition: none !important;
        }
    }
</style>