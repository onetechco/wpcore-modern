<?php
/**
 * Button component helper
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Render a button component
 *
 * @param array $args {
 *     Component arguments.
 *
 *     @type string $text      Button text
 *     @type string $url       Button URL
 *     @type string $variant   Button variant: primary, secondary, accent, outline, ghost (default: primary)
 *     @type string $size      Button size: sm, lg, xl (default: normal)
 *     @type string $icon      SVG icon HTML (optional)
 *     @type bool   $icon_right Icon position on right (default: false)
 *     @type string $classes   Additional CSS classes
 *     @type array  $attributes Additional HTML attributes
 * }
 */
function wpcore_render_button($args = array()) {
    $defaults = array(
        'text'       => '',
        'url'        => '#',
        'variant'    => 'primary',
        'size'       => '',
        'icon'       => '',
        'icon_right' => false,
        'classes'    => '',
        'attributes' => array(),
    );

    $args = wp_parse_args($args, $defaults);

    // Build classes
    $btn_classes = 'btn';

    // Variant
    $valid_variants = array('primary', 'secondary', 'accent', 'outline', 'ghost');
    if (in_array($args['variant'], $valid_variants)) {
        $btn_classes .= ' btn-' . $args['variant'];
    }

    // Size
    if ($args['size'] && in_array($args['size'], array('sm', 'lg', 'xl'))) {
        $btn_classes .= ' btn-' . $args['size'];
    }

    // Icon
    if ($args['icon']) {
        $btn_classes .= ' btn-icon';
    }

    // Custom classes
    if ($args['classes']) {
        $btn_classes .= ' ' . esc_attr($args['classes']);
    }

    // Build attributes
    $attributes = '';
    foreach ($args['attributes'] as $key => $value) {
        $attributes .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
    }

    // Sanitize icon HTML (allow SVG elements)
    $allowed_icon_tags = array(
        'svg' => array(
            'class' => array(),
            'fill' => array(),
            'stroke' => array(),
            'viewBox' => array(),
            'xmlns' => array(),
            'width' => array(),
            'height' => array(),
        ),
        'path' => array(
            'stroke-linecap' => array(),
            'stroke-linejoin' => array(),
            'stroke-width' => array(),
            'd' => array(),
            'fill' => array(),
        ),
        'circle' => array(
            'cx' => array(),
            'cy' => array(),
            'r' => array(),
        ),
        'line' => array(
            'x1' => array(),
            'y1' => array(),
            'x2' => array(),
            'y2' => array(),
        ),
    );
    $sanitized_icon = $args['icon'] ? wp_kses($args['icon'], $allowed_icon_tags) : '';

    ?>
    <a href="<?php echo esc_url($args['url']); ?>"
       class="<?php echo $btn_classes; ?>"
       <?php echo $attributes; ?>>
        <?php if ($sanitized_icon && !$args['icon_right']) : ?>
            <?php echo $sanitized_icon; ?>
        <?php endif; ?>

        <?php echo esc_html($args['text']); ?>

        <?php if ($sanitized_icon && $args['icon_right']) : ?>
            <?php echo $sanitized_icon; ?>
        <?php endif; ?>
    </a>
    <?php
}

/**
 * Example usage:
 *
 * wpcore_render_button(array(
 *     'text'    => 'Click Me',
 *     'url'     => home_url('/contact'),
 *     'variant' => 'primary',
 *     'size'    => 'lg',
 *     'icon'    => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>',
 *     'icon_right' => true,
 * ));
 */
