<?php
/**
 * Real Home Theme Customizer Front Page Property Featured Sections settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_Property_Features_Fields extends Real_Home_Customize_Base_Field {

    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_front_page_featured_properties_group_settings' => [
                'type'              => 'group',
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_featured_properties_section_heading',
                            'real_home_front_page_featured_properties_limit'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_front_page_featured_properties_sep_one',
                            'real_home_front_page_featured_properties_background',
                            'real_home_front_page_featured_properties_background_overlay'
                        )
                    )
                ]
            ],
            // Heading
            'real_home_front_page_featured_properties_section_heading' => [
                'type'              => 'text',
                'default'           => esc_html__( 'Feature Listings', 'real-home' ),
                'sanitize_callback' => 'sanitize_text_field',
                'label'             => esc_html__( 'Section Heading', 'real-home' ),
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 15,
            ],
            // Number of Slides
            'real_home_front_page_featured_properties_limit' => [
                'type'              => 'range',
                'default'           => ['desktop' => 3 ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
                'label'             => esc_html__( 'Posts Limit', 'real-home' ),
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 25,
                'units'             => [],
                'input_attrs'       => [
                    'min'               => 1,
                    'step'              => 1,
                    'max'               => 20
                ]
            ],
            // Section Separator
            'real_home_front_page_featured_properties_sep_one' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SECTION STYLING', 'real-home' ),
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 30,
            ],
            // Background Image
            'real_home_front_page_featured_properties_background' => [
                'type'              => 'background',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Image', 'real-home' ),
                'description'       => esc_html__( 'Set background image for container.', 'real-home' ),
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 35,
                'fields'            => ['image' => true, 'position' => true, 'attachment' => true, 'repeat' => true, 'size' => true ],
            ],
            // Background Overlay
            'real_home_front_page_featured_properties_background_overlay' => [
                'type'              => 'background',
                'default'           => [
                    'background'        => 'color',
                    'colors'            => [
                        'color_1'           => 'var(--color-bg)'
                    ]
                ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_background' ],
                'label'             => esc_html__( 'Background Overlay', 'real-home' ),
                'description'       => esc_html__( 'Set background overlay color for container.', 'real-home' ),
                'section'           => 'real_home_front_page_property_features_section',
                'priority'          => 36,
                'inherits'          => [
                    'color_1'           => 'var(--color-bg)'
                ],
                'fields'            => ['colors' => true],
            ]
        ];
    }

}
new Real_Home_Customize_Front_Page_Property_Features_Fields();
