<?php
/**
 * Customizer Control: Fifty50
 * @package Fifty50
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Fifty50_Select_Control' ) ) {

	// Select control.
	class Fifty50_Select_Control extends Wp_Customize_Control {

		public $type = 'fifty50';

		public $multiple = 1;
        
        public $tooltip = '';
        
		public function to_json() {
			parent::to_json();
			
            if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			} else {
				$this->json['default'] = $this->setting->default;
			}
			
            $this->json['multiple'] = $this->multiple;
            $this->json['value']    = $this->value();
			$this->json['choices']  = $this->choices;
			$this->json['link']     = $this->get_link();
            $this->json['tooltip']  = $this->tooltip;
						
            $this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
		}
        
        
        public function enqueue() {
            wp_enqueue_style( 'selectize', get_template_directory_uri() . '/inc/customizer/custom-controls/select/select.css', null );
            wp_enqueue_script( 'selectize', get_template_directory_uri() . '/assets/js/selectize.js', array( 'jquery' ) ); // for multi select
            wp_enqueue_script( 'fifty50-select', get_template_directory_uri() . '/inc/customizer/custom-controls/select/select.js', array( 'jquery', 'selectize' ), false, true ); // for multi select    
        }
		
		protected function content_template() {
			?>
<# if ( ! data.choices ) return; #>
    <# if ( data.tooltip ) { #>
        <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
        <# } #>
            <label>
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{ data.label }}</span>
                    <# } #>
                        <# if ( data.description ) { #>
                            <span class="description customize-control-description">{{{ data.description }}}</span>
                            <# } #>
                                <select {{{ data.inputAttrs }}} {{{ data.link }}} data-multiple="{{ data.multiple }}" <# if ( 1 < data.multiple ) { #> multiple<# } #>>
                                        <# if ( 1 < data.multiple && data.value ) { #>
                                            <# for ( key in data.value ) { #>
                                                <option value="{{ data.value[ key ] }}" selected>{{ data.choices[ data.value[ key ] ] }}</option>
                                                <# } #>
                                                    <# for ( key in data.choices ) { #>
                                                        <# if ( data.value[ key ] in data.value ) { #>
                                                            <# } else { #>
                                                                <option value="{{ key }}">{{ data.choices[ key ] }}</option>
                                                                <# } #>
                                                                    <# } #>
                                                                        <# } else { #>
                                                                            <# for ( key in data.choices ) { #>
                                                                                <option value="{{ key }}" <# if ( key===data.value ) { #>selected<# } #>>{{ data.choices[ key ] }}</option>
                                                                                <# } #>
                                                                                    <# } #>
                                </select>
            </label>
            <?php
		}
	}
}
