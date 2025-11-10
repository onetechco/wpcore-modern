<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="<?php echo esc_attr(wpcore_container_class()); ?> py-20">
	<div class="max-w-2xl mx-auto text-center">

		<div class="mb-8">
			<h1 class="text-9xl font-bold text-gray-300">404</h1>
			<h2 class="text-3xl font-bold text-gray-900 mt-4">
				<?php esc_html_e('Oops! Page Not Found', 'wpcore-modern'); ?>
			</h2>
			<p class="text-gray-600 mt-4">
				<?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'wpcore-modern'); ?>
			</p>
		</div>

		<div class="space-y-6">
			<!-- Search Form -->
			<div class="max-w-md mx-auto">
				<?php get_search_form(); ?>
			</div>

			<!-- Back to Home Button -->
			<div>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
					<?php esc_html_e('Back to Home', 'wpcore-modern'); ?>
				</a>
			</div>
		</div>

	</div>
</div>

<?php
get_footer();
