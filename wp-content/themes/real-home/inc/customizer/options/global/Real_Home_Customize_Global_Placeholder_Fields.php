<?php
/**
 * Real Home Theme Customizer Placeholder settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Placeholder_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Color
            'real_home_placeholder_color' => [
                'type'              => 'color',
                'default'           => [
                    'color_1'           => '#dbdcdf'
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'Placeholder Color', 'real-home' ),
                'description'       => esc_html__( 'Set color in placeholder if there isn’t a featured image.', 'real-home' ),
                'section'           => 'real_home_placeholder_section',
                'priority'          => 10,
            ],
            // Image
            'real_home_placeholder_image' => [
                'type'              => 'image',
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'label'             => esc_html__( 'Placeholder Image', 'real-home' ),
                'description'       => esc_html__( 'Set placeholder image for no featured image. It will replace the placeholder color.', 'real-home' ),
                'section'           => 'real_home_placeholder_section',
                'priority'          => 15,
            ]
        ];
    }

}
new Real_Home_Customize_Global_Placeholder_Fields();
