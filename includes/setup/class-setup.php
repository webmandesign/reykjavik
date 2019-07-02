<?php
/**
 * Theme Setup Class
 *
 * Theme options with `__` prefix (`get_theme_mod( '__option_id' )`) are theme
 * setup related options and can not be edited via customizer.
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
 *  10) Installation
 *  20) Setup
 *  30) Globals
 *  40) Images
 *  50) Typography
 *  60) Visual editor
 * 100) Others
 */
class Reykjavik_Setup {





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

				// Setup

					self::content_width();

				// Hooks

					// Actions

						add_action( 'load-themes.php', __CLASS__ . '::welcome_admin_notice_activation' );

						add_action( 'after_setup_theme', __CLASS__ . '::setup' );

						add_action( 'after_setup_theme', __CLASS__ . '::visual_editor' );

						add_action( 'init', __CLASS__ . '::register_meta' );

						add_action( 'admin_init', __CLASS__ . '::image_sizes_notice' );

					// Filters

						add_filter( 'wmhook_reykjavik_enable_rtl', '__return_true' );

						add_filter( 'wmhook_reykjavik_setup_image_sizes', __CLASS__ . '::image_sizes' );

						add_filter( 'wmhook_reykjavik_assets_google_fonts_url_fonts_setup', __CLASS__ . '::google_fonts' );

						add_filter( 'wmhook_reykjavik_library_editor_style_formats', __CLASS__ . '::editor_style_formats' );

						add_filter( 'wmhook_reykjavik_widget_css_classes', __CLASS__ . '::widget_css_classes' );

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
	 * 10) Installation
	 */

		/**
		 * Initiate "Welcome" admin notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function welcome_admin_notice_activation() {

			// Processing

				global $pagenow;

				if (
					is_admin()
					&& 'themes.php' == $pagenow
					&& isset( $_GET['activated'] )
				) {

					add_action( 'admin_notices', __CLASS__ . '::welcome_admin_notice', 99 );

				}

		} // /welcome_admin_notice_activation



		/**
		 * Display "Welcome" admin notice
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function welcome_admin_notice() {

			// Processing

				get_template_part( 'templates/parts/admin/notice', 'welcome' );

		} // /welcome_admin_notice





	/**
	 * 20) Setup
	 */

		/**
		 * Theme setup
		 *
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		public static function setup() {

			// Helper variables

				$image_sizes   = array_filter( (array) apply_filters( 'wmhook_reykjavik_setup_image_sizes', array() ) );
				$editor_styles = array_filter( (array) apply_filters( 'wmhook_reykjavik_setup_editor_stylesheets', array() ) );


			// Processing

				// Localization

					/**
					 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
					 */

					// wp-content/languages/themes/reykjavik/en_GB.mo
					load_theme_textdomain( 'reykjavik', trailingslashit( WP_LANG_DIR ) . 'themes/' . get_template() );

					// wp-content/themes/child-theme/languages/en_GB.mo
					load_theme_textdomain( 'reykjavik', get_stylesheet_directory() . '/languages' );

					// wp-content/themes/reykjavik/languages/en_GB.mo
					load_theme_textdomain( 'reykjavik', get_template_directory() . '/languages' );

				// Declare support for child theme stylesheet automatic enqueuing
				add_theme_support( 'child-theme-stylesheet' );

				// Add support for editor styles.
				add_editor_style( $editor_styles );
				/**
				 * add_theme_support( 'editor-styles' );
				 *
				 * This is not OK for this theme! Do not ever use it here!
				 * As the theme applies more advanced styles for TinyMCE,
				 * the stylesheet would be enqueued into block editor too,
				 * which would mess block editor styles greatly...
				 *
				 * @see  Reykjavik_Assets::enqueue_styles_editor()
				 */

				// Block color palettes.
				add_theme_support( 'editor-color-palette', self::get_color_palette() );

				// Block font sizes.
				add_theme_support( 'editor-font-sizes', self::get_font_sizes() );

				// Wide alignment.
				add_theme_support( 'align-wide' );

				// Responsive embedded content.
				add_theme_support( 'responsive-embeds' );

				// Title tag
				add_theme_support( 'title-tag' );

				// Site logo
				add_theme_support( 'custom-logo' );

				// Feed links
				add_theme_support( 'automatic-feed-links' );

				// Enable HTML5 markup
				add_theme_support( 'html5', array(
					'caption',
					'comment-form',
					'comment-list',
					'gallery',
					'search-form',
				) );

				// Custom background
				add_theme_support( 'custom-background', apply_filters( 'wmhook_reykjavik_setup_custom_background_args', array(
					'default-color' => 'e3e3e4',
				) ) );

				// Custom header

					/**
					 * @see  includes/custom-header/class-intro.php
					 */

				// Custom menus

					/**
					 * @see  includes/frontend/class-menu.php
					 */

				// Post formats

					/**
					 * @see  includes/frontend/class-post-media.php
					 */

				// Thumbnails support

					/**
					 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
					 */
					add_theme_support( 'post-thumbnails', array( 'attachment:audio', 'attachment:video' ) );
					add_theme_support( 'post-thumbnails' );

					// Image sizes (x, y, crop)

						if ( ! empty( $image_sizes ) ) {
							foreach ( $image_sizes as $size => $setup ) {
								if ( ! in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
									add_image_size(
										$size,
										$image_sizes[ $size ][0],
										$image_sizes[ $size ][1],
										$image_sizes[ $size ][2]
									);
								}
							}
						}

		} // /setup





	/**
	 * 30) Globals
	 */

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet
		 *
		 * Priority -100 to make it available to lower priority callbacks.
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @global  int $content_width
		 */
		public static function content_width() {

			// Processing

				/**
				 * We cannot use Reykjavik_Library_Customize::get_theme_mod() here as we are setting
				 * these before the actual theme options are declared.
				 */
				$content_width = absint( get_theme_mod( 'layout_width_content', 1200 ) );
				$site_width    = absint( get_theme_mod( 'layout_width_site', 1640 ) );

				// Make content width max 88% of site width

					if ( $content_width > absint( $site_width * .88 ) ) {
						$content_width = absint( $site_width * .88 );
					}

				// Allow filtering

					$GLOBALS['content_width'] = absint( apply_filters( 'wmhook_reykjavik_content_width', $content_width ) );

		} // /content_width





	/**
	 * 40) Images
	 */

		/**
		 * Image sizes
		 *
		 * @example
		 *
		 *   $image_sizes = array(
		 *     'image_size_id' => array(
		 *       absint( width ),
		 *       absint( height ),
		 *       (bool) cropped?,
		 *       (string) optional_theme_usage_explanation_text
		 *     )
		 *   );
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @param  array $image_sizes
		 */
		public static function image_sizes( $image_sizes = array() ) {

			// Helper variables

				global $content_width;

				// Intro image size

					if ( 'boxed' === Reykjavik_Library_Customize::get_theme_mod( 'layout_site' ) ) {

						$intro_width = absint( Reykjavik_Library_Customize::get_theme_mod( 'layout_width_site' ) );

						if ( 1000 > $intro_width ) {
							// Can't set site width less then 1000 px,
							// so default to max boxed site width then.
							$intro_width = 1640;
						}

					} else {

						$intro_width = 1920;

					}


			// Processing

				$image_sizes = array(

						'thumbnail' => array(
								absint( $content_width * .62 ),
								absint( $content_width * .62 * 9 / 16 ),
								true,
								esc_html__( 'In posts list.', 'reykjavik' ),
							),

						'medium' => array(
								absint( $content_width * .62 ),
								0,
								false,
								esc_html__( 'As featured image preview on single post page.', 'reykjavik' ) . '<br>' .
								esc_html__( 'In list of child pages.', 'reykjavik' ),
							),

						'large' => array(
								absint( $content_width ),
								0,
								false,
								esc_html__( 'Not used in the theme.', 'reykjavik' ),
							),

						/**
						 * @since  WordPress 4.4.0
						 */
						'medium_large' => array(
								absint( $content_width ),
								0,
								false,
								esc_html__( 'This is WordPress native image size.', 'reykjavik' ) . '<br>' .
								esc_html__( 'Not used in the theme.', 'reykjavik' ),
							),

						'reykjavik-intro' => array(
								absint( $intro_width ),
								absint( 9 * $intro_width / 16 ),
								true,
								esc_html__( 'In page intro section.', 'reykjavik' ),
							),

					);


			// Output

				return $image_sizes;

		} // /image_sizes



		/**
		 * Register recommended image sizes notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function image_sizes_notice() {

			// Processing

				add_settings_field(
						// $id
						'recommended-image-sizes',
						// $title
						'',
						// $callback
						__CLASS__ . '::image_sizes_notice_html',
						// $page
						'media',
						// $section
						'default',
						// $args
						array()
					);

				register_setting(
						// $option_group
						'media',
						// $option_name
						'recommended-image-sizes',
						// $sanitize_callback
						'esc_attr'
					);

		} // /image_sizes_notice



		/**
		 * Display recommended image sizes notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function image_sizes_notice_html() {

			// Processing

				get_template_part( 'templates/parts/admin/media', 'image-sizes' );

		} // /image_sizes_notice_html





	/**
	 * 50) Typography
	 */

		/**
		 * Google Fonts
		 *
		 * Custom fonts setup left for plugins.
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @param  array $fonts_setup
		 */
		public static function google_fonts( $fonts_setup ) {

			// Requirements check

				if ( Reykjavik_Library_Customize::get_theme_mod( 'typography_custom_fonts' ) ) {
					return array();
				}


			// Helper variables

				$fonts_setup = array();


			// Processing

				/**
				 * translators: Do not translate into your own language!
				 * If there are characters in your language that are not
				 * supported by the font, translate this to 'off'.
				 * The font will not load then.
				 */
				if ( 'off' !== esc_html_x( 'on', 'Montserrat font: on or off', 'reykjavik' ) ) {
					$fonts_setup[] = 'Montserrat:300,400,700';
				}

				/**
				 * translators: Do not translate into your own language!
				 * If there are characters in your language that are not
				 * supported by the font, translate this to 'off'.
				 * The font will not load then.
				 */
				if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'reykjavik' ) ) {
					$fonts_setup[] = 'Open+Sans:300,400,700';
				}


			// Output

				return $fonts_setup;

		} // /google_fonts





	/**
	 * 60) Visual editor
	 */

		/**
		 * Include Visual Editor (TinyMCE) setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function visual_editor() {

			// Processing

				if (
						is_admin()
						|| isset( $_GET['fl_builder'] )
					) {

					require_once REYKJAVIK_LIBRARY . 'includes/classes/class-visual-editor.php';

				}

		} // /visual_editor



		/**
		 * TinyMCE "Formats" dropdown alteration
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 *
		 * @param  array $formats
		 */
		public static function editor_style_formats( $formats ) {

			// Requirements check

				global $post;

				if ( ! isset( $post ) ) {
					return $formats;
				}


			// Processing

				// Font weight classes

					$font_weights = array(

						// Font weight names from https://developer.mozilla.org/en/docs/Web/CSS/font-weight

						100 => esc_html__( 'Thin (hairline) text', 'reykjavik' ),
						200 => esc_html__( 'Extra light text', 'reykjavik' ),
						300 => esc_html__( 'Light text', 'reykjavik' ),
						400 => esc_html__( 'Normal weight text', 'reykjavik' ),
						500 => esc_html__( 'Medium text', 'reykjavik' ),
						600 => esc_html__( 'Semi bold text', 'reykjavik' ),
						700 => esc_html__( 'Bold text', 'reykjavik' ),
						800 => esc_html__( 'Extra bold text', 'reykjavik' ),
						900 => esc_html__( 'Heavy text', 'reykjavik' ),

					);

					$formats[ 250 . 'text_weights' ] = array(
						'title' => esc_html__( 'Text weights', 'reykjavik' ),
						'items' => array(),
					);

					foreach ( $font_weights as $weight => $name ) {
						$formats[ 250 . 'text_weights' ]['items'][ 250 . 'text_weights' . $weight ] = array(
							'title'    => $name . ' (' . $weight . ')',
							'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
							'classes'  => 'has-' . $weight . '-font-weight',
						);
					} // /foreach

				// Font classes

					$formats[ 260 . 'font' ] = array(
						'title' => esc_html__( 'Fonts', 'reykjavik' ),
						'items' => array(

							100 . 'font' . 100 => array(
								'title'    => esc_html__( 'General font', 'reykjavik' ),
								'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
								'classes'  => 'has-root-font-family',
							),

							100 . 'font' . 110 => array(
								'title'    => esc_html__( 'Headings font', 'reykjavik' ),
								'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
								'classes'  => 'has-headings-font-family',
							),

							100 . 'font' . 120 => array(
								'title'    => esc_html__( 'Logo font', 'reykjavik' ),
								'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
								'classes'  => 'has-site-title-font-family',
							),

							100 . 'font' . 130 => array(
								'title'    => esc_html__( 'Inherit font', 'reykjavik' ),
								'selector' => 'p, h1, h2, h3, h4, h5, h6, address, blockquote',
								'classes'  => 'has-inherited-font-family',
							),

						),
					);

				// Columns styles

					$formats[ 400 . 'columns' ] = array(
							'title' => esc_html__( 'Columns', 'reykjavik' ),
							'items' => array(),
						);

					for ( $i = 2; $i <= 3; $i++ ) {
						$formats[ 400 . 'columns' ]['items'][ 400 . 'columns' . ( 100 + 10 * $i ) ] = array(
							'title'   => sprintf( esc_html( _nx( 'Text in %d column', 'Text in %d columns', $i, '%d: Number of columns.', 'reykjavik' ) ), $i ),
							'classes' => 'has-' . $i . '-text-columns',
							'block'   => 'div',
							'wrapper' => true,
						);
					}

				// Buttons

					$formats[ 500 . 'buttons' ] = array(
						'title' => esc_html__( 'Buttons', 'reykjavik' ),
						'items' => array(

							500 . 'buttons' . 100 => array(
								'title'    => esc_html__( 'Button from link', 'reykjavik' ),
								'selector' => 'a',
								'classes'  => 'button',
							),

						),
					);

				// Outdent styles

					$formats[ 600 . 'media' ] = array(
						'title' => esc_html__( 'Outdent', 'reykjavik' ),
						'items' => array(

							600 . 'media' . 100 => array(
								'title'   => esc_html__( 'Outdent selected content', 'reykjavik' ),
								'classes' => 'outdent-content',
								'block'   => 'div',
								'wrapper' => true,
							),

						),
					);

					if ( 'page' === get_post_type( $post ) ) {
						$formats[ 600 . 'media' ]['items'][ 600 . 'media' . 110 ] = array(
							'title'    => esc_html__( 'Outdented heading style', 'reykjavik' ),
							'selector' => 'p, h1, h2, h3, h4, h5, h6',
							'classes'  => 'outdent-heading',
						);
					}


			// Output

				return $formats;

		} // /editor_style_formats





	/**
	 * 100) Others
	 */

		/**
		 * Register post meta
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function register_meta() {

			// Processing

				register_meta( 'post', 'show_intro_widgets', 'absint' );
				register_meta( 'post', 'no_intro',           'absint' );
				register_meta( 'post', 'no_intro_media',     'absint' );
				register_meta( 'post', 'no_thumbnail',       'absint' );
				register_meta( 'post', 'content_layout',     'esc_attr' );
				register_meta( 'post', 'intro_image',        'esc_attr' );

		} // /register_meta



		/**
		 * Widget CSS classes
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $classes
		 */
		public static function widget_css_classes( $classes = array() ) {

			// Processing

				$classes = array_merge( (array) $classes, array(
						'hide-widget-title-accessibly',
						'hide-widget-title',
						'set-flex-grow-2',
						'set-flex-grow-3',
						'set-flex-grow-4',
					) );


			// Output

				return $classes;

		} // /widget_css_classes



		/**
		 * Get color palette setup array.
		 *
		 * Theme mod color classes are constructed with "-mod" suffix:
		 * - .has-{$theme-mod-slug}-mod-color
		 * - .has-{$theme-mod-slug}-mod-background-color
		 *
		 * These should be styled in the theme stylesheet already,
		 * so no need to output any inline CSS code on front-end.
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function get_color_palette() {

			// Variables

				$palette = array();
				$colors  = $colors_unique = (array) Reykjavik_Customize::get_theme_colors();


			// Processing

				$colors_unique = array_column( $colors_unique, 'color', 'id' );
				$colors_unique = array_unique( $colors_unique );
				asort( $colors_unique );

				foreach ( $colors_unique as $slug => $color ) {
					$palette[] = array(
						'name'  => $colors[ $slug ]['name'],
						// Making the slug create `.has-{$theme-mod-slug}-mod-(background)-color` CSS classes.
						// (Though block editor automatically changes "_" to "-", we play safe here.)
						'slug'  => str_replace( '_', '-', $slug ) . '-mod',
						'color' => maybe_hash_hex_color( $color ),
					);
				}


			// Output

				return (array) apply_filters( 'wmhook_reykjavik_setup_get_color_palette', $palette );

		} // /get_color_palette



		/**
		 * Get font sizes setup array.
		 *
		 * These are set in `em` units within the theme stylesheet,
		 * so no need to output any inline CSS code on front-end.
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function get_font_sizes() {

			// Variables

				$base_font_size = Reykjavik_Library_Customize::get_theme_mod( 'typography_size_html' );

				$sizes = array(

					array(
						'name' => _x( 'Extra Small', 'Font size.', 'reykjavik' ),
						'size' => round( $base_font_size * .618 ),
						'slug' => 'extra-small',
					),

					array(
						'name' => _x( 'Small', 'Font size.', 'reykjavik' ),
						'size' => round( $base_font_size * .809 ),
						'slug' => 'small',
					),

					array(
						'name' => _x( 'Normal', 'Font size.', 'reykjavik' ),
						'size' => $base_font_size,
						'slug' => 'normal', // Can not use empty value here as that would cause inline styles being applied.
					),

					array(
						'name' => _x( 'Large', 'Font size.', 'reykjavik' ),
						'size' => round( $base_font_size * 1.382 ),
						'slug' => 'large',
					),

					array(
						'name' => _x( 'Extra Large', 'Font size.', 'reykjavik' ),
						'size' => round( $base_font_size * 1.618 ),
						'slug' => 'extra-large',
					),

				);

				$display_sizes = array(
					1 => 2.618,
					2 => 3.329,
					3 => 4.236,
					4 => 5.387,
				);
				foreach ( $display_sizes as $key => $value ) {
					$sizes[] = array(
						'name' => sprintf( _x( 'Display %d', 'Font size.', 'reykjavik' ), $key ),
						'size' => round( $base_font_size * $value ),
						'slug' => 'display-' . $key,
					);
				}


			// Output

				return (array) apply_filters( 'wmhook_reykjavik_setup_get_font_sizes', $sizes );

		} // /get_font_sizes





} // /Reykjavik_Setup

add_action( 'after_setup_theme', 'Reykjavik_Setup::init', -100 ); // Low priority for early $content_width setup
