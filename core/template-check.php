<?php
/**
 * Template checking helper functions
 * Functions to check which template is being used
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Check if block template exists for current template
 *
 * @param string $template_name Template name (e.g., 'index', 'single', 'page')
 * @return bool|string False if not found, template path if found
 */
function wpcore_block_template_exists($template_name) {
    $block_template_path = get_template_directory() . '/templates/' . $template_name . '.html';
    return file_exists($block_template_path) ? $block_template_path : false;
}

/**
 * Check if PHP template exists for current template
 *
 * @param string $template_name Template name (e.g., 'index', 'single', 'page')
 * @return bool|string False if not found, template path if found
 */
function wpcore_php_template_exists($template_name) {
    $php_template_path = get_template_directory() . '/' . $template_name . '.php';
    return file_exists($php_template_path) ? $php_template_path : false;
}

/**
 * Get which template is being used (block or PHP)
 *
 * @param string $template_name Template name (e.g., 'index', 'single', 'page')
 * @return string 'block'|'php'|'none'
 */
function wpcore_get_template_type($template_name) {
    $block_template = wpcore_block_template_exists($template_name);
    $php_template = wpcore_php_template_exists($template_name);
    
    // WordPress prioritizes block templates
    if ($block_template) {
        return 'block';
    } elseif ($php_template) {
        return 'php';
    }
    
    return 'none';
}

/**
 * Get current template information
 *
 * @return array Template information
 */
function wpcore_get_current_template_info() {
    global $template;
    
    $template_info = array(
        'template_file' => basename($template),
        'template_path' => $template,
        'is_block_template' => false,
        'is_php_template' => false,
    );
    
    // Check if it's a block template
    if (strpos($template, '/templates/') !== false || strpos($template, '\templates\\') !== false) {
        $template_info['is_block_template'] = true;
        $template_info['template_type'] = 'block';
    } else {
        $template_info['is_php_template'] = true;
        $template_info['template_type'] = 'php';
    }
    
    return $template_info;
}

/**
 * Display template information (for debugging)
 * Add this to your template to see which template is being used
 */
function wpcore_display_template_info() {
    if (!current_user_can('manage_options')) {
        return; // Only show to admins
    }
    
    $info = wpcore_get_current_template_info();
    
    echo '<!-- WPCore Template Info: ';
    echo 'Type: ' . esc_html($info['template_type']) . ', ';
    echo 'File: ' . esc_html($info['template_file']);
    echo ' -->';
}

