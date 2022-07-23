<?php
/**
 * Real Home Theme Customizer Footer Sidebar 1 settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Sidebar_1_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Heading One
            'real_home_footer_sidebar_1_widgets_note' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'NOTE', 'real-home' ),
				'description'       => sprintf(__( 'Drag and Drop Widgets to <a data-type="section" data-id="sidebar-widgets-footer-sidebar-1" class="customizer-focus"><strong> Footer Sidebar 1 </strong></a>widget area.', 'real-home' )),
                'section'           => 'footer_sidebar_1',
                'priority'          => 5,
            ]
        ];
    }

}

new Real_Home_Customize_Footer_Sidebar_1_Fields();
