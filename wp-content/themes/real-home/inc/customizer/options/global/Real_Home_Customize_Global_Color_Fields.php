<?php
/**
 * Real Home Theme Customizer Color settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Color_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Accent Color
            'real_home_accent_color' => [
                'type'              => 'color',
                'default'           => [
                    'color_1'           => '#FCCE00',
                    'color_2'           => '#354255'
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'Accent', 'real-home' ),
                'section'           => 'colors',
                'priority'          => 10,
                'colors'            => [
                    'color_1'           => esc_html__( 'Primary', 'real-home' ),
                    'color_2'           => esc_html__( 'Secondary', 'real-home' )
                ],
                'inherits'            => [
                    'color_1'           => 'var(--color-accent)',
                    'color_2'           => 'var(--color-accent-secondary)'
                ]
            ],
            // H1-H6 Color
            'real_home_heading_color' => [
                'type'              => 'color',
                'default'           => [
                    'color_1'           => '#3d4151'
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'H1 -H6', 'real-home' ),
                'section'           => 'colors',
                'priority'          => 15,
                'inherits'            => [
                    'color_1'           => 'var(--color-heading)'
                ]
            ],
            // Text Color
            'real_home_text_color' => [
                'type'              => 'color',
                'default'           => [
                    'color_2'           => '#6d707d'
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'Base Text', 'real-home' ),
                'section'           => 'colors',
                'priority'          => 20,
                'colors'            => [
                    'color_2'           => esc_html__( 'Color 2', 'real-home' )
                ],
                'inherits'            => [
                    'color_2'           => 'var(--color-2)'
                ]
            ],
            // Link Color
            'real_home_link_color' => [
                'type'              => 'color',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'Link', 'real-home' ),
                'section'           => 'colors',
                'priority'          => 25,
                'colors'            => [
                    'color_1'           => esc_html__( 'Normal', 'real-home' ),
                    'color_2'           => esc_html__( 'Hover', 'real-home' ),
                    'color_3'           => esc_html__( 'Visited', 'real-home' )
                ],
                'inherits'            => [
                    'color_1'           => 'var(--color-1)',
                    'color_2'           => 'var(--color-accent)',
                    'color_3'           => 'var(--color-3)'
                ]
            ],
            // Background Color
            'real_home_background_color' => [
                'type'              => 'color',
                'default'           => [
                    'color_1'           => '#ffffff'
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_color' ],
                'label'             => esc_html__( 'Background', 'real-home' ),
                'section'           => 'colors',
                'priority'          => 30,
                'colors'            => [
                    'color_1'           => esc_html__( 'BG Color', 'real-home' )
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Global_Color_Fields();
