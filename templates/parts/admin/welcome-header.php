<?php
/**
 * Admin "Welcome" page content component
 *
 * Header.
 *
 * @package    Reykjavík
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





?>

<div class="wm-notes special">

	<h1>
		<?php

		printf(
			esc_html_x( 'Welcome to %1$s %2$s', '1: theme name, 2: theme version number.', 'reykjavik' ),
			'<strong>' . wp_get_theme( 'reykjavik' )->get( 'Name' ) . '</strong>',
			'<small>' . REYKJAVIK_THEME_VERSION . '</small>'
		);

		?>
	</h1>

	<div class="welcome-text about-text">
		<?php

		printf(
			esc_html_x( 'Thank you for using %1$s WordPress theme by %2$s!', '1: theme name, 2: theme developer link.', 'reykjavik' ),
			'<strong>' . wp_get_theme( 'reykjavik' )->get( 'Name' ) . '</strong>',
			'<a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'AuthorURI' ) ) . '" target="_blank"><strong>WebMan Design</strong></a>'
		);

		?>
		<br>
		<?php esc_html_e( 'Please take time to read the steps below to set up your website.', 'reykjavik' ); ?>
	</div>

	<p class="wm-actions">

		<a href="https://www.webmandesign.eu/manual/reykjavik/" class="button button-primary button-hero" target="_blank"><?php esc_html_e( 'Theme Documentation', 'reykjavik' ); ?></a>

		<a href="https://www.webmandesign.eu/reference/#links-support" class="button button-hero" target="_blank"><?php esc_html_e( 'Support Center', 'reykjavik' ); ?></a>

	</p>

</div>

<div class="welcome-content">
