<?php
/**
 * Content Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Main
 * 100) Helpers
 */
class Reykjavik_Content {





	/**
	 * 0) Init
	 */

		private static $instance;

		private static $site_layout;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		private function __construct() {

			// Processing

				// Setup

					self::$site_layout = Reykjavik_Library_Customize::get_theme_mod( 'layout_site' );

				// Hooks

					// Actions

						add_action( 'tha_content_top', __CLASS__ . '::open_container', 10 );

						add_action( 'tha_content_top', __CLASS__ . '::open_container_inner', 20 );

						add_action( 'tha_content_top', __CLASS__ . '::open_primary', 30 );

						add_action( 'tha_content_top', __CLASS__ . '::open_main', 40 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_main', 70 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_primary', 80 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_container_inner', 90 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_container', 100 );

					// Filters

						add_filter( 'render_block', __CLASS__ . '::render_block', 5, 2 );

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
	 * 10) Main
	 */

		/**
		 * Content container: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open_container() {

			// Output

				echo "\r\n\r\n" . '<div id="content" class="site-content">';

		} // /open_container



		/**
		 * Content container inner: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open_container_inner() {

			// Output

				echo "\r\n" . '<div class="site-content-inner">';

		} // /open_container_inner



			/**
			 * Content primary: Open
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function open_primary() {

				// Output

					echo "\r\n\t" . '<div id="primary" class="content-area">';

			} // /open_primary



				/**
				 * Content main: Open
				 *
				 * @since    1.0.0
				 * @version  1.0.0
				 */
				public static function open_main() {

					// Output

						echo "\r\n\t\t" . '<main id="main" class="site-main">' . "\r\n\r\n";

				} // /open_main



				/**
				 * Content main: Close
				 *
				 * @since    1.0.0
				 * @version  1.0.0
				 */
				public static function close_main() {

					// Output

						echo "\r\n\r\n\t\t" . '</main><!-- /#main -->';

				} // /close_main



			/**
			 * Content primary: Close
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function close_primary() {

				// Output

					echo "\r\n\t" . '</div><!-- /#primary -->';

			} // /close_primary



		/**
		 * Content container inner: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close_container_inner() {

			// Output

				echo "\r\n" . '</div><!-- /.site-content-inner -->';

		} // /close_container_inner



		/**
		 * Content container: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close_container() {

			// Output

				echo "\r\n" . '</div><!-- /#content -->' . "\r\n\r\n";

		} // /close_container





	/**
	 * 100) Helpers
	 */

		/**
		 * Level up heading tags
		 *
		 * Levels up the HTML headings in single post/page view.
		 * Transforms H3 to H2 and H4 to H3.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $html
		 */
		public static function headings_level_up( $html ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_content_headings_level_up_pre', false, $html );

				if ( false !== $pre ) {
					return $pre;
				}


			// Requirements check

				if ( ! Reykjavik_Post::is_singular() ) {
					return $html;
				}


			// Processing

				switch ( $html ) {

					case 'h3':
							$html = tag_escape( 'h2' );
						break;

					case 'h4':
							$html = tag_escape( 'h3' );
						break;

					default:
							$html = str_replace(
									array(
										'<h3', '</h3', // 1) H3...
										'<h4', '</h4', // 2) H4...
									),
									array(
										'<h2', '</h2', // 1) ...to H2
										'<h3', '</h3', // 2) ...to H3
									),
									$html
								);
						break;

				} // /switch


			// Output

				return $html;

		} // /headings_level_up



		/**
		 * Block editor output modifications.
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 *
     * @param  string $block_content  The pre-rendered content. Default null.
     * @param  array  $block          The block being rendered.
		 */
		public static function render_block( $block_content, $block ) {

			// Processing

				// Button block class.
				$block_content = str_replace(
					'wp-block-button__link',
					'wp-block-button__link button',
					$block_content
				);

				// Wide/full align wrapper (for simplified styles).
				if ( ! isset( $block['attrs']['align'] ) ) {
					$block['attrs']['align'] = '';
				}
				if ( ! isset( $block['attrs']['className'] ) ) {
					$block['attrs']['className'] = '';
				}
				if (
					in_array( $block['attrs']['align'], array( 'wide', 'full' ) )
					|| false !== strpos( $block['attrs']['className'], 'alignwide' )
					|| false !== strpos( $block['attrs']['className'], 'alignfull' )
				) {
					$class  = 'align-wrap';
					$class .= 'align-wrap-wp-block-' . sanitize_html_class( str_replace( 'core/', '', $block['blockName'] ) );
					$block_content = '<div class="' . esc_attr( $class ) . '">' . $block_content . '</div>';
				}


			// Output

				return $block_content;

		} // /render_block





} // /Reykjavik_Content

add_action( 'after_setup_theme', 'Reykjavik_Content::init' );
