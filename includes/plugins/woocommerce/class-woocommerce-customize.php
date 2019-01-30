<?php
/**
 * WooCommerce: Customize Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Options
 */
class Reykjavik_WooCommerce_Customize {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function init() {

			// Processing

				// Hooks

					// Actions

						add_action( 'customize_register', __CLASS__ . '::options_pointers' );

					// Filters

						add_filter( 'wmhook_reykjavik_theme_options', __CLASS__ . '::options' );

		} // /init





	/**
	 * 10) Options
	 */

		/**
		 * Theme options addons and modifications
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Processing

				// WooCommerce specific options

					$options = array_merge( $options, array(

						970 . 'woocommerce' => array(
							'id'             => 'woocommerce',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Shop', 'Customizer section title.', 'reykjavik' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),

							970 . 'woocommerce' . 100 => array(
								'type'    => 'html',
								'content' => '<h3>' . esc_html__( 'Cart and Checkout', 'reykjavik' ) . '</h3>',
							),

								970 . 'woocommerce' . 110 => array(
									'type'        => 'checkbox',
									'id'          => 'woocommerce_checkout_guide',
									'label'       => esc_html__( 'Display checkout guide', 'reykjavik' ),
									'description' => esc_html__( 'Enables the checkout process steps visualization.', 'reykjavik' ),
									'default'     => true,
									// No need for `preview_js` here as we also need to load the scripts.
								),

					) );


			// Output

				return $options;

		} // /options



		/**
		 * Theme options pointers
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $wp_customize  WP customizer object.
		 */
		public static function options_pointers( $wp_customize ) {

			// Processing

				$wp_customize->selective_refresh->add_partial( 'woocommerce_checkout_guide', array(
					'selector' => '.checkout-guide',
				) );

		} // /options_pointers





} // /Reykjavik_WooCommerce_Customize

add_action( 'after_setup_theme', 'Reykjavik_WooCommerce_Customize::init' );
