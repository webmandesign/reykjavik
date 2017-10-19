<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link  https://codex.wordpress.org/Template_Hierarchy
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}





do_action( 'tha_comments_before' );

?>

<div id="comments" class="comments-area">
<div class="comments-area-inner">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php

			$comment_count = get_comments_number();

			if ( 1 === $comment_count ) {

				printf(
					/* translators: 1: title. */
					esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'reykjavik' ),
					'<span>' . get_the_title() . '</span>'
				);

			} else {

				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$d thought on &ldquo;%2$s&rdquo;', '%1$d thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'Comments list title.', 'reykjavik' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);

			}

			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php

			wp_list_comments( array(
				'avatar_size' => 240,
				'style'       => 'ol',
				'short_ping'  => true,
			) );

			?>
		</ol>

		<?php

		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>

			<p class="comments-closed no-comments"><?php esc_html_e( 'Comments are closed.', 'reykjavik' ); ?></p>

			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();

	?>

</div>
</div><!-- #comments -->

<?php

do_action( 'tha_comments_after' );
