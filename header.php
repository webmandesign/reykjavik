<?php
/**
 * The header for our theme
 *
 * @link  https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @see  `includes/frontend/class-header.php`
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 */





do_action( 'tha_html_before' );

?>

<html <?php language_attributes(); ?> class="no-js">

<head>

<?php

do_action( 'tha_head_top' );
do_action( 'tha_head_bottom' );

wp_head();

?>

</head>


<body <?php body_class(); ?>>

<?php

do_action( 'tha_body_top' );

if ( Reykjavik_Header::is_enabled() ) {
	do_action( 'tha_header_before' );
	do_action( 'tha_header_top' );
	do_action( 'tha_header_bottom' );
	do_action( 'tha_header_after' );
}

do_action( 'tha_content_before' );
do_action( 'tha_content_top' );
