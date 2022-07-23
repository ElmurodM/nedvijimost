<?php
/**
 * Real Home google fonts utilities
 *
 * @package Real_Home
 */

/**
 * class for google fonts utilities
 *
 * @access public
 */
class Real_Home_Google_Fonts {

    /**
     * Instance
     *
     * @access private
     * @var object
     */
    private static $instance;

    /**
     * Returns the instance.
     *
     * @access public
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor method.
     *
     * @access private
     * @return void
     */
    private function __construct() {

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ], 1 );
    }

	/**
	 * Standard Web Fonts
	 *
	 * @return array $webfonts
	 */
	protected static function standard_webfonts() {

		// Declare default font lists
		$lists = [
			[
				'family'	=> 'Serif',
				'variants'	=> [
					"400",
					"400italic",
					"700",
					"700italic"
				],
				'subsets'	=> []
			],
			[
				'family'	=> 'Sans Serif',
				'variants'	=> [
					"400",
					"400italic",
					"700",
					"700italic"
				],
				'subsets'	=> []
			],
			[
				'family'	=> 'Monospace',
				'variants'	=> [
					"400",
					"400italic",
					"700",
					"700italic"
				],
				'subsets'	=> []
			]
		];

		// Build default webfonts
		$webfonts = [];

		foreach ( $lists as $item ) {

			// font name
			$name   = str_replace(' ', '+', $item['family']);

			// font url
			$url    = "https://fonts.googleapis.com/css?family={$name}:" . implode( ',', $item['variants'] );
			if ( isset( $item['subsets'] ) ) {
				$url .= '&subset=' . join(',', $item['subsets']);
			}

			// Create a font array containing it's properties and add it to the $webfonts array
			$attr = array(
				'name'          => $item['family'],
				'font_type'     => esc_html__( 'Standard Fonts', 'real-home' ),
				'font_variants' => $item['variants'],
				'subsets'       => $item['subsets'],
				'url'           => $url
			);

			// Add this font to the fonts array
			$id                 = strtolower( str_replace( ' ', '_', $item['family'] ) );
			$webfonts[ $id ]    = $attr;
		}

		return $webfonts;

	}

	/**
	 * Google Web Fonts
	 *
	 * @return array $webfonts
	 */
	protected static function google_webfonts() {
		// Declare default font lists
		$lists = [
			[
				'family'	=> 'Barlow',
				'variants'	=> [
					"100",
					"100italic",
					"200",
					"200italic",
					"300",
					"300italic",
					"regular",
					"italic",
					"500",
					"500italic",
					"600",
					"600italic",
					"700",
					"700italic",
					"800",
					"800italic",
					"900",
					"900italic"
				],
				'subsets'	=> [
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Bona Nova',
				'variants'	=> [
					"regular",
					"italic",
					"700"
				],
				'subsets'	=> [
					"cyrillic",
					"cyrillic-ext",
					"greek",
					"hebrew",
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'serif'
			],
			[
				'family'	=> 'Josefin Sans',
				'variants'	=> [
					"100",
					"200",
					"300",
					"regular",
					"500",
					"600",
					"700",
					"100italic",
					"200italic",
					"300italic",
					"italic",
					"500italic",
					"600italic",
					"700italic"
				],
				'subsets'	=> [
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Kaisei Tokumin',
				'variants'	=> [
					"regular",
					"500",
					"700",
					"800"
				],
				'subsets'	=> [
					"cyrillic",
					"japanese",
					"latin",
					"latin-ext"
				],
				'category'	=> 'serif'
			],
			[
				'family'	=> 'Lato',
				'variants'	=> [
					"100",
					"100italic",
					"300",
					"300italic",
					"regular",
					"italic",
					"700",
					"700italic",
					"900",
					"900italic"
				],
				'subsets'	=> [
					"latin",
					"latin-ext"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Montserrat',
				'variants'	=> [
					"100",
					"100italic",
					"200",
					"200italic",
					"300",
					"300italic",
					"regular",
					"italic",
					"500",
					"500italic",
					"600",
					"600italic",
					"700",
					"700italic",
					"800",
					"800italic",
					"900",
					"900italic"
				],
				'subsets'	=> [
					"cyrillic",
					"cyrillic-ext",
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Open Sans',
				'variants'	=> [
					"300",
					"300italic",
					"regular",
					"italic",
					"600",
					"600italic",
					"700",
					"700italic",
					"800",
					"800italic"
				],
				'subsets'	=> [
					"cyrillic",
					"cyrillic-ext",
					"greek",
					"greek-ext",
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Prompt',
				'variants'	=> [
					"100",
					"100italic",
					"200",
					"200italic",
					"300",
					"300italic",
					"regular",
					"italic",
					"500",
					"500italic",
					"600",
					"600italic",
					"700",
					"700italic",
					"800",
					"800italic",
					"900",
					"900italic"
				],
				'subsets'	=> [
					"latin",
					"latin-ext",
					"thai",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			],
			[
				'family'	=> 'Roboto',
				'variants'	=> [
					"100",
					"100italic",
					"300",
					"300italic",
					"regular",
					"italic",
					"500",
					"500italic",
					"700",
					"700italic",
					"900",
					"900italic"
				],
				'subsets'	=> [
					"cyrillic",
					"cyrillic-ext",
					"greek",
					"greek-ext",
					"latin",
					"latin-ext",
					"vietnamese"
				],
				'category'	=> 'sans-serif'
			]
		];

		// Google Fonts webfonts
		$webfonts = [];

		foreach ( $lists as $item ) {

			// font name
			$name   = str_replace(' ', '+', $item['family']);

			// font url
			$url    = "https://fonts.googleapis.com/css?family={$name}:" . implode( ',', $item['variants'] );
			if ( isset( $item['subsets'] ) ) {
				$url .= '&subset=' . join(',', $item['subsets']);
			}

			// Create a font array containing it's properties and add it to the $webfonts array
			$attr = array(
				'name'          => $item['family'],
				'category'      => $item['category'],
				'font_type'     => esc_html__( 'Google Fonts', 'real-home' ),
				'font_variants' => $item['variants'],
				'subsets'       => $item['subsets'],
				'url'           => $url
			);

			// Add this font to the fonts array
			$id                 = strtolower( str_replace( ' ', '_', $item['family'] ) );
			$webfonts[ $id ]    = $attr;
		}

		return $webfonts;
	}

	/**
	 * Get All Fonts
	 *
	 * Merges the default system fonts and the google fonts
	 * into a single array and returns it
	 *
	 * @static
	 * @access public
	 * @return array All fonts with their properties
	 *
	 */
	public static function get_fonts() {

		$standard   = self::standard_webfonts();
		$google     = self::google_webfonts();

		return array_merge( $standard, $google );
	}

    /**
     * Returns an array of all available variants.
     *
     * @static
     * @access public
     * @return array
     */
    public static function get_variants() {
        return [
            '100'       => esc_attr__( 'Ultra-Light 100', 'real-home' ),
            '100light'  => esc_attr__( 'Ultra-Light 100', 'real-home' ),
            '100italic' => esc_attr__( 'Ultra-Light 100 Italic', 'real-home' ),
            '200'       => esc_attr__( 'Light 200', 'real-home' ),
            '200italic' => esc_attr__( 'Light 200 Italic', 'real-home' ),
            '300'       => esc_attr__( 'Book 300', 'real-home' ),
            '300italic' => esc_attr__( 'Book 300 Italic', 'real-home' ),
            '400'       => esc_attr__( 'Normal 400', 'real-home' ),
            'italic'    => esc_attr__( 'Normal 400 Italic', 'real-home' ),
            '500'       => esc_attr__( 'Medium 500', 'real-home' ),
            '500italic' => esc_attr__( 'Medium 500 Italic', 'real-home' ),
            '600'       => esc_attr__( 'Semi-Bold 600', 'real-home' ),
            '600bold'   => esc_attr__( 'Semi-Bold 600', 'real-home' ),
            '600italic' => esc_attr__( 'Semi-Bold 600 Italic', 'real-home' ),
            '700'       => esc_attr__( 'Bold 700', 'real-home' ),
            '700italic' => esc_attr__( 'Bold 700 Italic', 'real-home' ),
            '800'       => esc_attr__( 'Extra-Bold 800', 'real-home' ),
            '800bold'   => esc_attr__( 'Extra-Bold 800', 'real-home' ),
            '800italic' => esc_attr__( 'Extra-Bold 800 Italic', 'real-home' ),
            '900'       => esc_attr__( 'Ultra-Bold 900', 'real-home' ),
            '900bold'   => esc_attr__( 'Ultra-Bold 900', 'real-home' ),
            '900italic' => esc_attr__( 'Ultra-Bold 900 Italic', 'real-home' ),
        ];
    }

    /**
     * Returns an array of added google fonts
     *
     * @static
     * @access public
     * @return array
     */
    public static function add_google_fonts() {

        $added_fonts        = [];
        $added_fonts_pass   = [];
        $all_fonts          = self::get_fonts();

        /*--------------------------------------------------------------
        # Global
        --------------------------------------------------------------*/
        // Base
        $base = get_theme_mod(
            'real_home_base_typography',
            ''
        );
        if ( $base && array_key_exists( 'font_family', $base ) ) {
            $added_fonts[] = $base;
        }
        // Header contact info
		$header_contact_info_title = get_theme_mod(
			'real_home_header_contact_info_title_typo',
			''
		);
		if ( $header_contact_info_title && array_key_exists( 'font_family', $header_contact_info_title ) ) {
			$added_fonts[] = $header_contact_info_title;
		}
		$header_contact_info_subtitle = get_theme_mod(
			'real_home_header_contact_info_subtitle_typo',
			''
		);
		if ( $header_contact_info_subtitle && array_key_exists( 'font_family', $header_contact_info_subtitle ) ) {
			$added_fonts[] = $header_contact_info_subtitle;
		}
        // Site Identity ->  Site Title
        $site_title = get_theme_mod(
            'real_home_header_site_title_typo',
            ''
        );
        if ( $site_title && array_key_exists( 'font_family', $site_title ) ) {
            $added_fonts[] = $site_title;
        }
        // Site Identify => Tagline
		$site_tagline = get_theme_mod(
			'real_home_header_site_tagline_typo',
			''
		);
		if ( $site_tagline && array_key_exists( 'font_family', $site_tagline ) ) {
			$added_fonts[] = $site_tagline;
		}
        $added_fonts = apply_filters( 'real_home_added_fonts', $added_fonts );

		if ( ! empty( $added_fonts ) ) {

			foreach ( $added_fonts as $added_font ) {

				// Check if font_family exist in $selected_font
				if ( ! empty( $added_font['font_family'] ) ) {

					$font_key = esc_html(strtolower( str_replace(' ', '_', $added_font['font_family'] ) ));
					// Check for the Google Fonts arrays.
					if ( array_key_exists( $font_key, $all_fonts ) ) {
						$added_fonts_pass[$font_key]['font'] = esc_html($added_font['font_family']);
					}
					if ( array_key_exists( 'weight', $added_font ) || array_key_exists( 'style', $added_font ) ) {
						$added_fonts_pass[$font_key]['font_variant'][]  = esc_html($added_font['font_variant']);
					}
				}
			}

		}

        return $added_fonts_pass;
    }

	/**
	 * Enqueue fonts.
	 */
	public static function enqueue() {

		$selected_fonts = self::add_google_fonts();
		$font_str       = '';

		if ( empty( $selected_fonts ) ) {
			return;
		}

		foreach ( $selected_fonts as $selected_font ) {
			if ( ! empty( $font_str ) ) {
				$font_str .= '|';
			}

			// font family, font style and font weight
			if ( ! empty( $selected_font['font'] ) ) {
				$font_str .= trim($selected_font['font']);
				if ( ! empty( $selected_font['font_variant'] ) ) {
					$variant = $selected_font['font_variant'];
					sort($variant);
					$font_str .= ':' . rawurlencode( trim( implode(',', $variant ) ) );
				}
			}
		}
		wp_enqueue_style( 'real-home-google-fonts', '//fonts.googleapis.com/css?family='.$font_str.'&display=swap', false );
	}
}

Real_Home_Google_Fonts::get_instance();
