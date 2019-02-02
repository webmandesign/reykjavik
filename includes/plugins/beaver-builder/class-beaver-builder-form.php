<?php
/**
 * Beaver Builder: Form Class
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
 * 10) Custom options
 * 20) Classes
 */
class Reykjavik_Beaver_Builder_Form {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  1.2.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						add_filter( 'fl_builder_register_settings_form', __CLASS__ . '::register_settings_form', 10, 2 );

						add_filter( 'fl_builder_field_js_config', __CLASS__ . '::predefined_classes_dropdown', 10, 2 );

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
	 * 10) Custom options
	 */

		/**
		 * Settings form alterations
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $form
		 * @param  string $id
		 */
		public static function register_settings_form( $form, $id ) {

			// Processing

				// Row and/or column settings only

					if ( in_array( $id, array( 'col', 'row' ) ) ) {

						// Adding column content vertical centering option

							$form['tabs']['style']['sections']['general']['fields']['vertical_alignment'] = array(
									'type'    => 'select',
									'label'   => esc_html__( 'Content Vertical Alignment', 'reykjavik' ),
									'help'    => esc_html__( 'As the theme makes all columns in a row equally high automatically, it allows you to set the column content vertical alignment here.', 'reykjavik' ),
									'default' => '',
									'options' => array(
										''                      => esc_html_x( 'Initial', 'Vertical content alignment value', 'reykjavik' ),
										'vertical-align-top'    => esc_html_x( 'Top', 'Vertical content alignment value', 'reykjavik' ),
										'vertical-align-middle' => esc_html_x( 'Middle', 'Vertical content alignment value', 'reykjavik' ),
										'vertical-align-bottom' => esc_html_x( 'Bottom', 'Vertical content alignment value', 'reykjavik' ),
									),
									'preview' => array(
										'type' => 'none',
									),
								);

					}


			// Output

				return $form;

		} // /register_settings_form





	/**
	 * 20) Classes
	 */

		/**
		 * Add predefined classes helper dropdown
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 *
		 * @param  array $field
		 * @param  name  $name
		 */
		public static function predefined_classes_dropdown( $field, $name ) {

			// Processing

				if ( 'class' == $name ) {
					$field['options'] = array(

						'' => esc_html__( '- Choose from predefined classes -', 'reykjavik' ),

						// Decoration classes
						'optgroup-decoration' => array(
							'label'   => esc_html__( 'Decorations:', 'reykjavik' ),
							'options' => array(

								'has-small-box-shadow'  => esc_html__( 'Column shadow, small', 'reykjavik' ),
								'has-medium-box-shadow' => esc_html__( 'Column shadow, medium', 'reykjavik' ),
								'has-large-box-shadow'  => esc_html__( 'Column shadow, large', 'reykjavik' ),

							),
						),

						// Layout classes
						'optgroup-layout' => array(
							'label'   => esc_html__( 'Layout:', 'reykjavik' ),
							'options' => array(

								'has-center-text-align' => esc_html__( 'Text center', 'reykjavik' ),
								'has-left-text-align'   => esc_html__( 'Text left', 'reykjavik' ),
								'has-right-text-align'  => esc_html__( 'Text right', 'reykjavik' ),

								'fullwidth' => esc_html__( 'Fullwidth elements', 'reykjavik' ),

								'hide-accessibly' => esc_html__( 'Hide accessibly (displayed in page builder edit mode only)', 'reykjavik' ),

								'split-screen-row' => esc_html__( 'Split screen row (apply on full-height row only)', 'reykjavik' ),

								'has-rised-z-index' => esc_html__( 'Bring element to front (CSS z-index)', 'reykjavik' ),

							),
						),

						// Widget classes
						'optgroup-widget' => array(
							'label'   => esc_html__( 'Widgets:', 'reykjavik' ),
							'options' => array(

								'widget-title-style'           => esc_html__( 'Use default widget title styling', 'reykjavik' ),
								'hide-widget-title-accessibly' => esc_html__( 'Hide widget title accessibly', 'reykjavik' ),
								'hide-widget-title'            => esc_html__( 'Hide widget title forcefully', 'reykjavik' ),

							),
						),

						// Typography classes
						'optgroup-typography' => array(
							'label'   => esc_html__( 'Typography:', 'reykjavik' ),
							'options' => array(

								'has-extra-small-font-size' => esc_html__( 'Font size, extra small', 'reykjavik' ),
								'has-small-font-size'       => esc_html__( 'Font size, small', 'reykjavik' ),
								'has-smaller-font-size'     => esc_html__( 'Font size, smaller', 'reykjavik' ),
								'has-large-font-size'       => esc_html__( 'Font size, large', 'reykjavik' ),
								'has-extra-large-font-size'      => esc_html__( 'Font size, extra large', 'reykjavik' ),

							),
						),

					);
				}


			// Output

				return $field;

		} // /predefined_classes_dropdown





} // /Reykjavik_Beaver_Builder_Form

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Form::init' );
