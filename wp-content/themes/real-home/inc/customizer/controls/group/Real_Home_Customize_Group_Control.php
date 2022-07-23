<?php
/**
 * Customizer Control: real_home_group
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Group_Control class
 */
class Real_Home_Customize_Group_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_group';

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <# const tab_attrs = data.choices; #>

        <div class="d-flex justify-content-between align-items-center">
            <span class="customize-control-title position-relative">
                {{{ data.label }}}
            </span>
        </div>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <div class="customizer-group-control d-flex" id="input_{{ data.id }}">

            <# Object.keys( tab_attrs ).forEach( function ( item, index ) {
            let active_class = index === 0 ? 'active': 'inactive';
            const controls = tab_attrs[item]['controls'];
            #>
            <div class="customizer-tab {{ item }}">
                <input type="radio" value="{{ item }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}-{{ item }}" data-controls="{{ controls }}" class="{{ active_class }}"/>
                <span class="screen-reader-text">{{{ tab_attrs[item]['tab-title'] }}}</span>
                <# if ( tab_attrs[item]['tab-title'] !== undefined ) { #>
                <label class="{{ controls.join( ' ' ) }}" >{{{ tab_attrs[item]['tab-title'] }}}</label>
                <# } #>
            </div>

            <# }); #>

        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Group_Control' );