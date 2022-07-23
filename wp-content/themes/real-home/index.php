<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */

get_header();
?>

<?php
/**
 * Functions hooked into real_home_content_before action
 *
 * @hooked real_home_content_before_wrapper_start     - 10
 */
do_action( 'real_home_content_before' );
?>

<div id="primary" <?php Real_Home_Helper::primary_class();?>>
    <main id="main" class="site-main">

        <?php
        /**
         * Functions hooked into real_home_content_before action
         *
         */
        do_action( 'real_home_content_top' );
        ?>

        <?php if ( have_posts() ) : ?>

            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php
            /**
             * Functions hooked into real_home_posts_content_loop_before action
             *
             */
            do_action('real_home_posts_content_loop_before');

            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;

            /**
             * Functions hooked into real_home_posts_content_loop_after action
             *
             * @hooked real_home_posts_navigation - 10
             */
            do_action('real_home_posts_content_loop_after');

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

        <?php
        /**
         * Functions hooked into real_home_content_bottom action
         *
         */
        do_action( 'real_home_content_bottom' );
        ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php
/**
 * Functions hooked into real_home_content_after action
 *
 * @hooked real_home_content_after_wrapper_end     - 10
 */
do_action( 'real_home_content_after' );
?>

<?php get_footer(); ?>
