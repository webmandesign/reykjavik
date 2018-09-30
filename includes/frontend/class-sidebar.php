<?php
/**
 * Sidebar Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Register
 *  20) Widget areas
 *  30) Conditions
 * 100) Others
 */
class Reykjavik_Sidebar {





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

						add_action( 'widgets_init', __CLASS__ . '::register', 1 );

						add_action( 'tha_content_bottom', __CLASS__ . '::secondary', 85 );

						add_action( 'wmhook_reykjavik_intro_after', __CLASS__ . '::intro' );

						add_action( 'tha_footer_top', __CLASS__ . '::footer', 30 );

					// Filters

						add_filter( 'is_active_sidebar', __CLASS__ . '::intro_conditions', 10, 2 );

						add_filter( 'is_active_sidebar', __CLASS__ . '::secondary_conditions', 100, 2 );

						add_filter( 'wmhook_reykjavik_header_body_classes_sidebars', __CLASS__ . '::body_class_sidebars' );

						add_filter( 'widget_tag_cloud_args', __CLASS__ . '::widget_tag_cloud_args' );

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
	 * 10) Register
	 */

		/**
		 * Register predefined widget areas (sidebars)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function register() {

			// Helper variables

				$widget_areas = array(

						'sidebar' => array(
							'name'        => esc_html__( 'Sidebar', 'reykjavik' ),
							'description' => esc_html__( 'Default sidebar area.', 'reykjavik' ),
						),

						'intro' => array(
							'name'        => esc_html__( 'Intro Widgets', 'reykjavik' ),
							'description' => esc_html__( 'Widgetized area displayed at the bottom of the Intro title section.', 'reykjavik' ),
						),

						'footer' => array(
							'name'        => esc_html__( 'Footer Widgets', 'reykjavik' ),
							'description' => esc_html__( 'Widgetized area displaying the main website footer content.', 'reykjavik' ),
						),

					);


			// Processing

				foreach( $widget_areas as $id => $args ) {

					register_sidebar( array(
						'id'            => esc_attr( $id ),
						'name'          => $args['name'],
						'description'   => $args['description'],
						'before_widget' => '<section id="%1$s" class="widget %2$s">',
						'after_widget'  => '</section>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>'
					) );

				} // /foreach

		} // /register





	/**
	 * 20) Widget areas
	 */

		/**
		 * Sidebar (secondary content)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function secondary() {

			// Output

				get_sidebar();

		} // /secondary



		/**
		 * Intro sidebar
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function intro() {

			// Output

				get_sidebar( 'intro' );

		} // /intro



		/**
		 * Footer sidebar
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function footer() {

			// Output

				get_sidebar( 'footer' );

		} // /footer





	/**
	 * 30) Conditions
	 */

		/**
		 * Sidebar (secondary content): display conditions
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  bool       $is_active_sidebar
		 * @param  int|string $index
		 */
		public static function secondary_conditions( $is_active_sidebar, $index ) {

			// Requirements check

				if ( 'sidebar' !== $index ) {
					return $is_active_sidebar;
				}


			// Processing

				if (
						is_404()
						|| is_attachment()
						|| ( is_page( get_the_ID() ) && ! is_page_template( 'templates/sidebar.php' ) )
						|| Reykjavik_Post::is_page_builder_ready()
						|| apply_filters( 'wmhook_reykjavik_sidebar_disable', false )
					) {
					$is_active_sidebar = false;
				}


			// Output

				return $is_active_sidebar;

		} // /secondary_conditions



		/**
		 * Intro sidebar: display conditions
		 *
		 * @since    1.0.0
		 * @version  1.3.0
		 *
		 * @param  bool       $is_active_sidebar
		 * @param  int|string $index
		 */
		public static function intro_conditions( $is_active_sidebar, $index ) {

			// Requirements check

				if ( 'intro' !== $index ) {
					return $is_active_sidebar;
				}


			// Helper variables

				$enabled = ( 'always' === Reykjavik_Library_Customize::get_theme_mod( 'layout_intro_widgets_display' ) ) ? ( ! is_search() ) : ( is_singular() );


			// Processing

				if (
						Reykjavik_Post::is_paged()
						|| ! $enabled
						|| (
							Reykjavik_Post::is_singular()
							&& ! is_page_template( 'templates/intro-widgets.php' )
							&& ! get_post_meta( get_the_ID(), 'show_intro_widgets', true )
						)
					) {
					$is_active_sidebar = false;
				}


			// Output

				return $is_active_sidebar;

		} // /intro_conditions





	/**
	 * 100) Others
	 */

		/**
		 * Which sidebar classes to apply on HTML body?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $sidebars
		 */
		public static function body_class_sidebars( $sidebars = array() ) {

			// Helper variables

				$sidebars[] = 'sidebar';


			// Output

				return (array) $sidebars;

		} // /body_class_sidebars



		/**
		 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $args
		 */
		public static function widget_tag_cloud_args( $args = array() ) {

			// Helper variables

				$args['largest']  = 1;
				$args['smallest'] = 1;
				$args['unit']     = 'em';


			// Output

				return $args;

		} // /widget_tag_cloud_args





} // /Reykjavik_Sidebar

add_action( 'after_setup_theme', 'Reykjavik_Sidebar::init' );
