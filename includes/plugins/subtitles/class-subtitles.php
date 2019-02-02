<?php
/**
 * Subtitles Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.4.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Subtitle
 *  20) Getters
 * 100) Others
 */
class Reykjavik_Subtitles {





	/**
	 * 0) Init
	 */

		/**
		 * Initialization.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 */
		public static function init() {

			// Variables

				$post_types        = array_filter( (array) apply_filters( 'wmhook_reykjavik_subtitles_post_types', array( 'post', 'page' ) ) );
				$post_type_support = ( class_exists( 'WPSubtitle' ) ) ? ( 'wps_subtitle' ) : ( 'subtitles' );


			// Requirements check

				if ( empty( $post_types ) ) {
					return;
				}


			// Processing

				// Setup

					foreach ( $post_types as $post_type ) {
						add_post_type_support( $post_type, $post_type_support );
					}

				// Hooks

					// Actions: removing

						if ( method_exists( 'Subtitles', 'subtitle_styling' ) ) {
							remove_action( 'wp_head', array( Subtitles::getInstance(), 'subtitle_styling' ) );
						}

					// Actions

						// Add before intro section.
						add_action( 'tha_content_top', __CLASS__ . '::force_subtitle_add', 0 );
						// Remove before post navigation.
						add_action( 'tha_content_bottom', __CLASS__ . '::force_subtitle_remove', 0 );
						// Make sure the subtitle displays in Recent Posts widget.
						add_action( 'wmhook_reykjavik_widget_recent_posts_before', __CLASS__ . '::force_subtitle_add', 0 );
						add_action( 'wmhook_reykjavik_widget_recent_posts_after', __CLASS__ . '::force_subtitle_remove', 0 );

					// Filters

						add_filter( 'the_title', __CLASS__ . '::subtitle', 10, 2 );
						add_filter( 'single_post_title', __CLASS__ . '::subtitle', 100, 2 );
						add_filter( 'wmhook_reykjavik_intro_title', __CLASS__ . '::subtitle', 10, 2 );

						// Make sure the navigation does not display subtitle, not even sidebar navigational menu widget.
						add_filter( 'nav_menu_item_title', __CLASS__ . '::remove_subtitle' );

		} // /init





	/**
	 * 10) Subtitle
	 */

		/**
		 * Subtitles support in post title.
		 *
		 * @since    1.0.0
		 * @version  1.4.0
		 *
		 * @param  string  $title
		 * @param  WP_Post $post
		 */
		public static function subtitle( $title, $post ) {

			// Processing

				if (
					empty( strpos( $title, 'entry-subtitle' ) )
					&& (bool) apply_filters( 'wmhook_reykjavik_subtitle_enabled', in_the_loop() )
				) {

					$subtitle = self::get_the_subtitle( $post );

					if ( ! empty( $subtitle ) ) {
						$title = '<span class="entry-title-primary">' . $title . '</span>' . $subtitle;
					}

				}


			// Output

				return $title;

		} // /subtitle



		/**
		 * Remove subtitle.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  string $title
		 */
		public static function remove_subtitle( $title = '' ) {

			// Processing

				if ( strpos( $title, '<span class="entry-subtitle">' ) ) {
					$title = explode( '<span class="entry-subtitle">', $title );
					$title = str_replace(
						array(
							'<span class="entry-title-primary">',
							'</span>',
						),
						'',
						$title[0]
					);
				}


			// Output

				return $title;

		} // /remove_subtitle





	/**
	 * 20) Getters
	 */

		/**
		 * Get the subtitle.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  WP_Post $post
		 */
		public static function get_the_subtitle( $post ) {

			// Processing

				if ( class_exists( 'WPSubtitle' ) ) {
					/**
					 * @link  https://github.com/benhuson/wp-subtitle#parameters
					 */
					$subtitle = get_the_subtitle( $post, '', '', false );
				} else {
					$subtitle = get_the_subtitle( $post );
				}

				if ( ! empty( $subtitle ) ) {
					$subtitle = '<span class="entry-subtitle">' . $subtitle . '</span>';
				}


			// Output

				return $subtitle;

		} // /get_the_subtitle





	/**
	 * 100) Others
	 */

		/**
		 * Force enable subtitle display: add filter.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 */
		public static function force_subtitle_add() {

			// Processing

				add_filter( 'wmhook_reykjavik_subtitle_enabled', '__return_true' );

		} // /force_subtitle_add



		/**
		 * Force enable subtitle display: remove filter.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 */
		public static function force_subtitle_remove() {

			// Processing

				remove_filter( 'wmhook_reykjavik_subtitle_enabled', '__return_true' );

		} // /force_subtitle_remove





} // /Reykjavik_Subtitles

add_action( 'after_setup_theme', 'Reykjavik_Subtitles::init', 20 );
