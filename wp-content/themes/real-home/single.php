<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Real_Home
 */

get_header();
?>

<?php
/**
 * Functions hooked into real_home_content_before action
 *
 * @hooked real_home_content_before_wrapper_start   - 15
 */
do_action( 'real_home_content_before' );
?>

    <div id="primary" <?php Real_Home_Helper::primary_class();?>>
        <main id="main" class="site-main">

            <?php
            /**
             * Functions hooked into real_home_post_content_loop_before action
             *
             */
            do_action('real_home_post_content_loop_before');

            while ( have_posts() ) : the_post();

                /**
                 * Functions hooked into real_home_post_content_elements action
                 *
                 */
                do_action('real_home_post_content_before');

                get_template_part( 'template-parts/content', 'single' );

                /**
                 * Functions hooked into real_home_post_content_elements action
                 *
                 */
                do_action('real_home_post_content_after');

            endwhile; // End of the loop.

            /**
             * Functions hooked into real_home_post_content_loop_after action
             *
             */
            do_action('real_home_post_content_loop_after');

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