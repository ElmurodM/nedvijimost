<?php
/**
 * Real Home Theme Customizer Property Post Fields
 *
 * @package Real_Home
 */

class Real_Home_Customize_Property_Post_Fields extends Real_Home_Customize_Base_Field {

	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		// Page Header
		$this->args = [
			// Post Header
			'real_home_property_single_post_header_elements' => [
				'type'              => 'sortable',
				'default'           => ['post-title','breadcrumb'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Sort Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable Social Share elements and sort list by drag and drop.', 'real-home' ),
				'section'           => 'real_home_property_single_post_header_section',
				'priority'          => 15,
				'choices'           => [
					'post-title'        => esc_html__( 'Post Title', 'real-home' ),
					'post-meta'         => esc_html__( 'Post Meta', 'real-home' ),
					'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
				],
			],
			// Meta Elements
			'real_home_property_single_post_meta_elements' => [
				'type'              => 'sortable',
				'default'           => ['author','post-date'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Post Meta Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable Post Meta Elements and sort their order by drag and drop.', 'real-home' ),
				'section'           => 'real_home_property_single_post_header_section',
				'priority'          => 15,
				'choices'           => [
					'author'            => esc_html__( 'Author', 'real-home' ),
					'comments'          => esc_html__( 'Comments', 'real-home' ),
					'post-date'         => esc_html__( 'Post Date', 'real-home' ),
					'location'        	=> esc_html__( 'Property Location', 'real-home' ),
					'status'            => esc_html__( 'Property Status', 'real-home' ),
					'types'             => esc_html__( 'Property Type', 'real-home' )

				],
			]
		];
		// Post Content
		$this->args = array_merge($this->args,
			[
				'real_home_property_post_elements' => [
					'type'              => 'sortable',
					'default'           => ['address','main','other','gallery','features','floor','video','author'],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
					'label'             => esc_html__( 'Sort Elements', 'real-home' ),
					'description'       => esc_html__( 'To reorder elements drag and drop them.', 'real-home' ),
					'section'           => 'real_home_property_single_post_content_section',
					'priority'          => 5,
					'choices'           => [
						'address'           => esc_html__( 'Address', 'real-home' ),
						'main'              => esc_html__( 'Main Detail', 'real-home' ),
						'other'             => esc_html__( 'Other Detail', 'real-home' ),
						'gallery'           => esc_html__( 'Gallery', 'real-home' ),
						'features'          => esc_html__( 'Features', 'real-home' ),
						'floor'             => esc_html__( 'Floor Plan', 'real-home' ),
						'video'             => esc_html__( 'Video', 'real-home' ),
						'author'            => esc_html__( 'Author Box', 'real-home' )
					],
				],
			]
		);
		// Related Posts
		$this->args = array_merge($this->args,
			[
				// Enable/Disable
				'real_home_property_related_posts_enable' => [
					'type'              => 'toggle',
					'default'           => ['desktop'=>'true'],
					'section'           => 'real_home_property_single_related_posts_section',
					'priority'          => 20,
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
					'label'             => esc_html__( 'Related Posts', 'real-home' ),
				],

				// Number of posts
				'real_home_property_related_posts_limit' => [
					'type'              => 'range',
					'default'           => ['desktop' => 3],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
					'label'             => esc_html__( 'No. of Posts', 'real-home' ),
					'section'           => 'real_home_property_single_related_posts_section',
					'priority'          => 25,
					'units'             => [],
					'input_attrs'       => [
						'min'               => 0,
						'max'               => 20
					]
				],
				// Thumbnail Size
				'real_home_property_related_posts_featured_img_size' => [
					'type'              => 'buttonset',
					'default'           => ['desktop' => 'medium'],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
					'label'             => esc_html__( 'Image Size', 'real-home' ),
					'description'       => esc_html__( 'Set proper size for featured image. Selecting a bigger image size may display a better appearance but takes more time on loading websites.', 'real-home' ),
					'section'           => 'real_home_property_single_related_posts_section',
					'priority'          => 35,
					'choices'           => [
						'thumbnail'         => esc_html__( 'Small', 'real-home' ),
						'medium'            => esc_html__( 'Medium', 'real-home' ),
						'medium_large'      => esc_html__( 'Medium Large', 'real-home' ),
						'large'             => esc_html__( 'Large', 'real-home' )
					],
				],
			]
		);
	}

}
new Real_Home_Customize_Property_Post_Fields();
