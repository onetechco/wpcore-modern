<?php
/**
 * Block Patterns
 * Register custom block patterns for the theme
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Register block patterns
 */
function wpcore_register_block_patterns() {
    // Register pattern category
    register_block_pattern_category(
        'wpcore-modern',
        array('label' => __('WPCore Modern', 'wpcore-modern'))
    );

    /**
     * Hero Pattern
     */
    register_block_pattern(
        'wpcore-modern/hero',
        array(
            'title'       => __('Hero Section', 'wpcore-modern'),
            'description' => __('A hero section with title, description, and call-to-action buttons.', 'wpcore-modern'),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"linear-gradient(135deg, #667eea 0%, #764ba2 100%)"}},"textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-text-color" style="padding-top:5rem;padding-bottom:5rem;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem","fontWeight":"800"}},"textColor":"white"} -->
<h1 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:4rem;font-weight:800">Welcome to WPCore Modern</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="font-size:1.25rem">A modern, lightweight WordPress starter theme built with Tailwind CSS 4.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"white","textColor":"primary","style":{"border":{"radius":"0.5rem"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:0.5rem">Get Started</a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"white","style":{"border":{"radius":"0.5rem","width":"2px","color":"white"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-border-color wp-element-button" style="border-radius:0.5rem;border-width:2px;border-color:white">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
            'categories'  => array('wpcore-modern', 'header'),
        )
    );

    /**
     * Features Pattern
     */
    register_block_pattern(
        'wpcore-modern/features',
        array(
            'title'       => __('Features Section', 'wpcore-modern'),
            'description' => __('A features section with three columns.', 'wpcore-modern'),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:5rem;padding-bottom:5rem"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="font-size:2.5rem;font-weight:800">Key Features</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem"}},"textColor":"gray-600"} -->
<p class="has-text-align-center has-gray-600-color has-text-color" style="font-size:1.125rem">Everything you need to build a modern WordPress website</p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"3rem"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:3rem"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Modern Stack</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Built with Tailwind CSS 4, PostCSS, and esbuild for fast development and optimized builds.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Performance</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Minimal dependencies, optimized bundle sizes, and lazy loading for the best performance.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Developer Experience</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Clean code structure, reusable components, and easy customization for developers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
            'categories'  => array('wpcore-modern', 'featured'),
        )
    );

    /**
     * CTA Pattern
     */
    register_block_pattern(
        'wpcore-modern/cta',
        array(
            'title'       => __('Call to Action', 'wpcore-modern'),
            'description' => __('A call-to-action section with gradient background.', 'wpcore-modern'),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem"}},"color":{"background":"linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)"}},"textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-text-color" style="padding-top:5rem;padding-bottom:5rem;background:linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"2.5rem","fontWeight":"800"}},"textColor":"white"} -->
<h2 class="wp-block-heading has-text-align-center has-white-color has-text-color" style="font-size:2.5rem;font-weight:800">Ready to Get Started?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem"}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="font-size:1.125rem">Start building your modern WordPress website today with WPCore Modern theme.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"textColor":"white","style":{"border":{"radius":"0.5rem","width":"2px","color":"white"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-border-color wp-element-button" style="border-radius:0.5rem;border-width:2px;border-color:white">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
            'categories'  => array('wpcore-modern', 'call-to-action'),
        )
    );
}
add_action('init', 'wpcore_register_block_patterns');

