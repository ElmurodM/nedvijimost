<?php
/**
 * Real Home Theme Customizer Header Site Identify settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Header_Site_Identity_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Grouping Settings
            'real_home_header_site_identity_group_settings' => [
                'type'              => 'group',
                'section'           => 'title_tagline',
                'priority'          => 10,
                'choices'           => [
                    'normal'            => array(
                        'tab-title'     => esc_html__( 'General', 'real-home' ),
                        'controls'      => array(
                            'custom_logo',
							'real_home_header_site_logo_position',
                            'real_home_header_site_title_enable',
                            'blogname',
                            'real_home_header_site_tagline_enable',
                            'blogdescription',
                            'site_icon'
                        )
                    ),
                    'hover'         => array(
                        'tab-title'     => esc_html__( 'Style', 'real-home' ),
                        'controls'      => array(
                            'real_home_header_site_identify_note_two',
                            'real_home_header_site_title_typo',
                            'real_home_header_site_tagline_typo',
                            'real_home_header_site_identify_note_three',
                            'real_home_header_site_identify_padding',
                            'real_home_header_site_identify_margin'
                        )
                    )
                ]
            ],
            // Site title
            'real_home_header_site_title_enable' => [
                'type'              => 'toggle',
                'default'           => ['desktop'=> 'true'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Site Title', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 30
            ],
            // Site tagline
            'real_home_header_site_tagline_enable' => [
                'type'              => 'toggle',
                'default'           => ['desktop'=> 'true'],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Tagline', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 40
            ],
            // Note Two
            'real_home_header_site_identify_note_two' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SITE TITLE & TAGLINE', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 65,
            ],
            // Site Title
            'real_home_header_site_title_typo' => [
                'type'              => 'typography',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_typography' ],
                'label'             => esc_html__( 'Site Title', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 70,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'units'             => [ 'px', 'rem', 'pt', 'em','vw' ],
                'colors'            => [
                    'color_1'           => esc_html__( 'Normal', 'real-home' ),
                    'color_2'           => esc_html__( 'Hover', 'real-home' )
                ],
                'inherits'          => [
                    'color_1'           => 'var(--color-link)',
                    'color_2'           => 'var(--color-link-hover)'
                ],
				'fields'            => ['font_family'=>true,'font_variant'=>true,'font_size'=>true,'letter_spacing'=>true,'colors'=>true]
            ],
            // Site Tagline
            'real_home_header_site_tagline_typo' => [
                'type'              => 'typography',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_typography' ],
                'label'             => esc_html__( 'Tagline', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 75,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
                'units'             => [ 'px', 'rem', 'pt', 'em','vw' ],
                'inherits'          => [
                    'color_1'           => 'var(--color-link)'
                ],
				'fields'            => ['font_size'=>true,'colors'=>true]
            ],
            // Note Three
            'real_home_header_site_identify_note_three' => [
                'type'              => 'heading',
                'label'             => esc_html__( 'SITE IDENTIFY CONTAINER', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 80,
            ],
            // Padding
            'real_home_header_site_identify_padding' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Padding', 'real-home' ),
				'description'       => esc_html__( 'Set container padding.', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 85,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ],
            // Margin
            'real_home_header_site_identify_margin' => [
                'type'              => 'dimensions',
                'default'           => '',
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_dimensions' ],
                'label'             => esc_html__( 'Margin', 'real-home' ),
				'description'       => esc_html__( 'Set container margin.', 'real-home' ),
                'section'           => 'title_tagline',
                'priority'          => 90,
                'responsive'        => [ 'desktop', 'tablet', 'mobile' ],
            ]
        ];
    }

}
new Real_Home_Customize_Header_Site_Identity_Fields();
