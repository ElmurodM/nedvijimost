<?php
/**
 * Real Home Theme Customizer Footer Copyright settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Copyright_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_footer_copyright_group_settings' => [
                'type'              => 'group',
                'section'           => 'footer_copyright',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_copyright_text',
                            'real_home_footer_copyright_link_target'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_copyright_padding',
                            'real_home_footer_copyright_margin'
                        )
                    )
                ]
            ],
            // Textarea
            'real_home_footer_copyright_text' => [
                'type'              => 'textarea',
                'default'           => __( 'Copyright {copyright} {current_year} {site_title}', 'real-home' ),
                'sanitize_callback' => 'wp_kses_post',
                'label'             => esc_html__( 'Copyright Text', 'real-home' ),
                'description'       => esc_html__( 'You can insert some arbitrary HTML code tags: {current_year} and {site_title}', 'real-home' ),
                'section'           => 'footer_copyright',
                'priority'          => 15,
            ],
            // Link Open
            'real_home_footer_copyright_link_target' => [
                'type'              => 'toggle',
                'default'           => ['desktop'=>'true'],
                'section'           => 'footer_copyright',
                'priority'          => 20,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Link Open', 'real-home' ),
                'description'       => esc_html__( 'Toggle to enable link open in new window tab.', 'real-home' ),
            ],
            // Padding
            'real_home_footer_copyright_padding' => [
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
                'section'           => 'footer_copyright',
                'priority'          => 55,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_footer_copyright_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'section'           => 'footer_copyright',
                'priority'          => 60,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ]
        ];
    }

}
new Real_Home_Customize_Footer_Copyright_Fields();
