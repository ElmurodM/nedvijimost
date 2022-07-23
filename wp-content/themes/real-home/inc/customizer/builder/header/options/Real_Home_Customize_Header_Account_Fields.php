<?php
/**
 * Real Home Theme Customizer Header Account settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Account_Fields extends Real_Home_Customize_Base_Field {


    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_header_account_group_settings' => [
                'type'              => 'group',
                'section'           => 'account',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_account_note_one',
                            'real_home_header_account_login_text',
                            'real_home_header_account_login_url',
                            'real_home_header_account_note_two',
                            'real_home_header_account_logout_text',
                            'real_home_header_account_logout_url',
                            'real_home_header_account_note_three',
                            'real_home_header_account_url_target'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                        	'real_home_header_account_border',
                            'real_home_header_account_padding',
                            'real_home_header_account_margin'
                        )
                    )
                ]
            ],
            // Note One
            'real_home_header_account_note_one' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'LOGIN', 'real-home' ),
                'section'           => 'account',
                'priority'          => 15,
            ],
            // Login Text
            'real_home_header_account_login_text' => [
                'type'              => 'text',
                'default'           => esc_html__( 'My Account', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Text', 'real-home' ),
                'section'           => 'account',
                'priority'          => 20,
            ],
            // Account URL
            'real_home_header_account_login_url' => [
                'type'              => 'url',
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
                'label'             => esc_html__( 'URL', 'real-home' ),
                'section'           => 'account',
                'priority'          => 25,
            ],
            // Note Two
            'real_home_header_account_note_two' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'LOGOUT', 'real-home' ),
                'section'           => 'account',
                'priority'          => 30,
            ],
            // Logout Text
            'real_home_header_account_logout_text' => [
                'type'              => 'text',
                'default'           => esc_html__( 'Log In', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Text', 'real-home' ),
                'section'           => 'account',
                'priority'          => 35,
            ],
            //  Logout URL
            'real_home_header_account_logout_url' => [
                'type'              => 'url',
                'default'           => wp_login_url(),
                'sanitize_callback' => 'esc_url_raw',
                'label'             => esc_html__( 'URL', 'real-home' ),
                'section'           => 'account',
                'priority'          => 40,
            ],
            // Note Three
            'real_home_header_account_note_three' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SETTINGS', 'real-home' ),
                'section'           => 'account',
                'priority'          => 45,
            ],
            // Link Open
            'real_home_header_account_url_target' => [
                'type'              => 'toggle',
                'default'           => '',
                'section'           => 'account',
                'priority'          => 75,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Link Open', 'real-home' ),
                'description'       => esc_html__( 'Toggle to enable link open in new window tab.', 'real-home' ),
            ],
			// Border
			'real_home_header_account_border' => [
				'type'              => 'border',
				'default'           => [
					'width'           => [
						'side_1'            => '1px',
						'side_2'            => '1px',
						'side_3'            => '1px',
						'side_4'            => '1px',
						'linked'            => 'on'
					]
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_border' ],
				'label'             => esc_html__( 'Border', 'real-home' ),
				'description'       => esc_html__( 'Set account border width.', 'real-home' ),
				'section'           => 'account',
				'priority'          => 95,
				'fields'            => ['width'=>true],
			],
            // Padding
            'real_home_header_account_padding' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '12px',
                        'side_2'            => '18px',
                        'side_3'            => '12px',
                        'side_4'            => '18px',
                        'linked'            => 'off'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set account padding.', 'real-home' ),
                'section'           => 'account',
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'priority'          => 105,
            ],
            // Margin
            'real_home_header_account_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set account margin.', 'real-home' ),
                'section'           => 'account',
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'priority'          => 110,
            ],

        ];
    }

}
new Real_Home_Customize_Header_Account_Fields();
