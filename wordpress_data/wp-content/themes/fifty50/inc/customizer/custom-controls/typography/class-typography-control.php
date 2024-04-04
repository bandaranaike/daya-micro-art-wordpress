<?php
/**
 * Customizer Typography Control
 * @package Fifty50
 * @since 1.0.0
 * 
 * Taken from Kirki.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Fifty50_Typography_Control' ) ) {
    
    class Fifty50_Typography_Control extends WP_Customize_Control {
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'fifty50-typography-control/il8n/strings', array(
    			'on'                 => esc_attr__( 'ON', 'fifty50' ),
    			'off'                => esc_attr__( 'OFF', 'fifty50' ),
    			'all'                => esc_attr__( 'All', 'fifty50' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'fifty50' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'fifty50' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'fifty50' ),
    			'greek'              => esc_attr__( 'Greek', 'fifty50' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'fifty50' ),
    			'khmer'              => esc_attr__( 'Khmer', 'fifty50' ),
    			'latin'              => esc_attr__( 'Latin', 'fifty50' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'fifty50' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'fifty50' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'fifty50' ),
    			'arabic'             => esc_attr__( 'Arabic', 'fifty50' ),
    			'bengali'            => esc_attr__( 'Bengali', 'fifty50' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'fifty50' ),
    			'tamil'              => esc_attr__( 'Tamil', 'fifty50' ),
    			'telugu'             => esc_attr__( 'Telugu', 'fifty50' ),
    			'thai'               => esc_attr__( 'Thai', 'fifty50' ),
    			'serif'              => _x( 'Serif', 'font style', 'fifty50' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'fifty50' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'fifty50' ),
    			'font-family'        => esc_attr__( 'Font Family', 'fifty50' ),
    			'font-size'          => esc_attr__( 'Font Size', 'fifty50' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'fifty50' ),
    			'line-height'        => esc_attr__( 'Line Height', 'fifty50' ),
    			'font-style'         => esc_attr__( 'Font Style', 'fifty50' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'fifty50' ),
    			'text-align'         => esc_attr__( 'Text Align', 'fifty50' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'fifty50' ),
    			'none'               => esc_attr__( 'None', 'fifty50' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'fifty50' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'fifty50' ),
    			'top'                => esc_attr__( 'Top', 'fifty50' ),
    			'bottom'             => esc_attr__( 'Bottom', 'fifty50' ),
    			'left'               => esc_attr__( 'Left', 'fifty50' ),
    			'right'              => esc_attr__( 'Right', 'fifty50' ),
    			'center'             => esc_attr__( 'Center', 'fifty50' ),
    			'justify'            => esc_attr__( 'Justify', 'fifty50' ),
    			'color'              => esc_attr__( 'Color', 'fifty50' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'fifty50' ),
    			'variant'            => esc_attr__( 'Variant', 'fifty50' ),
    			'style'              => esc_attr__( 'Style', 'fifty50' ),
    			'size'               => esc_attr__( 'Size', 'fifty50' ),
    			'height'             => esc_attr__( 'Height', 'fifty50' ),
    			'spacing'            => esc_attr__( 'Spacing', 'fifty50' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'fifty50' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'fifty50' ),
    			'light'              => esc_attr__( 'Light 200', 'fifty50' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'fifty50' ),
    			'book'               => esc_attr__( 'Book 300', 'fifty50' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'fifty50' ),
    			'regular'            => esc_attr__( 'Normal 400', 'fifty50' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'fifty50' ),
    			'medium'             => esc_attr__( 'Medium 500', 'fifty50' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'fifty50' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'fifty50' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'fifty50' ),
    			'bold'               => esc_attr__( 'Bold 700', 'fifty50' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'fifty50' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'fifty50' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'fifty50' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'fifty50' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'fifty50' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'fifty50' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'fifty50-typography', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typography.css', null );
            /*
    		 * JavaScript
    		 */
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		
    		// Selectize
    		wp_enqueue_script( 'selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    
    		// Typography
    		wp_enqueue_script( 'fifty50-typography', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typography.js', array(
    			'jquery',
    			'selectize'
    		), false, true );
    
    		$google_fonts   = Fifty50_Fonts::get_google_fonts();
    		$standard_fonts = Fifty50_Fonts::get_standard_fonts();
    		$all_variants   = Fifty50_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $key,
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'fifty50-typography', 'fifty50_all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template() { ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}
    
    }
}