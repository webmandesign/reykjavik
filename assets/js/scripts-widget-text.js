/**
 * Custom Text widget scripts
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 */





( function( $ ) {

	'use strict';





		/**
		 * Image uploader
		 */

			$( document )
				.on( 'click', '.text-widget-media-image-select', function( e ) {
					e.preventDefault();

					// Helper variables

						var
							$button     = $( this ),
							$file_frame = wp.media.frames.file_frame = wp.media( {
								library  : {
									type : 'image'
								},
								multiple : false
							} );


					// Processing

						$file_frame
							.on( 'select', function() {

									var
										attachment = $file_frame.state().get( 'selection' ).first().toJSON(),
										imageURL   = ( 'undefined' !== typeof attachment.sizes.thumbnail ) ? ( attachment.sizes.thumbnail.url ) : ( attachment.sizes.full.url );

									$button
										.next() // Hidden input
											.val( attachment.id )
											.trigger( 'change' )
										.next() // Image preview
											.show()
											.find( 'img' )
												.attr( 'src', imageURL );

							} )
							.open();

				} )
				.on( 'click', '.text-widget-media-image-remove', function( e ) {
					e.preventDefault();

					// Processing

						$( this )
							.parent() // Image preview
								.hide()
							.prev() // Hidden input
								.val( '' )
								.trigger( 'change' );

				} );





} )( jQuery );
