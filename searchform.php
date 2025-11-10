<?php
/**
 * The template for displaying search form
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="sr-only" for="s">
		<?php esc_html_e('Search for:', 'wpcore-modern'); ?>
	</label>
	<div class="flex gap-2">
		<input type="search"
		       class="form-input flex-1"
		       placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'wpcore-modern'); ?>"
		       value="<?php echo get_search_query(); ?>"
		       name="s"
		       id="s" />
		<button type="submit" class="btn btn-primary">
			<?php esc_html_e('Search', 'wpcore-modern'); ?>
		</button>
	</div>
</form>
