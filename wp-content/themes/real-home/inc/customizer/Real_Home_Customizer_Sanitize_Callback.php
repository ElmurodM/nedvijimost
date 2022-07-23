<?php
/**
 * Customizer Controls Sanitize functions
 *
 * @package Real_Home
 */

/**
 * class for customize controls sanitize values
 *
 * @access public
 */
class Real_Home_Customizer_Sanitize_Callback {

    /**
     * Instance
     *
     * @access private
     * @var object
     */
    private static $instance;

    /**
     * Returns the instance.
     *
     * @access public
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor method.
     *
     * @access private
     * @return void
     */
    private function __construct() {}

    /**
     * Sanitize Background control.
     *
     * @param $input
     * @return mixed|string|array
     */
    public static function sanitize_background( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            switch( $key ) {

                case 'image':
                    $data[$key] = esc_url_raw( $val );
                    break;

                case 'position':
                case 'attachment':
                case 'repeat':
                case 'size':
                case 'background':
                    $data[$key] = sanitize_text_field( $val );
                    break;

                case 'colors':
                case 'gradient':
                    // if is multiple array
                    if ( is_array( $val ) ) {
                        foreach ( $val as $k => $v ) {
                            if ( isset( $fields[$key][$v] ) ) {
                                // To allow hex, rgba(), and var() values or custom values like transparent run through custom preg_replace to remove most special characters and spaces.
                                if ( strpos( $v, '#' ) === 0 ) {
                                    $val[$k] = sanitize_hex_color( $v );
                                } else {
                                    $val[$k] = preg_replace( '/[^A-Za-z0-9_)(\-,.]/', '', $v );
                                }
                            }
                        }
                        $data[$key] = $val;
                    }
                    break;
            }
        }

        return $data;
    }

    /**
     * Sanitize Border control.
     *
     * @param $input
     * @return mixed|string|array
     */
    public static function sanitize_border( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            switch( $key ) {
                
                case 'style':
                case 'radius':
                    $data[$key] = sanitize_text_field( $val );
                    break;

                case 'colors':
                    // if is multiple array
                    if ( is_array( $val ) ) {
                        foreach ( $val as $k => $v ) {
                            if ( isset( $fields[$key][$v] ) ) {
                                // To allow hex, rgba(), and var() values or custom values like transparent run through custom preg_replace to remove most special characters and spaces.
                                if ( strpos( $v, '#' ) === 0 ) {
                                    $val[$k] = sanitize_hex_color( $v );
                                } else {
                                    $val[$k] = preg_replace( '/[^A-Za-z0-9_)(\-,.]/', '', $v );
                                }
                            }
                        }
                        $data[$key] = $val;
                    }
                    break;

                case 'width':
                    // if is multiple array
                    if ( is_array( $val ) ) {
                        foreach ( $val as $k => $v ) {
                            if ( isset( $fields[$key][$v] ) ) {
                                $val[$k] = sanitize_text_field( $val );
                            }
                        }
                        $data[$key] = $val;
                    }
                    break;
            }
        }

        return $data;
    }

    /**
     * Sanitize Typography control.
     *
     * @param $input
     * @return mixed|string|array
     */
    public static function sanitize_typography( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            switch( $key ) {

                case 'font_family':
                case 'font_variant':
                case 'text_transform':
                case 'text_decoration':
                    $data[$key] = sanitize_text_field( $val );
                    break;

                case 'colors':
                    // if is multiple array
                    if ( is_array( $val ) ) {
                        foreach ( $val as $k => $v ) {
                            if ( isset( $fields[$key][$v] ) ) {
                                // To allow hex, rgba(), and var() values or custom values like transparent run through custom preg_replace to remove most special characters and spaces.
                                if ( strpos( $v, '#' ) === 0 ) {
                                    $val[$k] = sanitize_hex_color( $v );
                                } else {
                                    $val[$k] = preg_replace( '/[^A-Za-z0-9_)(\-,.]/', '', $v );
                                }
                            }
                        }
                        $data[$key] = $val;
                    }
                    break;

                case 'font_size':
                case 'line_height':
                case 'letter_spacing':
                    // if is multiple array
                    if ( is_array( $val ) ) {
                        foreach ( $val as $k => $v ) {
                            if ( isset( $fields[$key][$v] ) ) {
                                $val[$k] = sanitize_text_field( $v );
                            }
                        }
                        $data[$key] = $val;
                    }
                    break;
            }
        }

        return $data;
    }

    /**
     * Sanitize Typography control.
     *
     * @param $input
     * @return array
     */
    public static function sanitize_color( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            // To allow hex, rgba(), and var() values or custom values like transparent run through custom preg_replace to remove most special characters and spaces.
            if ( strpos( $val, '#' ) === 0 ) {
                $data[$key] = sanitize_hex_color( $val );
            } else {
                $data[$key] = preg_replace( '/[^A-Za-z0-9_)(\-,.]/', '', $val );
            }
        }

        return $data;
    }

    /**
     * Sanitize Sortable control.
     *
     * @param mixed $input the value before sanitized.
     * @param $setting
     * @return array
     */
    public static function sanitize_sortable( $input, $setting ){

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            // Ensure input is a slug.
            $val = sanitize_key( $val );

            // If the input is a valid key, return it; otherwise, return the default.
            $data[$key] = ( array_key_exists( $val, $choices ) ? $val : $setting->default );
        }

        return $data;
    }

    /**
     * Sanitize Toggle control.
     *
     * @param $input
     * @return array
     */
    public static function sanitize_toggle( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            $data[$key] = self::sanitize_boolean( $val );
        }

        return $data;
    }

    /**
     * Sanitize Range control.
     *
     * @param $input
     * @return array
     */
    public static function sanitize_range( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            $data[$key] = sanitize_text_field( $val );
        }

        return $data;
    }

    /**
     * Sanitize Dimensions control.
     *
     * @param $input
     * @return array
     */
    public static function sanitize_dimensions( $input ){

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            if ( is_array( $val ) ) {

                foreach ( $val as $k => $v ) {

                    $val[$k] = sanitize_text_field( $v );
                }
                $data[$key] = $val;
            }
            else {
                $data[$key] = sanitize_text_field( $val );
            }
        }

        return $data;
    }

    /**
     * Sanitize Buttonset control.
     *
     * @param mixed $input the value before sanitized.
     * @param $setting
     * @return array
     */
    public static function sanitize_buttonset( $input, $setting ){

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        $data = wp_parse_args( $input, array() );

        if ( empty( $data ) ) {
            return false;
        }

        if ( ! is_array( $data ) ) {
            return false;
        }

        foreach ( $data as $key => $val ) {

            // Ensure input is a slug.
            $val = sanitize_key( $val );

            // If the input is a valid key, return it; otherwise, return the default.
            $data[$key] = ( array_key_exists( $val, $choices ) ? $val : $setting->default );
        }

        return $data;
    }


    /**
     * Boolean value sanitize
     *
     * @param mixed $value the value before sanitized.
     *
     * @return string
     */
    public static function sanitize_boolean( $value ) {
        // Boolean check.
        return ( isset( $value ) && true == $value ? 'true' : 'false' );
    }

    /**
     * Choices or Options value sanitize
     *
     * @param mixed $value the value before sanitized.
     * @param $setting
     *
     * @return string
     */
    public static function sanitize_choices( $value, $setting ) {

        if ( empty( $value ) ) {
            return false;
        }

        // Ensure input is a slug.
        $value = sanitize_key( $value );

        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $value, $choices ) ? $value : $setting->default );
    }

    /**
     * Sanitize Repeater control
     *
     * @param $value
     * @param $setting object $wp_customize
     * @return bool|mixed|string|void
     */
    public static function sanitize_repeater( $value, $setting ) {

        $control    = $setting->manager->get_control( $setting->id );

        // is the value formatted as a string?
        if ( is_string( $value ) ) {
            $value = rawurldecode( $value );
            $value = json_decode( $value, true );
        }

        // Nothing to sanitize if we don't have fields.
        if ( empty( $control->fields ) ) {
            return $value;
        }

        foreach ( $value as $row_id => $row_value ) {

            // Make sure the row is formatted as an array.
            if ( ! is_array( $row_value ) ) {
                $value[ $row_id ] = [];
                continue;
            }

            // Start parsing sub-fields in rows.
            foreach ( $row_value as $subfield_id => $subfield_value ) {

                // Make sure this is a valid subfield.
                // If it's not, then unset it.
                if ( ! isset( $control->fields[ $subfield_id ] ) ) {
                    unset( $value[ $row_id ][ $subfield_id ] );
                }

                // Get the subfield-type.
                if ( ! isset( $control->fields[ $subfield_id ]['type'] ) ) {
                    continue;
                }
                $subfield_type = $control->fields[ $subfield_id ]['type'];

                // Allow using a sanitize-callback on a per-field basis.
                if ( isset( $control->fields[ $subfield_id ]['sanitize_callback'] ) ) {
                    $subfield_value = call_user_func( $control->fields[ $subfield_id ]['sanitize_callback'], $subfield_value );
                } else {

                    switch ( $subfield_type ) {
                        case 'image':
                        case 'cropped_image':
                        case 'upload':
                            if ( ! is_numeric( $subfield_value ) && is_string( $subfield_value ) ) {
                                $subfield_value = esc_url_raw( $subfield_value );
                            }
                            break;
                        case 'dropdown-pages':
                            $subfield_value = (int) $subfield_value;
                            break;
                        case 'color':
                            if ( $subfield_value ) {
                                $color_obj      = \ariColor::newColor( $subfield_value );
                                $subfield_value = $color_obj->toCSS( $color_obj->mode );
                            }
                            break;
                        case 'text':
                            $subfield_value = sanitize_text_field( $subfield_value );
                            break;
                        case 'url':
                        case 'link':
                            $subfield_value = esc_url_raw( $subfield_value );
                            break;
                        case 'email':
                            $subfield_value = filter_var( $subfield_value, FILTER_SANITIZE_EMAIL );
                            break;
                        case 'tel':
                            $subfield_value = sanitize_text_field( $subfield_value );
                            break;
                        case 'checkbox':
                            $subfield_value = (bool) $subfield_value;
                            break;
                        case 'select':
                            if ( isset( $control->fields[ $subfield_id ]['multiple'] ) ) {
                                if ( true === $control->fields[ $subfield_id ]['multiple'] ) {
                                    $multiple = 2;
                                }
                                $multiple = (int) $control->fields[ $subfield_id ]['multiple'];
                                if ( 1 < $multiple ) {
                                    $subfield_value = (array) $subfield_value;
                                    foreach ( $subfield_value as $sub_subfield_key => $sub_subfield_value ) {
                                        $subfield_value[ $sub_subfield_key ] = sanitize_text_field( $sub_subfield_value );
                                    }
                                } else {
                                    $subfield_value = sanitize_text_field( $subfield_value );
                                }
                            }
                            break;
                        case 'radio':
                        case 'radio-image':
                            $subfield_value = sanitize_text_field( $subfield_value );
                            break;
                        case 'textarea':
                            $subfield_value = html_entity_decode( wp_kses_post( $subfield_value ) );

                    }
                }
                $value[ $row_id ][ $subfield_id ] = $subfield_value;
            }
        }
        return $value;
    }
}

Real_Home_Customizer_Sanitize_Callback::get_instance();
