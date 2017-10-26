<?php
/**
 * Breadcrumbs content
 *
 * @package    Reykjavik
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


?>

<?php do_action( 'wmhook_reykjavik_breadcrumb_navxt_before' ); ?>

<div class="breadcrumbs-container">
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs navigation', 'reykjavik' ); ?>">

		<?php bcn_display(); ?>

	</nav>
</div>

<?php do_action( 'wmhook_reykjavik_breadcrumb_navxt_after' ); ?>
