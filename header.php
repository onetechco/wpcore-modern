<?php
/**
 * The header template
 *
 * @package WPCore
 * @author Phong Nguyen <https://phongnguyen.net>
 */

defined('ABSPATH') || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<?php
// Get header template based on page settings
$header_template = wpcore_get_header_template();

// Add body class for transparent header
$body_classes = array('antialiased');
if ($header_template === 'transparent') {
	$body_classes[] = 'transparent-header';
}
?>

<body <?php body_class($body_classes); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen flex flex-col">
	<a class="skip-link screen-reader-text" href="#primary">
		<?php esc_html_e('Skip to content', 'wpcore-modern'); ?>
	</a>

	<?php
	// Get header template part
	get_template_part('template-parts/header/header', $header_template);
	?>

	<main id="main-content" class="site-main flex-1">
