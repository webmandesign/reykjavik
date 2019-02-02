<?php
/**
 * Plugin compatibility file.
 *
 * Subtitles
 * WP Subtitle
 *
 * @link  https://wordpress.org/plugins/subtitles/
 * @link  https://wordpress.org/plugins/wp-subtitle/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! function_exists( 'get_the_subtitle' ) ) {
		return;
	}





/**
 * 20) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'subtitles/class-subtitles.php';
