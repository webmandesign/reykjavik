<?php
/**
 * Footer Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 *
 * Contents:
 *
 *   0) Init
 *  10) Site footer
 *  20) Body ending
 * 100) Others
 */
class Reykjavik_Footer {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'tha_footer_top', __CLASS__ . '::open', 1 );

						add_action( 'tha_footer_bottom', __CLASS__ . '::site_info', 100 );

						add_action( 'tha_footer_bottom', __CLASS__ . '::close', 101 );

						add_action( 'tha_body_bottom', __CLASS__ . '::site_close', 100 );

					// Filters

						add_filter( 'theme_mod_' . 'texts_site_info', __CLASS__ . '::site_info_year' );

						add_filter( 'wmhook_reykjavik_library_link_skip_to_pre', __CLASS__ . '::skip_links_no_footer', 10, 2 );

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
	 * 10) Site footer
	 *
	 * Footer widgets:
	 * @see  includes/frontend/class-sidebar.php
	 *
	 * Footer menu:
	 * @see  includes/frontend/class-menu.php
	 */

		/**
		 * Footer: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open() {

			// Output

				echo "\r\n\r\n" . '<footer id="colophon" class="site-footer">' . "\r\n\r\n";

		} // /open



		/**
		 * Footer: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close() {

			// Output

				echo "\r\n\r\n" . '</footer>' . "\r\n\r\n";

		} // /close



		/**
		 * Site info
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function site_info() {

			// Output

				get_template_part( 'templates/parts/footer/site', 'info' );

		} // /site_info



			/**
			 * Site info: Replacing `[year]` with dynamically generated year
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  string $value
			 */
			public static function site_info_year( $value ) {

				// Requirements check

					if (
							empty( $value )
							|| ! is_string( $value )
						) {
						return $value;
					}


				// Output

					return str_replace(
						'[year]',
						esc_html( date_i18n( 'Y' ) ),
						(string) $value
					);

			} // /site_info_year





	/**
	 * 20) Body ending
	 */

		/**
		 * Site container: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function site_close() {

			// Output

				echo "\r\n" . '</div><!-- /#page -->' . "\r\n\r\n";

		} // /site_close





	/**
	 * 100) Others
	 */

		/**
		 * Is footer disabled?
		 *
		 * @since    1.5.2
		 * @version  1.5.2
		 */
		public static function is_disabled() {

			// Output

				return (bool) apply_filters( 'wmhook_reykjavik_footer_is_disabled', false );

		} // /is_disabled



		/**
		 * Is footer enabled?
		 *
		 * @since    1.5.2
		 * @version  1.5.2
		 */
		public static function is_enabled() {

			// Output

				return (bool) apply_filters( 'wmhook_reykjavik_footer_is_enabled', ! self::is_disabled() );

		} // /is_enabled



		/**
		 * Skip links: Remove footer related links.
		 *
		 * When we display no footer, remove all related skip links.
		 *
		 * @since    1.5.2
		 * @version  1.5.2
		 *
		 * @param  string $pre  Pre output.
		 * @param  string $id   Link target element ID.
		 */
		public static function skip_links_no_footer( $pre, $id ) {

			// Processing

				if (
					(bool) apply_filters( 'wmhook_reykjavik_skip_links_no_footer', self::is_disabled() )
					&& in_array( $id, array( 'colophon' ) )
				) {
					$pre = '';
				}


			// Output

				return $pre;

		} // /skip_links_no_footer





} // /Reykjavik_Footer

add_action( 'after_setup_theme', 'Reykjavik_Footer::init' );
