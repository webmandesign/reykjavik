<?php
/**
 * Beaver Builder: Column Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.3.1
 *
 * Contents:
 *
 *  0) Init
 * 10) Classes
 */
class Reykjavik_Beaver_Builder_Column {





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

						add_filter( 'fl_builder_column_custom_class', __CLASS__ . '::classes', 10, 2 );

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
	 * 10) Classes
	 */

		/**
		 * Modify CSS classes
		 *
		 * @since    1.0.0
		 * @version  1.3.1
		 *
		 * @param  string $class
		 * @param  object $node
		 */
		public static function classes( $class, $node ) {

			// Processing

				// Content vertical alignment

					if ( ! empty( $node->settings->vertical_alignment ) ) {
						$class .= ' ' . esc_attr( trim( $node->settings->vertical_alignment ) );
					}

				// Predefined colors

					if ( ! empty( $node->settings->predefined_color ) ) {
						$class .= ' ' . esc_attr( trim( $node->settings->predefined_color ) );
					}


			// Output

				return $class;

		} // /classes





} // /Reykjavik_Beaver_Builder_Column

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Column::init' );
