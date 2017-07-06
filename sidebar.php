<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Requirements check

	if ( ! is_active_sidebar( 'sidebar' ) ) {
		return;
	}


// Output

	do_action( 'tha_sidebars_before' );

	?>

	<aside id="secondary" class="widget-area sidebar" role="complementary" aria-labelledby="sidebar-label">

		<h2 class="screen-reader-text" id="sidebar-label"><?php echo esc_html_x( 'Sidebar', 'Sidebar aria label', 'reykjavik' ); ?></h2>

		<?php

		do_action( 'tha_sidebar_top' );

		dynamic_sidebar( 'sidebar' );

		do_action( 'tha_sidebar_bottom' );

		?>

	</aside><!-- /#secondary -->

	<?php

	do_action( 'tha_sidebars_after' );
