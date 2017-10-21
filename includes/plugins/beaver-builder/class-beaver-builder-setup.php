<?php
/**
 * Beaver Builder: Setup Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
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
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'customize_save_after', __CLASS__ . '::theme_colors_cache_flush', 100 );

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
		 * @version  1.0.0
		 *
		 * @param  array  $defaults
		 * @param  string $form_type
		 */
		public static function global_settings( $defaults, $form_type ) {

			// Processing

				if ( 'global' === $form_type ) {

					// "Default Page Heading" section

						$defaults->show_default_heading     = 1;
						$defaults->default_heading_selector = '.fl-builder .intro-container, .fl-theme-builder-singular .intro-container, .fl-theme-builder-404 .intro-container, .fl-theme-builder-archive .intro-container';

					// "Rows" section

						$defaults->row_padding = '';
						$defaults->row_margins = '';
						$defaults->row_width   = $GLOBALS['content_width']; // This will get overridden via custom CSS

					// "Modules" section

						$defaults->module_margins = absint( round( get_theme_mod( 'typography_size_html', 18 ) * ( pow( 1.62, 2 ) / 2 ) ) );

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
		 * Retrieves all theme colors in array
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function get_theme_colors() {

			// Requirements check

				$theme_colors = get_transient( 'reykjavik_theme_colors' );

				if ( ! empty( $theme_colors ) ) {
					return (array) $theme_colors;
				}


			// Helper variables

				$mods          = (array) get_theme_mods();
				$theme_options = (array) apply_filters( 'wmhook_reykjavik_theme_options', array() );


			// Processing

				foreach ( $theme_options as $key => $option ) {
					if ( 'color' === $option['type'] && isset( $option['default'] ) ) {
						$theme_colors[ $option['id'] ] = ( isset( $mods[ $option['id'] ] ) ) ? ( sanitize_hex_color_no_hash( $mods[ $option['id'] ] ) ) : ( sanitize_hex_color_no_hash( $option['default'] ) );
					}
				}

				// Cache the colors

					set_transient( 'reykjavik_theme_colors', $theme_colors );


			// Output

				return $theme_colors;

		} // /get_theme_colors



		/**
		 * Flush theme colors array cache
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function theme_colors_cache_flush() {

			// Processing

				delete_transient( 'reykjavik_theme_colors' );

		} // /theme_colors_cache_flush



		/**
		 * Add theme color presets
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $color_presets
		 */
		public static function color_presets( $color_presets = array() ) {

			// Helper variables

				$theme_colors = array_unique( array_values( (array) self::get_theme_colors() ) );


			// Processing

				$color_presets = array_map( 'sanitize_hex_color_no_hash', array_unique( array_merge( (array) $color_presets, $theme_colors ) ) );
				asort( $color_presets );


			// Output

				return array_values( $color_presets );

		} // /color_presets



		/**
		 * Remove theme color from array when saving BB color presets
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $color_presets
		 */
		public static function color_presets_save( $color_presets = array() ) {

			// Helper variables

				$theme_colors = array_unique( array_values( (array) self::get_theme_colors() ) );


			// Output

				return array_values( array_diff( (array) $color_presets, $theme_colors ) );

		} // /color_presets_save





} // /Reykjavik_Beaver_Builder_Setup

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Setup::init' );
