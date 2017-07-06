<?php
/**
 * Post meta: Author
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





?>

<span class="entry-meta-element byline author vcard">
	<span class="entry-meta-description">
		<?php echo esc_html_x( 'Written by:', 'Post meta info description: author name.', 'reykjavik' ); ?>
	</span>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="url fn n" rel="author">
		<?php the_author(); ?>
	</a>
</span>
