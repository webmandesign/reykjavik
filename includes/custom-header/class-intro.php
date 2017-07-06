<?php
/**
 * Custom Header / Intro Class
 *
 * @package    Reykjavík
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Setup
 * 20) Output
 * 30) Conditions
 * 40) Assets
 * 50) Special intro
 */
class Reykjavik_Intro {





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

				// Setup

					self::setup();

				// Hooks

					// Actions

						add_action( 'tha_content_top', __CLASS__ . '::container', 15 );

						add_action( 'wmhook_reykjavik_intro_before', __CLASS__ . '::special_wrapper_open', -10 );

						add_action( 'wmhook_reykjavik_intro', __CLASS__ . '::content' );

						add_action( 'wmhook_reykjavik_intro_after', __CLASS__ . '::media', -10 );

						add_action( 'wmhook_reykjavik_intro_after', __CLASS__ . '::special_wrapper_close', 0 );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::special_image', 120 );

					// Filters

						add_filter( 'wmhook_reykjavik_intro_disable', __CLASS__ . '::disable', 5 );

						add_filter( 'theme_mod_header_image', __CLASS__ . '::image', 15 ); // Has to be priority 15 for correct customizer previews.

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
						'random-default'     => true,
						'default-text-color' => 'ffffff',
						'width'              => ( isset( $image_sizes['reykjavik-intro'] ) ) ? ( $image_sizes['reykjavik-intro'][0] ) : ( 1920 ),
						'height'             => ( isset( $image_sizes['reykjavik-intro'] ) ) ? ( $image_sizes['reykjavik-intro'][1] ) : ( 1080 ),
						'flex-width'         => true,
						'flex-height'        => true,
						'video'              => true,
					) ) );

				// Default custom headers packed with the theme

					register_default_headers( array(

							'unsplash-matt-howard-248421' => array(
								'url'           => '%s/assets/images/header/unsplash-matt-howard-248421.jpg',
								'thumbnail_url' => '%s/assets/images/header/thumbnail/unsplash-matt-howard-248421.jpg',
								'description'   => esc_html_x( 'Cliffs', 'Header image description.', 'reykjavik' ),
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

			// Pre

				$disable = (bool) apply_filters( 'wmhook_reykjavik_intro_disable', false );

				$pre = apply_filters( 'wmhook_reykjavik_intro_container_pre', $disable );

				if ( false !== $pre ) {
					if ( true !== $pre ) {
						echo $pre;
					}
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
		 * @version  1.0.0
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

				} elseif ( has_post_thumbnail( $post_id ) ) {

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
		 * Setting custom header image as an intro background for front page special intro
		 *
		 * @uses  `wmhook_reykjavik_esc_css` global hook
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function special_image() {

			// Pre

				$disable = (bool) apply_filters( 'wmhook_reykjavik_intro_disable', false );

				$pre = apply_filters( 'wmhook_reykjavik_intro_special_image_pre', $disable );

				if ( false !== $pre ) {
					if ( true !== $pre ) {
						echo $pre;
					}
					return;
				}


			// Requirements check

				if ( ! is_front_page() || Reykjavik_Post::is_paged() ) {
					return;
				}


			// Helper variables

				$image_url = get_header_image();


			// Processing

				if ( $image_url = get_header_image() ) {
					$styles = ".intro-special { background-image: url('" . esc_url_raw( $image_url ) . "'); }" . "\r\n\r\n";
					wp_add_inline_style( 'reykjavik-stylesheet', apply_filters( 'wmhook_reykjavik_esc_css', $styles ) );
				}

		} // /special_image





} // /Reykjavik_Intro

add_action( 'after_setup_theme', 'Reykjavik_Intro::init' );
