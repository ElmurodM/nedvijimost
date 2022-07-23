<?php
/**
 * Customizer Control: real_home_background
 *
 * @package Real_Home
 */

/**
 * Real_Home_Customize_Background_Control class
 */
class Real_Home_Customize_Background_Control extends Real_Home_Customize_Base_Control {

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @var    string
     */
    public $type = 'real_home_background';
    
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
            'background'        => false,
            'image'             => false,
            'position'          => false,
            'attachment'        => false,
            'repeat'            => false,
            'size'              => false,
            'colors'            => false,
            'gradient'          => false
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

        <div class="controls-wrap">

            <!-- background -->
            <# if ( fields.background ) { #>
            <div class="control-wrap d-flex justify-content-between position-relative background">

                <# if ( fields.colors ) { #>
                <input class="buttonset" type="radio" value="color" name="{{ data.id }}" id="{{ data.id }}-color" data-reset="">
                <label id="{{ data.id }}-color" class="buttonset-label d-flex flex-column justify-content-center align-items-center position-relative buttonset-label-on" for="{{ data.id }}-color">
                    <span><?php esc_html_e( 'Color', 'real-home' ); ?></span>
                </label>
                <# } #>

                <# if ( fields.gradient ) { #>
                <input class="buttonset" type="radio" value="gradient" name="{{ data.id }}" id="{{ data.id }}-gradient" data-reset="">
                <label id="{{ data.id }}-gradient" class="buttonset-label d-flex flex-column justify-content-center align-items-center position-relative" for="{{ data.id }}-gradient">
                    <span><?php esc_html_e( 'Gradient', 'real-home' ); ?></span>
                </label>
                <# } #>

                <# if ( fields.image ) { #>
                <input class="buttonset" type="radio" value="image" name="{{ data.id }}" id="{{ data.id }}-image" data-reset="">
                <label id="{{ data.id }}-image" class="buttonset-label d-flex flex-column justify-content-center align-items-center position-relative" for="{{ data.id }}-image">
                    <span><?php esc_html_e( 'Image', 'real-home' ); ?></span>
                </label>
                <# } #>

            </div>
            <# } #>

            <!-- Image -->
            <# if ( fields.image ) { #>
            <div class="d-flex justify-content-between align-items-center">
                <span class="customize-control-title"><?php esc_html_e( 'Image', 'real-home' ); ?></span>
            </div>

            <div class="control-wrap d-flex justify-content-between position-relative background-image">
                <div class="background-image w-100">
                    <div class="attachment-media-view w-100">
                        <button type="button" class="upload-button button-add-media"><?php esc_html_e( 'Select Image', 'real-home' ); ?></button>
                    </div>

                    <# const img_reset = ( resetData !== '' && resetData['image'] !== undefined ) ? resetData['image'] : ''; #>
                    <input type="hidden" class="background-image-url" data-reset="{{ img_reset }}" />
                </div>
            </div>
            <# } #>
            
            <!-- Position -->
            <# if ( fields.position ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center background-position">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Position', 'real-home' ); ?></span>

                <# const position_reset = ( resetData !== '' && resetData['position'] !== undefined ) ? resetData['position'] : ''; #>
                <select class="select background-position-select w-60" data-reset="{{ position_reset }}">

                    <option value="top left"><?php esc_html_e( 'Top Left', 'real-home' ); ?></option>
                    <option value="top center"><?php esc_html_e( 'Top Center', 'real-home' ); ?></option>
                    <option value="top right"><?php esc_html_e( 'Top Right', 'real-home' ); ?></option>
                    <option value="center left"><?php esc_html_e( 'Center Left', 'real-home' ); ?></option>
                    <option value="center"><?php esc_html_e( 'Center', 'real-home' ); ?></option>
                    <option value="center right"><?php esc_html_e( 'Center Right', 'real-home' ); ?></option>
                    <option value="bottom left"><?php esc_html_e( 'Bottom Left', 'real-home' ); ?></option>
                    <option value="bottom center"><?php esc_html_e( 'Bottom Center', 'real-home' ); ?></option>
                    <option value="bottom right"><?php esc_html_e( 'Bottom Right', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Attachment -->
            <# if ( fields.attachment ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center background-attachment">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Attachment', 'real-home' ); ?></span>

                <# const attachment_reset = ( resetData !== '' && resetData['attachment'] !== undefined ) ? resetData['attachment'] : ''; #>
                <select class="select background-attachment-select w-60" data-reset="{{ attachment_reset }}">
                    <option value="scroll"><?php esc_html_e( 'Scroll', 'real-home' ); ?></option>
                    <option value="fixed"><?php esc_html_e( 'Fixed', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Repeat -->
            <# if ( fields.repeat ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center background-repeat">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Repeat', 'real-home' ); ?></span>

                <# const repeat_reset = ( resetData !== '' && resetData['repeat'] !== undefined ) ? resetData['repeat'] : ''; #>
                <select class="select background-repeat-select w-60" data-reset="{{ repeat_reset }}">
                    <option value="no-repeat"><?php esc_html_e( 'No Repeat', 'real-home' ); ?></option>
                    <option value="repeat"><?php esc_html_e( 'Repeat', 'real-home' ); ?></option>
                    <option value="repeat-x"><?php esc_html_e( 'Repeat Horizontally', 'real-home' ); ?></option>
                    <option value="repeat-y"><?php esc_html_e( 'Repeat Vertically', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Size -->
            <# if ( fields.size ) { #>
            <div class="control-wrap d-flex justify-content-between align-items-center background-size">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Size', 'real-home' ); ?></span>

                <# const size_reset = ( resetData !== '' && resetData['size'] !== undefined ) ? resetData['size'] : ''; #>
                <select class="select background-size-select w-60" data-reset="{{ size_reset }}">
                    <option value="auto"><?php esc_html_e( 'Auto', 'real-home' ); ?></option>
                    <option value="cover"><?php esc_html_e( 'Cover', 'real-home' ); ?></option>
                    <option value="contain"><?php esc_html_e( 'Contain', 'real-home' ); ?></option>
                </select>
            </div>
            <# } #>

            <!-- Colors -->
            <# if ( fields.colors ) { const colors = data.colors; #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative background-colors">
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

            <!-- Gradient -->
            <# if ( fields.gradient ) { const gradients = { color_1: 'Color Left', color_2: 'Color Right' } #>
            <div class="control-wrap d-flex justify-content-between align-items-center position-relative background-gradient">
                <span class="customize-control-title w-40"><?php esc_html_e( 'Gradient Color', 'real-home' ); ?></span>

                <div class="colors d-flex">

                    <# Object.keys( gradients ).forEach( function ( key, index ) { #>
                    <div class="color-picker d-flex flex-column">

                        <span class="position-relative"><label class="inner-label">{{{ gradients[key] }}}</label></span>

                        <# let gradient_reset = ( resetData !== '' && resetData['gradient'] !== undefined && resetData['gradient'][key] !== undefined ) ? resetData['gradient'][key] : ''; #>
                        <input class="alpha-color-control {{ key }}" type="text" data-alpha-enabled="true" data-reset="{{ gradient_reset }}" />

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
$wp_customize->register_control_type( 'Real_Home_Customize_Background_Control' );