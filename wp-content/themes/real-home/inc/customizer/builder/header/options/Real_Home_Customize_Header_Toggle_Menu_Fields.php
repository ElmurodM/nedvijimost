<?php
/**
 * Real Home Theme Customizer Header Toggle Menu settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Toggle_Menu_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {

        $this->args = [
            // Grouping Settings
            'real_home_header_toggle_menu_group_settings' => [
                'type'              => 'group',
                'section'           => 'toggle_menu',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_toggle_menu_note_one'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_toggle_menu_padding',
                            'real_home_header_toggle_menu_margin'

                        )
                    )
                ]
            ],
            // Note One
            'real_home_header_toggle_menu_note_one' => [
                'type'              => 'heading',
				'description'       => sprintf(__( 'To set menu, go to <a data-type="section" data-id="menu_locations" class="customizer-focus"><strong>Mobile Menu</strong></a>', 'real-home' )),
                'section'           => 'toggle_menu',
                'priority'          => 10,
            ],
            // Container Padding
            'real_home_header_toggle_menu_padding' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set toggle menu container padding.', 'real-home' ),
                'section'           => 'toggle_menu',
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'priority'          => 70,
            ],
            // Container Margin
            'real_home_header_toggle_menu_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set toggle menu container margin.', 'real-home' ),
                'section'           => 'toggle_menu',
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'priority'          => 75,
            ],

        ];
    }

}
new Real_Home_Customize_Header_Toggle_Menu_Fields();
