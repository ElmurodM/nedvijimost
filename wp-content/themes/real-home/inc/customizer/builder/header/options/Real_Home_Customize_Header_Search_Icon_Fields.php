<?php
/**
 * Real Home Theme Customizer Header Search Icon settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Search_Icon_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_header_search_icon_group_settings' => [
                'type'              => 'group',
                'section'           => 'search_icon',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_search_icon_placeholder'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_search_icon_container_padding',
                            'real_home_header_search_icon_container_margin'
                        )
                    )
                ]
            ],
            // Placeholder
            'real_home_header_search_icon_placeholder' => [
                'type'              => 'text',
                'default'           => esc_html__( 'Search...', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Placeholder', 'real-home' ),
                'description'       => esc_html__( 'Set Search Model with placeholder.', 'real-home' ),
                'section'           => 'search_icon',
                'priority'          => 15,
            ],
            // Padding
            'real_home_header_search_icon_container_padding' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
                'description'       => esc_html__( 'Set search icon container padding.', 'real-home' ),
                'section'           => 'search_icon',
                'priority'          => 31,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_header_search_icon_container_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
                'description'       => esc_html__( 'Set search icon container margin.', 'real-home' ),
                'section'           => 'search_icon',
                'priority'          => 32,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ]
        ];
    }

}
new Real_Home_Customize_Header_Search_Icon_Fields();
