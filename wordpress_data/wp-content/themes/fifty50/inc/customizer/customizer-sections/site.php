<?php

/**
 * Theme Customizer - Site Identity tab
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function fifty50_customize_register_site($wp_customize)
{

	/** Add postMessage support for site title and description */
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('background_color')->transport = 'refresh';
	$wp_customize->get_setting('background_image')->transport = 'refresh';


	// Show site title
	$wp_customize->add_setting('fifty50_show_site_title',	array(
		'default' => true,
		'transport'  => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_checkbox',
	));

	$wp_customize->add_control(new Fifty50_Toggle_Control(
		$wp_customize,
		'fifty50_show_site_title',
		array(
			'label'    => esc_html__('Show the Site Title', 'fifty50'),
			'description' => esc_html__('Show or hide the site title.', 'fifty50'),
			'section'  => 'title_tagline',
		)
	));

	// Show site description
	$wp_customize->add_setting('fifty50_show_site_desc', array(
		'default' => true,
		'transport'  => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_checkbox',
	));

	$wp_customize->add_control(new Fifty50_Toggle_Control(
		$wp_customize,
		'fifty50_show_site_desc',
		array(
			'label'    => esc_html__('Show the Site Description', 'fifty50'),
			'description' => esc_html__('Show or hide the site tagline [description].', 'fifty50'),
			'section'  => 'title_tagline',
		)
	));

	// Site title colour
	$wp_customize->add_setting('fifty50_site_title_colour', array(
		'default'           => '#fff',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'fifty50_site_title_colour',
		array(
			'label'       => esc_html__('Site Title Colour', 'fifty50'),
			'description' => esc_html__('Sets the site title colour in the sidebar area.', 'fifty50'),
			'section'     => 'title_tagline',
		)
	));

	// Site tagline colour
	$wp_customize->add_setting('fifty50_tagline_colour', array(
		'default'           => '#fff',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'fifty50_tagline_colour',
		array(
			'label'       => esc_html__('Site Tagline Colour', 'fifty50'),
			'description' => esc_html__('Sets the site tagline [ description ] colour in the header area.', 'fifty50'),
			'section'     => 'title_tagline',
		)
	));

	// Site Logo size
	$wp_customize->add_setting('fifty50_sidecolumn_logo_width', array(
		'default'           => 100,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Fifty50_Slider_Control($wp_customize, 'fifty50_sidecolumn_logo_width', array(
			'section'	  => 'title_tagline',
			'label'		  => esc_html__('Site Logo Size', 'fifty50'),
			'description' => esc_html__('Change the site logo size for your sidebar column.', 'fifty50'),
			'choices'	  => array(
				'min' 	=> 50,
				'max' 	=> 300,
				'step'	=> 1,
			)
		))
	);


	// Site Title Font Size for the custom header image
	$wp_customize->add_setting('site_title_font_size', array(
		'default'           => 5,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'fifty50_sanitize_number_decimal',
	));

	$wp_customize->add_control(
		new Fifty50_Slider_Control($wp_customize, 'site_title_font_size', array(
			'section'	  => 'title_tagline',
			'label'		  => esc_html__('Site Title Font Size', 'fifty50'),
			'description' => esc_html__('Change the font size of your site title.', 'fifty50'),
			'priority'    => 65,
			'choices'	  => array(
				'min' 	=> 1,
				'max' 	=> 10,
				'step'	=> 0.25,
			)
		))
	);
}
add_action('customize_register', 'fifty50_customize_register_site');
