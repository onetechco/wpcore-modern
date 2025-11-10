<?php
/**
 * Default footer template part
 * Footer with widgets and footer menu
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer bg-gray-900 text-gray-300 mt-auto">

	<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
	<div class="footer-widgets py-12">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

				<?php if (is_active_sidebar('footer-1')) : ?>
				<div class="footer-column">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
				<?php endif; ?>

				<?php if (is_active_sidebar('footer-2')) : ?>
				<div class="footer-column">
					<?php dynamic_sidebar('footer-2'); ?>
				</div>
				<?php endif; ?>

				<?php if (is_active_sidebar('footer-3')) : ?>
				<div class="footer-column">
					<?php dynamic_sidebar('footer-3'); ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="footer-bottom border-t border-gray-800 py-6">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="flex flex-col md:flex-row justify-between items-center gap-4">

				<div class="copyright text-sm">
					<?php
					printf(
						esc_html__('&copy; %1$s %2$s. All rights reserved.', 'wpcore-modern'),
						date_i18n('Y'),
						get_bloginfo('name')
					);
					?>
				</div>

				<?php if (has_nav_menu('footer')) : ?>
				<nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer menu', 'wpcore-modern'); ?>">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'flex flex-wrap gap-4 text-sm',
						'container'      => false,
						'depth'          => 1,
					));
					?>
				</nav>
				<?php endif; ?>

			</div>
		</div>
	</div>

</footer><!-- #colophon -->

