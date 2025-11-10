<?php
/**
 * The template for displaying single posts
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="<?php echo esc_attr(wpcore_container_class()); ?> py-12">
	<div class="grid grid-cols-1 <?php echo wpcore_has_sidebar() ? 'lg:grid-cols-3' : ''; ?> gap-8">

		<div class="<?php echo wpcore_has_sidebar() ? 'lg:col-span-2' : ''; ?>">

			<?php
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content/content', 'single');

				// If comments are open or there is at least one comment
				if (comments_open() || get_comments_number()) :
					?>
					<div class="comments-wrapper mt-12">
						<?php comments_template(); ?>
					</div>
					<?php
				endif;

				// Post navigation
				the_post_navigation(array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'wpcore-modern') . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'wpcore-modern') . '</span> <span class="nav-title">%title</span>',
					'class'     => 'post-navigation flex justify-between gap-4 mt-12',
				));

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
