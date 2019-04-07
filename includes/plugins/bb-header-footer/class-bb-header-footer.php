<?php
/**
 * Beaver Builder Header Footer Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 */
class Reykjavik_BB_Header_Footer {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization
		 *
		 * Adding the hooks overrides very late,
		 * hoping no THA hook is inserted later.
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function init() {

			// Processing

				// Setup

					add_theme_support( 'bb-header-footer' );

				// Hooks

					// Actions

						add_action( 'wp', __CLASS__ . '::hook_overrides', 999 );

		} // /init





	/**
	 * 10) Setup
	 */

		/**
		 * Hooks overrides
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function hook_overrides() {

			// Requirements check

				if ( is_admin() ) {
					return;
				}


			// Variables

				$header_id = BB_Header_Footer::get_settings( 'bb_header_id' );
				$footer_id = BB_Header_Footer::get_settings( 'bb_footer_id' );


			// Processing

				// Custom header

					if ( ! empty( $header_id ) ) {
						remove_all_actions( 'tha_header_top' );
						remove_all_actions( 'tha_header_bottom' );

						add_action( 'tha_header_top', 'Reykjavik_Header::open' );
						add_action( 'tha_header_top', 'BB_Header_Footer::get_header_content', 20 );
						add_action( 'tha_header_bottom', 'Reykjavik_Header::close' );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::dequeue_header_scripts', 110 );

						add_filter( 'wmhook_reykjavik_skip_links_no_header', '__return_true' );
					}

				// Custom footer

					if ( ! empty( $footer_id ) ) {
						remove_all_actions( 'tha_footer_top' );
						remove_all_actions( 'tha_footer_bottom' );

						add_action( 'tha_footer_top', 'Reykjavik_Footer::open' );
						add_action( 'tha_footer_top', 'BB_Header_Footer::get_footer_content', 20 );
						add_action( 'tha_footer_bottom', 'Reykjavik_Footer::close' );

						add_filter( 'wmhook_reykjavik_skip_links_no_footer', '__return_true' );
					}

		} // /hook_overrides



		/**
		 * Dequeue theme header scripts
		 *
		 * @since    1.5.2
		 * @version  1.5.2
		 */
		public static function dequeue_header_scripts() {

			// Processing

				wp_dequeue_script( 'reykjavik-scripts-nav-a11y' );
				wp_dequeue_script( 'reykjavik-scripts-nav-mobile' );

		} // /dequeue_header_scripts





} // /Reykjavik_BB_Header_Footer

add_action( 'after_setup_theme', 'Reykjavik_BB_Header_Footer::init', 100 );
