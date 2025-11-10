<?php
/**
 * Template parts helper functions
 * Functions to get header and footer template parts
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Get header template part
 * 
 * @param string $template Template name: default, transparent, minimal
 * @return void
 */
function wpcore_get_header_part($template = 'default') {
    get_template_part('template-parts/header/header', $template);
}

/**
 * Get footer template part
 * 
 * @param string $template Template name: default, minimal, full
 * @return void
 */
function wpcore_get_footer_part($template = 'default') {
    get_template_part('template-parts/footer/footer', $template);
}

/**
 * Determine which header template to use
 * 
 * @return string Header template name
 */
function wpcore_get_header_template() {
    // Check for page template
    if (is_page_template('page-templates/template-fullwidth-transparent-header.php')) {
        return 'transparent';
    }
    
    // Check for custom meta
    if (is_page() || is_single()) {
        $header_template = get_post_meta(get_the_ID(), '_wpcore_header_template', true);
        if ($header_template) {
            return $header_template;
        }
    }
    
    // Default
    return 'default';
}

/**
 * Determine which footer template to use
 * 
 * @return string Footer template name
 */
function wpcore_get_footer_template() {
    // Check for custom meta
    if (is_page() || is_single()) {
        $footer_template = get_post_meta(get_the_ID(), '_wpcore_footer_template', true);
        if ($footer_template) {
            return $footer_template;
        }
    }
    
    // Check if footer-4 has widgets (use full footer)
    if (is_active_sidebar('footer-4')) {
        return 'full';
    }
    
    // Check if any footer widgets exist
    if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) {
        return 'default';
    }
    
    // Minimal footer if no widgets
    return 'minimal';
}

