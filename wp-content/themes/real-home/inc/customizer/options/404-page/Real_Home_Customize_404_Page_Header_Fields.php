<?php
/**
 * Real Home Theme Customizer 404 Page Header settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_404_Page_Header_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Page Header
            'real_home_404_page_header_elements' => [
                'type'              => 'sortable',
                'default'           => ['post-title','breadcrumb'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Sort Elements', 'real-home' ),
				'description'       => esc_html__( 'Enable page header elements and order their list with drag and drop.', 'real-home' ),
                'section'           => 'real_home_404_page_header_section',
                'priority'          => 15,
                'choices'           => [
                    'post-title'        => esc_html__( 'Page Title', 'real-home' ),
                    'breadcrumb'        => esc_html__( 'Breadcrumb', 'real-home' )
                ],
            ]
        ];
    }

}
new Real_Home_Customize_404_Page_Header_Fields();
