/**
 * Post editor scripts.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0.0
 * @version  2.0.0
 */

( function( $ ) {

	'use strict';

	if ( 'undefined' === typeof wp ) {
		return;
	}

	/**
	 * Apply page template class to post editor.
	 *
	 * This is a temporary solution until it's in core.
	 * @see  https://github.com/WordPress/gutenberg/issues/8948
	 */
	wp.domReady( function() {

		// Variables

			var
				postEditor     = $( '#editor' ),
				templateSelect = '.editor-page-attributes__template select',
				/**
				 * Initial page template.
				 * @see  Reykjavik_Assets::enqueue_edit_post_scripts()
				 */
				wpPost = window.reykjavikPost || { 'page_template' : '' };


		// Processing

			postEditor
				// Set initial template class.
				.addClass( 'page-template-' + ( wpPost.page_template || 'default' ) )
				// Set correct template class when it's changed.
				.on( 'change.set-editor-class', templateSelect, function() {

					var
						pageTemplate = $( this ).val() || 'default';

					pageTemplate = pageTemplate
						.substr( pageTemplate.lastIndexOf( '/' ) + 1, pageTemplate.length )
						.replace( /\.php$/, '' )
						.replace( /\./g, '-' );

					postEditor
						.removeClass( function( index, className ) {
							return ( className.match( /\bpage-template-[^ ]+/ ) || [] ).join( ' ' );
						} )
						.addClass( 'page-template-' + pageTemplate );

					// Run the same action as in the pre-block post editor.
					$( document )
						.trigger( 'editor-classchange' );

				} );

	} );

} )( jQuery );
