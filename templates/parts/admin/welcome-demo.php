<?php
/**
 * Admin "Welcome" page content component.
 *
 * Theme demo.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  2.2.0
 */

if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
	return;
}

?>

<div class="welcome__section welcome__section--demo" id="welcome-demo">

	<h2>
		<span class="welcome__icon dashicons dashicons-database-add"></span>
		<?php esc_html_e( 'Theme Demo Content', 'reykjavik' ); ?>
	</h2>

	<div class="welcome__section--child">
		<h3><?php esc_html_e( 'Full theme demo content', 'reykjavik' ); ?></h3>

		<p>
			<?php esc_html_e( 'You can install a full theme demo content to match the theme demo website.', 'reykjavik' ); ?>
			<a href="https://themedemos.webmandesign.eu/reykjavik/"><?php esc_html_e( '(Preview the demo &rarr;)', 'reykjavik' ); ?></a>
			<?php esc_html_e( 'This provides a comprehensive start for building your own website.', 'reykjavik' ); ?>
		</p>

		<?php if ( class_exists( 'OCDI_Plugin' ) ) : ?>
			<p>
				<a class="button button-hero" href="<?php echo esc_url( 'themes.php?page=pt-one-click-demo-import' ); ?>"><?php esc_html_e( 'Install demo content', 'reykjavik' ); ?></a>
				&ensp;
				<small><em><?php esc_html_e( '(Appearance &rarr; Import Demo Data)', 'reykjavik' ); ?></em></small>
			</p>
		<?php else : ?>
			<p><a href="https://webmandesign.github.io/docs/reykjavik/#demo-content"><?php esc_html_e( 'How to import demo content &raquo;', 'reykjavik' ); ?></a></p>
		<?php endif; ?>
	</div>

</div>
