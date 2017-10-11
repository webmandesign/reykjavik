<?php
/**
 * Admin "Welcome" page content component
 *
 * WP Filesystem info.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Requirements check

	if ( ! current_theme_supports( 'stylesheet-generator' ) ) {
		return;
	}


?>

<h3>
	<em>
		<strong>
			<?php esc_html_e( 'Important:', 'reykjavik' ); ?>
		</strong>
	</em>
</h3>

<p>
	<em>
		<?php esc_html_e( 'For the best performance, the theme generates a single CSS stylesheet file using WordPress native filesystem API.', 'reykjavik' ); ?>
		<?php esc_html_e( 'The file is being generated after saving theme customizer settings.', 'reykjavik' ); ?>
		<?php esc_html_e( 'If you notice an error message in WordPress dashboard after leaving the theme customizer, please check whether you should set up the FTP credentials in your "wp-config.php" file.', 'reykjavik' ); ?>
		<a href="http://codex.wordpress.org/Editing_wp-config.php#WordPress_Upgrade_Constants"><?php esc_html_e( 'In that case please read the instructions &raquo;', 'reykjavik' ); ?></a>
	</em>
</p>
