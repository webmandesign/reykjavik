<?php
/**
 * WooCommerce: Widgets Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.5
 *
 * Contents:
 *
 *  0) Init
 * 10) Sidebars
 * 20) Widget: Product Search
 */
class Reykjavik_WooCommerce_Widgets {





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

					// Removing

						remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

					// Actions

						add_action( 'widgets_init', __CLASS__ . '::register_widget_areas', 1 );

					// Filters

						add_filter( 'sidebars_widgets', __CLASS__ . '::shop_sidebar', 5 );

						add_filter( 'wmhook_reykjavik_sidebar_disable', __CLASS__ . '::sidebar_disable' );

						add_filter( 'get_product_search_form', __CLASS__ . '::product_search_form' );

						if ( is_callable( 'Reykjavik_Sidebar::widget_tag_cloud_args' ) ) {
							add_filter( 'woocommerce_product_tag_cloud_widget_args', 'Reykjavik_Sidebar::widget_tag_cloud_args' );
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
	 * 10) Sidebars
	 */

		/**
		 * Product widget area: registration
		 *
		 * @since    1.0.0
		 * @version  1.0.5
		 */
		public static function register_widget_areas() {

			// Processing

				register_sidebar( array(
					'id'            => 'shop',
					'name'          => esc_html__( 'Shop Sidebar', 'reykjavik' ),
					'description'   => esc_html__( 'This sidebar replaces the default sidebar area for shop page and product archive pages.', 'reykjavik' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title screen-reader-text">',
					'after_title'   => '</h2>',
				) );

		} // /register_widget_areas



		/**
		 * Replace default sidebar with Shop Sidebar
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function shop_sidebar( $sidebars_widgets ) {

			// Requirements check

				if (
						! ( is_shop() || is_product_taxonomy() )
						|| ! isset( $sidebars_widgets['shop'] )
						|| empty( $sidebars_widgets['shop'] )
					) {
					return $sidebars_widgets;
				}


			// Helper variables

				$shop_sidebar_widgets = $sidebars_widgets['shop'];


			// Processing

				// Replace default sidebar widgets with the shop sidebar ones

					$sidebars_widgets['sidebar'] = $shop_sidebar_widgets;


			// Output

				return $sidebars_widgets;

		} // /shop_sidebar



		/**
		 * Sidebar disabling
		 *
		 * Disable sidebar on single products.
		 * Enable shop sidebar on product archives.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  boolean $disabled
		 */
		public static function sidebar_disable( $disabled = false ) {

			// Processing

				if ( is_product() ) {
					return true;
				} elseif ( is_shop() || is_product_taxonomy() ) {
					return ! is_active_sidebar( 'shop' );
				}


			// Output

				return $disabled;

		} // /sidebar_disable





	/**
	 * 20) Widget: Product Search
	 */

		/**
		 * Fixing search field ID for multiple display
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function product_search_form( $html ) {

			// Output

				return str_replace( 'woocommerce-product-search-field', 'woocommerce-product-search-field-' . esc_attr( uniqid() ), $html );

		} // /product_search_form





} // /Reykjavik_WooCommerce_Widgets

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Widgets::init' );
