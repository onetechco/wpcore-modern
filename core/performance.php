<?php
/**
 * Performance optimizations
 * Content Security Policy, caching, and performance enhancements
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Add Content Security Policy headers
 * 
 * Note: Adjust CSP rules based on your needs
 * For production, use stricter rules
 */
function wpcore_content_security_policy() {
    // Only add CSP in production
    if (defined('WP_DEBUG') && WP_DEBUG) {
        return;
    }

    $csp = array(
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com",
        "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
        "font-src 'self' https://fonts.gstatic.com data:",
        "img-src 'self' data: https: blob:",
        "connect-src 'self'",
        "frame-src 'self'",
        "object-src 'none'",
        "base-uri 'self'",
        "form-action 'self'",
        "frame-ancestors 'self'",
        "upgrade-insecure-requests",
    );

    $csp_string = implode('; ', $csp);
    
    header("Content-Security-Policy: {$csp_string}");
}
add_action('send_headers', 'wpcore_content_security_policy');

/**
 * Add security headers
 */
function wpcore_security_headers() {
    // X-Content-Type-Options
    header('X-Content-Type-Options: nosniff');
    
    // X-Frame-Options
    header('X-Frame-Options: SAMEORIGIN');
    
    // X-XSS-Protection
    header('X-XSS-Protection: 1; mode=block');
    
    // Referrer-Policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Permissions-Policy
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}
add_action('send_headers', 'wpcore_security_headers');

/**
 * Disable emoji scripts (performance optimization)
 */
function wpcore_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove DNS prefetch for emoji
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'wpcore_disable_emojis');

/**
 * Remove unnecessary WordPress features for performance
 */
function wpcore_remove_unnecessary_features() {
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove wlwmanifest.xml
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
    
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove REST API link
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'wpcore_remove_unnecessary_features');

/**
 * Optimize WordPress queries
 */
function wpcore_optimize_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Limit post revisions
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 3);
        }
        
        // Optimize autoload options
        if (!defined('AUTOSAVE_INTERVAL')) {
            define('AUTOSAVE_INTERVAL', 300); // 5 minutes
        }
    }
}
add_action('pre_get_posts', 'wpcore_optimize_queries');

/**
 * Add async/defer to scripts
 */
function wpcore_script_loader_tag($tag, $handle, $src) {
    // Add defer to non-critical scripts
    $defer_scripts = array(
        'wpcore-script',
    );
    
    if (in_array($handle, $defer_scripts, true)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'wpcore_script_loader_tag', 10, 3);

/**
 * Lazy load images (if not using native lazy loading)
 */
function wpcore_lazy_load_images($content) {
    if (is_admin() || is_feed()) {
        return $content;
    }
    
    // Check if native lazy loading is supported
    if (function_exists('wp_lazy_loading_enabled') && wp_lazy_loading_enabled('img', 'the_content')) {
        return $content;
    }
    
    // Add loading="lazy" to images without it
    $content = preg_replace_callback(
        '/<img([^>]+?)(?:\s+loading=["\'](lazy|eager)["\'])?([^>]*?)>/i',
        function($matches) {
            if (isset($matches[2]) && $matches[2]) {
                return $matches[0]; // Already has loading attribute
            }
            return '<img' . $matches[1] . ' loading="lazy"' . $matches[3] . '>';
        },
        $content
    );
    
    return $content;
}
add_filter('the_content', 'wpcore_lazy_load_images', 10);

