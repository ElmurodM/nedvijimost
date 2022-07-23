<?php
/**
 * Real Home Theme Customizer Front Page Featured Properties Sections settings
 *
 * @package Real_Home
 */



class Real_Home_Customize_Front_Page_Property_Type_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_front_page_property_type_group_settings' => [
                'type'              => 'group',
                'section'           => 'real_home_front_page_property_type_section',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_property_types',
                            'real_home_front_page_property_type_limits',
							'real_home_front_page_property_type_view_all_btn'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_property_section_divider',
                            'real_home_front_page_property_type_background',
                            'real_home_front_page_property_type_background_overlay'
                        )
                    )
                ]
            ],
			// Number of posts
			'real_home_front_page_property_type_limits' => [
				'type'              => 'range',
				'default'           => ['desktop' => 6],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
				'label'             => esc_html__( 'Posts Limit', 'real-home' ),
				'section'           => 'real_home_front_page_property_type_section',
				'priority'          => 18,
				'units'             => [],
				'input_attrs'       => [
					'min'               => 0,
					'max'               => 20
				]
			],
			'real_home_front_page_property_type_view_all_btn' => [
				'type'              => 'toggle',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
				'label'             => esc_html__( 'View All', 'real-home' ),
				'description'       => esc_html__( 'Toggle to show/hide view all button.', 'real-home' ),
				'section'           => 'real_home_front_page_property_type_section',
				'priority'          => 18,
			],
            // Heading One
            'real_home_front_page_property_section_divider' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SECTION STYLING', 'real-home' ),
                'section'           => 'real_home_front_page_property_type_section',
                'priority'          => 19,
            ],
            // Background Image
            'real_home_front_page_property_type_background' => [
                'type'              => 'background',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Image', 'real-home' ),
                'description'       => esc_html__( 'Set background image for container.', 'real-home' ),
                'section'           => 'real_home_front_page_property_type_section',
                'priority'          => 20,
                'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
            ],
            // Background Overlay
            'real_home_front_page_property_type_background_overlay' => [
                'type'              => 'background',
                'default'           => [
                    'background'        => 'color',
                    'colors'            => [
                        'color_1'           => 'var(--color-bg)'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Overlay', 'real-home' ),
                'description'       => esc_html__( 'Set background overlay color for container.', 'real-home' ),
                'section'           => 'real_home_front_page_property_type_section',
                'priority'          => 20,
                'inherits'          => [
                    'color_1'           => 'var(--color-bg)'
                ],
                'fields'            => ['colors' => true ],
            ]
        ];
    }

}
new Real_Home_Customize_Front_Page_Property_Type_Fields();
