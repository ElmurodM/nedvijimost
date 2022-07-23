<?php
/**
 * Real Home Theme Customizer blog page header settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Blog_Page_Header_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Page Header
            'real_home_blog_page_header_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-title','breadcrumb'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Sort Elements', 'real-home' ),
                'description'       => esc_html__( 'Enable lists of page header elements and rearrange the order by drag and drop.', 'real-home' ),
                'section'           => 'real_home_blog_page_header_section',
                'priority'          => 15,
                'choices'           => [
                    'post-title'        => esc_html__( 'Title', 'real-home' ),
                    'post-desc'         => esc_html__( 'Description', 'real-home' ),
                    'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
                ],
            ]
        ];
    }

}
new Real_Home_Customize_Blog_Page_Header_Fields();
