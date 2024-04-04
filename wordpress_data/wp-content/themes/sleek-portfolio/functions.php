<?php
/**
 * After setup theme hook
 */
function sleek_portfolio_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'sleek-portfolio', get_stylesheet_directory() . '/languages' );

    add_image_size( 'sleek-portfolio-banner', 540, 540, true);
}
add_action( 'after_setup_theme', 'sleek_portfolio_theme_setup', 100 );

function sleek_portfolio_styles() {
	$my_theme = wp_get_theme();
	$version = $my_theme['Version'];

    if( perfect_portfolio_is_woocommerce_activated() ){
        //dependency call when woocommerce is activated
        $array_style = array( 'perfect-portfolio-woocommerce-style','perfect-portfolio-style' );
    }else{
        $array_style = array( 'perfect-portfolio-style' );
    }
    
    wp_enqueue_style( 'perfect-portfolio-style', get_template_directory_uri()  . '/style.css', array() );
    
    wp_enqueue_style( 'sleek-portfolio-style', get_stylesheet_directory_uri() . '/style.css', $array_style, $version );
}
add_action( 'wp_enqueue_scripts', 'sleek_portfolio_styles');

function sleek_portfolio_customize_register( $wp_customize ) {
    
    $wp_customize->get_setting('primary_font')->default  = 'Rubik';
    $wp_customize->get_control('primary_font')->priority = 10;
    
    $wp_customize->get_control('ed_localgoogle_fonts')->priority = 30;
    $wp_customize->get_control('ed_localgoogle_fonts')->priority = 40;
    $wp_customize->get_control('flush_google_fonts')->priority   = 50;

    /** Secondary Font */
    $wp_customize->add_setting(
        'secondary_font',
        array(
            'default'           => 'Manrope',
            'sanitize_callback' => 'perfect_portfolio_sanitize_select'
        )
    );

    $wp_customize->add_control(
        new Perfect_Portfolio_Select_Control(
            $wp_customize,
            'secondary_font',
            array(
                'label'       => __( 'Secondary Font', 'sleek-portfolio' ),
                'description' => __( 'Secondary font of the site.', 'sleek-portfolio' ),
                'section'     => 'typography_settings',
                'choices'     => perfect_portfolio_get_all_fonts(), 
                'priority'    => 10,
            )
        )
    );
}
add_action( 'customize_register', 'sleek_portfolio_customize_register', 40 );

/**
 * Extract About Section Image Id
*/
function sleek_portfolio_about_section_image_id(){
    if( perfect_portfolio_is_rtc_activated() ){
        $widgets_array = sleek_portfolio_widget_array('About Section');

        if ( !empty( $widgets_array[0]->image ) ) {
            $image_id = $widgets_array[0]->image;
            return $image_id;  
        }
    }
}
add_action('wp_footer','sleek_portfolio_about_section_image_id');

function sleek_portfolio_widget_array( $sidebar_name ) {
    global $wp_registered_sidebars, $wp_registered_widgets;
    // Holds the final data to return
    $output = array();
    // Loop over all of the registered sidebars looking for the one with the same name as $sidebar_name
    
    foreach ( $wp_registered_sidebars as $sidebar ) {
        if ( $sidebar['name'] == $sidebar_name ) {
            // We now have the Sidebar ID, we can stop our loop and continue.
            $sidebar_id = $sidebar['id'];
            break;
        }
    }
    $sibebar_id = false;
    if ( ! $sidebar_id ) {
        // There is no sidebar registered with the name provided.
        return $output;
    }
    // A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widget_ids = $sidebars_widgets[ $sidebar_id ];
    if ( ! $widget_ids ) {
        // Without proper widget_ids we can't continue.
        return array();
    }
    // Loop over each widget_id so we can fetch the data out of the wp_options table.
    foreach ( $widget_ids as $id ) {
        // The name of the option in the database is the name of the widget class.
        $option_name = $wp_registered_widgets[ $id ]['callback'][0]->option_name;
        // Widget data is stored as an associative array. To get the right data we need to get the right key which is stored in $wp_registered_widgets
        $key = $wp_registered_widgets[ $id ]['params'][0]['number'];
        $widget_data = get_option( $option_name );
        // Add the widget data on to the end of the output array.
        $output[] = (object) $widget_data[ $key ];
    }
    return $output;
}

/**
 * Parent Functions
*/
require get_stylesheet_directory() . '/inc/parent-functions.php';