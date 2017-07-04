<?php
/**
 * Widget: WordPress Text
 *
 * Altering native WordPress Text widget.
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
			|| ! class_exists( 'WP_Widget_Text' )
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
	 *  0) Init
	 * 10) Output
	 * 20) Options
	 * 30) Admin
	 */
	class Reykjavik_WP_Widget_Text extends WP_Widget_Text {





		/**
		 * 0) Init
		 */

			/**
			 * Constructor
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public function __construct() {

				// Processing

					parent::__construct();

					// Hooks

						// Actions

							add_action( 'admin_print_scripts-widgets.php', array( $this, 'enqueue' ) );

							add_action( 'wp_enqueue_scripts', array( $this, 'assets_beaver_builder' ) );

			} // /__construct





		/**
		 * 10) Output
		 */

			/**
			 * Outputs the content for the current widget instance
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $args      Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
			 * @param  array $instance  Settings for the current Text widget instance.
			 */
			public function widget( $args, $instance ) {

				// Helper variables

					$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

					$widget_text  = ( ! empty( $instance['text'] ) ) ? ( $instance['text'] ) : ( '' );
					$widget_media = array_filter( array(
							'icon'  => ( isset( $instance['icon'] ) ) ? ( trim( $instance['icon'] ) ) : ( '' ),
							'image' => ( isset( $instance['image'] ) ) ? ( absint( $instance['image'] ) ) : ( 0 ),
						) );


				// Processing

					$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

					if ( ! empty( $widget_media ) ) {

						$widget_text = '';

						// Output image

							if ( isset( $widget_media['image'] ) ) {
								$widget_text .= '<div class="widget-text-media widget-text-media-image">';
								$widget_text .= wp_get_attachment_image( absint( $instance['image'] ), 'medium' );
								$widget_text .= '</div>';
							}

						// Output icon

							if ( isset( $widget_media['icon'] ) ) {
								$widget_text .= '<div class="widget-text-media widget-text-media-icon h3">'; // Heading class is to inherit heading color
								$widget_text .= '<span class="widget-symbol ' . esc_attr( $widget_media['icon'] ) . '" aria-hidden="true"></span>';
								$widget_text .= '</div>';
							}

						$widget_text .= '<div class="widget-text-content">';

						if ( ! empty( $title ) ) {
							$widget_text .= $args['before_title'];
							$widget_text .= $title;
							$widget_text .= $args['after_title'];

							$title = '';
						}

						$widget_text .= $text;
						$widget_text .= '</div>';

						$text = $widget_text;

						$instance['filter'] = true;
					}

					if ( isset( $instance['filter'] ) ) {
						if ( 'content' === $instance['filter'] ) {
							// WP 4.8+
							$text = apply_filters( 'widget_text_content', $text, $instance, $this );
						} elseif ( $instance['filter'] ) {
							// WP 4.8-
							$text = wpautop( $text );
						}
					}


				// Output

					echo $args['before_widget'];

					if ( ! empty( $title ) ) {
						echo $args['before_title'] . $title . $args['after_title'];
					}

					?>

					<div class="textwidget"><?php echo $text; ?></div>

					<?php

					echo $args['after_widget'];

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

					$this->field_image( $instance );
					$this->field_icon( $instance );

			} // /form



			/**
			 * Option field: Icon
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $instance  Current settings.
			 */
			public function field_icon( $instance = array() ) {

				// Helper variables

					if ( ! isset( $instance['icon'] ) ) {
						$instance['icon'] = '';
					}


				// Output

					?>

					<p class="text-widget-media-icon">
						<label for="<?php echo $this->get_field_id( 'icon' ); ?>">
							<strong><?php esc_html_e( 'Set icon CSS class:', 'reykjavik' ); ?></strong><br>
							<span class="description" style="display: inline-block; padding: 0 0 .38em">
								<em>
									<?php
									printf(
										esc_html__( 'For displaying icons on your website use a plugin, such as %1$s or %2$s.', 'reykjavik' ),
										'<a href="https://wordpress.org/plugins/better-font-awesome/" target="_blank">' . esc_html_x( 'Better Font Awesome', 'Plugin name.', 'reykjavik' ) . '</a>',
										'<a href="https://wordpress.org/plugins/ionicons-official/" target="_blank">' . esc_html_x( 'Ionicons Official', 'Plugin name.', 'reykjavik' ) . '</a>'
									);
									?>
								</em>
							</span>
						</label>
						<input type="text" class="widefat text-widget-media-icon-class" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" value="<?php echo esc_attr( $instance['icon'] ); ?>" />
					</p>

					<?php

			} // /field_icon



			/**
			 * Option field: Image
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 *
			 * @param  array $instance  Current settings.
			 */
			public function field_image( $instance = array() ) {

				// Helper variables

					if ( ! isset( $instance['image'] ) ) {
						$instance['image'] = 0;
					}


				// Output

					?>

					<p class="text-widget-media-image">
						<label for="<?php echo $this->get_field_id( 'image' ); ?>">
							<strong><?php esc_html_e( 'Set image:', 'reykjavik' ); ?></strong><br>
							<span class="description" style="display: inline-block; padding: 0 0 .38em">
								<em>
									<?php esc_html_e( 'Choose a featured image for this widget.', 'reykjavik' ); ?>
								</em>
							</span>
						</label>
						<br>
						<button class="button button-hero text-widget-media-image-select"><?php esc_html_e( 'Select image', 'reykjavik' ); ?></button>
						<input type="hidden" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" />
						<span class="text-widget-media-image-preview"<?php if ( empty( $instance['image'] ) ) { echo ' style="display: none;"'; } ?>>
							<img src="<?php

								if ( $instance['image'] ) {
									$image_url = wp_get_attachment_image_src( absint( $instance['image'] ) );
									if ( $image_url ) {
										echo esc_url( $image_url[0] );
									}
								}

								?>" alt="" />
							<button class="button text-widget-media-image-remove">
								<span class="screen-reader-text"><?php esc_html_e( 'Remove image', 'reykjavik' ); ?></span>
							</button>
						</span>
					</p>

					<?php

			} // /field_image



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


				// Processing

					$instance['icon']  = esc_attr( $new_instance['icon'] );
					$instance['image'] = absint( $new_instance['image'] );


				// Output

					return $instance;

			} // /update





		/**
		 * 30) Admin
		 */

			/**
			 * Enqueue assets
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public function enqueue() {

				// Processing

					// Styles

						wp_enqueue_style(
								'reykjavik-widget-text',
								get_theme_file_uri( 'assets/css/options-widget-text.css' ),
								array(),
								esc_attr( REYKJAVIK_THEME_VERSION )
							);

					// Scripts

						wp_enqueue_media();

						wp_enqueue_script(
								'reykjavik-widget-text',
								get_theme_file_uri( 'assets/js/scripts-widget-text.js' ),
								array( 'media-upload' ),
								esc_attr( REYKJAVIK_THEME_VERSION ),
								true
							);

			} // /enqueue



			/**
			 * Loading assets in Beaver Builder
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public function assets_beaver_builder() {

				// Requirements check

					if ( ! is_callable( 'FLBuilderModel::is_builder_active' ) || ! FLBuilderModel::is_builder_active() ) {
						return;
					}


				// Processing

					$this->enqueue();

			} // /assets_beaver_builder





	} // /Reykjavik_WP_Widget_Text



	/**
	 * Widget registration
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	function reykjavik_register_widget_text() {

		// Processing

			unregister_widget( 'WP_Widget_Text' );

			register_widget( 'Reykjavik_WP_Widget_Text' );

	} // /reykjavik_register_widget_text

	add_action( 'widgets_init', 'reykjavik_register_widget_text' );
