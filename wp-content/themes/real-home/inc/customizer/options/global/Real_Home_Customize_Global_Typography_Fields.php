<?php
/**
 * Real Home Theme Customizer Typography settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Typography_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Base Typography
            'real_home_base_typography' => [
                'type'              => 'typography',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_typography' ],
                'label'             => esc_html__( 'Base', 'real-home' ),
                'description'       => esc_html__( 'Set Typography for the base of your website.', 'real-home' ),
                'section'           => 'real_home_typography_section',
                'priority'          => 10,
                'fields'            => ['font_family'=>true,'font_variant'=>true]
            ]
        ];

    }

}
new Real_Home_Customize_Global_Typography_Fields();
