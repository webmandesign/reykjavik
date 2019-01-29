<?php
/**
 * Admin class
 *
 * @subpackage  Admin
 *
 * @package    WebMan WordPress Theme Framework
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.7.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Assets
 */
final class Reykjavik_Library_Admin {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.5.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						// Styles and scripts

							add_action( 'admin_enqueue_scripts', __CLASS__ . '::assets', 998 );

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
	 * 10) Assets
	 */

		/**
		 * Admin assets
		 *
		 * @since    1.0.0
		 * @version  2.7.0
		 */
		public static function assets() {

			// Processing

				// Register

					// Styles

						$register_styles = array_filter( (array) apply_filters( 'wmhook_reykjavik_library_admin_assets_register_styles', array(
							'reykjavik-welcome' => array( get_theme_file_uri( REYKJAVIK_LIBRARY_DIR . 'css/welcome.css' ) ),
						) ) );

						foreach ( $register_styles as $handle => $atts ) {
							$src   = ( isset( $atts['src'] ) ) ? ( $atts['src'] ) : ( $atts[0] );
							$deps  = ( isset( $atts['deps'] ) ) ? ( $atts['deps'] ) : ( false );
							$ver   = ( isset( $atts['ver'] ) ) ? ( $atts['ver'] ) : ( REYKJAVIK_THEME_VERSION );
							$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'screen' );

							wp_register_style( $handle, $src, $deps, $ver, $media );
						}

					// RTL setup

						wp_style_add_data( 'reykjavik-welcome', 'rtl', 'replace' );

		} // /assets





} // /Reykjavik_Library_Admin

add_action( 'admin_init', 'Reykjavik_Library_Admin::init' );
