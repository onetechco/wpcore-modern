<?php
/**
 * Default header template part
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<header id="masthead" class="site-header sticky top-0 z-50 bg-white shadow-md">
	<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
		<div class="flex items-center justify-between py-4 relative">

			<!-- Site Branding -->
			<div class="site-branding flex items-center">
				<?php wpcore_site_branding(); ?>
			</div>

			<!-- Primary Navigation -->
			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary menu', 'wpcore-modern'); ?>">
				<?php
				// Check if menu exists and has items
				$locations = get_nav_menu_locations();
				$menu_id = isset($locations['primary']) ? $locations['primary'] : 0;
				$menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : false;
				
				if (!empty($menu_items) && has_nav_menu('primary')) {
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu flex items-center space-x-1',
						'container'      => false,
						'walker'         => new WPCore_Nav_Walker(),
					));
				} else {
					wpcore_fallback_menu();
				}
				?>
			</nav>

			<!-- Mobile Menu Toggle -->
			<button class="mobile-menu-toggle lg:hidden" aria-label="<?php esc_attr_e('Toggle menu', 'wpcore-modern'); ?>" aria-expanded="false">
				<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
				</svg>
			</button>

		</div>
	</div>

	<!-- Mobile Menu Overlay -->
	<div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

	<!-- Mobile Navigation -->
	<nav id="mobile-navigation" class="mobile-navigation hidden" aria-label="<?php esc_attr_e('Mobile menu', 'wpcore-modern'); ?>">
		<?php
		// Check if menu exists and has items
		$locations = get_nav_menu_locations();
		$menu_id = isset($locations['primary']) ? $locations['primary'] : 0;
		$menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : false;
		
		if (!empty($menu_items) && has_nav_menu('primary')) {
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'menu_id'        => 'mobile-menu',
				'menu_class'     => 'menu flex flex-col space-y-2',
				'container'      => false,
				'walker'         => new WPCore_Nav_Walker(),
			));
		} else {
			wpcore_fallback_menu();
		}
		?>
	</nav>
</header>

