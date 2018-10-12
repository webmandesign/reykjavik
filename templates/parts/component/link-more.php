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

	$post_id      = get_the_ID();
	$has_more_tag = Reykjavik_Library::has_more_tag();
	$more_tag     = ( $has_more_tag ) ? ( '#more-' . $post_id ) : ( '' );
	$hidden_title = the_title( '<span class="screen-reader-text"> &ldquo;', '&rdquo;</span>', false );


?>

<div class="link-more">
	<a href="<?php echo esc_url( get_permalink( $post_id ) . $more_tag ); ?>" class="more-link">
		<?php

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

		?>
	</a>
</div>
