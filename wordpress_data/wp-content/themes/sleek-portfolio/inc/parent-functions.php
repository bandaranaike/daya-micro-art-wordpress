<?php

/**
 * Filter to add bg color of cta section widget
 */    
function perfect_portfolio_cta_section_bgcolor_filter(){
    return '#f2643f';
}

function perfect_portfolio_dynamic_css(){
    
    $primary_font     = get_theme_mod( 'primary_font', 'Rubik' );
    $primary_fonts    = perfect_portfolio_get_fonts( $primary_font, 'regular' );
    $secondary_font   = get_theme_mod( 'secondary_font', 'Manrope' );
    $secondary_fonts  = perfect_portfolio_get_fonts( $secondary_font, 'regular' );
    $site_title_font  = get_theme_mod( 'site_title_font', 'Poppins' );
    $site_title_fonts = perfect_portfolio_get_fonts( $site_title_font, 'regular' );
    
    echo "<style type='text/css' media='all'>"; ?>
    
    /*Typography*/
    body,
    button,
    input,
    select,
    optgroup,
    textarea{
        font-family : <?php echo wp_kses_post( $primary_fonts['font'] ); ?>;
    }
    
    section[class*="-section"] .widget-title,
    section[class*="-section"] .widget-title span, .section-title span,
    .related .related-title, 
    .additional-posts .title,
    .top-footer .widget .widget-title{
        font-family : <?php echo wp_kses_post( $secondary_fonts['font'] ); ?>;
    }

    .site-branding .site-title,
    .site-branding .site-description{
        font-family : <?php echo wp_kses_post( $site_title_fonts['font'] ); ?>;
    }

    <?php echo "</style>";
}
add_action( 'wp_head', 'perfect_portfolio_dynamic_css', 100 );

function perfect_portfolio_fonts_url(){
    $fonts_url               = '';
    $primary_font       = get_theme_mod( 'primary_font', 'Rubik' );
    $ig_primary_font    = perfect_portfolio_is_google_font( $primary_font );
    $secondary_font     = get_theme_mod( 'secondary_font', 'Manrope' );
    $ig_secondary_font  = perfect_portfolio_is_google_font( $secondary_font );
    $site_title_font    = get_theme_mod( 'site_title_font', 'Poppins' );
    $ig_site_title_font = perfect_portfolio_is_google_font( $site_title_font );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'sleek-portfolio' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'sleek-portfolio' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'sleek-portfolio' );
    
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();

        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = perfect_portfolio_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }

        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = perfect_portfolio_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            $site_title_var = perfect_portfolio_check_varient( $site_title_font, 'regular', true );
            if( $site_title_var ) {
                $site_title_var = ':' . $site_title_var;    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}

function perfect_portfolio_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="tc-wrapper">
            <div class="copyright">           
                <?php if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
                } 
                perfect_portfolio_get_footer_copyright();
                esc_html_e( 'Sleek Portfolio | Developed By ', 'sleek-portfolio' );
                echo '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Themes', 'sleek-portfolio' ) . '</a>.';
                
                printf( esc_html__( ' Powered by %s', 'sleek-portfolio' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'sleek-portfolio' ) ) .'" target="_blank">WordPress</a>.' );
            ?>               
            </div>
            <div class="foot-social">
                <?php perfect_portfolio_social_links(); ?>
            </div>
        </div>
    </div>
    <?php
}