/**
 * Tech Stack Jar — 2D Physics Falling Blocks
 * Uses Matter.js to simulate colored blocks falling into a jar-shaped container.
 */

import Matter from 'matter-js';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

const { Engine, Render, Runner, Bodies, Composite, Mouse, MouseConstraint, Events, Body } = Matter;

// Category color map
const CATEGORY_COLORS = {
    'Frontend': { bg: '#3b82f6', text: '#ffffff' },              // blue
    'Backend': { bg: '#22c55e', text: '#ffffff' },               // green
    'AI & Machine Learning': { bg: '#a855f7', text: '#ffffff' }, // purple
    'DevOps & Tools': { bg: '#f97316', text: '#ffffff' },        // orange
};

let engine, render, runner;
let hasStarted = false;
let activeCategory = null;

/**
 * Initialize the Tech Jar physics simulation
 */
export function initTechJar() {
    const container = document.getElementById('tech-jar-container');
    const canvas = document.getElementById('tech-jar-canvas');
    if (!container || !canvas) return;

    const width = container.clientWidth;
    const height = container.clientHeight;

    canvas.width = width;
    canvas.height = height;

    // Create engine
    engine = Engine.create({
        gravity: { x: 0, y: 1.2 },
    });

    // Create renderer
    render = Render.create({
        canvas: canvas,
        engine: engine,
        options: {
            width: width,
            height: height,
            wireframes: false,
            background: 'transparent',
            pixelRatio: window.devicePixelRatio || 1,
        },
    });

    // Full-width walls
    const wallThickness = 60;
    const wallOptions = {
        isStatic: true,
        render: {
            fillStyle: 'transparent',
            strokeStyle: 'transparent',
        },
        friction: 0.3,
        restitution: 0.2,
    };

    const floor = Bodies.rectangle(width / 2, height + wallThickness / 2, width + wallThickness, wallThickness, wallOptions);
    const leftWall = Bodies.rectangle(-wallThickness / 2, height / 2, wallThickness, height * 2, wallOptions);
    const rightWall = Bodies.rectangle(width + wallThickness / 2, height / 2, wallThickness, height * 2, wallOptions);

    Composite.add(engine.world, [floor, leftWall, rightWall]);

    // Parse tech data from DOM
    const dataEl = document.getElementById('tech-jar-data');
    if (!dataEl) return;

    let techData;
    try {
        techData = JSON.parse(dataEl.textContent);
    } catch (e) {
        console.error('Failed to parse tech jar data:', e);
        return;
    }

    // Emoji ideas
    const emojis = ['🚀', '💻', '⚡', '🎨', '🛠️', '📱', '🌐', '🔥', '✨', '🧠', '⚙️', '🔋', '🌈', '👾', '🎮', '💡', '📚', '🎯', '🙈', '👨🏻‍💻'];

    // Build block bodies
    const blocks = [];
    const blockBodies = [];

    // Config for larger, rounder blocks
    const blockHeight = 78; // Increased from 52
    const radius = 40;      // Increased from 20
    const fontSize = 24;    // Increased from 14

    // Use a temporary context to measure text precisely
    const tempCanvas = document.createElement('canvas');
    const tempCtx = tempCanvas.getContext('2d');
    tempCtx.font = `bold ${fontSize}px 'Space Grotesk', sans-serif`;

    // Add tech blocks
    Object.entries(techData).forEach(([category, items]) => {
        const colors = CATEGORY_COLORS[category] || { bg: '#6b7280', text: '#ffffff' };

        items.forEach((item) => {
            const textWidth = tempCtx.measureText(item).width;
            const blockWidth = textWidth + 50; // Dynamic width with padding

            const x = Math.random() * (width - 200) + 100;
            const y = -100 - Math.random() * 500;

            const body = Bodies.rectangle(x, y, blockWidth, blockHeight, {
                chamfer: { radius: radius },
                render: { fillStyle: colors.bg },
                friction: 0.5,
                restitution: 0.4,
                density: 0.002,
                angle: (Math.random() - 0.5) * 1,
            });

            blocks.push({ type: 'text', body, label: item, colors, category });
            blockBodies.push(body);
        });
    });

    // Add emoji blocks
    for (let i = 1; i < 18; i++) {
        const emoji = emojis[Math.floor(Math.random() * emojis.length)];
        const emojiSize = 65;
        const x = Math.random() * (width - 100) + 50;
        const y = -200 - Math.random() * 800;

        const body = Bodies.circle(x, y, emojiSize / 2, {
            render: {}, // No background
            friction: 0.3,
            restitution: 0.6,
            density: 0.001,
        });

        blocks.push({ type: 'emoji', body, label: emoji, size: emojiSize, category: null });
        blockBodies.push(body);
    }

    // Shuffle blocks + blockBodies together (Fisher-Yates) for random fall order
    for (let i = blocks.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [blocks[i], blocks[j]] = [blocks[j], blocks[i]];
        [blockBodies[i], blockBodies[j]] = [blockBodies[j], blockBodies[i]];
    }

    // Mouse interaction
    const mouse = Mouse.create(canvas);
    const mouseConstraint = MouseConstraint.create(engine, {
        mouse: mouse,
        constraint: {
            stiffness: 0.2,
            render: { visible: false },
        },
    });

    render.mouse = mouse;
    mouse.element.removeEventListener('mousewheel', mouse.mousewheel);
    mouse.element.removeEventListener('DOMMouseScroll', mouse.mousewheel);

    // Custom draw loop with highlight support
    Events.on(render, 'afterRender', () => {
        const ctx = render.context;

        blocks.forEach((block) => {
            const { body, type, label, colors, size, category } = block;
            const { x, y } = body.position;
            const angle = body.angle;

            // Determine if this block should be highlighted or dimmed
            const isHighlighted = activeCategory && category === activeCategory;
            const isDimmed = activeCategory && category !== activeCategory;
            const dimOpacity = isDimmed ? 0.15 : 1;

            ctx.save();
            ctx.translate(x, y);
            ctx.rotate(angle);
            ctx.globalAlpha = dimOpacity;

            if (type === 'text') {
                const w = body.bounds.max.x - body.bounds.min.x;
                const h = blockHeight;

                // Glow effect for highlighted blocks
                if (isHighlighted) {
                    ctx.shadowColor = colors.bg;
                    ctx.shadowBlur = 20;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 0;
                }

                // Redraw rounded rect for crispness
                ctx.beginPath();
                ctx.roundRect(-w / 2, -h / 2, w, h, radius);
                ctx.fillStyle = colors.bg;
                ctx.fill();

                // Reset shadow before drawing other elements
                ctx.shadowColor = 'transparent';
                ctx.shadowBlur = 0;

                // Glass shine
                const gradient = ctx.createLinearGradient(0, -h / 2, 0, h / 2);
                gradient.addColorStop(0, 'rgba(255,255,255,0.15)');
                gradient.addColorStop(0.5, 'rgba(255,255,255,0)');
                ctx.fillStyle = gradient;
                ctx.fill();

                // Highlighted border ring
                if (isHighlighted) {
                    ctx.strokeStyle = 'rgba(255,255,255,0.5)';
                    ctx.lineWidth = 2.5;
                } else {
                    ctx.strokeStyle = 'rgba(255,255,255,0.1)';
                    ctx.lineWidth = 1;
                }
                ctx.stroke();

                // Text
                ctx.fillStyle = '#ffffff';
                ctx.font = `bold ${fontSize}px 'Inter', sans-serif`;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(label, 0, 1);
            } else if (type === 'emoji') {
                ctx.font = `${size}px serif`;
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(label, 0, 0);
            }

            ctx.restore();
        });
    });

    // Start
    Render.run(render);
    runner = Runner.create();

    ScrollTrigger.create({
        trigger: container,
        start: 'top 75%',
        once: true,
        onEnter: () => {
            if (hasStarted) return;
            hasStarted = true;
            Runner.run(runner, engine);

            blockBodies.forEach((body, i) => {
                setTimeout(() => {
                    Composite.add(engine.world, body);
                }, i * 60);
            });

            setTimeout(() => {
                Composite.add(engine.world, mouseConstraint);
            }, blockBodies.length * 60 + 500);
        },
    });

    const handleResize = () => {
        const newWidth = container.clientWidth;
        const newHeight = container.clientHeight;
        canvas.width = newWidth;
        canvas.height = newHeight;
        render.options.width = newWidth;
        render.options.height = newHeight;
        render.canvas.width = newWidth * (render.options.pixelRatio || 1);
        render.canvas.height = newHeight * (render.options.pixelRatio || 1);

        // Update floor position
        Body.setPosition(floor, { x: newWidth / 2, y: newHeight + wallThickness / 2 });
        Body.setPosition(rightWall, { x: newWidth + wallThickness / 2, y: newHeight / 2 });
    };

    window.addEventListener('resize', handleResize);

    // --- Legend click handler ---
    const legendContainer = document.getElementById('tech-jar-legend');
    if (legendContainer) {
        const legendBtns = legendContainer.querySelectorAll('.tech-legend-btn');

        legendBtns.forEach((btn) => {
            const color = btn.dataset.color;
            // Set CSS custom property for active glow color
            btn.style.setProperty('--legend-color', color);

            btn.addEventListener('click', () => {
                const category = btn.dataset.category;

                if (activeCategory === category) {
                    // Deselect
                    activeCategory = null;
                    btn.classList.remove('active');
                } else {
                    // Deactivate all, activate this one
                    activeCategory = category;
                    legendBtns.forEach((b) => b.classList.remove('active'));
                    btn.classList.add('active');
                }
            });
        });
    }
}

export default { initTechJar };
