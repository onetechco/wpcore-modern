<?php
/**
 * Template Name: Blank
 * Template Post Type: page
 * Description: Blank page template without header and footer
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

// Remove header and footer
remove_action('wp_head', 'wp_head');
remove_action('wp_footer', 'wp_footer');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen">

	<?php
	while (have_posts()) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (has_post_thumbnail()) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('full', array('class' => 'w-full h-auto')); ?>
				</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'wpcore-modern'),
					'after'  => '</div>',
				));
				?>
			</div>

		</article>

		<?php
	endwhile;
	?>

</div>

<?php wp_footer(); ?>

</body>
</html>

