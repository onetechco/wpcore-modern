<?php
/**
 * Minimal header template part
 * Simple header without navigation
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<header id="masthead" class="site-header sticky top-0 z-50 bg-white shadow-sm">
	<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
		<div class="flex items-center justify-between py-4">

			<!-- Site Branding -->
			<div class="site-branding flex items-center">
				<?php wpcore_site_branding(); ?>
			</div>

		</div>
	</div>
</header>

