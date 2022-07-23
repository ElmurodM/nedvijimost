<?php
/**
 * Real Home Theme Customizer Page Header settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Page_Header_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
			// Background Image
			'real_home_page_header_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'To set the background image for the page header container.', 'real-home' ),
				'section'           => 'real_home_page_header_section',
				'priority'          => 5,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
			// Background Overlay
			'real_home_page_header_background_overlay' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Overlay', 'real-home' ),
				'description'       => esc_html__( 'Set Background overlay color on page header container.', 'real-home' ),
				'section'           => 'real_home_page_header_section',
				'priority'          => 5,
				'inherits'          => [
					'color_1'           => 'var(--color-bg-2)'
				],
				'fields'            => ['colors' => true],
			]
        ];

    }

}
new Real_Home_Customize_Global_Page_Header_Fields();
