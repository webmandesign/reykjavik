/**
 * Beaver Builder page editor scripts
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 */





( function( $ ) {

	'use strict';

	if ( 'undefined' !== typeof $reykjavikBBPreview ) {





		/**
		 * Helper function to change custom class fields instantly
		 *
		 * @param  object fieldElement  The settings form field element that was changed.
		 */
		function BBPreviewSelectClass( fieldElement ) {

			// Helper variables

				var
					$field  = fieldElement.attr( 'name' ),
					$node   = fieldElement.closest( 'form.fl-builder-settings' ).data( 'node' ),
					$value  = fieldElement.val(),
					$target = $( '.fl-node-' + $node );


			// Processing

				// Remove all existing classes

					$target
						.removeClass( $reykjavikBBPreview[ $field ].join( ' ' ) );

				// Add selected class

					if ( $value ) {

						$target
							.addClass( $value );

					}

		} // /BBPreviewSelectClass



		$( 'body' )
			/**
			 * Trigger immediate preview: vertical alignment
			 */
			.delegate( '#fl-field-' + 'vertical_alignment' + ' select', 'change', function() {
				BBPreviewSelectClass( $( this ) );
			} );





	}

} )( jQuery );
