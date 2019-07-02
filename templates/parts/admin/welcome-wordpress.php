<?php
/**
 * Admin "Welcome" page content component
 *
 * WordPress guide.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 */





// Requirements check

	if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
		return;
	}


?>

<div class="wm-notes special" style="padding: 2em; font-size: inherit;">

	<a class="button button-hero button-primary mt0 alignright" href="https://webmandesign.github.io/docs/reykjavik/#wordpress"><?php esc_html_e( 'WordPress Video Tutorials &raquo;', 'reykjavik' ); ?></a>

	<h2 class="mt0" style="font-size: 1.618em;"><strong><?php esc_html_e( 'New to WordPress?', 'reykjavik' ); ?></strong></h2>

	<p>
		<?php esc_html_e( 'If you are new to WordPress, please check out the introduction section in theme documentation.', 'reykjavik' ); ?>
	</p>

</div>
