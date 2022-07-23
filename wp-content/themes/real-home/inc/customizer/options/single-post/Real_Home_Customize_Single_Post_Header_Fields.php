<?php
/**
 * Real Home Theme Customizer Single Post Header settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Post_Header_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Post Header
            'real_home_single_post_header_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-title','breadcrumb'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Sort Elements', 'real-home' ),
                'description'       => esc_html__( 'Enable lists of page header elements and rearrange the order by drag and drop.', 'real-home' ),
                'section'           => 'real_home_single_post_header_section',
                'priority'          => 15,
                'choices'           => [
                    'post-title'        => esc_html__( 'Post Title', 'real-home' ),
                    'post-meta'         => esc_html__( 'Post Meta', 'real-home' ),
                    'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
                ],
            ],
			// Meta Elements
			'real_home_single_post_meta_elements' => [
				'type'              => 'sortable',
				'default'           => ['author','post-date'],
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
				'label'             => esc_html__( 'Post Meta Elements', 'real-home' ),
				'description'       => esc_html__( 'To display post meta data and rearrange them with drag and drop.', 'real-home' ),
				'section'           => 'real_home_single_post_header_section',
				'priority'          => 15,
				'choices'           => [
					'author'            => esc_html__( 'Author', 'real-home' ),
					'comments'          => esc_html__( 'Comments', 'real-home' ),
					'categories'        => esc_html__( 'Categories', 'real-home' ),
					'tags'              => esc_html__( 'Tags', 'real-home' ),
					'post-date'         => esc_html__( 'Post Date', 'real-home' )
				],
			]
        ];
    }

}
new Real_Home_Customize_Single_Post_Header_Fields();
