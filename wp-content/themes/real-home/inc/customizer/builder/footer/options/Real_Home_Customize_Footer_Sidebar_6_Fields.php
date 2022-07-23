<?php
/**
 * Real Home Theme Customizer Footer Sidebar 6 settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Sidebar_6_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Heading One
            'real_home_footer_sidebar_6_widgets_note' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'NOTE', 'real-home' ),
				'description'       => sprintf(__( 'Drag and Drop Widgets to <a data-type="section" data-id="sidebar-widgets-footer-sidebar-6" class="customizer-focus"><strong> Footer Sidebar 6 </strong></a>widget area.', 'real-home' )),
                'section'           => 'footer_sidebar_6',
                'priority'          => 5,
            ]
        ];
    }

}

new Real_Home_Customize_Footer_Sidebar_6_Fields();
