<?php
/**
 * Widget: WordPress Recent Posts
 *
 * Altering native WordPress Recent Posts widget.
 *
 * @package    Reykjavík
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * Contents:
 *
 *  1) Requirements check
 * 10) Widget functionality
 */





/**
 * 1) Requirements check
 */

	if (
			! class_exists( 'WP_Widget' )
			|| ! class_exists( 'WP_Widget_Recent_Posts' )
		) {
		return;
	}





/**
 * 10) Widget functionality
 */

	/**
	 * Widget class
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 *
	 * Contents:
	 *
	 * 10) Output
	 */
	class Reykjavik_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {





		/**
		 * 10) Output
		 */

			/**
			 * Output HTML
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public function widget( $args, $instance ) {

				// Helper variables

					$output = '';

					$instance = wp_parse_args( $instance, array(
							'number'    => 5,
							'show_date' => false,
							'title'     => '',
						) );

					$heading_tag = 'h4';
					if ( strpos( $args['after_title'], 'h2' ) ) {
						$heading_tag = 'h3';
					}

					$posts_container_class = "widget-recent-entries-list";
					if ( $instance['show_date'] ) {
						$posts_container_class .= " entry-date-enabled";
					}

					if ( ! isset( $args['widget_id'] ) ) {
						$args['widget_id'] = $this->id;
					}


				// Processing

					/**
					 * Filter the arguments for the Recent Posts widget.
					 *
					 * @since 3.4.0
					 *
					 * @see WP_Query::get_posts()
					 *
					 * @param array $args An array of arguments used to retrieve the recent posts.
					 */
					$r = new WP_Query( apply_filters( 'widget_posts_args', array(
						'posts_per_page'      => absint( $instance['number'] ),
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true
					) ) );

					if ( $r->have_posts() ) {

						// Title

							if ( trim( $instance['title'] ) ) {
								$output .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base, $args ) . $args['after_title'];
							}

						$output .= '<div class="' . esc_attr( $posts_container_class ) . '">';

						while ( $r->have_posts() ) : $r->the_post();

							$output .= '<article class="' . esc_attr( implode( ' ', (array) get_post_class() ) ) . '">';

							// Post date

								if ( $instance['show_date'] ) {
									$output .= '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
									$output .= '<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '" class="published entry-date" title="' . esc_attr( get_the_date() ) . ' | ' . esc_attr( get_the_time( '' ) ) . '">';
									$output .= '<span class="day">' . esc_html( get_the_date( 'd' ) ) . '</span> ';
									$output .= '<span class="month">' . esc_html( get_the_date( 'M' ) ) . '</span> ';
									$output .= '</time>';
									$output .= '</a>';
								}

							$output .= '<div class="entry-content">';

								// Post title

									$output .= '<' . tag_escape( $heading_tag ) . ' class="entry-title">';
									$output .= '<a href="' . esc_url( get_permalink() ) . '">';

									if (
											function_exists( 'get_the_subtitle' )
											&& get_the_subtitle()
											&& ! in_the_loop() // Prevent duplicate Subtitle display in page content
										) {

										$output .= '<span class="entry-title-primary">' . get_the_title() . '</span>';
										$output .= ' <span class="entry-subtitle">' . get_the_subtitle() . '</span>';

									} else {

										$output .= get_the_title();

									}

									$output .= '</a>';
									$output .= '</' . tag_escape( $heading_tag ) . '>';

								// Post excerpt

									$output .= '<div class="entry-summary">' . get_the_excerpt() . '</div>';

								// Read more link

									$output .= apply_filters( 'wmhook_reykjavik_summary_continue_reading', '', 'widget-recent-posts' );

							$output .= '</div>';

							$output .= '</article>';

						endwhile;

						$output .= '</div>';

						// Reset the global $the_post as this query will have stomped on it
						wp_reset_postdata();

					}


				// Output

					if ( $output ) {
						echo $args['before_widget'] . $output . $args['after_widget'];
					}

			} // /widget





	} // /Reykjavik_WP_Widget_Recent_Posts



	/**
	 * Widget registration
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function reykjavik_register_widget_recent_posts() {

		// Processing

			unregister_widget( 'WP_Widget_Recent_Posts' );

			register_widget( 'Reykjavik_WP_Widget_Recent_Posts' );

	} // /reykjavik_register_widget_recent_posts

	add_action( 'widgets_init', 'reykjavik_register_widget_recent_posts' );
