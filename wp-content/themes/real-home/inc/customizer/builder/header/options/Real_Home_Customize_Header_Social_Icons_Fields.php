<?php
/**
 * Real Home Theme Customizer Header Social Icons settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Social_Icons_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_header_social_icon_group_settings' => [
                'type'              => 'group',
                'section'           => 'social_icons',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_social_icon_note_one',
                            'real_home_header_social_icon_link_open'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_social_icon_padding',
                            'real_home_header_social_icon_margin',
                            'real_home_header_social_icon_note_two',
                            'real_home_header_social_icon_item_border',
                            'real_home_header_social_icon_item_padding',
                            'real_home_header_social_icon_item_margin'
                        )
                    )
                ]
            ],
            // Heading One
            'real_home_header_social_icon_note_one' => [
                'type'              => 'heading',
				'description'       => sprintf(__( 'Configure social icons in Global &raquo; Social &raquo; <a data-type="control" data-id="real_home_social_icons" class="customizer-focus"><strong> Social Icons </strong></a>.', 'real-home' )),
                'section'           => 'social_icons',
                'priority'          => 15,
            ],
            // Link Open
            'real_home_header_social_icon_link_open' => [
                'type'              => 'toggle',
                'default'           => '',
                'section'           => 'social_icons',
                'priority'          => 40,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Link Open', 'real-home' ),
                'description'       => esc_html__( 'Enable to open the link in the new tab.', 'real-home' ),
            ],
            // Padding
            'real_home_header_social_icon_padding' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set social container padding.', 'real-home' ),
                'section'           => 'social_icons',
                'priority'          => 42,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_header_social_icon_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set social container margin.', 'real-home' ),
                'section'           => 'social_icons',
                'priority'          => 45,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Heading One
            'real_home_header_social_icon_note_two' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'ITEM', 'real-home' ),
                'section'           => 'social_icons',
                'priority'          => 50,
            ],
			// Border
			'real_home_header_social_icon_item_border' => [
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
				'description'       => esc_html__( 'Set each item border width.', 'real-home' ),
				'section'           => 'social_icons',
				'priority'          => 65,
				'fields'			=> ['width'=>true]
			],
            // Padding
            'real_home_header_social_icon_item_padding' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_2'            => '15px',
                        'side_3'            => '10px',
                        'side_4'            => '15px',
                        'linked'            => 'off'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set each item padding.', 'real-home' ),
                'section'           => 'social_icons',
                'priority'          => 80,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_header_social_icon_item_margin' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '0px',
                        'side_2'            => '0px',
                        'side_3'            => '0px',
                        'side_4'            => '0px',
                        'linked'            => 'on'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set each item margin.', 'real-home' ),
                'section'           => 'social_icons',
                'priority'          => 85,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],

        ];
    }

}
new Real_Home_Customize_Header_Social_Icons_Fields();
