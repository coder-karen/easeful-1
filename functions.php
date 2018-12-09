<?php
/**
 * Easeful
 *
 * @package  Easeful
 * @author   StudioPress
 * @license  GPL-2.0+
 * @link     http://my.studiopress.com/themes/genesis/
 */

// Load internationalization components.
// English users do not need to load the text domain and can comment out or remove.
//load_child_theme_textdomain( 'easeful', get_stylesheet_directory() . '/languages' );

// This file loads the Google fonts used in this theme.
require get_stylesheet_directory() . '/includes/google-fonts.php';

// This file contains search form improvements.
require get_stylesheet_directory() . '/includes/search-form.php';

add_action( 'genesis_setup', 'easeful_setup', 15 );
/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function easeful_setup() {

	define( 'CHILD_THEME_NAME', __('Easeful', 'easeful'));
	define( 'CHILD_THEME_URL', 'https://karenattfield.com' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );

	// Add HTML5 markup structure.
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background.
	add_theme_support( 'custom-background', array( 'wp-head-callback' => '__return_false' ) );

	// Add support for three footer widget areas.
	add_theme_support( 'genesis-footer-widgets', 3 );

	// Add support for additional color style options.
	// add_theme_support(
	// 	'genesis-style-selector',
	// 	array(
	// 		'easeful-purple' => __( 'Purple', 'easeful' ),
	// 		'easeful-green'  => __( 'Green', 'easeful' ),
	// 		'easeful-red'    => __( 'Red', 'easeful' ),
	// 	)
	// );

	// Add support for structural wraps (all default Genesis wraps unless noted).
	add_theme_support(
		'genesis-structural-wraps',
		array(
			'footer',
			'footer-widgets',
			'footernav',    // Custom.
			'menu-footer',  // Custom.
			'header',
			'home-gallery', // Custom.
			'nav',
			'site-inner',
			'site-tagline',
		)
	);

	// Add support for two navigation areas (theme doesn't use secondary navigation).
	add_theme_support(
		'genesis-menus',
		array(
			'primary' => __( 'Primary Navigation Menu', 'easeful' ),
	//		'footer'  => __( 'Footer Navigation Menu', 'easeful' ),
		)
	);

	// Add custom image sizes.
	add_image_size( 'feature-large', 960, 330, true );

	// Unregister secondary sidebar.
	unregister_sidebar( 'sidebar-alt' );

	// Unregister layouts that use secondary sidebar.
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Register the default widget areas.
	easeful_register_widget_areas();

	// // Add Utility Bar above header.
	// add_action( 'genesis_before_header', 'easeful_add_bar' );

	// Add featured image above posts.
	add_filter( 'the_content', 'easeful_featured_image' );

	// // Add a navigation area above the site footer.
	// add_action( 'genesis_before_footer', 'easeful_do_footer_nav' );

	// // Remove Genesis archive pagination (Genesis pagination settings still apply).
	// remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

	// // Add WordPress archive pagination (accessibility).
	// add_action( 'genesis_after_endwhile', 'easeful_post_pagination' );

	// // Load accesibility components if the Genesis Accessible plugin is not active.
	// if ( ! easeful_genesis_accessible_is_active() ) {

	// 	// Load skip links (accessibility).
	// 	include get_stylesheet_directory() . '/includes/skip-links.php';
	// }

	// Apply search form enhancements (accessibility).
	//add_filter( 'get_search_form', 'easeful_get_search_form', 25 );



}




/**
 * Add Utility Bar above header.
 *
 * @since 1.0.0
 */
// function easeful_add_bar() {

// 	genesis_widget_area( 'utility-bar', array(
// 		'before' => '<div class="utility-bar"><div class="wrap">',
// 		'after'  => '</div></div>',
// 	) );
// }

/**
 * Add featured image above single posts.
 *
 * Outputs image as part of the post content, so it's included in the RSS feed.
 * H/t to Robin Cornett for the suggestion of making image available to RSS.
 *
 * @since 1.0.0
 *
 * @param string $content Post content.
 *
 * @return null|string Return early if not a single post or there is no thumbnail.
 *                     Image and content markup otherwise.
 */
function easeful_featured_image( $content ) {

	if ( ! is_singular( 'post' ) || ! has_post_thumbnail() ) {
		return $content;
	}

	$image = '<div class="featured-image">';
	$image .= get_the_post_thumbnail( get_the_ID(), 'feature-large' );
	$image .= '</div>';

	return $image . $content;
}

add_filter( 'genesis_footer_creds_text', 'easeful_footer_creds' );
/**
 * Change the footer text.
 *
 * @since  1.0.0
 *
 * @param string $creds Existing credentials.
 *
 * @return string Footer credentials, as shortcodes.
 */
function easeful_footer_creds( $creds ) {

	return 'Copyright [footer_copyright] &middot; <a href="https://karenattfield.com">Easeful</a>';
}

// add_filter( 'genesis_author_box_gravatar_size', 'easeful_author_box_gravatar_size' );
// *
//  * Customize the Gravatar size in the author box.
//  *
//  * @since 1.0.0
//  *
//  * @param int $size Existing pixel size of gravatar.
//  *
//  * @return int Pixel size of gravatar.
 
// function easeful_author_box_gravatar_size( $size ) {
// 	return 96;
// }

// Add theme widget areas.
include get_stylesheet_directory() . '/includes/widget-areas.php';

// Add footer navigation components.
include get_stylesheet_directory() . '/includes/footer-nav.php';

// Add scripts to enqueue.
include get_stylesheet_directory() . '/includes/enqueue-assets.php';

// Enable shortcodes in widgets.
add_filter( 'widget_text', 'do_shortcode' );

// Miscellaenous functions used in theme configuration.
//include get_stylesheet_directory() . '/includes/theme-config.php';

/**
 * Customize the search form to improve accessibility.
 *
 * The instantiation can accept an array of custom strings, should you want
 * the search form have different strings in different contexts.
 *
 * @since 1.0.0
 *
 * @return string Search form markup.
 */
function easeful_get_search_form() {
	$search = new Easeful_Search_Form;
	return $search->get_form();
}

/**
 * Use WordPress archive pagination.
 *
 * Return a paginated navigation to next/previous set of posts, when
 * applicable. Includes screen reader text for better accessibility.
 *
 * @since  1.0.0
 *
 * @see the_posts_pagination()
 */
function easeful_post_pagination() {
	$args = array(
		'mid_size' => 2,
		'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'utility-pro' ) . ' </span>',
	);

	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		the_posts_pagination( $args );
	} else {
		the_posts_navigation( $args );
	}
}
