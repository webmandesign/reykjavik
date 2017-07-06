<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

	<h2 class="comments-title">
		<?php

		printf(
			esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'Comments list title.', 'reykjavik' ) ),
			number_format_i18n( get_comments_number() ),
			'<span>' . get_the_title() . '</span>'
		);

		?>
	</h2>

	<?php

	/**
	 * Comments list
	 */
	if ( have_comments() ) {

		// If comments are closed and there are comments, let's leave a little note, shall we?

			if (
					! comments_open()
					&& get_comments_number()
					&& post_type_supports( get_post_type(), 'comments' )
				) :

				?>

				<p class="comments-closed no-comments"><?php esc_html_e( 'Comments are closed.', 'reykjavik' ); ?></p>

				<?php

			endif;

		// Actual comments list

			?>

			<ol class="comment-list">
				<?php

				wp_list_comments( array(
						'type'        => 'comment', // Do not display trackbacks and pingbacks
						'avatar_size' => 240,
						'style'       => 'ol',
						'short_ping'  => true,
					) );

				?>
			</ol>

			<?php

		// Are there comments to navigate through?

			if (
					1 < get_comment_pages_count()
					&& get_option( 'page_comments' )
				) :

				$total   = get_comment_pages_count();
				$current = ( get_query_var( 'cpage' ) ) ? ( absint( get_query_var( 'cpage' ) ) ) : ( 1 );

				?>

				<nav id="comment-nav-below" class="pagination comment-pagination" role="navigation" aria-labelledby="comment-nav-below-label" data-current="<?php echo esc_attr( $current ); ?>" data-total="<?php echo esc_attr( $total ); ?>">

					<h2 class="screen-reader-text" id="comment-nav-below-label"><?php esc_html_e( 'Comments Navigation', 'reykjavik' ); ?></h2>

					<?php

					paginate_comments_links( array(
							'prev_text' => esc_html_x( '&laquo;', 'Pagination text (visible): previous.', 'reykjavik' ) . '<span class="screen-reader-text"> '
							               . esc_html_x( 'Previous page', 'Pagination text (hidden): previous.', 'reykjavik' ) . '</span>',
							'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next page', 'Pagination text (hidden): next.', 'reykjavik' )
							               . ' </span>' . esc_html_x( '&raquo;', 'Pagination text (visible): next.', 'reykjavik' ),
						) );

					?>

				</nav>

				<?php

			endif;

	} // /have_comments()



	/**
	 * Comments form
	 */
	comment_form();

	?>

</div>
</div><!-- #comments -->

<?php

do_action( 'tha_comments_after' );
