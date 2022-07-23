<?php
/**
 * Real Home Theme Customizer Footer Button settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Button_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_footer_button_group_settings' => [
                'type'              => 'group',
                'section'           => 'footer_button',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_button_text',
                            'real_home_footer_button_url',
                            'real_home_footer_button_url_target'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_button_border',
                            'real_home_footer_button_padding',
                            'real_home_footer_button_margin'
                        )
                    )
                ]
            ],
            // Text
            'real_home_footer_button_text' => [
                'type'              => 'text',
                'default'           => esc_html__( 'Button', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Text', 'real-home' ),
                'section'           => 'footer_button',
                'priority'          => 20,
            ],
            // URL
            'real_home_footer_button_url' => [
                'type'              => 'url',
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
                'label'             => esc_html__( 'URL', 'real-home' ),
                'section'           => 'footer_button',
                'priority'          => 25,
            ],
            // Link Open
            'real_home_footer_button_url_target' => [
                'type'              => 'toggle',
                'default'           => '',
                'section'           => 'footer_button',
                'priority'          => 50,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Link Open', 'real-home' ),
                'description'       => esc_html__( 'Enable to open the link in the new tab.', 'real-home' ),
            ],
            // Border
            'real_home_footer_button_border' => [
                'type'              => 'border',
                'default'           => [
					'width'           => [
						'side_1'            => '1px',
						'side_2'            => '1px',
						'side_3'            => '1px',
						'side_4'            => '1px',
						'linked'            => 'off'
					]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_border' ],
                'label'             => esc_html__( 'Border', 'real-home' ),
                'description'       => esc_html__( 'Set button border width.', 'real-home' ),
                'section'           => 'footer_button',
                'priority'          => 65,
				'fields'			=> ['width'=>true]
            ],
            // Padding
            'real_home_footer_button_padding' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '7px',
                        'side_2'            => '15px',
                        'side_3'            => '7px',
                        'side_4'            => '15px',
                        'linked'            => 'off'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set button padding.', 'real-home' ),
                'section'           => 'footer_button',
                'priority'          => 75,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_footer_button_margin' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '5px',
                        'side_2'            => '5px',
                        'side_3'            => '5px',
                        'side_4'            => '5px',
                        'linked'            => 'on'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set button margin.', 'real-home' ),
                'section'           => 'footer_button',
                'priority'          => 80,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],

        ];
    }

}
new Real_Home_Customize_Footer_Button_Fields();
