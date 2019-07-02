<?php
/**
 * Assets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Register
 * 20) Enqueue
 * 30) Typography
 * 40) Setup
 */
class Reykjavik_Assets {





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

					// Actions

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_inline_styles', 0 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_styles' );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_scripts' );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_styles', 100 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_inline_styles', 105 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::theme_style_file', 110 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_scripts', 100 );

						add_action( 'customize_preview_init', __CLASS__ . '::enqueue_customize_preview' );

						add_action( 'comment_form_before', __CLASS__ . '::enqueue_comments_reply' );

						add_action( 'enqueue_block_editor_assets', __CLASS__ . '::enqueue_styles_editor' );
						add_action( 'enqueue_block_editor_assets', __CLASS__ . '::enqueue_edit_post_scripts' );

					// Filters

						add_filter( 'wp_resource_hints', __CLASS__ . '::resource_hints', 10, 2 );

						add_filter( 'wmhook_reykjavik_setup_editor_stylesheets', __CLASS__ . '::editor_stylesheets' );

						add_filter( 'editor_stylesheets', __CLASS__ . '::editor_frontend_stylesheets' );

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
	 * 10) Register
	 */

		/**
		 * Registering theme styles
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function register_styles() {

			// Helper variables

				$register_assets = array(
					'genericons-neue'             => array( 'src' => get_theme_file_uri( 'assets/fonts/genericons-neue/genericons-neue.css' ) ),
					'reykjavik-google-fonts'      => array( 'src' => self::google_fonts_url() ),
					'reykjavik-stylesheet-custom' => array( 'src' => get_theme_file_uri( 'assets/css/custom-styles.css' ) ),
					'reykjavik-stylesheet-global' => array( 'src' => get_theme_file_uri( 'assets/css/main.css' ), 'rtl' => 'replace' ),
				);

				$register_assets = (array) apply_filters( 'wmhook_reykjavik_assets_register_styles', $register_assets );


			// Processing

				foreach ( $register_assets as $handle => $atts ) {

					$src   = ( isset( $atts['src'] ) ) ? ( $atts['src'] ) : ( $atts[0] );
					$deps  = ( isset( $atts['deps'] ) ) ? ( $atts['deps'] ) : ( false );
					$ver   = ( isset( $atts['ver'] ) ) ? ( $atts['ver'] ) : ( REYKJAVIK_THEME_VERSION );
					$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'screen' );

					wp_register_style( $handle, $src, $deps, $ver, $media );

					if ( isset( $atts['rtl'] ) && $atts['rtl'] ) {
						wp_style_add_data( $handle, 'rtl', $atts['rtl'] );
					}

				}

		} // /register_styles



		/**
		 * Registering theme scripts
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function register_scripts() {

			// Helper variables

				$register_assets = array(
					'reykjavik-skip-link-focus-fix' => array( 'src' => get_theme_file_uri( 'assets/js/skip-link-focus-fix.js' ), 'deps' => array() ),
					'reykjavik-scripts-global'      => array( 'src' => get_theme_file_uri( 'assets/js/scripts-global.js' ), 'deps' => array( 'jquery' ) ),
					'reykjavik-scripts-masonry'     => array( 'src' => get_theme_file_uri( 'assets/js/scripts-masonry.js' ), 'deps' => array( 'jquery-masonry' ) ),
					'reykjavik-scripts-nav-a11y'    => array( get_theme_file_uri( 'assets/js/scripts-navigation-accessibility.js' ) ),
					'reykjavik-scripts-nav-mobile'  => array( get_theme_file_uri( 'assets/js/scripts-navigation-mobile.js' ) ),
				);

				$register_assets = (array) apply_filters( 'wmhook_reykjavik_assets_register_scripts', $register_assets );


			// Processing

				foreach ( $register_assets as $handle => $atts ) {

					$src       = ( isset( $atts['src'] ) ) ? ( $atts['src'] ) : ( $atts[0] );
					$deps      = ( isset( $atts['deps'] ) ) ? ( $atts['deps'] ) : ( array( 'jquery' ) );
					$ver       = ( isset( $atts['ver'] ) ) ? ( $atts['ver'] ) : ( REYKJAVIK_THEME_VERSION );
					$in_footer = ( isset( $atts['in_footer'] ) ) ? ( $atts['in_footer'] ) : ( true );

					wp_register_script( $handle, $src, $deps, $ver, $in_footer );

				} // /foreach

		} // /register_scripts





	/**
	 * 20) Enqueue
	 */

		/**
		 * Frontend styles enqueue
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function enqueue_styles() {

			// Helper variables

				$enqueue_assets = array();


			// Processing

				// Google Fonts
				if ( self::google_fonts_url() ) {
					$enqueue_assets[0] = 'reykjavik-google-fonts';
				}

				// Genericons Neue
				$enqueue_assets[5] = 'genericons-neue';

				// Main
				$enqueue_assets[10] = 'reykjavik-stylesheet-global';

				// Custom
				$enqueue_assets[20] = 'reykjavik-stylesheet-custom';

				// Filter enqueue array
				$enqueue_assets = (array) apply_filters( 'wmhook_reykjavik_assets_enqueue_styles', $enqueue_assets );

				// Enqueue

					ksort( $enqueue_assets );

					foreach ( $enqueue_assets as $handle ) {
						wp_enqueue_style( $handle );
					}

		} // /enqueue_styles



		/**
		 * Frontend scripts enqueue
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function enqueue_scripts() {

			// Helper variables

				$enqueue_assets = array();

				$breakpoints = (array) apply_filters( 'wmhook_reykjavik_assets_enqueue_scripts_breakpoints', array(
					's'     => 448,
					'm'     => 672,
					'l'     => 880,
					'xl'    => 1280,
					'xxl'   => 1600,
					'xxxl'  => 1920,
					'xxxxl' => 2560,
				) );


			// Processing

				// Skip link focus fix

					$enqueue_assets[10] = 'reykjavik-skip-link-focus-fix';

				// Navigation scripts

					if ( Reykjavik_Header::is_enabled() ) {
						$enqueue_assets[20] = 'reykjavik-scripts-nav-a11y';

						if ( Reykjavik_Library_Customize::get_theme_mod( 'navigation_mobile' ) ) {
							$enqueue_assets[25] = 'reykjavik-scripts-nav-mobile';
						}
					}

				// Masonry

					if ( (bool) apply_filters( 'wmhook_reykjavik_is_masonry_layout', false ) ) {
						$enqueue_assets[30] = 'reykjavik-scripts-masonry';
					}

				// Global theme scripts

					$enqueue_assets[100] = 'reykjavik-scripts-global';

				// Filter enqueue array

					$enqueue_assets = (array) apply_filters( 'wmhook_reykjavik_assets_enqueue_scripts', $enqueue_assets );

				// Pass CSS breakpoint into JS (from `assets/scss/_setup.scss`)

					if ( ! empty( $breakpoints ) ) {
						wp_localize_script(
							'reykjavik-skip-link-focus-fix',
							'$reykjavikBreakpoints',
							$breakpoints
						);
					}

				// Enqueue

					ksort( $enqueue_assets );

					foreach ( $enqueue_assets as $handle ) {
						wp_enqueue_script( $handle );
					}

		} // /enqueue_scripts



		/**
		 * Enqueue theme `style.css` file late
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function theme_style_file() {

			// Processing

				if ( is_child_theme() ) {
					wp_enqueue_style(
						'reykjavik-stylesheet',
						get_stylesheet_uri()
					);
				}

		} // /theme_style_file



		/**
		 * Placeholder for adding inline styles: register.
		 *
		 * This should be loaded after all of the theme stylesheets are enqueued,
		 * and before the child theme stylesheet is enqueued.
		 * Use the `reykjavik` handle in `wp_add_inline_style`.
		 * Early registration is required!
		 *
		 * @since    1.3.0
		 * @version  1.3.0
		 */
		public static function register_inline_styles() {

			// Processing

				wp_register_style( 'reykjavik', '' );

		} // /register_inline_styles



		/**
		 * Placeholder for adding inline styles: enqueue.
		 *
		 * @since    1.3.0
		 * @version  1.3.0
		 */
		public static function enqueue_inline_styles() {

			// Processing

				wp_enqueue_style( 'reykjavik' );

		} // /enqueue_inline_styles



		/**
		 * Customize preview assets
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function enqueue_customize_preview() {

			// Processing

				// Styles

					if ( file_exists( get_theme_file_path( 'assets/css/customize-preview.css' ) ) ) {

						wp_enqueue_style(
							'reykjavik-customize-preview',
							get_theme_file_uri( 'assets/css/customize-preview.css' ),
							array(),
							esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
							'screen'
						);

					}

				// Scripts

					if ( file_exists( get_theme_file_path( 'assets/js/customize-preview.js' ) ) ) {

						wp_enqueue_script(
							'reykjavik-customize-preview',
							get_theme_file_uri( 'assets/js/customize-preview.js' ),
							array( 'jquery', 'customize-preview' ),
							esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
							true
						);

					}

		} // /enqueue_customize_preview



		/**
		 * Enqueue `comment-reply.js` the right way
		 *
		 * @link  http://wpengineer.com/2358/enqueue-comment-reply-js-the-right-way/
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function enqueue_comments_reply() {

			// Processing

				if (
						is_singular()
						&& comments_open()
						&& get_option( 'thread_comments' )
					) {
					wp_enqueue_script( 'comment-reply' );
				}

		} // /enqueue_comments_reply



		/**
		 * Enqueues block editor stylesheets.
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function enqueue_styles_editor() {

			// Processing

				if ( $url_google_fonts = self::google_fonts_url() ) {
					wp_enqueue_style(
						'reykjavik-google-fonts',
						$url_google_fonts,
						array(),
						REYKJAVIK_THEME_VERSION
					);
				}

				wp_enqueue_style(
					'genericons-neue',
					get_theme_file_uri( 'assets/fonts/genericons-neue/genericons-neue.css' ),
					array(),
					REYKJAVIK_THEME_VERSION
				);

				wp_enqueue_style(
					'reykjavik-editor-blocks',
					get_theme_file_uri( 'assets/css/editor-style-blocks.css' ),
					array(),
					REYKJAVIK_THEME_VERSION
				);
				wp_style_add_data( 'reykjavik-editor-blocks', 'rtl', 'replace' );

				wp_add_inline_style(
					'reykjavik-editor-blocks',
					Reykjavik_Customize_Styles::esc_css( Reykjavik_Customize_Styles::get_css_variables(), 'customize-styles-editor' )
				);

		} // /enqueue_styles_editor



		/**
		 * Enqueues post editor scripts.
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function enqueue_edit_post_scripts() {

			// Processing

				wp_enqueue_script(
					'reykjavik-edit-post',
					get_theme_file_uri( 'assets/js/scripts-edit-post.js' ),
					array( 'wp-edit-post' ),
					REYKJAVIK_THEME_VERSION,
					true
				);

				wp_localize_script(
					'reykjavik-edit-post',
					'reykjavikPost',
					array(
						'page_template' => basename( get_page_template_slug(), '.php' ),
					)
				);

		} // /enqueue_edit_post_scripts





	/**
	 * 30) Typography
	 */

		/**
		 * Get Google Fonts link
		 *
		 * Returns a string such as:
		 * https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400|Exo+2:400,700|Allan&subset=latin,latin-ext
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $fonts Fallback fonts.
		 */
		public static function google_fonts_url( $fonts = array() ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_assets_google_fonts_url_pre', false, $fonts );

				if ( false !== $pre ) {
					return $pre;
				}


			// Helper variables

				$output = '';
				$family = array();
				$subset = ( 'sk_SK' !== get_locale() ) ? ( array( 'latin' ) ) : ( array( 'latin', 'latin-ext' ) );
				$subset = (array) apply_filters( 'wmhook_reykjavik_assets_google_fonts_url_subset', $subset );

				$fonts_setup = array_filter( (array) apply_filters( 'wmhook_reykjavik_assets_google_fonts_url_fonts_setup', array() ) );

				if ( empty( $fonts_setup ) && ! empty( $fonts ) ) {
					$fonts_setup = (array) $fonts;
				}

				$http = ( is_ssl() ) ? ( 'https' ) : ( 'http' );


			// Requirements check

				if ( empty( $fonts_setup ) ) {
					return $output;
				}


			// Processing

				foreach ( $fonts_setup as $section ) {

					$font = trim( $section );

					if ( $font ) {
						$family[] = str_replace( ' ', '+', $font );
					}

				} // /foreach

				if ( ! empty( $family ) ) {
					$output = esc_url_raw( add_query_arg(
						array(
							'family' => implode( '|', (array) array_unique( $family ) ),
							'subset' => implode( ',', (array) $subset ), // Subset can be array if multiselect Customizer input field used
						),
						$http . '://fonts.googleapis.com/css'
					) );
				}


			// Output

				return $output;

		} // /google_fonts_url





	/**
	 * 40) Setup
	 */

		/**
		 * Editor stylesheets array
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function editor_stylesheets() {

			// Helper variables

				$stylesheet_suffix = '';
				if ( is_rtl() ) {
					$stylesheet_suffix .= '-rtl';
				}

				$visual_editor_stylesheets = array();


			// Processing

				// Google Fonts stylesheet
				$visual_editor_stylesheets[0] = str_replace( ',', '%2C', self::google_fonts_url() );

				// Genericons Neue
				$visual_editor_stylesheets[5] = get_theme_file_uri( 'assets/fonts/genericons-neue/genericons-neue.css' );

				// Editor stylesheet

					$visual_editor_stylesheets[10] = esc_url_raw( add_query_arg(
						'ver',
						REYKJAVIK_THEME_VERSION,
						get_theme_file_uri( 'assets/css/editor-style' . $stylesheet_suffix . '.css' )
					) );

				// Icons stylesheet
				if ( class_exists( 'WM_Icons' ) && $icons_font_stylesheet = get_option( 'wmamp-icon-font' ) ) {
					$visual_editor_stylesheets[100] = esc_url_raw( $icons_font_stylesheet );
				}

				// Filter and order

					$visual_editor_stylesheets = (array) apply_filters( 'wmhook_reykjavik_assets_editor', $visual_editor_stylesheets );

					ksort( $visual_editor_stylesheets );


			// Output

				return $visual_editor_stylesheets;

		} // /editor_stylesheets



		/**
		 * Load editor styles for any frontend editor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function editor_frontend_stylesheets( $stylesheets ) {

			// Requirements check

				if ( is_admin() ) {
					return $stylesheets;
				}


			// Output

				return array_merge(
					(array) $stylesheets,
					array_filter( (array) apply_filters( 'wmhook_reykjavik_setup_editor_stylesheets', array() ) )
				);

		} // /editor_frontend_stylesheets



		/**
		 * Add preconnect for Google Fonts
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array  $urls           URLs to print for resource hints.
		 * @param  string $relation_type  The relation type the URLs are printed.
		 */
		public static function resource_hints( $urls, $relation_type ) {

			// Processing

				if (
						wp_style_is( 'reykjavik-google-fonts', 'queue' )
						&& 'preconnect' === $relation_type
					) {

					if ( version_compare( $GLOBALS['wp_version'], '4.7', '>=' ) ) {

						$urls[] = array(
								'href' => 'https://fonts.gstatic.com',
								'crossorigin',
							);

					} else {

						$urls[] = 'https://fonts.gstatic.com';

					}

				}


			// Output

				return $urls;

		} // /resource_hints





} // /Reykjavik_Assets

add_action( 'after_setup_theme', 'Reykjavik_Assets::init' );
