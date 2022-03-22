<?php
/**
 * Admin "Welcome" page content component
 *
 * Promo.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.1.0
 */

if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
	return;
}

?>

<div class="welcome-upgrade">

	<div class="two-col has-2-columns" style="max-width: none;">

		<div class="col column">

			<h2><?php esc_html_e( 'Enjoying the theme?', 'reykjavik' ); ?></h2>

			<p>
				<?php esc_html_e( 'If you like this free WordPress theme, please, consider supporting its development with a donation.', 'reykjavik' ); ?>
				<a href="https://www.webmandesign.eu/contact/#donation"><?php esc_html_e( 'Donate to WebMan Design &raquo;', 'reykjavik' ); ?></a>
			</p>

			<p>
				<?php esc_html_e( 'You can also rate the theme at WordPress repository page.', 'reykjavik' ); ?>
				<a href="https://wordpress.org/support/theme/reykjavik/reviews/#new-post">
					<?php esc_html_e( "Rate the theme with &#9733;&#9733;&#9733;&#9733;&#9733; :)", 'reykjavik' ); ?>
				</a>
			</p>

			<p class="welcome-upgrade-thanks">
				<?php esc_html_e( 'Thank you!', 'reykjavik' ); ?>
			</p>

		</div>

		<div class="col column">

			<h2><?php esc_html_e( 'Feel like stepping up?', 'reykjavik' ); ?></h2>

			<p>
				<?php esc_html_e( 'I invite you to check out my faster, better, modern themes too!', 'reykjavik' ); ?>
				<?php esc_html_e( 'There is a whole new generation of WordPress themes I offer nowadays.', 'reykjavik' ); ?>
				<?php esc_html_e( 'They all are fully block editor (Gutenberg) ready to ensure the best performance and ease of use.', 'reykjavik' ); ?>
			</p>
			<p>
				<a href="https://www.webmandesign.eu/project-tag/modern-themes/" class="welcome-upgrade-button">
					<?php esc_html_e( 'Modern themes &rarr;', 'reykjavik' ); ?>
				</a>
			</p>

		</div>

	</div>

</div>

<style>

	.welcome-wrap .wm-notes.special {
		padding-bottom: 120px;
		margin-bottom: 0;
		border: 0;
		border-radius: 40px;
	}

	.welcome-upgrade {
		position: relative;
		padding: 6%;
		margin: -100px -20px 100px;
		font-weight: 500;
		color: #000;
	}

		.welcome-upgrade::before {
			content: '';
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			background-color: #fbce2f;
			border-radius: 40px;
			box-shadow: 0 .15em .5em rgba(0,0,0,.25);
			transform: skewY(-4deg);
		}

	.welcome-upgrade .two-col {
		position: relative;
		-webkit-align-items: stretch;
		-moz-box-align: stretch;
		-ms-flex-align: stretch;
		align-items: stretch;
	}

	.welcome-upgrade h2 {
		margin: 0 0 1em;
		font-size: 2.058em;
		font-weight: 700;
		color: inherit;
	}

	.welcome-upgrade p {
		font-size: inherit;
	}

		.welcome-upgrade .welcome-upgrade-thanks {
			margin: 1.62rem 0 0;
			font-size: 2.058em;
			font-weight: 300;
		}

	.welcome-upgrade a {
		color: inherit;
	}

		.welcome-upgrade-button {
			display: inline-block;
			padding: .62em 1.62em;
			margin-top: 1em;
			text-decoration: none;
			font-size: 1rem;
			text-shadow: none;
			background: none;
			color: inherit;
			border: 2px solid;
			box-shadow: none;
		}

			.welcome-upgrade-button:hover,
			.welcome-upgrade-button:focus,
			.welcome-upgrade-button:active {
				background-color: #fefeff;
				color: #0f1732;
				border-color: #fefeff;
			}

	.welcome-upgrade li::before {
		margin: 0 .62em;
	}

</style>
