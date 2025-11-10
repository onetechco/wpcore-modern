<?php
/**
 * WPCORE Modern - WordPress Starter Theme
 *
 * A modern, lightweight WordPress starter theme built with Tailwind CSS 4.
 * Designed for speed, simplicity, and scalability.
 *
 * @package WPCore
 * @version 1.0.0
 * @author Phong Nguyen <https://phongnguyen.net>
 * @license GPL-2.0-or-later
 */

defined('ABSPATH') || exit;

/**
 * Theme constants
 */
define('WPCORE_VERSION', '1.0.0');
define('WPCORE_DIR', get_template_directory());
define('WPCORE_URI', get_template_directory_uri());
define('WPCORE_DIST', WPCORE_URI . '/assets/dist');

/**
 * Load core functionality
 * These files contain essential theme features
 */
require_once WPCORE_DIR . '/core/setup.php';
require_once WPCORE_DIR . '/core/enqueue.php';
require_once WPCORE_DIR . '/core/nav-walker.php';
require_once WPCORE_DIR . '/core/widgets.php';
require_once WPCORE_DIR . '/core/template-functions.php';
require_once WPCORE_DIR . '/core/template-parts.php';
require_once WPCORE_DIR . '/core/template-check.php';
require_once WPCORE_DIR . '/core/security.php';
require_once WPCORE_DIR . '/core/performance.php';
require_once WPCORE_DIR . '/core/accessibility.php';

/**
 * Load optional features
 * Uncomment the features you need for your project
 */
require_once WPCORE_DIR . '/features/block-patterns.php';
require_once WPCORE_DIR . '/features/block-styles.php';
// require_once WPCORE_DIR . '/features/custom-post-types.php';
// require_once WPCORE_DIR . '/features/taxonomies.php';
// require_once WPCORE_DIR . '/features/shortcodes.php';
// require_once WPCORE_DIR . '/features/acf-blocks.php';
// require_once WPCORE_DIR . '/features/ajax-handlers.php';

/**
 * Load WooCommerce integration if WooCommerce is active
 */
if (class_exists('WooCommerce')) {
    require_once WPCORE_DIR . '/features/woocommerce.php';
}

/**
 * Load reusable component helpers
 * These functions help you render common UI components
 */
require_once WPCORE_DIR . '/components/card.php';
require_once WPCORE_DIR . '/components/button.php';
require_once WPCORE_DIR . '/components/hero.php';
require_once WPCORE_DIR . '/components/breadcrumbs.php';
