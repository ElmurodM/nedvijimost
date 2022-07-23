<?php
/**
 * Real Home Theme Customizer Single Post Element settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Post_Content_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [

            // Entry Header
            'real_home_single_post_content_entry_header_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-cats','post-title'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Header Elements', 'real-home' ),
                'description'       => esc_html__( 'Enable to show Header elements in posts and rearrange them by drag and drop.', 'real-home' ),
                'section'           => 'real_home_single_post_content_section',
                'priority'          => 5,
                'choices'           => [
                    'post-cats'         => esc_html__( 'Categories', 'real-home' ),
                    'post-title'        => esc_html__( 'Post Title', 'real-home' )
                ]
            ],

            // Entry Footer
            'real_home_single_post_content_entry_footer_elements' => [
                'type'              => 'sortable',
                'default'           => ['tags','post-comments','post-navigation'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Footer Elements', 'real-home' ),
                'description'       => esc_html__( 'To display lists of Footer Elements, enable them. And sort them by drag and drop.', 'real-home' ),
                'section'           => 'real_home_single_post_content_section',
                'priority'          => 10,
                'choices'           => [
					'tags'              => esc_html__( 'Tags', 'real-home' ),
                    'post-comments'     => esc_html__( 'Comments', 'real-home' ),
                    'post-navigation'   => esc_html__( 'Post Navigation', 'real-home' ),
                    'author-box'        => esc_html__( 'Author Box', 'real-home' ),
                    'related-posts'     => esc_html__( 'Related Posts', 'real-home' )
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Single_Post_Content_Fields();
