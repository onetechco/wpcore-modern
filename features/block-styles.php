<?php
/**
 * Block Styles
 * Register custom block styles for core blocks
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Register block styles
 */
function wpcore_register_block_styles() {
    /**
     * Button block styles
     */
    register_block_style(
        'core/button',
        array(
            'name'         => 'outline',
            'label'        => __('Outline', 'wpcore-modern'),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name'         => 'ghost',
            'label'        => __('Ghost', 'wpcore-modern'),
        )
    );

    /**
     * Quote block styles
     */
    register_block_style(
        'core/quote',
        array(
            'name'         => 'modern',
            'label'        => __('Modern', 'wpcore-modern'),
        )
    );

    /**
     * Image block styles
     */
    register_block_style(
        'core/image',
        array(
            'name'         => 'rounded-lg',
            'label'        => __('Rounded Large', 'wpcore-modern'),
        )
    );

    register_block_style(
        'core/image',
        array(
            'name'         => 'shadow-lg',
            'label'        => __('Shadow Large', 'wpcore-modern'),
        )
    );

    /**
     * Group block styles
     */
    register_block_style(
        'core/group',
        array(
            'name'         => 'card',
            'label'        => __('Card', 'wpcore-modern'),
        )
    );

    register_block_style(
        'core/group',
        array(
            'name'         => 'section',
            'label'        => __('Section', 'wpcore-modern'),
        )
    );

    /**
     * Columns block styles
     */
    register_block_style(
        'core/columns',
        array(
            'name'         => 'features',
            'label'        => __('Features', 'wpcore-modern'),
        )
    );
}
add_action('init', 'wpcore_register_block_styles');

