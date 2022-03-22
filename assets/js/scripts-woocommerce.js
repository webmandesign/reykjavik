/**
 * Theme's WooCommerce frontend scripts
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
		$body = $( document.body );

	// Add class of tabs count on tab selector wrapper.
	$( '.woocommerce-tabs' )
		.addClass( function() {
			return 'tabs-count-' + $( this ).find( '.tabs li' ).length;
		} );

	// Apply additional classes and attributes into reviews pagination.
	$( '#reviews .woocommerce-pagination' )
		.addClass( 'pagination' )
		.attr( 'data-current', function() {
			return jQuery( this ).find( '.current' ).text();
		} )
		.attr( 'data-total', function() {
			return jQuery( this ).find( '.page-numbers:not(.prev):not(.next)' ).length;
		} );

	// Product "More details" link tabs switching and smooth scroll to product tabs.
	$body
		.on( 'click', 'a.product-description-link', function() {

			var
				$tabs = $( '.woocommerce-tabs' ),
				$tab  = $( '.description_tab a' );

			if ( ! $tabs.length ) {
				return false;
			}

			if ( $tab.length ) {

				$( '.description_tab a' )
					.trigger( 'click' );

			} else {

				$( '.additional_information_tab a' )
					.trigger( 'click' );

			}
		} );

} )( jQuery );
