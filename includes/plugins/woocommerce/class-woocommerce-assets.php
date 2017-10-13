<?php
/**
 * WooCommerce: Assets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
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
		 * @version  1.0.0
		 */
		public static function enqueue() {

			// Processing

				// Styles

					if ( current_theme_supports( 'stylesheet-generator' ) ) {

						$wp_upload_dir    = wp_upload_dir();
						$theme_upload_dir = trailingslashit( $wp_upload_dir['basedir'] . get_theme_mod( '__path_theme_generated_files' ) );

						if (
								! file_exists( $theme_upload_dir . 'reykjavik-styles.css' )
								|| ( defined( 'REYKJAVIK_DEBUG_SASS' ) && REYKJAVIK_DEBUG_SASS )
							) {

							wp_enqueue_style(
								'reykjavik-stylesheet-woocommerce',
								get_theme_file_uri( 'fallback-woocommerce.css' ),
								array( 'reykjavik-stylesheet-global' ),
								esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
								'screen'
							);

						}

					} else {

						wp_enqueue_style(
							'reykjavik-stylesheet-woocommerce',
							get_theme_file_uri( 'assets/css/woocommerce.css' ),
							array( 'reykjavik-stylesheet-global' ),
							esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
							'screen'
						);

					}

					// RTL setup

						wp_style_add_data( 'reykjavik-stylesheet-woocommerce', 'rtl', 'replace' );

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
