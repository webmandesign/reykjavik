<?php
/**
 * Admin "Welcome" page content component.
 *
 * Header.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.2.0
 */

if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
	return;
}

?>

<div class="welcome__section welcome__header">

	<h1>
		<?php echo wp_get_theme( 'reykjavik' )->display( 'Name' ); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?>
		<small><?php echo REYKJAVIK_THEME_VERSION; /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></small>
	</h1>

	<p class="welcome__intro">
		<?php

		printf(
			/* translators: 1: theme name, 2: theme developer link. */
			esc_html__( 'Congratulations and thank you for choosing %1$s theme by %2$s!', 'reykjavik' ),
			'<strong>' . wp_get_theme( 'reykjavik' )->display( 'Name' ) . '</strong>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			'<a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'AuthorURI' ) ) . '"><strong>WebMan Design</strong></a>'
		);

		?>
		<?php esc_html_e( 'Information on this page introduces the theme and provides useful tips.', 'reykjavik' ); ?>
	</p>

	<nav class="welcome__nav">
		<ul>
			<li><a href="#welcome-a11y"><?php esc_html_e( 'Accessibility', 'reykjavik' ); ?></a></li>
			<li><a href="#welcome-guide"><?php esc_html_e( 'Quickstart', 'reykjavik' ); ?></a></li>
			<li><a href="#welcome-demo"><?php esc_html_e( 'Demo content', 'reykjavik' ); ?></a></li>
			<li><a href="#welcome-promo"><?php esc_html_e( 'Upgrade', 'reykjavik' ); ?></a></li>
		</ul>
	</nav>

	<p>
		<a href="https://webmandesign.github.io/docs/reykjavik/" class="button button-hero button-primary"><?php esc_html_e( 'Documentation &rarr;', 'reykjavik' ); ?></a>
		<a href="https://support.webmandesign.eu/forums/forum/reykjavik/" class="button button-hero button-primary"><?php esc_html_e( 'Support Forum &rarr;', 'reykjavik' ); ?></a>
	</p>

	<p class="welcome__alert welcome__alert--tip">
		<strong class="welcome__badge"><?php echo esc_html_x( 'Tip:', 'Notice, hint.', 'reykjavik' ); ?></strong>
		<?php echo Reykjavik_Welcome::get_info_like(); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?>
	</p>

</div>

<div class="welcome-content">
