<?php
/**
 * Real Home Theme Customizer Blog Post Read More settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Blog_Post_Read_More_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Type
            'real_home_blog_post_read_btn_type' => [
                'type'              => 'buttonset',
                'default'           => ['desktop'=>'text'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_buttonset' ],
                'label'             => esc_html__( 'Display as', 'real-home' ),
                'section'           => 'real_home_blog_post_read_more_section',
                'priority'          => 20,
                'choices'           => [
                    'text'              => esc_html__( 'Text', 'real-home' ),
                    'button'            => esc_html__( 'Button', 'real-home' )
                ]
            ],
            // Button Arrow
            'real_home_blog_post_read_more_btn_arrow' => [
                'type'              => 'toggle',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Button Arrow', 'real-home' ),
                'description'       => esc_html__( 'Enable Arrow Icon after Button/Text.', 'real-home' ),
                'section'           => 'real_home_blog_post_read_more_section',
                'priority'          => 25,
            ]
        ];
    }

}
new Real_Home_Customize_Blog_Post_Read_More_Fields();
