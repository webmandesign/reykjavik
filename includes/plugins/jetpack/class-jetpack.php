<?php
/**
 * Jetpack Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Sharing
 * 20) Infinite scroll
 * 30) Content options
 * 40) Custom Post Types
 */
class Reykjavik_Jetpack {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		private function __construct() {

			// Requirements check

				if ( ! Jetpack::is_active() && ! Jetpack::is_development_mode() ) {
					return;
				}


			// Processing

				// Setup

					// Add theme support for Responsive Videos

						add_theme_support( 'jetpack-responsive-videos' );

					// Add theme support for Infinite Scroll

						add_theme_support( 'infinite-scroll', apply_filters( 'wmhook_reykjavik_jetpack_setup_infinite_scroll', array(
							'container'      => 'posts',
							'footer'         => false,
							'posts_per_page' => 6,
							'render'         => 'Reykjavik_Jetpack::infinite_scroll_render',
							'type'           => 'scroll',
							'wrapper'        => false,
						) ) );

					// Add theme support for Content Options

						/**
						 * @link  https://jetpack.com/support/content-options/
						 */
						add_theme_support( 'jetpack-content-options', array(
							'author-bio'   => true,
							'post-details' => array(
								'stylesheet' => 'reykjavik',
								'date'       => '.posted-on',
								// 'categories' => '.cat-links',
								// 'tags'       => '.tags-links',
								'author'     => '.byline',
								'comment'    => '.comments-link',
							),
						) );

					// Add theme support for custom post types

						add_theme_support( 'jetpack-portfolio' );
						add_theme_support( 'jetpack-testimonial' );

						add_post_type_support( 'jetpack-portfolio', 'excerpt' );

				// Hooks

					// Actions

						add_action( 'wp_enqueue_scripts', 'jetpack_post_details_enqueue_scripts', 120 ); // Load this after `reykjavik-stylesheet` is enqueued.

						add_action( 'tha_entry_bottom', __CLASS__ . '::author_bio' );

					// Filters

						add_filter( 'jetpack_sharing_display_markup',           'Reykjavik_Content::headings_level_up', 999 );
						add_filter( 'jetpack_relatedposts_filter_headline',     'Reykjavik_Content::headings_level_up', 999 );
						add_filter( 'jetpack_relatedposts_filter_post_heading', 'Reykjavik_Content::headings_level_up', 999 );

						add_filter( 'sharing_show', __CLASS__ . '::sharing_show', 10, 2 );

						add_filter( 'infinite_scroll_js_settings', __CLASS__ . '::infinite_scroll_js_settings' );

						add_filter( 'jetpack_author_bio_avatar_size', __CLASS__ . '::author_bio_avatar_size' );

						if ( is_callable( 'Reykjavik_Post_Media::size' ) ) {
							add_filter( 'jetpack_portfolio_thumbnail_size',   'Reykjavik_Post_Media::size' );
							add_filter( 'jetpack_testimonial_thumbnail_size', 'Reykjavik_Post_Media::size' );
						}

						add_filter( 'wmhook_reykjavik_post_navigation_post_type', __CLASS__ . '::add_post_types' );

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
	 * 10) Sharing
	 */

		/**
		 * Show sharing?
		 *
		 * @since    1.0.0
		 * @version  1.0.5
		 *
		 * @param  boolean $show
		 * @param  object  $post
		 */
		public static function sharing_show( $show = false, $post = null ) {

			// Processing

				if (
					in_array( 'the_excerpt', (array) $GLOBALS['wp_current_filter'] )
					|| ! Reykjavik_Post::is_singular()
					|| post_password_required()
				) {
					$show = false;
				}


			// Output

				return $show;

		} // /sharing_show





	/**
	 * 20) Infinite scroll
	 */

		/**
		 * Infinite scroll JS settings array modifier
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $settings
		 */
		public static function infinite_scroll_js_settings( $settings ) {

			// Helper variables

				$settings['text'] = esc_js( esc_html__( 'Load more&hellip;', 'reykjavik' ) );


			// Output

				return $settings;

		} // /infinite_scroll_js_settings



		/**
		 * Infinite scroll posts renderer
		 *
		 * @see  __construct()
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function infinite_scroll_render() {

			// Output

				while ( have_posts() ) :

					the_post();

					/**
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 *
					 * Or, you can use the filter hook below to modify which content file to load.
					 */
					get_template_part( 'templates/parts/content/content', apply_filters( 'wmhook_reykjavik_loop_content_type', get_post_format() ) );

				endwhile;

		} // /infinite_scroll_render





	/**
	 * 30) Content options
	 */

		/**
		 * Display author bio
		 *
		 * @since    1.0.0
		 * @version  1.2.0
		 */
		public static function author_bio() {

			// Requirements check

				if (
					! function_exists( 'jetpack_author_bio' )
					|| ! Reykjavik_Post::is_singular()
					|| post_password_required()
					|| ! in_array( get_post_type(), (array) apply_filters( 'wmhook_reykjavik_jetpack_author_bio_post_type', array( 'post' ) ) )
				) {
					return;
				}


			// Output

				echo self::get_author_bio();

		} // /author_bio



		/**
		 * Get author bio HTML
		 *
		 * @since    1.2.0
		 * @version  1.3.0
		 *
		 * @param  boolean $remove_default_paragraph
		 */
		public static function get_author_bio( $remove_default_paragraph = true ) {

			// Requirements check

				if ( ! function_exists( 'jetpack_author_bio' ) ) {
					return;
				}


			// Processing

				ob_start();
				jetpack_author_bio();
				$output = ob_get_clean();

				if ( $remove_default_paragraph ) {
					$output = str_replace(
						array(
							'<p class="author-bio">',
							'</p><!-- .author-bio -->',
						),
						array(
							'<div class="author-bio">',
							'</div><!-- .author-bio -->',
						),
						$output
					);
				}


			// Output

				return $output;

		} // /get_author_bio



		/**
		 * Author bio avatar size
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function author_bio_avatar_size() {

			// Output

				return 240;

		} // /author_bio_avatar_size





	/**
	 * 40) Custom Post Types
	 */

		/**
		 * Add support for Jetpack CPTs
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $post_types
		 */
		public static function add_post_types( $post_types ) {

			// Processing

				$post_types[] = 'jetpack-portfolio';
				$post_types[] = 'jetpack-testimonial';


			// Output

				return $post_types;

		} // /add_post_types





} // /Reykjavik_Jetpack

add_action( 'after_setup_theme', 'Reykjavik_Jetpack::init' );
