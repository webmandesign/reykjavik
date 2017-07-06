<?php
/**
 * Child pages list loop
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Helper variables

	$child_pages = new WP_Query( (array) apply_filters( 'wmhook_reykjavik_loop_child_pages_query', array(
			'post_type'           => 'page',
			'orderby'             => 'menu_order',
			'order'               => 'ASC',
			'post_parent'         => get_the_ID(), // Get only direct children.
			'posts_per_page'      => 12,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
		) ) );


// Requirements check

	if ( ! $child_pages->have_posts() ) {
		return;
	}


?>

<section id="list-child-pages-section" class="list-child-pages-section">
	<div class="list-child-pages-container">

		<?php do_action( 'wmhook_reykjavik_loop_child_pages_before' ); ?>

		<div class="list-child-pages count-child-pages-<?php echo absint( $child_pages->post_count ); ?>">

			<?php

			do_action( 'wmhook_reykjavik_loop_child_pages_top' );

			while ( $child_pages->have_posts() ) {

				$child_pages->the_post();

				do_action( 'wmhook_reykjavik_loop_child_pages_item' );

			} // /while

			do_action( 'wmhook_reykjavik_loop_child_pages_bottom' );

			?>

		</div>

		<?php do_action( 'wmhook_reykjavik_loop_child_pages_after' ); ?>

	</div>
</section>

<?php

wp_reset_postdata();
