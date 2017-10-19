<?php
/**
 * Image attachment template
 *
 * @link  https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





get_header();

	while ( have_posts() ) : the_post();

		get_template_part( 'templates/parts/content/content', 'attachment-image' );

	endwhile;

get_footer();
