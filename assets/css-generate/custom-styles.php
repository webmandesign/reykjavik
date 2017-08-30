<?php
/**
 * Customizer CSS generator
 *
 * @uses  `wmhook_reykjavik_esc_css` global hook
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.0.0
 */





/**
 * Output Customizer styles
 *
 * @since    1.0.0
 * @version  1.0.0
 *
 * @param  boolean $visual_editor If true, will output styles for WordPress Visual Editor only.
 */
function reykjavik_custom_styles( $visual_editor = false ) {

	// Pre

		$pre = apply_filters( 'wmhook_reykjavik_custom_styles_pre', false, $visual_editor );

		if ( false !== $pre ) {
			return $pre;
		}


	// Helper variables

		$output        = '';
		$custom_styles = array();

		$helper = apply_filters( 'wmhook_reykjavik_custom_styles_helper', array(
				'layout_width_site'    => get_theme_mod( 'layout_width_site', 1640 ),
				'layout_width_content' => get_theme_mod( 'layout_width_content', 1200 ),
				'typography_size_html' => get_theme_mod( 'typography_size_html', 18 ),
			) );


	// Processing

		/**
		 * Custom styles array
		 *
		 * For advanced, conditional styles.
		 *
		 * You can hook onto `wmhook_reykjavik_custom_styles_use_custom_array` and disable the theme
		 * default array setup. Then just hook onto `wmhook_reykjavik_custom_styles_array` to create
		 * your own custom array.
		 *
		 * This is very dependent on $helper['typography_size_html'] as we divide by this value.
		 * If the value is not existing, don't generate anything as we are using the theme defaults.
		 */
		if ( ! apply_filters( 'wmhook_reykjavik_custom_styles_use_custom_array', false ) ) {

			if ( ! $visual_editor ) {
			// Normal, non-Visual Editor styles

				$custom_styles = array(





						'customizer-styles-title' => array(
								'custom' => '/* Customizer styles: calculated */'
							),





						/**
						 * Typography
						 */

							'typography' => array(
									'custom' => '/* Typography */'
								),

							'typography-media-query-open' => array(
									'custom' => "\t" . '@media only screen and (min-width: 28em) {'
								),

								'typography-font-size-html' => array(
									'selector' => 'html',
									'styles'   => array(
										'font-size' => ( $helper['typography_size_html'] / 16 * 100 ) . '%',
									)
								),

							'typography-media-query-close' => array(
									'custom' => "\t" . '}'
								),





						/**
						 * Layout
						 */

							'layout' => array(
									'custom' => '/* Layout */'
								),

							'layout-width-site' => array(
								'selector' => implode( ', ', array(
										'.site-layout-boxed .site',
									) ),
								'styles'   => array(
									'max-width|1' => $helper['layout_width_site'] . 'px',
									'max-width|2' => ( $helper['layout_width_site'] / $helper['typography_size_html'] ) . 'rem',
								)
							),

							'layout-width-content' => array(
								'selector' => implode( ', ', array(
										// All the selectors with `@extend %content_width;` from SASS files // $content_width
										'.site-header-inner',
										'.intro-inner',
										'.intro-special .intro',
										'.site-content-inner',
										'.nav-links',
										'.page-template-child-pages:not(.fl-builder) .site-main .entry-content',
										'.list-child-pages-container',
										'.fl-builder .comments-area',
										'.content-layout-no-paddings .comments-area',
										'.content-layout-stretched .comments-area',
										'.site-footer-area-inner',
										'.site .fl-row-fixed-width',
										'.breadcrumbs',
									) ),
								'styles'   => array(
									'max-width|1' => $helper['layout_width_content'] . 'px',
									'max-width|2' => ( $helper['layout_width_content'] / $helper['typography_size_html'] ) . 'rem',
								)
							),





					); // /$custom_styles

			} else {
			// Visual Editor styles

				$custom_styles = array(





						'editor-' . 'customizer-styles-title' => array(
								'custom' => '/* Customizer styles: calculated */'
							),





						/**
						 * Typography
						 */

							'editor-' . 'typography' => array(
									'custom' => '/* Typography */'
								),

							'editor-' . 'typography-font-size-html' => array(
								'selector' => 'html',
								'styles'   => array(
									'font-size' => '100%', // First, we have to reset the initial font size
								)
							),

							'editor-' . 'typography-media-query-open' => array(
									'custom' => "\t" . '@media only screen and (min-width: 28em) {'
								),

								'editor-' . 'typography-font-size-body' => array(
									'selector' => '.mce-content-body',
									'styles'   => array(
										'font-size' => ( $helper['typography_size_html'] / 16 * 100 ) . '%',
									)
								),

							'editor-' . 'typography-media-query-close' => array(
									'custom' => "\t" . '}'
								),





						/**
						 * Layout
						 */

							'editor-' . 'layout' => array(
									'custom' => '/* Layout */'
								),

							'editor-' . 'layout-max-width' => array(
								'selector' => 'html, html[lang]', // We need to try for higher specificity to override later default setup.
								'styles'   => array(
									'max-width' => ( $helper['layout_width_content'] + 40 ) . 'px',
								)
							),





					); // /$custom_styles

			}

		} // /wmhook_reykjavik_custom_styles_use_custom_array

			// Filter the $custom_styles array

				$custom_styles = apply_filters( 'wmhook_reykjavik_custom_styles_array', $custom_styles, $visual_editor, $helper );

			// Process the $custom_styles array

				if ( ! empty( $custom_styles ) ) {
					foreach ( $custom_styles as $selector ) {

						// Check condition first, if set

							if (
									isset( $selector['condition'] )
									&& ! trim( $selector['condition'] )
								) {
								continue;
							}

						// Processing the array

							if (
									isset( $selector['selector'] )
									&& $selector['selector']
									&& isset( $selector['styles'] )
									&& is_array( $selector['styles'] )
									&& ! empty( $selector['styles'] )
								) {

								// When CSS selector and styles set up

									$selector_styles = $prepend = '';

									$prepend = ( ! isset( $selector['prepend'] ) ) ? ( "\t\t" ) : ( $selector['prepend'] );

									if ( is_array( $selector['selector'] ) ) {

										// Replace placeholders in selector string
										// array( 'selector string with {p}', 'placeholder' )

											$selector['selector'] = str_replace( '{p}', $selector['selector'][1], $selector['selector'][0] );

									}

									$selector['selector'] = str_replace( ', ', ",\r\n" . $prepend, $selector['selector'] );

									foreach ( $selector['styles'] as $property => $style ) {
										if ( trim( $style ) ) {

											// This is for multiple overridden properties

												if ( strpos( $property, '|' ) ) {
													$property = explode( '|', $property );
													$property = $property[0];
												}

											$selector_styles .= $prepend . "\t" . $property . ': ' . trim( $style ) . ';' . "\r\n";

										}
									} // /foreach

									if ( $selector_styles ) {
										$output .= $prepend . $selector['selector'] . ' {';
										$output .= "\r\n" . $selector_styles;
										$output .= $prepend . '}' . "\r\n\r\n";
									}

							} elseif (
									isset( $selector['custom'] )
									&& $selector['custom']
								) {

								// Custom texts

									$output .= "\r\n\t" . $selector['custom'] . "\r\n\r\n";

							}

					} // /foreach
				}



		/**
		 * Custom CSS variables stylesheet
		 *
		 * For permanent simple styles (default value must be set).
		 */
		if ( is_callable( 'Reykjavik_Library_Customize_Styles::custom_styles' ) ) {

			$custom_styles_custom_types = apply_filters( 'wmhook_reykjavik_custom_styles_custom_types', array(
					'frontend' => array(
							'addon',
						),
					'editor'   => array(
							'addon',
						),
				) );

			ob_start();

			if ( ! $visual_editor ) {

				locate_template( 'assets/css/custom-styles.css', true, false );

				if ( isset( $custom_styles_custom_types['frontend'] ) ) {
					foreach ( (array) $custom_styles_custom_types['frontend'] as $type ) {
						locate_template( 'assets/css/custom-styles-' . sanitize_file_name( $type ) . '.css', true, false );
					}
				}

			} else {

				locate_template( 'assets/css/custom-styles-editor.css', true, false );

				if ( isset( $custom_styles_custom_types['editor'] ) ) {
					foreach ( (array) $custom_styles_custom_types['editor'] as $type ) {
						locate_template( 'assets/css/custom-styles-' . sanitize_file_name( $type ) . '-editor.css', true, false );
					}
				}

			}

			$output .= "\r\n\r\n" . Reykjavik_Library_Customize_Styles::custom_styles( ob_get_clean() );

		}

		// Filter the output

			$output = (string) apply_filters( 'wmhook_reykjavik_custom_styles_output', $output, $visual_editor, $helper );

		// CSS generator info comments

			date_default_timezone_set( 'UTC' );

			$output .= "\r\n\r\n\r\n" . '/* Using Reykjavik theme by WebMan Design - Oliver Juhas (https://www.webmandesign.eu), version ' . REYKJAVIK_THEME_VERSION . '. CSS generated on ' . gmdate( 'Y/m/d H:i, e' ) . '. */';


	// Output

		return apply_filters( 'wmhook_reykjavik_esc_css', $output );

} // /reykjavik_custom_styles
