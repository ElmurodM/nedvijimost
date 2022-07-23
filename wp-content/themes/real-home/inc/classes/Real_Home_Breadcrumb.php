<?php
/**
 * Real Home Breadcrumb
 *
 * @package Real_Home
 */

/**
 * class for breadcrumb
 *
 * @access public
 */
class Real_Home_Breadcrumb {

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
    private function __construct() {

        // Include trial breadcrumb
        require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Breadcrumb_Trail.php';

    }

    public static function get_breadcrumb() {

        $defaults = array(
            'show_browse' => false,
            'echo'        => true,
        );

        $args = apply_filters( 'breadcrumb_trail_args', $defaults );

        $breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

        if ( ! is_object( $breadcrumb ) )

            $breadcrumb = new Real_Home_Breadcrumb_Trail( $args );

        return $breadcrumb->trail();

    }

}

Real_Home_Breadcrumb::get_instance();
