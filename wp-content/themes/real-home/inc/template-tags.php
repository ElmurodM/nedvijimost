<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Real_Home
 */

if ( ! function_exists( 'real_home_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function real_home_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		printf( '<div class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></div>', esc_url( get_permalink() ), $time_string ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'real_home_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function real_home_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'real-home' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		printf( '<div class="byline">%1$s</div>', $byline ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'real_home_posted_cats' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function real_home_posted_cats() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' ' );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<div class="post-cat-list"><span class="cat-links">%1$s</span></div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'real_home_posted_tags' ) ) :
	/**
	 * Prints HTML with meta information for the current tags.
	 */
	function real_home_posted_tags() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'real-home' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				if ( is_singular() ) {
					printf( '<div class="inner-post-tags-wrap"><label class="post-tags">%1$s</label></div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				else {
					printf( '<div class="post-tag-list"><span class="tag-links">%1$s</span></div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}
	}
endif;

if ( ! function_exists( 'real_home_entry_footer' ) ) :
	/**
	 * Footer edit post content
	 */
	function real_home_entry_footer() {

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'real-home' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'real_home_singular_post_thumbnail' ) ) :
	/**
	 * Displays singular an optional post thumbnail.
	 *
	 * @param string $size
	 * @param string $ratio
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function real_home_singular_post_thumbnail( $size = 'full', $ratio = '16x9', $post = null ) {

		if ( post_password_required() || is_attachment() ) {
			return;
		}
		if ( has_post_thumbnail() ) : ?>
			<figure class="featured-image" data-ratio="<?php echo esc_attr( $ratio ); ?>">
				<?php
				the_post_thumbnail(
					esc_html($size),
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</figure>
		<?php endif;
	}
endif;

if ( ! function_exists( 'real_home_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * @param string $size
	 * @param string $ratio
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function real_home_post_thumbnail( $size = 'full', $ratio = '16x9' ) {

		// Default Placeholder
		$placeholder_image = get_theme_mod(
			'real_home_placeholder_image',
			''
		);

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( has_post_thumbnail() ) : ?>
			<figure class="featured-image" data-ratio="<?php echo esc_attr( $ratio ); ?>">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
					the_post_thumbnail(
						esc_html($size),
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
					?>
				</a>
			</figure>
		<?php else : ?>
			<figure class="featured-image" data-ratio="<?php echo esc_attr( $ratio ); ?>">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php if ( $placeholder_image && $placeholder_image != '' ) : ?>
						<img src="<?php echo esc_url( $placeholder_image ); ?>" alt="<?php esc_attr_e( 'Placeholder Image', 'real-home' ); ?>" />
					<?php else: ?>
						<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==" alt="<?php esc_attr_e( 'Placeholder Image', 'real-home' ); ?>" />
					<?php endif; ?>
				</a>
			</figure>
		<?php endif;
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
