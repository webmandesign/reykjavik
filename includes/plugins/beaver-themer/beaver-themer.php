<?php
/**
 * Plugin compatibility file.
 *
 * Beaver Themer
 *
 * @link  https://www.wpbeaverbuilder.com/beaver-themer/
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

	if ( ! class_exists( 'FLThemeBuilder' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'beaver-themer/class-beaver-themer.php';
