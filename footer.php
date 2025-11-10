<?php
/**
 * The footer template
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;
?>

	</main><!-- #primary -->

	<?php
	// Get footer template based on page settings
	$footer_template = wpcore_get_footer_template();
	get_template_part('template-parts/footer/footer', $footer_template);
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
