<?php
/**
 * Customizer Control: real_home_color
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Color_Control class
 */
class Real_Home_Customize_Color_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_color';

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <#
        const   resetData   = data.default,
                inheritData = data.inherits,
                colors      = data.colors; #>

        <# if ( data.label ) { #>
        <div class="d-flex justify-content-between align-items-center">
            <span class="customize-control-title position-relative">
                {{{ data.label }}}
                <span class="reset-value"><i class="dashicons dashicons-image-rotate d-flex justify-content-center align-items-center"></i></span>
            </span>
        </div>
        <# } #>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <!-- Colors -->
        <div class="control-wrap d-flex justify-content-between align-items-center position-relative color-control">

            <span class="inner-label w-40"><?php esc_html_e( 'Color', 'real-home' ); ?></span>

            <div class="colors d-flex">
                <# Object.keys( colors ).forEach( function ( key ) { #>
                    <div class="color-picker d-flex flex-column" <# if ( inheritData !== undefined && inheritData[key] !== undefined ) { #> style="background:{{ inheritData[key] }}" <# } #>>

                        <span class="position-relative"><label class="inner-label">{{{ colors[key] }}}</label></span>

                        <# let color_reset = ( resetData !== '' && resetData[key] !== undefined ) ? resetData[key] : ''; #>
                        <# let color_inherit = ( inheritData !== '' && inheritData[key] !== undefined ) ? inheritData[key] : ''; #>
                        <input class="alpha-color-control {{ key }}" type="text" data-alpha-enabled="true" data-reset="{{ color_reset }}" data-inherit="{{ color_inherit }}" />

                    </div>
                <# }); #>
            </div>

        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Color_Control' );