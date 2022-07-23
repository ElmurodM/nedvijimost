<?php
/**
 * Customizer Control: real_home_radio_image
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Radio_Image_Control class
 */
class Real_Home_Customize_Radio_Image_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_radio_image';

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <# const resetData = data.default; #>

        <# const l10n = data.l10n; #>

        <div class="d-flex justify-content-between align-items-center">
            <span class="customize-control-title position-relative">
                {{{ data.label }}}
                <span class="reset-value"><i class="dashicons dashicons-image-rotate d-flex justify-content-center align-items-center"></i></span>
            </span>

        </div>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <div class="control-wrap d-flex flex-wrap align-items-start radio-image-control">

            <# let reset = ( resetData!== undefined ) ? resetData: ''; #>
            <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
            <input class="radio-image" type="radio" value="{{ choiceID }}" name="{{ data.id }}" id="{{ data.id }}-{{ choiceID }}" data-reset="{{ reset }}">
            <label id="{{ data.id }}-{{ choiceID }}" class="radio-image-label d-flex flex-column justify-content-center position-relative tooltip w-50" for="{{ data.id }}-{{ choiceID }}">
                <img src="{{ choiceLabel }}">

                <# let sub_label = ( l10n[choiceID] !== undefined ) ? l10n[choiceID] : choiceID; #>
                <span class="inner-label">{{{ sub_label }}}</span>
            </label>
            <# }); #>
        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Radio_Image_Control' );