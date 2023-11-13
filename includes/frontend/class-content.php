<?php
/**
 * Content Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.3.2
 *
 * Contents:
 *
 *   0) Init
 *  10) Main
 * 100) Helpers
 */
class Reykjavik_Content {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  2.2.0
		 */
		private function __construct() {

			// Processing

				self::register_block_styles();

				// Hooks

					// Actions

						add_action( 'enqueue_block_editor_assets', __CLASS__ . '::enqueue_editor_mods' );

						add_action( 'tha_content_top', __CLASS__ . '::open_container', 10 );

						add_action( 'tha_content_top', __CLASS__ . '::open_container_inner', 20 );

						add_action( 'tha_content_top', __CLASS__ . '::open_primary', 30 );

						add_action( 'tha_content_top', __CLASS__ . '::open_main', 40 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_main', 70 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_primary', 80 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_container_inner', 90 );

						add_action( 'tha_content_bottom', __CLASS__ . '::close_container', 100 );

					// Filters

						// WP6.0+ fix:
						remove_filter( 'render_block', 'wp_render_layout_support_flag' );

						add_filter( 'register_post_type_args', __CLASS__ . '::register_reusable_blocks_args', 10, 2 );

						add_filter( 'render_block', __CLASS__ . '::render_block', 5, 2 );

		} // /__construct



		/**
		 * Initialization (get instance)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function init() {

			// Processing

				if ( null === self::$instance ) {
					self::$instance = new self;
				}


			// Output

				return self::$instance;

		} // /init





	/**
	 * 10) Main
	 */

		/**
		 * Content container: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open_container() {

			// Output

				echo "\r\n\r\n" . '<div id="content" class="site-content">';

		} // /open_container



		/**
		 * Content container inner: Open
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function open_container_inner() {

			// Output

				echo "\r\n" . '<div class="site-content-inner">';

		} // /open_container_inner



			/**
			 * Content primary: Open
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function open_primary() {

				// Output

					echo "\r\n\t" . '<div id="primary" class="content-area">';

			} // /open_primary



				/**
				 * Content main: Open
				 *
				 * @since    1.0.0
				 * @version  1.0.0
				 */
				public static function open_main() {

					// Output

						echo "\r\n\t\t" . '<main id="main" class="site-main">' . "\r\n\r\n";

				} // /open_main



				/**
				 * Content main: Close
				 *
				 * @since    1.0.0
				 * @version  1.0.0
				 */
				public static function close_main() {

					// Output

						echo "\r\n\r\n\t\t" . '</main><!-- /#main -->';

				} // /close_main



			/**
			 * Content primary: Close
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function close_primary() {

				// Output

					echo "\r\n\t" . '</div><!-- /#primary -->';

			} // /close_primary



		/**
		 * Content container inner: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close_container_inner() {

			// Output

				echo "\r\n" . '</div><!-- /.site-content-inner -->';

		} // /close_container_inner



		/**
		 * Content container: Close
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function close_container() {

			// Output

				echo "\r\n" . '</div><!-- /#content -->' . "\r\n\r\n";

		} // /close_container





	/**
	 * 100) Helpers
	 */

		/**
		 * Level up heading tags
		 *
		 * Levels up the HTML headings in single post/page view.
		 * Transforms H3 to H2 and H4 to H3.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $html
		 */
		public static function headings_level_up( $html ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_content_headings_level_up_pre', false, $html );

				if ( false !== $pre ) {
					return $pre;
				}


			// Requirements check

				if ( ! Reykjavik_Post::is_singular() ) {
					return $html;
				}


			// Processing

				switch ( $html ) {

					case 'h3':
							$html = tag_escape( 'h2' );
						break;

					case 'h4':
							$html = tag_escape( 'h3' );
						break;

					default:
							$html = str_replace(
									array(
										'<h3', '</h3', // 1) H3...
										'<h4', '</h4', // 2) H4...
									),
									array(
										'<h2', '</h2', // 1) ...to H2
										'<h3', '</h3', // 2) ...to H3
									),
									$html
								);
						break;

				} // /switch


			// Output

				return $html;

		} // /headings_level_up



		/**
		 * Block editor output modifications.
		 *
		 * @since    2.0.0
		 * @version  2.3.1
		 *
     * @param  string $block_content  The pre-rendered content. Default null.
     * @param  array  $block          The block being rendered.
		 *
		 * @return  void
		 */
		public static function render_block( $block_content, $block ) {

			// Variables

				$attrs = $block['attrs'];

				// Forced default block attribute values.
				$defaults = apply_filters( 'wmhook_reykjavik_content_render_block_defaults', array(
					// Blocks with `wide` default alignment.
					'align:wide' => array(
						'core/media-text',
						'coblocks/media-card',
					),
				), $block_content, $block );

				if (
					in_array( $block['blockName'], $defaults['align:wide'] )
					&& ! isset( $attrs['align'] )
				) {
					$attrs['align'] = 'wide';
				}

				// Make sure the alignment attribute is set.
				if ( ! isset( $attrs['align'] ) ) {
					$attrs['align'] = null;
				}

				/**
				 * Compatibility with 3rd party block plugins.
				 * @link  https://wordpress.org/support/topic/align-attribute-name
				 */
				if ( null === $attrs['align'] && isset( $attrs['blockAlignment'] ) ) {
					$attrs['align'] = $attrs['blockAlignment'];
				}

				// Make sure the className attribute is set.
				if ( ! isset( $attrs['className'] ) ) {
					$attrs['className'] = '';
				}


			// Processing

				// WP6.0+ fix:
				// This must be first.
				if ( ! in_array( $block['blockName'], array(
					// See also `assets/js/editor-blocks.js`.
					'core/column',
					'core/columns',
				) ) ) {
					$block_content = wp_render_layout_support_flag( $block_content, $block );
				}

				// Wide align wrapper.
				if (
					'wide' == $attrs['align']
					|| false !== stripos( $attrs['className'], 'alignwide' )
				) {
					$atts = array(
						'class="alignwide-wrap"',
						'data-block="' . sanitize_title( str_replace( 'core/', '', $block['blockName'] ) ) . '"',
					);
					$block_content = '<div ' . implode( ' ', $atts ) . '>' . $block_content . '</div>';
				}

				// Image block left/right alignment.
				if (
					'core/image' === $block['blockName']
					&& in_array( $attrs['align'], array( 'left', 'right' ) )
				) {
					$block_content = str_replace(
						'wp-block-image',
						'wp-block-image align-horizontal-wrap',
						$block_content
					);
				}

				// Post Excerpt block.
				if ( 'core/post-excerpt' == $block['blockName'] ) {
					// Remove excerpt opening paragraph tag.
					$block_content = str_replace( '<p class="wp-block-post-excerpt__excerpt">', '', $block_content );
					// Remove excerpt closing paragraph tag (is `</p></div>`).
					$block_content = substr( $block_content, 0, -10 ) . '</div>';
					// Adding excerpt class back in.
					$block_content = str_replace( '"entry-summary', '"entry-summary wp-block-post-excerpt__excerpt', $block_content );
				}

				// Cover block.
				if (
					'core/cover' === $block['blockName']
					&& ! empty( $attrs['gradient'] )
				) {
					/**
					 * Modifying gradient CSS class applied onto the block container.
					 *
					 * This should not happen by default, but as we enable text color setup
					 * for Cover block, we get this weird erroneous behavior we need to fix.
					 * We invalidate the gradient CSS class applied on container only by
					 * appending `-overlay` to it.
					 */
					$re = '/wp-block-cover ([a-z0-9\-_\s]*?)-gradient-background/i';
					$block_content = preg_replace( $re, '$0-overlay', $block_content, 1 );
				}


			// Output

				return $block_content;

		} // /render_block



		/**
		 * Enqueues block editor assets for block modifications.
		 *
		 * @since    2.2.0
		 * @version  2.3.2
		 *
		 * @return  void
		 */
		public static function enqueue_editor_mods() {

			// Processing

				wp_enqueue_script(
					'reykjavik-editor-blocks',
					get_theme_file_uri( 'assets/js/editor-blocks.min.js' ),
					array( 'wp-blocks', 'wp-hooks', 'lodash' ),
					'v' . REYKJAVIK_THEME_VERSION
				);

		} // /enqueue_editor_mods



		/**
		 * Enable "Reusable blocks" in admin menu.
		 *
		 * @since  2.2.0
		 *
		 * @param  array  $args       Array of arguments for registering a post type.
		 * @param  string $post_type  Post type key.
		 *
		 * @return  array
		 */
		public static function register_reusable_blocks_args( $args, $post_type ) {

			// Processing

				if ( 'wp_block' === $post_type ) {
					// Show under "Tools" menu item.
					$args['show_in_menu'] = 'tools.php';
				}


			// Output

				return $args;

		} // /register_reusable_blocks_args



		/**
		 * Registering block styles.
		 *
		 * @since  2.1.0
		 */
		public static function register_block_styles() {

			// Requirements check

				if ( ! function_exists( 'register_block_style' ) ) {
					return;
				}


			// Output

				// Accessibly hidden heading.

					register_block_style( 'core/heading', array(
						'name'  => 'screen-reader-text',
						'label' => esc_html_x( 'Accessibly hidden', 'Block style label.', 'reykjavik' ),
					) );

				// Single column alignment.

					register_block_style( 'core/column', array(
						'name'  => 'alignleft',
						'label' => esc_html_x( 'Single column: align left', 'Block style label.', 'reykjavik' ),
					) );

					register_block_style( 'core/column', array(
						'name'  => 'alignright',
						'label' => esc_html_x( 'Single column: align right', 'Block style label.', 'reykjavik' ),
					) );

				// No vertical gap.

					$blocks = array(
						'core/column',
						'core/columns',
						'core/cover',
						'core/gallery',
						'core/group',
						'core/heading',
						'core/image',
						'core/media-text',
						'core/paragraph',
						'core/post-content',
						'core/post-date',
						'core/post-excerpt',
						'core/post-featured-image',
						'core/post-terms',
						'core/post-title',
						'core/query',
					);

					foreach (	$blocks as $block ) {
						register_block_style( $block, array(
							'name'  => 'no-margin-vertical',
							'label' => esc_html_x( 'No vertical gap', 'Block style label.', 'reykjavik' ),
						) );
					}

		} // /register_block_styles





} // /Reykjavik_Content

add_action( 'after_setup_theme', 'Reykjavik_Content::init' );
