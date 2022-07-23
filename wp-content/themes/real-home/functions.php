<?php
/**
 * Real Home functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Real_Home
 */

/**
 * Real Home only works in WordPress 5.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Define Constants
 */
if ( ! defined( 'REAL_HOME_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'REAL_HOME_THEME_VERSION', '1.0.0' );
}
if ( ! defined( 'REAL_HOME_THEME_DIR' ) ) {
	define( 'REAL_HOME_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'REAL_HOME_THEME_URI' ) ) {
	define( 'REAL_HOME_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
}

if ( ! function_exists( 'real_home_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function real_home_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Real Home, use a find and replace
		 * to change 'real-home' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'real-home', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu'  => esc_html__( 'Primary Menu', 'real-home' ),
				'mobile-menu'   => esc_html__( 'Mobile Menu', 'real-home' ),
				'footer-menu'   => esc_html__( 'Footer Menu', 'real-home' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'real_home_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function real_home_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'real_home_content_width', 640 );
}
add_action( 'after_setup_theme', 'real_home_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function real_home_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'real-home' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'real-home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Subscribe Form
	register_sidebar(
		array(
			'name'          => esc_html__( 'Front Page: Subscribe Form', 'real-home' ),
			'id'            => 'subscribe-form',
			'description'   => esc_html__( 'Add widgets here.', 'real-home' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $sidebar = 1; $sidebar <= 6; $sidebar++ ) {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'Footer Sidebar %d ', 'real-home' ), absint($sidebar) ),
				'id'            => 'footer-sidebar-' . absint($sidebar),
				'description'   => esc_html__( 'Display widgets footer section of the site.', 'real-home' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'real_home_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function real_home_scripts() {

	// Font Awesome Style
	wp_enqueue_style( 'font-awesome', REAL_HOME_THEME_URI .'assets/css/font-awesome.css', array(), '4.7.0' );

	// MeanMenu Style
	wp_enqueue_style( 'meanmenu', REAL_HOME_THEME_URI .'assets/css/meanmenu.css', array(), '2.0.7' );

	// Slick Style
	wp_enqueue_style( 'slick-theme', REAL_HOME_THEME_URI .'assets/css/slick-theme.css', null, '1.8.0' );
	wp_enqueue_style( 'slick', REAL_HOME_THEME_URI .'assets/css/slick.css', null, '1.8.0' );

	// Theme Style
	wp_enqueue_style( 'real-home-style', get_stylesheet_uri(), array(), REAL_HOME_THEME_VERSION );

	// Main Style
	wp_enqueue_style( 'real-home-main-style', REAL_HOME_THEME_URI . 'assets/css/main.css', null, REAL_HOME_THEME_VERSION, 'all' );

	// Responsive Style
	wp_enqueue_style( 'real-home-responsive', REAL_HOME_THEME_URI . 'assets/css/responsive.css', null, REAL_HOME_THEME_VERSION, 'all' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'real-home-main-style', Real_Home_Customizer_Inline_Style::css_output( 'front-end' ) );

	// Enqueue Slick Js
	wp_enqueue_script( 'slick', REAL_HOME_THEME_URI . 'assets/js/slick.js', [ 'jquery' ], '1.8.0', true );

	// Enqueue MeanMenu Js
	wp_enqueue_script( 'meanmenu', REAL_HOME_THEME_URI . 'assets/js/jquery.meanmenu.js', [ 'jquery' ], '2.0.7', true );

	// Enqueue Isotope Js
	wp_enqueue_script( 'isotope', REAL_HOME_THEME_URI . 'assets/js/isotope.pkgd.js', [ 'jquery' ], '3.0.6', true );

	// Enqueue Images Loaded Js
	wp_enqueue_script( 'imagesloaded', REAL_HOME_THEME_URI . 'assets/js/imagesloaded.pkgd.js', [ 'jquery' ], '3.2.0', true );

	// Enqueue theia-sticky-sidebar Js
	$sticky_sidebar = get_theme_mod( 'real_home_sidebar_sticky', '' );
	if ( $sticky_sidebar ) {
		wp_enqueue_script( 'theia-sticky-sidebar', REAL_HOME_THEME_URI . 'assets/js/theia-sticky-sidebar.js', [ 'jquery' ], '1.7.0', true );
	}

	// Main scripts.
	wp_enqueue_script( 'real-home', REAL_HOME_THEME_URI . 'assets/js/real-home.js', array( 'jquery' ), REAL_HOME_THEME_VERSION, true );

	// Localized Scripts for the load more posts.
	$locale = [
		'sticky_sidebar' => $sticky_sidebar ? true : false,
	];
	$locale = apply_filters( 'real_home_localize_var', $locale );
	wp_localize_script( 'real-home','REAL_HOME', $locale );

	// Comment Reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'real_home_scripts' );

/**
 * Custom template tags for this theme.
 */
require REAL_HOME_THEME_DIR . 'inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require REAL_HOME_THEME_DIR . 'inc/template-functions.php';

/**
 * Google fonts utilities
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Google_Fonts.php';

/**
 * Font Awesome Icon
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Font_Awesome_Icons.php';

/**
 * Breadcrumb
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Breadcrumb.php';

/**
 * Helper Functions
 */
require REAL_HOME_THEME_DIR . 'inc/classes/Real_Home_Helper.php';

/**
 * Customizer additions.
 */
require REAL_HOME_THEME_DIR . 'inc/customizer/Real_Home_Customizer.php';

// Builder
require REAL_HOME_THEME_DIR . 'inc/customizer/builder/Real_Home_Customizer_Builder.php';
require REAL_HOME_THEME_DIR. 'inc/customizer/builder/header/Real_Home_Customizer_Header_Builder.php';
require REAL_HOME_THEME_DIR. 'inc/customizer/builder/footer/Real_Home_Customizer_Footer_Builder.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require REAL_HOME_THEME_DIR . 'inc/compatibility/jetpack/jetpack.php';
}

/**
 * Load hooks file.
 */
require REAL_HOME_THEME_DIR . 'inc/hooks/hooks.php';
require REAL_HOME_THEME_DIR . 'inc/hooks/functions.php';

/**
 * Load plugin recommendations.
 */
require REAL_HOME_THEME_DIR . 'inc/tgm/tgm.php';
