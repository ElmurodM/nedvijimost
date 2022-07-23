<?php
/**
 * Customizer Control: real_home_buttonset
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Buttonset_Control class
 */
class Real_Home_Customize_Buttonset_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_buttonset';

    /**
     * The type button type as text or icon
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $button_type = 'text';

    /**
     * Refresh the parameters passed to the JavaScript via JSON.
     *
     * @access public
     * @see WP_Customize_Control::to_json()
     * @return void
     */
    public function to_json() {

        // Get the basics from the parent class.
        parent::to_json();

        // Button Type
        $this->json['button_type']   = $this->button_type;
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <# const   resetData   = data.default; #>

        <# const responsive_class  = Object.keys( data.responsive ).length > 1 ? ' has-responsive-switcher' : '';
        const switcher_class    = Object.keys( data.responsive ).length > 1 ? 'responsive-devices d-flex align-items-center' : 'd-flex align-items-center';
        #>

        <div class="d-flex justify-content-between align-items-center">
            <span class="customize-control-title position-relative">
                {{{ data.label }}}
                <span class="reset-value"><i class="dashicons dashicons-image-rotate d-flex justify-content-center align-items-center"></i></span>
            </span>

            <# if ( Object.keys( data.responsive ).length > 1 ) { #>
            <ul class="{{ switcher_class }}">

                <# Object.keys( data.responsive ).forEach( function( key ) {
                let active_class = ( (data.responsive)[key] === 'desktop' ) ? ' active' : ''; #>
                <li class="{{ (data.responsive)[key] }} m-0">
                    <button type="button" class="preview-{{ (data.responsive)[key] }} d-flex{{ active_class }}" data-device="{{ (data.responsive)[key] }}">
                        <# if ( (data.responsive)[key] === 'mobile' ) { #>
                        <i class="dashicons dashicons-smartphone"></i>
                        <# } else { #>
                        <i class="dashicons dashicons-{{ (data.responsive)[key] }}"></i>
                        <# } #>
                    </button>
                </li>
                <# }); #>

            </ul>
            <# } #>

        </div>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <# Object.keys( data.responsive ).forEach( function( key ) {
        let active_class = ( (data.responsive)[key] === 'desktop' ) ? ' active' : ''; #>
        <div class="control-wrap d-flex flex-wrap align-items-start buttonset-control buttonset-{{ data.button_type }} {{ (data.responsive)[key] }}{{active_class}}">

            <# let reset = ( resetData[(data.responsive)[key]] !== undefined ) ? resetData[(data.responsive)[key]] : ''; #>
            <# _.each( data.choices, function( choiceLabel, choiceID ) { let radio_val = ( data.button_type === 'icon' ) ? choiceLabel : choiceID; #>
                <input class="buttonset" type="radio" value="{{ radio_val }}" name="{{ (data.responsive)[key] }}-{{ data.id }}" id="{{ (data.responsive)[key] }}-{{ data.id }}-{{ radio_val }}" data-reset="{{ reset }}">
                <label id="{{ (data.responsive)[key] }}-{{ data.id }}-{{ radio_val }}" class="buttonset-label d-flex flex-column justify-content-center align-items-center position-relative" for="{{ (data.responsive)[key] }}-{{ data.id }}-{{ radio_val }}">

                    <# if ( data.button_type === 'icon' ) { #>
                    <i class="fa {{ choiceLabel }}" aria-hidden="true"></i>
                    <# } else { #>
                    <span>{{ choiceLabel }}</span>
                    <# } #>

                </label>
            <# }); #>

        </div>

        <# }); #>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Buttonset_Control' );