<?php
/**
 * Real Home Theme Customizer Front Page Property Locations Sections settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_Property_Locations_Fields extends Real_Home_Customize_Base_Field {


	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		$this->args = [
			// Grouping Settings
			'real_home_front_page_featured_categories_group_settings' => [
				'type'              => 'group',
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 10,
				'choices'           => [
					'normal'            => array(
						'tab-title'     => esc_html__( 'General', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_property_locations_section_heading',
							'real_home_front_page_property_locations_limits',
							'real_home_front_page_property_location_view_all_btn',
							'real_home_front_page_property_locations_view_all_btn_link'
						)
					),
					'hover'         => array(
						'tab-title'     => esc_html__( 'Style', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_property_locations_heading_one',
							'real_home_front_page_property_locations_background',
							'real_home_front_page_property_locations_background_overlay'
						)
					)
				]
			],
			// Section Heading
			'real_home_front_page_property_locations_section_heading' => [
				'type'              => 'text',
				'default'           => esc_html__( 'Reality Property Location', 'real-home' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Section Heading', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 14,
			],
			// Number of posts
			'real_home_front_page_property_locations_limits' => [
				'type'              => 'range',
				'default'           => ['desktop' => 6],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
				'label'             => esc_html__( 'Posts Limit', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 16,
				'units'             => [],
				'input_attrs'       => [
					'min'               => 0,
					'max'               => 20
				]
			],
			'real_home_front_page_property_location_view_all_btn' => [
				'type'              => 'toggle',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
				'label'             => esc_html__( 'View All', 'real-home' ),
				'description'       => esc_html__( 'Toggle to show/hide view all button.', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 18,
			],
			// Button URL
			'real_home_front_page_property_locations_view_all_btn_link' => [
				'type'              => 'text',
				'default'           => '#',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Button Link', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 19,
			],
			// Heading One
			'real_home_front_page_property_locations_heading_one' => [
				'type'              => 'heading',
				'label'             => esc_html__( 'SECTION STYLING', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 20,
			],
			// Background Image
			'real_home_front_page_property_locations_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'Set background image for container.', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 25,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
			// Background Overlay
			'real_home_front_page_property_locations_background_overlay' => [
				'type'              => 'background',
				'default'           => [
					'colors'            => [
						'color_1'           => 'var(--color-bg-4)'
					]
				],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Overlay', 'real-home' ),
				'description'       => esc_html__( 'Set background overlay color for container.', 'real-home' ),
				'section'           => 'real_home_front_page_property_locations_section',
				'priority'          => 26,
				'inherits'          => [
					'color_1'           => 'var(--color-bg-4)'
				],
				'fields'            => ['colors' => true],
			]
		];
	}

}
new Real_Home_Customize_Front_Page_Property_Locations_Fields();
