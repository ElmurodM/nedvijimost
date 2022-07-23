<?php
/**
 * Customizer Control: real_home_dimensions
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Dimensions_Control class
 */
class Real_Home_Customize_Dimensions_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_dimensions';

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <# const   resetData   = data.default, responsive = data.responsive; #>

        <# const responsive_class  = Object.keys( responsive ).length > 1 ? ' has-responsive-switcher' : '';
        const switcher_class    = Object.keys( responsive ).length > 1 ? 'responsive-devices d-flex align-items-center' : 'd-flex align-items-center';
        #>

        <div class="d-flex justify-content-between align-items-center">
            <span class="customize-control-title position-relative">
                {{{ data.label }}}
                <span class="reset-value"><i class="dashicons dashicons-image-rotate d-flex justify-content-center align-items-center"></i></span>
            </span>

            <# if ( Object.keys( responsive ).length > 1 ) { #>
            <ul class="{{ switcher_class }}">

                <# Object.keys( responsive ).forEach( function( key ) {
                let active_class = ( (responsive)[key] === 'desktop' ) ? ' active' : ''; #>
                <li class="{{ (responsive)[key] }} m-0">
                    <button type="button" class="preview-{{ (responsive)[key] }} d-flex{{ active_class }}" data-device="{{ (responsive)[key] }}">
                        <# if ( (responsive)[key] === 'mobile' ) { #>
                        <i class="dashicons dashicons-smartphone"></i>
                        <# } else { #>
                        <i class="dashicons dashicons-{{ (responsive)[key] }}"></i>
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

        <# Object.keys( responsive ).forEach( function( key ) {
        let active_class = ( (responsive)[key] === 'desktop' ) ? ' active' : ''; #>
        <div class="control-wrap d-flex justify-content-between position-relative dimensions-control {{ (responsive)[key] }}{{active_class}}">

            <ul class="dimensions d-flex linked">

                <#
                const width_sides = {side_1:"Top", side_2:"Right", side_3:"Bottom", side_4:"Left"},
                sides_disable = data.off_sides;
                #>

                <# Object.keys( width_sides ).forEach( ( side, index ) => { #>
                <li class="dimension dimension-{{ side }} d-flex flex-column align-items-center m-0">
                    <# let side_class = sides_disable.includes( side ) ? 'dimension-input off-field' : 'dimension-input on-field linked'; #>
                    <# let side_reset = ( resetData[(responsive)[key]] !== undefined && resetData[(responsive)[key]][side] !== undefined ) ? resetData[(responsive)[key]][side] : ''; #>
                    <input type="number" {{{ data.inputAttrs }}} class="{{ side_class }}" data-element="{{ data.settings.default }}" data-reset="{{ side_reset }}"/>
                    <span class="inner-label">{{{ width_sides[side] }}}</span>
                </li>
                <# }); #>
            </ul>

            <!-- Units -->
            <div class="units-wrap position-relative">
                <ul class="units position-absolute transition-35s">
                    <#_.each( data.units, function( unit_key, unit_index ) { const unit_class = unit_index === 0 ? 'single-unit active' : 'single-unit'; #>
                    <li class="{{ unit_class }}" data-unit="{{{ unit_key }}}">
                        <span class="unit-text">{{{ unit_key }}}</span>
                    </li>
                    <# }); #>
                </ul>
            </div>

            <!-- Link -->
            <# let linked_reset = ( resetData[(responsive)[key]] !== undefined && resetData[(responsive)[key]]['linked'] !== undefined ) ? resetData[(responsive)[key]]['linked'] : ''; #>
            <div class="dimension link-dimensions-wrap d-flex flex-column align-items-center m-0">
                <div class="link-dimensions w-100">
                    <span class="dashicons dashicons-admin-links linked d-flex justify-content-center align-items-center" data-element="{{(responsive)[key]}}-{{ data.settings.default }}" title=""></span>
                    <span class="dashicons dashicons-editor-unlink unlinked d-flex justify-content-center align-items-center" data-element="{{(responsive)[key]}}-{{ data.settings.default }}" title=""></span>
                    <input type="hidden" class="dimension-input dimensions-link-input dimensions-{{(responsive)[key]}}-link" data-id="linked" value="on" data-reset="{{ linked_reset }}" />
                </div>
            </div>

        </div>

        <# }); #>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Dimensions_Control' );