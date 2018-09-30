<?php
/**
 * Breadcrumb NavXT Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Admin
 * 20) Frontend
 * 30) Options
 */
class Reykjavik_Breadcrumb_NavXT {





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

						add_action( 'wp', __CLASS__ . '::display' );

					// Filters

						add_filter( 'bcn_show_cpt_private', __CLASS__ . '::admin', 10, 2 );

						add_filter( 'wmhook_reykjavik_theme_options', __CLASS__ . '::options' );

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
	 * 10) Admin
	 */

		/**
		 * Plugin setup admin page modification
		 *
		 * Don't display breadcrumbs settings for posts with no single view.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  boolean $display
		 * @param  string  $post_type
		 */
		public static function admin( $display = true, $post_type = '' ) {

			// Helper variables

				$redirects = (array) apply_filters( 'wmhook_reykjavik_post_type_redirect', array() );


			// Processing

				if (
						! empty( $redirects )
						&& in_array( $post_type, array_keys( $redirects ) )
					) {
					$display = false;
				}


			// Output

				return $display;

		} // /admin





	/**
	 * 20) Frontend
	 */

		/**
		 * Display
		 *
		 * Controlling where the breadcrumbs are displayed.
		 * Has to be in a separate method hooked into some early THA hook
		 * (such as `tha_body_top`) to make it work in theme customizer
		 * preview when editing breadcrumbs display options (see below).
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 */
		public static function display() {

			// Helper variables

				$display = Reykjavik_Library_Customize::get_theme_mod( 'breadcrumbs_display' );


			// Processing

				if ( in_array( $display, array( 'both', 'before' ) ) ) {
					add_action( 'tha_content_top', __CLASS__ . '::breadcrumbs', 16 );
				}

				if ( in_array( $display, array( 'both', 'after' ) ) ) {
					add_action( 'tha_footer_top', __CLASS__ . '::breadcrumbs', 5 );
				}

		} // /display



		/**
		 * Breadcrumbs
		 *
		 * Breadcrumbs displayed in footer.
		 * Adding random number to breadcrumbs label ID to allow multiple
		 * breadcrumbs displays.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function breadcrumbs() {

			// Output

				get_template_part( 'templates/parts/component/breadcrumbs' );

		} // /breadcrumbs





	/**
	 * 30) Options
	 */

		/**
		 * Theme options addons and modifications
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Processing

				$options[ 300 . 'layout' . 600 ] = array(
						'type'    => 'html',
						'content' => '<h3>' . esc_html__( 'Breadcrumbs', 'reykjavik' ) . '</h3>',
					);

				$options[ 300 . 'layout' . 610 ] = array(
						'type'    => 'radio',
						'id'      => 'breadcrumbs_display',
						'label'   => esc_html__( 'Breadcrumbs display', 'reykjavik' ),
						'choices' => array(
								'before' => esc_html__( 'Before content only', 'reykjavik' ),
								'both'   => esc_html__( 'Both before and after content', 'reykjavik' ),
								'after'  => esc_html__( 'After content only', 'reykjavik' ),
							),
						'default' => 'after',
					);


			// Output

				return $options;

		} // /options





} // /Reykjavik_Breadcrumb_NavXT

add_action( 'after_setup_theme', 'Reykjavik_Breadcrumb_NavXT::init' );
