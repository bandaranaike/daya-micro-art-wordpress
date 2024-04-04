<?php

/**
 * Color Setting
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

function fifty50_customize_register_colour($wp_customize)
{

  // Colour Options Panel
  $wp_customize->add_panel('colors', array(
    'priority' => 40,
    'title'    => esc_html__('Colours', 'fifty50'),
  ));

  // SECTION - PRESET COLOURS 
  $wp_customize->add_section('fifty50_preset_colours', array(
    'title' => esc_html__('Preset Colours', 'fifty50'),
    'priority' => 10,
    'panel' => 'colors'
  ));

  // SECTION - CONTENT COLOURS 
  $wp_customize->add_section('fifty50_content_colours', array(
    'title' => esc_html__('Content Colors', 'fifty50'),
    'priority' => 15,
    'panel' => 'colors'
  ));

  // SECTION - NAV COLOURS
  $wp_customize->add_section('fifty50_nav_colours', array(
    'title' => esc_html__('Navigation Colors', 'fifty50'),
    'priority' => 20,
    'panel' => 'colors'
  ));

  /* PRESET SETTINGS
@since 1.0.0
==================================================== */
  // Presets
  $wp_customize->add_setting(
    'fifty50_presets',
    array(
      'default' => 'preset1',
      'sanitize_callback' => 'fifty50_sanitize_select',
    )
  );

  $wp_customize->add_control(
    new Fifty50_Radio_Image_Control(
      $wp_customize,
      'fifty50_presets',
      array(
        'label' => esc_html__('Preset Groups', 'fifty50'),
        'description' => esc_html__('Choose a preset colour palette for your theme. This will load a variety of accent colours for select elements in your page.', 'fifty50'),
        'section' => 'fifty50_preset_colours',
        'type' => 'radio-image',
        'choices' => fifty50_colour_preset_options()
      ),
    )
  );


  /** Enable Custom Accent Colours */
  $wp_customize->add_setting(
    'fifty50_custom_accent_colours',
    array(
      'default'           => false,
      'sanitize_callback' => 'fifty50_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    new Fifty50_Toggle_Control(
      $wp_customize,
      'fifty50_custom_accent_colours',
      array(
        'section'     => 'fifty50_preset_colours',
        'label'        => esc_html__('Custom Accent Colours', 'fifty50'),
        'description' => esc_html__('Enable to change the theme accent colours to be your own.', 'fifty50'),
      )
    )
  );


  // Custom Primary Colour
  $wp_customize->add_setting('fifty50_custom_primary_colour', array(
    'default'           => '#d0b875',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_custom_primary_colour',
    array(
      'label'       => esc_html__('Primary Colour', 'fifty50'),
      'description' => esc_html__('Sets a custom primary accent colour for your theme.', 'fifty50'),
      'section'     => 'fifty50_preset_colours',
      'active_callback' => 'fifty50_custom_accent_colours_show',
    )
  ));

  // Custom Secondary Colour
  $wp_customize->add_setting('fifty50_custom_secondary_colour', array(
    'default'           => '#7c8963',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_custom_secondary_colour',
    array(
      'label'       => esc_html__('Secondary Colour', 'fifty50'),
      'description' => esc_html__('Sets a custom secondary accent colour for your theme.', 'fifty50'),
      'section'     => 'fifty50_preset_colours',
      'active_callback' => 'fifty50_custom_accent_colours_show',
    )
  ));

  // Custom Tertiary Colour
  $wp_customize->add_setting('fifty50_custom_tertiary_colour', array(
    'default'           => '#85723d',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_custom_tertiary_colour',
    array(
      'label'       => esc_html__('Tertiary Colour', 'fifty50'),
      'description' => esc_html__('Sets a custom tertiary (third) accent colour for your theme.', 'fifty50'),
      'section'     => 'fifty50_preset_colours',
      'active_callback' => 'fifty50_custom_accent_colours_show',
    )
  ));

  /* CONTENT COLOUR SETTINGS
==================================================== */
  $wp_customize->add_setting('fifty50_content_bg_colour', array(
    'default'           => '#fff',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_content_bg_colour',
    array(
      'label'       => esc_html__('Body Content Background', 'fifty50'),
      'description' => esc_html__('Unless a preset changes the colour, you can customize your body and content area background colour.', 'fifty50'),
      'section'     => 'colors',
    )
  ));

  // Body text colour
  $wp_customize->add_setting(
    'fifty50_content_area_text_colour',
    array(
      'default' => '#646464',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_content_area_text_colour',
      array(
        'label' => esc_html__('Body Text Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_content_area_text_colour',
      )
    )
  );

  // Secondary colour
  $wp_customize->add_setting(
    'fifty50_secondary_text_colour',
    array(
      'default' => '#7c7c7c',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_secondary_text_colour',
      array(
        'label' => esc_html__('Secondary Text Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_secondary_text_colour',
      )
    )
  );

  // Headings colour
  $wp_customize->add_setting(
    'fifty50_headings_colour',
    array(
      'default' => '#333',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_headings_colour',
      array(
        'label' => esc_html__('Headings Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_headings_colour',
      )
    )
  );

  // Headings line colour
  $wp_customize->add_setting(
    'fifty50_heading_line_color',
    array(
      'default' => '#cfcfcf',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_heading_line_color',
      array(
        'label' => esc_html__('Headings Line Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_heading_line_color',
      )
    )
  );

  // Content links
  $wp_customize->add_setting(
    'fifty50_content_links',
    array(
      'default' => '#d0b875',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_content_links',
      array(
        'label' => esc_html__('Content Links', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_content_links',
      )
    )
  );




  // Banner caption background
  $wp_customize->add_setting(
    'fifty50_banner_caption',
    array(
      'default' => '#000',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_banner_caption',
      array(
        'label' => esc_html__('Banner Caption Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_banner_caption',
      )
    )
  );

  // Banner caption text
  $wp_customize->add_setting(
    'fifty50_banner_caption_text_color',
    array(
      'default' => '#fff',
      'sanitize_callback' => 'fifty50_sanitize_hex_colour',
      'transport' => 'postMessage'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'fifty50_banner_caption_text_color',
      array(
        'label' => esc_html__('Banner Caption Text Colour', 'fifty50'),
        'section' => 'colors',
        'settings' => 'fifty50_banner_caption_text_color',
      )
    )
  );



  /* NAVIGATION COLOUR SETTINGS
==================================================== */
  $wp_customize->add_setting('fifty50_nav_colour', array(
    'default'           => '#555555',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_nav_colour',
    array(
      'label'       => esc_html__('Primary Nav Link Colour', 'fifty50'),
      'description' => esc_html__('This sets the colour for your primary menu links.', 'fifty50'),
      'section'     => 'fifty50_nav_colours',
    )
  ));


  // Mobile menu line separators
  $wp_customize->add_setting('fifty50_mobile_line_separators', array(
    'default'           => '#000',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_mobile_line_separators',
    array(
      'label'       => esc_html__('Mobile Menu Line Separators', 'fifty50'),
      'description' => esc_html__('This sets the colour for your mobile menu line separators.', 'fifty50'),
      'section'     => 'fifty50_nav_colours',
    )
  ));

  // Pagination background
  $wp_customize->add_setting('fifty50_pagination_bg', array(
    'default'           => '#f2f2f2',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_pagination_bg',
    array(
      'label'       => esc_html__('Pagination Number Backgrounds', 'fifty50'),
      'description' => esc_html__('This sets the colour for the non-active blog pagination background numbers.', 'fifty50'),
      'section'     => 'fifty50_nav_colours',
    )
  ));

  // Pagination numbers
  $wp_customize->add_setting('fifty50_pagination_numbers', array(
    'default'           => '#333',
    'transport' => 'postMessage',
    'sanitize_callback' => 'fifty50_sanitize_hex_colour'
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'fifty50_pagination_numbers',
    array(
      'label'       => esc_html__('Pagination Numbers', 'fifty50'),
      'description' => esc_html__('This sets the colour for the non-active blog pagination numbers numbers.', 'fifty50'),
      'section'     => 'fifty50_nav_colours',
    )
  ));
}
add_action('customize_register', 'fifty50_customize_register_colour');


/* CALLBACKS
==================================================== */
// Show custom accent colour selectors callback
function fifty50_custom_accent_colours_show($control)
{
  if ($control->manager->get_setting('fifty50_custom_accent_colours')->value() == 'true') {
    return true;
  } else {
    return false;
  }
}
