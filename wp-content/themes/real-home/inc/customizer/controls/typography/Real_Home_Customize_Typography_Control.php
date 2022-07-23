<?php
/**
 * Customizer Control: real_home_typography
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Typography_Control class
 */
class Real_Home_Customize_Typography_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_typography';

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
            'font_family'       => false,
            'font_variant'      => false,
            'text_transform'    => false,
            'text_decoration'   => false,
            'font_size'         => false,
            'line_height'       => false,
            'letter_spacing'    => false,
            'colors'            => false
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
     * Set up our control.
     *
     * @access public
     * @param  object  $manager
     * @param  string  $id
     * @param  array   $args
     * @return void
     */
    public function __construct( $manager, $id, $args = array() ) {

        // Let the parent class do its thing.
        parent::__construct( $manager, $id, $args );

        // Make sure we have labels.
        $this->l10n = wp_parse_args(
            $this->l10n,
            array(
                'option_default'    => esc_html__( 'Default', 'real-home' ),
            )
        );

        add_action( 'customize_controls_enqueue_scripts', array( $this, 'localize_script' ) );
    }

    /**
     * Localize google fonts to customize-controls.js file.
     *
     * @access public
     */
    public function localize_script() {

        // Get formatted array of standard fonts, google fonts and all variants.
        wp_localize_script(
            'real-home-customize-controls', 'realHomeAllFonts', array(
                'allFonts'  => Real_Home_Google_Fonts::get_fonts(),
                'variants'  => Real_Home_Google_Fonts::get_variants()
            )
        );
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
                inheritData = data.inherits;

        const responsive_class  = Object.keys( data.responsive ).length > 1 ? ' has-responsive-switcher' : '';
        const switcher_class    = Object.keys( data.responsive ).length > 1 ? 'responsive-devices d-flex align-items-center' : 'd-flex align-items-center';
        #>

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

        <div class="controls-wrap typography-control">

            <!-- Font Family -->
            <# if ( fields.font_family ) { #>

            <div class="control-wrap d-flex justify-content-between align-items-center typography-font_family">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Font Family', 'real-home' ); ?></span>

                <# let font_reset = ( resetData !== '' && resetData['font_family'] !== undefined ) ? resetData['font_family'].toLowerCase() : ''; font_reset = font_reset.replace(/ /g, '-'); #>
                <select class="select w-60" data-reset="{{ font_reset }}"></select>
            </div>
            <# } #>

            <!-- Font Variant -->
            <# if ( fields.font_family && data.fields.font_variant ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center typography-font_variant">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Font Weight', 'real-home' ); ?></span>

                <# const variant_reset = ( resetData !== '' && resetData['font_variant'] !== undefined ) ? resetData['font_variant'] : ''; #>
                <select class="select font_variant w-60" data-reset="{{ variant_reset }}"></select>
            </div>
            <# } #>


            <!-- Text Transform -->
            <# if ( fields.text_transform ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center typography-text_transform">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Text Transform', 'real-home' ); ?></span>

                <# const transform_reset = ( resetData !== '' && resetData['text_transform'] !== undefined ) ? resetData['text_transform'] : ''; #>
                <select class="select w-60" data-reset="{{ transform_reset }}">
                    <option value=""><?php esc_html_e( 'Default', 'real-home' ); ?></option>
                    <option value="uppercase"><?php esc_html_e( 'Uppercase', 'real-home' ); ?></option>
                    <option value="lowercase"><?php esc_html_e( 'Lowercase', 'real-home' ); ?></option>
                    <option value="capitalize"><?php esc_html_e( 'Capitalize', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Text Decoration -->
            <# if ( fields.text_decoration ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center typography-text_decoration">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Text Decoration', 'real-home' ); ?></span>

                <# const decoration_reset = ( resetData !== '' && resetData['text_decoration'] !== undefined ) ? resetData['text_decoration'] : ''; #>
                <select class="select w-60" data-reset="{{ decoration_reset }}">
                    <option value=""><?php esc_html_e( 'Default', 'real-home' ); ?></option>
                    <option value="overline"><?php esc_html_e( 'Overline', 'real-home' ); ?></option>
                    <option value="underline"><?php esc_html_e( 'Underline', 'real-home' ); ?></option>
                    <option value="line-through"><?php esc_html_e( 'Line through', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Font Size -->
            <# if ( fields.font_size ) { #>
            <div class="typography-font_size{{ responsive_class }}">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="customize-control-title"><?php esc_html_e( 'Font Size', 'real-home' ); ?></span>

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

                <# Object.keys( data.responsive ).forEach( function( key ) { let fontDevice = (data.responsive)[key];
                let active_class = ( (data.responsive)[key] === 'desktop' ) ? ' active' : ''; #>
                <div class="control-wrap d-flex justify-content-between align-items-center {{ (data.responsive)[key] }}{{active_class}}">

                    <# let font_size_reset = ( resetData !== '' && resetData['font_size'] !== undefined && resetData['font_size'][fontDevice] !== undefined ) ? resetData['font_size'][fontDevice] : ''; #>
                    <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ font_size_reset }}" />

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="range-input">
                            <input type="number" class="spread" {{{ data.inputAttrs }}} data-reset="{{ font_size_reset }}" />
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
                <# }); #>

            </div>
            <# } #>

            <!-- Line Height -->
            <# if ( fields.line_height ) { #>
            <div class="typography-line_height{{ responsive_class }}">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="customize-control-title"><?php esc_html_e( 'Line Height', 'real-home' ); ?></span>

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

                <# Object.keys( data.responsive ).forEach( function( key ) { let HeightDevice = (data.responsive)[key];
                let active_class = ( (data.responsive)[key] === 'desktop' ) ? ' active' : ''; #>
                <div class="control-wrap d-flex justify-content-between align-items-center {{ (data.responsive)[key] }}{{active_class}}">

                    <# let line_height_reset = ( resetData !== '' && resetData['line_height'] !== undefined && resetData['line_height'][HeightDevice] !== undefined ) ? resetData['line_height'][HeightDevice] : ''; #>
                    <input class="range" type="range" {{{ data.inputAttrs }}} data-reset="{{ line_height_reset }}" />

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="range-input">
                            <input type="number" class="spread" {{{ data.inputAttrs }}} data-reset="{{ line_height_reset }}" />
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
                <# }); #>

            </div>
            <# } #>

            <!-- Letter Spacing -->
            <# if ( fields.letter_spacing ) { #>
            <div class="typography-letter_spacing{{ responsive_class }}">

                <div class="d-flex justify-content-between align-items-center">
                    <span class="customize-control-title"><?php esc_html_e( 'Letter Spacing', 'real-home' ); ?></span>

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

                <# Object.keys( data.responsive ).forEach( function( key ) { let SpacingDevice = (data.responsive)[key];
                let active_class = ( (data.responsive)[key] === 'desktop' ) ? ' active' : ''; #>
                <div class="control-wrap d-flex justify-content-between align-items-center {{ (data.responsive)[key] }}{{active_class}}">

                    <# let spacing_reset = ( resetData !== '' && resetData['letter_spacing'] !== undefined && resetData['letter_spacing'][SpacingDevice] !== undefined ) ? resetData['letter_spacing'][SpacingDevice] : ''; #>
                    <input class="range" type="range" min="0" max="20" step="0.1" {{{ data.inputAttrs }}} data-reset="{{ spacing_reset }}" />

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="range-input">
                            <input type="number" class="spread" {{{ data.inputAttrs }}} data-reset="{{ spacing_reset }}" />
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
                <# }); #>

            </div>
            <# } #>




            <!-- Colors -->
            <# if ( fields.colors ) { const colors = data.colors; #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative mt-16 typography-colors">
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

        </div>

        <?php
    }
}

// Register JS-rendered control types.
$wp_customize->register_control_type( 'Real_Home_Customize_Typography_Control' );
