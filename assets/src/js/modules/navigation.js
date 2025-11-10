/**
 * Navigation functionality
 *
 * @package WPCore
 */

export function initNavigation() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('#mobile-navigation');
    const mobileOverlay = document.querySelector('#mobile-menu-overlay');
    const body = document.body;

    if (!mobileMenuToggle || !mobileMenu) {
        return;
    }

    // Toggle mobile menu
    mobileMenuToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';

        mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
        body.classList.toggle('overflow-hidden');
        
        // Toggle overlay
        if (mobileOverlay) {
            if (isExpanded) {
                mobileOverlay.classList.remove('active');
            } else {
                mobileOverlay.classList.add('active');
            }
        }

        // Update icon
        const icon = mobileMenuToggle.querySelector('svg');
        if (icon) {
            if (isExpanded) {
                // Hamburger icon
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            } else {
                // Close icon
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            }
        }
    });

    // Close mobile menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            mobileMenuToggle.click();
        }
    });

    // Close mobile menu when clicking overlay
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', () => {
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenuToggle.click();
            }
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!mobileMenu.classList.contains('hidden') &&
            !mobileMenu.contains(e.target) &&
            !mobileMenuToggle.contains(e.target) &&
            !mobileOverlay?.contains(e.target)) {
            mobileMenuToggle.click();
        }
    });

    // Submenu toggles
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');
    menuItemsWithChildren.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            link.addEventListener('click', (e) => {
                // Only on mobile
                if (window.innerWidth < 1024) {
                    e.preventDefault();
                    item.classList.toggle('is-open');
                }
            });
        }
    });

    // Sticky header
    let lastScroll = 0;
    const header = document.querySelector('.site-header');

    if (header) {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    }
}
