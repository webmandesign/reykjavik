<?php
/**
 * Post Summary Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Excerpt
 * 20) Continue reading
 */
class Reykjavik_Post_Summary {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						add_filter( 'the_excerpt', 'Reykjavik_Library::remove_shortcodes' );

						add_filter( 'the_excerpt', __CLASS__ . '::excerpt', 20 );

						add_filter( 'excerpt_length', __CLASS__ . '::excerpt_length' );

						add_filter( 'excerpt_more', __CLASS__ . '::excerpt_more' );

						add_filter( 'wmhook_reykjavik_summary_continue_reading', __CLASS__ . '::continue_reading' );


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
	 * 10) Excerpt
	 */

		/**
		 * Excerpt
		 *
		 * Displays the excerpt properly.
		 * If the post is password protected, display a message.
		 * If the post has more tag, display the content appropriately.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $excerpt
		 */
		public static function excerpt( $excerpt ) {

			// Helper variables

				$post_id = get_the_ID();


			// Requirements check

				if ( post_password_required( $post_id ) ) {

					if ( ! is_single( $post_id ) ) {

						return esc_html__( 'This content is password protected.', 'reykjavik' ) . ' <a href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Enter the password to view it.', 'reykjavik' ) . '</a>';

					}

					return;

				}


			// Processing

				if (
						! is_single( $post_id )
						&& Reykjavik_Library::has_more_tag()
					) {

					/**
					 * Post has more tag
					 */

						if ( has_excerpt( $post_id ) ) {
							$excerpt = '<div class="entry-summary has-more-tag">' . get_the_excerpt() . '</div>';
						} else {
							$excerpt = '';
						}

						$excerpt = apply_filters( 'the_content', $excerpt . get_the_content( '' ) );

				} else {

					/**
					 * Default excerpt for posts without more tag
					 */

						$excerpt = '<div class="entry-summary">' . $excerpt . '</div>';

				}

				// Adding "Continue reading" link

					if (
							! is_single( $post_id )
							&& in_array( get_post_type( $post_id ), (array) apply_filters( 'wmhook_reykjavik_summary_continue_reading_post_type', array( 'post', 'page' ) ) )
						) {
						$excerpt .= apply_filters( 'wmhook_reykjavik_summary_continue_reading', '' );
					}


			// Output

				return $excerpt;

		} // /excerpt



		/**
		 * Excerpt length
		 *
		 * The number of words. Default 55.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  absint $length
		 */
		public static function excerpt_length( $length ) {

			// Output

				return 40;

		} // /excerpt_length



		/**
		 * Excerpt more
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $more
		 */
		public static function excerpt_more( $more ) {

			// Output

				return '&hellip;';

		} // /excerpt_more





	/**
	 * 20) Continue reading
	 */

		/**
		 * Excerpt "Continue reading" text
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $continue
		 */
		public static function continue_reading( $continue ) {

			// Processing

				ob_start();
				get_template_part( 'templates/parts/component/link-more', get_post_type() );


			// Output

				return ob_get_clean();

		} // /continue_reading





} // /Reykjavik_Post_Summary

add_action( 'after_setup_theme', 'Reykjavik_Post_Summary::init' );
