<?php
/**
 * Beaver Builder: Setup Class
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
 *  10) Upgrade
 *  20) Globals
 * 100) Others
 */
class Reykjavik_Beaver_Builder_Setup {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						add_filter( 'fl_builder_upgrade_url', __CLASS__ . '::upgrade_url' );

						add_filter( 'fl_builder_settings_form_defaults', __CLASS__ . '::global_settings', 10, 2 );

						add_filter( 'fl_builder_color_presets', __CLASS__ . '::color_presets' );

						add_filter( 'pre_update_option__fl_builder_color_presets', __CLASS__ . '::color_presets_save' );

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
	 * 10) Upgrade
	 */

		/**
		 * Upgrade link URL
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $url
		 */
		public static function upgrade_url( $url ) {

			// Output

				return esc_url( add_query_arg( 'fla', '67', $url ) );

		} // /upgrade_url





	/**
	 * 20) Globals
	 */

		/**
		 * Global settings
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array  $defaults
		 * @param  string $form_type
		 */
		public static function global_settings( $defaults, $form_type ) {

			// Processing

				if ( 'global' === $form_type ) {

					// "Default Page Heading" section

						$defaults->show_default_heading     = '1';
						$defaults->default_heading_selector = '.fl-builder .intro-container, .fl-theme-builder-singular .intro-container, .fl-theme-builder-404 .intro-container, .fl-theme-builder-archive .intro-container';

					// "Rows" section

						$defaults->row_padding = '';
						$defaults->row_margins = '';
						$defaults->row_width   = $GLOBALS['content_width']; // This will get overridden via custom CSS

					// "Modules" section

						$defaults->module_margins = absint( round( Reykjavik_Library_Customize::get_theme_mod( 'typography_size_html' ) * ( pow( 1.62, 2 ) / 2 ) ) );

					// "Responsive Layout" section

						$defaults->auto_spacing          = 0;
						$defaults->medium_breakpoint     = 1280;
						$defaults->responsive_breakpoint = 880;

				}


			// Output

				return $defaults;

		} // /global_settings





	/**
	 * 100) Others
	 */

		/**
		 * Converting Reykjavik_Customize::get_theme_colors() to BB format.
		 *
		 * Converting colors to Beaver Builder format.
		 *
		 * @subpackage  Customize
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function get_colors() {

			// Variables

				$theme_colors = (array) Reykjavik_Customize::get_theme_colors();


			// Processing

				$theme_colors = array_column( $theme_colors, 'color' );
				$theme_colors = array_values( $theme_colors );
				$theme_colors = array_unique( $theme_colors );
				asort( $theme_colors );


			// Output

				return $theme_colors;

		} // /get_colors



		/**
		 * Add theme color presets
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 *
		 * @param  array $color_presets
		 */
		public static function color_presets( $color_presets = array() ) {

			// Variables

				$theme_colors = self::get_colors();


			// Processing

				$color_presets = array_map(
					'sanitize_hex_color_no_hash',
					array_unique( array_merge( (array) $color_presets, $theme_colors ) )
				);
				asort( $color_presets );


			// Output

				return array_values( array_filter( $color_presets ) );

		} // /color_presets



		/**
		 * Remove theme color from array when saving BB color presets
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 *
		 * @param  array $color_presets
		 */
		public static function color_presets_save( $color_presets = array() ) {

			// Output

				return array_values( array_diff( (array) $color_presets, self::get_colors() ) );

		} // /color_presets_save





} // /Reykjavik_Beaver_Builder_Setup

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Setup::init' );
