<?php
/**
 * Customizer Custom Section: real_home_custom_section
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Custom_Section class
 */
class Real_Home_Customize_Custom_Section extends WP_Customize_Section {

    /**
     * Type of this section.
     *
     * @var string
     */
    public $type = 'real_home_custom_section';

    /**
     * Button Text for this section.
     *
     * @var string
     */
    public $btn_text = '';
    
    /**
     * Button URL for this section.
     *
     * @var string
     */
    public $btn_url = '';
    
    /**
     * Inline Style for this section.
     *
     * @var string
     */
    public $inline_style = '';

    /**
     * Gather the parameters passed to client JavaScript via JSON.
     *
     * @return array The array to be exported to the client as JSON.
     */
    public function json() {
        $json                   = parent::json();
        $json['btn_url']        = esc_url( $this->btn_url );
        $json['btn_text']       = $this->btn_text;
        $json['inline_style']   = $this->inline_style;

        return $json;
    }

    /**
     * An Underscore (JS) template for rendering this section.
     */
    protected function render_template() { ?>

        <# let css_class = ( data.css_class ) ? data.css_class : '' ; #>
        
        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
            <h3 class="accordion-section-title" <# if ( data.inline_style ) { #> style="{{ data.inline_style }}" <# } #>>
                {{ data.title }}
                <# if ( data.btn_text && data.btn_url ) { #>
                <a href="{{ data.btn_url }}" class="button button-secondary alignright" target="_blank">{{ data.btn_text }}</a>
                <# } #>
            </h3>

            <# if ( data.description ) { #>
            <p class="description customize-section-description">{{ data.description }}</p>
            <# } #>
        </li>

        <?php
    }
}

$wp_customize->register_section_type( 'Real_Home_Customize_Custom_Section' );