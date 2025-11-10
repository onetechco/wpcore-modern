<?php
/**
 * Template helper functions
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;

/**
 * Display the site logo or site title
 */
function wpcore_site_branding() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-bold text-gray-900 hover:text-primary transition-colors">
            <?php bloginfo('name'); ?>
        </a>
        <?php
        $description = get_bloginfo('description', 'display');
        if ($description) {
            ?>
            <p class="text-sm text-gray-600 mt-1"><?php echo esc_html($description); ?></p>
            <?php
        }
    }
}

/**
 * Display post thumbnail with responsive sizes and optimization
 *
 * @param string $size  Image size name
 * @param string $class Additional CSS classes
 * @param array  $attr  Additional attributes
 */
function wpcore_post_thumbnail($size = 'wpcore-featured', $class = '', $attr = array()) {
    if (!has_post_thumbnail()) {
        return;
    }

    $default_class = 'w-full h-auto object-cover';
    $img_class = $class ? $default_class . ' ' . $class : $default_class;

    // Get image ID
    $image_id = get_post_thumbnail_id();
    
    // Get image data
    $image_src = wp_get_attachment_image_src($image_id, $size);
    $image_srcset = wp_get_attachment_image_srcset($image_id, $size);
    $image_sizes = wp_get_attachment_image_sizes($image_id, $size);
    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    
    // Fallback alt text
    if (empty($image_alt)) {
        $image_alt = get_the_title();
    }

    // Build attributes
    $default_attr = array(
        'class'    => $img_class,
        'src'      => $image_src[0],
        'srcset'   => $image_srcset,
        'sizes'    => $image_sizes,
        'alt'      => $image_alt,
        'loading'  => 'lazy',
        'decoding' => 'async',
    );

    // Merge with custom attributes
    $attr = wp_parse_args($attr, $default_attr);

    // Output image
    echo '<img';
    foreach ($attr as $key => $value) {
        if ('src' === $key) {
            echo ' src="' . esc_url($value) . '"';
        } elseif ('srcset' === $key) {
            echo ' srcset="' . esc_attr($value) . '"';
        } elseif ('sizes' === $key) {
            echo ' sizes="' . esc_attr($value) . '"';
        } elseif ('alt' === $key) {
            echo ' alt="' . esc_attr($value) . '"';
        } else {
            echo ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }
    }
    echo '>';
}

/**
 * Display post meta information
 */
function wpcore_post_meta() {
    ?>
    <div class="post-meta flex flex-wrap items-center gap-4 text-sm text-gray-600">
        <span class="post-date flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <?php echo get_the_date(); ?>
        </span>

        <span class="post-author flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <?php the_author_posts_link(); ?>
        </span>

        <?php if (has_category()) : ?>
        <span class="post-categories flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            <?php the_category(', '); ?>
        </span>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Display pagination
 */
function wpcore_pagination() {
    if ($GLOBALS['wp_query']->max_num_pages <= 1) {
        return;
    }

    $args = array(
        'mid_size'           => 2,
        'prev_text'          => __('&laquo; Previous', 'wpcore-modern'),
        'next_text'          => __('Next &raquo;', 'wpcore-modern'),
        'type'               => 'array',
        'before_page_number' => '<span class="sr-only">Page </span>',
    );

    $pages = paginate_links($args);

    if (is_array($pages)) {
        echo '<nav class="pagination flex justify-center items-center gap-2 mt-12" aria-label="' . esc_attr__('Page navigation', 'wpcore-modern') . '">';
        echo '<ul class="flex gap-2">';
        foreach ($pages as $page) {
            // Check if this is the current page
            $is_current = (strpos($page, 'current') !== false || strpos($page, 'aria-current="page"') !== false);
            
            // Build classes based on page state
            $classes = 'px-4 py-2 rounded border';
            if ($is_current) {
                $classes .= ' bg-primary text-white border-primary';
            } else {
                $classes .= ' bg-white text-gray-700 border-gray-300 hover:bg-gray-50';
            }
            
            // Replace class attribute more safely
            if (preg_match('/class=["\']([^"\']*)["\']/', $page, $matches)) {
                $page = preg_replace('/class=["\'][^"\']*["\']/', 'class="' . esc_attr($classes) . '"', $page);
            } else {
                // If no class attribute, add it
                $page = str_replace('<a ', '<a class="' . esc_attr($classes) . '" ', $page);
                $page = str_replace('<span ', '<span class="' . esc_attr($classes) . '" ', $page);
            }
            
            echo '<li>' . $page . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}

/**
 * Check if sidebar should be displayed
 */
function wpcore_has_sidebar() {
    // Don't show sidebar on these pages
    if (is_page_template('page-templates/template-fullwidth.php') || 
        is_page_template('page-templates/template-fullwidth-transparent-header.php') || 
        is_404()) {
        return false;
    }

    // Show sidebar on sidebar template
    if (is_page_template('page-templates/template-sidebar.php')) {
        return is_active_sidebar('sidebar-1');
    }

    // Check if sidebar has widgets
    return is_active_sidebar('sidebar-1');
}

/**
 * Get container class based on layout
 */
function wpcore_container_class() {
    $class = 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8';
    return apply_filters('wpcore_container_class', $class);
}

/**
 * Fallback menu for when no menu is assigned
 */
function wpcore_fallback_menu() {
    ?>
    <ul class="menu flex items-center space-x-1">
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="block px-4 py-2 text-gray-700 hover:text-primary transition-colors">
                <?php esc_html_e('Home', 'wpcore-modern'); ?>
            </a>
        </li>
        <?php if (get_option('page_for_posts')) : ?>
        <li class="menu-item">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="block px-4 py-2 text-gray-700 hover:text-primary transition-colors">
                <?php esc_html_e('Blog', 'wpcore-modern'); ?>
            </a>
        </li>
        <?php endif; ?>
        <?php
        $pages = get_pages(array('sort_column' => 'menu_order', 'number' => 5));
        foreach ($pages as $page) :
        ?>
        <li class="menu-item">
            <a href="<?php echo esc_url(get_permalink($page->ID)); ?>" class="block px-4 py-2 text-gray-700 hover:text-primary transition-colors">
                <?php echo esc_html($page->post_title); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php
}
