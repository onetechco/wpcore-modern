<?php
/**
 * Security enhancements
 * Input validation, AJAX handlers, and security checks
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Validate and sanitize user input
 *
 * @param mixed  $input Input value to validate
 * @param string $type  Input type: text, email, url, int, float, textarea
 * @return mixed Sanitized value or false on failure
 */
function wpcore_validate_input($input, $type = 'text') {
    if (null === $input || '' === $input) {
        return false;
    }

    switch ($type) {
        case 'text':
            return sanitize_text_field($input);
        
        case 'email':
            return sanitize_email($input);
        
        case 'url':
            return esc_url_raw($input);
        
        case 'int':
            return absint($input);
        
        case 'float':
            return floatval($input);
        
        case 'textarea':
            return sanitize_textarea_field($input);
        
        case 'html':
            return wp_kses_post($input);
        
        case 'slug':
            return sanitize_title($input);
        
        default:
            return sanitize_text_field($input);
    }
}

/**
 * Verify AJAX nonce
 *
 * @param string $nonce  Nonce value
 * @param string $action Action name
 * @return bool True if valid, false otherwise
 */
function wpcore_verify_ajax_nonce($nonce, $action = 'wpcore-nonce') {
    return wp_verify_nonce($nonce, $action);
}

/**
 * Check user capability for AJAX request
 *
 * @param string $capability Capability to check
 * @return bool True if user has capability, false otherwise
 */
function wpcore_check_ajax_capability($capability = 'read') {
    return current_user_can($capability);
}

/**
 * Send JSON response with error
 *
 * @param string $message Error message
 * @param int    $code    Error code (default: 400)
 */
function wpcore_ajax_error($message, $code = 400) {
    wp_send_json_error(
        array(
            'message' => sanitize_text_field($message),
        ),
        $code
    );
}

/**
 * Send JSON response with success
 *
 * @param mixed $data Response data
 * @param int   $code Response code (default: 200)
 */
function wpcore_ajax_success($data = array(), $code = 200) {
    wp_send_json_success($data, $code);
}

/**
 * Example AJAX handler - Contact form submission
 * 
 * Usage: Add this to your JavaScript:
 * jQuery.post(wpcore.ajaxUrl, {
 *     action: 'wpcore_contact_form',
 *     nonce: wpcore.nonce,
 *     name: name,
 *     email: email,
 *     message: message
 * });
 */
function wpcore_ajax_contact_form() {
    // Verify nonce
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wpcore_verify_ajax_nonce($nonce, 'wpcore-nonce')) {
        wpcore_ajax_error(__('Security check failed. Please refresh the page and try again.', 'wpcore-modern'), 403);
    }

    // Validate inputs
    $name = isset($_POST['name']) ? wpcore_validate_input($_POST['name'], 'text') : '';
    $email = isset($_POST['email']) ? wpcore_validate_input($_POST['email'], 'email') : '';
    $message = isset($_POST['message']) ? wpcore_validate_input($_POST['message'], 'textarea') : '';

    // Check required fields
    if (empty($name) || empty($email) || empty($message)) {
        wpcore_ajax_error(__('Please fill in all required fields.', 'wpcore-modern'), 400);
    }

    // Validate email format
    if (!is_email($email)) {
        wpcore_ajax_error(__('Please enter a valid email address.', 'wpcore-modern'), 400);
    }

    // Process form (example: send email)
    $to = get_option('admin_email');
    $subject = sprintf(__('New contact form submission from %s', 'wpcore-modern'), $name);
    $body = sprintf(
        __("Name: %s\nEmail: %s\n\nMessage:\n%s", 'wpcore-modern'),
        $name,
        $email,
        $message
    );
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wpcore_ajax_success(
            array(
                'message' => __('Thank you! Your message has been sent.', 'wpcore-modern'),
            ),
            200
        );
    } else {
        wpcore_ajax_error(__('Sorry, there was an error sending your message. Please try again later.', 'wpcore-modern'), 500);
    }
}
add_action('wp_ajax_wpcore_contact_form', 'wpcore_ajax_contact_form');
add_action('wp_ajax_nopriv_wpcore_contact_form', 'wpcore_ajax_contact_form');

/**
 * Example AJAX handler - Load more posts
 * 
 * Usage: Add this to your JavaScript:
 * jQuery.post(wpcore.ajaxUrl, {
 *     action: 'wpcore_load_more',
 *     nonce: wpcore.nonce,
 *     page: pageNumber
 * });
 */
function wpcore_ajax_load_more() {
    // Verify nonce
    $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    if (!wpcore_verify_ajax_nonce($nonce, 'wpcore-nonce')) {
        wpcore_ajax_error(__('Security check failed.', 'wpcore-modern'), 403);
    }

    // Validate page number
    $page = isset($_POST['page']) ? wpcore_validate_input($_POST['page'], 'int') : 1;
    if ($page < 1) {
        $page = 1;
    }

    // Query posts
    $query = new WP_Query(
        array(
            'post_type'      => 'post',
            'posts_per_page' => get_option('posts_per_page'),
            'paged'          => $page,
            'post_status'    => 'publish',
        )
    );

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', get_post_format());
        }
        wp_reset_postdata();
        $html = ob_get_clean();

        wpcore_ajax_success(
            array(
                'html' => $html,
                'has_more' => $query->max_num_pages > $page,
            ),
            200
        );
    } else {
        wpcore_ajax_error(__('No more posts to load.', 'wpcore-modern'), 404);
    }
}
add_action('wp_ajax_wpcore_load_more', 'wpcore_ajax_load_more');
add_action('wp_ajax_nopriv_wpcore_load_more', 'wpcore_ajax_load_more');

