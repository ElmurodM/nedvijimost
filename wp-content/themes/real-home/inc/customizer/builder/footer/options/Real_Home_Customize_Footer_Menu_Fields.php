<?php
/**
 * Real Home Theme Customizer Footer Menu settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Footer_Menu_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_footer_menu_group_settings' => [
                'type'              => 'group',
                'section'           => 'footer_menu',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_footer_menu_note_one',
                            'real_home_footer_menu_spacing',
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
							'real_home_footer_menu_note_six',
							'real_home_footer_menu_padding',
							'real_home_footer_menu_margin'
                        )
                    )
                ]
            ],
            // Note One
            'real_home_footer_menu_note_one' => [
                'type'              => 'heading',
                'description'       => sprintf(__( 'To set menu, go to <a data-type="section" data-id="menu_locations" class="customizer-focus"><strong>Footer Menu</strong></a>', 'real-home' )),
                'section'           => 'footer_menu',
                'priority'          => 10,
            ],
            // Items Spacing
            'real_home_footer_menu_spacing' => [
                'type'              => 'range',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
                'label'             => esc_html__( 'Menu Spacing', 'real-home' ),
                'description'       => esc_html__( 'Slide to set Menu Spacing.', 'real-home' ),
                'section'           => 'footer_menu',
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'priority'          => 20
            ],
			// Heading four
			'real_home_footer_menu_note_six' => [
				'type'              => 'heading',
				'label'             => esc_html__( 'CONTAINER', 'real-home' ),
				'section'           => 'footer_menu',
				'priority'          => 65,
			],
			// Container Padding
			'real_home_footer_menu_padding' => [
				'type'              => 'dimensions',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
				'label'             => esc_html__( 'Padding', 'real-home' ),
				'description'       => esc_html__( 'Set Padding to the Footer Menu.', 'real-home' ),
				'section'           => 'footer_menu',
				'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
				'priority'          => 70,
			],
			// Container Margin
			'real_home_footer_menu_margin' => [
				'type'              => 'dimensions',
				'default'           => '',
				'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
				'label'             => esc_html__( 'Margin', 'real-home' ),
				'description'       => esc_html__( 'Set Margin to the Footer Menu.', 'real-home' ),
				'section'           => 'footer_menu',
				'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
				'priority'          => 75,
			],
        ];
    }

}
new Real_Home_Customize_Footer_Menu_Fields();
