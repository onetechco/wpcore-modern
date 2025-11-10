<?php
/**
 * Enqueue scripts and styles
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Enqueue front-end scripts and styles
 */
function wpcore_enqueue_assets() {
    $version = WPCORE_VERSION;
    $is_dev = defined('WP_ENV') && WP_ENV === 'development';

    /**
     * Main stylesheet
     * Use timestamp in dev mode for cache busting
     */
    wp_enqueue_style(
        'wpcore-style',
        WPCORE_DIST . '/css/style.css',
        array(),
        $is_dev ? time() : $version
    );

    /**
     * Main JavaScript
     * Check if minified version exists, otherwise use regular version
     */
    $js_file = 'main.js';
    if (!$is_dev) {
        $min_file = WPCORE_DIR . '/assets/dist/js/main.min.js';
        if (file_exists($min_file)) {
            $js_file = 'main.min.js';
        }
    }
    
    wp_enqueue_script(
        'wpcore-script',
        WPCORE_DIST . '/js/' . $js_file,
        array(),
        $is_dev ? time() : $version,
        true
    );

    /**
     * Pass data to JavaScript
     */
    wp_localize_script('wpcore-script', 'wpcore', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('wpcore-nonce'),
        'siteUrl' => home_url('/'),
        'themePath' => WPCORE_URI,
        'isAdmin' => is_admin(),
    ));

    /**
     * Comment reply script
     */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wpcore_enqueue_assets');

/**
 * Enqueue block editor assets
 */
function wpcore_enqueue_block_editor_assets() {
    $version = WPCORE_VERSION;
    $is_dev = defined('WP_ENV') && WP_ENV === 'development';

    /**
     * Block editor styles
     */
    wp_enqueue_style(
        'wpcore-editor-style',
        WPCORE_DIST . '/css/editor.css',
        array(),
        $is_dev ? time() : $version
    );

    /**
     * Block editor script
     * Check if minified version exists, otherwise use regular version
     */
    $editor_js_file = 'block-editor.js';
    if (!$is_dev) {
        $editor_min_file = WPCORE_DIR . '/assets/dist/js/block-editor.min.js';
        if (file_exists($editor_min_file)) {
            $editor_js_file = 'block-editor.min.js';
        }
    }
    
    wp_enqueue_script(
        'wpcore-block-editor',
        WPCORE_DIST . '/js/' . $editor_js_file,
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        $is_dev ? time() : $version,
        true
    );
}
add_action('enqueue_block_editor_assets', 'wpcore_enqueue_block_editor_assets');

/**
 * Add preload for critical assets
 */
function wpcore_preload_assets() {
    echo '<link rel="preload" href="' . esc_url(WPCORE_DIST . '/css/style.css') . '" as="style">' . "\n";
}
add_action('wp_head', 'wpcore_preload_assets', 1);

/**
 * Add resource hints (preconnect/prefetch) for performance
 */
function wpcore_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        // Preconnect to Google Fonts if using external fonts
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    
    if ('dns-prefetch' === $relation_type) {
        // DNS prefetch for external resources
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    
    return $urls;
}
add_filter('wp_resource_hints', 'wpcore_resource_hints', 10, 2);
