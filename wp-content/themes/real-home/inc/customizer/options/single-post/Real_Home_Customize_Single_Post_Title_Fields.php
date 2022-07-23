<?php
/**
 * Real Home Theme Customizer Single Post Title settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Post_Title_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Title Tag
            'real_home_single_post_title_tag' => [
                'type'              => 'buttonset',
                'default'           => ['desktop' => 'h1'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
                'label'             => esc_html__( 'Heading Tag', 'real-home' ),
                'section'           => 'real_home_single_post_title_section',
                'priority'          => 15,
                'choices' 			=> array(
                    'h1'                => esc_html__( 'H1', 'real-home' ),
                    'h2'                => esc_html__( 'H2', 'real-home' ),
                    'h3'                => esc_html__( 'H3', 'real-home' ),
                    'h4'                => esc_html__( 'H4', 'real-home' ),
                    'h5'                => esc_html__( 'H5', 'real-home' ),
                    'h6'                => esc_html__( 'H6', 'real-home' )
                )
            ]
        ];
    }

}
new Real_Home_Customize_Single_Post_Title_Fields();
