/**
 * Customize preview scripts
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  10) WordPress options
 * 100) Helpers
 */





/**
 * 10) WordPress options
 */
( function( $ ) {

	'use strict';





	/**
	 * Site title and description
	 */

		wp.customize( 'blogname', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						$( '.site-title' )
							.text( to );

					} );

		} ); // /blogname

		wp.customize( 'blogdescription', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						$( '.site-description' )
							.text( to );

					} );

		} ); // /blogdescription

		wp.customize( 'header_textcolor', function( value ) {

			// Processing

				value
					.bind( function( to ) {

						if ( 'blank' === to ) {

							$( '.site-title, .site-description' )
								.css( {
									'clip'     : 'rect(1px, 1px, 1px, 1px)',
									'position' : 'absolute',
								} );

							$( 'body' )
								.addClass( 'site-title-hidden' );

						} else {

							$( '.site-title, .site-description' )
								.css( {
									'clip'     : 'auto',
									'position' : 'relative',
								} );

							$( 'body' )
								.removeClass( 'site-title-hidden' );

						}

					} );

		} ); // /header_textcolor





} )( jQuery );





/**
 * 100) Helpers
 */
( function( window ) {

	'use strict';

	window.reykjavik = window.reykjavik || {};

	/**
	 * Theme customizer preview helper
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	window.reykjavik.Customize = {





		/**
		 * Convert hex color into rgb array
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		hexToRgb : function( $hex = '' ) {

			// Processing

				var
					$rgb = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( $hex );


			// Output

				return ( $rgb ) ? ( [
						parseInt( $rgb[1], 16 ),
						parseInt( $rgb[2], 16 ),
						parseInt( $rgb[3], 16 )
					] ) : ( [] );

		}, // /hexToRgb



		/**
		 * Convert hex color into rgb array
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		hexToRgbJoin : function( $hex = '' ) {

			// Output

				return this.hexToRgb( $hex ).join();

		} // /hexToRgb





	} // /Customize

} )( window );
