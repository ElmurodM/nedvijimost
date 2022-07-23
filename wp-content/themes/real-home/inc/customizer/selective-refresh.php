<?php
/**
 * Real Home Theme Customizer Selective Refresh
 *
 * @package Real_Home
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( isset( $wp_customize->selective_refresh ) ) {

    $wp_customize->selective_refresh->add_partial(
        'blogname',
        array(
            'selector'        => '.site-title a',
            'render_callback' => [ $this, 'real_home_customize_partial_blogname' ],
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'blogdescription',
        array(
            'selector'        => '.site-description',
            'render_callback' => [ $this, 'real_home_customize_partial_blogdescription' ],
        )
    );

    // Header Builder
    $wp_customize->selective_refresh->add_partial(
        'real_home_header',
        array(
            'selector'          => '.site-header',
            'settings'          => array(
                'real_home_header_builder_controller_section'
            ),
            'render_callback'   => function() {
                Real_Home_Customizer_Header_Builder()->real_home_header_display();
            }
        )
    );

    // Footer Builder
    $wp_customize->selective_refresh->add_partial(
        'real_home_footer',
        array(
            'selector'          => '.site-footer',
            'settings'          => array(
                'real_home_footer_builder_controller_section'
            ),
            'render_callback'   => function() {
                Real_Home_Customizer_Footer_Builder()->real_home_footer_display();
            }
        )
    );
}
