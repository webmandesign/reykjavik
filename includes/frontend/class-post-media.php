<?php
/**
 * Post Media Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *  0) Init
 * 10) Size
 * 20) Display
 * 30) Media
 */
class Reykjavik_Post_Media {





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

					// Actions

						add_action( 'tha_entry_top', __CLASS__ . '::media' );

					// Filters

						add_filter( 'wmhook_reykjavik_post_media_pre', __CLASS__ . '::media_disable' );

						add_filter( 'wmhook_reykjavik_post_media_image_size', __CLASS__ . '::size' );

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
	 * 10) Size
	 */

		/**
		 * Post thumbnail (featured image) display size
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string  $image_size
		 */
		public static function size( $image_size ) {

			// Processing

				if ( is_single( get_the_ID() ) ) {
					$image_size = 'medium';
				} else {
					$image_size = 'thumbnail';
				}


			// Output

				return $image_size;

		} // /size





	/**
	 * 20) Display
	 */

		/**
		 * Entry media
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  array $args  Optional post helper variables.
		 */
		public static function media( $args = array() ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_post_media_pre', false, $args );

				if ( false !== $pre ) {
					echo $pre; // Functionality bypass via filter.
					return;
				}


			// Helper variables

				$output     = apply_filters( 'wmhook_reykjavik_post_media_output_pre', '', $args );
				$image_size = apply_filters( 'wmhook_reykjavik_post_media_image_size', 'thumbnail', $args );
				$class      = 'entry-media';


			// Processing

				if ( empty( $output ) ) {
					$output .= self::image_featured( $image_size );
				}


			// Output

				if ( $output ) {
					echo '<div class="' . esc_attr( $class ) . '">' . $output . '</div>';
				}

		} // /media



		/**
		 * Do not display entry media on top of single post content
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  mixed $pre
		 */
		public static function media_disable( $pre ) {

			// Processing

				if ( Reykjavik_Post::is_singular() && ! is_attachment() ) {
					$pre = '';
				}


			// Output

				return $pre;

		} // /media_disable





	/**
	 * 30) Media
	 */

		/**
		 * Featured image
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $image_size
		 */
		public static function image_featured( $image_size ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_post_media_image_featured_pre', false, $image_size );

				if ( false !== $pre ) {
					return $pre;
				}


			// Helper variables

				$output   = '';
				$post_id  = get_the_ID();
				$image_id = ( is_attachment() ) ? ( $post_id ) : ( get_post_thumbnail_id( $post_id ) );


			// Processing

				if (
						has_post_thumbnail( $post_id )
						|| ( is_attachment() && $attachment_image = wp_get_attachment_image( $image_id, (string) $image_size ) )
					) {

					$image_link = ( is_single( $post_id ) || is_attachment() ) ? ( wp_get_attachment_image_src( $image_id, 'full' ) ) : ( array( esc_url( get_permalink() ) ) );
					$image_link = array_filter( (array) apply_filters( 'wmhook_reykjavik_post_media_image_featured_link', $image_link ) );

					$output .= '<figure class="post-thumbnail">';

						if ( ! empty( $image_link ) ) {
							$output .= '<a href="' . esc_url( $image_link[0] ) . '">';
						}

						if ( is_attachment() ) {

							$output .= $attachment_image;

						} else {

							$output .= get_the_post_thumbnail(
									null,
									(string) $image_size
								);

						}

						if ( ! empty( $image_link ) ) {
							$output .= '</a>';
						}

					$output .= '</figure>';

				}


			// Output

				return $output;

		} // /image_featured





} // /Reykjavik_Post_Media

add_action( 'after_setup_theme', 'Reykjavik_Post_Media::init' );
