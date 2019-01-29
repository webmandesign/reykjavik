<?php
/**
 * Sanitization Methods class
 *
 * @link  https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php
 *
 * @subpackage  Core
 *
 * @package    WebMan WordPress Theme Framework
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.5.0
 * @version  2.7.0
 * @version  1.4.0
 *
 * Contents:
 *
 * 10) General
 * 20) CSS
 */
final class Reykjavik_Library_Sanitize {





	/**
	 * 10) General
	 */

		/**
		 * Sanitize checkbox
		 *
		 * Sanitization callback for checkbox type controls.
		 * This callback sanitizes `$checked` as a boolean value, either TRUE or FALSE.
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
		 * @version  1.4.0
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
				if ( $choices instanceof WP_Customize_Setting ) {
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
		 * @version  2.6.1
		 * @version  1.4.0
		 *
		 * @param  mixed $value
		 * @param  array $choices
		 */
		public static function multi_array( $value, $choices = array() ) {

			// Variables

				/**
				 * If we get a string in `$value`,
				 * split it to array using `,` as delimiter.
				 */
				$value = ( is_string( $value ) ) ? ( explode( ',', (string) $value ) ) : ( (array) $value );

				/**
				 * If we pass a customizer control as `$choices`,
				 * get the list of choices and default value from it.
				 */
				if ( $choices instanceof WP_Customize_Setting ) {
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

				}


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
		 * @version  1.4.0
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
				if ( $default instanceof WP_Customize_Setting ) {
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





	/**
	 * 20) CSS
	 *
	 * Outputs values formatted for CSS properties.
	 */

		/**
		 * Get numeric value with string suffix.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  number $value
		 * @param  string $suffix
		 * @param  string $sanitize
		 */
		public static function get_number_with_suffix( $value, $suffix = '%', $sanitize = 'absint' ) {

			// Output

				if ( is_callable( $sanitize ) ) {
					return call_user_func( $sanitize, $value ) . trim( $suffix );
				} else {
					return '';
				}

		} // /get_number_with_suffix



		/**
		 * Sanitize CSS pixel value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_pixels( $value ) {

			// Output

				return self::get_number_with_suffix( $value, 'px', 'absint' );

		} // /css_pixels



		/**
		 * Sanitize CSS percentage value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_percent( $value ) {

			// Output

				return self::get_number_with_suffix( $value, '%' );

		} // /css_percent



		/**
		 * Sanitize CSS rem unit value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_rem( $value ) {

			// Output

				return self::get_number_with_suffix( $value, 'rem' );

		} // /css_rem



		/**
		 * Sanitize CSS em unit value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_em( $value ) {

			// Output

				return self::get_number_with_suffix( $value, 'em' );

		} // /css_em



		/**
		 * Sanitize CSS vh unit value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_vh( $value ) {

			// Output

				return self::get_number_with_suffix( $value, 'vh' );

		} // /css_vh



		/**
		 * Sanitize CSS vw unit value.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  int $value
		 */
		public static function css_vw( $value ) {

			// Output

				return self::get_number_with_suffix( $value, 'vw' );

		} // /css_vw



		/**
		 * Sanitize CSS fonts.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  string $fonts
		 */
		public static function css_fonts( $fonts ) {

			// Variables

				/**
				 * @link  https://developer.mozilla.org/en-US/docs/Web/CSS/font-family
				 */
				$font_family_generic = array(
					'serif',
					'sans-serif',
					'monospace',
					'cursive',
					'fantasy',
					'system-ui',
					'inherit',
					'initial',
					'unset',
				);


			// Processing

				$fonts = explode( ',', (string) self::fonts( $fonts ) );

				foreach ( $fonts as $key => $font_family ) {
					$font_family = trim( $font_family, "\"' \t\n\r\0\x0B" );
					if ( ! in_array( $font_family, $font_family_generic ) ) {
						$font_family = '"' . $font_family . '"';
					}
					$fonts[ $key ] = $font_family;
				}

				$fonts = implode( ', ', (array) $fonts );


			// Output

				return (string) $fonts;

		} // /css_fonts



		/**
		 * Sanitize CSS image URL.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  mixed $image  Could be a URL, numeric image ID or an array with `id` image ID key.
		 */
		public static function css_image_url( $image ) {

			// Variables

				$value = 'none';


			// Processing

				if ( is_array( $image ) && isset( $image['id'] ) ) {
					$image = absint( $image['id'] );
				}

				if ( is_numeric( $image ) ) {
					$image = wp_get_attachment_image_src( absint( $image ), 'full' );
					$image = $image[0];
				}

				if ( ! empty( $image ) ) {
					$value = 'url("' . esc_url_raw( $image ) . '")';
				}


			// Output

				return $value;

		} // /css_image_url



		/**
		 * Sanitize CSS background-repeat checkbox.
		 *
		 * Available values:
		 * - TRUE: CSS value of `repeat`,
		 * - FALSE: CSS value of `no-repeat`.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  mixed $repeat
		 */
		public static function css_checkbox_background_repeat( $repeat ) {

			// Processing

				if ( ! is_string( $repeat ) ) {
					$repeat = ( $repeat ) ? ( 'repeat' ) : ( 'no-repeat' );
				}


			// Output

				return (string) $repeat;

		} // /css_checkbox_background_repeat



		/**
		 * Sanitize CSS background-attachment checkbox.
		 *
		 * Available values:
		 * - TRUE: CSS value of `fixed`,
		 * - FALSE: CSS value of `scroll`.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 *
		 * @param  mixed $attachment
		 */
		public static function css_checkbox_background_attachment( $attachment ) {

			// Processing

				if ( ! is_string( $attachment ) ) {
					$attachment = ( $attachment ) ? ( 'fixed' ) : ( 'scroll' );
				}


			// Output

				return (string) $attachment;

		} // /css_checkbox_background_attachment





} // /Reykjavik_Library_Sanitize
