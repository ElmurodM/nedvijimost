<?php
/**
 * Customizer Control: real_home_toggle
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Toggle_Control class
 */
class Real_Home_Customize_Toggle_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_toggle';


    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <#
        const   resetData   = data.default; #>


        <# const l10n = data.l10n; #>

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
        <div class="control-wrap d-flex justify-content-between align-items-center mb-16 toggle-control {{ (data.responsive)[key] }}{{active_class}}">

            <# let sub_label = ( l10n[(data.responsive)[key]] !== undefined ) ? l10n[(data.responsive)[key]] : 'Enable'; #>
            <span class="inner-label">{{{ sub_label }}}</span>

            <span class="custom-toggle-btn-wrap">
                <# let reset = ( resetData !== '' && resetData[(data.responsive)[key]] !== undefined ) ? resetData[(data.responsive)[key]] : ''; #>
                <input id="{{ (data.responsive)[key] }}_{{ data.settings.default }}" type="checkbox" class="custom-toggle-btn d-none inset" data-reset="{{ reset }}" />
                <label for="{{ (data.responsive)[key] }}_{{ data.settings.default }}" class="custom-toggle-btn-label"></label>
            </span>
        </div>

        <# }); #>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Toggle_Control' );