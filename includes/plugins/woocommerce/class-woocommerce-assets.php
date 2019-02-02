<?php
/**
 * WooCommerce: Assets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Enqueue
 */
class Reykjavik_WooCommerce_Assets {





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

					// Actions

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue', 100 );

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





	/**
	 * 10) Enqueue
	 */

		/**
		 * Enqueue assets
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function enqueue() {

			// Processing

				// Styles

					wp_enqueue_style(
						'reykjavik-stylesheet-woocommerce',
						get_theme_file_uri( 'assets/css/woocommerce.css' ),
						array( 'reykjavik-stylesheet-global' ),
						esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
						'screen'
					);
					wp_style_add_data( 'reykjavik-stylesheet-woocommerce', 'rtl', 'replace' );

					wp_enqueue_style(
						'reykjavik-stylesheet-custom-woocommerce',
						get_theme_file_uri( 'assets/css/custom-styles-woocommerce.css' ),
						array( 'reykjavik-stylesheet-woocommerce' ),
						esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
						'screen'
					);

				// Scripts

					wp_enqueue_script(
						'reykjavik-scripts-woocommerce',
						get_theme_file_uri( 'assets/js/scripts-woocommerce.js' ),
						array( 'jquery' ),
						esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
						true
					);

		} // /enqueue





} // /Reykjavik_WooCommerce_Assets

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Assets::init' );
