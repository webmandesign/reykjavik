<?php
/**
 * Plugins recommendations
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
 * 10) Functionality
 */





/**
 * 1) Requirements check
 */

	if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
		return;
	}





/**
 * 20) Functionality
 */

	require REYKJAVIK_PATH_INCLUDES . 'tgmpa/class-tgmpa-plugins.php';
