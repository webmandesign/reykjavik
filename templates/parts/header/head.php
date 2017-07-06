<?php
/**
 * HTML head content
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





?>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php

/**
 * Support for Chrome Theme Color Changer plugin
 *
 * @see  https://wordpress.org/plugins/chrome-theme-color-changer
 */
if ( ! class_exists( 'Chrome_Theme_Color_Changer' ) ) {
	echo '<meta name="theme-color" content="' . esc_attr( get_theme_mod( 'color_header_background', '#fefeff' ) ) . '">';
}
