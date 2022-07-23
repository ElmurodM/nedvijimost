<?php
/**
 * Real Home Theme Customizer 404 Page Content settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_404_Page_Content_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
			// Grouping Settings
			'real_home_404_error_grouping_settings' => [
				'type'              => 'group',
				'section'           => 'real_home_404_page_content_section',
				'priority'          => 10,
				'choices'           => [
					'normal'            => array(
						'tab-title'     => esc_html__( 'General', 'real-home' ),
						'controls'      => array(
							'real_home_404_error_page_content_elements',
							'real_home_404_error_image'
						)
					),
					'hover'         => array(
						'tab-title'     => esc_html__( 'Style', 'real-home' ),
						'controls'      => array(
							'real_home_404_error_background',
						)
					)
				]
			],
            // Error Page Content
            'real_home_404_error_page_content_elements' => [
                'type'              => 'sortable',
                'default'           => ['title','subtitle','button'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Sort Elements', 'real-home' ),
                'description'       => esc_html__( 'Enable page content elements and order their list with drag and drop.', 'real-home' ),
                'section'           => 'real_home_404_page_content_section',
                'priority'          => 15,
                'choices'           => [
                    'image'             => esc_html__( 'Image', 'real-home' ),
                    'title'             => esc_html__( 'Title', 'real-home' ),
                    'subtitle'          => esc_html__( 'Sub Title', 'real-home' ),
                    'button'            => esc_html__( 'Button', 'real-home' ),
                    'search'            => esc_html__( 'Search', 'real-home' )
                ],
            ],
            // Image
            'real_home_404_error_image' => [
                'type'              => 'image',
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'label'             => esc_html__( 'Image', 'real-home' ),
                'section'           => 'real_home_404_page_content_section',
                'priority'          => 20,
            ],
			// Background Image
			'real_home_404_error_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'Set background image for 404 page content.', 'real-home' ),
				'section'           => 'real_home_404_page_content_section',
				'priority'          => 75,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
        ];
    }

}
new Real_Home_Customize_404_Page_Content_Fields();
