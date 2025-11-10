/**
 * Block Editor enhancements
 *
 * @package WPCore
 */

// Wait for WordPress to be ready
wp.domReady(() => {
    console.log('Block editor enhancements loaded');

    // Register block variations if needed
    // Example: Custom button variations
    // wp.blocks.registerBlockVariation('core/button', {
    //     name: 'primary-button',
    //     title: 'Primary Button',
    //     attributes: {
    //         className: 'btn-primary'
    //     }
    // });
});
