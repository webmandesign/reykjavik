<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link  https://codex.wordpress.org/Template_Hierarchy
 * @uses  `wmhook_reykjavik_title_primary_disable` global hook to disable `#primary` section H1
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





?>

<section class="no-results not-found">

	<?php if ( ! (bool) apply_filters( 'wmhook_reykjavik_title_primary_disable', false ) ) : ?>
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'reykjavik' ); ?></h1>
	</header>

	<?php endif; ?>
	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php

				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'reykjavik' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);

			?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'reykjavik' ); ?></p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'reykjavik' ); ?></p>

			<?php get_search_form(); ?>

		<?php endif; ?>

	</div>

</section>
