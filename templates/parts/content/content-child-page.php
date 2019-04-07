<?php
/**
 * Child page item content
 *
 * If a child page has a content, a featured image and page title will link
 * to the page and "continue reading" button is added at the bottom.
 *
 * Featured image:
 * By default the page featured image is used. You can override this by setting
 * a `custom_image` custom field to an image ID, object or URL. You can also use
 * a `custom_image_alt` custom field to set an image alt text.
 * Alternatively, if a page has a feature image set and you don't want to display
 * it in child pages list, set a `no_thumbnail` custom field to `1` (true).
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 */





// Helper variables

	$child_id      = get_the_ID();
	$has_more_link = (bool) apply_filters( 'wmhook_reykjavik_content_child_page_has_more_link', get_the_content(), $child_id );
	$image_size    = (string) apply_filters( 'wmhook_reykjavik_content_child_page_image_size', 'medium', $child_id );

	// Getting a (custom) featured image

		$page_image_url = trim( get_post_meta( $child_id, 'custom_image', true ) );
		$image_alt_attr = trim( get_post_meta( $child_id, 'custom_image_alt', true ) );

		if ( get_post_meta( $child_id, 'no_thumbnail', true ) ) {
			$page_image_url = '-';
		}

		if ( empty( $image_alt_attr ) ) {
			$image_alt_attr = the_title_attribute( 'echo=0' );
		}

		if ( is_object( $page_image_url ) ) {
			$page_image_url = absint( $page_image_url->ID );
		}

		if ( is_numeric( $page_image_url ) ) {
			$image_alt_attr = get_post_meta( absint( $page_image_url ), '_wp_attachment_image_alt', true );
			$page_image_url = wp_get_attachment_image_src( absint( $page_image_url ), $image_size );
			$page_image_url = $page_image_url[0];
		}

		if ( empty( $page_image_url ) && has_post_thumbnail( $child_id ) ) {
			$image_alt_attr = get_post_meta( get_post_thumbnail_id( $child_id ), '_wp_attachment_image_alt', true );
			$page_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $child_id ), $image_size );
			$page_image_url = $page_image_url[0];
		}

		$page_image_url = (string) apply_filters( 'wmhook_reykjavik_content_child_page_image_url', $page_image_url, $child_id );

	// Set helper CSS classes

		$child_page_class = ( $page_image_url && '-' != $page_image_url ) ? ( ' has-child-page-image' ) : ( ' no-child-page-image' );


?>

<article id="post-<?php echo esc_attr( $child_id ); ?>" class="child-page post-<?php echo esc_attr( $child_id ) . esc_attr( $child_page_class ); ?>">

	<?php if ( $page_image_url && '-' != $page_image_url ) : ?>

	<figure class="child-page-image">
		<?php

		if ( $has_more_link ) {
			echo '<a href="' . esc_url( get_permalink( $child_id ) ) . '">';
		}

		?>

		<img
			src="<?php echo esc_url( $page_image_url ); ?>"
			alt="<?php echo esc_attr( $image_alt_attr ); ?>"
			title="<?php echo the_title_attribute( 'echo=0&post=' . $child_id ); ?>"
			/>

		<?php

		if ( $has_more_link ) {
			echo '</a>';
		}

		?>
	</figure>

	<?php endif; ?>

	<h2 class="child-page-title">
		<?php

		if ( $has_more_link ) {
			echo '<a href="' . esc_url( get_permalink( $child_id ) ) . '">';
		}

		the_title();

		if ( $has_more_link ) {
			echo '</a>';
		}

		?>
	</h2>

	<?php if ( has_excerpt() ) : ?>

	<div class="child-page-summary">
		<?php

		if ( ! $has_more_link ) {
			add_filter( 'wmhook_reykjavik_summary_continue_reading_pre', '__return_empty_string' );
		}

		the_excerpt();

		remove_filter( 'wmhook_reykjavik_summary_continue_reading_pre', '__return_empty_string' );

		?>
	</div>

	<?php endif; ?>

</article>
