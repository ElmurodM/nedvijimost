<?php
/**
 * Real Home Theme Customizer Front Page Services Sections settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_Services_Fields extends Real_Home_Customize_Base_Field {

	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		$this->args = [
			// Grouping Settings
			'real_home_front_page_services_group_settings' => [
				'type'              => 'group',
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 10,
				'choices'           => [
					'normal'            => array(
						'tab-title'     => esc_html__( 'General', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_services_section_heading',
							'real_home_front_page_services_page'

						)
					),
					'hover'         => array(
						'tab-title'     => esc_html__( 'Style', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_services_heading_one',
							'real_home_front_page_services_background',
							'real_home_front_page_services_background_overlay'
						)
					)
				]
			],
			// Heading
			'real_home_front_page_services_section_heading' => [
				'type'              => 'text',
				'default'           => esc_html__( 'why people choose us', 'real-home' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Section Heading', 'real-home' ),
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 10,
			],
			// Heading One
			'real_home_front_page_services_heading_one' => [
				'type'              => 'heading',
				'label'             => esc_html__( 'SECTION STYLING', 'real-home' ),
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 21,
			],
			// Select Page
			'real_home_front_page_services_page' => [
				'type'              => 'select',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_choices' ],
				'label'             => esc_html__( 'Select Page', 'real-home' ),
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 25,
				'choices'  			=> Real_Home_Helper::get_posts(
					array(
						'posts_per_page' => -1,
						'post_type'      => 'page'
					)
				)
			],
			// Background Image
			'real_home_front_page_services_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'Set background image for container.', 'real-home' ),
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 30,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
			// Background Overlay
			'real_home_front_page_services_background_overlay' => [
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
				'section'           => 'real_home_front_page_services_section',
				'priority'          => 31,
				'inherits'          => [
					'color_1'           => 'var(--color-bg)'
				],
				'fields'            => ['colors' => true],
			]
		];
	}

}
new Real_Home_Customize_Front_Page_Services_Fields();
