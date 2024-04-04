<?php

/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$header_layout = esc_attr(get_theme_mod('fifty50_header_layout', 'header1'));
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>

	<div id="page" class="site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'fifty50'); ?></a>

		<?php // Get our side column
		fifty50_sidecolumn(); ?>

		<div id="content" class="site-content">

			<?php // Action hook for any content placed before the top navigation
			do_action('fifty50_before_menu');

			// Load our menu if active and is either in the primary or secondary location
			if ( has_nav_menu( 'primary' ) ) {
				echo '<div id="nav-wrapper">', fifty50_menus() . '</div>';
			} elseif ( has_nav_menu( 'secondary' ) ) {
				fifty50_menus();
			} else {
				echo '<div id="nav-wrapper"></div>';
			}
			
			// Action hook for any content placed after the top navigation
			do_action('fifty50_after_menu');
			?>

			<?php get_template_part('template-parts/sidebar', 'banner'); ?>