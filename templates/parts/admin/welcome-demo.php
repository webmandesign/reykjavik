<?php
/**
 * Admin "Welcome" page content component
 *
 * Demo content installation.
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

	<h2 class="mt0"><strong><?php esc_html_e( 'Installing the theme demo content', 'reykjavik' ); ?></strong></h2>

	<p>
		<?php esc_html_e( 'You can install the theme demo content including pages, posts, custom post types, layouts, menus and widgets directly from your WordPress dashboard by clicking the button bellow.', 'reykjavik' ); ?>
	</p>

	<p>
		<?php esc_html_e( 'Alternatively (such as when the automated installation fails) you can follow theme documentation instructions for manual demo content installation.', 'reykjavik' ); ?>
		<a href="https://webmandesign.github.io/docs/reykjavik/#demo-content"><?php esc_html_e( 'Read the instructions &raquo;', 'reykjavik' ); ?></a>
	</p>

	<?php if ( ! class_exists( 'OCDI_Plugin' ) ) : ?>

		<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-hero"><strong><?php esc_html_e( 'Install and run "One Click Demo Import" plugin', 'reykjavik' ); ?></strong></a>

	<?php else : ?>

		<a href="<?php echo esc_url( 'themes.php?page=pt-one-click-demo-import' ); ?>" class="button button-hero button-primary"><strong><?php esc_html_e( 'Install theme demo content', 'reykjavik' ); ?></strong></a>

		<br>
		<small><em>
			<?php esc_html_e( 'Or head over to Appearance &raquo; Import Demo Data to start the import process.', 'reykjavik' ); ?>
		</em></small>

	<?php endif; ?>

</div>
