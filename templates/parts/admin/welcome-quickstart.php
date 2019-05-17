<?php
/**
 * Admin "Welcome" page content component
 *
 * Quickstart guide.
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

<h2 class="screen-reader-text"><?php esc_html_e( 'Quickstart Guide', 'reykjavik' ); ?></h2>

<div class="feature-section two-col has-2-columns" style="max-width: none;">

	<div class="first-feature col column">

		<span class="dropcap">1</span>

		<h3><?php esc_html_e( 'WordPress settings', 'reykjavik' ); ?></h3>

		<p>
			<?php esc_html_e( 'Do not forget to set up your WordPress in "Settings" section of the WordPress dashboard.', 'reykjavik' ); ?>
			<?php esc_html_e( 'Please go through all the subsections and options.', 'reykjavik' ); ?>
			<?php esc_html_e( 'This step is required for all WordPress websites.', 'reykjavik' ); ?>
		</p>

		<p>
			<strong><?php esc_html_e( 'Please, pay special attention to image sizes setup under Settings &raquo; Media.', 'reykjavik' ); ?></strong>
		</p>

		<a class="button button-hero" href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>"><?php esc_html_e( 'Set Up WordPress &raquo;', 'reykjavik' ); ?></a>

	</div>

	<div class="last-feature col column">

		<span class="dropcap">2</span>

		<h3><?php esc_html_e( 'Customize the theme', 'reykjavik' ); ?></h3>

		<p>
			<?php esc_html_e( 'You can customize the theme using live-preview editor.', 'reykjavik' ); ?>
			<?php esc_html_e( 'Customization changes will go live only after you save them!', 'reykjavik' ); ?>
		</p>

		<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary button-hero"><?php esc_html_e( 'Customize the Theme &raquo;', 'reykjavik' ); ?></a>

	</div>

</div>
