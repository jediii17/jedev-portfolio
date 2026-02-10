/**
 * Typed Headline Animation
 * Creates a typewriter effect cycling through phrases
 */

export class TypedHeadline {
    constructor(element, options = {}) {
        this.element = element;
        this.phrases = options.phrases || ['Hello'];
        this.typeSpeed = options.typeSpeed || 80;
        this.deleteSpeed = options.deleteSpeed || 50;
        this.pauseDuration = options.pauseDuration || 2000;
        this.cursorChar = options.cursorChar || '|';
        this.loop = options.loop !== false;

        this.currentPhraseIndex = 0;
        this.currentCharIndex = 0;
        this.isDeleting = false;
        this.isPaused = false;

        // Respect prefers-reduced-motion
        this.prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Create a text node and cursor inside the element
        // so they move together when the element is position: absolute
        this.textNode = document.createTextNode('');
        this.cursor = document.createElement('span');
        this.cursor.className = 'typed-cursor';
        this.cursor.textContent = this.cursorChar;
        this.cursor.setAttribute('aria-hidden', 'true');

        // Clear element and append text node + cursor inside it
        this.element.textContent = '';
        this.element.appendChild(this.textNode);
        this.element.appendChild(this.cursor);

        // Start animation
        if (this.prefersReducedMotion) {
            // Just show first phrase without animation
            this.textNode.textContent = this.phrases[0];
        } else {
            this.tick();
        }
    }

    tick() {
        const currentPhrase = this.phrases[this.currentPhraseIndex];

        if (this.isDeleting) {
            this.currentCharIndex--;
        } else {
            this.currentCharIndex++;
        }

        // Update only the text node, cursor stays in place
        this.textNode.textContent = currentPhrase.substring(0, this.currentCharIndex);

        // Determine next action
        let timeout = this.isDeleting ? this.deleteSpeed : this.typeSpeed;

        if (!this.isDeleting && this.currentCharIndex === currentPhrase.length) {
            // Finished typing, pause then delete
            timeout = this.pauseDuration;
            this.isDeleting = true;
        } else if (this.isDeleting && this.currentCharIndex === 0) {
            // Finished deleting, move to next phrase
            this.isDeleting = false;
            this.currentPhraseIndex = (this.currentPhraseIndex + 1) % this.phrases.length;

            if (!this.loop && this.currentPhraseIndex === 0) {
                // Stop if not looping
                return;
            }
            timeout = 500; // Brief pause before typing next
        }

        setTimeout(() => this.tick(), timeout);
    }

    destroy() {
        if (this.cursor && this.cursor.parentNode) {
            this.cursor.parentNode.removeChild(this.cursor);
        }
    }
}

/**
 * Initialize typed headlines
 */
export function initTypedHeadlines() {
    const elements = document.querySelectorAll('[data-typed]');

    elements.forEach(el => {
        const phrasesAttr = el.dataset.typedPhrases;
        const phrases = phrasesAttr ? phrasesAttr.split('|') : ['Hello World'];

        new TypedHeadline(el, {
            phrases,
            typeSpeed: parseInt(el.dataset.typeSpeed) || 80,
            deleteSpeed: parseInt(el.dataset.deleteSpeed) || 50,
            pauseDuration: parseInt(el.dataset.pauseDuration) || 2000,
        });
    });
}

export default TypedHeadline;
