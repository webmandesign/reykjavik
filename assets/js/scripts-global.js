/**
 * Theme frontend scripts
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 *
 * Contents:
 *
 * 10) Basics
 * 20) Content
 * 30) Custom header
 */





( function( $ ) {

	'use strict';





	/**
	 * 10) Basics
	 */

		var
			$breakpoints = ( 'undefined' !== typeof $reykjavikBreakpoints ) ? ( $reykjavikBreakpoints ) : ( { 'xl' : 1280 } ),
			$introMedia  = $( document.getElementById( 'intro-media' ) );



		/**
		 * Tell CSS that JS is enabled...
		 */

			$( '.no-js' )
				.removeClass( 'no-js' );



		/**
		 * Fixing Recent Comments widget multiple appearances
		 */

			$( '.widget_recent_comments ul' )
				.attr( 'id', '' );



		/**
		 * Back to top link
		 */

			if ( parseInt( $breakpoints['xl'] ) < window.innerWidth ) {

				$( '.back-to-top' )
					.on( 'click', function( e ) {

						// Processing

							// Scroll the page to top.
							$( 'html, body' )
								.animate( {
									scrollTop : 0
								}, 600 );

							// Reset focus on top of the page.
							$( 'body' )
								.attr( 'tabindex', 0 )
								.focus();

							// Do not alter URL in browser.
							return false;

					} );

			}



		/**
		 * Primary menu fallback
		 */

			$( '#menu-primary.menu-fallback .menu-item-has-children > a' )
				.append( ' <span class="expander" aria-hidden="true"></span>' );





	/**
	 * 20) Content
	 */

		/**
		 * Comment form improvements
		 *
		 * Set input fields placeholders from field labels.
		 */

			$( document.getElementById( 'commentform' ) )
				.find( 'input[type="text"], input[type="email"], input[type="url"], textarea' )
					.each( function( index, el ) {

						// Helper variables

							var
								$this = $( el );


						// Processing

							$this
								.attr( 'placeholder', $this.prev( 'label' ).text() )
								.prev( 'label' )
									.addClass( 'screen-reader-text' );

					} );





	/**
	 * 30) Custom header
	 */

		if ( $introMedia.length ) {
			$introMedia
				.parent( '.intro-special' )
					.addClass( 'intro-special-has-media' );
		}

		$( document )
			.on( 'wp-custom-header-video-loaded', function() {

				// Processing

					$introMedia
						.addClass( 'has-header-video' );

			} );





} )( jQuery );
