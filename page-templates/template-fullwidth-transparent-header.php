<?php
/**
 * Template Name: Full Width - Transparent Header
 * Template Post Type: page
 * Description: Full width page template with transparent header
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

// Add transparent header class to body
add_filter('body_class', function($classes) {
	$classes[] = 'transparent-header';
	return $classes;
});

get_header();
?>

<div class="w-full py-12">
	<div class="<?php echo esc_attr(wpcore_container_class()); ?>">

		<?php
		while (have_posts()) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header mb-8">
					<?php the_title('<h1 class="entry-title text-4xl font-bold text-gray-900 mb-4">', '</h1>'); ?>
				</header>

				<?php if (has_post_thumbnail()) : ?>
					<div class="entry-thumbnail mb-8">
						<?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg')); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content prose prose-lg max-w-none">
					<?php
					the_content();

					wp_link_pages(array(
						'before' => '<div class="page-links mt-8">' . esc_html__('Pages:', 'wpcore-modern'),
						'after'  => '</div>',
					));
					?>
				</div>

				<?php if (get_edit_post_link()) : ?>
					<footer class="entry-footer mt-8">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									__('Edit <span class="screen-reader-text">%s</span>', 'wpcore-modern'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer>
				<?php endif; ?>

			</article>

			<?php
			// If comments are open or there is at least one comment
			if (comments_open() || get_comments_number()) :
				?>
				<div class="comments-wrapper mt-12">
					<?php comments_template(); ?>
				</div>
				<?php
			endif;

		endwhile;
		?>

	</div>
</div>

<?php
get_footer();

