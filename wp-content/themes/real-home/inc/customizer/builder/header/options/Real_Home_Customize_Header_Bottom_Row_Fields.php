<?php
/**
 * Real Home Theme Customizer Header Bottom Row settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Bottom_Row_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
			// Min Height
			'real_home_header_bottom_row_height' => [
				'type'              => 'range',
				'default'           => ['desktop' => '0px'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
				'label'             => esc_html__( 'Min Height', 'real-home' ),
				'description'       => esc_html__( 'To set Min Height at the bottom row of Header.', 'real-home' ),
				'section'           => 'real_home_header_bottom',
				'priority'          => 15,
				'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
				'input_attrs'       => [
					'min'               => 0,
					'max'               => 400
				]
			],
			// Left Column Justify Content
			'real_home_header_bottom_row_left_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'start',
					'tablet'    => 'start',
					'mobile'    => 'start'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Left Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Left Column.', 'real-home' ),
				'section'           => 'real_home_header_bottom',
				'priority'          => 17,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
			// Center Column Justify Content
			'real_home_header_bottom_row_center_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'center',
					'tablet'    => 'center',
					'mobile'    => 'center'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Center Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Center Column.', 'real-home' ),
				'section'           => 'real_home_header_bottom',
				'priority'          => 18,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
			// Right Column Justify Content
			'real_home_header_bottom_row_right_col_content_justify' => [
				'type'              => 'buttonset',
				'default'           => [
					'desktop'   => 'end',
					'tablet'    => 'end',
					'mobile'    => 'end'
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
				'label'             => esc_html__( 'Right Column', 'real-home' ),
				'description'       => esc_html__( 'Choose position for the content in the Right Column.', 'real-home' ),
				'section'           => 'real_home_header_bottom',
				'priority'          => 19,
				'choices'           => [
					'start'     => esc_html__( 'Start', 'real-home' ),
					'center'    => esc_html__( 'Center', 'real-home' ),
					'end'       => esc_html__( 'End', 'real-home' )
				],
				'responsive'        => ['desktop','tablet','mobile'],
			],
            // Background Overlay
            'real_home_header_bottom_row_background_overlay' => [
                'type'              => 'background',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Overlay', 'real-home' ),
                'description'       => esc_html__( 'Set Background overlay color for bottom row container.', 'real-home' ),
                'section'           => 'real_home_header_bottom',
                'priority'          => 20,
                'inherits'          => [
                    'color_1'           => 'var(--color-bg)'
                ],
                'fields'            => ['colors' => true],
            ]
        ];
    }

}
new Real_Home_Customize_Header_Bottom_Row_Fields();
