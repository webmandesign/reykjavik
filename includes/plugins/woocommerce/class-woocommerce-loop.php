<?php
/**
 * WooCommerce: Loop Class
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
 *  20) Categories
 *  30) Controls
 * 100) Others
 */
class Reykjavik_WooCommerce_Loop {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.2.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Removing

						remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

						remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

						remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );

						remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

						remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );

					// Actions

						add_action( 'woocommerce_before_shop_loop', __CLASS__ . '::categories', 5 );

						add_action( 'woocommerce_before_shop_loop', __CLASS__ . '::products_sorting' );

						add_action( 'woocommerce_before_shop_loop', __CLASS__ . '::shop_loop_title', 100 );

						add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 40 );

						add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 50 );

						add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 60 );

						add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5 );

						add_action( 'woocommerce_before_subcategory_title', __CLASS__ . '::category_button', 20 );

						add_action( 'woocommerce_before_subcategory_title', __CLASS__ . '::category_label', 95 );

						add_action( 'woocommerce_after_shop_loop', __CLASS__ . '::products_sorting', 5 );

						add_action( 'woocommerce_after_shop_loop', __CLASS__ . '::pagination' );

						add_filter( 'init', __CLASS__ . '::set_shop_columns' );

						add_action( 'wp', __CLASS__ . '::search_results' );

					// Filters

						add_filter( 'woocommerce_before_shop_loop', __CLASS__ . '::active_filters',  20 );
						add_filter( 'woocommerce_after_shop_loop',  __CLASS__ . '::active_filters', -10 );

						add_filter( 'woocommerce_pagination_args', __CLASS__ . '::pagination_args' );

						add_filter( 'the_title', __CLASS__ . '::search_results_product_title', 10, 2 );

						add_filter( 'wmhook_reykjavik_post_media_image_size', __CLASS__ . '::product_media_size', 15 );

						add_filter( 'wmhook_reykjavik_is_masonry_layout', __CLASS__ . '::is_masonry' );

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
		 * Set shop columns
		 *
		 * @since    1.0.5
		 * @version  1.0.5
		 */
		public static function set_shop_columns() {

			// Processing

				if ( ! function_exists( 'wc_reset_product_grid_settings' ) ) {
					add_filter( 'loop_shop_columns', __CLASS__ . '::shop_columns' );
				}

		} // /set_shop_columns



		/**
		 * Shop columns
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  integer $columns
		 */
		public static function shop_columns( $columns ) {

			// Processing

				if ( is_active_sidebar( 'sidebar' ) ) {
					$columns = Reykjavik_WooCommerce_Helpers::return_number( 'shop_columns_sidebar' );
				}


			// Output

				return $columns;

		} // /shop_columns



		/**
		 * Product image size in search
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $image_size
		 */
		public static function product_media_size( $image_size ) {

			// Processing

				if (
						is_search()
						&& 'product' === get_post_type()
					) {
					$image_size = 'shop_catalog_image_size';
				}


			// Output

				return $image_size;

		} // /product_media_size





	/**
	 * 20) Categories
	 */

		/**
		 * Display list of (sub)categories
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function categories() {

			// Requirements check

				if (
						is_paged()
						|| is_filtered()
						|| is_search()
						|| ! ( is_shop() || is_tax( 'product_cat' ) )
						|| ( is_shop() && 'both' !== get_option( 'woocommerce_shop_page_display' ) )
						|| ( is_tax( 'product_cat' ) && 'both' !== get_option( 'woocommerce_category_archive_display' ) )
					) {
					return;
				}


			// Output

				get_template_part( 'templates/parts/loop/loop', 'categories-product' );

				add_filter( 'pre_option_woocommerce_shop_page_display', '__return_empty_string' );

				add_filter( 'pre_option_woocommerce_category_archive_display', '__return_empty_string' );

		} // /categories



		/**
		 * Category description top
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function category_label() {

			// Output

				echo '<p class="category-label">' . esc_html__( 'Shop Category', 'reykjavik' ) . '</p>';

		} // /category_label



		/**
		 * Category description bottom
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  object $category
		 */
		public static function category_button( $category = null ) {

			// Output

				echo '<span class="button">' . esc_html__( 'Shop Now &rarr;', 'reykjavik' ) . '</span>';

		} // /category_button





	/**
	 * 30) Controls
	 */

		/**
		 * Products sorting
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function products_sorting() {

			// Output

				echo '<div class="products-sorting">';

					woocommerce_result_count();
					woocommerce_catalog_ordering();

				echo '</div>';

		} // /products_sorting



		/**
		 * Active filters
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function active_filters() {

			// Helper variables

				$widget = 'WC_Widget_Layered_Nav_Filters';


			// Requirements check

				if ( ! class_exists( $widget ) ) {
					return;
				}


			// Output

				the_widget( $widget );

		} // /active_filters



		/**
		 * Pagination
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function pagination() {

			// Requirements check

				if ( ! function_exists( 'woocommerce_pagination' ) ) {
					return;
				}


			// Processing

				ob_start();
				woocommerce_pagination();

				if ( function_exists( 'wc_get_loop_prop' ) ) {
					$total   = wc_get_loop_prop( 'total_pages' );
					$current = wc_get_loop_prop( 'current_page' );
				} else {
					// WooCommerce 3.3- backwards compatibility
					global $wp_query;
					$total   = ( isset( $wp_query->max_num_pages ) ) ? ( $wp_query->max_num_pages ) : ( 1 );
					$current = ( get_query_var( 'paged' ) ) ? ( absint( get_query_var( 'paged' ) ) ) : ( 1 );
				}

				$html = str_replace(
					'<nav class="woocommerce-pagination',
					'<nav aria-label="' . esc_attr__( 'Products Navigation', 'reykjavik' ) . '" data-current="' . esc_attr( $current ) . '" data-total="' . esc_attr( $total ) . '" class="pagination woocommerce-pagination',
					ob_get_clean()
				);


			// Output

				echo $html; // WPCS: XSS OK.

		} // /pagination



		/**
		 * Pagination setup
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function pagination_args( $args = array() ) {

			// Processing

				$args['type'] = 'plain';

				$args['prev_text'] = esc_html_x( '&laquo;', 'Pagination text (visible): previous.', 'reykjavik' )
				                     . '<span class="screen-reader-text"> '
				                     . esc_html_x( 'Previous page', 'Pagination text (hidden): previous.', 'reykjavik' )
				                     . '</span>';

				$args['next_text'] = '<span class="screen-reader-text">'
				                     . esc_html_x( 'Next page', 'Pagination text (hidden): next.', 'reykjavik' )
				                     . ' </span>'
				                     . esc_html_x( '&raquo;', 'Pagination text (visible): next.', 'reykjavik' );


			// Output

				return (array) apply_filters( 'wmhook_reykjavik_pagination_args', $args, 'woocommerce' );

		} // /pagination_args





	/**
	 * 100) Others
	 */

		/**
		 * Products list title
		 *
		 * Adding heading to non-titled lists to improve accessibility.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  integer $columns
		 */
		public static function shop_loop_title() {

			// Output

				echo '<h2 class="screen-reader-text">' . esc_html__( 'List of products', 'reykjavik' ) . '</h2>';

		} // /shop_loop_title



		/**
		 * Fix search results list
		 *
		 * Removing WooCommerce body classes on blog search results page.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function search_results() {

			// Processing

				if ( is_search() && ! is_post_type_archive( 'product' ) ) {
					remove_filter( 'body_class', 'wc_body_class' );
				}

		} // /search_results



		/**
		 * Price in product title in global search
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $title The post title.
		 * @param  int    $id    The post ID.
		 */
		public static function search_results_product_title( $title, $id ) {

			// Requirements check

				if (
						! is_search()
						|| is_post_type_archive( 'product' )
						|| 'product' !== get_post_type( $id )
					) {
					return $title;
				}


			// Helper variables

				$product = wc_setup_product_data( $id );


			// Output

				return $title . ' <span class="price">' . $product->get_price_html() . '</span>';

		} // /search_results_product_title



		/**
		 * When to use masonry posts layout?
		 *
		 * @since    1.2.0
		 * @version  1.2.0
		 *
		 * @param  boolean $is_masonry
		 */
		public static function is_masonry( $is_masonry ) {

			// Processing

				if (
					( is_shop() || is_product_taxonomy() )
					&& 'uncropped' === get_option( 'woocommerce_thumbnail_cropping' )
				) {
					$is_masonry = true;
				}


			// Output

				return $is_masonry;

		} // /is_masonry





} // /Reykjavik_WooCommerce_Loop

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Loop::init' );
