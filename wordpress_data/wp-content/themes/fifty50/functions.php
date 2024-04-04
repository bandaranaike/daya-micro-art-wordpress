<?php

/**
 * Functions main file
 * @package fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// This theme requires WordPress 4.7 or later.
if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}


/* THEME SETUP
@since Fifty50 1.0.0
   ==================================================== */
// Sets up theme defaults and registers support for various WordPress features.
if (!function_exists('fifty50_setup')) {
	function fifty50_setup()
	{

		// Theme text domain
		load_theme_textdomain('fifty50', get_template_directory() . '/languages');

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support('automatic-feed-links');

		// Add document title tag to HTML <head>.
		add_theme_support('title-tag');

		// Add Page Excerpt support
		add_post_type_support('page', 'excerpt');

		// Add theme support for Secondary Logo.
		add_theme_support('custom-logo', array(
			'flex-width' => true,
		));

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');
		add_theme_support('align-wide');

		// Block Editor color palette.
		$black      = '#000000';
		$grey     = '#848484';
		$white     = '#ffffff';
		$primary = esc_attr(get_theme_mod('fifty50_custom_primary_colour', '#d0b875'));
		$secondary    = esc_attr(get_theme_mod('fifty50_custom_secondary_colour', '#7c8963'));
		$tertiary = esc_attr(get_theme_mod('fifty50_custom_tertiary_colour', '#85723d'));

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__('Black', 'fifty50'),
					'slug'  => 'black',
					'color' => $black,
				),

				array(
					'name'  => esc_html__('Grey', 'fifty50'),
					'slug'  => 'grey',
					'color' => $grey,
				),

				array(
					'name'  => esc_html__('White', 'fifty50'),
					'slug'  => 'white',
					'color' => $white,
				),

				// Default accent colours - Primary is yellow, Secondary is green, Tertiary is brown
				array(
					'name'  => esc_html__('Primary', 'fifty50'),
					'slug'  => 'primary',
					'color' => $primary,
				),
				array(
					'name'  => esc_html__('Secondary', 'fifty50'),
					'slug'  => 'secondary',
					'color' => $secondary,
				),
				array(
					'name'  => esc_html__('Tertiary', 'fifty50'),
					'slug'  => 'tertiary',
					'color' => $tertiary,
				),

			)
		);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__('Extra small', 'fifty50'),
					'shortName' => esc_html_x('XS', 'Font size', 'fifty50'),
					'size'      => 14,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__('Small', 'fifty50'),
					'shortName' => esc_html_x('S', 'Font size', 'fifty50'),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__('Medium', 'fifty50'),
					'shortName' => esc_html_x('M', 'Font size', 'fifty50'),
					'size'      => 18,
					'slug'      => 'medium',
				),
				array(
					'name'      => esc_html__('Large', 'fifty50'),
					'shortName' => esc_html_x('L', 'Font size', 'fifty50'),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__('Extra large', 'fifty50'),
					'shortName' => esc_html_x('XL', 'Font size', 'fifty50'),
					'size'      => 34,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__('Huge', 'fifty50'),
					'shortName' => esc_html_x('XXL', 'Font size', 'fifty50'),
					'size'      => 48,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__('Gigantic', 'fifty50'),
					'shortName' => esc_html_x('XXXL', 'Font size', 'fifty50'),
					'size'      => 60,
					'slug'      => 'gigantic',
				),
			)
		);

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(900, 9999, false);

		// Setup the WordPress core custom background feature.    
		add_theme_support('custom-background', array(
			'default-color'      => '222222',
			'default-image'      => get_template_directory_uri() . '/assets/images/background.jpg',
			'default-preset'     => 'default',
			'default-position-x' => 'center',
			'default-position-y' => 'center',
			'default-size'       => 'cover',
			'default-repeat'     => 'no-repeat',
			'default-attachment' => 'scroll',
			'wp-head-callback'   => 'custom_background_cb'
		));

		// Switch default core markup for search form, comment form, and comments to output valid HTML5
		add_theme_support('html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		));

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' 			=> esc_html__('Top Menu', 'fifty50'),
				'secondary' 		=> esc_html__('Off Canvas Menu', 'fifty50'),
				'footer' 			=> esc_html__('Footer Menu', 'fifty50'),
				'social' 			=> esc_html__('Social Menu', 'fifty50')
			)
		);

		// Additional support
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support('responsive-embeds');
		add_theme_support('custom-line-height');
		add_theme_support('experimental-link-color');
		add_theme_support('custom-spacing');
		add_theme_support('custom-units');
	}
}
add_action('after_setup_theme', 'fifty50_setup');


/* SET CONTENT WIDTH
@since Fifty50 1.0.0
   ==================================================== */
if (!isset($content_width)) {
	$content_width = 750;
}


/* ENQUEUE THEME SCRIPTS
@since Fifty50 1.0.0
   ==================================================== */
if (!function_exists('enqueue_scripts')) :
	function enqueue_scripts()
	{

		$theme_version = wp_get_theme()->get('Version');

		// Check Comments
		if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		// Skip to link
		wp_enqueue_script('fifty50-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), null, true);

		// Theme scripts
		wp_enqueue_script('fifty50-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array('jquery'), $theme_version, true);
		wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), $theme_version, true);
	}
endif;
add_action('wp_enqueue_scripts', 'enqueue_scripts');


/* ENQUEUE THEME STYLES
@since Fifty50 1.0.0
   ==================================================== */
if (!function_exists('enqueue_styles')) :
	function enqueue_styles()
	{

		$theme_version = wp_get_theme()->get('Version');

		// Block styles - Front-end
		wp_enqueue_style('block-styles-css', get_template_directory_uri() . '/assets/css/block-styles.css', array(), null);

		// Bootstrap Icons
		wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/css/bootstrap-icons.css', array(), null);

		// Bootstrap styles
		wp_enqueue_style('bootstrap-reboot', get_template_directory_uri() . '/assets/css/bootstrap-reboot.css', array(), null);
		wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), null);

		// Load our primary stylesheet.
		wp_enqueue_style('fifty50-style', get_stylesheet_uri(), array(), $theme_version);

		// Add customizer css.
		wp_add_inline_style('fifty50-style', fifty50_inline_styles());
	}
endif;
add_action('wp_enqueue_scripts', 'enqueue_styles', 10);


/* EDITOR STYLES FOR THE CLASSIC EDITOR
@since Fifty50 1.0.0
   ==================================================== */
if (!function_exists('fifty50_classic_editor_styles')) :
	function fifty50_classic_editor_styles()
	{
		$classic_editor_styles = array(
			'/assets/css/editor-classic.css',
		);
		add_editor_style($classic_editor_styles);
	}
endif;
add_action('init', 'fifty50_classic_editor_styles');


/* ENQUEUE BLOCK EDITOR STYLES
 @since Fifty50 1.0.0
   ==================================================== */
if (!function_exists('fifty50_block_editor_styles')) :
	function fifty50_block_editor_styles()
	{

		$theme_version = wp_get_theme()->get('Version');

		// Block styles.
		wp_enqueue_style('fifty50-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), $theme_version);
	}
endif;
add_action('enqueue_block_editor_assets', 'fifty50_block_editor_styles', 10);


/* INCLUDES - ADDITIONAL FUNCTIONS & CLASSES
@since Fifty50 1.0.0
   ==================================================== */
// Function files
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/inline-styles.php';
require get_template_directory() . '/inc/sidebars.php';

// Classes
require get_template_directory() . '/classes/class-fifty50-comment-walker.php';

// Customizer
require get_template_directory() . '/inc/customizer/custom-controls/custom-control.php';
require get_template_directory() . '/inc/customizer/customizer.php';

// Load theme structure
require get_template_directory() . '/inc/layouts/blog-layouts.php';
require get_template_directory() . '/inc/layouts/post-layouts.php';
