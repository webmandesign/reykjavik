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
 * @version  2.0.0
 */





// Requirements check

	if ( ! class_exists( 'Reykjavik_Welcome' ) ) {
		return;
	}


?>

<div class="welcome-upgrade">

	<div class="two-col has-2-columns" style="max-width: none;">

		<div class="col column">

			<h2><strong><?php esc_html_e( 'Do you like this theme?', 'reykjavik' ); ?></strong></h2>

			<p>
				<?php esc_html_e( 'If you like this free WordPress theme, please, consider supporting its development by purchasing one of my premium products.', 'reykjavik' ); ?>
				(<a href="https://www.webmandesign.eu" target="_blank"><?php esc_html_e( 'Go to WebMan Design website &raquo;', 'reykjavik' ); ?></a>)
				<?php esc_html_e( 'Or perhaps you are considering a small donation?', 'reykjavik' ); ?>
				&rarr;
				<a href="https://webmandesign.eu/contact/?utm_source=reykjavik" target="_blank"><em><?php esc_html_e( '"Hey Oliver, have a gallon of coffee on me :)"', 'reykjavik' ); ?></em></a>
			</p>

			<p>
				<?php esc_html_e( 'You can also rate it at its WordPress repository page.', 'reykjavik' ); ?>
				<a href="https://wordpress.org/support/theme/reykjavik/reviews/#new-post">
					<?php esc_html_e( "Let's go and rate the theme with &#9733;&#9733;&#9733;&#9733;&#9733; :)", 'reykjavik' ); ?>
				</a>
			</p>

			<p>
				<a href="https://webmandesign.eu/contact/?utm_source=reykjavik" target="_blank" class="welcome-upgrade-button"><?php esc_html_e( 'Support theme development', 'reykjavik' ); ?></a>
			</p>

			<p class="welcome-upgrade-thanks">
				<?php esc_html_e( 'Thank you!', 'reykjavik' ); ?>
			</p>

		</div>

		<div class="col column">

			<h2><strong><?php esc_html_e( 'Feel like stepping up?', 'reykjavik' ); ?></strong></h2>

			<p>
				<?php

				printf(
					esc_html_x( 'If you need more for your growing website, consider upgrading to %s theme with this additional functionality:', '%s = linked theme name.', 'reykjavik' ),
					'<a href="https://www.webmandesign.eu/portfolio/icelander-wordpress-theme/"><strong>Icelander</strong></a>'
				);

				?>
			</p>
			<ul>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Portfolios, Staff, Testimonials management', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Additional layouts and widget areas', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Custom page builder elements', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Sticky header functionality', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Custom icons uploader', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Additional blog styles', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li class="dashicons-before dashicons-star-filled"><?php echo esc_html_x( 'Child theme generator', 'Theme feature.', 'reykjavik' ); ?>,</li>
				<li><?php echo esc_html_x( 'And more&hellip;', 'Theme feature.', 'reykjavik' ); ?></li>
			</ul>
			<p>
				<a href="https://www.webmandesign.eu/portfolio/icelander-wordpress-theme/" class="welcome-upgrade-button">
					<?php

					printf(
						esc_html_x( 'Upgrade to %s theme', '%s = theme name.', 'reykjavik' ),
						'<strong>Icelander</strong>'
					);

					?>
				</a>
			</p>

		</div>

	</div>

</div>

<style>

	.welcome-upgrade {
		position: relative;
		padding: 2.62em;
		background-color: #0f1732;
		background-image: url('<?php echo esc_url_raw( trailingslashit( get_template_directory_uri() ) ); ?>assets/images/footer/pixabay-colorado-1436681.png');
		background-size: cover;
		color: #fefeff;
	}

		.welcome-upgrade::before {
			content: '';
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
			background-color: inherit;
			opacity: .85;
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
			font-family: Georgia, serif;
			font-size: 2.058em;
			font-style: italic;
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
