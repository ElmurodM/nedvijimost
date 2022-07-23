<?php
/**
 * Real Home Theme Customizer Footer Back to Top Button settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Back_To_Top_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Enable
            'real_home_footer_back_to_top_enable' => [
                'type'              => 'toggle',
                'default'           => ['desktop'=>'true'],
                'priority'          => 5,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Scroll to Top', 'real-home' ),
                'description'       => esc_html__( 'Enable button to scroll to top.', 'real-home' ),
                'section'           => 'real_home_footer_builder_back_to_top_section',
            ]
        ];
    }

}
new Real_Home_Customize_Footer_Back_To_Top_Fields();
