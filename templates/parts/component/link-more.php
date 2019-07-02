<?php
/**
 * More link HTML
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 */





// Variables

	$has_more_tag = Reykjavik_Library::has_more_tag();
	$more_tag     = ( $has_more_tag ) ? ( '#more-' . get_the_ID() ) : ( '' );
	$hidden_title = the_title( '<span class="screen-reader-text"> &ldquo;', '&rdquo;</span>', false );


?>

<div class="link-more">
	<a href="<?php the_permalink(); echo esc_url( $more_tag ); ?>" class="more-link"><?php

		if ( is_string( $has_more_tag ) ) {
			printf(
				$has_more_tag,
				$hidden_title
			);
		} else {
			printf(
				esc_html_x( 'Continue reading%s&hellip;', '%s: Name of current post.', 'reykjavik' ),
				$hidden_title
			);
		}

	?></a>
</div>
