<?php
/**
 * Admin notice: Welcome
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.5.2
 * @version  1.5.3
 */





// Requirements check

	if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
		return;
	}


// Variables

	$theme_name = wp_get_theme( 'reykjavik' )->display( 'Name' );


?>

<div class="updated notice is-dismissible theme-welcome-notice">
	<h2>
		<?php

		printf(
			esc_html_x( 'Thank you for installing %s theme!', '%s: Theme name.', 'reykjavik' ),
			'<strong>' . $theme_name . '</strong>'
		);

		?>
	</h2>
	<p>
		<?php esc_html_e( 'Visit "Welcome" page for information on how to set up your website.', 'reykjavik' ); ?>
		<br>
		<?php echo Reykjavik_Welcome::get_info_like(); ?>
	</p>
	<p class="call-to-action">
		<a href="<?php echo esc_url( admin_url( 'themes.php?page=reykjavik-welcome' ) ); ?>" class="button button-primary button-hero">
			<?php esc_html_e( 'Show "Welcome" page', 'reykjavik' ); ?>
		</a>
	</p>
</div>

<style type="text/css" media="screen">

	.notice.theme-welcome-notice {
		padding: 1.62em;
		line-height: 1.62;
		font-size: 1.38em;
		text-align: center;
		border: 0;
	}

	.theme-welcome-notice h2 {
		margin: 0 0 .62em;
		line-height: inherit;
		font-size: 1.62em;
		font-weight: 400;
	}

	.theme-welcome-notice p {
		font-size: inherit;
	}

	.theme-welcome-notice a {
		padding-bottom: 0;
	}

	.theme-welcome-notice strong {
		font-weight: bolder;
	}

	.theme-welcome-notice .call-to-action {
		margin-top: 1em;
	}

	.theme-welcome-notice .button.button {
		font-size: 1em;
	}

</style>
