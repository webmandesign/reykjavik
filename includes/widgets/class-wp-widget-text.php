<?php
/**
 * Widget: WordPress Text
 *
 * Altering native WordPress Text widget.
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
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
	 * @version  1.2.0
	 *
	 * Contents:
	 *
	 *  0) Init
	 * 10) Output
	 * 20) Options
	 * 30) Admin
	 * 40) Icon fallback
	 */
	class Reykjavik_WP_Widget_Text extends WP_Widget_Text {





		/**
		 * 0) Init
		 */

			/**
			 * Constructor
			 *
			 * @since    1.0.0
			 * @version  1.2.0
			 */
			public function __construct() {

				// Processing

					parent::__construct();

					// Hooks

						// Actions

							add_action( 'admin_print_scripts-widgets.php', __CLASS__ . '::enqueue' );

							add_action( 'wp_head', __CLASS__ . '::style_icon_fallback', 5 );

			} // /__construct





		/**
		 * 10) Output
		 */

			/**
			 * Outputs the content for the current widget instance
			 *
			 * @since    1.0.0
			 * @version  1.0.4
			 *
			 * @param  array $args      Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
			 * @param  array $instance  Settings for the current Text widget instance.
			 */
			public function widget( $args, $instance ) {

				// Helper variables

					$output = '';

					$widget_media = array_filter( array(
						'icon'  => ( isset( $instance['icon'] ) ) ? ( trim( $instance['icon'] ) ) : ( '' ),
						'image' => ( isset( $instance['image'] ) ) ? ( $instance['image'] ) : ( 0 ),
					) );


				// Requirements check

					if ( empty( $widget_media ) ) {
						parent::widget( $args, $instance );
						return;
					}


				// Processing

					// Adding widget media before widget title

						$args['before_widget'] .= self::get_widget_media_image( $widget_media );
						$args['before_widget'] .= self::get_widget_media_icon( $widget_media );

					// Wrapping widget title and content with custom div

						$args['before_widget'] .= '<div class="widget-text-content">';
						$args['after_widget']   = '</div>' . $args['after_widget'];


				// Output

					// Now everything is set and we can output the widget HTML
					parent::widget( $args, $instance );

			} // /widget



			/**
			 * Get output HTML of widget media: Image
			 *
			 * @since    1.0.4
			 * @version  1.2.0
			 *
			 * @param  array $widget_media  Media setup array.
			 */
			public static function get_widget_media_image( $widget_media = array() ) {

				// Requirements check

					if (
						! isset( $widget_media['image'] )
						|| empty( $widget_media['image'] )
					) {
						return '';
					}


				// Helper variables

					$output = '';


				// Processing

					$output .= '<div class="widget-text-media widget-text-media-image">';

					if ( is_numeric( $widget_media['image'] ) ) {
						$output .= wp_get_attachment_image( absint( $widget_media['image'] ), 'medium' );
					} else {
						$output .= '<img
							src="' . esc_url( $widget_media['image'] ) . '"
							alt="' . esc_attr__( 'Widget featured image', 'reykjavik' ) . '"
							/>';
					}

					$output .= '</div>';


				// Output

					return $output;

			} // /get_widget_media_image



			/**
			 * Get output HTML of widget media: Icon
			 *
			 * @since    1.0.4
			 * @version  1.0.4
			 *
			 * @param  array $widget_media  Media setup array.
			 */
			public static function get_widget_media_icon( $widget_media = array() ) {

				// Requirements check

					if (
						! isset( $widget_media['icon'] )
						|| empty( $widget_media['icon'] )
					) {
						return '';
					}


				// Helper variables

					$output = '';


				// Processing

					$output .= '<div class="widget-text-media widget-text-media-icon h3">'; // Heading class is to inherit heading colors.
					$output .= '<span class="widget-symbol ' . esc_attr( $widget_media['icon'] ) . '" aria-hidden="true"></span>';
					$output .= '</div>';


				// Output

					return $output;

			} // /get_widget_media_icon





		/**
		 * 20) Options
		 */

			/**
			 * Outputs the settings form
			 *
			 * @since    1.0.0
			 * @version  1.2.0
			 *
			 * @param  array $instance  Current settings.
			 */
			public function form( $instance ) {

				// Processing

					parent::form( $instance );


				// Output

					/**
					 * Warning:
					 * Do not use static method call here (self::X), keep using $this->X!
					 */
					$this->field_icon( $instance );
					$this->field_image( $instance );

			} // /form



			/**
			 * Option field: Icon
			 *
			 * Warning:
			 * Do not feel tempted to make this a static method!
			 *
			 * @since    1.0.0
			 * @version  2.0.0
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
						<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>">
							<strong><?php esc_html_e( 'Set icon CSS class:', 'reykjavik' ); ?></strong><br>
							<span class="description" style="display: inline-block; padding: 0 0 .382em">
								<em>
									<?php

									printf(
										esc_html__( 'For displaying icons on your website use a plugin, such as %1$s or %2$s.', 'reykjavik' ),
										'<a href="https://wordpress.org/plugins/better-font-awesome/">' . esc_html_x( 'Better Font Awesome', 'Plugin name.', 'reykjavik' ) . '</a>',
										'<a href="https://wordpress.org/plugins/ionicons-official/">' . esc_html_x( 'Ionicons Official', 'Plugin name.', 'reykjavik' ) . '</a>'
									);

									if ( class_exists( 'WM_Icons' ) ) {
										echo '<br><strong>' . esc_html__( 'As your theme supports custom icons, you can simply use icon classes from Appearance &rarr; Icon Font.', 'reykjavik' ) . '</strong>';
									}

									?>
								</em>
							</span>
						</label>
						<input type="text" class="widefat text-widget-media-icon-class" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" value="<?php echo esc_attr( $instance['icon'] ); ?>" />
					</p>

					<?php

			} // /field_icon



			/**
			 * Option field: Image
			 *
			 * Warning:
			 * Do not feel tempted to make this a static method!
			 *
			 * @since    1.0.0
			 * @version  2.0.0
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
						<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>">
							<strong><?php esc_html_e( 'Set image:', 'reykjavik' ); ?></strong><br>
							<span class="description" style="display: inline-block; padding: 0 0 .382em">
								<em>
									<?php esc_html_e( 'Choose a featured image for this widget.', 'reykjavik' ); ?>
								</em>
							</span>
						</label>
						<br>
						<button class="button button-hero text-widget-media-image-select"><?php esc_html_e( 'Select image', 'reykjavik' ); ?></button>
						<input type="hidden" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" />
						<span class="text-widget-media-image-preview"<?php if ( empty( $instance['image'] ) ) { echo ' style="display: none;"'; } ?>>
							<img src="<?php

								if ( is_numeric( $instance['image'] ) ) {
									$image_url = wp_get_attachment_image_src( absint( $instance['image'] ) );
									if ( $image_url ) {
										echo esc_url( $image_url[0] );
									}
								} elseif ( $instance['image'] ) {
									echo esc_url( $instance['image'] );
								}

								?>" alt="<?php esc_attr_e( 'Widget featured image', 'reykjavik' ); ?>" />
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

					if ( ! isset( $new_instance['icon'] ) ) {
						$new_instance['icon'] = '';
					}

					if ( ! isset( $new_instance['image'] ) ) {
						$new_instance['image'] = '';
					}


				// Processing

					$instance['icon']  = esc_attr( $new_instance['icon'] );
					$instance['image'] = ( is_numeric( $new_instance['image'] ) ) ? ( absint( $new_instance['image'] ) ) : ( esc_url_raw( $new_instance['image'] ) );


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
			 * @version  1.2.0
			 */
			public static function enqueue() {

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
		 * 40) Icon fallback
		 */

			/**
			 * Icon fallback styles
			 *
			 * For cases when no icons font is loaded.
			 *
			 * IMPORTANT:
			 * This has to be loaded early enough, before the icons font
			 * stylesheet is enqueued (with any plugin)!
			 *
			 * @since    1.0.0
			 * @version  1.2.0
			 */
			public static function style_icon_fallback() {

				// Output

					echo '<style id="reykjavik-text-widget-icon-fallback">'
					   . '.widget-symbol::before { content: "?"; font-family: inherit; }'
					   . '</style>';

			} // /style_icon_fallback





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
