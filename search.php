<?php
/**
 * The template for displaying search results
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="<?php echo esc_attr(wpcore_container_class()); ?> py-12">
	<div class="grid grid-cols-1 <?php echo wpcore_has_sidebar() ? 'lg:grid-cols-3' : ''; ?> gap-8">

		<div class="<?php echo wpcore_has_sidebar() ? 'lg:col-span-2' : ''; ?>">

			<?php if (have_posts()) : ?>

				<header class="page-header mb-8">
					<h1 class="page-title text-4xl font-bold text-gray-900 mb-4">
						<?php
						printf(
							esc_html__('Search Results for: %s', 'wpcore-modern'),
							'<span class="text-primary">' . get_search_query() . '</span>'
						);
						?>
					</h1>
				</header>

				<div class="posts-grid grid gap-8">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('template-parts/content/content', get_post_type());
					endwhile;
					?>
				</div>

				<?php wpcore_pagination(); ?>

			<?php else : ?>

				<?php get_template_part('template-parts/content/content', 'none'); ?>

			<?php endif; ?>

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
