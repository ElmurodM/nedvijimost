<?php
/**
 * Real Home Theme Customizer Property Archive Custom Post Type Fields
 *
 * @package Real_Home
 */

class Real_Home_Customize_Custom_Archive_Property_Fields extends Real_Home_Customize_Base_Field {

	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		// Page Header
		$this->args = [
			// Page Header
			'real_home_property_archive_page_header_elements' => [
				'type'              => 'sortable',
				'default'           => ['post-title','breadcrumb'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Sort Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable Page Header Elements and manage lists using drag and drop.', 'real-home' ),
				'section'           => 'real_home_property_archive_page_header_section',
				'priority'          => 15,
				'choices'           => [
					'post-title'        => esc_html__( 'Title', 'real-home' ),
					'post-desc'         => esc_html__( 'Description', 'real-home' ),
					'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
				],
			]
		];
		// Post Content
		$this->args = array_merge( $this->args,
			[
				// Image Size
				'real_home_property_archive_posts_image_size' => [
					'type'              => 'buttonset',
					'default'           => ['desktop' => 'medium'],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
					'label'             => esc_html__( 'Image Size', 'real-home' ),
					'description'       => esc_html__( 'Set proper size for featured image. Selecting a bigger image size may display a better appearance but takes more time on loading websites.', 'real-home' ),
					'section'           => 'real_home_property_archive_post_content_section',
					'priority'          => 20,
					'choices' 			=> [
						'thumbnail'         => esc_html__( 'Small', 'real-home' ),
						'medium'            => esc_html__( 'Medium', 'real-home' ),
						'medium_large'      => esc_html__( 'Medium Large', 'real-home' ),
						'large'             => esc_html__( 'Large', 'real-home' ),
					]
				],
			]
		);
	}

}
new Real_Home_Customize_Custom_Archive_Property_Fields();
