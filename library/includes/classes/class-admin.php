<?php
/**
 * Admin class
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Admin
 *
 * @since    1.0.0
 * @version  2.0.2
 *
 * Contents:
 *
 *  0) Init
 * 10) Assets
 * 20) Messages
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

						// Admin notices

							add_action( 'admin_notices', __CLASS__ . '::message', 998 );

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
		 * @version  2.0.2
		 */
		public static function assets() {

			// Processing

				// Register

					// Styles

						$register_styles = apply_filters( 'wmhook_reykjavik_library_admin_assets_register_styles', array(
								'reykjavik-welcome' => array( get_theme_file_uri( REYKJAVIK_LIBRARY_DIR . 'css/welcome.css' ) ),
							) );

						foreach ( $register_styles as $handle => $atts ) {
							$src   = ( isset( $atts['src'] )   ) ? ( $atts['src']   ) : ( $atts[0] );
							$deps  = ( isset( $atts['deps'] )  ) ? ( $atts['deps']  ) : ( false    );
							$ver   = ( isset( $atts['ver'] )   ) ? ( $atts['ver']   ) : ( esc_attr( REYKJAVIK_THEME_VERSION ) );
							$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'screen' );

							wp_register_style( $handle, $src, $deps, $ver, $media );
						}

					// RTL setup

						wp_style_add_data( 'reykjavik-welcome', 'rtl', 'replace' );

		} // /assets





	/**
	 * 20) Messages
	 */

		/**
		 * WordPress admin notification messages
		 *
		 * Displays the message stored in `reykjavik_admin_notice` transient cache
		 * once or multiple times, than deletes the message cache.
		 *
		 * Transient structure:
		 *
		 * @example
		 *
		 *   set_transient(
		 *     'reykjavik_admin_notice',
		 *     array(
		 *       $text,
		 *       $class,
		 *       $capability,
		 *       $number_of_displays
		 *     )
		 *   );
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function message() {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_library_admin_message_pre', false );

				if ( false !== $pre ) {
					echo $pre;
					return;
				}


			// Requirements check

				if ( ! is_admin() ) {
					return;
				}


			// Helper variables

				$output = '';

				$class      = 'updated';
				$repeat     = 0;
				$capability = apply_filters( 'wmhook_reykjavik_library_admin_message_capability', 'edit_theme_options' );
				$message    = get_transient( 'reykjavik_admin_notice' );


			// Requirements check

				if ( empty( $message ) ) {
					return;
				}


			// Processing

				if ( ! is_array( $message ) ) {
					$message = array( $message, $class, $capability, $repeat );
				}
				if ( ! isset( $message[1] ) || empty( $message[1] ) ) {
					$message[1] = $class;
				}
				if ( ! isset( $message[2] ) || empty( $message[2] ) ) {
					$message[2] = $capability;
				}
				if ( ! isset( $message[3] ) ) {
					$message[3] = $repeat;
				}

				if ( $message[0] && current_user_can( $message[2] ) ) {
					$output .= '<div class="' . trim( 'wm-notice notice is-dismissible ' . $message[1] ) . '"><p>' . $message[0] . '</p></div>';
					delete_transient( 'reykjavik_admin_notice' );
				}

				// Delete the transient cache after specific number of displays

					if ( 1 < intval( $message[3] ) ) {
						$message[3] = intval( $message[3] ) - 1;
						set_transient( 'reykjavik_admin_notice', $message, ( 60 * 60 * 48 ) );
					}


			// Output

				if ( $output ) {
					echo $output;
				}

		} // /message





} // /Reykjavik_Library_Admin

add_action( 'admin_init', 'Reykjavik_Library_Admin::init' );
