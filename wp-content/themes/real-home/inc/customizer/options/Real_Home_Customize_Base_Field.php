<?php
/**
 * Real Home Theme Customizer
 *
 * @package Real_Home
 */


/**
 * This is a simple abstraction which makes adding simple controls to the Customizer.
 *
 * This class is not meant to be used as-is, you'll need to extend it from a child class.
 *
 */
abstract class Real_Home_Customize_Base_Field {

    /**
     * The field arguments.
     *
     * @access protected
     * @var array
     */
    protected $args = [];

    /**
     * Constructor.
     * Registers any hooks we need to run.
     *
     * @access public
     */
    public function __construct() {

        $this->init();

        // Register customizer options.
        add_action( 'customize_register', [ $this, 'real_home_customizer_add_fields' ], 10, 1 );
    }

    /**
     * Abstract public init function
     *
     * @access public
     * @return void
     */
    abstract public function init();

    /**
     * Registers the setting.
     *
     * @access public
     * @param WP_Customize_Manager $wp_customize The customizer instance.
     * @return void
     */
    public function real_home_customizer_add_fields( $wp_customize ) {

        foreach ( $this->args as $field_key => $field_data ) {

            /**
             * Setting.
             */
            $default           = isset( $field_data['default'] ) ? $field_data['default'] : '';
            $sanitize_callback = isset( $field_data['sanitize_callback'] ) ? $field_data['sanitize_callback'] : '';

            $wp_customize->add_setting(
                $field_key,
                array(
                    'default'           => $default,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'sanitize_callback' => $sanitize_callback,
                )
            );


            $control_type   = implode( '_', array_map( 'ucfirst', explode( '_', $field_data['type'] ) ) );
            $classname      = in_array( $control_type , ['Image','Upload'] ) ? 'WP_Customize_' . $control_type . '_Control' : 'Real_Home_Customize_' . $control_type . '_Control';

            // Field Control
            $control_args = [
                'type'          => isset( $field_data['type'] ) ? $field_data['type'] : 'text',
                'label'         => isset( $field_data['label'] ) ? $field_data['label'] : '',
                'description'   => isset( $field_data['description'] ) ? $field_data['description'] : '',
                'section'       => isset( $field_data['section'] ) ? $field_data['section'] : '',
                'settings'      => $field_key,
                'priority'      => isset( $field_data['priority'] ) ? $field_data['priority'] : ''
            ];

            // active_callback
            if ( isset( $field_data['active_callback'] ) ) {
                $control_args['active_callback'] = $field_data['active_callback'];
            }

            // Input Attributes
            if ( isset( $field_data['input_attrs'] ) ) {
                $control_args['input_attrs'] = $field_data['input_attrs'];
            }

            // Choices
            if ( isset( $field_data['choices'] ) ) {
                $control_args['choices'] = $field_data['choices'];
            }

            // l10n
            if ( isset( $field_data['l10n'] ) ) {
                $control_args['l10n'] = $field_data['l10n'];
            }

            // Check custom customize control class exist
            if ( class_exists( $classname ) ) {

                // Unset control type for the custom control
                unset($control_args['type'] );

                // Colors
                if ( isset( $field_data['colors'] ) ) {
                    $control_args['colors'] = $field_data['colors'];
                }

                // Inherits
                if ( isset( $field_data['inherits'] ) ) {
                    $control_args['inherits'] = $field_data['inherits'];
                }

                // Disable Sides
                if ( isset( $field_data['off_sides'] ) ) {
                    $control_args['off_sides'] = $field_data['off_sides'];
                }

                // Responsive Devices
                if ( isset( $field_data['responsive'] ) ) {
                    $control_args['responsive'] = $field_data['responsive'];
                }

                // Unit Choices
                if ( isset( $field_data['units'] ) ) {
                    $control_args['units'] = $field_data['units'];
                }

                // fields
                if ( isset( $field_data['fields'] ) ) {
                    $control_args['fields'] = $field_data['fields'];
                }

                // live_title_id
                if ( isset( $field_data['live_title_id'] ) ) {
                    $control_args['live_title_id'] = $field_data['live_title_id'];
                }

                // title_format
                if ( isset( $field_data['title_format'] ) ) {
                    $control_args['title_format'] = $field_data['title_format'];
                }

                // button_type
                if ( isset( $field_data['button_type'] ) ) {
                    $control_args['button_type'] = $field_data['button_type'];
                }

                // add control
                $wp_customize->add_control( new $classname( $wp_customize, $field_key, $control_args ) );
            }
            else {

                // add control
                $wp_customize->add_control( $field_key, $control_args );
            }
        }

    }
}