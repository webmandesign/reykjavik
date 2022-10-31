<?php
/**
 * Admin "Welcome" page content component.
 *
 * Promo.
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

<div class="welcome__section welcome__section--promo" id="welcome-promo">

	<h2>
		<span class="welcome__icon dashicons dashicons-superhero-alt"></span>
		<?php esc_html_e( 'Like the theme?', 'reykjavik' ); ?>
	</h2>

	<p>
		<?php esc_html_e( 'You are using a fully functional 100% free WordPress theme without any paid upgrade.', 'reykjavik' ); ?>
		<?php esc_html_e( 'If you find it helpful, please support its updates and technical support service with a donation or by purchasing one of paid products at WebManDesign.eu.', 'reykjavik' ); ?>
		<?php esc_html_e( 'Thank you!', 'reykjavik' ); ?>
	</p>

	<p><a href="https://www.webmandesign.eu/contact/#donation"><strong><?php esc_html_e( 'Visit WebMan Design website now &rarr;', 'reykjavik' ); ?></strong></a></p>

</div>
