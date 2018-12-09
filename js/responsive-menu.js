/* global easefulResponsiveL10n:false */
( function( window, $, undefined ) {
	'use strict';
	var primaryButton, subMenuButton;

	primaryButton = $( '<button>' + easefulResponsiveL10n.buttonText + '</button>' )
		.attr( 'role', 'button' )
		.attr( 'aria-pressed', false )
		.attr( 'aria-expanded', false )
		.attr( 'aria-controls', $( '.menu-primary' ).attr( 'id' ) )
		.attr( 'aria-label', easefulResponsiveL10n.buttonLabel )
		.attr( 'class', 'menu-toggle menu-toggle-primary' );
	$( '.menu-primary' ).before( primaryButton );

	// Sub-level menu items
	subMenuButton = $( '<button>' + easefulResponsiveL10n.subButtonText + '</button>' )
		.attr( 'role', 'button' )
		.attr( 'aria-pressed', false )
		.attr( 'aria-label', easefulResponsiveL10n.subButtonLabel )
		.attr( 'class', 'menu-toggle sub-menu-toggle' );
	$( '.sub-menu' ).before( subMenuButton );

	// Show/hide the navigation
	$( '.menu-toggle, .sub-menu-toggle' ).on( 'click.easeful', function() {
		var $button = $( this ),
			state = 'false' === $button.attr( 'aria-pressed' ) ? true : false;

		$button.attr( 'aria-pressed', state).toggleClass( 'menu-toggle-activated' );
		// Only toggle aria-expanded if top level button
		if ( $button.is( '[aria-controls]' ) ) {
			$button.attr( 'aria-expanded', state );
		}

		$button.next( '.menu-primary, .sub-menu' ).slideToggle( 'fast' ).attr( 'aria-hidden', ! state );
	});
})( this, jQuery );