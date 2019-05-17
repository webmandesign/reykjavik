<?php
/**
 * Admin "Welcome" page content component
 *
 * Header.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.3
 */





// Requirements check

	if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
		return;
	}


?>

<div class="wm-notes special">

	<h1>
		<?php

		printf(
			esc_html_x( 'Welcome to %1$s %2$s', '1: theme name, 2: theme version number.', 'reykjavik' ),
			'<strong>' . wp_get_theme( 'reykjavik' )->display( 'Name' ) . '</strong>',
			'<small>' . REYKJAVIK_THEME_VERSION . '</small>'
		);

		?>
	</h1>

	<div class="welcome-text about-text">
		<?php

		printf(
			esc_html_x( 'Thank you for using %1$s WordPress theme by %2$s!', '1: theme name, 2: theme developer link.', 'reykjavik' ),
			'<strong>' . wp_get_theme( 'reykjavik' )->display( 'Name' ) . '</strong>',
			'<a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'AuthorURI' ) ) . '"><strong>WebMan Design</strong></a>'
		);

		?>
		<br>
		<?php esc_html_e( 'Please take time to read the steps below to set up your website.', 'reykjavik' ); ?>
		<br>
		<?php echo Reykjavik_Welcome::get_info_like(); ?>
	</div>

	<p class="wm-actions">

		<a href="https://webmandesign.github.io/docs/reykjavik/" class="button button-primary button-hero"><?php esc_html_e( 'Theme Documentation', 'reykjavik' ); ?></a>

		<a href="https://support.webmandesign.eu" class="button button-hero"><?php esc_html_e( 'Support Center', 'reykjavik' ); ?></a>

	</p>

</div>

<div class="welcome-content">
