<?php

/**
 * Layout options
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

function fifty50_customize_register_layout($wp_customize)
{

  $wp_customize->add_section('fifty50_layout_settings', array(
    'title'      => esc_html__('Layout Options', 'fifty50'),
    'priority'   => 21,
    'capability' => 'edit_theme_options',
  ));

  // Sticky Nav
  $wp_customize->add_setting('fifty50_sticky_nav', array(
    'default' => 0,
    'sanitize_callback' => 'fifty50_sanitize_checkbox',
  ));

  $wp_customize->add_control(new Fifty50_Toggle_Control(
    $wp_customize,
    'fifty50_sticky_nav',
    array(
      'label'    => esc_html__('Sticky Top Navigation', 'fifty50'),
      'description' => esc_html__(' Enable to make your top navigation stay fixed in place when you scroll.', 'fifty50'),
      'section'  => 'fifty50_layout_settings',
    )
  ));

  // Blog Layout
  $wp_customize->add_setting(
    'fifty50_blog_layout',
    array(
      'default' => 'center',
      'sanitize_callback' => 'fifty50_sanitize_select',
    )
  );

  $wp_customize->add_control(
    new Fifty50_Select_Control(
      $wp_customize,
      'fifty50_blog_layout',
      array(
        'label' => esc_html__('Blog Layout', 'fifty50'),
        'priority'   => 14,
        'section' => 'fifty50_layout_settings',
        'choices' => fifty50_blog_layout_options()
      ),
    )
  );
}
add_action('customize_register', 'fifty50_customize_register_layout');


// Render the blog content for the selective refresh partial.
function fifty50_customize_partial_blog_content()
{

  $blog_layout = apply_filters('fifty50_blog_layout', get_theme_mod('fifty50_blog_layout', 'center'));

  while (have_posts()) {
    the_post();
    get_template_part('template-parts/content', $blog_layout !== 'center' ? $blog_layout : '');
    get_template_part('template-parts/content', get_post_format());
  }
}
