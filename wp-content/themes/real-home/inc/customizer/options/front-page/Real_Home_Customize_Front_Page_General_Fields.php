<?php
/**
 * Real Home Theme Customizer Front Page General settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Front_Page_General_Fields extends Real_Home_Customize_Base_Field {

    /**
     * Arguments for fields.
     *
     * @return void
     */
    public function init() {

        $sortable_list = [
            'why-us'            => esc_html__( 'Why Us?', 'real-home' ),
            'blog'              => esc_html__( 'News & Blog', 'real-home' ),
            'clients'           => esc_html__( 'Clients Logo', 'real-home' )
        ];
        $sortable_default = ['why-us','blog','clients'];
        if ( Real_Home_Helper::crucial_real_state_plugin() ) {
            $sortable_list = array_merge( $sortable_list, [
                'property-types'    => esc_html__( 'Property Types', 'real-home' ),
                'location'          => esc_html__( 'Property Locations', 'real-home' ),
                'featured'          => esc_html__( 'Property Featured', 'real-home' )
            ]);
            $sortable_default = ['featured','why-us','location','property-types','blog','clients'];
        }
        $this->args = [
            // Active Front Page
            'real_home_front_page_enable' => [
                'type'              => 'radio',
                'default'           => 'disable',
                'section'           => 'real_home_front_page_general_section',
                'priority'          => 10,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_choices' ],
                'label'             => esc_html__( 'Front Page', 'real-home' ),
				'description'       => sprintf(__( 'To set <strong>Front Page</strong> enable the option. Else WordPress Static Page will be your <a data-type="section" data-id="static_front_page" class="customizer-focus"><strong> Front Page</strong></a>.', 'real-home' )),
                'choices'           => [
                    'enable'            => esc_html__( 'Enable', 'real-home' ),
                    'disable'           => esc_html__( 'Disable [ use WordPress Static Page ]', 'real-home' )
                ]
            ],
            // Elements
            'real_home_front_page_elements' => [
                'type'              => 'sortable',
                'default'           => $sortable_default,
                'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
                'label'             => esc_html__( 'Sort Elements', 'real-home' ),
                'description'       => esc_html__( 'Enable Page Header Elements and sort them by Drag and Drop.', 'real-home' ),
                'section'           => 'real_home_front_page_general_section',
                'priority'          => 20,
                'choices'           => $sortable_list,
            ],
        ];
    }

}
new Real_Home_Customize_Front_Page_General_Fields();
