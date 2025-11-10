<?php
/**
 * Theme setup and configuration
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Sets up theme defaults and registers support for various WordPress features
 */
function wpcore_setup() {
    /**
     * Make theme available for translation
     */
    load_theme_textdomain('wpcore-modern', WPCORE_DIR . '/languages');

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support('automatic-feed-links');

    /**
     * Let WordPress manage the document title
     */
    add_theme_support('title-tag');

    /**
     * Enable support for Post Thumbnails on posts and pages
     */
    add_theme_support('post-thumbnails');

    /**
     * Register navigation menus
     */
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'wpcore-modern'),
        'footer'  => __('Footer Menu', 'wpcore-modern'),
    ));

    /**
     * Switch default core markup to output valid HTML5
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    /**
     * Add theme support for selective refresh for widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo
     */
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    /**
     * Add support for editor styles
     */
    add_theme_support('editor-styles');
    add_editor_style('assets/dist/css/editor.css');

    /**
     * Add support for responsive embedded content
     */
    add_theme_support('responsive-embeds');

    /**
     * Add support for align wide and align full
     */
    add_theme_support('align-wide');

    /**
     * Add support for custom spacing
     */
    add_theme_support('custom-spacing');

    /**
     * Add support for block editor features
     */
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_theme_support('editor-color-palette');
    add_theme_support('editor-font-sizes');
    add_theme_support('editor-gradient-presets');
    add_theme_support('custom-line-height');
    add_theme_support('custom-units', array('px', 'em', 'rem', 'vh', 'vw', '%'));

    /**
     * Add support for block templates
     */
    add_theme_support('block-templates');

    /**
     * Add support for block template parts
     */
    add_theme_support('block-template-parts');

    /**
     * Add image sizes
     */
    add_image_size('wpcore-featured', 1200, 675, true);
    add_image_size('wpcore-thumbnail', 400, 300, true);
    add_image_size('wpcore-medium', 800, 600, true);
}
add_action('after_setup_theme', 'wpcore_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function wpcore_content_width() {
    $GLOBALS['content_width'] = apply_filters('wpcore_content_width', 1140);
}
add_action('after_setup_theme', 'wpcore_content_width', 0);
