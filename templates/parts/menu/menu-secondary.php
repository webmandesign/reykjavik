<?php
/**
 * Secondary menu template
 *
 * This is a simple, one-level secondary site navigation in header.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Requirements check

	if ( ! has_nav_menu( 'secondary' ) ) {
		return;
	}


?>

<nav id="secondary-navigation" class="secondary-navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'reykjavik' ); ?>">

	<?php

	wp_nav_menu( array(
			'theme_location' => 'secondary',
			'container'      => 'false',
			'depth'          => 1,
			'fallback_cb'    => false,
		) );

	?>

</nav>
