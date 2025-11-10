/**
 * Accessibility improvements
 *
 * @package WPCore
 */

export function initAccessibility() {
    // Skip link focus fix
    const skipLink = document.querySelector('.skip-link');
    if (skipLink) {
        skipLink.addEventListener('click', (e) => {
            const target = document.querySelector(e.target.getAttribute('href'));
            if (target) {
                target.setAttribute('tabindex', '-1');
                target.focus();
            }
        });
    }

    // Focus management for modals
    document.querySelectorAll('[data-modal]').forEach(modal => {
        modal.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                trapFocus(modal, e);
            }
        });
    });

    // Keyboard navigation for dropdowns
    const dropdownToggles = document.querySelectorAll('.menu-item-has-children > a');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const submenu = toggle.nextElementSibling;
                if (submenu) {
                    submenu.classList.toggle('is-open');
                }
            }
        });
    });
}

/**
 * Trap focus within an element
 */
function trapFocus(element, event) {
    const focusableElements = element.querySelectorAll(
        'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
    );

    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    if (event.shiftKey && document.activeElement === firstElement) {
        lastElement.focus();
        event.preventDefault();
    } else if (!event.shiftKey && document.activeElement === lastElement) {
        firstElement.focus();
        event.preventDefault();
    }
}
