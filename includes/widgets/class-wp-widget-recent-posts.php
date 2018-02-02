<?php
/**
 * Widget: WordPress Recent Posts
 *
 * Altering native WordPress Recent Posts widget.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.5
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
	 * @version  1.0.5
	 *
	 * Contents:
	 *
	 * 10) Output
	 * 20) Options
	 */
	class Reykjavik_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {





		/**
		 * 10) Output
		 */

			/**
			 * Output HTML
			 *
			 * @since    1.0.0
			 * @version  1.0.5
			 */
			public function widget( $args, $instance ) {

				// Helper variables

					$output = '';

					$instance = wp_parse_args( $instance, array(
						'number'    => 5,
						'show_date' => false,
						'title'     => '',
						'category'  => '',
					) );

					if ( empty( $instance['title'] ) ) {
						$instance['title'] = esc_html__( 'Recent Posts', 'reykjavik' );
					}

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

					// Categories functionality

						$cat = array();

						if ( isset( $instance['category'] ) && $instance['category'] ) {
							if ( is_numeric( $instance['category'] ) ) {
								$cat = array( 'cat' => absint( $instance['category'] ) );
							} else {
								$cat = array( 'category_name' => sanitize_title( $instance['category'] ) );
							}
						}

					// Fix wrong "Continue reading" link

						$continue_reading_url_to_replace = esc_url( get_permalink( get_the_ID() ) );


				// Processing

					/**
					 * Filter the arguments for the Recent Posts widget.
					 *
					 * @since 3.4.0
					 * @since 4.9.0 Added the `$instance` parameter.
					 *
					 * @see WP_Query::get_posts()
					 *
					 * @param array $args     An array of arguments used to retrieve the recent posts.
					 * @param array $instance Array of settings for the current widget.
					 */
					$r = new WP_Query( apply_filters( 'widget_posts_args', array_merge( array(
						'posts_per_page'      => absint( $instance['number'] ),
						'no_found_rows'       => true,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
					), (array) $cat ), $instance ) );

					if ( ! $r->have_posts() ) {
						return;
					}

					// Title

						if ( trim( $instance['title'] ) ) {
							$output .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base, $args ) . $args['after_title'];
						}

					$output .= '<div class="' . esc_attr( $posts_container_class ) . '">';

					foreach ( $r->posts as $recent_post ) :

						$recent_post_id = $recent_post->ID;

						$output .= '<article class="' . esc_attr( implode( ' ', (array) get_post_class( '', $recent_post_id ) ) ) . '">';

						// Post date

							if ( $instance['show_date'] ) {
								$output .= '<a href="' . esc_url( get_permalink( $recent_post_id ) ) . '" rel="bookmark">';
								$output .= '<time datetime="' . esc_attr( get_the_date( 'c', $recent_post_id ) ) . '" class="published entry-date" title="' . esc_attr( get_the_date( '', $recent_post_id ) ) . ' | ' . esc_attr( get_the_time( '', $recent_post_id ) ) . '">';
								$output .= '<span class="day">' . esc_html( get_the_date( 'd', $recent_post_id ) ) . '</span> ';
								$output .= '<span class="month">' . esc_html( get_the_date( 'M', $recent_post_id ) ) . '</span> ';
								$output .= '</time>';
								$output .= '</a>';
							}

						$output .= '<div class="entry-content">';

							// Post title

								$output .= '<' . tag_escape( $heading_tag ) . ' class="entry-title">';
								$output .= '<a href="' . esc_url( get_permalink( $recent_post_id ) ) . '">';

								if (
									function_exists( 'get_the_subtitle' )
									&& ! in_the_loop() // Prevent duplicate Subtitle display in page content
									&& $subtitle = get_the_subtitle( $recent_post_id )
								) {

									$output .= '<span class="entry-title-primary">' . get_the_title( $recent_post_id ) . '</span>';
									$output .= ' <span class="entry-subtitle">' . $subtitle . '</span>';

								} else {

									$output .= get_the_title( $recent_post_id );

								}

								$output .= '</a>';
								$output .= '</' . tag_escape( $heading_tag ) . '>';

							// Post excerpt

								$output .= '<div class="entry-summary">' . get_the_excerpt( $recent_post_id ) . '</div>';

							// Read more link

								$output .= str_replace(
									$continue_reading_url_to_replace,
									esc_url( get_permalink( $recent_post_id ) ),
									(string) apply_filters( 'wmhook_reykjavik_summary_continue_reading', '', 'widget-recent-posts' )
								);

						$output .= '</div>';

						$output .= '</article>';

					endforeach;

					$output .= '</div>';


				// Output

					if ( $output ) {
						echo $args['before_widget'] . $output . $args['after_widget'];
					}

			} // /widget





		/**
		 * 20) Options
		 */

			/**
			 * Outputs the settings form
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $instance  Current settings.
			 */
			public function form( $instance ) {

				// Processing

					parent::form( $instance );


				// Output

					$this->field_category( $instance );

			} // /form



			/**
			 * Option field: Category
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $instance  Current settings.
			 */
			public function field_category( $instance = array() ) {

				// Helper variables

					if ( ! isset( $instance['category'] ) ) {
						$instance['category'] = '';
					}


				// Output

					?>

					<p>
						<label for="<?php echo $this->get_field_id( 'category' ); ?>">
							<?php esc_html_e( 'Category slug or ID:', 'reykjavik' ); ?>
						</label>
						<input type="text" size="32" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo esc_attr( $instance['category'] ); ?>" />
					</p>

					<?php

			} // /field_category



			/**
			 * Handles updating settings for the current widget instance
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $new_instance  New settings for this instance as input by the user via WP_Widget::form().
			 * @param  array $old_instance  Old settings for this instance.
			 */
			public function update( $new_instance, $old_instance ) {

				// Helper variables

					$instance = parent::update( $new_instance, $old_instance );

					if ( ! isset( $new_instance['category'] ) ) {
						$new_instance['category'] = '';
					}


				// Processing

					$instance['category'] = ( is_numeric( $new_instance['category'] ) ) ? ( absint( $new_instance['category'] ) ) : ( sanitize_title( $new_instance['category'] ) );


				// Output

					return $instance;

			} // /update





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
