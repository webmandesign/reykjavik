<?php
/**
 * Admin "Welcome" page content component.
 *
 * Footer.
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

<div class="welcome__section welcome__footer">
	<p><?php echo Reykjavik_Welcome::get_info_like(); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
	<p><?php echo Reykjavik_Welcome::get_info_support(); /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ ?></p>
</div>

<div class="welcome__section welcome__section--colophon">
	<p><small><em><?php esc_html_e( 'You can disable this page in Appearance &rarr; Customize &rarr; Theme Options &rarr; Others.', 'reykjavik' ); ?></em></small></p>
</div>
