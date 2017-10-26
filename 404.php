<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link  https://codex.wordpress.org/Creating_an_Error_404_Page
 * @uses  `wmhook_reykjavik_title_primary_disable` global hook to disable `#primary` section H1
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





get_header();

	?>

	<section class="error-404 not-found">

		<?php if ( ! (bool) apply_filters( 'wmhook_reykjavik_title_primary_disable', false ) ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'reykjavik' ); ?></h1>
		</header>

		<?php endif; ?>
		<div class="page-content">

			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try the search below?', 'reykjavik' ); ?></p>

			<?php get_search_form(); ?>

		</div>

	</section>

	<?php

get_footer();
