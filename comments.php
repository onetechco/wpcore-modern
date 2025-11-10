<?php
/**
 * The template for displaying comments
 *
 * @package WPCore
 */

defined('ABSPATH') || exit;

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area bg-white rounded-lg shadow-md p-8">

	<?php if (have_comments()) : ?>
		<h2 class="comments-title text-2xl font-bold text-gray-900 mb-6">
			<?php
			$comment_count = get_comments_number();
			if ('1' === $comment_count) {
				printf(
					esc_html__('One comment on &ldquo;%1$s&rdquo;', 'wpcore-modern'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'wpcore-modern')),
					number_format_i18n($comment_count),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list space-y-6">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size' => 60,
			));
			?>
		</ol>

		<?php
		the_comments_navigation();

		if (!comments_open()) :
			?>
			<p class="no-comments text-gray-600 mt-6">
				<?php esc_html_e('Comments are closed.', 'wpcore-modern'); ?>
			</p>
			<?php
		endif;

	endif;

	comment_form(array(
		'class_submit' => 'btn btn-primary',
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold text-gray-900 mb-6">',
		'title_reply_after' => '</h3>',
	));
	?>

</div>
