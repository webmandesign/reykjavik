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

	/**
	 * Need to set the initial page template.
	 * @see  Reykjavik_Assets::enqueue_edit_post_scripts()
	 */
	window.reykjavikPost = window.reykjavikPost || { 'page_template' : '' };

	/**
	 * Applies page template class to post editor.
	 *
	 * This is a temporary solution until it's in core.
	 * @see  https://github.com/WordPress/gutenberg/issues/8948
	 */
	function editorPageTemplate() {

		var
			postEditor = $( '#editor' ),
			templateDropdownSelector = 'select[name="page_template"], .editor-page-attributes__template select';

		postEditor
			// Set initial template class.
			.addClass( 'page-template-' + ( reykjavikPost.page_template || 'default' ) )
			// Set correct template class when it's changed.
			.on( 'change.set-editor-class', templateDropdownSelector, function() {

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

	} // /editorPageTemplate

	// Run the page template functionality.
	if ( 'undefined' === typeof wp ) {
		$( document ).ready( editorPageTemplate );
	} else {
		wp.domReady( editorPageTemplate );
	}

} )( jQuery );
