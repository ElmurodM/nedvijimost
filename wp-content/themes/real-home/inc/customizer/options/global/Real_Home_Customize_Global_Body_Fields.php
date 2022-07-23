<?php
/**
 * Real Home Theme Customizer Body settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Body_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        // Background
        $this->args = [
            'real_home_body_background' => [
                'type'              => 'background',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background', 'real-home' ),
                'description'       => esc_html__( 'Color or Image as the background of your site.', 'real-home' ),
                'section'           => 'real_home_body_section',
                'priority'          => 10,
                'inherits'          => [
                    'color_1'           => 'var(--color-bg)',
                ],
				'fields'            => ['background' => true, 'colors' => true,'image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true],
            ]
        ];
    }

}
new Real_Home_Customize_Global_Body_Fields();
