<?php
/**
 * Site info / footer credits area
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.5
 */





// Helper variables

	$site_info_text = trim( get_theme_mod( 'texts_site_info' ) );


// Requirements check

	if ( '-' === $site_info_text ) {

		if ( is_customize_preview() ) {
			echo '<style>.footer-area-site-info { display: none; }</style>';
		} else {
			return;
		}

	}


?>

<div class="site-footer-area footer-area-site-info">
	<div class="site-footer-area-inner site-info-inner">

		<?php do_action( 'wmhook_reykjavik_site_info_before' ); ?>

		<div class="site-info">
			<?php if ( empty( $site_info_text ) ) : ?>

				&copy; <?php echo date_i18n( 'Y' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<span class="sep"> | </span>
				<?php

				printf(
					esc_html_x( 'Using %1$s %2$s theme.', '1: theme name, 2: linked "WordPress" word.', 'reykjavik' ),
					'<a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'ThemeURI' ) ) . '"><strong>' . wp_get_theme( 'reykjavik' )->display( 'Name' ) . '</strong></a>',
					'<a href="' . esc_url( __( 'https://wordpress.org/', 'reykjavik' ) ) . '">WordPress</a>'
				);

				?>
				<span class="sep"> | </span>
				<a href="#top" id="back-to-top" class="back-to-top"><?php esc_html_e( 'Back to top &uarr;', 'reykjavik' ); ?></a>

			<?php else :

				// No need to apply wp_kses_post() on output as it is already validated via Customizer.
				echo $site_info_text;

			endif; ?>
		</div>

		<?php do_action( 'wmhook_reykjavik_site_info_after' ); ?>

	</div>
</div>
