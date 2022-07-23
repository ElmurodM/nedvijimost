<?php
/**
 * Real Home Theme Customizer Front Page Header Banner settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_Banner_Slider_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {
        $this->args = [
            // Enable Header Banner
            'real_home_front_page_banner_slider_enable' => [
                'type'              => 'toggle',
                'default'           => ['desktop'=>true],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_toggle' ],
                'label'             => esc_html__( 'Slider', 'real-home' ),
                'section'           => 'real_home_front_page_banner_section',
                'priority'          => 15,
            ],
            // Number of Slides
            'real_home_front_page_banner_slider_limit' => [
                'type'              => 'range',
                'default'           => ['desktop' => 5 ],
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
                'label'             => esc_html__( 'Slides Limit', 'real-home' ),
                'section'           => 'real_home_front_page_banner_section',
                'priority'          => 25,
                'units'             => [],
                'input_attrs'       => [
                    'min'               => 1,
                    'step'              => 1,
                    'max'               => 20
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Front_Page_Banner_Slider_Fields();
