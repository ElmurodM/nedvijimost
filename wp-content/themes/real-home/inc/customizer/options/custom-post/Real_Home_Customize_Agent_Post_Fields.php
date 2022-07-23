<?php
/**
 * Real Home Theme Customizer Agent Custom Post Type Fields
 *
 * @package Real_Home
 */

class Real_Home_Customize_Agent_Post_Fields extends Real_Home_Customize_Base_Field {

	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		// Page Header
		$this->args = [
			// Page Header
			'real_home_agent_single_post_header_elements' => [
				'type'              => 'sortable',
				'default'           => ['post-title','breadcrumb'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Sort Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable Page Header Elements and manage lists using drag and drop.', 'real-home' ),
				'section'           => 'real_home_agent_single_post_header_section',
				'priority'          => 15,
				'choices'           => [
					'post-title'        => esc_html__( 'Page Title', 'real-home' ),
					'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
				],
			]
		];
		// Post Content
		$this->args = array_merge($this->args,
			[
				// Elements
				'real_home_agent_post_elements' => [
					'type'              => 'sortable',
					'default'           => ['contact-info','content','social','properties'],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
					'label'             => esc_html__( 'Sort Elements', 'real-home' ),
					'description'       => esc_html__( 'To reorder elements drag and drop them.', 'real-home' ),
					'section'           => 'real_home_agent_single_post_content_section',
					'priority'          => 10,
					'choices'           => [
						'contact-info'      => esc_html__( 'Contact Info', 'real-home' ),
						'content'           => esc_html__( 'Content', 'real-home' ),
						'social'            => esc_html__( 'Social Profile', 'real-home' ),
						'properties'        => esc_html__( 'Related Properties', 'real-home' )
					],
				],
			]
		);
		// Related Properties
		$this->args = array_merge($this->args,
			[
				// Number of posts
				'real_home_agent_property_posts_limit' => [
					'type'              => 'range',
					'default'           => ['desktop' => 6],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
					'label'             => esc_html__( 'Posts Per Page', 'real-home' ),
					'section'           => 'real_home_agent_single_related_posts_section',
					'priority'          => 25,
					'units'             => [],
					'input_attrs'       => [
						'min'               => 0,
						'max'               => 20
					]
				],
				// Thumbnail Size
				'real_home_agent_property_posts_featured_img_size' => [
					'type'              => 'buttonset',
					'default'           => ['desktop' => 'medium'],
					'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
					'label'             => esc_html__( 'Image Size', 'real-home' ),
					'description'       => esc_html__( 'Set proper size for featured image. Selecting a bigger image size may display a better appearance but takes more time on loading websites.', 'real-home' ),
					'section'           => 'real_home_agent_single_related_posts_section',
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
new Real_Home_Customize_Agent_Post_Fields();
