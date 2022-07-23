<?php
/**
 * Real Home back compat functionality
 *
 * Prevents Real Home from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 5.6.
 *
 * @package Real_Home
 */

/**
 * Prevent switching to Real Home on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function real_home_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'real_home_upgrade_notice' );
}
add_action( 'after_switch_theme', 'real_home_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Real Home on WordPress versions prior to 5.6.
 *
 * @global string $wp_version WordPress version.
 */
function real_home_upgrade_notice() {
	$message = sprintf( esc_html__( 'Real Home requires at least WordPress version 5.6. You are running version %s. Please upgrade and try again.', 'real-home' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 5.6.
 *
 * @global string $wp_version WordPress version.
 */
function real_home_customize() {
	wp_die( sprintf( esc_html__( 'Real Home requires at least WordPress version 5.6. You are running version %s. Please upgrade and try again.', 'real-home' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'real_home_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 5.6.
 *
 * @global string $wp_version WordPress version.
 */
function real_home_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Real Home requires at least WordPress version 5.6. You are running version %s. Please upgrade and try again.', 'real-home' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'real_home_preview' );
