<?php
/**
 * Loading theme functionality
 *
 * @link  https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *   0) Paths
 *   1) Theme framework
 *  10) Theme setup
 *  20) Frontend
 *  30) Features
 * 100) Custom widgets
 * 999) Plugins integration
 */





/**
 * 0) Paths
 */

	// Theme directory path

		define( 'REYKJAVIK_PATH', trailingslashit( get_template_directory() ) );

	// Includes path

		define( 'REYKJAVIK_PATH_INCLUDES', trailingslashit( REYKJAVIK_PATH . 'includes' ) );

		// Plugin compatibility files

			define( 'REYKJAVIK_PATH_PLUGINS', trailingslashit( REYKJAVIK_PATH_INCLUDES . 'plugins' ) );





/**
 * 1) Theme framework
 */

	require REYKJAVIK_PATH . 'library/init.php';





/**
 * 10) Theme setup
 */

	require REYKJAVIK_PATH_INCLUDES . 'setup/class-setup.php';

	require REYKJAVIK_PATH_INCLUDES . 'starter-content/class-starter-content.php';





/**
 * 20) Frontend
 */

	// Theme Hook Alliance

		require REYKJAVIK_PATH_INCLUDES . 'frontend/theme-hook-alliance.php';

	// SVG

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-svg.php';

	// Assets (styles and scripts)

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-assets.php';

	// Header

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-header.php';

	// Menu

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-menu.php';

	// Content

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-content.php';

	// Loop

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-loop.php';

	// Post

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-post.php';
		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-post-summary.php';
		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-post-media.php';

	// Footer

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-footer.php';

	// Sidebars (widget areas)

		require REYKJAVIK_PATH_INCLUDES . 'frontend/class-sidebar.php';





/**
 * 30) Features
 */

	// Theme Customization

		require REYKJAVIK_PATH_INCLUDES . 'customize/class-customize.php';

	// Customized Styles

		require REYKJAVIK_PATH_INCLUDES . 'customize/class-customize-styles.php';

	// Custom Header / Intro

		require REYKJAVIK_PATH_INCLUDES . 'custom-header/class-intro.php';





/**
 * 100) Custom widgets
 */

	// WordPress Recent Posts Widget

		require REYKJAVIK_PATH_INCLUDES . 'widgets/class-wp-widget-recent-posts.php';

	// WordPress Text Widget

		require REYKJAVIK_PATH_INCLUDES . 'widgets/class-wp-widget-text.php';





/**
 * 999) Plugins integration
 */

	// Advanced Custom Fields

		if ( function_exists( 'acf_add_local_field_group' ) && is_admin() ) {
			require REYKJAVIK_PATH_PLUGINS . 'advanced-custom-fields/advanced-custom-fields.php';
		}

	// Beaver Builder

		if ( class_exists( 'FLBuilder' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'beaver-builder/beaver-builder.php';
		}

	// Beaver Themer

		if ( class_exists( 'FLThemeBuilder' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'beaver-themer/beaver-themer.php';
		}

	// Beaver Builder Header Footer

		if ( class_exists( 'BB_Header_Footer' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'bb-header-footer/bb-header-footer.php';
		}

	// Breadcrumb NavXT

		if ( function_exists( 'bcn_display' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'breadcrumb-navxt/breadcrumb-navxt.php';
		}

	// Elementor

		/**
		 * @subpackage  Page Builder
		 * @subpackage  Theme Builder
		 */
		if ( class_exists( '\Elementor\Plugin' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'elementor/elementor.php';
		}

	// One Click Demo Import

		if ( class_exists( 'OCDI_Plugin' ) && is_admin() ) {
			require REYKJAVIK_PATH_PLUGINS . 'one-click-demo-import/one-click-demo-import.php';
		}

	// Subtitles & WP Subtitle

		if ( function_exists( 'get_the_subtitle' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'subtitles/subtitles.php';
		}

	// Widget CSS Classes

		if ( function_exists( 'widget_css_classes_loader' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'widget-css-classes/widget-css-classes.php';
		}

	// WooCommerce

		if ( class_exists( 'WooCommerce' ) ) {
			require REYKJAVIK_PATH_PLUGINS . 'woocommerce/woocommerce.php';
		}

	// Jetpack

		if ( class_exists( 'Jetpack' ) ) {
			// Loading after WooCommerce to apply inline styles handle filtering.
			require REYKJAVIK_PATH_PLUGINS . 'jetpack/jetpack.php';
		}
