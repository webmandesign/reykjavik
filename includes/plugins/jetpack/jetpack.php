<?php
/**
 * Plugin compatibility file.
 *
 * Jetpack
 *
 * @link  https://wordpress.org/plugins/jetpack/
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

	if ( ! class_exists( 'Jetpack' ) ) {
		return;
	}





/**
 * 20) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'jetpack/class-jetpack.php';
