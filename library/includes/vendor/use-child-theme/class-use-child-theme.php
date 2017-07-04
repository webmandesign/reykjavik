<?php
/**
 * WebMan Design Use Child Theme
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Plugins
 *
 * @since    1.6.2
 * @version  2.2.6
 */





/**
 * WebMan Design Use Child Theme
 *
 * @link  https://github.com/webmandesign/use-child-theme
 * @link  https://github.com/FacetWP/use-child-theme
 *
 * This is a fork of Use Child Theme by FacetWP modified for use
 * in WebMan WordPress Theme Framework.
 *
 * This does not work in WordPress multisite installation due to theme
 * file editor not being available in single site dashboard.
 *
 * Modifications:
 * - Localization text domain
 * - `style.css` file default content
 * - `functions.php` file default content
 * - Reformatting the code
 * - Renaming the file
 *
 * Used development variables/prefixes:
 * - text_domain
 *
 * @version 1.2.1
 */



/**
 * Use Child Theme
 * A drop-in to make it easy to use WordPress child themes
 * @version 0.4
 */

defined( 'ABSPATH' ) or exit;

if ( ! class_exists( 'Use_Child_Theme' ) && is_admin() ) {

	class Use_Child_Theme {





		public $theme;
		public $child_slug;





		function __construct() {

			add_action( 'admin_init', array( $this, 'admin_init' ) );

		} // /__construct



		function admin_init() {

			// Exit if unauthorized
			if ( ! current_user_can( 'switch_themes' ) ) {
				return;
			}

			// Exit if dismissed
			if ( false !== get_transient( 'uct_dismiss_notice' ) ) {
				return;
			}

			$this->theme = wp_get_theme();

			// Exit if child theme
			if ( false !== $this->theme->parent() ) {
				return;
			}

			// Exit if no direct access
			if ( 'direct' != get_filesystem_method() ) {
				return;
			}

			add_action( 'wp_ajax_uct_activate', array( $this, 'activate_child_theme' ) );
			add_action( 'wp_ajax_uct_dismiss', array( $this, 'dismiss_notice' ) );
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );

		} // /admin_init



		function admin_notices() {

			// Show only on specific admin page(s) (default: Appearance > Editor)
			$admin_notices_screen_id = apply_filters( 'uct_admin_notices_screen_id', array( 'theme-editor' ) );
			$screen = get_current_screen();
			if ( ! isset( $screen->id ) || ! in_array( $screen->id, (array) $admin_notices_screen_id ) ) {
				return;
			}

			?>

			<script>
			(function($) {
				$(function() {
					$(document).on('click', '.uct-activate', function() {
						$.post(ajaxurl, { action: 'uct_activate' }, function(response) {
							$('.uct-notice p').html(response);
						});
					});

					$(document).on('click', '.uct-notice .notice-dismiss', function() {
						$.post(ajaxurl, { action: 'uct_dismiss' });
					});
				});
			})(jQuery);
			</script>

			<div class="notice notice-error uct-notice is-dismissible">
				<p>
					<?php printf( esc_html__( 'Please use a %s child theme to make changes!', 'reykjavik' ), $this->theme->get( 'Name' ) ); ?>
					<a class="uct-activate" href="javascript:;"><?php esc_html_e( 'Create and activate now &raquo;', 'reykjavik' ); ?></a>
				</p>
			</div>

			<?php

		} // /admin_notices



		function dismiss_notice() {

			set_transient( 'uct_dismiss_notice', 'yes', apply_filters( 'uct_dismiss_timeout', 86400 ) );
			exit;

		} // /dismiss_notice



		function has_child_theme() {

			$themes = wp_get_themes();
			$folder_name = $this->theme->get_stylesheet();
			$this->child_slug = $folder_name . '-child';

			foreach ( $themes as $theme ) {
				if ( $folder_name == $theme->get( 'Template' ) ) {
					$this->child_slug = $theme->get_stylesheet();
					return true;
				}
			}

			return false;

		} // /has_child_theme



		function activate_child_theme() {

			$parent_slug = $this->theme->get_stylesheet();

			// Create child theme
			if ( ! $this->has_child_theme() ) {
				$this->create_child_theme();
			}

			// Copy customizer settings, widgets, etc.
			$settings = get_option( 'theme_mods_' . $this->child_slug );

			if ( false === $settings ) {
				$parent_settings = get_option( 'theme_mods_' . $parent_slug );
				update_option( 'theme_mods_' . $this->child_slug, $parent_settings );
			}

			switch_theme( $this->child_slug );

			wp_die( esc_html__( 'All done! You are using a child theme now! Please refresh the page.', 'reykjavik' ) );

		} // /activate_child_theme



		function create_child_theme() {

			$parent_dir = $this->theme->get_stylesheet_directory();
			$child_dir = $parent_dir . '-child';

			if ( wp_mkdir_p( $child_dir ) ) {
				$creds = request_filesystem_credentials( admin_url() );
				WP_Filesystem( $creds ); // we already have direct access

				global $wp_filesystem;
				$wp_filesystem->put_contents( $child_dir . '/style.css', $this->style_css() );
				$wp_filesystem->put_contents( $child_dir . '/functions.php', $this->functions_php() );

				if ( false !== ( $img = $this->theme->get_screenshot( 'relative' ) ) ) {
					$wp_filesystem->copy( "$parent_dir/$img", "$child_dir/$img" );
				}
			} else {
				wp_die( esc_html__( 'Error: theme folder not writable!', 'reykjavik' ) );
			}

		} // /create_child_theme



		function style_css() {

			$output  = '/**' . "\r\n";
			$output .= ' * Theme Name: ' . $this->theme->get( 'Name' ) . ' Child' . "\r\n";
			$output .= ' * Template: ' . $this->theme->get_stylesheet() . "\r\n";
			$output .= ' * Version: 1.0.0' . "\r\n";
			$output .= ' * Description: This is a child theme of ' . $this->theme->get( 'Name' ) . "\r\n";
			$output .= ' */' . "\r\n";
			$output .= "\r\n";
			$output .= '/* Put your custom CSS styles below... */' . "\r\n";

			return apply_filters( 'uct_style_css', $output );

		} // /style_css



		function functions_php() {

			$output  = '<?php' . "\r\n";
			$output .= '/**' . "\r\n";
			$output .= ' * Child theme functions' . "\r\n";
			$output .= ' *' . "\r\n";
			$output .= ' * @package  ' . $this->theme->get( 'Name' ) . ' Child' . "\r\n";
			$output .= ' */' . "\r\n";
			$output .= "\r\n";
			$output .= '/**' . "\r\n";
			$output .= ' * Enqueue parent theme stylesheet the right way' . "\r\n";
			$output .= ' */' . "\r\n";
			$output .= 'function child_theme_enqueue_parent_styles() {' . "\r\n";
			$output .= "\t" . "if ( current_theme_supports( 'child-theme-stylesheet' ) ) { return; }" . "\r\n";
			$output .= "\t" . "wp_enqueue_style( 'parent-theme-styles', get_template_directory_uri() . '/style.css' );" . "\r\n";
			$output .= "\t" . "wp_enqueue_style( 'child-theme-styles', get_stylesheet_uri() );" . "\r\n";
			$output .= '}' . "\r\n";
			$output .= "\r\n";
			$output .= "add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_parent_styles', 1000 );\r\n";
			$output .= "\r\n";
			$output .= '/* Put your custom PHP code below... */' . "\r\n";

			return apply_filters( 'uct_functions_php', $output );

		} // /functions_php





	} // /Use_Child_Theme

	new Use_Child_Theme();

}
