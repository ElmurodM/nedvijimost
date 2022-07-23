<?php
/**
 * Real Home Theme Customizer Social settings
 *
 * @package Real_Home
 */

class Real_Home_Customize_Global_Social_Fields extends Real_Home_Customize_Base_Field {

	/**
	 * Arguments for fields.
	 *
	 * @return void
	 */
	public function init() {
		$this->args = [
			// Heading One
			'real_home_social_icon_note' => [
				'type'              => 'heading',
				'label'             => esc_html__( 'SOCIAL ICONS', 'real-home' ),
				'section'           => 'real_home_social_section',
				'priority'          => 5,
			]
		];

		if ( Real_Home_Helper::crucial_real_state_plugin() ) {
			$this->args = array_merge($this->args,
				[
					// Heading One
					'real_home_social_share_note' => [
						'type'              => 'heading',
						'label'             => esc_html__( 'SOCIAL SHARE', 'real-home' ),
						'section'           => 'real_home_social_section',
						'priority'          => 15,
					],
					// Social Network
					'real_home_social_share' => [
						'type'              => 'sortable',
						'default'           => ['facebook','twitter'],
						'sanitize_callback' => ['Real_Home_Customizer_Sanitize_Callback', 'sanitize_sortable' ],
						'description'       => esc_html__( 'Enable Social Share lists and re-arrange them by drag and drop.', 'real-home' ),
						'section'           => 'real_home_social_section',
						'priority'          => 20,
						'choices'           => [
							'facebook'          => esc_html__( 'Facebook', 'real-home' ),
							'twitter'           => esc_html__( 'Twitter', 'real-home' )
						],
					]
				]
			);
		}
	}

}
new Real_Home_Customize_Global_Social_Fields();
