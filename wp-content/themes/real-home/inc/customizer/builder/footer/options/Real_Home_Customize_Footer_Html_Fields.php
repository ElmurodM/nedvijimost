<?php
/**
 * Real Home Theme Customizer Footer HTML settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Html_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_footer_html_group_settings' => [
                'type'              => 'group',
                'section'           => 'footer_html',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'custom_logo',
                            'real_home_footer_html_text'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_html_padding',
                            'real_home_footer_html_margin'
                        )
                    )
                ]
            ],
            // Textarea
            'real_home_footer_html_text' => [
                'type'              => 'textarea',
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
                'label'             => esc_html__( 'HTML', 'real-home' ),
                'description'       => esc_html__( 'Enter Text/Simple HTML Code', 'real-home' ),
                'section'           => 'footer_html',
                'priority'          => 15,
            ],
            // Padding
            'real_home_footer_html_padding' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_3'            => '10px',
                        'linked'            => 'off'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set HTML container padding.', 'real-home' ),
                'section'           => 'footer_html',
                'priority'          => 55,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_footer_html_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set HTML container margin.', 'real-home' ),
                'section'           => 'footer_html',
                'priority'          => 60,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ]
        ];
    }

}
new Real_Home_Customize_Footer_Html_Fields();
