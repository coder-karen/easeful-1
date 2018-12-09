<?php
/**
 * Front page for the Easeful theme
 *
 * @package Easeful 1
 * @author  Karen Attfield
 * @license GPL-2.0+
 */

add_action( 'genesis_meta', 'easeful_homepage_setup' );
/**
 * Set up the homepage layout by conditionally loading sections when widgets
 * are active.
 *
 * @since 1.0.0
 */
function easeful_homepage_setup() {

	$home_sidebars = array(
		'home_banner' 	   => is_active_sidebar( 'easeful-home-banner' ),
		'home_gallery_1'   => is_active_sidebar( 'easeful-home-gallery-1' ),
		'content_strip'   => is_active_sidebar( 'easeful-content-strip' ),
		'content_strip_2'   => is_active_sidebar( 'easeful-content-strip-2' ),
	);

	// Return early if no sidebars are active.
	if ( ! in_array( true, $home_sidebars ) ) {
		return;
	}

	// Get static home page number.
	$page = ( get_query_var( 'page' ) ) ? (int) get_query_var( 'page' ) : 1;

	// Only show home page widgets on page 1.
	if ( 1 === $page ) {

		// Add home welcome area if "Home Banner" widget area is active.
		if ( $home_sidebars['home_banner'] ) {
			add_action( 'genesis_after_header', 'easeful_add_home_banner' );
		}

		// Add home gallery area if "Home Gallery 1" widget area is active.
		if ( $home_sidebars['home_gallery_1'] ) {
			add_action( 'genesis_after_header', 'easeful_add_home_gallery' );
		}

		// Add content strip area if "Content Strip" widget area is active.
		if ( $home_sidebars['content_strip'] ) {
			add_action( 'genesis_after_header', 'easeful_add_content_strip' );
		}

		// Add a second content strip after content if "Home Pre Footer Content" widget area is active.
		if ( $home_sidebars['content_strip_2'] ) {
			add_action( 'genesis_before_footer', 'easeful_add_content_strip_2', 5 );
		}
	}

	// Full width layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remove standard loop and replace with loop showing Posts, not Page content.

//	remove_action( 'genesis_loop', 'genesis_do_loop' );
//	add_action( 'genesis_loop', 'easeful_front_loop' );
}

/**
 * Display content for the "Home Banner" section.
 *
 * @since 1.0.0
 */
function easeful_add_home_banner() {

	genesis_widget_area( 'easeful-home-banner',
		array(
			'before' => '<div class="home-banner"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

/**
 * Display content for the "Home Gallery" section.
 *
 * @since 1.0.0
 */
function easeful_add_home_gallery() {

	printf( '<div %s>', genesis_attr( 'home-gallery' ) );
	genesis_structural_wrap( 'home-gallery' );

	genesis_widget_area(
		'easeful-home-gallery-1',
		array(
			'before' => '<div class="home-gallery-1 widget-area">',
			'after'  => '</div>',
		)
	);

	genesis_widget_area(
		'easeful-home-gallery-2',
		array(
			'before' => '<div class="home-gallery-2 widget-area">',
			'after'  => '</div>',
		)
	);

	genesis_widget_area(
		'easeful-home-gallery-3',
		array(
			'before' => '<div class="home-gallery-3 widget-area">',
			'after'  => '</div>',
		)
	);
	genesis_widget_area(
		'easeful-home-gallery-4',
		array(
			'before' => '<div class="home-gallery-4 widget-area">',
			'after'  => '</div>',
		)
	);

	genesis_structural_wrap( 'home-gallery', 'close' );
	echo '</div>';
}

/**
 * Display content for the "Content Area" section.
 *
 * @since 1.0.0
 */
function easeful_add_content_strip() {

	genesis_widget_area(
		'easeful-content-strip',
		array(
			'before' => '<div class="content-strip"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

/**
 * Display content for the "Home Pre Footer Content" section.
 *
 * @since 1.0.0
 */
function easeful_add_content_strip_2() {

	genesis_widget_area(
		'easeful-content-strip-2',
		array(
			'before' => '<div class="content-strip-2"><div class="wrap">',
			'after' => '</div></div>',
		)
	);
}

/**
 * Display latest posts instead of static page.
 *
 * @since 1.0.0
 */
// function easeful_front_loop() {
// 	global $query_args;
// 	genesis_custom_loop( wp_parse_args( $query_args, array( 'post_type' => 'post', 'paged' => get_query_var( 'page' ) ) ) );
// }


genesis();