<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<section class="no-results not-found bg-white rounded-lg shadow-md p-8">
	<header class="page-header mb-6">
		<h1 class="page-title text-3xl font-bold text-gray-900">
			<?php esc_html_e('Nothing Found', 'wpcore-modern'); ?>
		</h1>
	</header>

	<div class="page-content">
		<?php if (is_home() && current_user_can('publish_posts')) : ?>

			<p class="text-gray-600 mb-4">
				<?php
				printf(
					wp_kses(
						__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wpcore-modern'),
						array('a' => array('href' => array()))
					),
					esc_url(admin_url('post-new.php'))
				);
				?>
			</p>

		<?php elseif (is_search()) : ?>

			<p class="text-gray-600 mb-4">
				<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'wpcore-modern'); ?>
			</p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p class="text-gray-600 mb-4">
				<?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'wpcore-modern'); ?>
			</p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
