<?php
/**
 * One Click Demo Import Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 *
 * Contents:
 *
 *   0) Init
 *  10) Files
 *  20) Texts
 *  30) Setup
 * 100) Helpers
 */
class Reykjavik_One_Click_Demo_Import {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.1
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Actions

						add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles', 99 );

						add_action( 'pt-ocdi/before_content_import', __CLASS__ . '::before' );

						add_action( 'pt-ocdi/before_widgets_import', __CLASS__ . '::before_widgets_import' );

						add_action( 'pt-ocdi/after_import', __CLASS__ . '::after' );

					// Filters

						add_filter( 'pt-ocdi/import_files', __CLASS__ . '::files' );

						add_filter( 'pt-ocdi/plugin_intro_text', __CLASS__ . '::info' );
						add_action( 'pt-ocdi/plugin_intro_text', __CLASS__ . '::jetpack_custom_posts' );

						add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

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
	 * 10) Files
	 */

		/**
		 * Import files setup
		 *
		 * @since    1.0.0
		 * @version  1.0.1
		 */
		public static function files() {

			// Output

				return array(

						array(
							'import_file_name'       => esc_html__( 'Theme demo content', 'reykjavik' ),
							'import_file_url'        => esc_url( get_theme_file_uri( 'includes/plugins/one-click-demo-import/demo-content-reykjavik.xml' ) ),
							'import_widget_file_url' => esc_url( get_theme_file_uri( 'includes/plugins/one-click-demo-import/demo-widgets-reykjavik.wie' ) ),
							'preview_url'            => 'https://themedemos.webmandesign.eu/reykjavik/',
						),

					);

		} // /files





	/**
	 * 20) Texts
	 */

		/**
		 * Info texts
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 *
		 * @param  string $text  Default intro text.
		 */
		public static function info( $text = '' ) {

			// Processing

				$text .= '<div class="media-files-quality-info">';

					$text .= '<h3>';
					$text .= esc_html__( 'Media files quality', 'reykjavik' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please note that imported media files (such as images, video and audio files) are of low quality to prevent copyright infringement.', 'reykjavik' );
					$text .= ' ' . esc_html__( 'Please read "Credits" section of theme documentation for reference where the demo media files were obtained from.', 'reykjavik' );
					$text .= ' <a href="https://webmandesign.github.io/docs/reykjavik/#credits">' . esc_html__( 'Get media for your website &raquo;', 'reykjavik' ) . '</a>';
					$text .= '</p>';

				$text .= '</div>';

				$text .= '<div class="ocdi__demo-import-notice">';

					$text .= '<h3>';
					$text .= esc_html__( 'Install demo required plugins!', 'reykjavik' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please read the information about the theme demo required plugins first.', 'reykjavik' );
					$text .= ' ' . esc_html__( 'If you do not install and activate demo required plugins, some of the content will not be imported.', 'reykjavik' );
					$text .= ' <a href="https://github.com/webmandesign/demo-content/tree/master/reykjavik/content#before-you-begin" title="' . esc_attr__( 'Read the information before you run the theme demo content import process.', 'reykjavik' ) . '"><strong>';
					$text .= esc_html__( 'View the list of required plugins &raquo;', 'reykjavik' );
					$text .= '</strong></a>';
					$text .= '</p>';

					$text .= '<p>';
					$text .= '<em>';
					$text .= esc_html__( '(Note that this set of plugins may differ from plugins recommended under Appearance &rarr; Install Plugins!)', 'reykjavik' );
					$text .= '</em>';
					$text .= '</p>';

				$text .= '</div>';


			// Output

				return $text;

		} // /info





	/**
	 * 30) Setup
	 */

		/**
		 * Before import actions
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function before() {

			// Helper variables

				$image_sizes = array_filter( (array) apply_filters( 'wmhook_reykjavik_setup_image_sizes', array() ) );


			// Processing

				// Image sizes

					foreach ( array( 'thumbnail', 'medium', 'medium_large', 'large' ) as $size ) {
						if ( isset( $image_sizes[ $size ] ) ) {
							update_option( $size . '_size_w', $image_sizes[ $size ][0] );
							update_option( $size . '_size_h', $image_sizes[ $size ][1] );
							update_option( $size . '_crop', $image_sizes[ $size ][2] );
						}
					}

				// WooCommerce image sizes

					self::woocommerce_image_sizes();

		} // /before



		/**
		 * After import actions
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $selected_import
		 */
		public static function after( $selected_import = '' ) {

			// Processing

				// Theme options

					self::theme_options();

				// Front and blog page

					self::front_and_blog_page();

				// Menu locations

					self::menu_locations();

				// WooCommerce pages

					self::woocommerce_pages();

				// Beaver Builder setup

					self::beaver_builder();

		} // /after



		/**
		 * Setup theme options
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function theme_options() {

			// Helper variables

				$footer_image_attachment_post = get_page_by_title( 'Footer decorative background image', OBJECT, 'attachment' );


			// Processing

				// Custom header video

					set_theme_mod( 'external_header_video', 'https://youtu.be/HbXTFQXnhmY' );

				// Footer background image

					if ( isset( $footer_image_attachment_post->ID ) ) {

						$footer_image_url = wp_get_attachment_image_src( $footer_image_attachment_post->ID, 'full' );
						$footer_image_url = $footer_image_url[0];

						set_theme_mod( 'footer_image', esc_url_raw( $footer_image_url ) );
						set_theme_mod( 'footer_image_opacity', .10 );

						if ( is_callable( 'Reykjavik_Library_CSS_Variables::cache_flush' ) ) {
							Reykjavik_Library_CSS_Variables::cache_flush();
						}

					}

		} // /theme_options



		/**
		 * Setup front and blog page
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function front_and_blog_page() {

			// Processing

				update_option( 'show_on_front', 'page' );

				// Front page

					$page = get_page_by_path( 'home' );

					update_option( 'page_on_front', $page->ID );

				// Blog page

					$page = get_page_by_path( 'blog' );

					update_option( 'page_for_posts', $page->ID );

		} // /front_and_blog_page



		/**
		 * Setup navigation menu locations
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function menu_locations() {

			// Helper variables

				$menu              = array();
				$menu['primary']   = get_term_by( 'slug', 'primary', 'nav_menu' );
				$menu['secondary'] = get_term_by( 'slug', 'secondary', 'nav_menu' );
				$menu['social']    = get_term_by( 'slug', 'social-links', 'nav_menu' );


			// Processing

				set_theme_mod( 'nav_menu_locations', array(
						'primary'   => ( isset( $menu['primary']->term_id ) ) ? ( $menu['primary']->term_id ) : ( null ),
						'secondary' => ( isset( $menu['secondary']->term_id ) ) ? ( $menu['secondary']->term_id ) : ( null ),
						'social'    => ( isset( $menu['social']->term_id ) ) ? ( $menu['social']->term_id ) : ( null ),
					) );

		} // /menu_locations



		/**
		 * Remove all widgets from sidebars first
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function before_widgets_import() {

			// Processing

				delete_option( 'sidebars_widgets' );

		} // /before_widgets_import



		/**
		 * Setup WooCommerce pages
		 *
		 * Have to use alternative page slugs in theme demo content
		 * to prevent issues with WooCommerce setup wizard created pages.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function woocommerce_pages() {

			// Requirements check

				if ( ! class_exists( 'WooCommerce' ) ) {
					return;
				}


			// Processing

				// Shop page

					$page = get_page_by_path( 'our-shop' );

					update_option( 'woocommerce_shop_page_id', $page->ID );

				// Cart page

					$page = get_page_by_path( 'our-shop/shopping-cart' );

					update_option( 'woocommerce_cart_page_id', $page->ID );

				// Checkout page

					$page = get_page_by_path( 'our-shop/shop-checkout' );

					update_option( 'woocommerce_checkout_page_id', $page->ID );

				// Terms and Conditions page

					$page = get_page_by_path( 'our-shop/terms-and-conditions' );

					update_option( 'woocommerce_terms_page_id', $page->ID );

				// My Account page

					$page = get_page_by_path( 'our-shop/customer-account' );

					update_option( 'woocommerce_myaccount_page_id', $page->ID );

		} // /woocommerce_pages



		/**
		 * Setup WooCommerce image sizes
		 *
		 * Must be set before the images are imported to generate correct sizes.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function woocommerce_image_sizes() {

			// Requirements check

				if ( ! class_exists( 'WooCommerce' ) ) {
					return;
				}


			// Processing

				// Shop images

					update_option( 'shop_catalog_image_size', array(
							'width'  => 480,
							'height' => 480,
							'crop'   => 1,
						) );
					add_image_size( 'shop_catalog_image_size', 480, 480, true );

					update_option( 'shop_single_image_size', array(
							'width'  => 1200,
							'height' => 1200,
							'crop'   => 1,
						) );
					add_image_size( 'shop_single_image_size', 1200, 1200, true );

					update_option( 'shop_thumbnail_image_size', array(
							'width'  => 120,
							'height' => 120,
							'crop'   => 1,
						) );
					add_image_size( 'shop_thumbnail_image_size', 120, 120, true );

		} // /woocommerce_image_sizes



		/**
		 * Setup Beaver Builder
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function beaver_builder() {

			// Processing

				// Page builder enabled post types

					update_option( '_fl_builder_post_types', array(
							'page',
							'product',
						) );

		} // /beaver_builder



		/**
		 * Enable Jetpack custom post types message
		 *
		 * This will display the message only if the "Custom content types"
		 * module is not active already.
		 * On page reload we attempt to activate the module automatically.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $text  Default intro text.
		 */
		public static function jetpack_custom_posts( $text = '' ) {

			// Requirements check

				if (
						is_callable( 'Jetpack::is_module_active' )
						&& Jetpack::is_module_active( 'custom-content-types' )
					) {
					return $text;
				}


			// Processing

				$text .= '<div class="jetpack-info ocdi__demo-import-notice">';

					$text .= '<h3>';
					$text .= esc_html__( 'Jetpack Custom content types', 'reykjavik' );
					$text .= '</h3>';

					$text .= '<p>';
					$text .= esc_html__( 'Please make sure your Jetpack plugin is connected and you have activated Testimonials and Portfolios "Custom content types" in Jetpack settings (navigate to Jetpack &rarr; Settings &rarr; Writing).', 'reykjavik' );
					$text .= ' ' . esc_html__( 'If you do not activate these, the related demo content will not be imported.', 'reykjavik' );
					$text .= '</p>';
					$text .= '<p>';
					$text .= '<em>';
					$text .= esc_html__( 'If your Jetpack plugin is connected, you may just try to reload this page and we will attempt to activate those custom content types for you automatically.', 'reykjavik' );
					$text .= ' ';
					$text .= esc_html__( 'If the operation is successful, this message will disappear and you should see 2 new items in your WordPress dashboard menu: "Portfolio" and "Testimonials".', 'reykjavik' );
					$text .= '</em>';
					$text .= '</p>';
					$text .= '<a href="" class="button">' . esc_html__( 'Reload this page &raquo;', 'reykjavik' ) . '</a>';

				$text .= '</div>';

				// This will activate the post types automatically, but page reload is required.

					if ( is_callable( 'Jetpack::activate_module' ) ) {
						/**
						 * Fires before a module is activated.
						 *
						 * @param  string $module    Module slug.
						 * @param  bool   $exit      Should we exit after the module has been activated. Default to true.
						 * @param  bool   $redirect  Should the user be redirected after module activation? Default to true.
						 */
						Jetpack::activate_module( 'custom-content-types', false, false );
					}


			// Output

				return $text;

		} // /jetpack_custom_posts





	/**
	 * 100) Helpers
	 */

		/**
		 * OCDI plugin admin page styles
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function styles() {

			// Processing

				// OCDI 2.0 styling fix

					wp_add_inline_style(
							'ocdi-main-css',
							'.ocdi.about-wrap { max-width: 66em; }'
						);

		} // /styles





} // /Reykjavik_One_Click_Demo_Import

add_action( 'after_setup_theme', 'Reykjavik_One_Click_Demo_Import::init', 5 ); // Hook before plugin setup (see plugin code).
