<?php

/**
 * Upgrade Theme Info
 * @package Fifty50
 * @since 1.0.3
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Load the premium upgrade info when using the free version
function fifty50_customizer_fifty50_upgrade($wp_customize)
{

	$wp_customize->add_section('fifty50_upgrade', array(
		'title'       => esc_html__('Fifty50 Pro Features - Save $10', 'fifty50'),
		'priority'    => 5,
	));

	/** Important Links */
	$wp_customize->add_setting(
		'fifty50_upgrade_theme',
		array(
			'default' => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$fifty50_upgrade = '<div class="upgrade-pro">';
	$fifty50_upgrade .= '<p class="rp-discount">';
	$fifty50_upgrade .= esc_html__('Save $10 (Limited Time Offer!) if you decide to upgrade to the Pro version (plugin) option with this discount code on checkout: ', 'fifty50');
	$fifty50_upgrade .= '<span class="rp-discount-code">';
	$fifty50_upgrade .= 'FIFTY5010';
	$fifty50_upgrade .= '</span></p>';
	$fifty50_upgrade .= '<p class="rp-pro-title">';
	$fifty50_upgrade .= esc_html__('Pro Features: ', 'fifty50');

	$fifty50_upgrade .= '</p><ul class="rp-pro-list">';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Custom Side Column for Categories', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Custom Side Column Post Images', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Custom Side Column Page Images', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; 6 Blog Styles', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; 2 Post Styles', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Custom Blog Intro', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Customizable Text Labels', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Custom Excerpt Sizing', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Auto Create Featured Image Thumbnails', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Make All Images Black &amp; White', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Customized Mailchimp Signup', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Customized Contact 7 Form', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Related Posts w/Thumbnails', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Author Widget w/Thumbnail', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Comments Widget w/Thumbnails', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Show/Hide Blog &amp; Post Elements', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('&bull; Disable Gutenberg Theme Styles', 'fifty50') . '</li>';
	$fifty50_upgrade .= '<li>' . esc_html('...and much more!', 'fifty50') . '</li></ul>';


	$fifty50_upgrade .= esc_html__('Even though the FREE version of Fifty50 offers a lot, you may want to opt-in for more features.', 'fifty50');
	$fifty50_upgrade .= '<p>';
	$fifty50_upgrade .= sprintf(__('%1$sView Details%2$s', 'fifty50'),  '<a class="rp-get-pro button" href="' . esc_url('https://www.roughpixels.com/themes/fifty50/') . '" target="_blank">', '</a>');
	$fifty50_upgrade .= '</p></div>';


	$wp_customize->add_control(
		new Fifty50_Note_Control(
			$wp_customize,
			'fifty50_upgrade_theme',
			array(
				'section'     => 'fifty50_upgrade',
				'label'	      => esc_html__('Fifty50 Pro', 'fifty50'),
				'description' => $fifty50_upgrade
			)
		)
	);
}

add_action('customize_register', 'fifty50_customizer_fifty50_upgrade', 10);