<?php
/**
 * Customizer Control: real_home_border
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Border_Control class
 */
class Real_Home_Customize_Border_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_border';

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

        // default fields
        $default_fields = array(
            'width'     => false,
            'style'     => false,
            'radius'    => false,
            'colors'    => false
        );

        $fields = [];

        $fields_exist = !empty( $this->fields ) ? $this->fields : $default_fields;

        foreach( $fields_exist as $field_key => $field_value ){

            $fields[ str_replace( '-', '_', $field_key ) ] = true;
        }

        $fields = wp_parse_args( $fields, $default_fields );

        // Fields
        $this->json['fields']   = $fields;
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @access public
     * @return void
     */
    public function content_template() { ?>

        <#
        const   fields      = data.fields,
                resetData   = data.default,
                inheritData = data.inherits; #>

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

        <div class="controls-wrap border-control">

            <!-- width -->
            <# if ( fields.width ) { #>

            <div class="d-flex justify-content-between align-items-center">
                <span class="customize-control-title"><?php esc_html_e( 'Width', 'real-home' ); ?></span>
            </div>

            <div class="control-wrap d-flex justify-content-between position-relative">

                <ul class="border-width dimensions d-flex linked">

                    <#
                    const width_sides = {side_1:"Top", side_2:"Right", side_3:"Bottom", side_4:"Left"},
                    sides_disable = data.off_sides;
                    #>

                    <# Object.keys( width_sides ).forEach( ( side, index ) => { #>
                    <li class="dimension border-width-{{ side }} d-flex flex-column align-items-center m-0">
                        <# let side_class = sides_disable.includes( side ) ? 'dimension-input off-field' : 'dimension-input on-field linked'; #>
                        <# let side_reset = ( resetData !== '' && resetData['width']!== undefined && resetData['width'][side] !== undefined ) && resetData['colors'] !== undefined ? resetData['width'][side] : ''; #>
                        <input type="number" class="{{ side_class }}" data-element="{{ data.settings.default }}" data-reset="{{ side_reset }}"/>
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
                <# const linked_reset = ( resetData !== '' && resetData['width'] !== undefined && resetData['width']['linked'] !== undefined ) ? resetData['width']['linked'] : ''; #>
                <div class="border-linked dimension link-dimensions-wrap d-flex flex-column align-items-center m-0">
                    <div class="link-dimensions w-100">
                        <span class="dashicons dashicons-admin-links linked d-flex justify-content-center align-items-center" data-element="{{ data.settings.default }}" title=""></span>
                        <span class="dashicons dashicons-editor-unlink unlinked d-flex justify-content-center align-items-center" data-element="{{ data.settings.default }}" title=""></span>
                        <input type="hidden" class="dimension-input dimensions-link-input dimensions-desktop-link" data-id="linked" value="on" data-reset="{{ linked_reset }}" />
                    </div>
                </div>
            </div>
            <# } #>

            <!-- Style -->
            <# if ( fields.style ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative border-style">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Style', 'real-home' ); ?></span>

                <# const style_reset = ( resetData !== '' && resetData['style'] !== undefined ) ? resetData['style'] : ''; #>
                <select class="select border-style-select w-60" data-reset="{{ style_reset }}">
                    <option value="none"><?php esc_html_e( 'None', 'real-home' ); ?></option>
                    <option value="solid"><?php esc_html_e( 'Solid', 'real-home' ); ?></option>
                    <option value="dotted"><?php esc_html_e( 'Dotted', 'real-home' ); ?></option>
                    <option value="dashed"><?php esc_html_e( 'Dashed', 'real-home' ); ?></option>
                    <option value="double"><?php esc_html_e( 'Double', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Colors -->
            <# if ( fields.colors ) { const colors = data.colors; #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative border-colors">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Color', 'real-home' ); ?></span>

                <div class="colors d-flex">

                    <# Object.keys( colors ).forEach( function ( key ) { #>
                    <div class="color-picker d-flex flex-column" <# if ( inheritData !== undefined && inheritData[key] !== undefined ) { #> style="background:{{ inheritData[key] }}" <# } #>>

                    <span class="position-relative"><label class="inner-label">{{{ colors[key] }}}</label></span>

                    <# let color_reset = ( resetData !== '' && resetData['colors'] !== undefined && resetData['colors'][key] !== undefined ) ? resetData['colors'][key] : ''; #>
                    <# let color_inherit = ( inheritData !== '' && inheritData[key] !== undefined ) ? inheritData[key] : ''; #>
                    <input class="alpha-color-control {{ key }}" type="text" data-alpha-enabled="true" data-reset="{{ color_reset }}" data-inherit="{{ color_inherit }}" />

                </div>
                <# }); #>
                </div>
            </div>
            <# } #>

        <!-- Radius -->
        <# if ( fields.radius ) { #>
        <span class="customize-control-title"><?php esc_html_e( 'Radius', 'real-home' ); ?></span>

        <div class="control-wrap border-radius d-flex justify-content-between align-items-center">
            <#
            const radius_reset = ( resetData !== '' && resetData['radius'] !== undefined ) ? resetData['radius'] : '';
            #>

            <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ radius_reset }}" />

            <div class="d-flex justify-content-end align-items-center">
                <div class="range-input">
                    <input type="number" class="radius" {{{ data.inputAttrs }}} data-reset="{{ radius_reset }}" />
                </div>

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
            </div>
        </div>
        <# } #>
        
        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Border_Control' );