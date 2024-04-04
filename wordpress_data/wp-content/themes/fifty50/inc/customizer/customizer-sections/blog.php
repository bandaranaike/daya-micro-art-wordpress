<?php

/**
 * Blog Settings
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!function_exists('fifty50_customize_register_blog')) :
	function fifty50_customize_register_blog($wp_customize)
	{

		/** Blog Options */
		$wp_customize->add_section(
			'fifty50_blog_options',
			array(
				'title'    => esc_html__('Blog Options', 'fifty50'),
				'priority' => 22,
			)
		);

		// Heading - blog excerpts
		$wp_customize->add_control(new Fifty50_Note_Control(
			$wp_customize,
			'fifty50_blog_excerpts_note',
			array(
				'label' => esc_html__('Blog Excerpts', 'fifty50'),
				'section' => 'fifty50_blog_options',
				'priority' => 2,
				'settings' => array(),
			)
		));

		/** Blog Excerpt */
		$wp_customize->add_setting(
			'fifty50_blog_excerpt',
			array(
				'default'           => 1,
				'sanitize_callback' => 'fifty50_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new Fifty50_Toggle_Control(
				$wp_customize,
				'fifty50_blog_excerpt',
				array(
					'section'     => 'fifty50_blog_options',
					'priority' => 2,
					'label'	      => esc_html__('Enable Blog Excerpts', 'fifty50'),
					'description' => esc_html__('Enable to show excerpts or disable to show full post content.', 'fifty50'),
				)
			)
		);

		/** Excerpt Length */
		$wp_customize->add_setting(
			'fifty50_excerpt_length',
			array(
				'default' => 35,
				'sanitize_callback' => 'fifty50_sanitize_number_absint',
			)
		);

		$wp_customize->add_control(
			new Fifty50_Slider_Control(
				$wp_customize,
				'fifty50_excerpt_length',
				array(
					'section' => 'fifty50_blog_options',
					'priority' => 3,
					'label' => esc_html__('Excerpt Length', 'fifty50'),
					'description' => esc_html__('Automatically generated excerpt length (in words).', 'fifty50'),
					'choices' => array(
						'min' => 10,
						'max' => 100,
						'step' => 5,
					)
				)
			)
		);


		// Add Partial for Blog Layout and Excerpt Length.
		$wp_customize->selective_refresh->add_partial('fifty50_blog_content_partial', array(
			'selector' => '.site-main',
			'settings' => array(
				'fifty50_blog_layout',
				'fifty50_blog_excerpt',
				'fifty50_excerpt_length',
			),
			'render_callback'  => 'fifty50_customize_partial_blog_content',
			'fallback_refresh' => false,
		));
	}
endif;

add_action('customize_register', 'fifty50_customize_register_blog');
