<?php
/**
 * Widget areas
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Register widget areas
 */
function wpcore_widgets_init() {
    /**
     * Sidebar widget area
     */
    register_sidebar(array(
        'name'          => __('Sidebar', 'wpcore-modern'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'wpcore-modern'),
        'before_widget' => '<section id="%1$s" class="widget mb-8 %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title text-xl font-bold mb-4">',
        'after_title'   => '</h3>',
    ));

    /**
     * Footer widget areas (4 columns for full footer)
     */
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer %d', 'wpcore-modern'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('Add widgets here to appear in footer column %d.', 'wpcore-modern'), $i),
            'before_widget' => '<div id="%1$s" class="widget mb-6 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title text-lg font-semibold mb-4 text-white">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'wpcore_widgets_init');
