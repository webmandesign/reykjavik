/**
 * Theme frontend scripts
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.1.0
 */

( function( $ ) {
	'use strict';

	var
		$introMedia = $( document.getElementById( 'intro-media' ) );

	// Tell CSS that JS is enabled...
	$( '.no-js' )
		.removeClass( 'no-js' );

	// Fixing Recent Comments widget multiple appearances.
	$( '.widget_recent_comments ul' )
		.attr( 'id', '' );

	// Custom header.

		if ( $introMedia.length ) {
			$introMedia
				.parent( '.intro-special' )
					.addClass( 'intro-special-has-media' );
		}

		$( document )
			.on( 'wp-custom-header-video-loaded', function() {

				$introMedia
					.addClass( 'has-header-video' );

			} );

} )( jQuery );
