<?php
/**
 * WebMan WordPress Theme Framework
 *
 * Theme options with `__` prefix (`get_theme_mod( '__option_id' )`) are theme
 * setup related options and can not be edited via customizer.
 * This way we prevent creating additional options in the database.
 *
 * @link  https://github.com/webmandesign/webman-theme-framework
 * @link  https://www.webmandesign.eu
 *
 * @package    WebMan WordPress Theme Framework
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, http://www.gnu.org/licenses/gpl-3.0.html
 * @version    2.7.0
 * @version    1.4.0
 *
 * Used development prefixes:
 *
 * @uses theme_slug
 * @uses text_domain
 * @uses prefix_var
 * @uses prefix_hook
 * @uses theme_name
 * @uses prefix_class
 * @uses prefix_constant
 *
 * Contents:
 *
 * 10) Constants
 * 20) Load
 */





/**
 * 10) Constants
 */

	// Theme version

		if ( ! defined( 'REYKJAVIK_THEME_VERSION' ) ) {
			define( 'REYKJAVIK_THEME_VERSION', wp_get_theme( 'reykjavik' )->get( 'Version' ) );
		}

	// Paths

		if ( ! defined( 'REYKJAVIK_PATH' ) ) {
			define( 'REYKJAVIK_PATH', trailingslashit( get_template_directory() ) );
		}

		if ( ! defined( 'REYKJAVIK_LIBRARY_DIR' ) ) {
			define( 'REYKJAVIK_LIBRARY_DIR', trailingslashit( basename( dirname( __FILE__ ) ) ) );
		}

		define( 'REYKJAVIK_LIBRARY', trailingslashit( REYKJAVIK_PATH . REYKJAVIK_LIBRARY_DIR ) );





/**
 * 20) Load
 */

	// Core class.
	require REYKJAVIK_LIBRARY . 'includes/classes/class-core.php';

	// Customize (has to be frontend accessible, otherwise it hides the theme settings).

		// Sanitize class.
		require REYKJAVIK_LIBRARY . 'includes/classes/class-sanitize.php';

		// Customize class.
		require REYKJAVIK_LIBRARY . 'includes/classes/class-customize.php';

		// CSS variables generator class.
		require REYKJAVIK_LIBRARY . 'includes/classes/class-css-variables.php';

	// Admin area related functionality.
	if ( is_admin() ) {

		// Optional theme welcome page.
		$welcome_page = get_theme_file_path( 'includes/welcome/welcome.php' );
		if ( file_exists( $welcome_page ) ) {
			require REYKJAVIK_LIBRARY . 'includes/classes/class-admin.php';
			require $welcome_page;
		}

		// Optional plugins suggestions.
		$plugins_suggestions = get_theme_file_path( 'includes/tgmpa/plugins.php' );
		if ( (bool) apply_filters( 'wmhook_reykjavik_plugins_suggestion_enabled', file_exists( $plugins_suggestions ) ) ) {
			require REYKJAVIK_LIBRARY . 'includes/vendor/tgmpa/class-tgm-plugin-activation.php';
			require $plugins_suggestions;
		}

	}
