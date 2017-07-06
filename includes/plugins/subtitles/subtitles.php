<?php
/**
 * Plugin compatibility file.
 *
 * Subtitles
 *
 * @link  https://wordpress.org/plugins/subtitles/
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

	if ( ! class_exists( 'Subtitles' ) ) {
		return;
	}





/**
 * 20) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'subtitles/class-subtitles.php';
