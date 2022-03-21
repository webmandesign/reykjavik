<?php
/**
 * Primary menu template
 *
 * Accessibility markup applied (ARIA).
 *
 * @link  http://a11yproject.com/patterns/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.1.0
 */

$is_mobile_nav_enabled = Reykjavik_Library_Customize::get_theme_mod( 'navigation_mobile' );

?>

<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'reykjavik' ); ?>">

	<?php

	if ( $is_mobile_nav_enabled ) :
		?>
		<button
			id="menu-toggle"
			class="menu-toggle"
			aria-controls="menu-primary"
			aria-expanded="false"
		><?php

		echo esc_html_x( 'Menu', 'Mobile navigation toggle button title.', 'reykjavik' );

		?></button>
		<?php
	endif;

	?>
	<div id="site-navigation-container" class="main-navigation-container">
		<?php

		/**
		 * For `theme_location` see `Reykjavik_Menu::primary_menu_args()` method
		 * in `includes/frontend/class-menu.php` file.
		 */
		wp_nav_menu( Reykjavik_Menu::primary_menu_args( $is_mobile_nav_enabled ) );

		?>
	</div>

</nav>
