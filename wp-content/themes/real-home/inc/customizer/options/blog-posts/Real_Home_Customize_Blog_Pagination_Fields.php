<?php
/**
 * Real Home Theme Customizer Blog Pagination settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Blog_Pagination_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Pagination Type
            'real_home_blog_pagination_type' => [
                'type'              => 'select',
                'default'           => 'nxt-prv',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_choices' ],
                'label'             => esc_html__( 'Pagination Type', 'real-home' ),
                'section'           => 'real_home_blog_pagination_section',
                'priority'          => 15,
                'choices'           => [
                    'nxt-prv'           => esc_html__( 'Next/Prev', 'real-home' ),
                    'numeric'           => esc_html__( 'Numeric', 'real-home' )
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Blog_Pagination_Fields();
