<?php
/**
 * Assets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
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
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_styles' );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_scripts' );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_styles', 100 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::theme_style_file', 110 );
						add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_scripts', 100 );

						add_action( 'customize_preview_init', __CLASS__ . '::enqueue_customize_preview' );

						add_action( 'comment_form_before', __CLASS__ . '::enqueue_comments_reply' );

					// Filters

						add_filter( 'wp_resource_hints', __CLASS__ . '::resource_hints', 10, 2 );

						add_filter( 'wmhook_reykjavik_setup_editor_stylesheets', __CLASS__ . '::editor_stylesheets' );

						add_filter( 'editor_stylesheets', __CLASS__ . '::editor_frontend_stylesheets' );

						if ( ! ( current_theme_supports( 'jetpack-responsive-videos' ) && function_exists( 'jetpack_responsive_videos_init' ) ) ) {
							add_filter( 'embed_handler_html', __CLASS__ . '::enqueue_fitvids' );
							add_filter( 'embed_oembed_html',  __CLASS__ . '::enqueue_fitvids' );
						}

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
		 * @version  1.0.0
		 */
		public static function register_styles() {

			// Helper variables

				$stylesheet_global_version = '';

				if ( current_theme_supports( 'stylesheet-generator' ) ) {

					$wp_upload_dir             = wp_upload_dir();
					$theme_upload_dir          = trailingslashit( $wp_upload_dir['basedir'] . get_theme_mod( '__path_theme_generated_files' ) );
					$dev_prefix                = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? ( 'dev-' ) : ( '' );
					$stylesheet_global_version = get_theme_mod( '__stylesheet_timestamp' );

					$stylesheets = array(
						'global' => ( ! file_exists( $theme_upload_dir . 'reykjavik-styles.css' ) ) ? ( get_theme_file_uri( 'fallback.css' ) ) : ( str_replace( 'reykjavik-styles', $dev_prefix . 'reykjavik-styles', get_theme_mod( '__url_css' ) ) ),
					);

				} else {

					$stylesheets = array(
						'global' => get_theme_file_uri( 'assets/css/main.css' ),
					);

				}

				$stylesheets = (array) apply_filters( 'wmhook_reykjavik_assets_register_styles_sheets', $stylesheets );

				if ( empty( $stylesheet_global_version ) ) {
					$stylesheet_global_version = REYKJAVIK_THEME_VERSION;
				}

				$register_assets = array(
					'reykjavik-google-fonts'      => array( self::google_fonts_url() ),
					'reykjavik-stylesheet-global' => array( 'src' => Reykjavik_Library::fix_ssl_urls( $stylesheets['global'] ), 'ver' => $stylesheet_global_version ),
				);

				$register_assets = (array) apply_filters( 'wmhook_reykjavik_assets_register_styles', $register_assets, $stylesheets );


			// Processing

				foreach ( $register_assets as $handle => $atts ) {

					$src   = ( isset( $atts['src'] ) ) ? ( $atts['src'] ) : ( $atts[0] );
					$deps  = ( isset( $atts['deps'] ) ) ? ( $atts['deps'] ) : ( false );
					$ver   = ( isset( $atts['ver'] ) ) ? ( $atts['ver'] ) : ( REYKJAVIK_THEME_VERSION );
					$media = ( isset( $atts['media'] ) ) ? ( $atts['media'] ) : ( 'screen' );

					wp_register_style( $handle, $src, $deps, $ver, $media );

				} // /foreach

		} // /register_styles



		/**
		 * Registering theme scripts
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function register_scripts() {

			// Helper variables

				$script_global_deps = ( ! ( current_theme_supports( 'jetpack-responsive-videos' ) && function_exists( 'jetpack_responsive_videos_init' ) ) ) ? ( array( 'jquery-fitvids' ) ) : ( array( 'jquery' ) );

				$register_assets = array(
					'jquery-fitvids'                => array( get_theme_file_uri( 'assets/js/vendors/fitvids/jquery.fitvids.js' ) ),
					'reykjavik-skip-link-focus-fix' => array( 'src' => get_theme_file_uri( 'assets/js/skip-link-focus-fix.js' ), 'deps' => array() ),
					'reykjavik-scripts-global'      => array( 'src' => get_theme_file_uri( 'assets/js/scripts-global.js' ), 'deps' => $script_global_deps ),
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
		 * @version  1.0.0
		 */
		public static function enqueue_styles() {

			// Helper variables

				$enqueue_assets = array();


			// Processing

				// SASS debugging - enqueue default (fallback) stylesheet

					if (
							defined( 'REYKJAVIK_DEBUG_SASS' )
							&& REYKJAVIK_DEBUG_SASS
							&& current_theme_supports( 'stylesheet-generator' )
						) {

						// We must deregister first to register again with the new URL.
						wp_deregister_style( 'reykjavik-stylesheet-global' );

						wp_register_style(
							'reykjavik-stylesheet-global',
							get_theme_file_uri( 'fallback.css' ),
							false,
							esc_attr( trim( REYKJAVIK_THEME_VERSION ) ),
							'screen'
						);

					}

				// Google Fonts

					if ( self::google_fonts_url() ) {
						$enqueue_assets[5] = 'reykjavik-google-fonts';
					}

				// Main

					$enqueue_assets[10] = 'reykjavik-stylesheet-global';

				// Filter enqueue array

					$enqueue_assets = (array) apply_filters( 'wmhook_reykjavik_assets_enqueue_styles', $enqueue_assets );

				// RTL setup

					wp_style_add_data( 'reykjavik-stylesheet-global', 'rtl', 'replace' );

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
		 * @version  1.0.0
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

					if ( ! apply_filters( 'wmhook_reykjavik_disable_header', false ) ) {
						$enqueue_assets[20] = 'reykjavik-scripts-nav-a11y';

						if ( get_theme_mod( 'navigation_mobile', true ) ) {
							$enqueue_assets[25] = 'reykjavik-scripts-nav-mobile';
						}
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
		 * Enqueues FitVids only when needed
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $html The generated HTML of the shortcodes
		 */
		public static function enqueue_fitvids( $html ) {

			// Requirements check

				if (
						is_admin()
						|| empty( $html )
						|| ! is_string( $html )
					) {
					return $html;
				}


			// Processing

				wp_enqueue_script( 'jquery-fitvids' );


			// Output

				return $html;

		} // /enqueue_fitvids





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
		 * @version  1.0.0
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

					$output = esc_url_raw( add_query_arg( array( // Use `esc_url_raw()` for HTTP requests.
							'family' => implode( '|', (array) array_unique( $family ) ),
							'subset' => implode( ',', (array) $subset ), // Subset can be array if multiselect Customizer input field used
						), 'https://fonts.googleapis.com/css' ) );

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
		 * @version  1.0.0
		 */
		public static function editor_stylesheets() {

			// Helper variables

				$stylesheet_suffix = '-editor';
				if ( is_rtl() ) {
					$stylesheet_suffix .= '-rtl';
				}

				$visual_editor_stylesheets = array();


			// Processing

				// Google Fonts stylesheet

					$visual_editor_stylesheets[5] = str_replace( ',', '%2C', self::google_fonts_url() );

				// Editor stylesheet

					if ( current_theme_supports( 'stylesheet-generator' ) ) {

						$wp_upload_dir    = wp_upload_dir();
						$theme_upload_dir = trailingslashit( $wp_upload_dir['basedir'] . get_theme_mod( '__path_theme_generated_files' ) );

						if ( file_exists( $theme_upload_dir . 'reykjavik-styles' . $stylesheet_suffix . '.css' ) ) {

							$dev_prefix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? ( 'dev-' ) : ( '' );

							$visual_editor_stylesheets[10] = esc_url_raw( add_query_arg(
								'ver',
								get_theme_mod( '__stylesheet_timestamp' ),
								Reykjavik_Library::fix_ssl_urls( str_replace(
									'reykjavik-styles',
									$dev_prefix . 'reykjavik-styles',
									get_theme_mod( '__url_css' . $stylesheet_suffix )
								) )
							) );

						}

					}

					/**
					 * If we don't have generated editor stylesheet enqueued yet, load a fallback stylesheets.
					 *
					 * In Reykjavik_Customize_Styles::editor_stylesheet() the fallback custom styles stylesheet
					 * will be overridden if the theme does not support `stylesheet-generator`.
					 */
					if ( ! isset( $visual_editor_stylesheets[10] ) ) {

						$visual_editor_stylesheets[10] = esc_url_raw( add_query_arg(
							'ver',
							REYKJAVIK_THEME_VERSION,
							get_theme_file_uri( 'assets/css/editor-style' . str_replace(
								'-editor',
								'',
								$stylesheet_suffix
							) . '.css' )
						) );

						$visual_editor_stylesheets[20] = esc_url_raw( add_query_arg(
							'ver',
							REYKJAVIK_THEME_VERSION,
							get_theme_file_uri( 'assets/css/custom-styles-editor.css' )
						) );

					}

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
