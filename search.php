<?php
/**
 * The template for displaying search results pages
 *
 * @link  https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @uses  `wmhook_reykjavik_title_primary_disable` global hook to disable `#primary` section H1
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





get_header();

	if ( have_posts() ) :

		if ( ! (bool) apply_filters( 'wmhook_reykjavik_title_primary_disable', false ) ) :

			?>

			<header class="page-header">
				<h1 class="page-title"><?php

					printf(
						/* translators: %s: search query. */
						esc_html__( 'Search Results for: %s', 'reykjavik' ),
						'<span>' . get_search_query() . '</span>'
					);

				?></h1>
			</header>

			<?php

		endif;

		get_template_part( 'templates/parts/loop/loop', 'search' );

	else :

		get_template_part( 'templates/parts/content/content', 'none' );

	endif;

get_footer();
