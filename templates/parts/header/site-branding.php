<?php
/**
 * Displays header site branding
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.1.0
 */

$site_title  = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a>';
$title_tag   = ( is_front_page() ) ? ( 'h1' ) : ( 'p' );
$description = get_bloginfo( 'description', 'display' );

if (
	(bool) get_theme_support( 'custom-logo', 'unlink-homepage-logo' )
	&& is_front_page()
	&& ! is_paged()
) {
	$site_title = get_bloginfo( 'name', 'display' );
}

?>

<div class="site-branding">
	<?php the_custom_logo(); ?>
	<div class="site-branding-text">
		<<?php echo tag_escape( $title_tag ) ?> class="site-title"><?php
			echo $site_title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?></<?php echo tag_escape( $title_tag ) ?>>

		<?php

		if ( $description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php
				echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?></p>
			<?php
		endif;

		?>
	</div>
</div>
