<?php
/**
 * Real Home Theme Customizer Front Page Clients Logo Section settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_Clients_Logo_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_front_page_clients_logo_group_settings' => [
                'type'              => 'group',
                'section'           => 'real_home_front_page_clients_section',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_clients_logo_section_heading',
                            'real_home_front_page_clients_logo_lists',
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_clients_logo_section_note_one',
                            'real_home_front_page_clients_logo_section_background',
                            'real_home_front_page_clients_logo_section_background_overlay'

                        )
                    )
                ]
            ],
            // Heading
            'real_home_front_page_clients_logo_section_heading' => [
                'type'              => 'text',
                'default'           => esc_html__( 'our partners', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Section Heading', 'real-home' ),
                'section'           => 'real_home_front_page_clients_section',
                'priority'          => 14,
            ],
            // Note One
            'real_home_front_page_clients_logo_section_note_one' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SECTION STYLING', 'real-home' ),
                'section'           => 'real_home_front_page_clients_section',
                'priority'          => 19,
            ],
            // Background Image
            'real_home_front_page_clients_logo_section_background' => [
                'type'              => 'background',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Image', 'real-home' ),
                'description'       => esc_html__( 'Set Background Image for container.', 'real-home' ),
                'section'           => 'real_home_front_page_clients_section',
                'priority'          => 25,
                'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
            ],
            // Background Overlay
            'real_home_front_page_clients_logo_section_background_overlay' => [
                'type'              => 'background',
                'default'           => [
                    'background'        => 'color',
                    'colors'            => [
                        'color_1'           => 'var(--color-bg-4)'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Overlay', 'real-home' ),
                'description'       => esc_html__( 'Set background overlay color for container.', 'real-home' ),
                'section'           => 'real_home_front_page_clients_section',
                'priority'          => 26,
                'inherits'          => [
                    'color_1'           => 'var(--color-bg-4)'
                ],
                'fields'            => ['colors' => true],
            ]
        ];
    }

}
new Real_Home_Customize_Front_Page_Clients_Logo_Fields();
