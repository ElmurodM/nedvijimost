<?php
/**
 * Real Home Theme Customizer Container Settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Container_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {


        $this->args = [
            // Max Width
            'real_home_container_max_width' => [
                'type'              => 'range',
                'default'           => ['desktop' => '1170px'],
                'section'           => 'real_home_container_section',
                'priority'          => 15,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_range' ],
                'label'             => esc_html__( 'Max Width', 'real-home' ),
                'description'       => esc_html__( 'Set Max width for container. Default value is 1170px.', 'real-home' ),
                'input_attrs'       => [
                    'min'               => 0,
                    'max'               => 2000
                ]
            ]
        ];
    }

}
new Real_Home_Customize_Global_Container_Fields();
