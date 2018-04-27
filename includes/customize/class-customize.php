<?php
/**
 * Theme Customization Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  1.1.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Options
 *  20) Replacements
 *  30) Active callbacks
 *  40) Partial refresh
 * 100) Helpers
 */
class Reykjavik_Customize {





	/**
	 * 0) Init
	 */

		private static $instance;



		/**
		 * Constructor
		 *
		 * @uses  `wmhook_reykjavik_theme_options` global hook
		 * @uses  `wmhook_reykjavik_generate_css_replacements` global hook
		 * @uses  `wmhook_reykjavik_custom_styles_alphas` global hook
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		private function __construct() {

			// Processing

				// Setup

					// Indicate widget sidebars can use selective refresh in the Customizer

						add_theme_support( 'customize-selective-refresh-widgets' );

				// Hooks

					// Actions

						add_action( 'customize_register', __CLASS__ . '::setup' );

					// Filters

						add_filter( 'wmhook_reykjavik_theme_options', __CLASS__ . '::options', 5 );

						add_filter( 'wmhook_reykjavik_generate_css_replacements', __CLASS__ . '::css_replacements' );

						add_filter( 'wmhook_reykjavik_custom_styles_alphas', __CLASS__ . '::rgba_alphas' );

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
	 * 10) Options
	 */

		/**
		 * Modify native WordPress options and setup partial refresh
		 *
		 * @since    1.0.0
		 * @version  1.1.0
		 *
		 * @param  object $wp_customize  WP customizer object.
		 */
		public static function setup( $wp_customize ) {

			// Processing

				// Move the custom logo option down

					$wp_customize->get_control( 'custom_logo' )->priority = 101;

				// Remove header color in favor of theme options

					$wp_customize->remove_control( 'header_textcolor' );

				// Partial refresh

					// Site title

						$wp_customize->selective_refresh->add_partial( 'blogname', array(
							'selector'        => '.site-title',
							'render_callback' => __CLASS__ . '::partial_blogname',
						) );

					// Site description

						$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
							'selector'        => '.site-description',
							'render_callback' => __CLASS__ . '::partial_blogdescription',
						) );

					// Site info (footer credits)

						$wp_customize->selective_refresh->add_partial( 'texts_site_info', array(
							'selector'            => '.site-info',
							'render_callback'     => __CLASS__ . '::partial_texts_site_info',
							'container_inclusive' => false,
						) );

					// Option pointers only

						$wp_customize->selective_refresh->add_partial( 'archive_title_prefix', array(
							'selector' => '.archive .intro-title',
						) );

						$wp_customize->selective_refresh->add_partial( 'layout_page_outdent', array(
							'selector'            => '.page-layout-outdented:not(.content-layout-no-paddings):not(.fl-builder) .option-pointer',
							'render_callback'     => '__return_empty_string',
							'fallback_refresh'    => false,
							'container_inclusive' => false,
						) );
						/**
						 * We need to add a helper HTML not to trigger content or page refresh with this option pointer.
						 * Only required for options with `preview_js` set.
						 */
						add_action( 'tha_entry_top', __CLASS__ . '::option_pointer_' . 'layout_page_outdent', 0 );

		} // /setup



			/**
			 * Option pointer: layout_page_outdent
			 *
			 * This is only required for options with `preview_js` set.
			 * Outputs a helper HTML for our option pointer so we don't trigger
			 * any content or page refresh.
			 *
			 * @since    1.0.0
			 * @version  1.0.0
			 */
			public static function option_pointer_layout_page_outdent() {

				// Output

					if ( is_customize_preview() && is_page() ) {
						echo '<small class="option-pointer"></small>';
					}

			} // /option_pointer_layout_page_outdent



		/**
		 * Set theme options array
		 *
		 * @since    1.0.0
		 * @version  1.0.7
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Helper variables

				global $content_width;

				$alpha = (array) self::rgba_alphas();

				// Helper CSS selectors for `preview_js` (the "@" will be replaced with `selector_replace`)

					$h_tags  =   '@h1, @.h1';
					$h_tags .= ', @h2, @.h2';
					$h_tags .= ', @h3, @.h3';
					$h_tags .= ', @h4, @.h4';

				// Registered image sizes

					$image_sizes = (array) get_intermediate_image_sizes();
					$image_sizes = array_combine( $image_sizes, $image_sizes );


			// Processing

				/**
				 * Theme customizer options array
				 */

					$options = array(

						/**
						 * Site identity: Logo image size
						 */
						'0' . 10 . 'logo' . 10 => array(
							'id'          => 'custom_logo_dimenstions_info',
							'section'     => 'title_tagline',
							'priority'    => 100,
							'type'        => 'html',
							'content'     => '<h3>' . esc_html__( 'Logo image', 'reykjavik' ) . '</h3>',
							'description' => esc_html__( 'Please, do not forget to set the logo max height.', 'reykjavik' ) . ' ' . esc_html__( 'To make your logo image ready for high DPI screens, please upload twice as big image.', 'reykjavik' ),
						),

							'0' . 10 . 'logo' . 20 => array(
								'section'     => 'title_tagline',
								'priority'    => 102,
								'type'        => 'text',
								'id'          => 'custom_logo_height',
								'label'       => esc_html__( 'Max logo image height (px)', 'reykjavik' ),
								'default'     => 50,
								'validate'    => 'absint',
								'input_attrs' => array(
									'size'     => 5,
									'maxwidth' => 3,
								),
								'preview_js'  => array(
									'custom' => "jQuery( '.custom-logo' ).css( 'max-height', to + 'px' );",
								),
							),



						/**
						 * Theme credits
						 */
						'0' . 90 . 'placeholder' => array(
							'id'                   => 'placeholder',
							'type'                 => 'section',
							'create_section'       => '',
							'in_panel'             => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
							'in_panel-description' => '<h3>' . esc_html__( 'Theme Credits', 'reykjavik' ) . '</h3>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( '%1$s is a WordPress theme developed by %2$s.', '1: linked theme name, 2: theme author name.', 'reykjavik' ),
									'<a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'ThemeURI' ) ) . '"><strong>' . esc_html( wp_get_theme( 'reykjavik' )->get( 'Name' ) ) . '</strong></a>',
									'<strong>' . esc_html( wp_get_theme( 'reykjavik' )->get( 'Author' ) ) . '</strong>'
								)
								. '</p>'
								. '<p class="description">'
								. sprintf(
									esc_html_x( 'You can obtain other professional WordPress themes at %s.', '%s: theme author link.', 'reykjavik' ),
									'<strong><a href="' . esc_url( wp_get_theme( 'reykjavik' )->get( 'AuthorURI' ) ) . '">' . esc_html( str_replace( 'http://', '', untrailingslashit( wp_get_theme( 'reykjavik' )->get( 'AuthorURI' ) ) ) ) . '</a></strong>'
								)
								. '</p>'
								. '<p class="description">'
								. esc_html__( 'Thank you for using a theme by WebMan Design!', 'reykjavik' )
								. '</p>',
						),



						/**
						 * Colors: Accents and predefined colors
						 *
						 * Don't use `preview_js` here as these colors affect too many elements.
						 */
						100 . 'colors' . 10 => array(
							'id'             => 'colors-accents',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'reykjavik' ), esc_html_x( 'Accents', 'Customizer color section title', 'reykjavik' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Accent colors
							 */

								100 . 'colors' . 10 . 100 => array(
									'type'    => 'html',
									'content' => '<p class="description">' . esc_html__( 'These colors affect links, buttons and other elements.', 'reykjavik' ) . '</p>',
								),

								100 . 'colors' . 10 . 200 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Primary accent color', 'reykjavik' ) . '</h3>',
								),

									100 . 'colors' . 10 . 210 => array(
										'type'    => 'color',
										'id'      => 'color_accent',
										'label'   => esc_html__( 'Accent color', 'reykjavik' ),
										'default' => '#273a7d',
									),
									100 . 'colors' . 10 . 220 => array(
										'type'        => 'color',
										'id'          => 'color_accent_text',
										'label'       => esc_html__( 'Accent text color', 'reykjavik' ),
										'description' => esc_html__( 'Color of text on accent color background.', 'reykjavik' ),
										'default'     => '#fefeff',
									),



						/**
						 * Colors: Header
						 */
						100 . 'colors' . 20 => array(
							'id'             => 'colors-header',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'reykjavik' ), esc_html_x( 'Header', 'Customizer color section title', 'reykjavik' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Header colors
							 */

								100 . 'colors' . 20 . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Header', 'reykjavik' ) . '</h3>',
								),

									100 . 'colors' . 20 . 110 => array(
										'type'        => 'color',
										'id'          => 'color_header_background',
										'label'       => esc_html__( 'Background color', 'reykjavik' ),
										'description' => esc_html__( 'This color is also used to style a mobile device browser address bar.', 'reykjavik' ) . ' <a href="https://wordpress.org/plugins/chrome-theme-color-changer/">' . esc_html__( 'You can further customize it with a dedicated plugin.', 'reykjavik' ) . '</a>',
										'default'     => '#fefeff',
										'preview_js'  => array(
											'css' => array(

												'.site-header-content, ' . self::color_selectors( 'header' ) => array(
													'background-color'
												),
												'.main-navigation-container li ul' => array(
													'selector_before' => '@media only screen and (min-width: 55em) { ',
													'selector_after'  => ' }',
													'background-color',
												),
												'.main-navigation-container' => array(
													'selector_before' => '@media only screen and (max-width: 54.9375em) { ',
													'selector_after'  => ' }',
													'background-color',
												),

											),
										),
									),
									100 . 'colors' . 20 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_header_text',
										'label'      => esc_html__( 'Text color', 'reykjavik' ),
										'default'    => '#535354',
										'preview_js' => array(
											'css' => array(

												'.site-header-content, ' . self::color_selectors( 'header' ) => array(
													'color',
													array(
														'property'         => 'border-color',
														'prefix'           => 'rgba(',
														'suffix'           => ',.' . $alpha[0] . ')',
														'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
													),
												),
												'.main-navigation-container li ul' => array(
													'selector_before' => '@media only screen and (min-width: 55em) { ',
													'selector_after'  => ' }',
													'color',
												),
												'.main-navigation-container' => array(
													'selector_before' => '@media only screen and (max-width: 54.9375em) { ',
													'selector_after'  => ' }',
													'color',
												),

											),
										),
									),
									100 . 'colors' . 20 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_header_headings',
										'label'      => esc_html__( 'Site title (logo) color', 'reykjavik' ),
										'default'    => '#232324',
										'preview_js' => array(
											'css' => array(

												'.site-title, .custom-logo' => array(
													'color',
												),

											),
										),
									),



						/**
						 * Colors: Intro
						 */
						100 . 'colors' . 25 => array(
							'id'             => 'colors-intro',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'reykjavik' ), esc_html_x( 'Intro', 'Customizer color section title', 'reykjavik' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Intro colors
							 */

								100 . 'colors' . 25 . 100 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Intro', 'reykjavik' ) . '</h3>',
									'description' => esc_html__( 'This is a specially styled, main, dominant page title section.', 'reykjavik' ),
								),

									100 . 'colors' . 25 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_intro_background',
										'label'      => esc_html__( 'Background color', 'reykjavik' ),
										'default'    => '#fafafb',
										'preview_js' => array(
											'css' => array(

												'.intro-container, ' . self::color_selectors( 'intro' ) => array(
													'background-color'
												),

											),
										),
									),
									100 . 'colors' . 25 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_intro_text',
										'label'      => esc_html__( 'Text color', 'reykjavik' ),
										'default'    => '#535354',
										'preview_js' => array(
											'css' => array(

												'.intro-container, ' . self::color_selectors( 'intro' ) => array(
													'color',
													array(
														'property'         => 'border-color',
														'prefix'           => 'rgba(',
														'suffix'           => ',.' . $alpha[0] . ')',
														'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
													),
												),

											),
										),
									),
									100 . 'colors' . 25 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_intro_headings',
										'label'      => esc_html__( 'Headings color', 'reykjavik' ),
										'default'    => '#232324',
										'preview_js' => array(
											'css' => array(

												$h_tags . ', @a, @.accent-color' => array(
													'selector_replace' => '.intro-container ',
													'color'
												),

											),
										),
									),



							/**
							 * Intro widgets colors
							 */

								100 . 'colors' . 25 . 500 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Intro widgets', 'reykjavik' ) . '</h3>',
									'description' => esc_html__( 'Please note that this widgets area is displayed only if it contains some widgets.', 'reykjavik' ),
								),

									100 . 'colors' . 25 . 510 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_background',
										'label'      => esc_html__( 'Background color', 'reykjavik' ),
										'default'    => '#0f1732',
										'preview_js' => array(
											'css' => array(

												'.intro-widgets-container, ' . self::color_selectors( 'intro-widgets' ) => array(
													'background-color'
												),

											),
										),
									),
									100 . 'colors' . 25 . 520 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_text',
										'label'      => esc_html__( 'Text color', 'reykjavik' ),
										'default'    => '#d3d3d4',
										'preview_js' => array(
											'css' => array(

												'.intro-widgets-container, ' . self::color_selectors( 'intro-widgets' ) => array(
													'color',
													array(
														'property'         => 'border-color',
														'prefix'           => 'rgba(',
														'suffix'           => ',.' . $alpha[0] . ')',
														'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
													),
												),

											),
										),
									),
									100 . 'colors' . 25 . 530 => array(
										'type'       => 'color',
										'id'         => 'color_intro_widgets_headings',
										'label'      => esc_html__( 'Headings color', 'reykjavik' ),
										'default'    => '#fefeff',
										'preview_js' => array(
											'css' => array(

												$h_tags . ', @a, @.accent-color' => array(
													'selector_replace' => '.intro-widgets-container ',
													'color'
												),

											),
										),
									),



						/**
						 * Colors: Content
						 */
						100 . 'colors' . 30 => array(
							'id'             => 'colors-content',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'reykjavik' ), esc_html_x( 'Content', 'Customizer color section title', 'reykjavik' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Content colors
							 */

								100 . 'colors' . 30 . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Content', 'reykjavik' ) . '</h3>',
								),

									100 . 'colors' . 30 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_content_background',
										'label'      => esc_html__( 'Background color', 'reykjavik' ),
										'default'    => '#fefeff',
										'preview_js' => array(
											'css' => array(

												'.site, .site-content, ' . self::color_selectors( 'content' ) => array(
													'background-color'
												),

											),
										),
									),
									100 . 'colors' . 30 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_content_text',
										'label'      => esc_html__( 'Text color', 'reykjavik' ),
										'default'    => '#535354',
										'preview_js' => array(
											'css' => array(

												'.site, .site-content, ' . self::color_selectors( 'content' ) => array(
													'color',
													array(
														'property'         => 'border-color',
														'prefix'           => 'rgba(',
														'suffix'           => ',.' . $alpha[0] . ')',
														'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
													),
												),

											),
										),
									),
									100 . 'colors' . 30 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_content_headings',
										'label'      => esc_html__( 'Headings color', 'reykjavik' ),
										'default'    => '#232324',
										'preview_js' => array(
											'css' => array(

												$h_tags . ', .post-navigation, .dropcap-text::first-letter' => array(
													'selector_replace' => '',
													'color'
												),

											),
										),
									),



						/**
						 * Colors: Footer
						 */
						100 . 'colors' . 40 => array(
							'id'             => 'colors-footer',
							'type'           => 'section',
							'create_section' => sprintf( esc_html_x( 'Colors: %s', '%s = section name. Customizer section title.', 'reykjavik' ), esc_html_x( 'Footer', 'Customizer color section title', 'reykjavik' ) ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Footer colors
							 */

								100 . 'colors' . 40 . 100 => array(
									'type'        => 'html',
									'content'     => '<h3>' . esc_html__( 'Footer', 'reykjavik' ) . '</h3>',
									'description' => esc_html__( 'The main footer widgets area is displayed only if it contains some widgets.', 'reykjavik' ),
								),

									100 . 'colors' . 40 . 110 => array(
										'type'       => 'color',
										'id'         => 'color_footer_background',
										'label'      => esc_html__( 'Background color', 'reykjavik' ),
										'default'    => '#0f1732',
										'preview_js' => array(
											'css' => array(

												'.site-footer, ' . self::color_selectors( 'footer' ) => array(
													'background-color'
												),
												'.site-footer mark, .site-footer .highlight, .site-footer .pagination .current, .site-footer .bypostauthor > .comment-body .comment-author::before, .site-footer .widget_calendar tbody a, .site-footer .widget .tagcloud a:hover, .site-footer .widget .tagcloud a:focus, .site-footer .widget .tagcloud a:active' => array(
													'color'
												),
												'.site-footer .button:hover, .site-footer .button:focus, .site-footer .button:active, .site-footer button:hover, .site-footer button:focus, .site-footer button:active, .site-footer [type="button"]:hover, .site-footer [type="button"]:focus, .site-footer [type="button"]:active, .site-footer [type="reset"]:hover, .site-footer [type="reset"]:focus, .site-footer [type="reset"]:active, .site-footer [type="submit"]:hover, .site-footer [type="submit"]:focus, .site-footer [type="submit"]:active' => array(
													'color'
												),

											),
										),
									),
									100 . 'colors' . 40 . 120 => array(
										'type'       => 'color',
										'id'         => 'color_footer_text',
										'label'      => esc_html__( 'Text color', 'reykjavik' ),
										'default'    => '#d3d3d4',
										'preview_js' => array(
											'css' => array(

												'.site-footer, ' . self::color_selectors( 'footer' ) => array(
													'color',
													array(
														'property'         => 'border-color',
														'prefix'           => 'rgba(',
														'suffix'           => ',.' . $alpha[0] . ')',
														'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
													),
												),

											),
										),
									),
									100 . 'colors' . 40 . 130 => array(
										'type'       => 'color',
										'id'         => 'color_footer_headings',
										'label'      => esc_html__( 'Headings color', 'reykjavik' ),
										'default'    => '#fefeff',
										'preview_js' => array(
											'css' => array(

												$h_tags . ', @a, @.accent-color' => array(
													'selector_replace' => '.site-footer ',
													'color'
												),
												'.site-footer mark, .site-footer .highlight, .site-footer .pagination .current, .site-footer .bypostauthor > .comment-body .comment-author::before, .site-footer .widget_calendar tbody a, .site-footer .widget .tagcloud a:hover, .site-footer .widget .tagcloud a:focus, .site-footer .widget .tagcloud a:active' => array(
													'background-color'
												),
												'.site-footer .button:hover, .site-footer .button:focus, .site-footer .button:active, .site-footer button:hover, .site-footer button:focus, .site-footer button:active, .site-footer [type="button"]:hover, .site-footer [type="button"]:focus, .site-footer [type="button"]:active, .site-footer [type="reset"]:hover, .site-footer [type="reset"]:focus, .site-footer [type="reset"]:active, .site-footer [type="submit"]:hover, .site-footer [type="submit"]:focus, .site-footer [type="submit"]:active' => array(
													'background-color'
												),

											),
										),
									),

									100 . 'colors' . 40 . 140 => array(
										'type'                => 'image',
										'id'                  => 'footer_image',
										'label'               => esc_html__( 'Background image', 'reykjavik' ),
										'default'             => trailingslashit( get_template_directory_uri() ) . 'assets/images/footer/pixabay-colorado-1436681.png',
										'is_background_image' => true,
										'is_css_condition'    => true,
										'preview_js'          => array(
											'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' );",
											'css'    => array(

												'.site-footer::before' => array(
													array(
														'property' => 'background-image',
														'prefix'   => 'url("',
														'suffix'   => '")',
													),
												),

											),
										),
									),
										100 . 'colors' . 40 . 141 => array(
											'type'    => 'select',
											'id'      => 'footer_image_position',
											'label'   => esc_html__( 'Image position', 'reykjavik' ),
											'default' => '50% 50%',
											'choices' => array(

												'0 0'    => esc_html_x( 'Top left', 'Image position.', 'reykjavik' ),
												'50% 0'  => esc_html_x( 'Top center', 'Image position.', 'reykjavik' ),
												'100% 0' => esc_html_x( 'Top right', 'Image position.', 'reykjavik' ),

												'0 50%'    => esc_html_x( 'Center left', 'Image position.', 'reykjavik' ),
												'50% 50%'  => esc_html_x( 'Center', 'Image position.', 'reykjavik' ),
												'100% 50%' => esc_html_x( 'Center right', 'Image position.', 'reykjavik' ),

												'0 100%'    => esc_html_x( 'Bottom left', 'Image position.', 'reykjavik' ),
												'50% 100%'  => esc_html_x( 'Bottom center', 'Image position.', 'reykjavik' ),
												'100% 100%' => esc_html_x( 'Bottom right', 'Image position.', 'reykjavik' ),

											),
											'preview_js' => array(
												'css' => array(

													'.site-footer::before' => array(
														'background-position'
													),

												),
											),
										),
										100 . 'colors' . 40 . 142 => array(
											'type'    => 'select',
											'id'      => 'footer_image_size',
											'label'   => esc_html__( 'Image size', 'reykjavik' ),
											'default' => 'cover',
											'choices' => array(
												'auto'    => esc_html_x( 'Original', 'Image size.', 'reykjavik' ),
												'contain' => esc_html_x( 'Fit', 'Image size.', 'reykjavik' ),
												'cover'   => esc_html_x( 'Fill', 'Image size.', 'reykjavik' ),
											),
											'preview_js' => array(
												'css' => array(

													'.site-footer::before' => array(
														'background-size'
													),

												),
											),
										),
										100 . 'colors' . 40 . 143 => array(
											'type'             => 'checkbox',
											'id'               => 'footer_image_repeat',
											'label'            => esc_html__( 'Tile the image', 'reykjavik' ),
											'default'          => true,
											'is_css_condition' => true,
											'preview_js'       => array(
												'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-repeat', ( to ) ? ( 'no-repeat' ) : ( 'repeat' ) );",
											),
										),
										100 . 'colors' . 40 . 144 => array(
											'type'             => 'checkbox',
											'id'               => 'footer_image_attachment',
											'label'            => esc_html__( 'Fix image position', 'reykjavik' ),
											'default'          => false,
											'is_css_condition' => true,
											'preview_js'       => array(
												'custom' => "jQuery( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-attachment', ( to ) ? ( 'fixed' ) : ( 'scroll' ) );",
											),
										),
										100 . 'colors' . 40 . 145 => array(
											'type'       => 'range',
											'id'         => 'footer_image_opacity',
											'label'      => esc_html__( 'Background image opacity', 'reykjavik' ),
											'default'    => .15,
											'min'        => .05,
											'max'        => 1,
											'step'       => .05,
											'multiplier' => 100,
											'suffix'     => '%',
											'validate'   => 'Reykjavik_Library_Sanitize::float',
											'preview_js' => array(
												'css' => array(

													'.site-footer::before' => array(
														'opacity'
													),

												),
											),
										),



						/**
						 * Layout
						 */
						300 . 'layout' => array(
							'id'             => 'layout',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Layout', 'Customizer section title.', 'reykjavik' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),



							/**
							 * Site layout
							 */

								300 . 'layout' . 100 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html_x( 'Site Container', 'A website container.', 'reykjavik' ) . '</h3>',
								),

									300 . 'layout' . 110 => array(
										'type'    => 'radio',
										'id'      => 'layout_site',
										'label'   => esc_html__( 'Website layout', 'reykjavik' ),
										'default' => 'fullwidth',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'reykjavik' ),
											'boxed'     => esc_html__( 'Boxed', 'reykjavik' ),
										),
										// No need for `preview_js` here as it won't trigger the `active_callback` below.
									),

									300 . 'layout' . 120 => array(
										'type'        => 'range',
										'id'          => 'layout_width_site',
										'label'       => esc_html__( 'Website max width', 'reykjavik' ),
										'description' => esc_html__( 'For boxed website layout.', 'reykjavik' ) . '<br />' . sprintf( esc_html__( 'Default value: %s', 'reykjavik' ), number_format_i18n( 1640 ) ),
										'default'     => 1640,
										'min'         => 1000,
										'max'         => 1920,
										'step'        => 20,
										'suffix'      => 'px',
										'preview_js'  => array(
											'css' => array(

												'.site-layout-boxed .site' => array(
													array(
														'property' => 'max-width',
														'suffix'   => 'px',
													),
												),

											),
										),
										'active_callback' => __CLASS__ . '::is_layout_site_boxed',
									),
									300 . 'layout' . 130 => array(
										'type'        => 'range',
										'id'          => 'layout_width_content',
										'label'       => esc_html__( 'Content width', 'reykjavik' ),
										'description' => sprintf( esc_html__( 'Default value: %s', 'reykjavik' ), number_format_i18n( 1200 ) ),
										'default'     => 1200,
										'min'         => 880,
										'max'         => 1620, // cca ( 1920 x 96% ) x 88%
										'step'        => 20,
										'suffix'      => 'px',
										'preview_js'  => array(
											'css' => array(

												implode( ', ', array(
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
												) ) => array(
													array(
														'property' => 'max-width',
														'suffix'   => 'px',
													),
												),

												implode( ', ', array(
													// $content_width * $golden_major
													'.fl-builder div.sharedaddy',
													'.content-layout-no-paddings div.sharedaddy',
													'.fl-builder .entry-author',
													'.content-layout-no-paddings .entry-author',
												) ) => array(
													array(
														'property' => 'max-width',
														'prefix'   => 'calc(.62*',
														'suffix'   => 'px) !important',
													),
												),

											),
										),
									),



							/**
							 * Header layout
							 */

								300 . 'layout' . 200 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Header', 'reykjavik' ) . '</h3>',
								),

									300 . 'layout' . 210 => array(
										'type'    => 'radio',
										'id'      => 'layout_header',
										'label'   => esc_html__( 'Header layout', 'reykjavik' ),
										'default' => 'fullwidth',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'reykjavik' ),
											'boxed'     => esc_html__( 'Boxed', 'reykjavik' ),
										),
										'preview_js'  => array(
											'custom' => "jQuery( 'body' ).toggleClass( 'header-layout-boxed' ).toggleClass( 'header-layout-fullwidth' );",
										),
									),



							/**
							 * Intro layout
							 */

								300 . 'layout' . 300 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Intro', 'reykjavik' ) . '</h3>',
								),

									300 . 'layout' . 310 => array(
										'type'        => 'radio',
										'id'          => 'layout_intro_widgets_display',
										'label'       => esc_html__( 'Enable intro widgets', 'reykjavik' ),
										'description' => sprintf( esc_html_x( 'If you enable this widget area also for archives, we recommend using %s plugin to control its appearance further more.', '%s: Linked plugin name.', 'reykjavik' ), '<a href="https://wordpress.org/plugins/woosidebars/">WooSidebars</a>' ),
										'default'     => '',
										'choices'     => array(
											''       => esc_html__( 'On singular pages only', 'reykjavik' ),
											'always' => esc_html__( 'On both archive and singular pages', 'reykjavik' ),
										),
									),



							/**
							 * Content layout
							 */

								300 . 'layout' . 400 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Content', 'reykjavik' ) . '</h3>',
								),

									300 . 'layout' . 410 => array(
										'type'        => 'checkbox',
										'id'          => 'layout_page_outdent',
										'label'       => esc_html__( 'Outdent page content', 'reykjavik' ),
										'description' => esc_html__( 'Page content will be displayed in 2 columns: H2 headings in first, all the other page content in second column.', 'reykjavik' ) . ' ' . esc_html__( 'This does not affect pages using "With sidebar" page template.', 'reykjavik' ),
										'default'     => true,
										'preview_js'  => array(
											'custom' => "jQuery( 'body.page:not(.page-template-sidebar)' ).toggleClass( 'page-layout-outdented' );",
										),
									),



							/**
							 * Footer layout
							 */

								300 . 'layout' . 500 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Footer', 'reykjavik' ) . '</h3>',
								),

									300 . 'layout' . 510 => array(
										'type'    => 'radio',
										'id'      => 'layout_footer',
										'label'   => esc_html__( 'Footer layout', 'reykjavik' ),
										'default' => 'boxed',
										'choices' => array(
											'fullwidth' => esc_html__( 'Fullwidth', 'reykjavik' ),
											'boxed'     => esc_html__( 'Boxed', 'reykjavik' ),
										),
										'preview_js'  => array(
											'custom' => "jQuery( 'body' ).toggleClass( 'footer-layout-boxed' ).toggleClass( 'footer-layout-fullwidth' );",
										),
									),



						/**
						 * Texts
						 *
						 * Don't use `preview_js` here as it outputs escaped HTML.
						 */
						800 . 'texts' => array(
							'id'             => 'texts',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Texts', 'Customizer section title.', 'reykjavik' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),

							800 . 'texts' . 500 => array(
								'type'        => 'textarea',
								'id'          => 'texts_site_info',
								'label'       => esc_html__( 'Footer credits (copyright)', 'reykjavik' ),
								'description' => sprintf( esc_html__( 'Set %s to disable this area.', 'reykjavik' ), '<code>-</code>' ) . ' ' . esc_html__( 'Leaving the field empty will fall back to default theme setting.', 'reykjavik' ) . ' ' . sprintf( esc_html__( 'You can use %s to display dynamic, always current year.', 'reykjavik' ), '<code>[year]</code>' ),
								'default'     => '',
								'validate'    => 'wp_kses_post',
								'preview_js'  => array(
									'custom' => "jQuery( '.site-info' ).html( to ); if ( '-' === to ) { jQuery( '.footer-area-site-info' ).hide(); } else { jQuery( '.footer-area-site-info:hidden' ).show(); }",
								),
							),



						/**
						 * Typography
						 */
						900 . 'typography' => array(
							'id'             => 'typography',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Typography', 'Customizer section title.', 'reykjavik' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),

							900 . 'typography' . 100 => array(
								'type'        => 'range',
								'id'          => 'typography_size_html',
								'label'       => esc_html__( 'Basic font size in px', 'reykjavik' ),
								'description' => esc_html__( 'All other font sizes are calculated automatically from this basic font size.', 'reykjavik' ),
								'default'     => 18,
								'min'         => 12,
								'max'         => 24,
								'step'        => 1,
								'suffix'      => 'px',
								'validate'    => 'absint',
								'preview_js'  => array(
									'css' => array(

										'html' => array(
											array(
												'property' => 'font-size',
												'suffix'   => 'px',
											),
										),

									),
								),
							),

							900 . 'typography' . 200 => array(
								'type'             => 'checkbox',
								'id'               => 'typography_custom_fonts',
								'label'            => esc_html__( 'Use custom fonts', 'reykjavik' ),
								'default'          => false,
								'is_css_condition' => true,
							),

								900 . 'typography' . 210 => array(
									'type'    => 'html',
									'content' => '<h3>' . esc_html__( 'Custom fonts setup', 'reykjavik' ) . '</h3><p class="description">' . sprintf(
											esc_html_x( 'This theme does not restrict you to choose from a predefined set of fonts. Instead, please use any font service (such as %s) plugin you like.', '%s: linked examples of web fonts libraries such as Google Fonts or Adobe Typekit.', 'reykjavik' ),
											'<a href="http://www.google.com/fonts"><strong>Google Fonts</strong></a>, <a href="https://typekit.com/fonts"><strong>Adobe Typekit</strong></a>'
										) . '</p><p class="description">' . esc_html__( 'You can set your fonts plugin according to information provided below, or insert your custom font names (a value of "font-family" CSS property) directly into input fields (you still need to use a plugin to load those fonts on the website).', 'reykjavik' ) . '</p>',
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
								),

								900 . 'typography' . 220 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_text',
									'label'           => esc_html__( 'General text font', 'reykjavik' ),
									'default'         => "'Open Sans', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Open Sans', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Reykjavik_Library_Sanitize::fonts',
								),

								900 . 'typography' . 230 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_headings',
									'label'           => esc_html__( 'Headings font', 'reykjavik' ),
									'default'         => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Reykjavik_Library_Sanitize::fonts',
								),

								900 . 'typography' . 240 => array(
									'type'            => 'text',
									'id'              => 'typography_fonts_logo',
									'label'           => esc_html__( 'Logo font', 'reykjavik' ),
									'default'         => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
									'input_attrs'     => array(
										'placeholder' => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
									),
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
									'validate'        => 'Reykjavik_Library_Sanitize::fonts',
								),

								900 . 'typography' . 290 => array(
									'type'            => 'html',
									'content'         => '<h3>' . esc_html__( 'Info: CSS selectors', 'reykjavik' ) . '</h3>'
										. '<p class="description">' . esc_html__( 'Here you can find CSS selectors list associated with each font group in the theme. You can use these in your custom font plugin settings.', 'reykjavik' ) . '</p>'

										. '<p>'
										. '<strong>' . esc_html__( 'General text font CSS selectors:', 'reykjavik' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. implode( ', ', array(
												'html',
												'.site .font-body',
											) )
										. '</pre>'

										. '<p>'
										. '<strong>' . esc_html__( 'Headings font CSS selectors:', 'reykjavik' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. implode( ', ', array(
												'.site .font-headings',
												'.site .font-headings-primary',

												'h1, .h1',
												'h2, .h2',
												'h3, .h3',
												'h4, .h4',
												'h5, .h5',
												'h6, .h6',
											) )
										. '</pre>'

										. '<p>'
										. '<strong>' . esc_html__( 'Logo font CSS selectors:', 'reykjavik' ) . '</strong>'
										. '</p>'
										. '<pre>'
										. implode( ', ', array(
												'.site-title',
												'.site .font-logo',
												'.site .font-headings-secondary',

												'h1.display-1',
												'h1.display-2',
												'h1.display-3',
												'h1.display-4',

												'h2.display-1',
												'h2.display-2',
												'h2.display-3',
												'h2.display-4',

												'h3.display-1',
												'h3.display-2',
												'h3.display-3',
												'h3.display-4',

												'.h1.display-1',
												'.h1.display-2',
												'.h1.display-3',
												'.h1.display-4',

												'.h2.display-1',
												'.h2.display-2',
												'.h2.display-3',
												'.h2.display-4',

												'.h3.display-1',
												'.h3.display-2',
												'.h3.display-3',
												'.h3.display-4',
											) )
										. '</pre>',
									'active_callback' => __CLASS__ . '::is_typography_custom_fonts',
								),



						/**
						 * Others
						 */
						950 . 'others' => array(
							'id'             => 'others',
							'type'           => 'section',
							'create_section' => esc_html_x( 'Others', 'Customizer section title.', 'reykjavik' ),
							'in_panel'       => esc_html_x( 'Theme Options', 'Customizer panel title.', 'reykjavik' ),
						),

							950 . 'others' . 100 => array(
								'type'        => 'checkbox',
								'id'          => 'admin_welcome_page',
								'label'       => esc_html__( 'Show "Welcome" page', 'reykjavik' ),
								'description' => esc_html__( 'Under "Appearance" WordPress dashboard menu.', 'reykjavik' ),
								'default'     => true,
								'preview_js'  => false, // This is to prevent customizer preview reload
							),

							950 . 'others' . 110 => array(
								'type'        => 'checkbox',
								'id'          => 'navigation_mobile',
								'label'       => esc_html__( 'Enable mobile navigation', 'reykjavik' ),
								'description' => esc_html__( 'If your website navigation is very simple and you do not want to use the mobile navigation functionality, you can disable it here.', 'reykjavik' ),
								'default'     => true,
							),

							950 . 'others' . 120 => array(
								'type'    => 'multicheckbox',
								'id'      => 'archive_title_prefix',
								'label'   => esc_html__( 'Archive page title prefix', 'reykjavik' ),
								'default' => array( 'category', 'tag', 'author' ),
								'choices' => array(
									'category'  => esc_html__( 'Display "Category:" prefix', 'reykjavik' ),
									'tag'       => esc_html__( 'Display "Tag:" prefix', 'reykjavik' ),
									'author'    => esc_html__( 'Display "Author:" prefix', 'reykjavik' ),
									'post-type' => esc_html__( 'Display "Archives:" prefix', 'reykjavik' ),
									'taxonomy'  => esc_html__( 'Display "Taxonomy:" prefix', 'reykjavik' ),
								),
								// No need for `preview_js` as we really need to refresh the page to apply changes.
							),



					);


			// Output

				return $options;

		} // /options





	/**
	 * 20) Replacements
	 */

		/**
		 * CSS generator replacements
		 *
		 * You can also use a `SLASH**if(option_id)` and `endif(option_id)**SLASH`
		 * conditional CSS replacements. These CSS comments will get uncommented
		 * once there is a value set to `option_id`.
		 * (Don't forget to replace `SLASH` with `/` above when used in CSS.)
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $replacements
		 */
		public static function css_replacements( $replacements = array() ) {

			// Processing

				$replacements = array(
						'/*[*/'                            => '/** ', // Open a comment
						'/*]*/'                            => ' **/', // Close a comment
						'/*//'                             => '', // Remove a comment opening
						'//*/'                             => '', // Remove a comment closing
						'[[get_template_directory]]'       => untrailingslashit( get_template_directory() ),
						'[[get_stylesheet_directory]]'     => untrailingslashit( get_stylesheet_directory() ),
						'[[get_template_directory_uri]]'   => untrailingslashit( get_template_directory_uri() ),
						'[[get_stylesheet_directory_uri]]' => untrailingslashit( get_stylesheet_directory_uri() ),
					);


			// Output

				return $replacements;

		} // /css_replacements





	/**
	 * 30) Active callbacks
	 */

		/**
		 * Is site layout: Boxed?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_layout_site_boxed( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'layout_site' );


			// Output

				return ( 'boxed' == $option->value() );

		} // /is_layout_site_boxed



		/**
		 * Do you want to use custom fonts?
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $control
		 */
		public static function is_typography_custom_fonts( $control ) {

			// Helper variables

				$option = $control->manager->get_setting( 'typography_custom_fonts' );


			// Output

				return (bool) $option->value();

		} // /is_typography_custom_fonts





	/**
	 * 40) Partial refresh
	 */

		/**
		 * Render the site title for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_blogname() {

			// Output

				bloginfo( 'name' );

		} // /partial_blogname



		/**
		 * Render the site tagline for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_blogdescription() {

			// Output

				bloginfo( 'description' );

		} // /partial_blogdescription



		/**
		 * Render the site info in the footer for the selective refresh partial
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 */
		public static function partial_texts_site_info() {

			// Helper variables

				$site_info_text = trim( get_theme_mod( 'texts_site_info' ) );


			// Output

				if ( empty( $site_info_text ) ) {
					esc_html_e( 'Please set your website credits text or the theme default one will be displayed.', 'reykjavik' );
				} else {
					echo (string) $site_info_text;
				}

		} // /partial_texts_site_info





	/**
	 * 100) Helpers
	 */

		/**
		 * Alpha values (%) for generating rgba() colors
		 *
		 * Values taken from `assets/scss/_setup.scss` file's `$border_opacity_from_text` variable.
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  array $alphas
		 */
		public static function rgba_alphas( $alphas = array() ) {

			// Output

				return array( 20 );

		} // /rgba_alphas



		/**
		 * Get special color class selectors
		 *
		 * @since    1.0.0
		 * @version  1.0.0
		 *
		 * @param  string $context
		 */
		public static function color_selectors( $context = '' ) {

			// Pre

				$pre = apply_filters( 'wmhook_reykjavik_customize_color_selectors_pre', false );

				if ( false !== $pre ) {
					return $pre;
				}


			// Helper variables

				$output  = array();
				$context = sanitize_html_class( trim( (string) $context ) );


			// Requirements check

				if ( empty( $context ) ) {
					return;
				}


			// Processing

				$output[] = '.set-colors-' . $context;
				$output[] = '.set-colors-' . $context . ' > .fl-row-content-wrap';
				$output[] = '.set-colors-' . $context . ' > .fl-col-content';


			// Output

				return implode( ', ', $output );

		} // /color_selectors





} // /Reykjavik_Customize

add_action( 'after_setup_theme', 'Reykjavik_Customize::init' );
