<?php
/**
 * Template part for displaying posts
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow'); ?>>

	<?php if (has_post_thumbnail()) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
			<?php wpcore_post_thumbnail('wpcore-featured', 'w-full h-full object-cover hover:scale-105 transition-transform duration-300'); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="post-content p-6">

		<header class="entry-header mb-4">
			<?php
			if (is_singular()) :
				the_title('<h1 class="entry-title text-3xl font-bold text-gray-900 mb-4">', '</h1>');
			else :
				the_title('<h2 class="entry-title text-2xl font-bold text-gray-900 mb-4"><a href="' . esc_url(get_permalink()) . '" class="hover:text-primary transition-colors">', '</a></h2>');
			endif;
			?>

			<?php wpcore_post_meta(); ?>
		</header>

		<div class="entry-content prose max-w-none">
			<?php
			if (is_singular()) :
				the_content();

				wp_link_pages(array(
					'before' => '<div class="page-links mt-6 flex flex-wrap gap-2">' . esc_html__('Pages:', 'wpcore-modern'),
					'after'  => '</div>',
				));
			else :
				the_excerpt();
				?>
				<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-primary font-semibold hover:underline mt-4">
					<?php esc_html_e('Read more', 'wpcore-modern'); ?>
					<svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</a>
				<?php
			endif;
			?>
		</div>

		<?php if (is_singular() && has_tag()) : ?>
		<footer class="entry-footer mt-6 pt-6 border-t border-gray-200">
			<div class="post-tags flex flex-wrap gap-2">
				<?php
				the_tags(
					'<span class="text-sm font-semibold text-gray-600 mr-2">' . esc_html__('Tags:', 'wpcore-modern') . '</span>',
					'',
					''
				);
				?>
			</div>
		</footer>
		<?php endif; ?>

	</div>

</article>
