<?php
/**
 * Sanitization Methods class
 *
 * @link  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @package     WebMan WordPress Theme Framework
 * @subpackage  Core
 *
 * @since    2.5.0
 * @version  2.5.6
 *
 * Contents:
 *
 * 10) Sanitization methods
 */
final class Reykjavik_Library_Sanitize {





	/**
	 * 10) Sanitization methods
	 */

		/**
		 * Sanitize checkbox
		 *
		 * Sanitization callback for checkbox type controls.
		 * This callback sanitizes `$value` as a boolean, either TRUE or FALSE.
		 *
		 * @since    2.5.0
		 * @version  2.5.0
		 *
		 * @param  bool $value
		 */
		public static function checkbox( $value ) {

			// Output

				return ( ( isset( $value ) && true == $value ) ? ( true ) : ( false ) );

		} // /checkbox



		/**
		 * Sanitize select/radio
		 *
		 * Sanitization callback for select and radio type controls.
		 * This callback sanitizes `$value` against provided array of `$choices`.
		 * The `$choices` has to be associated array!
		 *
		 * @since    2.5.0
		 * @version  2.5.0
		 *
		 * @param  string $value
		 * @param  array  $choices
		 * @param  string $default
		 */
		public static function select( $value, $choices = array(), $default = '' ) {

			// Processing

				/**
				 * If we pass a customizer control as `$choices`,
				 * get the list of choices and default value from it.
				 */
				if ( is_a( $choices, 'WP_Customize_Setting' ) ) {
					$default = $choices->default;
					$choices = $choices->manager->get_control( $choices->id )->choices;
				}


			// Output

				return ( array_key_exists( $value, (array) $choices ) ? ( esc_attr( $value ) ) : ( esc_attr( $default ) ) );

		} // /select



		/**
		 * Sanitize array
		 *
		 * Sanitization callback for multiselect type controls.
		 * This callback sanitizes `$value` against provided array of `$choices`.
		 * The `$choices` has to be associated array!
		 * Returns an array of values.
		 *
		 * @since    2.5.0
		 * @version  2.5.4
		 *
		 * @param  mixed $value
		 * @param  array $choices
		 */
		public static function multi_array( $value, $choices = array() ) {

			// Helper variables

				/**
				 * If we get a string in `$value`,
				 * split it to array using `,` as delimiter.
				 */
				$value = ( ! is_array( $value ) ) ? ( explode( ',', (string) $value ) ) : ( $value );

				/**
				 * If we pass a customizer control as `$choices`,
				 * get the list of choices and default value from it.
				 */
				if ( is_a( $choices, 'WP_Customize_Setting' ) ) {
					$choices = $choices->manager->get_control( $choices->id )->choices;
				}


			// Requirements check

				if ( empty( $choices ) ) {
					return array();
				}


			// Processing

				foreach ( $value as $key => $single_value ) {

					if ( ! array_key_exists( $single_value, $choices ) ) {
						unset( $value[ $key ] );
						continue;
					}

					$value[ $key ] = esc_attr( $single_value );

				} // /foreach


			// Output

				return (array) $value;

		} // /multi_array



		/**
		 * Sanitize fonts
		 *
		 * Sanitization callback for `font-family` CSS property value.
		 * Allows only alphanumeric characters, spaces, commas, underscores,
		 * dashes, single and/or double quotes of `$value` variable.
		 *
		 * @since    2.5.0
		 * @version  2.5.0
		 *
		 * @param  string $value
		 * @param  string $default
		 */
		public static function fonts( $value, $default = '' ) {

			// Processing

				$value = trim( preg_replace( '/[^a-zA-Z0-9 ,_\-\'\"]+/', '', (string) $value ) );

				/**
				 * If we pass a customizer control as `$default`,
				 * get the default value from it.
				 */
				if ( is_a( $default, 'WP_Customize_Setting' ) ) {
					$default = $default->default;
				}


			// Output

				return ( ( $value ) ? ( (string) $value ) : ( (string) $default ) );

		} // /fonts



		/**
		 * Sanitize float
		 *
		 * Sanitization callback for float number type controls.
		 * This callback sanitizes `$value` as a float number.
		 * Has to do a wrapper for `floatval()` here as otherwise
		 * you can get a PHP warning when using in customizer
		 * ("floatval() expects exactly 1 parameter, 2 given").
		 *
		 * @since    2.5.6
		 * @version  2.5.6
		 *
		 * @param  string $value
		 */
		public static function float( $value ) {

			// Output

				return floatval( $value );

		} // /float





} // /Reykjavik_Library_Sanitize
