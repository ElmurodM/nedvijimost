<?php
/**
 * Real Home Theme Customizer Single Page Element settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Page_Content_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Entry Header
            'real_home_single_page_content_entry_header_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-title'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Header Elements', 'real-home' ),
                'section'           => 'real_home_single_page_content_section',
                'priority'          => 5,
                'choices'           => [
                    'post-title'        => esc_html__( 'Post Title', 'real-home' )
                ]
            ],
            // Page Content
            'real_home_single_page_content_entry_footer_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-comments'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Footer Elements', 'real-home' ),
                'section'           => 'real_home_single_page_content_section',
                'priority'          => 10,
                'choices'           => [
                    'post-comments'     => esc_html__( 'Comments', 'real-home' )
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Single_Page_Content_Fields();
