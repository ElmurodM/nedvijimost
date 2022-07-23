<?php
/**
 * Real Home Theme Customizer Single Page Sidebar settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Single_Page_Sidebar_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Sidebar
            'real_home_single_page_sidebar_layout' => [
                'type'              => 'radio_image',
                'default'           => 'right',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_choices' ],
                'label'             => esc_html__( 'Sidebar', 'real-home' ),
                'description'       => esc_html__( 'Select sidebar layout for single page.', 'real-home' ),
                'section'           => 'real_home_single_page_sidebar_section',
                'priority'          => 15,
                'choices' 			=> array(
                    'left'              => REAL_HOME_THEME_URI . 'assets/images/left.svg',
                    'right'  		    => REAL_HOME_THEME_URI . 'assets/images/right.svg',
                    'none'  		    => REAL_HOME_THEME_URI . 'assets/images/none.svg',
                ),
                'l10n'              => [
                    'left'              => esc_html__( 'Left', 'real-home' ),
                    'right'             => esc_html__( 'Right', 'real-home' ),
                    'none'              => esc_html__( 'None', 'real-home' )
                ]
            ],
        ];
    }

}
new Real_Home_Customize_Single_Page_Sidebar_Fields();
