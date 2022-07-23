<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

            <?php
            /**
             * Functions hooked into real_home_posts_content_loop_before action
             *
             */
            do_action('real_home_posts_content_loop_before');

            /* Start the Loop */
            while ( have_posts() ) : the_post();

                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
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
