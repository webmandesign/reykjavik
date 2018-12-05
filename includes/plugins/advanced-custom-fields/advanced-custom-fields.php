<?php
/**
 * Plugin compatibility file.
 *
 * Advanced Custom Fields
 *
 * @link  https://wordpress.org/plugins/advanced-custom-fields/
 * @link  https://www.advancedcustomfields.com/resources/register-fields-via-php/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.1
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Plugin integration
 */





/**
 * 1) Requirements check
 */

	if ( ! function_exists( 'acf_add_local_field_group' ) || ! is_admin() ) {
		return;
	}





/**
 * 10) Plugin integration
 */

	require REYKJAVIK_PATH_PLUGINS . 'advanced-custom-fields/class-advanced-custom-fields.php';
