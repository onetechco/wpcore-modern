<?php
/**
 * The front page template
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

get_header();
?>

<?php if (is_front_page() && is_home()) : ?>
	<!-- Hero Section -->
	<?php
	wpcore_render_hero(array(
		'title'              => __('Welcome to WPCore Modern', 'wpcore-modern'),
		'subtitle'           => __('Modern WordPress Theme', 'wpcore-modern'),
		'content'            => __('A modern, lightweight WordPress starter theme built with Tailwind CSS 4. Designed for speed, simplicity, and scalability.', 'wpcore-modern'),
		'cta_text'           => __('Get Started', 'wpcore-modern'),
		'cta_url'            => home_url('/'),
		'secondary_cta_text' => __('Learn More', 'wpcore-modern'),
		'secondary_cta_url'  => home_url('/'),
		'alignment'          => 'center',
		'height'             => 'md',
		'overlay'            => 'medium',
	));
	?>

	<!-- Features Section -->
	<section class="features-section py-16 bg-white">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
					<?php esc_html_e('Key Features', 'wpcore-modern'); ?>
				</h2>
				<p class="text-lg text-gray-600 max-w-2xl mx-auto">
					<?php esc_html_e('Everything you need to build a modern WordPress website', 'wpcore-modern'); ?>
				</p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				$features = array(
					array(
						'title'   => __('Modern Stack', 'wpcore-modern'),
						'content' => __('Built with Tailwind CSS 4, PostCSS, and esbuild for fast development and optimized builds.', 'wpcore-modern'),
					),
					array(
						'title'   => __('Performance', 'wpcore-modern'),
						'content' => __('Minimal dependencies, optimized bundle sizes, and lazy loading for the best performance.', 'wpcore-modern'),
					),
					array(
						'title'   => __('Developer Experience', 'wpcore-modern'),
						'content' => __('Clean code structure, reusable components, and easy customization for developers.', 'wpcore-modern'),
					),
				);

				foreach ($features as $feature) :
					?>
					<?php
					wpcore_render_card(array(
						'title'     => $feature['title'],
						'content'   => $feature['content'],
						'link_url'  => home_url('/'),
						'link_text' => __('Learn More', 'wpcore-modern'),
						'classes'   => 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow',
					));
					?>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</section>

	<!-- Services Section -->
	<section class="services-section py-16 bg-gray-50">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
					<?php esc_html_e('Our Services', 'wpcore-modern'); ?>
				</h2>
				<p class="text-lg text-gray-600 max-w-2xl mx-auto">
					<?php esc_html_e('Discover what we can do for you', 'wpcore-modern'); ?>
				</p>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				$services = array(
					array(
						'title'   => __('Web Design', 'wpcore-modern'),
						'content' => __('Beautiful and modern web designs that engage your audience and drive conversions.', 'wpcore-modern'),
					),
					array(
						'title'   => __('Development', 'wpcore-modern'),
						'content' => __('Custom WordPress development tailored to your specific needs and requirements.', 'wpcore-modern'),
					),
					array(
						'title'   => __('Support', 'wpcore-modern'),
						'content' => __('Ongoing support and maintenance to keep your website running smoothly.', 'wpcore-modern'),
					),
				);

				foreach ($services as $service) :
					?>
					<?php
					wpcore_render_card(array(
						'title'     => $service['title'],
						'content'   => $service['content'],
						'link_url'  => home_url('/'),
						'link_text' => __('Learn More', 'wpcore-modern'),
						'classes'   => 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow',
					));
					?>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="cta-section py-16 bg-primary text-white">
		<div class="<?php echo esc_attr(wpcore_container_class()); ?>">
			<div class="text-center max-w-3xl mx-auto">
				<h2 class="text-3xl md:text-4xl font-bold mb-4">
					<?php esc_html_e('Ready to Get Started?', 'wpcore-modern'); ?>
				</h2>
				<p class="text-lg mb-8 text-white/90">
					<?php esc_html_e('Start building your modern WordPress website today with WPCore Modern theme.', 'wpcore-modern'); ?>
				</p>
				<div class="flex flex-wrap gap-4 justify-center">
					<?php
					wpcore_render_button(array(
						'text'    => __('Get Started', 'wpcore-modern'),
						'url'     => home_url('/'),
						'variant' => 'outline',
						'size'    => 'lg',
						'classes' => 'bg-white text-primary border-white hover:bg-gray-100',
					));
					?>
					<?php
					wpcore_render_button(array(
						'text'    => __('Contact Us', 'wpcore-modern'),
						'url'     => home_url('/'),
						'variant' => 'ghost',
						'size'    => 'lg',
						'classes' => 'text-white border-white hover:bg-white/10',
					));
					?>
				</div>
			</div>
		</div>
	</section>

<?php else : ?>
	<!-- Regular Blog Layout -->
	<div class="<?php echo esc_attr(wpcore_container_class()); ?> py-12">
		<div class="grid grid-cols-1 <?php echo wpcore_has_sidebar() ? 'lg:grid-cols-3' : ''; ?> gap-8">

			<div class="<?php echo wpcore_has_sidebar() ? 'lg:col-span-2' : ''; ?>">

				<?php if (have_posts()) : ?>

					<header class="page-header mb-8">
						<?php
						if (is_home() && !is_front_page()) :
							?>
							<h1 class="page-title text-4xl font-bold text-gray-900">
								<?php single_post_title(); ?>
							</h1>
							<?php
						elseif (is_archive()) :
							the_archive_title('<h1 class="page-title text-4xl font-bold text-gray-900">', '</h1>');
							the_archive_description('<div class="archive-description mt-4 text-gray-600">', '</div>');
						elseif (is_search()) :
							?>
							<h1 class="page-title text-4xl font-bold text-gray-900">
								<?php
								printf(
									esc_html__('Search Results for: %s', 'wpcore-modern'),
									'<span class="text-primary">' . get_search_query() . '</span>'
								);
								?>
							</h1>
							<?php
						endif;
						?>
					</header>

					<div class="posts-grid grid gap-8">
						<?php
						while (have_posts()) :
							the_post();
							get_template_part('template-parts/content/content', get_post_format());
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
<?php endif; ?>

<?php
get_footer();

