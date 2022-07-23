<?php
/**
 * Real Home functions to be hooked
 *
 * @package Real_Home
 */


/* ------------------------------ HEADER ------------------------------ */

if ( ! function_exists( 'real_home_head_meta' ) ) :
    /**
     * Meta head
     */
    function real_home_head_meta() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php
    }
endif;

if ( ! function_exists( 'real_home_header_featured_slider' ) ) :
    /**
     * Header Featured Slider
     */
    function real_home_header_featured_slider() {

        if ( Real_Home_Helper::front_page_enable() ) {
            get_template_part( 'template-parts/front-page/content', 'banner' );
        }
    }
endif;

/* ------------------------------ BEFORE CONTENT ------------------------------ */
if ( ! function_exists( 'real_home_content_before_page_header' ) ) :
    /**
     * Featured page content page header
     */
    function real_home_content_before_page_header() {

        if ( is_front_page() && is_home() || Real_Home_Helper::front_page_enable() ) {
            return;
        }

        // Blog
        $elements = get_theme_mod(
            'real_home_blog_page_header_elements',
            ['post-title','breadcrumb']
        );
        if ( is_single() ) {
        	if ( 'property' == get_post_type() ) {
        		$elements = get_theme_mod(
					'real_home_property_single_post_header_elements',
					['post-title','breadcrumb']
				);
        	}
        	elseif ( 'agent' == get_post_type() ) {
        		$elements = get_theme_mod(
					'real_home_agent_single_post_header_elements',
					['post-title','breadcrumb']
				);
        	}
        	else {
        		$elements = get_theme_mod(
					'real_home_single_post_header_elements',
					['post-title','breadcrumb']
				);
        	}
        }

        // Is Single Page
        elseif ( is_page() ) {
            $elements = get_theme_mod(
                'real_home_single_page_header_elements',
                ['post-title','breadcrumb']
            );
        }
        // Is 404 Page
        elseif ( is_404() ) {
            $elements = get_theme_mod(
                'real_home_404_page_header_elements',
                ['post-title','breadcrumb']
            );
        }
        // Is Custom Archive Property
        elseif ( is_post_type_archive( 'property' ) || taxonomy_exists( 'property-type' ) || taxonomy_exists( 'property-location' ) || taxonomy_exists( 'property-status' ) ) {
        	$elements = get_theme_mod(
				'real_home_property_archive_page_header_elements',
				['post-title','breadcrumb']
			);
		}

        // Container Class
        $container_class = ['container d-flex flex-column align-items-center text-center'];
        ?>
        <?php if ( ! empty( $elements ) ) : ?>

            <div class="page-title-wrap">
                <div class="<?php echo esc_attr( implode( ' ', $container_class ) ); ?>">
                    <?php
                    foreach ( $elements as $element ) :

                        switch ( $element ) :

                            case 'post-title' :
                                Real_Home_Helper::page_header();
                                break;

                            case 'breadcrumb' :
                                Real_Home_Breadcrumb::get_breadcrumb();
                                break;

                            case 'post-meta' :

                                echo '<div class="post-meta-wrapper header-post-meta">';
                                Real_Home_Helper::post_meta( get_the_ID() );
                                echo '</div><!-- .header-post-meta -->';
                                break;

                            case 'post-desc' :
                                if ( ! is_404() ) {
                                    the_archive_description( '<div class="archive-description">', '</div>' );
                                }
                                break;

                        endswitch;

                    endforeach;
                    ?>
                </div>
            </div>

        <?php endif;
    }
endif;
if ( ! function_exists( 'real_home_content_before_wrapper_start' ) ) :
    /**
     * Add custom wrapper div before content start
     */
    function real_home_content_before_wrapper_start() {
        if ( is_404() || Real_Home_Helper::front_page_enable() ) {
            return;
        }
        $section_class = is_single() && 'agent' != get_post_type() ? 'page-wrapper single-post-wrapper' : 'page-wrapper';
        ?>
        <section class="<?php echo esc_attr( $section_class ); ?>">
        <div class="container d-flex flex-wrap">
        <?php
    }
endif;

/* ------------------------------ AFTER CONTENT ------------------------------ */
if ( ! function_exists( 'real_home_content_after_wrapper_end' ) ) :
    /**
     * Close custom wrapper div after content
     */
    function real_home_content_after_wrapper_end() {
        if ( is_404() || Real_Home_Helper::front_page_enable() ) {
            return;
        }
        get_sidebar();
        echo '</div><! -- .container -->';
        echo '</section><! -- .page-wrapper -->';
    }
endif;
/* ------------------------------ BLOG PAGE CONTENT ------------------------------ */

if ( ! function_exists( 'real_home_posts_navigation' ) ) :
    /**
     * Blog Posts navigation
     */
    function real_home_posts_navigation() {

        Real_Home_Helper::post_pagination();
    }
endif;

if ( ! function_exists( 'real_home_blog_post_content' ) ) :
    /**
     * Blog post content
     */
    function real_home_blog_post_content() {

        $posts_elements = get_theme_mod(
            'real_home_blog_posts_elements',
            ['post-meta','post-title','post-excerpt']
        );
        $meta_elements = get_theme_mod(
        	'real_home_blog_posts_meta_elements',
        	['categories','author']
        );

        if ( ! empty( $posts_elements ) ) :

            echo '<div class="post-detail-wrap d-flex flex-column text-left">';

            real_home_posted_on();

            foreach ( $posts_elements as $post_element ) :

                switch ( $post_element ) :

                    case 'post-title' :
                        Real_Home_Helper::post_title();
                        break;

                    case 'post-excerpt' :
                        Real_Home_Helper::post_content();
                        break;

                    case 'read-more' :
                        Real_Home_Helper::read_more();
                        break;

                    case 'post-meta' :
                        echo '<div class="entry-meta">';

                        if ( $meta_elements ) {
                        	foreach ( $meta_elements as $val ) {
                        		if( $val == 'author' ) {
                        			real_home_posted_by();
                        		}
                        		elseif( $val == 'categories' ) {
									real_home_posted_cats();
                        		}
                        		elseif( $val == 'tags' ) {
									real_home_posted_tags();
                        		}
                        	}
                        }
                        echo '</div><!-- .entry-meta -->';
                        break;

                endswitch;
            endforeach;

            echo '</div><!-- .post-details-wrap -->';

        endif;
    }
endif;

/* ------------------------------ SEARCH PAGE CONTENT ------------------------------ */

if ( ! function_exists( 'real_home_search_posts_header' ) ) :
    /**
     * Posts Header
     */
    function real_home_search_posts_header() {
        ?>
        <header class="entry-header">

            <?php
            /**
             * Functions hooked in to real_home_search_posts_header_top action.
             */
            do_action( 'real_home_search_posts_header_top' );
            ?>

            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

            <?php
            if ( 'post' === get_post_type() ) :
                ?>
                <div class="entry-meta">
                    <?php
                    real_home_posted_on();
                    real_home_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>

            <?php real_home_post_thumbnail(); ?>

            <?php
            /**
             * Functions hooked in to real_home_search_posts_header_bottom action.
             */
            do_action( 'real_home_search_posts_header_bottom' );
            ?>

        </header><!-- .entry-header -->
        <?php
    }
endif;

if ( ! function_exists( 'real_home_search_posts_content' ) ) :
    /**
     * Posts Content
     */
    function real_home_search_posts_content() {
        ?>
        <div class="entry-summary">

            <?php
            /**
             * Functions hooked in to real_home_search_posts_content_top action.
             *
             */
            do_action( 'real_home_search_posts_content_top' );
            ?>

            <?php the_excerpt(); ?>

            <?php
            /**
             * Functions hooked in to real_home_search_posts_content_bottom action.
             *
             */
            do_action( 'real_home_search_posts_content_bottom' );
            ?>
        </div><!-- .entry-summary -->

        <?php
    }
endif;

if ( ! function_exists( 'real_home_search_posts_footer' ) ) :
    /**
     * Posts Footer
     */
    function real_home_search_posts_footer() {
        ?>
        <footer class="entry-footer">

            <?php
            /**
             * Functions hooked in to real_home_search_posts_footer_top action.
             *
             */
            do_action( 'real_home_search_posts_footer_top' );
            ?>

            <?php real_home_entry_footer(); ?>

            <?php
            /**
             * Functions hooked in to real_home_search_posts_footer_bottom action.
             *
             */
            do_action( 'real_home_search_posts_footer_bottom' );
            ?>

        </footer><!-- .entry-footer -->

        <?php
    }
endif;

/* ------------------------------ POST CONTENT ------------------------------ */

if ( ! function_exists( 'real_home_get_post_thumbnail' ) ) :
    /**
     * Post Thumbnail
     */
    function real_home_get_post_thumbnail() {

        // Is Singular
        if ( is_singular() ) {

            $img_ratio = is_single() ? get_theme_mod('real_home_single_post_featured_image_ratio',['desktop' => '16x9'] ) : get_theme_mod( 'real_home_single_page_featured_image_ratio', ['desktop' => '16x9'] );

            $img_size = is_single() ? get_theme_mod('real_home_single_post_featured_image_size',['desktop' => 'medium_large'] ) : get_theme_mod( 'real_home_single_page_featured_image_size', ['desktop' => 'medium_large'] );

            $ratio = in_array( 'auto', $img_ratio ) ? '16x9' : $img_ratio['desktop'];

            real_home_singular_post_thumbnail( $img_size['desktop'],$ratio );
        }
        else {
            $img_ratio = get_theme_mod( 'real_home_blog_post_featured_image_ratio', ['desktop' => '16x9'] );

            $img_size = get_theme_mod( 'real_home_blog_post_featured_image_size', ['desktop' => 'medium_large'] );

            $ratio = in_array( 'auto', $img_ratio ) ? '16x9' : $img_ratio['desktop'];

            real_home_post_thumbnail( $img_size['desktop'],$ratio );
        }
    }
endif;

if ( ! function_exists( 'real_home_post_header' ) ) :
    /**
     * Post Header
     */
    function real_home_post_header() {
        ?>
        <header class="entry-header">

            <?php
            /**
             * Functions hooked in to real_home_post_header_top action.
             */
            do_action( 'real_home_post_header_top' );
            ?>

            <?php
            $elements = get_theme_mod(
                'real_home_single_post_content_entry_header_elements',
                ['post-cats','post-title']
            );
            if ( ! empty( $elements ) ) :

                foreach ( $elements as $element ) :

                    switch ( $element ) :

                        case 'post-title' :
                            $html_tag = get_theme_mod(
                                'real_home_single_post_title_tag',
                                ['desktop' => 'h1']
                            );
                            the_title( '<' . esc_attr( $html_tag['desktop'] ) . ' class="entry-title">', '</' . esc_attr( $html_tag['desktop'] ) . '>' );
                            break;

                        case 'post-cats' :

                            echo '<div class="entry-meta">';
                            real_home_posted_cats();
                            echo '</div><!-- .entry-meta -->';

                            break;

                    endswitch;

                endforeach;
            endif;

            if ( has_post_thumbnail() ) {
                real_home_posted_on();
            }
            ?>

            <?php
            /**
             * Functions hooked in to real_home_post_header_bottom action.
             */
            do_action( 'real_home_post_header_bottom' );
            ?>

        </header><!-- .entry-header -->

        <?php
    }
endif;

if ( ! function_exists( 'real_home_post_content' ) ) :
    /**
     * Post Content
     */
    function real_home_post_content() {
        ?>
        <div class="entry-content">

            <?php
            /**
             * Functions hooked in to real_home_post_content_top action.
             *
             */
            do_action( 'real_home_post_content_top' );
            ?>

            <?php
            the_content(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'real-home' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            ?>

            <?php

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'real-home' ),
                    'after'  => '</div>',
                )
            );
            ?>

            <?php
            /**
             * Functions hooked in to real_home_post_content_bottom action.
             *
             */
            do_action( 'real_home_post_content_bottom' );
            ?>

        </div><!-- .entry-content -->

        <?php
    }
endif;

if ( ! function_exists( 'real_home_post_footer' ) ) :
    /**
     * Post Footer for extra elements
     */
    function real_home_post_footer() {

        ?>
        <footer class="entry-footer">

            <?php
            /**
             * Functions hooked in to real_home_post_content_top action.
             *
             */
            do_action( 'real_home_post_footer_top' );
            ?>
            <?php
            $elements = get_theme_mod(
                'real_home_single_post_content_entry_footer_elements',
                ['tags','post-comments','post-navigation']
            );

            if ( ! empty( $elements ) ) :

                foreach ( $elements as $element ) :

                    switch ( $element ) :

                        case 'post-comments' :
                            Real_Home_Helper::post_comment();
                            break;

                        case 'post-navigation' :
                            Real_Home_Helper::post_navigation();
                            break;

                        case 'tags' :

                            echo '<div class="post-meta-wrapper content-post-tags">';
                            real_home_posted_tags();
                            echo '</div><!-- .content-post-tags -->';

                            break;

                        case 'author-box' :
                            Real_Home_Helper::author_box();
                            break;

                        case 'related-posts' :
                            Real_Home_Helper::related_posts();
                            break;

                    endswitch;

                endforeach;
            endif;


            ?>
            <?php real_home_entry_footer(); ?>

            <?php
            /**
             * Functions hooked in to real_home_post_content_bottom action.
             *
             */
            do_action( 'real_home_post_footer_bottom' );
            ?>

        </footer><!-- .entry-footer -->

        <?php
    }
endif;


/* ------------------------------ PAGE CONTENT ------------------------------ */

if ( ! function_exists( 'real_home_page_post_header' ) ) :
    /**
     * Post Header
     */
    function real_home_page_post_header() {
        ?>
        <header class="entry-header">

            <?php
            /**
             * Functions hooked in to real_home_page_header_top action.
             */
            do_action( 'real_home_page_header_top' );
            ?>

            <?php
            $elements = get_theme_mod(
                'real_home_single_page_content_entry_header_elements',
                ['post-title']
            );

            if ( ! empty( $elements ) ) :
				$html_tag = get_theme_mod(
					'real_home_single_page_title_tag',
					['desktop' => 'h1']
				);
				the_title( '<' . esc_attr( $html_tag['desktop'] ) . ' class="entry-title">', '</' . esc_attr( $html_tag['desktop'] ) . '>' );
            endif;

            ?>

            <?php
            /**
             * Functions hooked in to real_home_page_header_bottom action.
             */
            do_action( 'real_home_page_header_bottom' );
            ?>

        </header><!-- .entry-header -->

        <?php
    }
endif;

if ( ! function_exists( 'real_home_page_content' ) ) :
    /**
     * Post Content
     */
    function real_home_page_content() {
        ?>
        <div class="entry-content">

            <?php
            /**
             * Functions hooked in to real_home_page_content_top action.
             *
             */
            do_action( 'real_home_page_content_top' );
            ?>

            <?php
            the_content(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'real-home' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            ?>

            <?php

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'real-home' ),
                    'after'  => '</div>',
                )
            );
            ?>

            <?php
            /**
             * Functions hooked in to real_home_page_content_bottom action.
             *
             */
            do_action( 'real_home_page_content_bottom' );
            ?>

        </div><!-- .entry-content -->

        <?php
    }
endif;

if ( ! function_exists( 'real_home_page_footer' ) ) :
    /**
     * Post Footer for extra elements
     */
    function real_home_page_footer() {

        ?>
        <footer class="entry-footer">

            <?php
            /**
             * Functions hooked in to real_home_page_footer_top action.
             *
             */
            do_action( 'real_home_page_footer_top' );
            ?>
            <?php
            $elements = get_theme_mod(
                'real_home_single_page_content_entry_footer_elements',
                ['post-comments']
            );

            if ( ! empty( $elements ) ) :
				Real_Home_Helper::post_comment();
            endif;
            ?>
            <?php real_home_entry_footer(); ?>

            <?php
            /**
             * Functions hooked in to real_home_page_footer_bottom action.
             *
             */
            do_action( 'real_home_page_footer_bottom' );
            ?>

        </footer><!-- .entry-footer -->

        <?php
    }
endif;

/* ------------------------------ 404 PAGE ------------------------------ */

/* ------------------------------ FOOTER ------------------------------ */

if ( ! function_exists( 'real_home_footer_back_to_top' ) ) :
    /**
     * Footer Back to Top
     */
    function real_home_footer_back_to_top() {
        $back_to_top = get_theme_mod(
                'real_home_footer_back_to_top_enable',
                ['desktop'=>'true']
        );
        if ( $back_to_top && array_key_exists( 'desktop', $back_to_top ) ) :
        ?>
        <div class="back-to-top">
            <button href="#masthead" title="<?php esc_attr_e('Go to Top','real-home'); ?>"><i class="fa fa-angle-up" aria-hidden="true"></i></button>
        </div><!-- .back-to-top -->
        <?php
        endif;
    }
endif;

/* ------------------------------ CONTENT ------------------------------ */
if ( ! function_exists( 'real_home_menu_fallback' ) ) :

	/**
	 * Menu fallback for primary menu.
	 *
	 * Contains wp_list_pages to display pages created,
	 */
	function real_home_menu_fallback() {
		$output  = '';
		$output .= '<div class="menu-top-menu-container">';
		$output .= '<ul id="primary-menu-list" class="menu-wrapper">';

		$output .= wp_list_pages(
			array(
				'echo'     => false,
				'title_li' => false,
			)
		);

		$output .= '</ul>';
		$output .= '</div>';

		// @codingStandardsIgnoreStart
		echo $output;
		// @codingStandardsIgnoreEnd
	}

endif;
