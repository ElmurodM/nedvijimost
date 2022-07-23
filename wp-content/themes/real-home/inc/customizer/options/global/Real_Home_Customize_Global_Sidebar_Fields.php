<?php
/**
 * Real Home Theme Customizer Sidebar settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Sidebar_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Sticky Sidebar
            'real_home_sidebar_sticky' => [
                'type'              => 'toggle',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Sticky Sidebar', 'real-home' ),
                'description'       => esc_html__( 'Toggle to enable sticky sidebar. See the effect on content scrolling.', 'real-home' ),
                'section'           => 'real_home_sidebar_section',
                'priority'          => 15,
            ]
        ];
    }

}
new Real_Home_Customize_Global_Sidebar_Fields();
