<?php
/**
 * Minimal footer template part
 * Simple footer with just copyright
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<footer id="colophon" class="site-footer bg-gray-900 text-gray-300 mt-auto">
	<div class="footer-bottom py-6">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="text-center">

				<div class="copyright text-sm">
					<?php
					printf(
						esc_html__('&copy; %1$s %2$s. All rights reserved.', 'wpcore-modern'),
						date_i18n('Y'),
						get_bloginfo('name')
					);
					?>
				</div>

			</div>
		</div>
	</div>
</footer><!-- #colophon -->

