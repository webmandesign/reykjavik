<?php
/**
 * Required Plugins Class
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
 *  10) Recommend
 * 100) Helpers
 */
class Reykjavik_TGMPA_Plugins {





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

						add_action( 'tgmpa_register', __CLASS__ . '::recommend' );

						add_action( 'admin_notices', __CLASS__ . '::notice' );

					// Filters

						add_filter( 'tgmpa_notice_action_links', __CLASS__ . '::notification_links' );

						add_filter( 'tgmpa_table_columns', __CLASS__ . '::table_columns' );

						add_filter( 'tgmpa_table_data_item', __CLASS__ . '::table_data', 10, 2 );

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
	 * 10) Recommend
	 */

		/**
		 * Recommend plugins
		 *
		 * @link  https://github.com/thomasgriffin/TGM-Plugin-Activation/blob/master/example.php
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function recommend() {

			// Processing

				/**
				 * Array of plugin arrays. Required keys are name and slug.
				 * If the source is NOT from the .org repo, then source is also required.
				 */
				$plugins = apply_filters( 'wmhook_reykjavik_tgmpa_plugins_recommend_plugins', array(

					'beaver-builder' => array(
						'name'        => 'Beaver Builder',
						'description' => esc_html__( 'Easy to use front-end page builder.', 'reykjavik' ),
						'slug'        => 'beaver-builder-lite-version',
						'required'    => false,
						'is_callable' => 'FLBuilder::init',
					),

					'webman-templates' => array(
						'name'        => 'WebMan Templates',
						'description' => esc_html__( 'Adding set of predefined templates for Beaver Builder page builder.', 'reykjavik' ),
						'slug'        => 'webman-templates',
						'required'    => false,
					),

					'advanced-custom-fields' => array(
						'name'        => 'Advanced Custom Fields',
						'description' => esc_html__( 'For easy post and page attributes setup.', 'reykjavik' ),
						'slug'        => 'advanced-custom-fields',
						'required'    => false,
						'is_callable' => 'acf_add_local_field_group',
					),

					'jetpack' => array(
						'name'        => 'Jetpack',
						'description' => esc_html__( 'Adding portfolio and testimonials functionality.', 'reykjavik' ),
						'slug'        => 'jetpack',
						'required'    => false,
					),

					'woocommerce' => array(
						'name'        => 'WooCommerce',
						'description' => esc_html__( 'Adding e-commerce functionality.', 'reykjavik' ),
						'slug'        => 'woocommerce',
						'required'    => false,
					),

					'one-click-demo-import' => array(
						'name'        => 'One Click Demo Import',
						'description' => esc_html__( 'For installing theme demo content easily.', 'reykjavik' ),
						'slug'        => 'one-click-demo-import',
						'required'    => false,
					),

				) );

				$config = apply_filters( 'wmhook_reykjavik_tgmpa_plugins_recommend_config', array() );

				tgmpa( $plugins, $config );

		} // /recommend





	/**
	 * 100) Helpers
	 */

		/**
		 * Admin notification links
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $action_links
		 */
		public static function notification_links( $action_links ) {

		// Processing

			// Adding font weight classes

				$action_links[] = '<a href="' . esc_url( 'https://webmandesign.github.io/docs/reykjavik/#plugins' ) . '">' . esc_html__( 'Other useful plugins &raquo;', 'reykjavik' ) . '</a>';


		// Output

			return $action_links;

		} // /notification_links



		/**
		 * TGMPA plugins table: Columns
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $columns
		 */
		public static function table_columns( $columns = array() ) {

			// Processing

				$columns = array_merge(
					array_slice( $columns, 0, 2 ),
					array( 'description' => esc_html__( 'Description', 'reykjavik' ) ),
					array_slice( $columns, 2 )
				);


			// Output

				return $columns;

		} // /table_columns



		/**
		 * TGMPA plugins table: Plugin description
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $table_data
		 * @param  array $plugin
		 */
		public static function table_data( $table_data = array(), $plugin = array() ) {

			// Processing

				$table_data['description'] = ( isset( $plugin['description'] ) ) ? ( wp_kses_post( $plugin['description'] ) ) : ( '' );


			// Output

				return $table_data;

		} // /table_data



		/**
		 * Display admin notice
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function notice() {

			// Helper variables

				$current_screen = get_current_screen();


			// Requirements check

				if (
						! is_admin()
						|| ! isset( $current_screen->id )
						|| 'appearance_page_tgmpa-install-plugins' !== $current_screen->id
						|| isset( $_GET['plugin'] )
						|| ( isset( $_GET['plugin_status'] ) && 'all' !== $_GET['plugin_status'] )
					) {
					return;
				}


			// Output

				?>

				<div class="notice-info notice is-dismissible" style="padding: 1em 2em;">
					<h2>
						<?php echo esc_html_x( 'Recommended, not required', 'Plugins.', 'reykjavik' ); ?>
					</h2>
					<p>
						<?php esc_html_e( 'Please note that these are just recommended plugins, not required ones.', 'reykjavik' ); ?>
						<?php esc_html_e( 'Install only those plugins you will use.', 'reykjavik' ); ?>
						<?php echo esc_html_x( 'Or install the ones you prefer.', 'Plugins.', 'reykjavik' ); ?> <br>
						<?php esc_html_e( 'For example, if you are not building an eCommerce website, there is no need to install WooCommerce plugin suggested below.', 'reykjavik' ); ?>
					</p>
				</div>

				<?php

		} // /notice





} // /Reykjavik_TGMPA_Plugins

add_action( 'after_setup_theme', 'Reykjavik_TGMPA_Plugins::init' );
