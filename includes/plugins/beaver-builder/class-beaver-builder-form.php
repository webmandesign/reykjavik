<?php
/**
 * Beaver Builder: Form Class
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
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Hooks

					// Filters

						add_filter( 'fl_builder_register_settings_form', __CLASS__ . '::register_settings_form', 10, 2 );

						add_filter( 'fl_builder_render_settings_field', __CLASS__ . '::predefined_classes_dropdown', 10, 2 );

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

						// Adding "Predefined colors" section just after the "General" section

							// Backing up all the sections to keep the order of the fields

								$sections = $form['tabs']['style']['sections'];

							// Backing up and removing the first section ("General"), so we can merge it later in the correct order

								$section_general = array( 'general' => $form['tabs']['style']['sections']['general'] );

								unset( $sections['general'] );

							// "Predefined colors" section setup

								$section_colors_predefined = array(

										'colors_predefined' => array(
											'title'  => esc_html__( 'Predefined Colors', 'reykjavik' ),
											'fields' => array(

												'predefined_color' => array(
													'type'        => 'select',
													'label'       => esc_html__( 'Assign predefined colors', 'reykjavik' ),
													'help'        => esc_html__( 'You can override these further below by setting up a custom background or text color', 'reykjavik' ),
													'description' => '<br><br>' . esc_html__( 'Set this to match the colors of theme predefined sections', 'reykjavik' ),
													'default' => '',
													'options' => array(
														'' => esc_html__( '- No predefined color -', 'reykjavik' ),

														// Color classes

															'optgroup-sections' => array(
																'label'   => esc_html__( 'Theme sections colors:', 'reykjavik' ),
																'options' => array(

																	'set-colors-header'        => esc_html__( 'Set header colors', 'reykjavik' ),
																	'set-colors-intro'         => esc_html__( 'Set intro colors', 'reykjavik' ),
																	'set-colors-intro-widgets' => esc_html__( 'Set intro widgets colors', 'reykjavik' ),
																	'set-colors-content'       => esc_html__( 'Set content colors', 'reykjavik' ),
																	'set-colors-footer'        => esc_html__( 'Set footer colors', 'reykjavik' ),

																),
															),

														// Accent colors

															'optgroup-accents' => array(
																'label'   => esc_html__( 'Accent colors:', 'reykjavik' ),
																'options' => array(

																	'set-colors-accent'  => esc_html__( 'Set primary accent colors', 'reykjavik' ),
																	'hover-color-accent' => esc_html__( 'Set primary accent colors on mouse hover', 'reykjavik' ),

																	'set-colors-error'  => esc_html__( 'Set error colors', 'reykjavik' ),
																	'hover-color-error' => esc_html__( 'Set error colors on mouse hover', 'reykjavik' ),

																	'set-colors-info'  => esc_html__( 'Set info colors', 'reykjavik' ),
																	'hover-color-info' => esc_html__( 'Set info colors on mouse hover', 'reykjavik' ),

																	'set-colors-success'  => esc_html__( 'Set success colors', 'reykjavik' ),
																	'hover-color-success' => esc_html__( 'Set success colors on mouse hover', 'reykjavik' ),

																	'set-colors-warning'  => esc_html__( 'Set warning colors', 'reykjavik' ),
																	'hover-color-warning' => esc_html__( 'Set warning colors on mouse hover', 'reykjavik' ),

																),
															),

													),
													'preview' => array(
														'type' => 'none',
													),
												),

											),
										),

									);

							// Putting the sections all together in specific order

								$form['tabs']['style']['sections'] = array_merge( $section_general, $section_colors_predefined, $sections );

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
		 * @version  1.0.0
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

										'box-shadow-small'  => esc_html__( 'Column shadow, small', 'reykjavik' ),
										'box-shadow-medium' => esc_html__( 'Column shadow, medium', 'reykjavik' ),
										'box-shadow-large'  => esc_html__( 'Column shadow, large', 'reykjavik' ),

									),
								),

							// Layout classes

								'optgroup-layout' => array(
									'label'   => esc_html__( 'Layout:', 'reykjavik' ),
									'options' => array(

										'text-center'      => esc_html__( 'Text center', 'reykjavik' ),
										'text-left'        => esc_html__( 'Text left', 'reykjavik' ),
										'text-right'       => esc_html__( 'Text right', 'reykjavik' ),

										'fullwidth'        => esc_html__( 'Fullwidth elements', 'reykjavik' ),

										'hide-accessibly'  => esc_html__( 'Hide accessibly (displayed in page builder edit mode only)', 'reykjavik' ),

										'split-screen-row' => esc_html__( 'Split screen row (apply on full-height row only)', 'reykjavik' ),

										'zindex-10'        => esc_html__( 'Bring element to front (CSS z-index)', 'reykjavik' ),

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

										'font-size-xs' => esc_html__( 'Font size, extra small', 'reykjavik' ),
										'font-size-s'  => esc_html__( 'Font size, small', 'reykjavik' ),
										'font-size-sm' => esc_html__( 'Font size, smaller', 'reykjavik' ),
										'font-size-l'  => esc_html__( 'Font size, large', 'reykjavik' ),
										'font-size-xl' => esc_html__( 'Font size, extra large', 'reykjavik' ),

									),
								),

						);

				}


			// Output

				return $field;

		} // /predefined_classes_dropdown





} // /Reykjavik_Beaver_Builder_Form

add_action( 'after_setup_theme', 'Reykjavik_Beaver_Builder_Form::init' );
