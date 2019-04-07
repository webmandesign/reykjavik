<?php
/**
 * Skip links
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.5.2
 * @version  1.5.2
 */





?>

<ul class="skip-link-list">
	<?php

	$links = array(
		'site-navigation' => __( 'Skip to main navigation', 'reykjavik' ),
		'content'         => __( 'Skip to main content', 'reykjavik' ),
		'colophon'        => __( 'Skip to footer', 'reykjavik' ),
	);

	foreach ( $links as $id => $text ) {
		echo Reykjavik_Library::link_skip_to(
			$id,
			$text,
			'',
			'<li class="skip-link-list-item">%s</li>'
		);
	}

	?>
</ul>
