<?php
/**
 * Card component helper
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Render a card component
 *
 * @param array $args {
 *     Component arguments.
 *
 *     @type string $title       Card title
 *     @type string $content     Card content
 *     @type string $image_url   Featured image URL
 *     @type string $link_url    Card link URL
 *     @type string $link_text   Link text (default: "Read more")
 *     @type string $classes     Additional CSS classes
 *     @type bool   $horizontal  Use horizontal layout (default: false)
 * }
 */
function wpcore_render_card($args = array()) {
    $defaults = array(
        'title'      => '',
        'content'    => '',
        'image_url'  => '',
        'link_url'   => '',
        'link_text'  => __('Read more', 'wpcore-modern'),
        'classes'    => '',
        'horizontal' => false,
    );

    $args = wp_parse_args($args, $defaults);

    $card_classes = 'card';
    if ($args['horizontal']) {
        $card_classes .= ' card-horizontal';
    }
    if ($args['classes']) {
        $card_classes .= ' ' . esc_attr($args['classes']);
    }
    ?>

    <article class="<?php echo $card_classes; ?>">
        <?php if ($args['image_url']) : ?>
            <div class="card-image">
                <?php if ($args['link_url']) : ?>
                    <a href="<?php echo esc_url($args['link_url']); ?>">
                        <img src="<?php echo esc_url($args['image_url']); ?>"
                             alt="<?php echo esc_attr($args['title']); ?>"
                             loading="lazy">
                    </a>
                <?php else : ?>
                    <img src="<?php echo esc_url($args['image_url']); ?>"
                         alt="<?php echo esc_attr($args['title']); ?>"
                         loading="lazy">
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="card-body">
            <?php if ($args['title']) : ?>
                <h3 class="card-title">
                    <?php if ($args['link_url']) : ?>
                        <a href="<?php echo esc_url($args['link_url']); ?>" class="text-gray-900 hover:text-primary transition-colors">
                            <?php echo esc_html($args['title']); ?>
                        </a>
                    <?php else : ?>
                        <?php echo esc_html($args['title']); ?>
                    <?php endif; ?>
                </h3>
            <?php endif; ?>

            <?php if ($args['content']) : ?>
                <div class="card-content">
                    <?php echo wp_kses_post($args['content']); ?>
                </div>
            <?php endif; ?>

            <?php if ($args['link_url']) : ?>
                <a href="<?php echo esc_url($args['link_url']); ?>" class="card-link">
                    <?php echo esc_html($args['link_text']); ?>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </article>

    <?php
}

/**
 * Example usage:
 *
 * wpcore_render_card(array(
 *     'title'      => 'Amazing Title',
 *     'content'    => 'This is the card content...',
 *     'image_url'  => get_the_post_thumbnail_url(),
 *     'link_url'   => get_permalink(),
 *     'link_text'  => 'Learn More',
 *     'classes'    => 'custom-card',
 *     'horizontal' => false,
 * ));
 */
