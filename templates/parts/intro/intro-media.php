<?php
/**
 * Page intro media
 *
 * Video is displayed on front page only,
 * and only on screens larger than 900 x 500 pixels.
 *
 * @link  https://make.wordpress.org/core/2016/11/26/video-headers-in-4-7/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.1.0
 */

if (
	Reykjavik_Post::is_paged()
	|| ! function_exists( 'the_custom_header_markup' )
	|| ! get_custom_header_markup()
	|| ( Reykjavik_Post::is_singular() && get_post_meta( get_the_ID(), 'no_intro_media', true ) )
) {
	return;
}

?>

<div id="intro-media" class="intro-media">
	<?php

	if (
		is_singular()
		&& has_post_thumbnail( get_the_ID() )
		&& empty( get_post_meta( get_the_ID(), 'intro_image', true ) )
	) {

		echo '<div id="wp-custom-header" class="wp-custom-header">';
		the_post_thumbnail( 'reykjavik-intro' );
		echo '</div>';

	} else {
		the_custom_header_markup();
	}

	?>
</div>
