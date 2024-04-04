<?php

/**
 * Other options
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function fifty50_customize_register_other($wp_customize)
{

	$wp_customize->add_section('fifty50_other_settings', array(
		'title'      => esc_html__('Other Options', 'fifty50'),
		'priority'   => 38,
		'capability' => 'edit_theme_options',
	));


	// Hide back to top link
	$wp_customize->add_setting('fifty50_hide_backtotop', array(
		'default'           => 0,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_checkbox',
	));

	$wp_customize->add_control(new Fifty50_Toggle_Control($wp_customize, 'fifty50_hide_backtotop', array(
		'label'    => esc_html__('Hide the Back to Top Link', 'fifty50'),
		'description' => esc_html__('Show or hide the footer Back To Top navigation link.', 'fifty50'),
		'section'  => 'fifty50_other_settings',
	)));

	// Hide banner captions
	$wp_customize->add_setting('fifty50_hide_banner_captions', array(
		'default'           => 0,
		'sanitize_callback' => 'fifty50_sanitize_checkbox',
	));

	$wp_customize->add_control(new Fifty50_Toggle_Control($wp_customize, 'fifty50_hide_banner_captions', array(
		'label'    => esc_html__('Hide Banner Captions', 'fifty50'),
		'description' => esc_html__('Show or hide the banner sidebar image captions when using the image widget.', 'fifty50'),
		'section'  => 'fifty50_other_settings',
	)));

	// Hide edit link
	$wp_customize->add_setting('fifty50_hide_edit', array(
		'default'           => 0,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_checkbox',
	));

	$wp_customize->add_control(new Fifty50_Toggle_Control($wp_customize, 'fifty50_hide_edit', array(
		'label'    => esc_html__('Hide Edit Link', 'fifty50'),
		'description' => esc_html__('Show or hide the edit link from posts and pages. This will not show in the Customizer.', 'fifty50'),
		'section'  => 'fifty50_other_settings',
	)));



	/* SETTINGS FOR THE BACKGROUND_IMAGE TAB SECTION
@since 1.0.0
==================================================== */
	// Site Logo size
	$wp_customize->add_setting('fifty50_sidecolumn_width', array(
		'default'           => 40,
		'sanitize_callback' => 'fifty50_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Fifty50_Slider_Control($wp_customize, 'fifty50_sidecolumn_width', array(
			'section'	  => 'background_image',
			'label'		  => esc_html__('Side Column Width', 'fifty50'),
			'description' => esc_html__('Change the side column width. This will also adjust the main content window.', 'fifty50'),
			'choices'	  => array(
				'min' 	=> 25,
				'max' 	=> 50,
				'step'	=> 1,
			)
		))
	);

	// Side column overlay transparency
	$wp_customize->add_setting('fifty50_sidecolumn_overlay', array(
		'default'           => 0.2,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Fifty50_Slider_Control($wp_customize, 'fifty50_sidecolumn_overlay', array(
			'section'	  => 'background_image',
			'label'		  => esc_html__('Side Column Overlay Transparency', 'fifty50'),
			'description' => esc_html__('Change the level of transparency for the side column image overlay.', 'fifty50'),
			'choices'	  => array(
				'min' 	=> 0,
				'max' 	=> 1,
				'step'	=> 0.05,
			)
		))
	);

	// Side column height on mobile
	$wp_customize->add_setting('fifty50_sidecolumn_mobile_height', array(
		'default'           => 45,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Fifty50_Slider_Control($wp_customize, 'fifty50_sidecolumn_mobile_height', array(
			'section'	  => 'background_image',
			'label'		  => esc_html__('Side Column Height on Mobile', 'fifty50'),
			'description' => esc_html__('Change the height for your side column when viewed in a mobile device. This will show more as you increase the height.', 'fifty50'),
			'choices'	  => array(
				'min' 	=> 30,
				'max' 	=> 100,
				'step'	=> 1,
			)
		))
	);
	
	// Side column text colour
	$wp_customize->add_setting(
		'fifty50_sidecolumn_text_color',
		array(
			'default' => '#fff',
			'sanitize_callback' => 'fifty50_sanitize_hex_colour',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fifty50_sidecolumn_text_color',
			array(
				'label' => esc_html__('Side Column Text Colour', 'fifty50'),
				'section' => 'background_image',
				'settings' => 'fifty50_sidecolumn_text_color',
			)
		)
	);
}
add_action('customize_register', 'fifty50_customize_register_other');
