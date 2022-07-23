<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Real_Home
 */

if ( ! is_active_sidebar( 'sidebar-1' )
    || Real_Home_Helper::get_sidebar_layout() == 'none'
    || Real_Home_Helper::front_page_enable() ) {
    return;
}

/**
 * Functions hooked into real_home_sidebar_before action
 *
 */
do_action( 'real_home_sidebar_before' );
?>

    <aside id="secondary" <?php Real_Home_Helper::sidebar_class(); ?>>

        <?php
        /**
         * Functions hooked into real_home_sidebar_top action
         *
         */
        do_action( 'real_home_sidebar_top' );
        ?>

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

        <?php
        /**
         * Functions hooked into real_home_sidebar_bottom action
         *
         */
        do_action( 'real_home_sidebar_bottom' );
        ?>

    </aside><!-- #secondary -->

<?php
/**
 * Functions hooked into real_home_sidebar_before action
 *
 */
do_action( 'real_home_sidebar_after' );
