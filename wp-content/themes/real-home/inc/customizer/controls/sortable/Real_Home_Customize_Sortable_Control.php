<?php
/**
 * Customizer Control: real_home_sortable
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Sortable_Control class
 */
class Real_Home_Customize_Sortable_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_sortable';

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <#
        const   fields      = data.fields,
                resetData   = data.default; #>

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

        <ul class="sortable control-wrap sortable-list">
            <# const sortable_reset = ( resetData !== '' ) ? resetData : ''; #>
            <input type="hidden" class="sortable-field" data-reset="{{ sortable_reset }}" />
        </ul>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Sortable_Control' );