<?php
/**
 * Real Home Theme Customizer Single Page Featured Image settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Page_Featured_Image_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Image Ratio
            'real_home_single_page_featured_image_ratio' => [
                'type'              => 'buttonset',
                'default'           => ['desktop' => '16x9'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
                'label'             => esc_html__( 'Aspect Ratio', 'real-home' ),
                'description'       => esc_html__( 'Select custom aspect ratio for featured image. Choose it wisely for better appearance.', 'real-home' ),
                'section'           => 'real_home_single_page_featured_image_section',
                'priority'          => 15,
                'choices' 			=> array(
                    'auto'              => esc_html__( 'Auto', 'real-home' ),
                    '1x1'               => esc_html__( '1:1', 'real-home' ),
                    '4x3'               => esc_html__( '4:3', 'real-home' ),
                    '16x9'              => esc_html__( '16:9', 'real-home' ),
                    '3x4'               => esc_html__( '3:4', 'real-home' ),
                )
            ],
            // Image Size
            'real_home_single_page_featured_image_size' => [
                'type'              => 'buttonset',
                'default'           => ['desktop' => 'medium_large'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
                'label'             => esc_html__( 'Image Size', 'real-home' ),
                'description'       => esc_html__( 'Set proper size for featured image. Selecting a bigger image size may display a better appearance but takes more time on loading websites.', 'real-home' ),
                'section'           => 'real_home_single_page_featured_image_section',
                'priority'          => 20,
                'choices' 			=> [
                    'thumbnail'         => esc_html__( 'Small', 'real-home' ),
                    'medium'            => esc_html__( 'Medium', 'real-home' ),
                    'medium_large'      => esc_html__( 'Medium Large', 'real-home' ),
                    'large'             => esc_html__( 'Large', 'real-home' ),
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Single_Page_Featured_Image_Fields();
