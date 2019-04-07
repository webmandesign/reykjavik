<?php
/**
 * The template for displaying the footer
 *
 * @link  https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @see  `includes/frontend/class-footer.php`
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 */





do_action( 'tha_content_bottom' );
do_action( 'tha_content_after' );

if ( Reykjavik_Footer::is_enabled() ) {
	do_action( 'tha_footer_before' );
	do_action( 'tha_footer_top' );
	do_action( 'tha_footer_bottom' );
	do_action( 'tha_footer_after' );
}

do_action( 'tha_body_bottom' );

wp_footer();

?>

</body>

</html>
