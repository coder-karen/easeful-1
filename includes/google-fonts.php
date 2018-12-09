<?php
/**
 * This file contains elements for theme internationalization.
 *
 * @package Easeful
 * @author Karen Attfield
 * @license GPL-2.0+
 */
add_action( 'wp_enqueue_scripts', 'easeful_enqueue_fonts' );
/**
 * Load fonts.
 *
 * @since 1.0.0
 */
function easeful_enqueue_fonts() {
	wp_enqueue_style( 'easeful-fonts', easeful_fonts_url(), array(), null );
}
/**
 * Build Google fonts URL.
 *
 * This function enqueues Google fonts in such a way that translators can easily turn on/off
 * the fonts if they do not contain the necessary character sets. Hat tip to Frank Klein for
 * the tutorial.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since  1.0.0
 */
function easeful_fonts_url() {
	$fonts_url = '';
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by this font, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'easeful' );
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by this font, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'easeful' );
	if ( 'off' !== $roboto || 'off' !== $open_sans ) {
		$font_families = array();
		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:400,700';
		}
		if ( 'off' !== $open_sans ) {
			$font_families[] = 'Open Sans:400,700';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}