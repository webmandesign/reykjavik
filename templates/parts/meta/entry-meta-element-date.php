<?php
/**
 * Post meta: Publish and update date
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Helper variables

	$post_id = get_the_ID();


?>

<span class="entry-meta-element entry-date posted-on">
	<span class="entry-meta-description">
		<?php echo esc_html_x( 'Posted on:', 'Post meta info description: publish date.', 'reykjavik' ); ?>
	</span>
	<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" rel="bookmark">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="published" title="<?php echo esc_attr( get_the_date() ) . ' | ' . esc_attr( get_the_time( '', $post_id ) ); ?>">
			<?php echo esc_html( get_the_date() ); ?>
		</time>
	</a>
	<time class="updated" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>">
		<?php echo esc_html( get_the_modified_date() ); ?>
	</time>
</span>
