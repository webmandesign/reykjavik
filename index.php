<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link  https://codex.wordpress.org/Template_Hierarchy
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

		if ( is_home() && ! is_front_page() && ! (bool) apply_filters( 'wmhook_reykjavik_title_primary_disable', false ) ) :

			?>

			<header class="page-header">
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<?php

		endif;

		get_template_part( 'templates/parts/loop/loop', 'index' );

	else :

		get_template_part( 'templates/parts/content/content', 'none' );

	endif;

get_footer();
