<?php
/**
 * Real Home Theme Customizer Front Page Blog Posts Sections settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_News_Blog_Fields extends Real_Home_Customize_Base_Field {

    public function init() {
        $this->args = [
			// Grouping Settings
			'real_home_front_page_news_blog_group_settings' => [
				'type'              => 'group',
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 1,
				'choices'           => [
					'normal'            => array(
						'tab-title'     => esc_html__( 'General', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_news_blog_section_heading',
							'real_home_front_page_news_blog_posts_by_cat',
							'real_home_front_page_news_blog_posts_limit',
							'real_home_front_page_news_blog_post_elements'
						)
					),
					'hover'         => array(
						'tab-title'     => esc_html__( 'Style', 'real-home' ),
						'controls'      => array(
							'real_home_front_page_news_blog_heading_one',
							'real_home_front_page_news_blog_section_background',
							'real_home_front_page_news_blog_section_background_overlay'
						)
					)
				]
			],
			// Heading
			'real_home_front_page_news_blog_section_heading' => [
				'type'              => 'text',
				'default'           => esc_html__( 'latest news and blog', 'real-home' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Section Heading', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 5,
			],
			// Post By Category
			'real_home_front_page_news_blog_posts_by_cat' => [
				'type'              => 'select',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_choices' ],
				'label'             => esc_html__( 'Posts by Category', 'real-home' ),
				'description'       => esc_html__( 'Set post query to load with specific category. It will load the latest post by default.', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 10,
				'choices'           => Real_Home_Helper::get_terms('category' ),
			],
			// Number of Slides
			'real_home_front_page_news_blog_posts_limit' => [
				'type'              => 'range',
				'default'           => ['desktop' => 3 ],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
				'label'             => esc_html__( 'Posts Limit', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 10,
				'units'             => [],
				'input_attrs'       => [
					'min'               => 1,
					'step'              => 1,
					'max'               => 20
				]
			],
			// Posts Elements
			'real_home_front_page_news_blog_post_elements' => [
				'type'              => 'sortable',
				'default'           => ['post-meta','post-title','post-excerpt'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable blog post content elements and rearrange the list by drag and drop.', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 10,
				'choices'           => [
					'post-title'        => esc_html__( 'Post Title', 'real-home' ),
					'post-meta'         => esc_html__( 'Categories/Author', 'real-home' ),
					'post-excerpt'      => esc_html__( 'Post Excerpt', 'real-home' )
				],
			],
			// Heading One
			'real_home_front_page_news_blog_heading_one' => [
				'type'              => 'heading',
				'label'             => esc_html__( 'SECTION STYLE', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 5,
			],
			// Background Image
			'real_home_front_page_news_blog_section_background' => [
				'type'              => 'background',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
				'label'             => esc_html__( 'Background Image', 'real-home' ),
				'description'       => esc_html__( 'Set background image for container.', 'real-home' ),
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 5,
				'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
			],
			// Background Overlay
			'real_home_front_page_news_blog_section_background_overlay' => [
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
				'section'           => 'real_home_front_page_news_blog_section',
				'priority'          => 5,
				'inherits'          => [
					'color_1'           => 'var(--color-bg)'
				],
				'fields'            => ['colors' => true],
			],
        ];
    }

}
new Real_Home_Customize_Front_Page_News_Blog_Fields();
