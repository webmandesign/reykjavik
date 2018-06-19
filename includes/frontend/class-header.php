<?php
/**
 * Header Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.2.0
 *
 * Contents:
 *
 *  0) Init
 * 10) HTML head
 * 20) Body start
 * 30) Site header
 * 40) Setup
 */
class Reykjavik_Header {





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

						add_action( 'tha_html_before', __CLASS__ . '::doctype' );

						add_action( 'wp_head', __CLASS__ . '::head', 1 );
						add_action( 'wp_head', __CLASS__ . '::head_pingback', 1 );
						add_action( 'wp_head', __CLASS__ . '::head_chrome_color', 1 );

						add_action( 'tha_body_top', __CLASS__ . '::oldie', 5 );
						add_action( 'tha_body_top', __CLASS__ . '::site_open' );
						add_action( 'tha_body_top', __CLASS__ . '::skip_links' );

						add_action( 'tha_header_top', __CLASS__ . '::open', 1 );
						add_action( 'tha_header_top', __CLASS__ . '::open_inner', 2 );
						add_action( 'tha_header_top', __CLASS__ . '::site_branding' );

						add_action( 'tha_header_bottom', __CLASS__ . '::close_inner', 1 );
						add_action( 'tha_header_bottom', __CLASS__ . '::close', 101 );

					// Filters

						add_filter( 'body_class', __CLASS__ . '::body_class', 98 );

						add_filter( 'tiny_mce_before_init', __CLASS__ . '::editor_body_class' );

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
	 * 10) HTML head
	 */

		/**
		 * HTML DOCTYPE
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function doctype() {

			// Output

				echo '<!doctype html>';

		} // /doctype



		/**
		 * HTML HEAD
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function head() {

			// Processing

				get_template_part( 'templates/parts/header/head' );

		} // /head



		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function head_pingback() {

			// Output

				if ( is_singular() && pings_open() ) {
					echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
				}

		} // /head_pingback



		/**
		 * Chrome theme color with support for Chrome Theme Color Changer plugin
		 *
		 * @see  https://wordpress.org/plugins/chrome-theme-color-changer
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function head_chrome_color() {

			// Output

				if ( ! class_exists( 'Chrome_Theme_Color_Changer' ) ) {
					echo '<meta name="theme-color" content="' . esc_attr( get_theme_mod( 'color_header_background', '#fefeff' ) ) . '">';
				}

		} // /head_chrome_color





	/**
	 * 20) Body start
	 */

		/**
		 * IE upgrade message
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function oldie() {

			// Requirements check

				if ( ! isset( $GLOBALS['is_IE'] ) || ! $GLOBALS['is_IE'] ) {
					return;
				}


			// Processing

				get_template_part( 'templates/parts/component', 'oldie' );

		} // /oldie



		/**
		 * Skip links: Body top
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function skip_links() {

			// Output

				echo '<ul class="skip-link-list">'
				     . '<li class="skip-link-list-item">'
				     . Reykjavik_Library::link_skip_to( 'site-navigation', __( 'Skip to main navigation', 'reykjavik' ) )
				     . '</li>'
				     . '<li class="skip-link-list-item">'
				     . Reykjavik_Library::link_skip_to( 'content' )
				     . '</li>'
				     . '<li class="skip-link-list-item">'
				     . Reykjavik_Library::link_skip_to( 'colophon', __( 'Skip to footer', 'reykjavik' ) )
				     . '</li>'
				     . '</ul>';

		} // /skip_links



		/**
		 * Site container: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function site_open() {

			// Output

				echo '<div id="page" class="site">' . "\r\n";

		} // /site_open





	/**
	 * 30) Site header
	 *
	 * Header widgets:
	 * @see  includes/frontend/class-sidebar.php
	 *
	 * Header menu:
	 * @see  includes/frontend/class-menu.php
	 */

		/**
		 * Header: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open() {

			// Output

				echo "\r\n\r\n" . '<header id="masthead" class="site-header">' . "\r\n\r\n";

		} // /open



		/**
		 * Header: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close() {

			// Output

				echo "\r\n\r\n" . '</header>' . "\r\n\r\n";

		} // /close



		/**
		 * Header inner container: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open_inner() {

			// Output

				echo "\r\n\r\n" . '<div class="site-header-content"><div class="site-header-inner">' . "\r\n\r\n";

		} // /open_inner



		/**
		 * Header inner container: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close_inner() {

			// Output

				echo "\r\n\r\n" . '</div></div>' . "\r\n\r\n";

		} // /close_inner



		/**
		 * Logo, site branding
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function site_branding() {

			// Output

				get_template_part( 'templates/parts/header/site', 'branding' );

		} // /site_branding





	/**
	 * 40) Setup
	 */

		/**
		 * HTML Body classes
		 *
		 * @since    1.0.0
		 * @version  1.2.0
		 *
		 * @param  array $classes
		 */
		public static function body_class( $classes = array() ) {

			// Helper variables

				$classes = (array) $classes; // Just in case...


			// Processing

				// JS fallback

					$classes[] = 'no-js';

				// Website layout

					if ( $layout_site = get_theme_mod( 'layout_site', 'fullwidth' ) ) {
						$classes[] = esc_attr( 'site-layout-' . $layout_site );
					}

				// Header layout

					if ( $layout_header = get_theme_mod( 'layout_header', 'fullwidth' ) ) {
						$classes[] = esc_attr( 'header-layout-' . $layout_header );
					}

				// Footer layout

					if ( $layout_footer = get_theme_mod( 'layout_footer', 'boxed' ) ) {
						$classes[] = esc_attr( 'footer-layout-' . $layout_footer );
					}

				// Is mobile navigation enabled?

					if ( get_theme_mod( 'navigation_mobile', true ) ) {
						$classes[] = 'has-navigation-mobile';
					}

				// Is site branding text displayed?

					if ( 'blank' === get_header_textcolor() ) {
						$classes[] = 'site-title-hidden';
					}

				// Singular?

					if ( is_singular() ) {
						$classes[] = 'is-singular';

						$post_id = get_the_ID();

						// Privacy Policy page

							if ( (int) get_option( 'wp_page_for_privacy_policy' ) === $post_id ) {
								$classes[] = 'page-privacy-policy';
							}

						// Has featured image?

							if ( has_post_thumbnail() ) {
								$classes[] = 'has-post-thumbnail';
							}

						// Has custom intro image?

							if ( get_post_meta( $post_id, 'intro_image', true ) ) {
								$classes[] = 'has-custom-intro-image';
							}

						// Any page builder layout

							$content_layout = (string) get_post_meta( $post_id, 'content_layout', true );

							if ( 'stretched' === $content_layout ) {
								$classes[] = 'content-layout-no-paddings';
								$classes[] = 'content-layout-stretched';
							} elseif ( 'no-paddings' === $content_layout ) {
								$classes[] = 'content-layout-no-paddings';
							}

					} else {

						// Add a class of hfeed to non-singular pages

							$classes[] = 'hfeed';

					}

				// Has more than 1 published author?

					if ( is_multi_author() ) {
						$classes[] = 'group-blog';
					}

				// Intro displayed?

					if ( ! (bool) apply_filters( 'wmhook_reykjavik_intro_disable', false ) ) {
						$classes[] = 'has-intro';
					} else {
						$classes[] = 'no-intro';
					}

				// Widget areas

					foreach ( (array) apply_filters( 'wmhook_reykjavik_header_body_classes_sidebars', array() ) as $sidebar ) {
						if ( ! is_active_sidebar( $sidebar ) ) {
							$classes[] = 'no-widgets-' . $sidebar;
						} else {
							$classes[] = 'has-widgets-' . $sidebar;
						}
					}

				// Posts layout

					if (
							is_home()
							|| is_category()
							|| is_tag()
							|| is_date()
							|| is_author() // Display author archive as posts, not as custom post type archive.
						) {
						$classes[] = 'posts-layout-list';
					}

					if ( (bool) apply_filters( 'wmhook_reykjavik_is_masonry_layout', false ) ) {
						$classes[] = 'posts-layout-masonry';
					}

				// Enable outdented page layout

					if (
							is_page()
							&& ! is_attachment() // This is required for attachments added to a page.
							&& ! is_page_template( 'templates/sidebar.php' )
							&& get_theme_mod( 'layout_page_outdent', true )
						) {
						$classes[] = 'page-layout-outdented';
					}

				// Enable outdented single post meta

					if ( (bool) apply_filters( 'wmhook_reykjavik_header_body_classes_enable_entry_meta_outdented',
						is_single( get_the_ID() )
						&& ! is_active_sidebar( 'sidebar' )
						&& ! Reykjavik_Post::is_page_builder_ready()
					) ) {
						$classes[] = 'entry-meta-outdented';
					}


			// Output

				asort( $classes );

				return array_unique( $classes );

		} // /body_class



		/**
		 * HTML Body classes in content editor (TinyMCE)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $init
		 */
		public static function editor_body_class( $init = array() ) {

			// Requirements check

				global $post;

				if ( ! is_admin() || ! isset( $post ) ) {
					return $init;
				}


			// Processing

				// Page classes

					if ( 'page' === get_post_type( $post ) ) {

						// Outdented page layout

							if ( get_theme_mod( 'layout_page_outdent', true ) ) {
								$init['body_class'] .= ' page-layout-outdented';
							}

						// Any page builder ready

							$content_layout = (string) get_post_meta( $post->ID, 'content_layout', true );

							if ( in_array( $content_layout, array( 'stretched', 'no-paddings' ) ) ) {
								$init['body_class'] .= ' content-layout-no-paddings';
							}

					}


			// Output

				return $init;

		} // /editor_body_class





} // /Reykjavik_Header

add_action( 'after_setup_theme', 'Reykjavik_Header::init' );
