/**
 * Customizer custom controls scripts
 *
 * Customizer matrix radio fields.
 *
 * @subpackage  Customize
 *
 * @package    WebMan WordPress Theme Framework
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.7.0
 * @version  2.1.0
 */
( function( wp, $ ) {

	'use strict';

	$( wp.customize ).ready( function() {





		$( '.custom-radio-container' )
			.on( 'change', 'input', function() {

				// Processing

					$( this )
						.parent()
							.addClass( 'is-active' )
							.siblings()
							.removeClass( 'is-active' );

			} );





	} );
} )( wp, jQuery );
