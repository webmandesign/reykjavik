<?php
/**
 * WooCommerce: Wrappers Class
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
 *  10) Template
 *  20) Product
 * 100) Others
 */
class Reykjavik_WooCommerce_Wrappers {





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

				// Removing

					remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );

					remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

				// Actions

					add_action( 'woocommerce_before_template_part', __CLASS__ . '::template_part_wrapper_open' );

					add_action( 'woocommerce_after_template_part', __CLASS__ . '::template_part_wrapper_close' );

					add_action( 'woocommerce_before_single_product_summary', __CLASS__ . '::product_info_open', -10 );

					add_action( 'woocommerce_after_single_product_summary', __CLASS__ . '::product_info_close', -10 );

					add_action( 'woocommerce_before_shop_loop_item_title', __CLASS__ . '::product_item_thumbnail_wrapper_open', 7 );

					add_action( 'woocommerce_before_shop_loop_item_title', __CLASS__ . '::product_item_thumbnail_wrapper_close', 13 );

					add_action( 'woocommerce_before_shop_loop_item_title', __CLASS__ . '::product_item_description_wrapper_open', 90 );
					add_action( 'woocommerce_before_subcategory_title',    __CLASS__ . '::product_item_description_wrapper_open', 90 );

					add_action( 'woocommerce_after_shop_loop_item_title', __CLASS__ . '::product_item_description_wrapper_close', 90 );
					add_action( 'woocommerce_after_subcategory_title',    __CLASS__ . '::product_item_description_wrapper_close', 90 );

					add_action( 'woocommerce_before_customer_login_form', __CLASS__ . '::login_form_wrapper_open' );

					add_action( 'woocommerce_after_customer_login_form', __CLASS__ . '::login_form_wrapper_close' );

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
	 * 10) Template
	 */

		/**
		 * Template wrappers: Open
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  string $template_name
		 */
		public static function template_part_wrapper_open( $template_name ) {

			// Output

				switch ( $template_name ) {

					case 'single-product/product-image.php' :

							global $product;

							$class = '';

							if ( Reykjavik_WooCommerce_Helpers::get_product_gallery_image_ids( $product ) ) {
								$class .= ' gallery';
							}

							echo '<div class="single-product-images' . esc_attr( $class ) . '">';

						break;

					case 'cart/cart-empty.php' :

							if ( WC()->cart->is_empty() ) {
								echo '<div class="cart-empty-container">';
							}

						break;

					default :
						break;

				}

		} // /template_part_wrapper_open



		/**
		 * Template wrappers: Close
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  string $template_name
		 */
		public static function template_part_wrapper_close( $template_name ) {

			// Output

				switch ( $template_name ) {

					case 'single-product/product-image.php' :

							echo '</div>';

						break;

					case 'cart/cart-empty.php':

							if ( WC()->cart->is_empty() ) {
								echo '</div>';
							}

						break;

					default:
						break;

				}

		} // /template_part_wrapper_close





	/**
	 * 20) Product
	 */

		/**
		 * Product basic info container: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_info_open() {

			// Output

				echo '<div class="summary-container"><div class="summary-container-inner">';

		} // /product_info_open



		/**
		 * Product basic info container: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_info_close() {

			// Output

				echo '</div></div>';

		} // /product_info_close



		/**
		 * Products list item thumbnail: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_item_thumbnail_wrapper_open() {

			// Output

				echo '<div class="thumbnail">';

		} // /product_item_thumbnail_wrapper_open



		/**
		 * Products list item info: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_item_thumbnail_wrapper_close() {

			// Output

				echo '</div>';

		} // /product_item_thumbnail_wrapper_close



		/**
		 * Products list item description: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_item_description_wrapper_open() {

			// Output

				echo '<div class="description">';

		} // /product_item_description_wrapper_open



		/**
		 * Products list item info: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_item_description_wrapper_close() {

			// Output

				echo '</div>';

		} // /product_item_description_wrapper_close





	/**
	 * 100) Others
	 */

		/**
		 * Login form wrapper: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function login_form_wrapper_open() {

			// Helper variables

				$class = 'customer-login';

				if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) {
					$class .= ' customer-registration';
				}


			// Output

				echo '<div class="' . esc_attr( $class ) . '">';

		} // /login_form_wrapper_open



		/**
		 * Login form wrapper: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function login_form_wrapper_close() {

			// Output

				echo '</div>';

		} // /login_form_wrapper_close





} // /Reykjavik_WooCommerce_Wrappers

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Wrappers::init' );
