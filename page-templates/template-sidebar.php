<?php
/**
 * Template Name: With Sidebar
 * Template Post Type: page
 * Description: Page template with sidebar
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="<?php echo esc_attr(wpcore_container_class()); ?> py-12">
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

		<div class="lg:col-span-2">

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

		<?php if (wpcore_has_sidebar()) : ?>
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar('sidebar-1'); ?>
		</aside>
		<?php endif; ?>

	</div>
</div>

<?php
get_footer();

