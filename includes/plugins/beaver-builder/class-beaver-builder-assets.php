<?php
/**
 * Beaver Builder: Assets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.1
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 * 20) Assets
 * 30) Custom styles
 */
class Reykjavik_Beaver_Builder_Assets {





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

						add_action( 'init', __CLASS__ . '::late_load', 900 );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::assets' );

					// Filters

						add_filter( 'fl_builder_layout_style_media', __CLASS__ . '::stylesheet_layout_media' );

						add_filter( 'fl_builder_render_css', __CLASS__ . '::layout_styles', 10, 2 );

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
	 * 10) Setup
	 */

		/**
		 * Load plugin stylesheets after the theme stylesheet
		 *
		 * @since    1.0.0
		 * @version  1.1.1
		 */
		public static function late_load() {

			// Helper variables

				$priority  = 120;
				$callbacks = (array) apply_filters( 'wmhook_reykjavik_beaver_builder_assets_late_load_callbacks', array(
					'FLBuilder::enqueue_all_layouts_styles_scripts'     => 10,
					'FLBuilder::enqueue_ui_styles_scripts'              => 11,
					'FLBuilderUISettingsForms::enqueue_settings_config' => 11,
				) );

				$order = 0;


			// Processing

				foreach ( $callbacks as $callback => $default_priority ) {
					if ( is_callable( $callback ) ) {
						remove_action( 'wp_enqueue_scripts', $callback, $default_priority );
						   add_action( 'wp_enqueue_scripts', $callback, $priority + $order++ );
					}
				}

		} // /late_load



		/**
		 * Layout stylesheet media
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function stylesheet_layout_media() {

			// Output

				return 'screen';

		} // /stylesheet_layout_media





	/**
	 * 20) Assets
	 */

		/**
		 * Styles and scripts
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function assets() {

			// Processing

				if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

					// Styles

						wp_enqueue_style(
								'reykjavik-bb-editor',
								get_theme_file_uri( 'assets/css/beaver-builder-editor.css' ),
								false,
								esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
								'screen'
							);

					// Scripts

						wp_enqueue_script(
								'reykjavik-bb-editor',
								get_theme_file_uri( 'assets/js/scripts-beaver-builder-editor.js' ),
								'fl-builder',
								esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
								true
							);

						if ( class_exists( 'Reykjavik_Beaver_Builder_Form' ) ) {

							$bb_settings = Reykjavik_Beaver_Builder_Form::register_settings_form( array(), 'col' );

							wp_localize_script(
									'reykjavik-bb-editor',
									'$reykjavikBBPreview',
									array(
										'vertical_alignment' => array_values(
											array_filter(
												array_flip(
													(array) $bb_settings['tabs']['style']['sections']['general']['fields']['vertical_alignment']['options']
												)
											)
										),
									)
								);

						}

				}

		} // /assets





	/**
	 * 30) Custom styles
	 */

		/**
		 * Custom layout styles
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $css
		 * @param  array  $nodes
		 */
		public static function layout_styles( $css, $nodes ) {

			// Helper variables

				$global_settings = FLBuilderModel::get_global_settings();


			// Processing

				// Row width compensation

					$global_row_margins = $global_settings->module_margins;

					if ( is_numeric( $global_row_margins ) ) {
						$global_row_margins .= 'px';
					}

					if ( $global_row_margins ) {
						$css .= "\r\n\r\n";
						$css .= '.fl-row-fixed-width .fl-row-content-wrap';
						$css .= ',';
						$css .= '.fl-row-layout-full-fixed .fl-row-fixed-width > .fl-col-group';
						$css .= ' { ';
						$css .= 'width: auto;';
						$css .= 'margin-left: -' . esc_attr( $global_row_margins ) . ';';
						$css .= 'margin-right: -' . esc_attr( $global_row_margins ) . ';';
						$css .= ' }' . "\r\n\r\n";
					}

				// Fixing responsive element hiding

					$css .= "\r\n\r\n";
					$css .= '@media (min-width: ' . absint( $global_settings->responsive_breakpoint + 1 ) . 'px) and (max-width: ' . absint( $global_settings->medium_breakpoint ) . 'px) { ';
					$css .= '.fl-col-group .fl-visible-desktop-medium.fl-col, .fl-col-group .fl-visible-medium.fl-col, .fl-col-group .fl-visible-medium-mobile.fl-col';
					$css .= ' { display: flex; }';
					$css .= ' }' . "\r\n\r\n";

					$css .= "\r\n\r\n";
					$css .= '@media (max-width: ' . absint( $global_settings->responsive_breakpoint ) . 'px) { ';
					$css .= '.fl-col-group .fl-visible-medium-mobile.fl-col, .fl-col-group .fl-visible-mobile.fl-col';
					$css .= ' { display: flex; }';
					$css .= ' }' . "\r\n\r\n";


			// Output

				return $css;

		} // /layout_styles





} // /Reykjavik_Beaver_Builder_Assets

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Assets::init' );
