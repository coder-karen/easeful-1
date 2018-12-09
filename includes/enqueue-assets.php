<?php
/**
 * Easeful.
 *
 * @package      Easeful
 * @link         https://karenattfield.com
 * @author       Karen Attfield
 * @license      GPL-2.0+
 */

add_action( 'wp_enqueue_scripts', 'easeful_enqueue_scripts_styles' );
/**
 * Enqueue theme assets.
 *
 * @since 1.0.0
 */
function easeful_enqueue_scripts_styles() {



	wp_enqueue_script( 'easeful-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );

	$output = array(
		'buttonText'     => __( ' Menu', 'easeful' ),
		'buttonLabel'    => __( 'Primary Navigation Menu', 'easeful' ),
		'subButtonText'  => __( '', 'easeful' ),
		'subButtonLabel' => __( 'Sub Navigation Menu', 'easeful' ),
	);
	wp_localize_script( 'easeful-responsive-menu', 'easefulResponsiveL10n', $output );

	/*A modified version of the Keyboard Accessible Dropdown Menus Plugin by  Amy Hendrix and = Graham Armfield
	Code at https://github.com/RRWD/wpacc-genesis-dropdown - thanks to Rian Rietveld */
	wp_enqueue_script( 'wpacc-dropdown',   get_stylesheet_directory_uri() . '/js/wpacc-dropdown.js' , array( 'jquery' ), false, true );

	wp_enqueue_script( 'easeful-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '2.0.1', true );
	wp_enqueue_script( 'easeful-backstretch-args', get_stylesheet_directory_uri() . '/js/backstretch.args.js', array( 'easeful-backstretch' ), CHILD_THEME_VERSION, true );

	wp_localize_script( 'easeful-backstretch-args', 'easefulBackstretchL10n', array( 'src' => get_background_image() ) );


}