<?php
/**
 * Social links menu template
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Requirements check

	if ( ! has_nav_menu( 'social' ) ) {
		return;
	}


// Helper variables

	$social_menu_html = get_transient( 'reykjavik_social_links' );
	$social_menu_args = array(
			'theme_location' => 'social',
			'container'      => false,
			'menu_class'     => 'social-links-items',
			'depth'          => 1,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
			'fallback_cb'    => false,
			'items_wrap'     => '<ul data-id="%1$s" class="%2$s">%3$s<li class="back-to-top-link"><a href="#" class="back-to-top" title="' . esc_attr__( 'Back to top', 'reykjavik' ) . '"><span class="screen-reader-text">' . esc_html__( 'Back to top &uarr;', 'reykjavik' ) . '</span></a></li></ul>',
		);


?>

<nav class="social-links" aria-label="<?php esc_attr_e( 'Social Menu', 'reykjavik' ); ?>">

	<?php

	if ( is_customize_preview() ) {

		/**
		 * If we want to enable customizer partial edit, we need to output the menu standard way.
		 */
		wp_nav_menu( $social_menu_args );

	} else {

		/**
		 * Social menu cache gets refreshed when you save/update the menu in WordPress admin.
		 *
		 * @see  Reykjavik_Menu::social_cache_flush()
		 */
		if ( ! $social_menu_html ) {
			$social_menu_html = wp_nav_menu( array_merge( array( 'echo' => false ), $social_menu_args ) );
			$social_menu_html = str_replace( ' id=', ' data-id=', $social_menu_html ); // Fix for multiple displays
			set_transient( 'reykjavik_social_links', $social_menu_html );
		}

		echo $social_menu_html;

	}

	?>

</nav>
