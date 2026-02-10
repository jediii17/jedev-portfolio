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
    'Frontend': { bg: '#3b82f6', text: '#ffffff' },       // blue
    'Backend': { bg: '#22c55e', text: '#ffffff' },         // green
    'Frameworks': { bg: '#a855f7', text: '#ffffff' },      // purple
    'DevOps & Cloud': { bg: '#f97316', text: '#ffffff' },  // orange
    'Other': { bg: '#ec4899', text: '#ffffff' },           // pink
};

let engine, render, runner;
let hasStarted = false;

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

    // Jar walls (thicker for solid feel)
    const wallThickness = 20;
    const jarInset = Math.min(width * 0.08, 60);           // Side inset from container edge
    const jarBottom = height - wallThickness / 2;
    const jarLeft = jarInset;
    const jarRight = width - jarInset;
    const jarWidth = jarRight - jarLeft;

    const wallOptions = {
        isStatic: true,
        render: {
            fillStyle: 'transparent',
            strokeStyle: 'transparent',
        },
        friction: 0.3,
        restitution: 0.2,
    };

    const floor = Bodies.rectangle(width / 2, jarBottom, jarWidth + wallThickness, wallThickness, wallOptions);
    const leftWall = Bodies.rectangle(jarLeft - wallThickness / 2, height / 2, wallThickness, height, wallOptions);
    const rightWall = Bodies.rectangle(jarRight + wallThickness / 2, height / 2, wallThickness, height, wallOptions);

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

    // Build block bodies (4 per category)
    const blocks = [];
    const blockBodies = [];
    const blockWidth = Math.min(120, (jarWidth - 40) / 4);
    const blockHeight = 40;

    Object.entries(techData).forEach(([category, items]) => {
        const colors = CATEGORY_COLORS[category] || { bg: '#6b7280', text: '#ffffff' };
        const limitedItems = items.slice(0, 4);

        limitedItems.forEach((item) => {
            const x = jarLeft + 30 + Math.random() * (jarWidth - 60);
            const y = -50 - Math.random() * 400;  // Start above the jar

            const body = Bodies.rectangle(x, y, blockWidth, blockHeight, {
                chamfer: { radius: 8 },
                render: { fillStyle: colors.bg },
                friction: 0.5,
                restitution: 0.3,
                density: 0.002,
                angle: (Math.random() - 0.5) * 0.5,
            });

            blocks.push({ body, label: item, colors, category });
            blockBodies.push(body);
        });
    });

    // Mouse interaction (drag blocks)
    const mouse = Mouse.create(canvas);
    const mouseConstraint = MouseConstraint.create(engine, {
        mouse: mouse,
        constraint: {
            stiffness: 0.2,
            render: { visible: false },
        },
    });

    // Keep mouse in sync with render
    render.mouse = mouse;

    // Fix mouse offset for CSS-scaled canvas
    mouse.element.removeEventListener('mousewheel', mouse.mousewheel);
    mouse.element.removeEventListener('DOMMouseScroll', mouse.mousewheel);

    // Custom afterRender: draw labels on blocks
    Events.on(render, 'afterRender', () => {
        const ctx = render.context;

        blocks.forEach(({ body, label, colors }) => {
            const { x, y } = body.position;
            const angle = body.angle;

            ctx.save();
            ctx.translate(x, y);
            ctx.rotate(angle);

            // Block dimensions
            const w = blockWidth;
            const h = blockHeight;
            const r = 8;

            // Rounded rect (extra layer for crispness if needed, but Matter already drew the body)
            // But we redraw it to ensure our label is centered on our own rect
            ctx.beginPath();
            ctx.roundRect(-w / 2, -h / 2, w, h, r);
            ctx.fillStyle = colors.bg;
            ctx.fill();

            // Subtle border
            ctx.strokeStyle = 'rgba(255,255,255,0.2)';
            ctx.lineWidth = 1;
            ctx.stroke();

            // Text label
            ctx.fillStyle = '#ffffff';
            ctx.font = `600 ${Math.max(11, Math.min(14, blockWidth / (label.length * 0.8)))}px 'Inter', sans-serif`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            // Slight shadow for depth
            ctx.shadowColor = 'rgba(0,0,0,0.2)';
            ctx.shadowBlur = 4;
            ctx.shadowOffsetY = 1;

            ctx.fillText(label, 0, 0);

            ctx.restore();
        });
    });

    // Draw jar outline (glass effect) 
    Events.on(render, 'afterRender', () => {
        const ctx = render.context;
        const pixelRatio = render.options.pixelRatio || 1;
        const jl = jarLeft * pixelRatio;
        const jr = jarRight * pixelRatio;
        const jb = (jarBottom - wallThickness / 2) * pixelRatio;
        const jt = 0;

        ctx.save();
        ctx.strokeStyle = 'rgba(255,255,255,0.08)';
        ctx.lineWidth = 2 * pixelRatio;
        ctx.lineCap = 'round';

        // Left wall
        ctx.beginPath();
        ctx.moveTo(jl, jt);
        ctx.lineTo(jl, jb);
        ctx.stroke();

        // Right wall
        ctx.beginPath();
        ctx.moveTo(jr, jt);
        ctx.lineTo(jr, jb);
        ctx.stroke();

        // Bottom
        ctx.beginPath();
        ctx.moveTo(jl, jb);
        ctx.lineTo(jr, jb);
        ctx.stroke();

        ctx.restore();
    });

    // Start renderer (but don't drop blocks yet)
    Render.run(render);
    runner = Runner.create();

    // ScrollTrigger: drop blocks when section is visible
    ScrollTrigger.create({
        trigger: container,
        start: 'top 70%',
        once: true,
        onEnter: () => {
            if (hasStarted) return;
            hasStarted = true;

            Runner.run(runner, engine);

            // Stagger add blocks with delays
            blockBodies.forEach((body, i) => {
                setTimeout(() => {
                    Composite.add(engine.world, body);
                }, i * 80);
            });

            // Add mouse constraint after blocks start falling
            setTimeout(() => {
                Composite.add(engine.world, mouseConstraint);
            }, blockBodies.length * 80 + 500);
        },
    });

    // Handle resize
    const handleResize = () => {
        const newWidth = container.clientWidth;
        const newHeight = container.clientHeight;
        canvas.width = newWidth;
        canvas.height = newHeight;
        render.options.width = newWidth;
        render.options.height = newHeight;
        render.canvas.width = newWidth * (render.options.pixelRatio || 1);
        render.canvas.height = newHeight * (render.options.pixelRatio || 1);
    };

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 300);
    });
}

export default { initTechJar };
