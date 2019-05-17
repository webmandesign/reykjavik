<?php
/**
 * Welcome Page
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.3
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Admin page
 */





/**
 * 1) Requirements check
 */

	if (
		! is_admin()
		// Reykjavik_Library_Customize::get_theme_mod() does not work here yet.
		|| ! get_theme_mod( 'admin_welcome_page', true )
	) {
		return;
	}





/**
 * 10) Admin page
 */

	require REYKJAVIK_PATH_INCLUDES . 'welcome/class-welcome.php';
