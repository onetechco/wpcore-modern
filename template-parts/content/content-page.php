<?php
/**
 * Template part for displaying page content
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden p-8'); ?>>

	<header class="entry-header mb-6">
		<?php the_title('<h1 class="entry-title text-4xl font-bold text-gray-900">', '</h1>'); ?>
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

</article>
