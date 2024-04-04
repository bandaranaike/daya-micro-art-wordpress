<?php

/**
 * Register theme sidebars
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function fifty50_widgets_init()
{

	register_sidebar(array(
		'name' => esc_html__('Banner', 'fifty50'),
		'id' => 'banner',
		'description' => esc_html__('Banner sidebar for images and sliders.', 'fifty50'),
		'before_widget' => '<div id="%1$s" class="banner widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 1', 'fifty50'),
		'id'            => 'bottom1',
		'description'   => esc_html__('First sidebar of the bottom group located above the footer area.', 'fifty50'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Bottom 2', 'fifty50'),
		'id'            => 'bottom2',
		'description'   => esc_html__('Second sidebar of the bottom group located above the footer area.', 'fifty50'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer', 'fifty50'),
		'id' => 'footer',
		'description' => esc_html__('Add a widget to your footer area.', 'fifty50'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action('widgets_init', 'fifty50_widgets_init');


/*----------------------------------------------------------------------------------------------- 
	Grouped Sidebars - Bottom
	This will add classes based on how many sidebars are active.
--------------------------------------------------------------------------------------------------- */
function fifty50_bottom_group()
{
	$count = 0;
	if (is_active_sidebar('bottom1'))
		$count++;
	if (is_active_sidebar('bottom2'))
		$count++;
	$class = '';
	switch ($count) {
		case '1':
			$class = 'col widget-area';
			break;
		case '2':
			$class = 'col-md-6 widget-area';
			break;
	}
	if ($class)
		echo 'class="' . esc_attr($class) . '"';
}
