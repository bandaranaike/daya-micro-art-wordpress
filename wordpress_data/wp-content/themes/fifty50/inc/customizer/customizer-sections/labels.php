<?php

/**
 * Label Options
 * Register the label options section, settings and controls for Theme Customizer
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Label Options
if (!function_exists('fifty50_customize_register_label_options')) :
	function fifty50_customize_register_label_options($wp_customize)
	{

		// Add Sections for label options.
		$wp_customize->add_section('fifty50_label_options', array(
			'title'    => esc_html__('Label Options', 'fifty50'),
			'priority' => 27,
		));

		/** Prefix Archive Page */
		$wp_customize->add_setting(
			'fifty50_hide_prefix_archive',
			array(
				'default'           => false,
				'transport' => 'postMessage',
				'sanitize_callback' => 'fifty50_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			new Fifty50_Toggle_Control(
				$wp_customize,
				'fifty50_hide_prefix_archive',
				array(
					'section'     => 'fifty50_label_options',
					'priority' => 1,
					'label'	      => esc_html__('Hide Prefix in Archive Pages', 'fifty50'),
					'description' => esc_html__('Enable to hide the archive prefix labels from archive titles.', 'fifty50'),
				)
			)
		);

		// Footer Copyright
		$wp_customize->add_setting('fifty50_copyright', array(
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage'
		));

		$wp_customize->add_control('fifty50_copyright', array(
			'type'    => 'text',
			'label'   => esc_html__('Copyright Name', 'fifty50'),
			'description' => esc_html__('Enter your name, website name, or company name [ no html ].', 'fifty50'),
			'priority' => 8,
			'section' => 'fifty50_label_options',
		));
	}
endif;

add_action('customize_register', 'fifty50_customize_register_label_options', 12);
