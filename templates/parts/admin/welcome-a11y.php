<?php
/**
 * Admin "Welcome" page content component.
 *
 * Accessibility tips.
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

<div class="welcome__section welcome__section--a11y" id="welcome-a11y">

	<h2>
		<span class="welcome__icon dashicons dashicons-universal-access-alt"></span>
		<?php esc_html_e( 'Create an Accessible Website', 'reykjavik' ); ?>
	</h2>

	<p>
		<?php esc_html_e( 'Make your website inclusive and accessible to anyone.', 'reykjavik' ); ?>
		<?php esc_html_e( 'This theme will help you create a disabilities friendly and barrier-less user experience.', 'reykjavik' ); ?>
		<?php esc_html_e( 'When building your content, just follow web accessibility best practices.', 'reykjavik' ); ?>
	</p>

	<div class="welcome__column">
		<h3><?php esc_html_e( 'Simplicity', 'reykjavik' ); ?></h3>
		<p><?php esc_html_e( 'Keep your text simple. Paragraphs with more than four lines are more difficult to read. Use lists and spacing in your content.', 'reykjavik' ); ?></p>
	</div>

	<div class="welcome__column">
		<h3><?php esc_html_e( 'Hierarchy', 'reykjavik' ); ?></h3>
		<p><?php esc_html_e( 'Keep proper headings hierarchy, do not skip heading levels: H2 should be followed by H3 and so on.', 'reykjavik' ); ?></p>
	</div>

	<div class="welcome__column">
		<h3><?php esc_html_e( 'Images', 'reykjavik' ); ?></h3>
		<p><?php esc_html_e( 'Adding images to posts and pages makes your content easier to remember.', 'reykjavik' ); ?></p>
	</div>

	<div class="welcome__column">
		<h3><?php esc_html_e( 'Alternatives', 'reykjavik' ); ?></h3>
		<p>
			<?php esc_html_e( 'Set alt text to images (do this in the media library or directly in post editor).', 'reykjavik' ); ?>
			<?php esc_html_e( 'Provide text alternatives for videos and sound.', 'reykjavik' ); ?>
		</p>
	</div>

	<hr>

	<p><a href="https://webmandesign.github.io/docs/reykjavik/#accessibility"><?php esc_html_e( 'More info in theme documentation &rarr;', 'reykjavik' ); ?></a></p>

</div>
