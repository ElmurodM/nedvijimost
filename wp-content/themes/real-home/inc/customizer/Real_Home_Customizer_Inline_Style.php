<?php
/**
 * Real Home Customizer Styles
 *
 * @package Real_Home
 */

class Real_Home_Customizer_Inline_Style {

    /**
     * Get CSS Built from Customizer Options.
     *
     * @access static public
     * @param string $type Whether to return CSS for the "front-end", "block-editor" or "classic-editor".
     * @return string
     */
    public static function css_output( $type = 'front-end' ) {

        ob_start();

        // Front-End Styles.
        if ('front-end' === $type) {

            /*--------------------------------------------------------------
            # Root
            --------------------------------------------------------------*/
            // Accent Colors
            self::customizer_inherit_colors(
                'real_home_accent_color',
                null,
                [
                    'color_1'   => '--color-accent',
                    'color_2'   => '--color-accent-secondary'
                ]
            );
            // Heading H1-H6 Colors
            self::customizer_inherit_colors(
                'real_home_heading_color',
                null,
                [
                    'color_1'   => '--color-heading'
                ]
            );
            // Text Colors
            self::customizer_inherit_colors(
                'real_home_text_color',
                null,
                [
                    'color_2'   => '--color-2'
                ]
            );
            // Link Colors
            self::customizer_inherit_colors(
                'real_home_link_color',
                null,
                [
                    'color_1'   => '--color-link',
                    'color_2'   => '--color-link-hover',
                    'color_3'   => '--color-link-visited'
                ]
            );
            // Background Colors
            self::customizer_inherit_colors(
                'real_home_background_color',
                null,
                [
                    'color_1'   => '--color-bg'
                ]
            );

            // Container Width
            self::customizer_inherit_colors(
                'real_home_container_max_width',
                ['desktop' => '1170px'],
                [
                    'desktop'   => '--container-width'
                ]
            );

            /*--------------------------------------------------------------
            # Header Builder -> Top Row
            --------------------------------------------------------------*/
            // Min Height
            self::range(
                ['.site-header .top-header .site-header-row'],
                'real_home_header_top_row_height',
                ['desktop' => '0px'],
                'min-height'
            );
            self::background(
                ['.site-header .top-header::before'],
                'real_home_header_top_row_background_overlay',
                ''
            );
            /*--------------------------------------------------------------
            # Header Builder -> Main Row
            --------------------------------------------------------------*/
            // Min Height
            self::range(
                ['.site-header .main-header .site-header-row'],
                'real_home_header_main_row_height',
                ['desktop' => '80px'],
                'min-height'
            );
            self::background(
                ['.site-header .main-header::before'],
                'real_home_header_main_row_background_overlay'
            );
            /*--------------------------------------------------------------
            # Header Builder -> Bottom Row
            --------------------------------------------------------------*/
            // Min Height
            self::range(
                ['.site-header .bottom-header .site-header-row'],
                'real_home_header_bottom_row_height',
                ['desktop' => '0px'],
                'min-height'
            );
            self::background(
                ['.site-header .bottom-header::before'],
                'real_home_header_bottom_row_background_overlay'
            );
            /*--------------------------------------------------------------
            # Header Builder -> HTML
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-header .header-html-wrap'],
                'real_home_header_html_padding',
                [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_3'            => '10px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Container Margin
            self::dimensions(
                ['.site-header .header-html-wrap'],
                'real_home_header_html_margin',
                '',
                'margin'
            );

            /*--------------------------------------------------------------
            # Header Builder -> Site Identify
            --------------------------------------------------------------*/
            // logo margin
            self::generate_css(
                ['.site-header .site-branding.flex-row .site-logo'],
                ['margin-right'],
                '10px'
            );
            // Logo Width
            self::generate_css(
                ['.site-header .site-branding .site-logo .custom-logo'],
                ['width'],
                '185px'
            );
            // Site Title
            self::typography(
                [
                    '.site-title a',
                    '.site-title>a:hover'],
                'real_home_header_site_title_typo',
                ''
            );
            // Site Tagline
            self::typography(
                ['.site-header .site-branding .site-title-wrap .site-description'],
                'real_home_header_site_tagline_typo',
                ''
            );
            // Site Identify Padding
            self::dimensions(
                ['.site-header .site-branding'],
                'real_home_header_site_identify_padding',
                ''
            );
            // Site Identify Margin
            self::dimensions(
                ['.site-header .site-branding'],
                'real_home_header_site_identify_margin',
                '',
                'margin'
            );
            /*--------------------------------------------------------------
            # Header Builder -> Social Icons
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-header .header-social-wrap'],
                'real_home_header_social_icon_padding',
                ''
            );
            // Container Margin
            self::dimensions(
                ['.site-header .header-social-wrap'],
                'real_home_header_social_icon_margin',
                '',
                'margin'
            );
            // Icon color
            self::generate_css(
                ['.site-header .header-social-wrap li:hover a'],
                ['color'],
                'var(--color-5)'
            );
            // Item Background color
            self::color(
                ['.site-header .header-social-wrap li a','.site-header .header-social-wrap li:hover a'],
                'real_home_header_social_icon_item_background',
                [
                    'color_1' => 'var(--color-bg-4)',
                    'color_2' => 'var(--color-bg-3)'
                ],
                'background-color'
            );
			// Item Border
			self::border(
				['.site-header .header-social-wrap li a'],
				'real_home_header_social_icon_item_border',
				[
					'width'           => [
						'side_1'            => '1px',
						'side_2'            => '1px',
						'side_3'            => '1px',
						'side_4'            => '1px',
						'linked'            => 'off'
					]
				]
			);
            // Item Padding
            self::dimensions(
                ['.site-header .header-social-wrap li a'],
                'real_home_header_social_icon_item_padding',
                [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_2'            => '15px',
                        'side_3'            => '10px',
                        'side_4'            => '15px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Item Margin
            self::dimensions(
                ['.site-header .header-social-wrap li a'],
                'real_home_header_social_icon_item_margin',
                [
                    'desktop'           => [
                        'side_1'            => '0px',
                        'side_2'            => '0px',
                        'side_3'            => '0px',
                        'side_4'            => '0px',
                        'linked'            => 'on'
                    ]
                ],
                'margin'
            );

            /*--------------------------------------------------------------
            # Header Builder -> Primary Menu
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-header .primary-navbar'],
                'real_home_header_primary_menu_padding',
                ''
            );
            // Container Margin
            self::dimensions(
                ['.site-header .primary-navbar'],
                'real_home_header_primary_menu_margin',
                '',
                'margin'
            );
            // Parent Menu Spacing
            $primary_menu_spacing = get_theme_mod('real_home_header_primary_parent_menu_spacing','');
            if ( $primary_menu_spacing && ( $primary_menu_spacing['desktop'] == '0px' ) ) {
                self::generate_css(
                    ['.site-header .primary-navbar .main-navigation div>ul>li'],
                    ['margin'],
                    '0 -3px'
                );
            }
            else {
                self::range(
                    ['.site-header .primary-navbar .main-navigation div>ul>li'],
                    'real_home_header_primary_parent_menu_spacing',
                    '',
                    'margin-left'
                );
            }

            /*--------------------------------------------------------------
           # Header Builder -> Toggle Menu
           --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-header .header-toggle-menu-wrap'],
                'real_home_header_toggle_menu_padding',
                '',
                'padding'
            );
            // Container Padding
            self::dimensions(
                ['.site-header .header-toggle-menu-wrap'],
                'real_home_header_toggle_menu_margin',
                '',
                'margin'
            );
            /*--------------------------------------------------------------
            # Header Builder -> Button
            --------------------------------------------------------------*/
            // Icon color
            self::generate_css(
                ['.site-header .header-button-wrap a:hover'],
                ['color'],
                'var(--color-5)'
            );
            // Background color
            self::generate_css(
                ['.site-header .header-button-wrap a:hover'],
                ['background-color'],
                'var(--color-bg-3)'
            );
            self::border(
                ['.site-header .header-button-wrap a'],
                'real_home_header_button_border',
                [
                    'width'           => [
                        'side_1'            => '1px',
                        'side_2'            => '1px',
                        'side_3'            => '1px',
                        'side_4'            => '1px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Padding
            self::dimensions(
                ['.site-header .header-button-wrap a'],
                'real_home_header_button_padding',
                [
                    'desktop'           => [
                        'side_1'            => '12px',
                        'side_2'            => '18px',
                        'side_3'            => '12px',
                        'side_4'            => '18px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Margin
            self::dimensions(
                ['.site-header .header-button-wrap a'],
                'real_home_header_button_margin',
                '',
                'margin'
            );

            /*--------------------------------------------------------------
            # Header Builder -> Account
            --------------------------------------------------------------*/
            // Icon text color
            self::generate_css(
                ['.site-header .header-account-wrap a:hover'],
                ['color'],
                'var(--color-5)'
            );
            // Background color
            self::generate_css(
                ['.site-header .header-account-wrap a:hover'],
                ['background-color'],
                'var(--color-bg-3)'
            );
            self::border(
                ['.site-header .header-account-wrap a'],
                'real_home_header_account_border',
                [
                    'width'           => [
                        'side_1'            => '1px',
                        'side_2'            => '1px',
                        'side_3'            => '1px',
                        'side_4'            => '1px',
                        'linked'            => 'on'
                    ]
                ]
            );
            // Padding
            self::dimensions(
                ['.site-header .header-account-wrap a'],
                'real_home_header_account_padding',
                [
                    'desktop'           => [
                        'side_1'            => '12px',
                        'side_2'            => '18px',
                        'side_3'            => '12px',
                        'side_4'            => '18px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Margin
            self::dimensions(
                ['.site-header .header-account-wrap a'],
                'real_home_header_account_margin',
                '',
                'margin'
            );
            /*--------------------------------------------------------------
            # Header Builder -> Menu Trigger
            --------------------------------------------------------------*/
            // Icon Text Gap
            self::range(
                ['.site-header .header-menu-trigger-wrap a.flex-row-reverse .icon'],
                'real_home_header_menu_trigger_icon_text_gap',
                '',
                'padding-left'
            );
            self::range(
                ['.site-header .header-menu-trigger-wrap a.flex-row .icon'],
                'real_home_header_menu_trigger_icon_text_gap',
                '',
                'padding-right'
            );
            // Icon Size
            self::range(
                ['.site-header .header-menu-trigger-wrap a .icon'],
                'real_home_header_menu_trigger_icon_size',
                '',
                'font-size'
            );
            // Text Size
            self::range(
                ['.site-header .header-menu-trigger-wrap a label'],
                'real_home_header_menu_trigger_text_size',
                '',
                'font-size'
            );
            // Icon color
            self::color(
                ['.site-header .header-menu-trigger-wrap a','.site-header .header-menu-trigger-wrap a:hover'],
                'real_home_header_menu_trigger_color'
            );
            // Background color
            self::color(
                ['.site-header .header-menu-trigger-wrap a','.site-header .header-menu-trigger-wrap a:hover'],
                'real_home_header_menu_trigger_background',
                '',
                'background-color'
            );
//            // Border
            self::border(
                ['.site-header .header-menu-trigger-wrap a'],
                'real_home_header_menu_trigger_border',
                ''
            );
            // box shadow
            self::box_shadow(
                ['.site-header .header-menu-trigger-wrap a'],
                'real_home_header_menu_trigger_box_shadow',
                ''
            );
            // Padding
            self::dimensions(
                ['.site-header .header-menu-trigger-wrap a'],
                'real_home_header_menu_trigger_padding',
                ''
            );
            // Margin
            self::dimensions(
                ['.site-header .header-menu-trigger-wrap a'],
                'real_home_header_menu_trigger_margin',
                '',
                'margin'
            );

            /*--------------------------------------------------------------
            # Header Builder -> Search Icon
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-header .header-search-icon-wrap'],
                'real_home_header_search_icon_container_padding',
                ''
            );
            // Container Margin
            self::dimensions(
                ['.site-header .header-search-icon-wrap'],
                'real_home_header_search_icon_container_margin',
                '',
                'margin'
            );
            // Padding
            self::dimensions(
                ['.site-header .header-search-icon-wrap .search-toggle'],
                'real_home_header_search_icon_padding',
                [
                    'desktop'           => [
                        'side_1'            => '12px',
                        'side_2'            => '18px',
                        'side_3'            => '12px',
                        'side_4'            => '18px',
                        'linked'            => 'off'
                    ]
                ]
            );
            /*--------------------------------------------------------------
            # Global -> Body
            --------------------------------------------------------------*/
            self::background( ['body'], 'real_home_body_background' );

            /*--------------------------------------------------------------
            # Global -> Typography
            --------------------------------------------------------------*/
            // Base
            self::typography(
                ['body'],
                'real_home_base_typography',
                ''
            );
            /*--------------------------------------------------------------
            # Global -> Featured Image Color
            --------------------------------------------------------------*/
            // Background Overlay Color
            self::color(
                ['.featured-image,.featured-image a::before'],
                'real_home_placeholder_color',
                ['color_1' => '#dbdcdf'],
                'background-color'
            );

            /*--------------------------------------------------------------
            # Global -> Page Header
            --------------------------------------------------------------*/
            // Container Background Image
            self::background(
                ['.page-title-wrap'],
                'real_home_page_header_background',
                ''
            );
            // Container Background Overlay
            self::background(
                ['.page-title-wrap::before'],
                'real_home_page_header_background_overlay',
                ''
            );
            // Item Gap
            self::generate_css(
                ['.site-header .page-title-wrap .text-left .breadcrumbs ul li,.site-header .page-title-wrap .text-center .breadcrumbs ul li'],
                ['margin-right'],
                '20px'
            );
			self::generate_css(
				['.site-header .page-title-wrap .text-left .breadcrumbs ul li,.site-header .page-title-wrap .text-center .breadcrumbs ul li'],
				['margin-right'],
				'25px',
				'',
				'',
				'@media only screen and (min-width: 720px)'
			);
			self::generate_css(
				['.site-header .page-title-wrap .text-left .breadcrumbs ul li,.site-header .page-title-wrap .text-center .breadcrumbs ul li'],
				['margin-right'],
				'30px',
				'',
				'',
				'@media only screen and (min-width: 1024px)'
			);

            // Item Separator Spacing
            self::generate_css(
                ['.site-header .page-title-wrap .container>.breadcrumbs ul li::before'],
                ['right'],
                '12px',
                '-'
            );
            self::generate_css(
                ['.site-header .page-title-wrap .container>.breadcrumbs ul li::before'],
                ['right'],
                '15px',
                '-',
                '',
                '@media only screen and (min-width: 720px)'
            );
            self::generate_css(
                ['.site-header .page-title-wrap .container>.breadcrumbs ul li::before'],
                ['right'],
                '19px',
                '-',
                '',
                '@media only screen and (min-width: 1024px)'
            );
            // Post meta
            // Bottom Spacing
            self::range(
                ['.site-header .page-title-wrap .container>.header-post-meta'],
                'real_home_page_header_post_meta_spacing',
                [
                    'desktop'           => '10px'
                ],
                'margin-bottom'
            );
            // Is Home Page or archive page or search page
            if ( is_home() || is_archive() || is_search() || is_404() ) {

                /*--------------------------------------------------------------
                # Post Content
                --------------------------------------------------------------*/
                // Read More button icon gap
                self::generate_css(
                    ['.real-home-blog #primary .post .post-detail-wrap .read-more-wrap a .icon'],
                    ['margin-left'],
                    '10px'
                );
                /*--------------------------------------------------------------
                # Pagination
                --------------------------------------------------------------*/
                // is archive type property
                if ( is_post_type_archive( 'property' ) || taxonomy_exists( 'property-type' ) || taxonomy_exists( 'property-location' ) || taxonomy_exists( 'property-status' ) ) {
                    self::generate_css(
                        ['.post-type-archive-property .site-header .page-title-wrap .archive-description'],
                        ['display'],
                        'none'
                    );
                }

                // is archive type agent
                if ( is_post_type_archive( 'agent' ) ) {
                    self::generate_css(
                        ['.post-type-archive-agent .site-header .page-title-wrap .archive-description'],
                        ['display'],
                        'none'
                    );
                }
            }

            // Is Single Post
            if ( 'post' == get_post_type() ) {

                /*--------------------------------------------------------------
                # Post Content
                --------------------------------------------------------------*/
                // Background Color
                self::color(
                    ['.single .single-post-wrapper .post .post-navigation .nav-links a','.single .single-post-wrapper .post .post-navigation .nav-links a::before,.single .single-post-wrapper .post .post-navigation .nav-links a:hover'],
                    'real_home_single_post_navigation_background',
                    [
                        'color_1'           => '#F8F5FC',
                        'color_2'           => 'var(--color-bg-2)'
                    ],
                    'background-color'
                );
            }

            // Is 404 Page
            if ( is_404() ) {

                /*--------------------------------------------------------------
                # Page Content
                --------------------------------------------------------------*/
                // Image Height
                self::generate_css(
                    ['.error404 .error-404 .error-page-content figure img'],
                    ['height'],
                    '150px'
                );
                // Spacing
                self::generate_css(
                    ['.error404 .error-404 .error-page-content figure'],
                    ['margin-bottom'],
                    '15px'
                );
                self::generate_css(
                    ['.error404 .error-404 .error-page-content a.home-button'],
                    ['margin-bottom'],
                    '15px'
                );
                self::generate_css(
                    ['.error404 .error-404 .error-page-content form.search-form'],
                    ['margin-bottom'],
                    '15px'
                );
				// Background
				self::background(
					['.error404 .error-404.not-found'],
					'real_home_404_error_background'
				);
            }

            // Is Static Front Page Enable
            if ( Real_Home_Helper::front_page_enable() ) {

                // Featured Properties
                // background
                self::background(
                    ['.real-home-front-page .featured-properties-section'],
                    'real_home_front_page_featured_properties_background',
                    ''
                );
                // background
                self::background(
                    ['.real-home-front-page .featured-properties-section::before'],
                    'real_home_front_page_featured_properties_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg)'
                        ]
                    ]
                );
                // Front page : Why Us?
                // Background
                self::background(
                    ['.real-home-front-page .why-choose-us-section'],
                    'real_home_front_page_services_background',
                    ''
                );
                // Background Overlay
                self::background(
                    ['.real-home-front-page .why-choose-us-section::before'],
                    'real_home_front_page_services_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg)'
                        ]
                    ]
                );
                // Background
                self::background(
                    ['.site-content section.partner-section'],
                    'real_home_front_page_clients_logo_section_background',
                    ''
                );
                // Background
                self::background(
                    ['.site-content section.partner-section::before'],
                    'real_home_front_page_clients_logo_section_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg-4)'
                        ]
                    ]
                );
                // Front page : Property Locations
                // Background
                self::background(
                    ['.site-content section.property-location-section'],
                    'real_home_front_page_property_locations_background',
                    ''
                );
                // Background Overlay
                self::background(
                    ['.site-content section.property-location-section::before'],
                    'real_home_front_page_property_locations_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg-4)'
                        ]
                    ]
                );
                // Front page : Property Types
                // Background
                self::background(
                    ['.site-content section.buy-rent-section'],
                    'real_home_front_page_property_type_background',
                    ''
                );
                // Background Overlay
                self::background(
                    ['.site-content section.buy-rent-section::before'],
                    'real_home_front_page_property_type_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg)'
                        ]
                    ]
                );
                // Front page : News & Blog
                // Background
                self::background(
                    ['.real-home-front-page .latest-news-section'],
                    'real_home_front_page_news_blog_section_background',
                    ''
                );
                // Background
                self::background(
                    ['.real-home-front-page .latest-news-section::before'],
                    'real_home_front_page_news_blog_section_background_overlay',
                    [
                        'background'        => 'color',
                        'colors'            => [
                            'color_1'           => 'var(--color-bg)'
                        ]
                    ]
                );
                /*--------------------------------------------------------------
                # Post Content
                --------------------------------------------------------------*/
                // Read More button icon gap
                self::generate_css(
                    ['.real-home-front-page #page .latest-news-section .post .post-detail-wrap .read-more-wrap a .icon'],
                    ['margin-left'],
                    '10px'
                );
            }
            // Sidebar
            if ( is_active_sidebar( 'sidebar-1' ) && Real_Home_Helper::get_sidebar_layout() ) {

                /*--------------------------------------------------------------
                # Sidebar Container
                --------------------------------------------------------------*/
                // Sidebar Width
                self::generate_css(
                    ['.have-sidebar #secondary'],
                    ['width'],
                    '380px',
                    '',
                    '',
                    '@media only screen and (min-width: 1024px)'
                );
                self::generate_css(
                    ['.have-sidebar #primary'],
                    ['width'],
                    '380px',
                    'calc(100% - ',
                    ')',
                    '@media only screen and (min-width: 1024px)'
                );
                // Sidebar Gap
                if ( Real_Home_Helper::get_sidebar_layout() == 'right' ) {
                    self::generate_css(
                        ['.have-sidebar #secondary.right-sidebar'],
                        ['padding-left'],
                        '25px',
                        '',
                        '',
                        '@media only screen and (min-width: 1024px)'
                    );
                    self::generate_css(
                        ['.have-sidebar #primary.content-area'],
                        ['padding-right'],
                        '25px',
                        '',
                        '',
                        '@media only screen and (min-width: 1024px)'
                    );

                }
                elseif ( Real_Home_Helper::get_sidebar_layout() == 'left' ) {
                    self::generate_css(
                        ['.have-sidebar #secondary.left-sidebar'],
                        ['padding-right'],
                        '25px',
                        '',
                        '',
                        '@media only screen and (min-width: 1024px)'
                    );
                    self::generate_css(
                        ['.have-sidebar #primary.content-area'],
                        ['padding-left'],
                        '25px',
                        '',
                        '',
                        '@media only screen and (min-width: 1024px)'
                    );
                }
            }
            /*--------------------------------------------------------------
            # Footer Builder -> Top Row
            --------------------------------------------------------------*/
			// Background
			self::background(
				['.site-footer .top-footer'],
				'real_home_footer_top_row_background',
				''
			);
            self::background(
                ['.site-footer .top-footer::before'],
                'real_home_footer_top_row_background_overlay',
               ''
            );
            // Padding
            self::dimensions(
                ['.site-footer .top-footer .container>.row.columns'],
                'real_home_footer_top_row_padding',
                [
                    'desktop'           => [
                        'side_1'            => '25px',
                        'side_3'            => '25px',
                        'linked'            => 'off'
                    ]
                ]
            );
            /*--------------------------------------------------------------
            # Footer Builder -> Main Row
            --------------------------------------------------------------*/
			// Background
			self::background(
				['.site-footer .main-footer'],
				'real_home_footer_main_row_background'
			);
            self::background(
                ['.site-footer .main-footer::before'],
                'real_home_footer_main_row_background_overlay',
                [
                    'background'        => 'color',
                    'colors'            => [
                        'color_1'           => 'rgba(0,0,0,0.22)'
                    ]
                ]
            );
            // Padding
            self::dimensions(
                ['.site-footer .main-footer .container>.row.columns'],
                'real_home_footer_main_row_padding',
                [
                    'desktop'           => [
                        'side_1'            => '25px',
                        'side_3'            => '25px',
                        'linked'            => 'off'
                    ]
                ]
            );
            /*--------------------------------------------------------------
            # Footer Builder -> Bottom Row
            --------------------------------------------------------------*/
            self::background(
                ['.site-footer .bottom-footer::before'],
                'real_home_footer_bottom_row_background_overlay',
				[
					'background'        => 'color',
					'colors'            => [
						'color_1'           => 'var(--color-bg-3)'
					]
				]
            );
            // Padding
            self::dimensions(
                ['.site-footer .bottom-footer .container>.row.columns'],
                'real_home_footer_bottom_row_padding',
                ''
            );
            /*--------------------------------------------------------------
            # Footer Builder -> Footer HTML
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-footer .footer-html-wrap'],
                'real_home_footer_html_padding',
                [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_3'            => '10px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Container Margin
            self::dimensions(
                ['.site-footer .footer-html-wrap'],
                'real_home_footer_html_margin',
                '',
                'margin'
            );

            /*--------------------------------------------------------------
            # Footer Builder -> Footer Menu
            --------------------------------------------------------------*/
            // Container Padding
            self::dimensions(
                ['.site-footer .footer-navbar'],
                'real_home_footer_menu_padding',
                ''
            );
            // Container Margin
            self::dimensions(
                ['.site-footer .footer-navbar'],
                'real_home_footer_menu_margin',
                '',
                'margin'
            );
            // Menu Item Spacing
            $footer_menu_spacing = get_theme_mod('real_home_footer_menu_spacing','');
            if ( $footer_menu_spacing && ( $footer_menu_spacing['desktop'] == '0px' ) ) {
                self::generate_css(
                    ['.site-footer .footer-navbar .main-navigation div>ul>li'],
                    ['margin'],
                    '0 -3px'
                );
            }
            else {
                self::range(
                    ['.site-footer .footer-navbar .main-navigation div>ul>li'],
                    'real_home_footer_menu_spacing',
                    '',
                    'margin-left'
                );
            }

            /*--------------------------------------------------------------
            # Footer Builder -> Button
            --------------------------------------------------------------*/
			// Icon color
			self::generate_css(
				['.site-footer .footer-button-wrap a:hover'],
				['color'],
				'var(--color-5)'
			);
			// Background color
			self::generate_css(
				['.site-footer .footer-button-wrap a:hover'],
				['background-color'],
				'var(--color-bg-3)'
			);
            // Border
            self::border(
                ['.site-footer .footer-button-wrap a'],
                'real_home_footer_button_border',
                [
                    'width'           => [
                        'side_1'            => '1px',
                        'side_2'            => '1px',
                        'side_3'            => '1px',
                        'side_4'            => '1px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Padding
            self::dimensions(
                ['.site-footer .footer-button-wrap a'],
                'real_home_footer_button_padding',
                [
                    'desktop'           => [
                        'side_1'            => '7px',
                        'side_2'            => '15px',
                        'side_3'            => '7px',
                        'side_4'            => '15px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Margin
            self::dimensions(
                ['.site-footer .footer-button-wrap a'],
                'real_home_footer_button_margin',
                [
                    'desktop'           => [
                        'side_1'            => '5px',
                        'side_2'            => '5px',
                        'side_3'            => '5px',
                        'side_4'            => '5px',
                        'linked'            => 'on'
                    ]
                ],
                'margin'
            );

            /*--------------------------------------------------------------
            # Footer Builder -> Copyright Text
            --------------------------------------------------------------*/
            // Text color
            self::generate_css(
                ['.site-footer .site-info'],
                ['color'],
                'var(--color-2)'
            );
            // link color
            self::color(
                ['.site-footer .site-info a','.site-footer .site-info a:hover'],
                'real_home_footer_copyright_link_color',
                [
                    'color_1'           => 'var(--color-2)',
                    'color_2'           => 'var(--color-5)'
                ]
            );

            // Padding
            self::dimensions(
                ['.site-footer .site-info'],
                'real_home_footer_copyright_padding',
                [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_3'            => '10px',
                        'linked'            => 'off'
                    ]
                ],
                'padding'
            );
            // Margin
            self::dimensions(
                ['.site-footer .site-info'],
                'real_home_footer_copyright_margin',
                '',
                'margin'
            );

            /*--------------------------------------------------------------
            # Footer Builder -> Social Icons
            --------------------------------------------------------------*/
            // Icon Size
            self::generate_css(
                ['.site-footer .footer-social-wrap li a .icon'],
                ['font-size'],
                '18px'
            );
            // Container Padding
            self::dimensions(
                ['.site-footer .footer-social-wrap'],
                'real_home_footer_social_icon_padding',
                ''
            );
            // Container Margin
            self::dimensions(
                ['.site-footer .footer-social-wrap'],
                'real_home_footer_social_icon_margin',
                '',
                'margin'
            );
			// Icon color
			self::generate_css(
				['.site-footer .footer-social-wrap li:hover a'],
				['color'],
				'var(--color-5)'
			);
            // Item Background color
            self::color(
                ['.site-footer .footer-social-wrap li','.site-footer .footer-social-wrap li:hover'],
                'real_home_footer_social_icon_item_background',
                [
                    'color_2'           => 'var(--color-bg-2)'
                ],
                'background-color'
            );
			// Item Border
			self::border(
				['.site-footer .footer-social-wrap li'],
				'real_home_footer_social_icon_item_border',
				[
					'width'           => [
						'side_1'            => '0px',
						'side_2'            => '0px',
						'side_3'            => '0px',
						'side_4'            => '0px',
						'linked'            => 'on'
					]
				]
			);
            // Item Padding
            self::dimensions(
                ['.site-footer .footer-social-wrap li'],
                'real_home_footer_social_icon_item_padding',
                [
                    'desktop'           => [
                        'side_1'            => '10px',
                        'side_2'            => '15px',
                        'side_3'            => '10px',
                        'side_4'            => '15px',
                        'linked'            => 'off'
                    ]
                ]
            );
            // Item Margin
            self::dimensions(
                ['.site-footer .footer-social-wrap li'],
                'real_home_footer_social_icon_item_margin',
                [
                    'desktop'           => [
                        'side_1'            => '0px',
                        'side_2'            => '0px',
                        'side_3'            => '0px',
                        'side_4'            => '0px',
                        'linked'            => 'on'
                    ]
                ],
                'margin'
            );
        }

        // Customizer Styles.
        if ('customizer' === $type) {

            /*--------------------------------------------------------------
            # Root
            --------------------------------------------------------------*/
            // Accent Colors
            self::customizer_inherit_colors(
                'real_home_accent_color',
                null,
                [
                    'color_1'   => '--color-accent',
                    'color_2'   => '--color-accent-secondary'
                ]
            );
            // Heading H1-H6 Colors
            self::customizer_inherit_colors(
                'real_home_heading_color',
                null,
                [
                    'color_1'   => '--color-heading'
                ]
            );
            // Text Colors
            self::customizer_inherit_colors(
                'real_home_text_color',
                null,
                [
                    'color_2'   => '--color-2'
                ]
            );
            // Link Colors
            self::customizer_inherit_colors(
                'real_home_link_color',
                null,
                [
                    'color_1'   => '--color-link',
                    'color_2'   => '--color-link-hover',
                    'color_3'   => '--color-link-visited'
                ]
            );
            // Background Colors
            self::customizer_inherit_colors(
                'real_home_background_color',
                null,
                [
                    'color_1'   => '--color-bg'
                ]
            );
        }

        // Return the results.
        return ob_get_clean();

    }

	/**
	 * Inherit Color for the root
	 *
	 * @access static public
	 * @param string $setting
	 * @param null $default
	 * @param array $inheritColors
	 * @return void echo style
	 */
	public static function customizer_inherit_colors( $setting, $default = null, $inheritColors = [] ) {

		$values = get_theme_mod( $setting, $default );
		$output = '';
		if ( $values && $values != $default ) {

			foreach ( $values as $index => $val ) {

				if ( isset( $inheritColors[$index] ) ) {
					$output .= $inheritColors[$index] . ':' . esc_attr( $val ) . ';';
				}
			}
		}

		// Output
		$output = ( $output != '' ) ? ':root{ ' . $output . ' }' : '';

		echo $output; // // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Background control value output
	 *
	 * @access static public
	 * @param array $selectors
	 * @param string $setting
	 * @param null $default
	 * @return void echo style
	 */
	public static function background( $selectors, $setting, $default = null ) {

		$values = get_theme_mod( $setting, $default );
		$output = '';

		if ( $values ) {

			// Execute only sectors is array type
			if ( is_array( $selectors ) ) {

				$display_type = isset( $values['background'] )
					? $values['background']
					: ( isset( $values['image'] ) ? 'image' : 'color' );

				foreach ( $selectors as $s_index => $selector ) { $s_index++;

					// for color
					if ( $display_type == 'color' && isset( $values['colors'] ) ) {

						$output .= isset( $values['colors']['color_'.$s_index] ) ? $selector . '{ background-color:' . esc_attr( $values['colors']['color_'.$s_index] ) . ';}' : '' ;
					}
					// for gradient
					elseif ( $display_type == 'gradient' && isset( $values['gradient'] ) ) {

						$output .= $selector . '{';

						$output .= 'background:';
						$output .= isset( $values['gradient']['color_'.$s_index] ) ? esc_attr( $values['gradient']['color_'.$s_index] ) : '' ;
						$output .= ';';

						$output .= 'background:-webkit-linear-gradient(to right,';
						$output .= isset( $values['gradient']['color_1'] ) ? esc_attr( $values['gradient']['color_1'] ) . ', ' : '' ;
						$output .= isset( $values['gradient']['color_2'] ) ? esc_attr( $values['gradient']['color_2'] ) : '' ;
						$output .= ');';

						$output .= 'background:linear-gradient(to right,';
						$output .= isset( $values['gradient']['color_1'] ) ? esc_attr( $values['gradient']['color_1'] ) . ', ' : '' ;
						$output .= isset( $values['gradient']['color_2'] ) ? esc_attr( $values['gradient']['color_2'] ) : '' ;
						$output .= ');';

						$output .= '}';
					}
					// for image
					elseif ( $display_type == 'image' && isset( $values['image'] ) ) {
						$output .= $selector . '{ background-image:url("' .esc_url( $values['image'] ). '");';
						$output .= isset( $values['position'] ) ? 'background-position:'. esc_attr( $values['position'] ) .';' : '';
						$output .= isset( $values['size'] ) ? 'background-size:'. esc_attr( $values['size'] ) .';' : '';
						$output .= isset( $values['repeat'] ) ? 'background-repeat:'. esc_attr( $values['repeat'] ) .';' : '';
						$output .= isset( $values['attachment'] ) ? 'background-attachment:'. esc_attr( $values['attachment'] ) .';' : '';
						$output .= '}';
					}
				}
			}
		}

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Border control value output
	 *
	 * @access static public
	 * @param array $selectors
	 * @param string $setting
	 * @param null $default
	 * @return void echo style
	 */
	public static function border( $selectors, $setting, $default = null ) {

		$values = get_theme_mod( $setting, $default );
		$output = '';
		$properties = '';

		if ( $values ) {

			// border radius
			$properties .= isset( $values['radius'] ) ? 'border-radius: ' . esc_attr( $values['radius'] ) . ';' : '';

			// execute if linked is "on"
			if ( isset( $values['width'] ) && ( count( $values['width'] ) > 4 ) && $values['width']['linked'] == 'on' ) {

				$properties .= isset( $values['style'] ) && (isset($values['colors']) && !empty($values['colors']) )  ? 'border: ' : 'border-width: ';
				// width
				$width = '';
				foreach ( [ 'side_1', 'side_2', 'side_3', 'side_4' ] as $side ) {
					if ( isset( $values['width'] ) && isset( $values['width'][$side] ) ) {
						$width .= esc_attr( $values['width'][$side] ) . ' ';
						break;
					}
				}

				// Width
				$properties .= esc_attr( $width ) . ' ';

				// style
				$properties .= isset( $values['style'] ) ? esc_attr( $values['style'] ) . ' ' : '';

				$properties .= ';';

			}
			// Execute if linked is "off"
			else {

				// border width
				$widths = '';
				foreach ( [ 'top', 'right', 'bottom', 'left' ] as $index => $key ) { $index++;
					$widths .= isset( $values['width'] ) && isset( $values['width']['side_'.$index] ) ? 'border-' . $key . '-width: ' . esc_attr( $values['width']['side_'.$index] ) . ';' : '';
				}
				$properties .= ( $widths != '' ) ? 'border-width: 0;' : '';
				$properties .= esc_attr( $widths );
				// border style
				$properties .= isset( $values['style'] ) ? 'border-style: ' . esc_attr( $values['style'] ) . ';' : '';
			}

			// Execute only sectors is array type
			if ( is_array( $selectors ) ) {
				foreach ( $selectors as $s_index => $selector ) { $s_index++;
					$border_color = isset( $values['colors'] ) && isset( $values['colors']['color_'.$s_index] ) ? 'border-color: ' . esc_attr( $values['colors']['color_'.$s_index] ) . ';' : '';
					$output .= $selector . '{' . $properties . $border_color .'}';
				}
			}

		}

		// output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Box Shadow control value output
	 *
	 * @access static public
	 * @param array $selectors
	 * @param string $setting
	 * @param null $default
	 * @return void echo style
	 */
	public static function box_shadow( $selectors, $setting, $default = null ) {

		$values = get_theme_mod( $setting, $default );
		$output = '';
		$properties = '';

		if ( $values ) {

			// Execute only if blur value is set and value > 0
			if ( isset( $values['blur'] ) ) {

				// Inset
				$properties .= isset( $values['inset'] ) ? 'inset ' : '';

				// Horizontal Length
				$properties .= isset( $values['h_length'] ) && floatval($values['h_length'] ) != 0 ? esc_attr( $values['h_length'] ) . ' ' : '0 ';

				// Vertical Length
				$properties .= isset( $values['v_length'] ) && floatval($values['v_length'] ) != 0 ? esc_attr( $values['v_length'] ) . ' ' : '0 ';

				// Blur
				$properties .= floatval($values['blur'] ) != 0 ? esc_attr( $values['blur'] ) . ' ' : '0 ';

				// spread
				$properties .= isset( $values['spread'] ) && floatval($values['spread'] ) != 0 ? esc_attr( $values['spread'] ) . ' ' : '0 ';

				// Execute only sectors is array type
				if ( is_array( $selectors ) ) {

					foreach ( $selectors as $s_index => $selector ) { $s_index++;

						$output .= $selector . '{box-shadow: ';
						$output .= $properties;
						$output .= isset( $values['colors'] ) && isset( $values['colors']['color_'.$s_index] ) ? esc_attr( $values['colors']['color_'.$s_index] ) . ';' : ';';
						$output .= '}';
					}
				}
			}


		}

		// Output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Typography control value output
	 *
	 * @param   array $selectors
	 * @param   string $control
	 * @param   null $default
	 * @param   null $media_query
	 * @return  void echo style
	 */
	public static function typography( $selectors, $control, $default = null, $media_query = null ) {

		$values         = get_theme_mod( $control, $default );
		$sm_css         = '';
		$md_css         = '';
		$lg_css         = '';
		$output         = '';
		$media_query    = isset( $media_query ) ? $media_query : ['@media only screen and (min-width:720px)','@media only screen and (min-width:1024px)'];

		if ( $values ) {

			if ( is_array( $selectors ) ) {

				foreach ( $selectors as $s_index => $selector ) { $s_index++;

					// Font Family
					$sm_css .= isset( $values['font_family'] ) ? 'font-family: ' . esc_attr( $values['font_family'] ) . ';' : '';
					// Font Weight
					$sm_css .= isset( $values['weight'] ) ? 'font-weight: ' . esc_attr( $values['weight'] ) . ';' : '';
					// Font Style
					$sm_css .= isset( $values['style'] ) ? 'font-style: ' . esc_attr( $values['style'] ) . ';' : '';
					// Text Transform
					$sm_css .= isset( $values['text_transform'] ) ? 'text-transform: ' . esc_attr( $values['text_transform'] ) . ';' : '';
					// Text Decoration
					$sm_css .= isset( $values['text_decoration'] ) ? 'text-decoration: ' . esc_attr( $values['text_decoration'] ) . ';' : '';

					// font size
					$sm_css .= isset( $values['font_size']['mobile'] )
						? 'font-size: ' . esc_attr( $values['font_size']['mobile'] ) . ';'
						: ( isset( $values['font_size']['tablet'] )
							? 'font-size: ' . esc_attr( $values['font_size']['tablet'] ) . ';'
							: ( isset( $values['font_size']['desktop'] )
								? 'font-size: ' . esc_attr( $values['font_size']['desktop'] ) . ';'
								: ''
							)
						);

					$md_css .= isset( $values['font_size']['tablet'] )
						? 'font-size: ' . esc_attr( $values['font_size']['tablet'] ) . ';'
						: ( isset( $values['font_size']['desktop'] ) && isset( $values['font_size']['mobile'] )
							? 'font-size: ' . esc_attr( $values['font_size']['desktop'] ) . ';'
							: ''
						);

					$lg_css .= isset( $values['font_size']['desktop'] ) && isset( $values['font_size']['tablet'] ) && isset( $values['font_size']['mobile'] )
						? 'font-size: ' . esc_attr( $values['font_size']['desktop'] ) . ';'
						: '';

					// letter spacing
					$sm_css .= isset( $values['letter_spacing']['mobile'] )
						? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['mobile'] ) . ';'
						: ( isset( $values['letter_spacing']['tablet'] )
							? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['tablet'] ) . ';'
							: ( isset( $values['letter_spacing']['desktop'] )
								? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['desktop'] ) . ';'
								: ''
							)
						);

					$md_css .= isset( $values['letter_spacing']['tablet'] )
						? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['tablet'] ) . ';'
						: ( isset( $values['letter_spacing']['desktop'] ) && isset( $values['letter_spacing']['mobile'] )
							? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['desktop'] ) . ';'
							: ''
						);

					$lg_css .= isset( $values['letter_spacing']['desktop'] ) && isset( $values['letter_spacing']['tablet'] ) && isset( $values['letter_spacing']['mobile'] )
						? 'letter-spacing: ' . esc_attr( $values['letter_spacing']['desktop'] ) . ';'
						: '';

					// Line Height
					$sm_css .= isset( $values['line_height']['mobile'] )
						? 'line-height: ' . esc_attr( $values['line_height']['mobile'] ) . ';'
						: ( isset( $values['line_height']['tablet'] )
							? 'line-height: ' . esc_attr( $values['line_height']['tablet'] ) . ';'
							: ( isset( $values['line_height']['desktop'] )
								? 'line-height: ' . esc_attr( $values['line_height']['desktop'] ) . ';'
								: ''
							)
						);

					$md_css .= isset( $values['line_height']['tablet'] )
						? 'line-height: ' . esc_attr( $values['line_height']['tablet'] ) . ';'
						: ( isset( $values['line_height']['desktop'] ) && isset( $values['line_height']['mobile'] )
							? 'line-height: ' . esc_attr( $values['line_height']['desktop'] ) . ';'
							: ''
						);

					$lg_css .= isset( $values['line_height']['desktop'] ) && isset( $values['line_height']['tablet'] ) && isset( $values['line_height']['mobile'] )
						? 'line-height: ' . esc_attr( $values['line_height']['desktop'] ) . ';'
						: '';


					if ( $s_index == 1 ) {
						// Color
						$sm_css .= isset( $values['colors'] ) && isset( $values['colors']['color_'.$s_index] ) ? 'color: ' . esc_attr( $values['colors']['color_'.$s_index] ) . ';' : '';

						// Base CSS
						if ( $sm_css != '' ) {
							$output .= $selector . '{' . $sm_css . '}';
						}
						// For Medium Device
						if ( $md_css != '' ) {
							$output .= $media_query[0] . '{' . $selector . '{' . $md_css . '}}';
						}
						// For Large Device
						if ( $lg_css != '' ) {
							$output .= $media_query[1] . '{' . $selector . '{' . $lg_css . '}}';
						}
					}
					else {
						// Base CSS
						$output .= isset( $values['colors'] ) && isset( $values['colors']['color_'.$s_index] ) ? $selector . '{color: ' . esc_attr( $values['colors']['color_'.$s_index] ) . ';}' : '';
					}

				}

			}
		}

		// Output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Color control value output
	 *
	 * @access static public
	 * @param array $selectors
	 * @param string $setting
	 * @param null $default
	 * @param string $property default is 'color'
	 * @param string $prefix
	 * @param string $suffix
	 * @return void echo style
	 */
	public static function color( $selectors, $setting, $default = null, $property = 'color', $prefix = '', $suffix = '' ) {

		$values = get_theme_mod( $setting, $default );
		$output = '';

		if ( $values ) {

			// Execute only sectors is array type
			if ( is_array( $selectors ) ) {

				foreach ( $selectors as $s_index => $selector ) { $s_index++;

					$output .= isset( $values ) && isset( $values['color_'.$s_index] ) ? $selector . '{' . $property . ': ' . esc_attr( $prefix . $values['color_'.$s_index] .$suffix ) . ';}' : '';
				}
			}

		}

		// Output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Range control value output
	 *
	 * @param   string|array $selector
	 * @param   string $control
	 * @param   null $default
	 * @param   string $property default is 'padding'
	 * @param   string $prefix
	 * @param   string $suffix
	 * @param   null $media_query
	 * @return  void echo style
	 */
	public static function range($selector, $control, $default = null, $property = 'padding', $prefix = '', $suffix = '', $media_query = null ) {

		$values         = get_theme_mod( $control, $default );
		$sm_css         = '';
		$md_css         = '';
		$lg_css         = '';
		$output         = '';
		$media_query    = isset( $media_query ) ? $media_query : ['@media only screen and (min-width:720px)','@media only screen and (min-width:1024px)'];

		if ( $values ) {

			$selector = is_array( $selector ) ? join( ',', $selector ) : $selector;

			// font size
			$sm_css .= isset( $values['mobile'] )
				? $property . ': ' . esc_attr( $prefix . $values['mobile'] . $suffix ) . ';'
				: ( isset( $values['tablet'] )
					? $property . ': ' . esc_attr( $prefix . $values['tablet'] . $suffix ) . ';'
					: ( isset( $values['desktop'] )
						? $property . ': ' . esc_attr( $prefix . $values['desktop'] . $suffix ) . ';'
						: ''
					)
				);

			$md_css .= isset( $values['tablet'] )
				? $property . ': ' . esc_attr( $prefix . $values['tablet'] . $suffix ) . ';'
				: ( isset( $values['desktop'] ) && isset( $values['mobile'] )
					? $property . ': ' . esc_attr( $prefix . $values['desktop'] . $suffix ) . ';'
					: ''
				);

			$lg_css .= isset( $values['desktop'] ) && isset( $values['tablet'] ) && isset( $values['mobile'] )
				? $property . ': ' . esc_attr( $prefix . $values['desktop'] . $suffix ) . ';'
				: '';

			// Base CSS
			if ( $sm_css != '' ) {
				$output .= $selector . '{' . $sm_css . '}';
			}
			// For Medium Device
			if ( $md_css != '' ) {
				$output .= $media_query[0] . '{' . $selector . '{' . $md_css . '}}';
			}
			// For Large Device
			if ( $lg_css != '' ) {
				$output .= $media_query[1] . '{' . $selector . '{' . $lg_css . '}}';
			}
		}

		// Output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Dimensions control value output
	 *
	 * @param   string|array $selector
	 * @param   string $control
	 * @param   null $default
	 * @param   string $property default is 'padding'
	 * @param   string $prefix
	 * @param   string $suffix
	 * @param   null $media_query
	 * @return  void echo style
	 */
	public static function dimensions($selector, $control, $default = null, $property = 'padding', $prefix = '', $suffix = '', $media_query = null ) {

		$values         = get_theme_mod( $control, $default );
		$sm_css         = '';
		$md_css         = '';
		$lg_css         = '';
		$output         = '';
		$media_query    = isset( $media_query ) ? $media_query : ['@media only screen and (min-width:720px)','@media only screen and (min-width:1024px)'];

		if ( $values ) {

			$selector = is_array( $selector ) ? join( ',', $selector ) : $selector;

			// width
			foreach ( [ 'top', 'right', 'bottom', 'left' ] as $index => $key ) { $index++;

				$sm_css .= isset( $values['mobile'] ) && isset( $values['mobile']['side_'.$index] )
					? $property . '-' . $key . ': ' . esc_attr( $prefix . $values['mobile']['side_'.$index] . $suffix ) . ';'
					: ( isset( $values['tablet'] ) && isset( $values['tablet']['side_'.$index] )
						? $property . '-' . $key . ': ' . esc_attr( $prefix . $values['tablet']['side_'.$index] . $suffix ) . ';'
						: ( isset( $values['desktop'] ) && isset( $values['desktop']['side_'.$index] )
							? $property . '-' . $key . ': ' . esc_attr( $prefix . $values['desktop']['side_'.$index] . $suffix ) . ';'
							: ''
						)
					);

				$md_css .= isset( $values['tablet'] ) && isset( $values['tablet']['side_'.$index] )
					? $property . '-' . $key . ': '. esc_attr( $prefix . $values['tablet']['side_'.$index] . $suffix ) . ';'
					: ( isset( $values['desktop'] ) && isset( $values['desktop']['side_'.$index] ) && isset( $values['mobile'] ) && isset( $values['mobile']['side_'.$index] )
						? $property . '-' . $key . ': ' . esc_attr( $prefix . $values['desktop']['side_'.$index] . $suffix ) . ';'
						: ''
					);

				$lg_css .= isset( $values['desktop'] ) && isset( $values['desktop']['side_'.$index] ) && isset( $values['tablet'] ) && isset( $values['tablet']['side_'.$index] ) && isset( $values['mobile'] ) && isset( $values['mobile']['side_'.$index] )
					? $property . '-' . $key . ': ' . esc_attr( $prefix . $values['desktop']['side_'.$index] . $suffix ) . ';'
					: '';
			}

			// Base CSS
			if ( $sm_css != '' ) {
				$output .= $selector . '{' . $sm_css . '}';
			}
			// For Medium Device
			if ( $md_css != '' ) {
				$output .= $media_query[0] . '{' . $selector . '{' . $md_css . '}}';
			}
			// For Large Device
			if ( $lg_css != '' ) {
				$output .= $media_query[1] . '{' . $selector . '{' . $lg_css . '}}';
			}
		}

		// Output
		$output = ( '' != $output ) ? $output : '';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Generate CSS.
	 *
	 * @param array|string $selector The CSS selector.
	 * @param array $property  The CSS style.
	 * @param string $values The CSS value.
	 * @param string $prefix The CSS prefix.
	 * @param string $suffix The CSS suffix.
	 * @param void echo style
	 */
	public static function generate_css( $selector, $property , $values, $prefix = '', $suffix = '', $media = null ) {

		$output = '';

		/*
         * Bail early if we have no $selector elements or properties and $value.
         */
		if ( ! $values || ! $selector ) {
			return;
		}

		if ( $media ) {
			$output .= $media .'{';
		}

		$selector = is_array( $selector ) ? join( ',', $selector ) : $selector;

		$output .= $selector . '{';
		foreach ( $property  as $key => $style ) {
			$output .= $style . ':' . esc_attr( $prefix . $values . $suffix ) . ';';
		}
		$output .= '}';

		if ( $media ) {
			$output .= '}';
		}

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

}
new Real_Home_Customizer_Inline_Style();
