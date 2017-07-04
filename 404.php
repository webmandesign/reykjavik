<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package    Reykjavík
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





get_header();

	?>

	<section class="error-404 not-found">

		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'reykjavik' ); ?></h1>
		</header>

		<div class="page-content">

			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try the search below?', 'reykjavik' ); ?></p>

			<?php get_search_form(); ?>

		</div>

	</section>

	<?php

get_footer();
