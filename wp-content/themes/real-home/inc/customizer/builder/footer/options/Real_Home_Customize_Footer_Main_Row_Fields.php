<?php
/**
 * Real Home Theme Customizer Footer Main Row settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Main_Row_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
			// Left Column Justify Content
			'real_home_footer_main_row_left_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'start',
					'tablet'    => 'start',
					'mobile'    => 'start'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Left Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Left Column.', 'real-home' ),
				'section'           => 'real_home_footer_main',
				'priority'          => 17,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
			// Center Column Justify Content
			'real_home_footer_main_row_center_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'center',
					'tablet'    => 'center',
					'mobile'    => 'center'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Center Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Center Column.', 'real-home' ),
				'section'           => 'real_home_footer_main',
				'priority'          => 18,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
			// Right Column Justify Content
			'real_home_footer_main_row_right_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'end',
					'tablet'    => 'end',
					'mobile'    => 'end'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Right Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Right Column.', 'real-home' ),
				'section'           => 'real_home_footer_main',
				'priority'          => 19,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
			// Background Image
			'real_home_footer_main_row_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'Set Background Image for main row', 'real-home' ),
				'section'           => 'real_home_footer_main',
				'priority'          => 20,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
            // Background Overlay
            'real_home_footer_main_row_background_overlay' => [
                'type'              => 'background',
				'default'           => [
					'background'        => 'color',
					'colors'            => [
						'color_1'           => 'rgba(0,0,0,0.22)'
					]
				],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Overlay', 'real-home' ),
                'description'       => esc_html__( 'Set Background overlay color for main row container.', 'real-home' ),
                'section'           => 'real_home_footer_main',
                'priority'          => 20,
                'inherits'          => [
                    'color_1'           => 'rgba(0,0,0,0.22)'
                ],
                'fields'            => ['colors' => true],
            ],
            // Padding
            'real_home_footer_main_row_padding' => [
                'type'              => 'dimensions',
                'default'           => [
                    'desktop'           => [
                        'side_1'            => '25px',
                        'side_3'            => '25px',
                        'linked'            => 'off'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'section'           => 'real_home_footer_main',
                'priority'          => 35,
                'description'       => esc_html__( 'Set footer main row padding.', 'real-home' ),
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ]
            ]
        ];
    }

}
new Real_Home_Customize_Footer_Main_Row_Fields();
