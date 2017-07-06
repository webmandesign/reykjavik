<?php
/**
 * Plugin compatibility file.
 *
 * Breadcrumb NavXT
 *
 * @link  https://wordpress.org/plugins/breadcrumb-navxt/
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
 */





/**
 * 1) Requirements check
 */

	if ( ! function_exists( 'bcn_display' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'breadcrumb-navxt/class-breadcrumb-navxt.php';
