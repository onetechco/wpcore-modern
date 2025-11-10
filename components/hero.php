<?php
/**
 * Hero component helper
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Render a hero section component
 *
 * @param array $args {
 *     Component arguments.
 *
 *     @type string $title         Hero title
 *     @type string $subtitle      Hero subtitle
 *     @type string $content       Hero content text
 *     @type string $image_url     Background image URL
 *     @type string $cta_text      Call-to-action button text
 *     @type string $cta_url       Call-to-action button URL
 *     @type string $cta_variant   Button variant (default: primary)
 *     @type string $secondary_cta_text Secondary button text
 *     @type string $secondary_cta_url  Secondary button URL
 *     @type string $alignment     Text alignment: left, center (default: left)
 *     @type string $height        Hero height: sm, md, lg, full (default: lg)
 *     @type string $overlay       Overlay darkness: light, medium, dark (default: medium)
 *     @type string $classes       Additional CSS classes
 * }
 */
function wpcore_render_hero($args = array()) {
    $defaults = array(
        'title'              => '',
        'subtitle'           => '',
        'content'            => '',
        'image_url'          => '',
        'cta_text'           => '',
        'cta_url'            => '',
        'cta_variant'        => 'primary',
        'secondary_cta_text' => '',
        'secondary_cta_url'  => '',
        'alignment'          => 'left',
        'height'             => 'lg',
        'overlay'            => 'medium',
        'classes'            => '',
    );

    $args = wp_parse_args($args, $defaults);

    // Height classes
    $height_classes = array(
        'sm'   => 'hero-sm',
        'md'   => 'hero-md',
        'lg'   => 'hero-lg',
        'full' => 'hero-full',
    );
    $height_class = isset($height_classes[$args['height']]) ? $height_classes[$args['height']] : $height_classes['lg'];

    // Overlay classes
    $overlay_classes = array(
        'light'  => 'hero-overlay-light',
        'medium' => 'hero-overlay-medium',
        'dark'   => 'hero-overlay-dark',
    );
    $overlay_class = isset($overlay_classes[$args['overlay']]) ? $overlay_classes[$args['overlay']] : $overlay_classes['medium'];

    // Alignment classes
    $alignment_class = $args['alignment'] === 'center' ? 'hero-center' : 'hero-left';

    $hero_classes = "hero {$height_class} {$alignment_class} {$args['classes']}";
    ?>

    <section class="<?php echo esc_attr($hero_classes); ?>">
        <?php if ($args['image_url']) : ?>
            <!-- Background Image -->
            <div class="hero-background">
                <img src="<?php echo esc_url($args['image_url']); ?>"
                     alt="<?php echo esc_attr($args['title']); ?>"
                     class="hero-background-image"
                     loading="eager">
                <div class="hero-background-overlay <?php echo esc_attr($overlay_class); ?>"></div>
            </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="<?php echo esc_attr(wpcore_container_class()); ?> hero-content-wrapper">
            <div class="hero-inner <?php echo $args['alignment'] === 'center' ? 'hero-inner-center' : ''; ?>">

                <?php if ($args['subtitle']) : ?>
                    <p class="hero-subtitle hero-subtitle-image">
                        <?php echo esc_html($args['subtitle']); ?>
                    </p>
                <?php endif; ?>

                <?php if ($args['title']) : ?>
                    <h1 class="hero-title hero-title-image">
                        <?php echo esc_html($args['title']); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($args['content']) : ?>
                    <div class="hero-content-text hero-content-image">
                        <?php echo wp_kses_post($args['content']); ?>
                    </div>
                <?php endif; ?>

                <?php if ($args['cta_text'] || $args['secondary_cta_text']) : ?>
                    <div class="hero-actions <?php echo $args['alignment'] === 'center' ? 'hero-actions-center' : ''; ?>">
                        <?php if ($args['cta_text']) : ?>
                            <?php
                            wpcore_render_button(array(
                                'text'    => $args['cta_text'],
                                'url'     => $args['cta_url'],
                                'variant' => $args['cta_variant'] ?: 'primary',
                                'size'    => 'lg',
                                'classes' => 'bg-white text-primary hover:bg-gray-100',
                            ));
                            ?>
                        <?php endif; ?>

                        <?php if ($args['secondary_cta_text']) : ?>
                            <?php
                            wpcore_render_button(array(
                                'text'    => $args['secondary_cta_text'],
                                'url'     => $args['secondary_cta_url'],
                                'variant' => 'outline',
                                'size'    => 'lg',
                                'classes' => 'text-white border-white hover:bg-white hover:text-gray-900',
                            ));
                            ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php
}

/**
 * Example usage:
 *
 * wpcore_render_hero(array(
 *     'title'              => 'Welcome to Our Site',
 *     'subtitle'           => 'Your Journey Starts Here',
 *     'content'            => 'Discover amazing features and possibilities.',
 *     'image_url'          => get_template_directory_uri() . '/assets/images/hero-bg.jpg',
 *     'cta_text'           => 'Get Started',
 *     'cta_url'            => home_url('/get-started'),
 *     'secondary_cta_text' => 'Learn More',
 *     'secondary_cta_url'  => home_url('/about'),
 *     'alignment'          => 'center',
 *     'height'             => 'full',
 *     'overlay'            => 'dark',
 * ));
 */
