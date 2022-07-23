<?php
/**
 * Template part for displaying footer copyright text
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */


$content = get_theme_mod(
    'real_home_footer_copyright_text',
	__( 'Copyright {copyright} {current_year} {site_title}', 'real-home' )
);

$link_open = get_theme_mod(
    'real_home_footer_copyright_link_target',
    ['desktop'=>'true']
);

$link_target = ( $link_open && array_key_exists( 'desktop', $link_open ) ) ? '_blank' : '_self';

$content = str_replace( '{copyright}', '&copy;', $content );
$content = str_replace( '{current_year}', date_i18n( _x( 'Y', 'copyright date format; check date() on php.net', 'real-home' ) ), $content );
$content = str_replace( '{site_title}', get_bloginfo( 'name' ), $content );
$content .= sprintf(
/* translators: 1: title. */
	esc_html__( ' -  Powered by %1$s', 'real-home' ),
	'<a href="'.esc_url('https://www.aarambhathemes.com/').'" rel="designer" target="'. esc_attr( $link_target ) .'">' . esc_html__('Aarambha Themes', 'real-home') . '</a>');
?>

<div class="site-info footer-copyright-wrap">
    <?php echo wp_kses_post( do_shortcode( $content ) ); ?>
</div><!-- .site-info -->
