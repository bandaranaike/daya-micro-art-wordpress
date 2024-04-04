<?php
/**
 * Get Customizer functions
 * @package Fifty50
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Register Custom Controls
if( ! function_exists( 'fifty50_register_custom_controls' ) ) :

function fifty50_register_custom_controls( $wp_customize ){
    
    // Load our custom control.
    require_once get_template_directory() . '/inc/customizer/custom-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/select/class-select-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/slider/class-slider-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/typography/class-fonts.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/typography/class-typography-control.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-control-repeater.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'Fifty50_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Fifty50_Select_Control' );
    $wp_customize->register_control_type( 'Fifty50_Slider_Control' );
    $wp_customize->register_control_type( 'Fifty50_Toggle_Control' );
    $wp_customize->register_control_type( 'Fifty50_Typography_Control' ); 

	// Panels

	// Modify default WordPress sections and controls
	$wp_customize->get_control( 'blogdescription' )->label = esc_html__( 'Site Description', 'fifty50' );
	$wp_customize->get_section( 'colors' )->panel = 'colors';
	$wp_customize->get_section( 'colors' )->priority = 12;
	$wp_customize->get_section( 'colors' )->title = esc_html__( 'Main Body', 'fifty50' );
	$wp_customize->get_control( 'site_icon' )->priority = 68;
	$wp_customize->get_control( 'background_color' )->section   = 'fifty50_preset_colours';
	$wp_customize->get_control( 'background_color' )->priority = 40;
}
endif;
add_action( 'customize_register', 'fifty50_register_custom_controls' );