/**
 * Block modifications.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  2.2.0
 */

( function() {
	'use strict';

	// Modify block supports.
	wp.hooks.addFilter(
		'blocks.registerBlockType',
		'reykjavik/block-mods',
		function( settings, name ) {

			// Processing

				switch( name ) {

					case 'core/column':
					case 'core/columns':
						// See also `includes/frontend/class-content.php/Reykjavik_Content::render_block()`
						settings = lodash.merge( {}, settings, {
							supports: {
								__experimentalLayout: false
							},
						} );
						break;

					case 'core/cover':
						// https://github.com/WordPress/gutenberg/issues/33723
						settings = lodash.merge( {}, settings, {
							supports: {
								color: { text: true }
							},
						} );
						break;
				}


			// Output

				return settings;

		},
		// Need to use low priority here so WordPress can hook with default
		// priority of 10 to add required `attributes` for us.
		5
	);

} )();
