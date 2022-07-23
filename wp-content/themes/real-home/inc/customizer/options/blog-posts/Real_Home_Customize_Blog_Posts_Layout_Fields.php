<?php
/**
 * Real Home Theme Customizer Blog Posts Layout settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Blog_Posts_Layout_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Posts Elements
            'real_home_blog_posts_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-meta','post-title','post-excerpt'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Content Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable lists for blog post content elements and rearrange the order by drag and drop.', 'real-home' ),
                'section'           => 'real_home_blog_posts_layout_section',
                'priority'          => 10,
                'choices'           => [
                    'post-title'        => esc_html__( 'Post Title', 'real-home' ),
                    'post-meta'         => esc_html__( 'Post Meta', 'real-home' ),
                    'post-excerpt'      => esc_html__( 'Post Excerpt', 'real-home' ),
                    'read-more'         => esc_html__( 'Read More', 'real-home' )
                ],
            ],
			// Meta Elements
			'real_home_blog_posts_meta_elements' => [
				'type'              => 'sortable',
				'default'           => ['categories','author'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Post Meta Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable Post Meta elements and rearrange lists using drag and drop.', 'real-home' ),
				'section'           => 'real_home_blog_posts_layout_section',
				'priority'          => 15,
				'choices'           => [
					'author'            => esc_html__( 'Author', 'real-home' ),
					'categories'        => esc_html__( 'Categories', 'real-home' ),
					'tags'              => esc_html__( 'Tags', 'real-home' )
				],
			]
        ];
    }

}
new Real_Home_Customize_Blog_Posts_Layout_Fields();
