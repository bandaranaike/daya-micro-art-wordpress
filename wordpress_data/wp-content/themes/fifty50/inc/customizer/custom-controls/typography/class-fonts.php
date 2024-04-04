<?php
/**
 * Fonts
 * Used for compiling the standard and Google fonts, along with all the variants (weights).
 * @package Fifty50
 * @since 1.0.0
 * 
 * Taken from Kirki.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'Fifty50_Fonts' ) ) {
	return;
}

final class Fifty50_Fonts {

	/**
	 * One instance of Fifty50_Fonts
	 *
	 * @var Fifty50_Fonts
	 */
	private static $instance = null;

	/**
	 * Array of all Google Fonts
	 *
	 * @var array|null
	 */
	public static $google_fonts = null;

	/**
	 * Key used in transient name
	 *
	 * @var string
	 * @access public
	 */
	public static $transient_key = '';

	/**
	 * Time in seconds to cache the results for
	 *
	 * @var int
	 * @access public
	 */
	public static $cache_time = 0;

	/**
	 * Whether or not to cache the Google response.
	 * Only set this to true if debugging.
	 *
	 * @var bool
	 * @access public
	 */
	public static $cache = true;

	/**
	 * constructor.
	 */
	private function __construct() {
	}

	/**
	 * Get the one, true instance of this class.
	 * Prevents performance issues since this is only loaded once.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Compile font options from different sources.
	 *
	 * @return array All available fonts.
	 */
	public static function get_all_fonts() {
		$standard_fonts = self::get_standard_fonts();
		$google_fonts   = self::get_google_fonts();

		return apply_filters( 'fifty50-fonts/fonts/all', array_merge( $standard_fonts, $google_fonts ) );
	}

	/**
	 * Return an array of standard websafe fonts.
	 *
	 * @return array Standard websafe fonts.
	 */
	public static function get_standard_fonts() {
		return apply_filters( 'fifty50-fonts/fonts/standard_fonts', array(
			'georgia-serif' => array(
    			'label' => _x( 'Georgia', 'font style', 'fifty50' ),
    			'stack' => 'georgia-serif',
    		),
            'palatino-serif' => array(
    			'label' => _x( 'Palatino Linotype, Book Antiqua, Palatino', 'font style', 'fifty50' ),
    			'stack' => 'palatino-serif',
    		),
            'times-serif' => array(
    			'label' => _x( 'Times New Roman, Times', 'font style', 'fifty50' ),
    			'stack' => 'times-serif',
    		),
            'arial-helvetica' => array(
    			'label' => _x( 'Arial, Helvetica', 'font style', 'fifty50' ),
    			'stack' => 'arial-helvetica',
    		),
            'arial-gadget' => array(
    			'label' => _x( 'Arial Black, Gadget', 'font style', 'fifty50' ),
    			'stack' => 'arial-gadget',
    		),
    		'comic-cursive' => array(
    			'label' => _x( 'Comic Sans MS, cursive', 'font style', 'fifty50' ),
    			'stack' => 'comic-cursive',
    		),
    		'impact-charcoal'  => array(
    			'label' => _x( 'Impact, Charcoal', 'font style', 'fifty50' ),
    			'stack' => 'impact-charcoal',
    		),
            'lucida' => array(
    			'label' => _x( 'Lucida Sans Unicode, Lucida Grande', 'font style', 'fifty50' ),
    			'stack' => 'lucida',
    		),
            'tahoma-geneva' => array(
    			'label' => _x( 'Tahoma, Geneva', 'font style', 'fifty50' ),
    			'stack' => 'tahoma-geneva',
    		),
    		'trebuchet-helvetica' => array(
    			'label' => _x( 'Trebuchet MS, Helvetica', 'font style', 'fifty50' ),
    			'stack' => 'trebuchet-helvetica',
    		),
    		'verdana-geneva'  => array(
    			'label' => _x( 'Verdana, Geneva', 'font style', 'fifty50' ),
    			'stack' => 'verdana-geneva',
    		),
            'courier' => array(
    			'label' => _x( 'Courier New, Courier', 'font style', 'fifty50' ),
    			'stack' => 'courier',
    		),
            'lucida-monaco' => array(
    			'label' => _x( 'Lucida Console, Monaco', 'font style', 'fifty50' ),
    			'stack' => 'lucida-monaco',
    		)
		) );
	}

	/**
	 * Return an array of all available Google Fonts.
	 *
	 * @return array All Google Fonts.
	 */
	public static function get_google_fonts() {

		if ( null === self::$google_fonts || empty( self::$google_fonts ) ) {

			$fonts = array(
				'body' => ''
			);

			// If the Google Fonts API key is set, then pull data direct from Google.
			if ( defined( 'GOOGLE_FONTS_API_KEY' ) && GOOGLE_FONTS_API_KEY ) {

				// Cache the data from Google.(NEED TO CHK)
				if ( false === ( $fonts = get_transient( self::$transient_key ) ) || false === self::$cache ) {
					$google_api = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=' . GOOGLE_FONTS_API_KEY;
					$fonts      = wp_remote_get( $google_api, array( 'sslverify' => false ) );
					set_transient( self::$transient_key, $fonts, self::$cache_time );
				}

			} else {
				$fonts = include wp_normalize_path( get_template_directory() . '/inc/customizer/custom-controls/typography/webfonts.php' );
			}
			
			$google_fonts = array();

			if ( is_array( $fonts ) ) {
				foreach ( $fonts['items'] as $font ) {
					$google_fonts[ $font['family'] ] = array(
						'label'    => $font['family'],
						'variants' => $font['variants'],						
						'category' => $font['category'],
					);
				}
			}

			self::$google_fonts = apply_filters( 'fifty50-fonts/fonts/google_fonts', $google_fonts );

		}

		return self::$google_fonts;

	}

	/**
	 * Google Font Variants
	 *
	 * @return array
	 */
	public static function get_all_variants() {
		return apply_filters( 'fifty50-fonts/fonts/font_variants', array(
			'100'       => esc_attr__( 'Ultra-Light 100', 'fifty50' ),
			'100italic' => esc_attr__( 'Ultra-Light 100 Italic', 'fifty50' ),
			'200'       => esc_attr__( 'Light 200', 'fifty50' ),
			'200italic' => esc_attr__( 'Light 200 Italic', 'fifty50' ),
			'300'       => esc_attr__( 'Book 300', 'fifty50' ),
			'300italic' => esc_attr__( 'Book 300 Italic', 'fifty50' ),
			'regular'   => esc_attr__( 'Normal 400', 'fifty50' ),
			'italic'    => esc_attr__( 'Normal 400 Italic', 'fifty50' ),
			'500'       => esc_attr__( 'Medium 500', 'fifty50' ),
			'500italic' => esc_attr__( 'Medium 500 Italic', 'fifty50' ),
			'600'       => esc_attr__( 'Semi-Bold 600', 'fifty50' ),
			'600italic' => esc_attr__( 'Semi-Bold 600 Italic', 'fifty50' ),
			'700'       => esc_attr__( 'Bold 700', 'fifty50' ),
			'700italic' => esc_attr__( 'Bold 700 Italic', 'fifty50' ),
			'800'       => esc_attr__( 'Extra-Bold 800', 'fifty50' ),
			'800italic' => esc_attr__( 'Extra-Bold 800 Italic', 'fifty50' ),
			'900'       => esc_attr__( 'Ultra-Bold 900', 'fifty50' ),
			'900italic' => esc_attr__( 'Ultra-Bold 900 Italic', 'fifty50' ),
		) );
	}

	/**
	 * Is Google Font
	 *
	 * @param string $fontname
	 */
	public static function is_google_font( $fontname ) {
		return ( array_key_exists( $fontname, self::$google_fonts ) );
	}

	/**
	 * Returns an array of all font choices
	 *
	 * @return array
	 */
	public static function get_font_choices() {
		$fonts       = self::get_all_fonts();
		$fonts_array = array();
		foreach ( $fonts as $key => $args ) {
			$fonts_array[ $key ] = $key;
		}

		return $fonts_array;
	}

	/**
	 * Sanitize Typography Control
	 *
	 * @param array $value
	 *
	 * @access public
	 * @return array
	 */
	public static function sanitize_typography( $value ) {

		if ( ! is_array( $value ) ) {
			return array();
		}

		$sanitized_value = array();

		// Sanitize font family.
		if ( isset( $value['font-family'] ) ) {
			$sanitized_value['font-family'] = esc_attr( $value['font-family'] );
		}

		// Use a valid variant.
		if ( isset( $value['variant'] ) ) {
			$valid_variants = array(
				'regular',
				'italic',
				'100',
				'200',
				'300',
				'500',
				'600',
				'700',
				'700italic',
				'900',
				'900italic',
				'100italic',
				'300italic',
				'500italic',
				'800',
				'800italic',
				'600italic',
				'200italic',
			);

			$sanitized_value['variant'] = ( in_array( $value['variant'], $valid_variants ) ) ? sanitize_text_field( $value['variant'] ) : 'regular';
		}

		return $sanitized_value;

	}
}