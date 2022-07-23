<?php
/**
 * Real Home hooks
 *
 * @package Real_Home
 */

/* ------------------------------ HEADER ------------------------------ */
/**
 * Meta head.
 *
 * @see real_home_head_meta()
 */
add_action( 'real_home_head', 'real_home_head_meta', 10 );


/**
 * Header Bottom Content
 *
 * @see real_home_header_featured_slider()
 * @see real_home_content_before_page_header()
 */
add_action( 'real_home_header_bottom', 'real_home_header_featured_slider', 10 );
add_action( 'real_home_header_bottom', 'real_home_content_before_page_header', 15 );



/* ------------------------------ BEFORE CONTENT ------------------------------ */
/**
 * Before Content of page
 *
 * @see real_home_content_before_wrapper_start()
 */
add_action( 'real_home_content_before', 'real_home_content_before_wrapper_start', 10 );

/* ------------------------------ AFTER CONTENT ------------------------------ */
/**
 * After Content of page
 *
 * @see real_home_content_after_wrapper_end()
 */
add_action( 'real_home_content_after', 'real_home_content_after_wrapper_end', 10 );

/* ------------------------------ BLOG/ARCHIVE PAGE ------------------------------ */

/**
 * After content loop
 *
 * @see real_home_posts_navigation()
 */
add_action( 'real_home_posts_content_loop_after', 'real_home_posts_navigation', 10 );

/**
 * Entry Header
 *
 * @see real_home_get_post_thumbnail()
 * @see real_home_blog_post_content()
 */
add_action( 'real_home_posts_content', 'real_home_get_post_thumbnail', 10 );
add_action( 'real_home_posts_content', 'real_home_blog_post_content', 10 );

/* ------------------------------ SEARCH PAGE ------------------------------ */

/**
 * Entry Header
 *
 * @see real_home_search_posts_header()
 */
add_action( 'real_home_search_posts_entry_header', 'real_home_search_posts_header', 10 );

/**
 * Entry Content
 *
 * @see real_home_search_posts_content()
 */
add_action( 'real_home_search_posts_entry_content', 'real_home_search_posts_content', 10 );

/**
 * Entry Footer
 *
 * @see real_home_search_posts_footer()
 */
add_action( 'real_home_search_posts_entry_footer', 'real_home_search_posts_footer', 10 );

/* ------------------------------ SINGLE POST ------------------------------ */

/**
 * Entry Header Content
 *
 * @see real_home_get_post_thumbnail()
 * @see real_home_post_header()
 */
add_action( 'real_home_post_entry_header', 'real_home_get_post_thumbnail', 10 );
add_action( 'real_home_post_entry_header', 'real_home_post_header', 15 );

/**
 * Entry Content
 *
 * @see real_home_post_content()
 */
add_action( 'real_home_post_entry_content', 'real_home_post_content', 10 );

/**
 * Entry Footer
 *
 * @see real_home_post_footer()
 */
add_action( 'real_home_post_entry_footer', 'real_home_post_footer', 10 );


/* ------------------------------ SINGLE PAGE ------------------------------ */

/**
 * Entry Header Content
 *
 * @see real_home_get_post_thumbnail()
 * @see real_home_page_post_header()
 */
add_action( 'real_home_page_entry_header', 'real_home_get_post_thumbnail', 10 );
add_action( 'real_home_page_entry_header', 'real_home_page_post_header', 15 );

/**
 * Entry Content
 *
 * @see real_home_page_content()
 */
add_action( 'real_home_page_entry_content', 'real_home_page_content', 10 );

/**
 * Entry Footer
 *
 * @see real_home_page_footer()
 */
add_action( 'real_home_page_entry_footer', 'real_home_page_footer', 10 );

/* ------------------------------ FOOTER ------------------------------ */
/**
 * Footer back to top
 *
 * @see real_home_footer_back_to_top()
 */
add_action( 'real_home_footer_after', 'real_home_footer_back_to_top', 10 );
