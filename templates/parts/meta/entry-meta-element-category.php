<?php
/**
 * Post meta: Category
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 */





// Requirements check

	if (
		! Reykjavik_Library::is_categorized_blog()
		|| ! $categories = get_the_category_list( ', ', '', get_the_ID() )
	) {
		return;
	}


?>

<span class="entry-meta-element cat-links">
	<span class="entry-meta-description">
		<?php echo esc_html_x( 'Categorized in:', 'Post meta info description: categories list.', 'reykjavik' ); ?>
	</span>
	<?php echo $categories; /* WPCS: XSS OK. */ ?>
</span>
