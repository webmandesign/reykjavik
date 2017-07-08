<?php
/**
 * Plugin compatibility file.
 *
 * WooCommerce
 *
 * @link  https://wordpress.org/plugins/woocommerce/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 * 30) Pluggable functions overrides
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}





/**
 * 20) Plugin integration
 */

	define( 'REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE', REYKJAVIK_PATH_PLUGINS . 'woocommerce/class-woocommerce-' );

	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'setup.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'assets.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'customize.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'single.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'loop.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'pages.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'wrappers.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'widgets.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'helpers.php';
	require REYKJAVIK_PATH_PLUGINS_WOOCOMMERCE . 'extensions.php';





/**
 * 30) Pluggable functions overrides
 */

	/**
	 * Show the product title in the product loop. By default this is an H3.
	 *
	 * Redefining this function to assure it uses H3 heading tag as the theme
	 * adds H2 as the list heading everywhere.
	 * Current proposed solution in WooCommerce applies either H2 or H3 depending
	 * on whether we are on shop (or shop taxonomy) page or not.
	 *
	 * @link  https://github.com/woocommerce/woocommerce/issues/12306
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function woocommerce_template_loop_product_title() {

		// Output

			echo '<h3 class="woocommerce-loop-product__title">' . get_the_title() . '</h3>';

	} // /woocommerce_template_loop_product_title



	/**
	 * Show the subcategory title in the product loop.
	 *
	 * Redefining this function to assure it uses H3 heading tag as the theme
	 * adds H2 as the list heading everywhere.
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function woocommerce_template_loop_category_title( $category ) {

		// Helper variables

			$title = $category->name;

			if ( $category->count > 0 ) {
				$title .= apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			}


		// Output

			echo '<h3 class="woocommerce-loop-category__title">' . $title . '</h3>';

	} // /woocommerce_template_loop_category_title
