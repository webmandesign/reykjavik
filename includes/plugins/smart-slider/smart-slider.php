<?php
/**
 * Plugin compatibility file.
 *
 * Smart Slider 3
 *
 * @link  http://smartslider3.com/
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

	if ( ! class_exists( 'N2SS3' ) ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	/**
	 * Upgrade link source
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	N2SS3::$source = 'webmandesign';
