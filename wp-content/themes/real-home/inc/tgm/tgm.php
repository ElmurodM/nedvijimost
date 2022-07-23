<?php
/**
 * Plugin recommendation
 *
 * @package Real_Home
 */

// Load TGM library.
require REAL_HOME_THEME_DIR . 'inc/tgm/class-tgm-plugin-activation.php';

if ( ! function_exists( 'real_home_recommended_plugins' ) ) :

	/**
	 * Register recommended plugins.
	 *
	 * @since 1.0.0
	 */
	function real_home_recommended_plugins() {
        $plugins = array(
            array(
                'name'     => esc_html__( 'Aarambha Demo Sites', 'real-home' ),
                'slug'     => 'aarambha-demo-sites',
                'required' => false,
            ),
			array(
				'name'     => esc_html__( 'Crucial Real Estate', 'real-home' ),
				'slug'     => 'crucial-real-estate',
				'required' => false,
			)
        );

        $config = array();

        tgmpa( $plugins, $config );
	}

endif;

add_action( 'tgmpa_register', 'real_home_recommended_plugins' );
