<?php
/**
 * WooCommerce: Extensions Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 * 0) Init
 */
class Reykjavik_WooCommerce_Extensions {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						/**
						 * WooCommerce Product Image Flipper
						 *
						 * @see  https://wordpress.org/plugins/woocommerce-product-image-flipper/
						 */
						add_filter( 'woocommerce_product_image_flipper_styles', '__return_false' );

		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





} // /Reykjavik_WooCommerce_Extensions

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Extensions::init' );
