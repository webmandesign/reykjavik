<?php
/**
 * Beaver Themer Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.5.2
 *
 * Contents:
 *
 *   0) Init
 *  10) Setup
 * 100) Others
 */
class Reykjavik_Beaver_Themer {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function init() {

			// Processing

				// Setup

					add_theme_support( 'fl-theme-builder-headers' );
					add_theme_support( 'fl-theme-builder-footers' );
					add_theme_support( 'fl-theme-builder-parts' );

				// Hooks

					// Actions

						add_action( 'init', __CLASS__ . '::late_load', 900 );

						add_action( 'wp', __CLASS__ . '::headers_footers', 999 );
						add_action( 'wp', __CLASS__ . '::site_content',    999 );

					// Filters

						add_filter( 'fl_theme_builder_part_hooks', __CLASS__ . '::parts' );

		} // /init





	/**
	 * 10) Setup
	 */

		/**
		 * Load plugin assets a bit later (see Beaver Builder compatibility)
		 *
		 * @since    1.1.1
		 * @version  1.1.1
		 */
		public static function late_load() {

			// Helper variables

				$priority  = 120;
				$callbacks = (array) apply_filters( 'wmhook_reykjavik_beaver_builder_assets_late_load_callbacks', array(
					'FLThemeBuilderLayoutFrontendEdit::enqueue_scripts' => 11,
				), 'themer' );

				// Has to be enqueued after `Reykjavik_Beaver_Builder_Assets::late_load()` UI assets.
				$order = 3;


			// Processing

				foreach ( $callbacks as $callback => $default_priority ) {
					if ( is_callable( $callback ) ) {
						remove_action( 'wp_enqueue_scripts', $callback, $default_priority );
						   add_action( 'wp_enqueue_scripts', $callback, $priority + $order++ );
					}
				}

		} // /late_load



		/**
		 * Custom header and footer renderer
		 *
		 * @since    1.0.0
		 * @version  1.5.2
		 */
		public static function headers_footers() {

			// Requirements check

				if ( is_admin() ) {
					return;
				}


			// Variables

				$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();
				$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();


			// Processing

				// Custom header

					if ( ! empty( $header_ids ) ) {
						remove_all_actions( 'tha_header_top' );
						remove_all_actions( 'tha_header_bottom' );

						add_action( 'tha_header_top', 'FLThemeBuilderLayoutRenderer::render_header', 20 );

						add_action( 'wp_enqueue_scripts', __CLASS__ . '::dequeue_header_scripts', 110 );

						add_filter( 'wmhook_reykjavik_skip_links_no_header', '__return_true' );
					}

				// Custom footer

					if ( ! empty( $footer_ids ) ) {
						remove_all_actions( 'tha_footer_top' );
						remove_all_actions( 'tha_footer_bottom' );

						add_action( 'tha_footer_top', 'FLThemeBuilderLayoutRenderer::render_footer', 20 );

						add_filter( 'wmhook_reykjavik_skip_links_no_footer', '__return_true' );
					}

		} // /headers_footers



		/**
		 * Setup site content.
		 *
		 * @since    1.3.1
		 * @version  1.3.1
		 */
		public static function site_content() {

			// Requirements check

				if ( is_admin() ) {
					return;
				}


			// Helper variables

				$layouts = array_keys( (array) FLThemeBuilderLayoutData::get_current_page_layouts() );


			// Processing

				if ( count( array_intersect( $layouts, array( 'singular', '404', 'archive' ) ) ) ) {

					// Removing intro
					remove_action( 'tha_content_top', 'Reykjavik_Intro::container', 15 );

					// Disabling sidebar
					add_filter( 'wmhook_reykjavik_sidebar_disable', '__return_true' );

					// Removing post navigation
					// remove_action( 'tha_content_bottom', 'Reykjavik_Post::navigation', 95 );

				}

		} // /site_content



		/**
		 * Dequeue theme header scripts
		 *
		 * @since    1.5.2
		 * @version  1.5.2
		 */
		public static function dequeue_header_scripts() {

			// Processing

				wp_dequeue_script( 'reykjavik-scripts-nav-a11y' );
				wp_dequeue_script( 'reykjavik-scripts-nav-mobile' );

		} // /dequeue_header_scripts



		/**
		 * Registers hooks for theme parts
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function parts() {

			// Output

				return array(

					array(
						'label' => esc_html_x( 'Page', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_body_top'    => esc_html_x( 'Page Open', 'Website hook name.', 'reykjavik' ),
							'tha_body_bottom' => esc_html_x( 'Page Close', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Header', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_header_before' => esc_html_x( 'Before Header', 'Website hook name.', 'reykjavik' ),
							'tha_header_top'    => esc_html_x( 'Header Top', 'Website hook name.', 'reykjavik' ),
							'tha_header_bottom' => esc_html_x( 'Header Bottom', 'Website hook name.', 'reykjavik' ),
							'tha_header_after'  => esc_html_x( 'After Header', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Intro', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'wmhook_reykjavik_intro_before' => esc_html_x( 'Before Intro', 'Website hook name.', 'reykjavik' ),
							'wmhook_reykjavik_intro'        => esc_html_x( 'Intro Content', 'Website hook name.', 'reykjavik' ),
							'wmhook_reykjavik_intro_after'  => esc_html_x( 'After Intro', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Content Area', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_content_before' => esc_html_x( 'Before Content Area', 'Website hook name.', 'reykjavik' ),
							'tha_content_top'    => esc_html_x( 'Content Area Top', 'Website hook name.', 'reykjavik' ),
							'tha_content_bottom' => esc_html_x( 'Content Area Bottom', 'Website hook name.', 'reykjavik' ),
							'tha_content_after'  => esc_html_x( 'After Content Area', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Post Entry', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_entry_before'         => esc_html_x( 'Before Post', 'Website hook name.', 'reykjavik' ),
							'tha_entry_top'            => esc_html_x( 'Post Top', 'Website hook name.', 'reykjavik' ),
							'tha_entry_content_before' => esc_html_x( 'Before Post Content', 'Website hook name.', 'reykjavik' ),
							'tha_entry_content_after'  => esc_html_x( 'After Post Content', 'Website hook name.', 'reykjavik' ),
							'tha_entry_bottom'         => esc_html_x( 'Post Bottom', 'Website hook name.', 'reykjavik' ),
							'tha_entry_after'          => esc_html_x( 'After Post', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Comments', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_comments_before' => esc_html_x( 'Before Comments', 'Website hook name.', 'reykjavik' ),
							'tha_comments_after'  => esc_html_x( 'After Comments', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Posts List', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'wmhook_reykjavik_postslist_before' => esc_html_x( 'Before Posts List', 'Website hook name.', 'reykjavik' ),
							'wmhook_reykjavik_postslist_after'  => esc_html_x( 'After Posts List', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Child Pages List', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'wmhook_reykjavik_loop_child_pages_before' => esc_html_x( 'Before Child Pages List', 'Website hook name.', 'reykjavik' ),
							'wmhook_reykjavik_loop_child_pages_after'  => esc_html_x( 'After Child Pages List', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Sidebar', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_sidebars_before' => esc_html_x( 'Before Sidebar', 'Website hook name.', 'reykjavik' ),
							'tha_sidebar_top'     => esc_html_x( 'Sidebar Top', 'Website hook name.', 'reykjavik' ),
							'tha_sidebar_bottom'  => esc_html_x( 'Sidebar Bottom', 'Website hook name.', 'reykjavik' ),
							'tha_sidebars_after'  => esc_html_x( 'After Sidebar', 'Website hook name.', 'reykjavik' ),
						),
					),

					array(
						'label' => esc_html_x( 'Footer', 'Website hooks category name.', 'reykjavik' ),
						'hooks' => array(
							'tha_footer_before' => esc_html_x( 'Before Footer', 'Website hook name.', 'reykjavik' ),
							'tha_footer_top'    => esc_html_x( 'Footer Top', 'Website hook name.', 'reykjavik' ),
							'tha_footer_bottom' => esc_html_x( 'Footer Bottom', 'Website hook name.', 'reykjavik' ),
							'tha_footer_after'  => esc_html_x( 'After Footer', 'Website hook name.', 'reykjavik' ),

							'wmhook_reykjavik_site_info_before' => esc_html_x( 'Before Site Info', 'Website hook name.', 'reykjavik' ),
							'wmhook_reykjavik_site_info_after'  => esc_html_x( 'After Site Info', 'Website hook name.', 'reykjavik' ),
						),
					),

				);

		} // /parts





} // /Reykjavik_Beaver_Themer

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Themer::init' );
