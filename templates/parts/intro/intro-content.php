<?php
/**
 * Page intro content
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Helper variables

	$post_id      = get_the_ID();
	$posts_page   = get_option( 'page_for_posts' );
	$page_summary = '';

	$class_title  = ( is_single() ) ? ( 'entry-title' ) : ( 'page-title' );
	$class_title .= ' h1 intro-title';

	$intro_title_tag   = ( is_front_page() ) ? ( 'h2' ) : ( 'h1' );
	$pagination_suffix = Reykjavik_Library::get_the_paginated_suffix( 'small' );

	if ( is_home() && $posts_page && ! is_front_page() ) {
		$post_id = $posts_page;
	}

	$title               = get_the_title( $post_id );
	$title_paginated_url = get_permalink( $post_id );

	$intro_title_tag = apply_filters( 'wmhook_reykjavik_intro_title_tag', $intro_title_tag, $post_id );
	$title           = apply_filters( 'wmhook_reykjavik_intro_title', $title, $post_id );


// Processing

	if ( ! $pagination_suffix ) {

		// Page summary setup

			if ( is_singular() && has_excerpt() ) {
				$page_summary = get_the_excerpt();
			} elseif ( is_home() && $posts_page && ! is_front_page() ) {
				$page_for_posts = get_post( absint( $posts_page ) );
				$page_summary   = apply_filters( 'get_the_excerpt', $page_for_posts->post_excerpt );
			} elseif ( is_archive() ) {
				$page_summary = get_the_archive_description();
			}

			if ( $page_summary ) {
				$class_title .= ' has-page-summary';
			}

	} else {

		// Title setup

			$title = '<a href="' . esc_url( $title_paginated_url ) . '">' . $title . '</a>' . $pagination_suffix;

	}

	$title = '<' . tag_escape( $intro_title_tag ) . ' class="' . esc_attr( $class_title ) . '">' . $title . '</' . tag_escape( $intro_title_tag ) . '>';


// Output

	/**
	 * Page title
	 */

		if ( is_archive() ) { // For archive pages.

			$title  = '<' . tag_escape( $intro_title_tag ) . ' class="' . esc_attr( $class_title ) . '">';
			$title .= get_the_archive_title();
			$title .= $pagination_suffix;
			$title .= '</' . tag_escape( $intro_title_tag ) . '>';

		} elseif ( is_search() ) { // For search results.

			$title  = '<' . tag_escape( $intro_title_tag ) . ' class="' . esc_attr( $class_title ) . '">';
			$title .= sprintf(
					esc_html__( 'Search Results for: %s', 'reykjavik' ),
					'<span>' . get_search_query() . '</span>'
				);
			$title .= $pagination_suffix;
			$title .= '</' . tag_escape( $intro_title_tag ) . '>';

		} elseif ( is_front_page() && is_home() ) { // For blog front page.

			$title  = '<' . tag_escape( $intro_title_tag ) . ' class="' . esc_attr( $class_title ) . '">';
			$title .= get_bloginfo( 'name' );
			$title .= $pagination_suffix;

			if ( $site_description = get_bloginfo( 'description', 'display' ) ) {
				$title .= '<span class="intro-title-separator"> &mdash; </span>';
				$title .= '<small class="intro-title-tagline">' . $site_description . '</small>';
			}

			$title .= '</' . tag_escape( $intro_title_tag ) . '>';

		}

		echo $title;



	/**
	 * Page summary
	 */
	if ( $page_summary ) :

		?>

		<div class="page-summary">
			<?php echo $page_summary; ?>
		</div>

		<?php

	endif;
