<?php
/**
 * Customizer Control: real_home_box_shadow
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Box_Shadow_Control class
 */
class Real_Home_Customize_Box_Shadow_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_box_shadow';

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
            'inset'     => false,
            'h_length'  => false,
            'v_length'  => false,
            'blur'      => false,
            'spread'    => false,
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

        <div class="controls-wrap box-shadow-control">

            <!-- H Length -->
            <# if ( fields.h_length ) { #>
            <span class="customize-control-title"><?php esc_html_e( 'Horizontal Length', 'real-home' ); ?></span>

            <div class="control-wrap d-flex justify-content-between align-items-center box-shadow-h_length">
                <#
                const h_reset = ( resetData !== '' && resetData['h_length'] !== undefined ) ? resetData['h_length'] : '';
                #>

                <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ h_reset }}" />

                <div class="d-flex justify-content-end align-items-center">
                    <div class="range-input">
                        <input type="number" class="h-offset" {{{ data.inputAttrs }}} data-reset="{{ h_reset }}" />
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

            <!-- V Length -->
            <# if ( fields.v_length ) { #>
            <span class="customize-control-title"><?php esc_html_e( 'Vertical Length', 'real-home' ); ?></span>

            <div class="control-wrap d-flex justify-content-between align-items-center box-shadow-v_length">
                <#
                const v_reset = ( resetData !== '' && resetData['v_length'] !== undefined ) ? resetData['v_length'] : '';
                #>

                <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ v_reset }}" />

                <div class="d-flex justify-content-end align-items-center">
                    <div class="range-input">
                        <input type="number" class="v-offset" {{{ data.inputAttrs }}} data-reset="{{ v_reset }}" />
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

            <!-- Blur -->
            <# if ( fields.blur ) { #>
            <span class="customize-control-title"><?php esc_html_e( 'Blur', 'real-home' ); ?></span>

            <div class="control-wrap d-flex justify-content-between align-items-center box-shadow-blur">
                <#
                const blur_reset = ( resetData !== '' && resetData['blur'] !== undefined ) ? resetData['blur'] : '';
                #>

                <input class="range" type="range" data-reset="{{ blur_reset }}" />

                <div class="d-flex justify-content-end align-items-center">
                    <div class="range-input">
                        <input type="number" class="blur" data-reset="{{ blur_reset }}" />
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

            <!-- spread -->
            <# if ( fields.spread ) { #>
            <span class="customize-control-title"><?php esc_html_e( 'Spread', 'real-home' ); ?></span>

            <div class="control-wrap d-flex justify-content-between align-items-center box-shadow-spread">
                <#
                const spread_reset = ( resetData !== '' && resetData['spread'] !== undefined ) ? resetData['spread'] : '';
                #>

                <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ spread_reset }}" />

                <div class="d-flex justify-content-end align-items-center">
                    <div class="range-input">
                        <input type="number" class="spread" {{{ data.inputAttrs }}} data-reset="{{ spread_reset }}" />
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

            <!-- Colors -->
            <# if ( fields.colors ) { const colors = data.colors; #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative mt-16 box-shadow-colors">
                <span class="customize-control-title"><?php esc_html_e( 'Color', 'real-home' ); ?></span>

                <div class="colors d-flex">

                    <# Object.keys( colors ).forEach( function ( key ) { #>

                    <div class="color-picker d-flex flex-column" <# if ( inheritData !== undefined && inheritData[key] !== undefined ) { #> style="background:{{ inheritData[key] }}" <# } #>>
                        <span class="position-relative">
                            <label class="inner-label">{{{ colors[key] }}}</label>
                        </span>

                        <# let color_reset = ( resetData !== '' && resetData['colors'] !== undefined && resetData['colors'][key] !== undefined ) ? resetData['colors'][key] : ''; #>
                        <# let color_inherit = ( inheritData !== '' && inheritData[key] !== undefined ) ? inheritData[key] : ''; #>
                        <input class="alpha-color-control {{ key }}" type="text" data-alpha-enabled="true" data-reset="{{ color_reset }}" data-inherit="{{ color_inherit }}" />
                    </div>

                    <# }); #>

                </div>
            </div>
            <# } #>

            <!-- Inset -->
            <# if ( fields.inset ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center mb-16 box-shadow-inset active">
                <span class="customize-control-title"><?php esc_html_e( 'Inset', 'real-home' ); ?></span>

                <span class="custom-toggle-btn-wrap">
                        <# const inset_reset = ( resetData !== '' && resetData['inset'] !== undefined ) ? resetData['inset'] : ''; #>
                        <input id="{{ data.settings.default }}" type="checkbox" class="custom-toggle-btn d-none inset" data-reset="{{ inset_reset }}"/>
                        <label for="{{ data.settings.default }}" class="custom-toggle-btn-label"></label>
                    </span>
            </div>
            <# } #>
            
        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Box_Shadow_Control' );