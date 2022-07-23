<?php
/**
 * Customizer Control: real_home_range
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Range_Control class
 */
class Real_Home_Customize_Range_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_range';

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
        <div class="control-wrap d-flex justify-content-between align-items-center mb-16 range-control {{ (data.responsive)[key] }}{{active_class}}">

            <# let reset = ( resetData[(data.responsive)[key]] !== undefined ) ? resetData[(data.responsive)[key]] : '';#>

            <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ reset }}" />

            <div class="d-flex justify-content-end align-items-center">
                <div class="range-input">
                    <input type="number" {{{ data.inputAttrs }}} data-reset="{{ reset }}" />
                </div>

                <!-- Units -->
                <# if ( Object.keys( data.units ).length !== 0 ) { #>
                <div class="units-wrap position-relative">
                    <ul class="units position-absolute transition-35s">
                        <#_.each( data.units, function( unit_key, unit_index ) { const unit_class = unit_index === 0 ? 'single-unit active' : 'single-unit'; #>
                        <li class="{{ unit_class }}" data-unit="{{{ unit_key }}}">
                            <span class="unit-text">{{{ unit_key }}}</span>
                        </li>
                        <# }); #>
                    </ul>
                </div>
                <# } #>
            </div>
        </div>

        <# }); #>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Range_Control' );