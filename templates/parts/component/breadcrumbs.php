<?php
/**
 * Breadcrumbs content
 *
 * @package    Reykjavík
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





// Requirements check

	if (
			! function_exists( 'bcn_display' )
			|| apply_filters( 'wmhook_reykjavik_breadcrumb_navxt_disabled', false )
		) {
		return;
	}


// Helper variables

	$unique_id = uniqid();


?>

<?php do_action( 'wmhook_reykjavik_breadcrumb_navxt_before' ); ?>

<div class="breadcrumbs-container">
	<nav class="breadcrumbs" aria-labelledby="breadcrumbs-label-<?php echo esc_attr( $unique_id ); ?>">

		<h2 class="screen-reader-text" id="breadcrumbs-label-<?php echo esc_attr( $unique_id ); ?>"><?php esc_attr_e( 'Breadcrumbs navigation', 'reykjavik' ); ?></h2>

		<?php bcn_display(); ?>

	</nav>
</div>

<?php do_action( 'wmhook_reykjavik_breadcrumb_navxt_after' ); ?>
