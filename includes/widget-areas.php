<?php
/**
 * Easeful
 *
 * @package      Easeful
 * @link         https://karenattfield.com
 * @author       Karen Attfield
 * @license      GPL-2.0+
 */

/**
 * Register the widget areas enabled by default in Utility.
 *
 * @since  1.0.0
 */
function easeful_register_widget_areas() {

	$widget_areas = array(
		// array(
		// 	'id'          => 'utility-bar',
		// 	'name'        => __( 'Utility Bar', 'easeful' ),
		// 	'description' => __( 'This is the utility bar across the top of page.', 'easeful' ),
		// ),
		array(
			'id'          => 'easeful-home-banner',
			'name'        => __( 'Home Banner', 'easeful' ),
			'description' => __( 'This is the welcome section at the top of the home page.', 'easeful' ),
		),
		array(
			'id'          => 'easeful-home-gallery-1',
			'name'        => sprintf( _x( 'Home Gallery %d', 'Group of Home Gallery widget areas', 'easeful' ), 1 ),
			'description' => sprintf( _x( 'Home Gallery %d widget area on home page.', 'Description of widget area', 'easeful' ), 1 ),
		),
		array(
			'id'          => 'easeful-home-gallery-2',
			'name'        => sprintf( _x( 'Home Gallery %d', 'Group of Home Gallery widget areas', 'easeful' ), 2 ),
			'description' => sprintf( _x( 'Home Gallery %d widget area on home page.', 'Description of widget area', 'easeful' ), 2 ),
		),
		array(
			'id'          => 'easeful-home-gallery-3',
			'name'        => sprintf( _x( 'Home Gallery %d', 'Group of Home Gallery widget areas', 'easeful' ), 3 ),
			'description' => sprintf( _x( 'Home Gallery %d widget area on home page.', 'Description of widget area', 'easeful' ), 3 ),
		),
		array(
			'id'          => 'easeful-home-gallery-4',
			'name'        => sprintf( _x( 'Home Gallery %d', 'Group of Home Gallery widget areas', 'easeful' ), 4 ),
			'description' => sprintf( _x( 'Home Gallery %d widget area on home page.', 'Description of widget area', 'easeful' ), 4 ),
		),
		array(
			'id'          => 'easeful-content-strip',
			'name'        => __( 'Widget Content Strip', 'easeful' ),
			'description' => __( 'This is the Widget Content Strip section on the home page.', 'easeful' ),
		),
				array(
			'id'          => 'easeful-content-strip-2',
			'name'        => __( 'Home Pre-footer Content', 'easeful' ),
			'description' => __( 'This is the Pre-footer Widget Content Strip section on the home page.', 'easeful' ),
		),
	);

	$widget_areas = apply_filters( 'easeful_default_widget_areas', $widget_areas );

	foreach ( $widget_areas as $widget_area ) {
		genesis_register_sidebar( $widget_area );
	}
}
