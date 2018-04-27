<?php
/**
 * Plugin compatibility file.
 *
 * Elementor
 *
 * @link  https://wordpress.org/plugins/elementor/
 *
 * @subpackage  Plugins
 * @subpackage  Page Builder
 * @subpackage  Theme Builder
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.1.0
 * @version  1.1.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	/**
	 * Upgrade link
	 *
	 * @since    1.1.0
	 * @version  1.1.0
	 */
	define( 'ELEMENTOR_PARTNER_ID', 2179 );

	require REYKJAVIK_PATH_PLUGINS . 'elementor/class-elementor.php';
