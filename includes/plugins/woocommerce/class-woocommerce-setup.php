<?php
/**
 * WooCommerce: Setup Class
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
 *  10) Classes
 *  20) Breadcrumbs
 * 100) Others
 */
class Reykjavik_WooCommerce_Setup {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		private function __construct() {

			// Processing

				// Setup

					// Declare compatibility

						add_theme_support( 'woocommerce', array(

							// 'single_image_width'    => 1200,
							// 'thumbnail_image_width' => 480,

							'product_grid' => array(

								'default_columns' => Reykjavik_WooCommerce_Helpers::return_number( 'shop_columns' ),
								'min_columns'     => 2,
								'max_columns'     => 5,

								'default_rows' => 2,
								'min_rows'     => 2,
								'max_rows'     => 8,

							),

						) );

						// WC 3.0+ product gallery

							add_theme_support( 'wc-product-gallery-zoom' );
							add_theme_support( 'wc-product-gallery-lightbox' );
							add_theme_support( 'wc-product-gallery-slider' );

				// Hooks

					// Removing

						remove_action( 'wp_footer', 'woocommerce_demo_store' );

						remove_filter( 'wp_nav_menu', 'Reykjavik_Menu::mobile_menu_search', 20 );

					// Actions

						add_action( 'init', __CLASS__ . '::remove_gallery_noscript' );

						add_action( 'wmhook_reykjavik_breadcrumb_navxt_before', __CLASS__ . '::breadcrumb_navxt' );
						add_action( 'wmhook_reykjavik_breadcrumb_navxt_after',  __CLASS__ . '::breadcrumb_navxt' );

						add_action( 'tha_header_top', __CLASS__ . '::mobile_menu_links', 15 );

						add_action( 'tha_content_before', __CLASS__ . '::demo_store' );

					// Filters

						add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

						add_filter( 'woocommerce_review_gravatar_size', __CLASS__ . '::review_gravatar_size' );

						add_filter( 'woocommerce_breadcrumb_defaults', __CLASS__ . '::breadcrumb_defaults' );

						add_filter( 'post_class', __CLASS__ . '::post_class', 30, 3 );
						add_filter( 'tiny_mce_before_init', __CLASS__ . '::editor_body_class', 20 );

						add_filter( 'wp_nav_menu', __CLASS__ . '::mobile_menu_search', 20, 2 ); // See below for priority info

						add_filter( 'wmhook_reykjavik_summary_continue_reading_post_type', __CLASS__ . '::add_product_post_type' );
						add_filter( 'wmhook_reykjavik_post_navigation_post_type',          __CLASS__ . '::add_product_post_type' );
						add_filter( 'wmhook_reykjavik_subtitles_post_types',               __CLASS__ . '::add_product_post_type' );

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
	 * 10) Classes
	 */

		/**
		 * Product class
		 *
		 * Note: do not use `.added-to-cart` class on page refresh
		 * due to caching issues. @see  https://goo.gl/9TU5tW
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array  $classes
		 * @param  string $class
		 * @param  int    $post_id
		 */
		public static function post_class( $classes, $class = '', $post_id = '' ) {

			// Requirements check

				if (
						is_admin()
						|| ! $post_id
						|| 'product' !== get_post_type( $post_id )
					) {
					return $classes;
				}


			// Helper variables

				$classes = (array) $classes; // Just in case...
				$product = wc_get_product( $post_id );


			// Processing

				// Has gallery (product thumbnails)?

					if ( Reykjavik_WooCommerce_Helpers::get_product_gallery_image_ids( $product ) ) {
						$classes[] = 'has-gallery';
					}


			// Output

				return $classes;

		} // /post_class



		/**
		 * HTML Body classes in content editor (TinyMCE)
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 *
		 * @param  array $init
		 */
		public static function editor_body_class( $init = array() ) {

			// Requirements check

				global $post;

				if (
					! isset( $init['body_class'] )
					|| ! is_admin()
					|| ! is_callable( 'wc_get_page_id' )
					|| ! $post instanceof WP_Post
				) {
					return $init;
				}


			// Processing

				if ( wc_get_page_id( 'shop' ) == $post->ID ) {
					$init['body_class']  = str_replace( ' page-layout-outdented', '', $init['body_class'] );
					$init['body_class'] .= ' woocommerce-page-shop ';
				}


			// Output

				return $init;

		} // /editor_body_class





	/**
	 * 20) Breadcrumbs
	 */

		/**
		 * Breadcrumbs setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function breadcrumb_defaults( $args = array() ) {

			// Processing

				$args['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
				$args['before']      = '<span class="woocommerce-breadcrumb-item">';
				$args['after']       = '</span>';
				$args['delimiter']   = '<span class="woocommerce-breadcrumb-delimiter">&nbsp;&#47;&nbsp;</span>';


			// Output

				return $args;

		} // /breadcrumb_defaults



		/**
		 * Breadcrumbs NavXT setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function breadcrumb_navxt() {

			// Requirements check

				if ( ! class_exists( 'Reykjavik_WooCommerce_Pages' ) ) {
					return;
				}


			// Processing

				if ( doing_action( 'wmhook_reykjavik_breadcrumb_navxt_before' ) ) {
					add_filter( 'the_title', 'Reykjavik_WooCommerce_Pages::page_endpoint_title' );
				} else {
					remove_filter( 'the_title', 'Reykjavik_WooCommerce_Pages::page_endpoint_title' );
				}

		} // /breadcrumb_navxt





	/**
	 * 100) Others
	 */

		/**
		 * Allow features to work with products
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $post_types
		 */
		public static function add_product_post_type( $post_types = array() ) {

			// Processing

				$post_types[] = 'product';


			// Output

				return $post_types;

		} // /add_product_post_type



		/**
		 * Review author avatar image size
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function review_gravatar_size() {

			// Output

				return 120;

		} // /review_gravatar_size



		/**
		 * Mobile menu links
		 *
		 * Adding "My Account" page and "Checkout" page links for mobile menu.
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 */
		public static function mobile_menu_links() {

			// Requirements check

				if ( ! Reykjavik_Library_Customize::get_theme_mod( 'navigation_mobile' ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$links = array_filter( (array) apply_filters( 'wmhook_reykjavik_woocommerce_setup_mobile_menu_links', array( 'checkout', 'myaccount' ) ) );


			// Processing

				if ( ! empty( $links ) ) {
					foreach ( $links as $page ) {

						$page_id = wc_get_page_id( $page );

						if ( 0 < $page_id ) {
							$output .= '<a href="' . esc_url( wc_get_page_permalink( $page ) ) . '" class="button link-' . esc_attr( $page ) . '">' . get_the_title( $page_id ) . '</a>';
						}

					} // foreach
				}


			// Output

				if ( $output ) {
					echo '<div class="shop-mobile-menu-links">' . $output . '</div>';
				}

		} // /mobile_menu_links



		/**
		 * Mobile menu search form
		 *
		 * Replacing mobile menu default search form for product search form.
		 *
		 * Note:
		 * Not sure why, but has to use higher priority than 10 when hooking
		 * this method, as otherwise in some weird cases (wasn't able
		 * to determine the cause) customizer displays the menu twice.
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @param  string $nav_menu
		 * @param  object $args
		 */
		public static function mobile_menu_search( $nav_menu, $args ) {

			// Requirements check

				if (
					'primary' !== $args->theme_location
					|| ! Reykjavik_Library_Customize::get_theme_mod( 'navigation_mobile' )
				) {
					return $nav_menu;
				}


			// Output

				return '<div class="mobile-search-form mobile-search-products-form">' . get_product_search_form( false ) . '</div>' . $nav_menu;

		} // /mobile_menu_search



		/**
		 * Demo store notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function demo_store() {

			// Requirements check

				if (
						! is_woocommerce()
						&& ! is_cart()
						&& ! is_checkout()
						&& ! is_account_page()
					) {
					return;
				}


			// Processing

				woocommerce_demo_store();

		} // /demo_store



		/**
		 * Remove unnecessary `noscript` tag
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function remove_gallery_noscript() {

			// Processing

				remove_action( 'wp_head', 'wc_gallery_noscript' );

		} // /remove_gallery_noscript





} // /Reykjavik_WooCommerce_Setup

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Setup::init' );
