<?php
/**
 * Real Home Helper functions
 *
 * @package Real_Home
 */

class Real_Home_Helper {

    /**
     * Get an array of terms from a taxonomy.
     *
     * @static
     * @access public
     * @param string|array $taxonomies See https://developer.wordpress.org/reference/functions/get_terms/ for details.
     * @param bool $choice
     * @return array
     */
    public static function get_terms( $taxonomies, $choice = true ) {
        $items = [];

        // Get the post types.
        $terms = get_terms(
            array(
                'taxonomy'   => $taxonomies,
                'hide_empty' => true,
            )
        );

        // Build the array.
        if ( $terms ) {
            if ( $choice == true ) {
                $items[0]   = esc_html__( '--- choose ---', 'real-home');
            }
            foreach ( $terms as $term ) {
                $items[ $term->slug ] = esc_html($term->name);
            }
        }
        else {
            $items[0]   = esc_html__( 'Item Not Found...', 'real-home');
        }

        return $items;
    }

	/**
	 * Get an array of posts.
	 *
	 * @static
	 * @access public
	 * @param array $args Define arguments for the get_posts function.
	 * @return array
	 */
	public static function get_posts( $args ) {
		if ( is_string( $args ) ) {
			$args = add_query_arg(
				array(
					'suppress_filters' => false,
				)
			);
		} elseif ( is_array( $args ) && ! isset( $args['suppress_filters'] ) ) {
			$args['suppress_filters'] = false;
		}

		// Get the posts.
		// TODO: WordPress.VIP.RestrictedFunctions.get_posts_get_posts.
		$posts = get_posts( $args );

		// Properly format the array.
		$items = array();
		foreach ( $posts as $post ) {
			$items[ $post->ID ] = $post->post_title;
		}
		wp_reset_postdata();

		return $items;
	}

    /**
     * Get data columns with values.
     *
     * @access public
     * @param array $values
     * @return void
     */
    public static function get_data_columns( $values = [] ) {

        ob_start();

        if ( ! empty( $values ) ) {

            // Base or Mobile
            echo isset( $values['mobile'] )
                ? ' data-columns="' . esc_attr( $values['mobile'] ) .'"'
                : ( isset( $values['tablet'] )
                    ? ' data-columns="' . esc_attr( $values['tablet'] ) .'"'
                    : ( isset( $values['desktop'] )
                        ? ' data-columns="' . esc_attr( $values['desktop'] ) .'"'
                        : ''
                    )
                );
            // Tablet
            echo isset( $values['tablet'] ) && isset( $values['mobile'] )
                ? ' data-columns-md="' . esc_attr( $values['tablet'] ) .'"'
                : ( isset( $values['desktop'] ) && isset( $values['tablet'] )
                    ? ' data-columns-md="' . esc_attr( $values['desktop'] ) .'"'
                    : ''
                );
            // Desktop
            echo isset( $values['desktop'] ) && isset( $values['tablet'] ) && isset( $values['mobile'] )
                ? ' data-columns-lg="' . esc_attr( $values['desktop'] ) .'"'
                : '';
        }

        $output = ob_get_clean();

        echo apply_filters( 'real_home_get_data_columns', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Page Header
     *
     * @access public
     * @return void
     */
    public static function page_header() {

        if ( is_page() ){
            the_title('<h2 class="page-title">', '</h2>');
        }
        elseif ( is_404() ) {
            echo '<h2 class="page-title">' . esc_html__( '404 Page','real-home' ) . '</h2>';
        }
        elseif ( is_single() ) {
            the_title('<h2 class="page-title">', '</h2>');
        }
        elseif ( is_home() ) {

            echo '<h2 class="page-title">' . esc_html__( 'Blog','real-home' ) . '</h2>';
        }
        elseif( is_search() ) {

            printf( '<h2 class="page-title">%s</h2>', get_search_query() );
        }
        else {
            the_archive_title( '<h2 class="page-title">', '</h2>' );
        }
    }

    /**
     * Social Network Lists
     *
     * @access public
     * @return array
     */
    public static function social_network_list() {
        return [
            'facebook'		=> esc_html__( 'Facebook', 'real-home' ),
            'twitter'		=> esc_html__( 'Twitter', 'real-home' )
        ];
    }
    /**
     * Retrieves the post meta.
     *
     * @param int    $post_id The ID of the post.
     * @param null|array $meta_list custom post meta list
     * @return void
     */
    public static function post_meta( $post_id = null, $meta_list = null )  {

        // Require post ID.
        if ( ! $post_id ) {
            return;
        }

        /**
         * Filters post types array.
         *
         * @param array Array of post types
         */
        $disallowed_post_types = apply_filters( 'real_home_disallowed_post_meta', array( 'page' ) );

        // Check whether the post type is allowed to output post meta.
        if ( in_array( get_post_type( $post_id ), $disallowed_post_types, true ) ) {
            return;
        }

        if ( 'property' == get_post_type() ) {
            $post_meta = $meta_list ? $meta_list : get_theme_mod(
                'real_home_property_single_post_meta_elements',
                ['author','post-date']
            );
        }
        else {
            $post_meta = $meta_list ? $meta_list : get_theme_mod(
                'real_home_single_post_meta_elements',
                ['author','post-date']
            );
        }

        // If the post meta setting has the value 'empty', it's explicitly empty and the default post meta shouldn't be output.
        if ( $post_meta && ! in_array( 'empty', $post_meta, true ) ) {

            // Make sure we don't output an empty container.
            $has_meta = false;

            global $post;
            $the_post = get_post( $post_id );
            setup_postdata( $the_post );
            ob_start();
            ?>
            <ul class="post-meta d-flex flex-wrap">

                <?php
                /**
                 * Fires before post meta HTML display.
                 *
                 * Allow output of additional post meta info to be added by child themes and plugins.
                 *
                 * @param int    $post_id   Post ID.
                 * @param array  $post_meta An array of post meta information.
                 */
                do_action( 'real_home_before_post_meta_list', $post_id, $post_meta );
                ?>

				<?php foreach ( $post_meta as $meta ) : ?>

					<?php if ( post_type_supports( get_post_type( $post_id ), 'author' ) && in_array( 'author', $post_meta, true ) && $meta == 'author' ) : $has_meta = true; // author ?>
						<li class="post-author meta-wrapper d-flex">
							<?php
							$author_url     = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
							$author_avatar  = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'real_home_meta_avatar_size', 25 ) );
							?>
							<span class="meta-icon">
                            <span class="screen-reader-text"><?php esc_html_e( 'Post author', 'real-home' ); ?></span>
                            <figure class="author-avatar">
								<a href="<?php echo esc_url( $author_url ); ?>" rel="<?php esc_attr_e( 'Author', 'real-home'); ?>"><?php echo wp_kses_post( $author_avatar ); ?></a>
							</figure><!-- .author-avatar -->
							</span>
								<span class="meta-text">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
							</span>
						</li>

					<?php elseif ( in_array( 'post-date', $post_meta, true ) && $meta == 'post-date' ) : $has_meta = true; $date_format = get_option( 'date_format' ); $published_date = esc_html( get_the_date( $date_format ) );// post date ?>
						<li class="post-date meta-wrapper d-flex">
							<span class="meta-text">
								<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
							</span>
						</li>

					<?php elseif ( in_array( 'categories', $post_meta, true ) && $meta == 'categories' && has_category() ) : $has_meta = true; // Categories ?>
						<li class="post-categories meta-wrapper d-flex">
							<span class="meta-text">
								<?php the_category( ', ' ); ?>
							</span>
						</li>

					<?php
					$status_terms = wp_get_post_terms( get_the_ID(), 'property-status', [ 'orderby' => 'term_order' ] ); // Property Status
					elseif ( in_array( 'status', $post_meta, true ) && $meta == 'status' && $status_terms  ) : $has_meta = true; ?>
						<li class="post-categories meta-wrapper d-flex">
						<span class="meta-text">
							<?php
							echo wp_kses(
								get_the_term_list( get_the_ID(), 'property-status', '', ', ' ),
								array(
									'a' => array(
										'href' => array(),
										'rel' => array(),
									),
								)
							);
							?>
						</span>
						</li>
					<?php
						$type_terms = wp_get_post_terms( get_the_ID(), 'property-type', [ 'orderby' => 'term_order' ] ); // Property Types
					elseif ( in_array( 'types', $post_meta, true ) && $meta == 'types' && $type_terms  ) : $has_meta = true; ?>
						<li class="post-categories meta-wrapper d-flex">
						<span class="meta-text">
							<?php
							echo wp_kses(
								get_the_term_list( get_the_ID(), 'property-type', '', ', ' ),
								array(
									'a' => array(
										'href' => array(),
										'rel' => array(),
									),
								)
							);
							?>
						</span>
						</li>

						<?php
						$location_terms = wp_get_post_terms( get_the_ID(), 'property-location', [ 'orderby' => 'term_order' ] ); // Property Location
					elseif ( in_array( 'location', $post_meta, true ) && $meta == 'location' && $location_terms  ) : $has_meta = true; ?>
						<li class="post-categories meta-wrapper d-flex">
						<span class="meta-text">
							<?php
							echo wp_kses(
								get_the_term_list( get_the_ID(), 'property-location', '', ', ' ),
								array(
									'a' => array(
										'href' => array(),
										'rel' => array(),
									),
								)
							);
							?>
						</span>
						</li>

						<?php
					elseif ( in_array( 'tags', $post_meta, true ) && $meta == 'tags' && has_tag() ) : $has_meta = true; ?>
						<li class="post-tags meta-wrapper d-flex">
							<span class="meta-text">
								<?php the_tags( '', ', ', '' ); ?>
							</span>
						</li>

					<?php elseif ( in_array( 'comments', $post_meta, true ) && ! post_password_required() && ( comments_open() || get_comments_number() ) && $meta == 'comments' ) : $has_meta = true; // Comments ?>
						<li class="post-comment-link meta-wrapper d-flex">
							<span class="meta-text">
								<?php comments_popup_link(); ?>
							</span>
						</li>

					<?php endif; ?>

				<?php endforeach; ?>

            </ul><!-- .post-meta -->
            <?php

        }

    }

    /**
     * Returns sidebar layout value
     *
     * @param string $sidebar default sidebar value is none
     * @return string $sidebar
     */
    public static function get_sidebar_layout( $sidebar = 'none' ) {

        $post_id = get_the_ID();

        // Blog Page ID
        $page_for_posts = get_option( 'page_for_posts' );
        if ( is_home() && $page_for_posts ) {
            $post_id = $page_for_posts;
        }

        // Check meta first to override and return (prevents filters from overriding meta)
        $meta = get_post_meta( $post_id, 'cre_global_sidebar_layout', true );

        if ( $post_id && $meta && $meta != 'default' ) {

            return $meta;
        }

        // Bail if static blog page or archive page
        if ( is_front_page() && is_home() || is_home() || is_search() || is_archive() ) {

            $sidebar = get_theme_mod( 'real_home_blog_sidebar_layout', 'right' );

            if ( is_post_type_archive( 'property' )
                || is_post_type_archive( 'agent' )
                || is_post_type_archive( 'agency' )
                || is_tax( 'property-location' )
                || is_tax( 'property-type' )
				|| is_tax( 'property-status' )
			) {

                $sidebar = 'none';
            }
        }
        // Bail if single page
        elseif ( is_page() ) {

            if ( is_page_template( 'page-templates/location.php' ) ) {
                $sidebar = 'none';
            }
            else {
				$sidebar = get_theme_mod( 'real_home_single_page_sidebar_layout', 'right' );
			}
        }
        // Bail if single Post
        elseif ( is_single() ) {

            if ( 'post' == get_post_type() ) {

                $sidebar = get_theme_mod( 'real_home_single_post_sidebar_layout', 'right' );
            }
            else {

                $sidebar = 'none';
            }
        }

        return $sidebar;
    }

    /**
     * Post Comment template
     *
     * @return void
     */
    public static function post_comment() {
        // If comments are open or we have at least one comment, load up the comment template.
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
            comments_template();
        endif;
    }

    /**
     * Post Navigation
     *
     * @return void
     */
    public static function post_navigation() {

        // Only display for single post navigation
        if ( ! is_single() ) {
            return;
        }

        $next_post = get_next_post();
        $prev_post = get_previous_post();

        if ( $next_post || $prev_post ) {

            $pagination_classes = '';

            if ( ! $next_post ) {
                $pagination_classes = ' only-one only-prev';
            } elseif ( ! $prev_post ) {
                $pagination_classes = ' only-one only-next';
            }

            ?>

            <nav class="navigation post-navigation section-inner<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Post', 'real-home' ); ?>" role="navigation">

                <h2 class="screen-reader-text"><?php esc_html_e('Post navigation','real-home'); ?></h2>

                <div class="nav-links">

                    <?php
                    if ( $prev_post ) {
                        ?>
                        <div class="nav-previous text-left">
                            <span class="screen-reader-text"><?php esc_html_e( 'Previous Post', 'real-home' ); ?></span>
                            <a class="previous-post" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                                <div class="nav-content-wrap">
                                    <span class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                                </div><!-- .nav-content-wrap -->
                            </a>
                        </div><!-- .nav-previous -->
                        <?php
                    }

                    if ( $next_post ) {
                        ?>
                        <div class="nav-next text-right">
                            <span class="screen-reader-text"><?php esc_html_e( 'Next Post', 'real-home' ); ?></span>
                            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="prev">
                                <div class="nav-content-wrap">
                                    <span class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                                </div><!-- .nav-content-wrap -->
                            </a>
                        </div><!-- .nav-next -->
                        <?php
                    }
                    ?>

                </div><!-- .pagination-single-inner -->
            </nav><!-- .pagination-single -->

            <?php
        }



    }

    /**
     * Post Pagination
     *
     * @return void
     */
    public static function post_pagination() {

        global $wp_query;

        // Don't print empty markup if there is only one page.
        if ($wp_query->max_num_pages < 2) {
            return;
        }

        $pagination_type = get_theme_mod(
            'real_home_blog_pagination_type',
            'nxt-prv'
        );

        if ( $pagination_type ) :

            ob_start();

            echo '<div class="pagination-wrap pagination-' . esc_attr( $pagination_type ) . '">';

            switch ( $pagination_type ) :

                case 'nxt-prv' :

                    the_posts_navigation();

                    break;

                case 'numeric' :

                    the_posts_pagination();

                    break;

            endswitch;

            echo '</div><!-- .pagination-wrap -->';

            $output = ob_get_clean();

            echo apply_filters('real_home_pagination_markup', $output); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        endif;
    }

    /**
     * Author Box
     *
     * @return void
     */
    public static function author_box() {

        // Only display for standard posts
        if ( 'post' != get_post_type() ) {
            return;
        }

        // Get author data
        $author             = get_the_author();
        $author_description = get_the_author_meta( 'description' );
        $author_url         = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
        $author_avatar      = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'real_home_avatar_size', 150 ) );
        $author_contents 	= ['name','info'];
        ?>

        <div class="contact-agent-section">
            <div class="contact-agent-info-wrap">
                <div class="contact-agent-info">

                    <figure class="author-image" data-ratio="auto">
                        <a href="<?php echo esc_url( $author_url ); ?>" rel="<?php esc_attr_e( 'Author', 'real-home'); ?>"><?php echo wp_kses_post( $author_avatar ); ?></a>
                    </figure><!-- .author-avatar -->

                    <?php if ( $author_contents ) : ?>
                        <div class="contact-agent-info-content">

                            <?php foreach ( $author_contents as $content ) :

                                switch ( $content ) :
                                    case 'name' :
                                        ?>
                                        <h3 class="author-name"><a href="<?php echo esc_url( $author_url ); ?>" class="author-name" rel="<?php esc_attr_e( 'Author', 'real-home'); ?>"><?php echo esc_html( $author ); ?></a></h3>
                                        <?php
                                        break;

                                    case 'info' :
                                        ?>
                                        <div class="author-desc">
                                            <?php echo wp_kses_post( wpautop( $author_description ) ); ?>
                                        </div>
                                        <?php
                                        break;
                                endswitch;
                            endforeach; ?>
                        </div><!-- .contact-agent-info-content -->
                    <?php endif; ?>
                </div><!-- .contact-agent-info -->
            </div><!-- .contact-agent-info-wrap -->
        </div><!-- .contact-agent-section -->
        <?php
    }

    /**
     * Related Posts
     *
     * @return void
     */
    public static function related_posts() {
        // Only display for standard posts
        if ( 'post' != get_post_type() ) {
            return;
        }

        global $post;
        $current_post       = $post;
        $args               = [];

        // Categories arguments
        $cats   = wp_get_post_categories( $post->ID, [ 'fields' => 'ids' ] );
        if ( ! empty( $cats ) ) {
            $args['posts_per_page']         = 4;
            $args['post__not_in']           = [ $current_post->ID ];
            $args['category__in']           = $cats;
            $args['no_found_rows']          = true;
            $args['ignore_sticky_posts']    = true;
        }

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :

            // Columns per row
            $col_per_row = [
                'desktop'           => '2',
                'tablet'            => '2',
                'mobile'            => '1'
            ];
            ?>

            <div class="related-post-section">
                <header class="entry-header heading">
                    <h2 class="entry-title"><?php esc_html_e( 'Related Posts', 'real-home' ); ?></h2>
                </header>
                <div class="row columns"<?php Real_Home_Helper::get_data_columns( $col_per_row );?>>

                    <?php while ( $the_query->have_posts() ) : $the_query->the_post();

                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        ?>
                        <div class="column">
                            <div class="post">
                                <?php real_home_post_thumbnail( 'medium', '4x3' ); ?>

                                <div class="post-detail-wrap">

                                    <div class="entry-meta">
                                        <?php real_home_posted_cats(); ?>
                                        <?php real_home_posted_by(); ?>
                                    </div><!-- .property-meta-info -->

                                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                                    <div class="entry-content">
                                        <?php self::post_excerpt(); ?>
                                    </div><!-- .entry-content -->

                                    <?php real_home_posted_on(); ?>

                                </div><!-- .post-detail-wrap -->
                            </div>
                        </div>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                </div>
            </div><!-- .related-post-wrapper -->
        <?php
        endif;

    }

    /**
     * Post Title
     *
     * @return void
     */
    public static function post_title() { ?>
        <header class="entry-header">

            <?php
            if ( is_singular() ) :

                $html_tag = is_single() ? get_theme_mod('real_home_single_post_title_tag',['desktop' => 'h1'] ) : get_theme_mod( 'real_home_single_page_title_tag', ['desktop' => 'h1'] );

                the_title( '<' . esc_attr( $html_tag['desktop'] ) . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' . esc_attr( $html_tag['desktop'] ) . '>' );

            else :
                $html_tag = get_theme_mod(
                    'real_home_blog_post_title_tag',
                    ['desktop' => 'h2']
                );
                the_title( '<' . esc_attr( $html_tag['desktop'] ) . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' . esc_attr( $html_tag['desktop'] ) . '>' );
            endif;
            ?>

        </header><!-- .entry-header -->
        <?php

    }

    /**
     * Post Content
     *
     * @return void
     */
    public static function post_content() { ?>
        <div class="entry-content">

            <?php
            if ( is_singular() && !Real_Home_Helper::front_page_enable() ) :

                the_content();
            else :
                self::post_excerpt();
            endif;
            ?>

        </div><!-- .entry-content -->
        <?php

    }

    /**
     * Post Read More Button
     *
     * @return void
     */
    public static function read_more() {

        $btn_type = get_theme_mod(
            'real_home_blog_post_read_btn_type',
            ['desktop'=>'text']
        );
        $enable_arrow = get_theme_mod(
            'real_home_blog_post_read_more_btn_arrow',
            ''
        );

        $read_more_class = ['read-more'];

        if ( $btn_type && $btn_type['desktop'] == 'button' ) {
            $read_more_class[] = 'read-more-button';
        }

        if ( $enable_arrow && array_key_exists( 'desktop' , $enable_arrow ) ) {
            $read_more_class[] = 'd-flex align-items-center';
        }
        ob_start(); ?>

        <div class="d-flex justify-content-left read-more-wrap">
            <a href="<?php the_permalink( get_the_ID() ); ?>" class="<?php echo esc_attr( implode( ' ', $read_more_class ) ); ?>">
                <?php esc_html_e( 'Read More', 'real-home' ); ?>
                <?php if ( $enable_arrow && array_key_exists( 'desktop' , $enable_arrow ) ) : ?>
                    <?php Real_Home_Font_Awesome_Icons::get_icon( 'ui', 'fa-arrow-right'); ?>
                <?php endif; ?>

            </a>
        </div>

        <?php
        $output = ob_get_clean();
        echo apply_filters( 'real_home_read_more', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    /**
     * Post Excerpt
     *
     * @return void
     */
    public static function post_excerpt() {

        $excerpt = wp_trim_words( get_the_excerpt( get_the_ID() ), '20', '...' );
        echo wp_kses_post(wpautop($excerpt));
    }
    /**
     * Function to return the boolean value if 'static front page' is enabled or not.
     *
     *
     * @return boolean
     */
    public static function front_page_enable() {

        $is_static_page     = get_theme_mod( 'real_home_front_page_enable', 'disable' );
        $show_front_page    = get_option( 'show_on_front' );
        if ( is_front_page() && $show_front_page == 'page' && $is_static_page == 'enable' ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Function to return the boolean value if `Crucial Real State` plugin is activated or not.
     *
     * @return boolean
     */
    public static function crucial_real_state_plugin() {

        if ( class_exists( 'Crucial_Real_Estate' ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Add the classes into site content.
     *
     * @param string|array $class One or more classes to add to the class list.
     * @return void
     */
    public static function site_content_class(  $class = '' ) {

        $classes    = ['site-content'];

        if ( is_active_sidebar( 'sidebar-1' )
            && Real_Home_Helper::get_sidebar_layout() != 'none'
            && !Real_Home_Helper::front_page_enable()
        ) {
            $classes[] = 'have-sidebar';
        }

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }

        $classes = array_map( 'sanitize_html_class', $classes );

        /**
         * Filter site content class names
         */
        $classes = apply_filters( 'real_home_site_content_class', $classes, $class );

        $classes = array_unique( $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"'; // WPCS: XSS ok.
    }

    /**
     * Add the classes into sidebar widget area
     *
     * @param string|array $class One or more classes to add to the class list.
     * @return void
     */
    public static function sidebar_class(  $class = '' ) {

        $classes    = ['widget-area'];

        if ( is_active_sidebar( 'sidebar-1' ) && Real_Home_Helper::get_sidebar_layout() ) {

            $classes[] = '' . self::get_sidebar_layout() . '-sidebar';
        }

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }

        $classes = array_map( 'sanitize_html_class', $classes );

        /**
         * Filter sidebar class names
         */
        $classes = apply_filters( 'real_home_sidebar_class', $classes, $class );

        $classes = array_unique( $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"'; // WPCS: XSS ok.
    }


    /**
     * Add the classes into page site
     *
     * @param string|array $class One or more classes to add to the class list.
     * @return void
     */
    public static function site_class(  $class = '' ) {

        $classes = ['site'];

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }

        $classes = array_map( 'sanitize_html_class', $classes );

        /**
         * Filter site class names
         */
        $classes = apply_filters( 'real_home_site_class', $classes, $class );

        $classes = array_unique( $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"'; // WPCS: XSS ok.
    }

    /**
     * Add the classes into primary div
     *
     * @param string|array $class One or more classes to add to the class list.
     * @return void
     */
    public static function primary_class(  $class = '' ) {

        $classes = ['content-area'];

        if ( ! empty( $class ) ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_merge( $classes, $class );
        } else {
            // Ensure that we always coerce class to being an array.
            $class = array();
        }

        $classes = array_map( 'sanitize_html_class', $classes );

        /**
         * Filter primary class names
         */
        $classes = apply_filters( 'real_home_primary_class', $classes, $class );

        $classes = array_unique( $classes );

        echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"'; // WPCS: XSS ok.
    }
}


