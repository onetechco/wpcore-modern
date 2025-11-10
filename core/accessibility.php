<?php
/**
 * Accessibility enhancements
 * ARIA labels, live regions, and accessibility improvements
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Add ARIA live region for announcements
 */
function wpcore_aria_live_region() {
    ?>
    <div id="wpcore-aria-live" class="sr-only" aria-live="polite" aria-atomic="true" role="status"></div>
    <?php
}
add_action('wp_footer', 'wpcore_aria_live_region');

/**
 * Announce message to screen readers
 *
 * @param string $message Message to announce
 * @param string $priority Priority: polite or assertive (default: polite)
 */
function wpcore_announce($message, $priority = 'polite') {
    ?>
    <script>
    (function() {
        var liveRegion = document.getElementById('wpcore-aria-live');
        if (liveRegion) {
            liveRegion.setAttribute('aria-live', '<?php echo esc_js($priority); ?>');
            liveRegion.textContent = <?php echo wp_json_encode($message); ?>;
            // Clear after announcement
            setTimeout(function() {
                liveRegion.textContent = '';
            }, 1000);
        }
    })();
    </script>
    <?php
}

/**
 * Add skip link for keyboard navigation
 */
function wpcore_skip_link() {
    ?>
    <a class="skip-link sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-primary focus:text-white focus:rounded" href="#main-content">
        <?php esc_html_e('Skip to content', 'wpcore-modern'); ?>
    </a>
    <?php
}
add_action('wp_body_open', 'wpcore_skip_link');

/**
 * Add main content ID for skip link
 */
function wpcore_main_content_id($id) {
    return 'main-content';
}
add_filter('wpcore_main_content_id', 'wpcore_main_content_id');

/**
 * Ensure all images have alt text
 *
 * @param string $html Image HTML
 * @param int    $id   Attachment ID
 * @return string Modified HTML
 */
function wpcore_image_alt_text($html, $id) {
    $image_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    
    // If no alt text, use post title or filename
    if (empty($image_alt)) {
        $attachment = get_post($id);
        if ($attachment) {
            $image_alt = $attachment->post_title;
            if (empty($image_alt)) {
                $image_alt = get_the_title($id);
            }
        }
        
        // Update alt text
        if (!empty($image_alt)) {
            update_post_meta($id, '_wp_attachment_image_alt', $image_alt);
        }
    }
    
    // Ensure alt attribute exists
    if (strpos($html, 'alt=') === false) {
        $html = str_replace('<img ', '<img alt="' . esc_attr($image_alt) . '" ', $html);
    }
    
    return $html;
}
add_filter('wp_get_attachment_image', 'wpcore_image_alt_text', 10, 2);

/**
 * Add ARIA labels to navigation menus
 *
 * @param string $nav_menu Navigation menu HTML
 * @param object $args     Menu arguments
 * @return string Modified HTML
 */
function wpcore_nav_menu_aria_label($nav_menu, $args) {
    // Add aria-label if not present
    if (strpos($nav_menu, 'aria-label') === false) {
        $location = isset($args->theme_location) ? $args->theme_location : 'primary';
        $label = sprintf(__('%s navigation', 'wpcore-modern'), ucfirst($location));
        $nav_menu = str_replace('<nav', '<nav aria-label="' . esc_attr($label) . '"', $nav_menu);
    }
    
    return $nav_menu;
}
add_filter('wp_nav_menu', 'wpcore_nav_menu_aria_label', 10, 2);

/**
 * Add ARIA labels to search form
 *
 * @param string $form Search form HTML
 * @return string Modified HTML
 */
function wpcore_search_form_aria_label($form) {
    // Add aria-label to search input if not present
    if (strpos($form, 'aria-label') === false) {
        $form = str_replace(
            '<input type="search"',
            '<input type="search" aria-label="' . esc_attr__('Search', 'wpcore-modern') . '"',
            $form
        );
    }
    
    return $form;
}
add_filter('get_search_form', 'wpcore_search_form_aria_label');

/**
 * Add focus management for modals and dropdowns
 */
function wpcore_focus_management() {
    ?>
    <script>
    (function() {
        // Trap focus in modals
        function trapFocus(element) {
            var focusableElements = element.querySelectorAll(
                'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
            );
            var firstFocusable = focusableElements[0];
            var lastFocusable = focusableElements[focusableElements.length - 1];

            element.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusable) {
                            e.preventDefault();
                            lastFocusable.focus();
                        }
                    } else {
                        if (document.activeElement === lastFocusable) {
                            e.preventDefault();
                            firstFocusable.focus();
                        }
                    }
                }
                if (e.key === 'Escape') {
                    element.style.display = 'none';
                    // Return focus to trigger element
                    var trigger = document.querySelector('[data-modal-trigger="' + element.id + '"]');
                    if (trigger) {
                        trigger.focus();
                    }
                }
            });
        }

        // Initialize focus trap for modals
        document.querySelectorAll('[role="dialog"]').forEach(function(modal) {
            trapFocus(modal);
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'wpcore_focus_management');

/**
 * Add color contrast verification helper
 * 
 * Note: This is a helper function for developers to verify color contrast
 * Actual contrast checking should be done during design phase
 */
function wpcore_verify_color_contrast($foreground, $background) {
    // Convert hex to RGB
    $foreground_rgb = wpcore_hex_to_rgb($foreground);
    $background_rgb = wpcore_hex_to_rgb($background);
    
    // Calculate relative luminance
    $foreground_lum = wpcore_relative_luminance($foreground_rgb);
    $background_lum = wpcore_relative_luminance($background_rgb);
    
    // Calculate contrast ratio
    $lighter = max($foreground_lum, $background_lum);
    $darker = min($foreground_lum, $background_lum);
    $contrast = ($lighter + 0.05) / ($darker + 0.05);
    
    return array(
        'ratio' => round($contrast, 2),
        'wcag_aa' => $contrast >= 4.5,
        'wcag_aaa' => $contrast >= 7,
    );
}

/**
 * Convert hex color to RGB
 *
 * @param string $hex Hex color code
 * @return array RGB values
 */
function wpcore_hex_to_rgb($hex) {
    $hex = ltrim($hex, '#');
    return array(
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2)),
    );
}

/**
 * Calculate relative luminance
 *
 * @param array $rgb RGB values
 * @return float Relative luminance
 */
function wpcore_relative_luminance($rgb) {
    $r = $rgb['r'] / 255;
    $g = $rgb['g'] / 255;
    $b = $rgb['b'] / 255;
    
    $r = $r <= 0.03928 ? $r / 12.92 : pow(($r + 0.055) / 1.055, 2.4);
    $g = $g <= 0.03928 ? $g / 12.92 : pow(($g + 0.055) / 1.055, 2.4);
    $b = $b <= 0.03928 ? $b / 12.92 : pow(($b + 0.055) / 1.055, 2.4);
    
    return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
}

