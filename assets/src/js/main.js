/**
 * Main JavaScript entry point
 *
 * @package WPCore
 */

// Import modules
import { initNavigation } from './modules/navigation.js';
import { initAccessibility } from './modules/accessibility.js';
import { initLazyLoad } from './modules/lazy-load.js';

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initNavigation();
    initAccessibility();
    initLazyLoad();

    console.log('WPCore Modern theme loaded successfully');
});
