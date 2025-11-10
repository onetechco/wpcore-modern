<?php
/**
 * Breadcrumbs component helper
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Render breadcrumbs navigation
 *
 * @param array $args {
 *     Component arguments.
 *
 *     @type string $home_text   Home link text (default: "Home")
 *     @type string $separator   Breadcrumb separator (default: "/")
 *     @type string $classes     Additional CSS classes
 * }
 */
function wpcore_render_breadcrumbs($args = array()) {
    if (is_front_page()) {
        return;
    }

    $defaults = array(
        'home_text' => __('Home', 'wpcore-modern'),
        'separator' => '/',
        'classes'   => '',
    );

    $args = wp_parse_args($args, $defaults);

    $breadcrumbs = array();

    // Home link
    $breadcrumbs[] = array(
        'url'   => home_url('/'),
        'title' => $args['home_text'],
    );

    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $breadcrumbs[] = array(
                'url'   => get_category_link($category[0]->term_id),
                'title' => $category[0]->name,
            );
        }
    } elseif (is_page()) {
        if (wp_get_post_parent_id(get_the_ID())) {
            $parent_id = wp_get_post_parent_id(get_the_ID());
            $parents   = array();

            while ($parent_id) {
                $page      = get_post($parent_id);
                $parents[] = array(
                    'url'   => get_permalink($page->ID),
                    'title' => get_the_title($page->ID),
                );
                $parent_id = $page->post_parent;
            }

            $parents = array_reverse($parents);
            $breadcrumbs = array_merge($breadcrumbs, $parents);
        }
    } elseif (is_tag()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => __('Tag:', 'wpcore-modern') . ' ' . single_tag_title('', false),
        );
    } elseif (is_author()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => __('Author:', 'wpcore-modern') . ' ' . get_the_author(),
        );
    } elseif (is_day()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => get_the_time('F jS, Y'),
        );
    } elseif (is_month()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => get_the_time('F, Y'),
        );
    } elseif (is_year()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => get_the_time('Y'),
        );
    } elseif (is_search()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => __('Search Results for:', 'wpcore-modern') . ' ' . get_search_query(),
        );
    } elseif (is_404()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => __('404 Error', 'wpcore-modern'),
        );
    }

    // Current page
    if (is_single() || is_page()) {
        $breadcrumbs[] = array(
            'url'   => '',
            'title' => get_the_title(),
        );
    }

    if (count($breadcrumbs) <= 1) {
        return;
    }

    ?>
    <nav class="breadcrumbs <?php echo esc_attr($args['classes']); ?>" aria-label="<?php esc_attr_e('Breadcrumb', 'wpcore-modern'); ?>">
        <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="flex flex-wrap items-center gap-2">
            <?php foreach ($breadcrumbs as $index => $crumb) : ?>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <?php if ($crumb['url']) : ?>
                        <a href="<?php echo esc_url($crumb['url']); ?>"
                           itemprop="item"
                           class="hover:text-primary transition-colors">
                            <span itemprop="name"><?php echo esc_html($crumb['title']); ?></span>
                        </a>
                    <?php else : ?>
                        <span itemprop="name" class="breadcrumbs-current">
                            <?php echo esc_html($crumb['title']); ?>
                        </span>
                    <?php endif; ?>
                    <meta itemprop="position" content="<?php echo $index + 1; ?>">
                </li>

                <?php if ($index < count($breadcrumbs) - 1) : ?>
                    <li class="breadcrumbs-separator" aria-hidden="true">
                        <?php echo esc_html($args['separator']); ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </nav>
    <?php
}

/**
 * Example usage:
 *
 * wpcore_render_breadcrumbs(array(
 *     'home_text' => 'Home',
 *     'separator' => '→',
 *     'classes'   => 'mb-8',
 * ));
 */
