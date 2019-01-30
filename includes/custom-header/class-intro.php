<?php
/**
 * Custom Header / Intro Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Setup
 *  20) Output
 *  30) Conditions
 *  40) Assets
 *  50) Special intro
 * 100) Helpers
 */
class Reykjavik_Intro {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @uses  `wmhook_reykjavik_title_primary_disable` global hook to disable `#primary` section H1
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		private function __construct() {

			// Processing

				// Setup

					self::setup();

				// Hooks

					// Actions

						add_action( 'tha_content_top', __CLASS__ . '::container', 15 );

						add_action( 'wmhook_reykjavik_intro_before', __CLASS__ . '::special_wrapper_open', -10 );

						add_action( 'wmhook_reykjavik_intro', __CLASS__ . '::content' );

						add_action( 'wmhook_reykjavik_intro_after', __CLASS__ . '::media', -10 );
						add_action( 'wmhook_reykjavik_intro_after', __CLASS__ . '::special_wrapper_close', 0 );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::special_image', 120 ); // After Reykjavik_Assets::theme_style_file() is hooked.

					// Filters

						add_filter( 'wmhook_reykjavik_intro_disable', __CLASS__ . '::disable', 5 );

						add_filter( 'wmhook_reykjavik_title_primary_disable', __CLASS__ . '::is_enabled' );

						add_filter( 'theme_mod_' . 'header_image', __CLASS__ . '::image', 15 ); // Has to be priority 15 for correct customizer previews.

						add_filter( 'customize_partial_render_' . 'custom_header', __CLASS__ . '::special_image_partial_refresh' );

						add_filter( 'get_header_image_tag', __CLASS__ . '::image_alt_text', 10, 3 );

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
		 * Setup custom header
		 *
		 * @link  https://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
		 * @link  https://make.wordpress.org/core/2016/11/26/video-headers-in-4-7/
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function setup() {

			// Helper variables

				$image_sizes = array_filter( apply_filters( 'wmhook_reykjavik_setup_image_sizes', array() ) );


			// Processing

				add_theme_support( 'custom-header', apply_filters( 'wmhook_reykjavik_custom_header_args', array(
					'default-text-color' => 'ffffff',
					'width'              => ( isset( $image_sizes['reykjavik-intro'] ) ) ? ( $image_sizes['reykjavik-intro'][0] ) : ( 1920 ),
					'height'             => ( isset( $image_sizes['reykjavik-intro'] ) ) ? ( $image_sizes['reykjavik-intro'][1] ) : ( 1080 ),
					'flex-width'         => true,
					'flex-height'        => true,
					'video'              => true,
					/**
					 * WordPress issue:
					 *
					 * We can not use `random-default` as in that case there is no "Hide image" button displayed in customizer.
					 * We simply have to set up a `default-image`, unfortunately...
					 */
					'default-image'  => '%s/assets/images/header/pixabay-colorado-1436681.png',
					'random-default' => false,
				) ) );

				// Default custom headers packed with the theme

					register_default_headers( array(

						'pixabay-colorado-1436681' => array(
							'url'           => '%s/assets/images/header/pixabay-colorado-1436681.png',
							'thumbnail_url' => '%s/assets/images/header/thumbnail/pixabay-colorado-1436681.png',
							'description'   => esc_html_x( 'Mountains drawing', 'Header image description.', 'reykjavik' ),
						),

					) );

		} // /setup





	/**
	 * 20) Output
	 */

		/**
		 * Container
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function container() {

			// Requirements check

				if ( self::is_disabled() ) {
					return;
				}


			// Processing

				get_template_part( 'templates/parts/intro/intro', 'container' );

		} // /container



		/**
		 * Content
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function content() {

			// Helper variables

				$post_type = ( is_singular() ) ? ( get_post_type() ) : ( '' );


			// Processing

				get_template_part( 'templates/parts/intro/intro-content', $post_type );

		} // /content



		/**
		 * Media
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function media() {

			// Helper variables

				$post_type = ( is_singular() ) ? ( get_post_type() ) : ( '' );


			// Processing

				get_template_part( 'templates/parts/intro/intro-media', $post_type );

		} // /media





	/**
	 * 30) Conditions
	 */

		/**
		 * Is Intro disabled?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function is_disabled() {

			// Output

				return (bool) apply_filters( 'wmhook_reykjavik_intro_disable', false );

		} // /is_disabled



		/**
		 * Is Intro enabled?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function is_enabled() {

			// Output

				return (bool) ! self::is_disabled();

		} // /is_enabled



		/**
		 * Disabling conditions
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  boolean $disable
		 */
		public static function disable( $disable = false ) {

			// Helper variables

				// Check if is_singular() to prevent issues in archives

					$meta_no_intro = ( is_singular() ) ? ( get_post_meta( get_the_ID(), 'no_intro', true ) ) : ( '' );


			// Output

				return is_404() || is_attachment() || ! empty( $meta_no_intro );

		} // /disable





	/**
	 * 40) Assets
	 */

		/**
		 * Header image URL
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @param  string $url  Image URL or other custom header value.
		 */
		public static function image( $url ) {

			// Requirements check

				if ( ! is_singular() && ! is_home() ) {
					return $url;
				}


			// Helper variables

				$image_size = 'reykjavik-intro';
				$post_id    = ( is_home() && ! is_front_page() ) ? ( get_option( 'page_for_posts' ) ) : ( null );

				if ( empty( $post_id ) ) {
					$post_id = get_the_ID();
				}

				$intro_image = trim( get_post_meta( $post_id, 'intro_image', true ) );


			// Processing

				if ( $intro_image ) {

					if ( is_numeric( $intro_image ) ) {
						$url = wp_get_attachment_image_src( absint( $intro_image ), $image_size );
						$url = $url[0];
					} else {
						$url = (string) $intro_image;
					}

				} elseif ( has_post_thumbnail( $post_id ) && ! ( is_home() && is_front_page() ) ) {

					$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $image_size );
					$url = $url[0];

				} elseif ( ! is_front_page() ) {

					/**
					 * Remove custom header on single post/page if:
					 * - there is no featured image
					 * - there is no intro image
					 *
					 * @link  https://developer.wordpress.org/reference/functions/get_header_image/
					 */
					$url = 'remove-header';

				}


			// Output

				return $url;

		} // /image





	/**
	 * 50) Special intro
	 */

		/**
		 * Front page special intro wrapper: open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function special_wrapper_open() {

			// Requirements check

				if ( ! is_front_page() || Reykjavik_Post::is_paged() ) {
					return;
				}


			// Output

				echo '<div class="intro-special">';

		} // /special_wrapper_open



		/**
		 * Front page special intro wrapper: close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function special_wrapper_close() {

			// Requirements check

				if ( ! is_front_page() || Reykjavik_Post::is_paged() ) {
					return;
				}


			// Output

				echo '</div>';

		} // /special_wrapper_close



		/**
		 * Setting custom header image as an intro background for special intro
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function special_image() {

			// Requirements check

				if ( self::is_disabled() ) {
					return;
				}


			// Processing

				if ( $css = self::get_special_image_css() ) {
					wp_add_inline_style(
						'reykjavik',
						Reykjavik_Customize_Styles::esc_css( $css . "\r\n\r\n" )
					);
				}

		} // /special_image



		/**
		 * Get custom header special intro CSS
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function get_special_image_css() {

			// Requirements check

				if (
						! is_front_page()
						|| Reykjavik_Post::is_paged()
						|| ! $image_url = get_header_image()
					) {
					return;
				}


			// Output

				return ".intro-special { background-image: url('" . esc_url_raw( $image_url ) . "'); }";

		} // /get_special_image_css



		/**
		 * Output custom image CSS in customizer partial refresh
		 *
		 * Simply replace the last "</div>" (6 characters) with custom HTML output.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function special_image_partial_refresh( $rendered ) {

			// Output

				return substr( $rendered, 0, -6 )
					. '<style>'
					. '.intro-special { background-image: none; }'
					. self::get_special_image_css()
					. '</style>'
					. '</div>';

		} // /special_image_partial_refresh





	/**
	 * 100) Helpers
	 */

		/**
		 * Custom header image alt text fix.
		 *
		 * However, this does not always work. If the image URL is overridden
		 * with `self::image()` above, the attachment ID is different, thus
		 * the alt text could not be applied. This has to be fixed in WP core
		 * or completely redone in theme with custom code...
		 *
		 * @link  https://core.trac.wordpress.org/ticket/46124
		 * @todo  Remove with WordPress 5.2?
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 */
		public static function image_alt_text( $html, $header, $attr ) {

			// Processing

				if ( isset( $header->attachment_id ) ) {
					$image_alt = get_post_meta( $header->attachment_id, '_wp_attachment_image_alt', true );
					if (
						! empty( $image_alt )
						&& wp_get_attachment_url( $header->attachment_id ) === $attr['src']
					) {
						$attr['alt'] = $image_alt;
						$html = '<img';
						foreach ( $attr as $name => $value ) {
							$html .= ' ' . $name . '="' . esc_attr( $value ) . '"';
						}
						$html .= ' />';
					}
				}


			// Output

				return $html;

		} // /image_alt_text





} // /Reykjavik_Intro

add_action( 'after_setup_theme', 'Reykjavik_Intro::init' );
