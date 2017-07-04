/**
 * Post edit scripts
 *
 * @see  wp-admin/js/post.js
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Visual Editor
 *
 * @since    1.7.2
 * @version  2.0.1
 */





jQuery( document ).ready( function( $ ) {





	/**
	 * Adding page template class on TinyMCE editor HTML body
	 *
	 * @since    1.7.2
	 * @version  2.0.1
	 */
	if ( typeof tinymce !== 'undefined' ) {

		$( '#page_template' )
			.on( 'change.set-editor-class', function() {

				// Helper variables

					var
						editor,
						body,
						pageTemplate = $( this ).val() || '';

					pageTemplate = pageTemplate.substr( pageTemplate.lastIndexOf( '/' ) + 1, pageTemplate.length )
					               .replace( /\.php$/, '' )
					               .replace( /\./g, '-' );


				// Processing

					if ( pageTemplate && ( editor = tinymce.get( 'content' ) ) ) {
						body = editor.getBody();
						body.className = body.className.replace( /\bpage-template-[^ ]+/, '' );
						editor.dom.addClass( body, 'page-template-' + pageTemplate );
						$( document ).trigger( 'editor-classchange' );
					}

			} );

	}





} );
