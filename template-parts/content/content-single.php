<?php
/**
 * Template part for displaying single posts
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden p-8'); ?>>

	<header class="entry-header mb-6">
		<?php the_title('<h1 class="entry-title text-4xl font-bold text-gray-900 mb-4">', '</h1>'); ?>
		<?php wpcore_post_meta(); ?>
	</header>

	<?php if (has_post_thumbnail()) : ?>
	<div class="post-thumbnail mb-8 rounded-lg overflow-hidden">
		<?php wpcore_post_thumbnail('wpcore-featured'); ?>
	</div>
	<?php endif; ?>

	<div class="entry-content prose prose-lg max-w-none">
		<?php
		the_content();

		wp_link_pages(array(
			'before' => '<div class="page-links mt-8 flex flex-wrap gap-2">' . esc_html__('Pages:', 'wpcore-modern'),
			'after'  => '</div>',
		));
		?>
	</div>

	<?php if (has_tag()) : ?>
	<footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
		<div class="post-tags flex flex-wrap gap-2">
			<span class="text-sm font-semibold text-gray-600"><?php esc_html_e('Tags:', 'wpcore-modern'); ?></span>
			<?php the_tags('<div class="flex flex-wrap gap-2">', '', '</div>'); ?>
		</div>
	</footer>
	<?php endif; ?>

</article>
