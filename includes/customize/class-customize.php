<?php
/**
 * Theme Customization Class
 *
 * @package    Reykjavik
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0.0
 * @version  2.0.0
 *
 * Contents:
 *
 *   0) Init
 *  10) Options
 *  20) Active callbacks
 *  30) Partial refresh
 * 100) Helpers
 */
class Reykjavik_Customize {





	/**
	 * 0) Init
	 */

		private static $instance;

		/**
		 * Theme colors cache transient name.
		 */
		public static $cache_colors = 'reykjavik_cache_theme_colors';



		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 * @version  2.0.0
		 */
		private function __construct() {

			// Processing

				// Setup

					// Indicate widget sidebars can use selective refresh in the Customizer
					add_theme_support( 'customize-selective-refresh-widgets' );

				// Hooks

					// Actions

						add_action( 'customize_register', __CLASS__ . '::setup' );

						add_action( 'customize_save_after', __CLASS__ . '::theme_colors_cache_flush', 100 );

					// Filters

						add_filter( 'wmhook_reykjavik_theme_options', __CLASS__ . '::options', 5 );

						add_filter( 'wmhook_reykjavik_customize_get_rgba_alphas', __CLASS__ . '::rgba_alphas' );
						add_filter( 'wmhook_reykjavik_theme_options', __CLASS__ . '::customize_preview_rgba', 100 );
						add_filter( 'wmhook_reykjavik_library_css_variables_get_variables_array_per_option', __CLASS__ . '::css_vars_rgba', 10, 3 );

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
		 * @version  1.4.0
		 *
		 * @param  object $wp_customize  WP customizer object.
		 */
		public static function setup( $wp_customize ) {

			// Processing

				// Remove header color in favor of theme options.
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
		 * @version  2.0.0
		 *
		 * @param  array $options
		 */
		public static function options( $options = array() ) {

			// Processing

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
							'section'           => 'title_tagline',
							'priority'          => 102,
							'type'              => 'text',
							'id'                => 'custom_logo_height',
							'label'             => esc_html__( 'Max logo image height (px)', 'reykjavik' ),
							'default'           => 50,
							'sanitize_callback' => 'absint',
							'input_attrs'       => array(
								'size'     => 5,
								'maxwidth' => 3,
							),
							'css_var'           => 'Reykjavik_Library_Sanitize::css_pixels',
							'preview_js'        => array(
								'css' => array(
									':root' => array(
										array(
											'property' => '--[[id]]',
											'suffix'   => 'px',
										),
									),
								),
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
									'type'       => 'color',
									'id'         => 'color_accent',
									'label'      => esc_html__( 'Accent color', 'reykjavik' ),
									'default'    => '#273a7d',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 10 . 220 => array(
									'type'        => 'color',
									'id'          => 'color_accent_text',
									'label'       => esc_html__( 'Accent text color', 'reykjavik' ),
									'description' => esc_html__( 'Color of text on accent color background.', 'reykjavik' ),
									'default'     => '#fefeff',
									'css_var'     => 'maybe_hash_hex_color',
									'preview_js'  => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
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
									'palette'     => array( 'name' => __( 'Header background color', 'reykjavik' ) ),
									'description' => esc_html__( 'This color is also used to style a mobile device browser address bar.', 'reykjavik' ) . ' <a href="https://wordpress.org/plugins/chrome-theme-color-changer/">' . esc_html__( 'You can further customize it with a dedicated plugin.', 'reykjavik' ) . '</a>',
									'default'     => '#fefeff',
									'css_var'     => 'maybe_hash_hex_color',
									'preview_js'  => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 20 . 120 => array(
									'type'       => 'color',
									'id'         => 'color_header_text',
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Header text color', 'reykjavik' ) ),
									'default'    => '#535354',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 20 . 130 => array(
									'type'       => 'color',
									'id'         => 'color_header_headings',
									'label'      => esc_html__( 'Site title (logo) color', 'reykjavik' ),
									'default'    => '#232324',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
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
									'palette'    => array( 'name' => __( 'Intro background color', 'reykjavik' ) ),
									'default'    => '#fafafb',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 25 . 120 => array(
									'type'       => 'color',
									'id'         => 'color_intro_text',
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Intro text color', 'reykjavik' ) ),
									'default'    => '#535354',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 25 . 130 => array(
									'type'       => 'color',
									'id'         => 'color_intro_headings',
									'label'      => esc_html__( 'Headings color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Intro headings color', 'reykjavik' ) ),
									'default'    => '#232324',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),



						/**
						 * Special Intro colors
						 */

							100 . 'colors' . 25 . 200 => array(
								'type'        => 'html',
								'content'     => '<h3>' . esc_html__( 'Intro overlay', 'reykjavik' ) . '</h3>',
								'description' => esc_html__( 'Intro overlay is displayed on homepage only.', 'reykjavik' ),
							),

								100 . 'colors' . 25 . 210 => array(
									'type'       => 'color',
									'id'         => 'color_intro_overlay_background',
									'label'      => esc_html__( 'Background color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Intro overlay background color', 'reykjavik' ) ),
									'default'    => '#0f1732',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
								),
								100 . 'colors' . 25 . 220 => array(
									'type'       => 'color',
									'id'         => 'color_intro_overlay_text',
									'palette'    => array( 'name' => __( 'Intro overlay text color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'default'    => '#fefeff',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
								),
								100 . 'colors' . 25 . 230 => array(
									'type'              => 'range',
									'id'                => 'color_intro_overlay_opacity',
									'label'             => esc_html__( 'Overlay opacity', 'reykjavik' ),
									'default'           => .60,
									'min'               => .05,
									'max'               => .95,
									'step'              => .05,
									'multiplier'        => 100,
									'suffix'            => '%',
									'sanitize_callback' => 'Reykjavik_Library_Sanitize::float',
									'css_var'           => 'floatval',
									'preview_js'        => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
									'active_callback' => 'is_front_page',
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
									'palette'    => array( 'name' => __( 'Intro widgets background color', 'reykjavik' ) ),
									'default'    => '#0f1732',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 25 . 520 => array(
									'type'       => 'color',
									'id'         => 'color_intro_widgets_text',
									'palette'    => array( 'name' => __( 'Intro widgets text color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'default'    => '#d3d3d4',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 25 . 530 => array(
									'type'       => 'color',
									'id'         => 'color_intro_widgets_headings',
									'palette'    => array( 'name' => __( 'Intro widgets headings color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Headings color', 'reykjavik' ),
									'default'    => '#fefeff',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
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
									'palette'    => array( 'name' => __( 'Content background color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Background color', 'reykjavik' ),
									'default'    => '#fefeff',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 30 . 120 => array(
									'type'       => 'color',
									'id'         => 'color_content_text',
									'palette'    => array( 'name' => __( 'Content text color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'default'    => '#535354',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 30 . 130 => array(
									'type'       => 'color',
									'id'         => 'color_content_headings',
									'palette'    => array( 'name' => __( 'Content headings color', 'reykjavik' ) ),
									'label'      => esc_html__( 'Headings color', 'reykjavik' ),
									'default'    => '#232324',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
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
									'palette'    => array( 'name' => __( 'Footer background color', 'reykjavik' ) ),
									'default'    => '#0f1732',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 40 . 120 => array(
									'type'       => 'color',
									'id'         => 'color_footer_text',
									'label'      => esc_html__( 'Text color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Footer text color', 'reykjavik' ) ),
									'default'    => '#d3d3d4',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),
								100 . 'colors' . 40 . 130 => array(
									'type'       => 'color',
									'id'         => 'color_footer_headings',
									'label'      => esc_html__( 'Headings color', 'reykjavik' ),
									'palette'    => array( 'name' => __( 'Footer headings color', 'reykjavik' ) ),
									'default'    => '#fefeff',
									'css_var'    => 'maybe_hash_hex_color',
									'preview_js' => array(
										'css' => array(
											':root' => array(
												'--[[id]]',
											),
										),
									),
								),

								100 . 'colors' . 40 . 140 => array(
									'type'       => 'image',
									'id'         => 'footer_image',
									'label'      => esc_html__( 'Background image', 'reykjavik' ),
									'default'    => trailingslashit( get_template_directory_uri() ) . 'assets/images/footer/pixabay-colorado-1436681.png',
									'css_var'    => 'Reykjavik_Library_Sanitize::css_image_url',
									'preview_js' => array(
										'custom' => "$( '.site-footer' ).addClass( 'is-customize-preview' );",
										'css'    => array(
											':root' => array(
												array(
													'property' => '--[[id]]',
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
										'css_var'    => 'esc_attr',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
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
										'css_var'    => 'esc_attr',
										'preview_js' => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
												),
											),
										),
									),
									100 . 'colors' . 40 . 143 => array(
										'type'       => 'checkbox',
										'id'         => 'footer_image_repeat',
										'label'      => esc_html__( 'Tile the image', 'reykjavik' ),
										'default'    => true,
										'css_var'    => 'Reykjavik_Library_Sanitize::css_checkbox_background_repeat',
										'preview_js' => array(
											'custom' => "$( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-repeat', ( to ) ? ( 'no-repeat' ) : ( 'repeat' ) );",
										),
									),
									100 . 'colors' . 40 . 144 => array(
										'type'       => 'checkbox',
										'id'         => 'footer_image_attachment',
										'label'      => esc_html__( 'Fix image position', 'reykjavik' ),
										'default'    => false,
										'css_var'    => 'Reykjavik_Library_Sanitize::css_checkbox_background_attachment',
										'preview_js' => array(
											'custom' => "$( '.site-footer' ).addClass( 'is-customize-preview' ).css( 'background-attachment', ( to ) ? ( 'fixed' ) : ( 'scroll' ) );",
										),
									),
									100 . 'colors' . 40 . 145 => array(
										'type'              => 'range',
										'id'                => 'footer_image_opacity',
										'label'             => esc_html__( 'Background image opacity', 'reykjavik' ),
										'default'           => .15,
										'min'               => .05,
										'max'               => 1,
										'step'              => .05,
										'multiplier'        => 100,
										'suffix'            => '%',
										'sanitize_callback' => 'Reykjavik_Library_Sanitize::float',
										'css_var'           => 'floatval',
										'preview_js'        => array(
											'css' => array(
												':root' => array(
													'--[[id]]',
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
									'sanitize_callback' => 'absint',
									'css_var'           => 'Reykjavik_Library_Sanitize::css_pixels',
									'preview_js'        => array(
										'css' => array(
											':root' => array(
												array(
													'property' => '--[[id]]',
													'suffix'   => 'px',
												),
											),
										),
									),
									'active_callback' => __CLASS__ . '::is_layout_site_boxed',
								),
								300 . 'layout' . 130 => array(
									'type'              => 'range',
									'id'                => 'layout_width_content',
									'label'             => esc_html__( 'Content width', 'reykjavik' ),
									'description'       => sprintf( esc_html__( 'Default value: %s', 'reykjavik' ), number_format_i18n( 1200 ) )
									                       . '<br>'
									                       . esc_html__( 'This width is applied on archive pages, intro section, or wide blocks&hellip;', 'reykjavik' )
									                       . ' '
									                       . esc_html__( 'But, most of content elements are narrower for better readability.', 'reykjavik' )
									                       . ' '
									                       . esc_html__( 'Use the content editor to adapt their width if needed.', 'reykjavik' ),
									'default'           => 1200,
									'min'               => 880,
									'max'               => 1620, // cca ( 1920 x 96% ) x 88%
									'step'              => 20,
									'suffix'            => 'px',
									'sanitize_callback' => 'absint',
									'css_var'           => 'Reykjavik_Library_Sanitize::css_pixels',
									'preview_js'        => array(
										'css' => array(
											':root' => array(
												array(
													'property' => '--[[id]]',
													'suffix'   => 'px',
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
										'custom' => "$( 'body' ).toggleClass( 'header-layout-boxed' ).toggleClass( 'header-layout-fullwidth' );",
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
									'description' => esc_html__( 'If you enable this widget area also for archives, we recommend using a sidebar management plugin to control its appearance further more.', 'reykjavik' ),
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
									'description' => '<br>'
									                 . '<strong>' . esc_html__( 'Block editor:', 'reykjavik' ) . '</strong>'
									                 . ' '
									                 . esc_html__( 'Does not apply for pages built with block editor.', 'reykjavik' )
									                 . ' '
									                 . esc_html__( 'The layout can be replicated using Columns block.', 'reykjavik' )
									                 . '<br><br>'
									                 . '<a href="https://wordpress.org/plugins/classic-editor/"><strong>' . esc_html__( 'Classic Editor:', 'reykjavik' ) . '</strong></a>'
									                 . ' '
									                 . esc_html__( 'Page content will be displayed in 2 columns: H2 headings in first, all the other content in second column.', 'reykjavik' )
									                 . ' '
									                 . esc_html__( 'Does not apply on "With sidebar" page template.', 'reykjavik' ),
									'default'     => true,
									'preview_js'  => array(
										'custom' => "$( 'body.page:not(.page-template-sidebar)' ).toggleClass( 'page-layout-outdented' );",
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
										'custom' => "$( 'body' ).toggleClass( 'footer-layout-boxed' ).toggleClass( 'footer-layout-fullwidth' );",
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
							'type'              => 'textarea',
							'id'                => 'texts_site_info',
							'label'             => esc_html__( 'Footer credits (copyright)', 'reykjavik' ),
							'description'       => sprintf( esc_html__( 'Set %s to disable this area.', 'reykjavik' ), '<code>-</code>' ) . ' ' . esc_html__( 'Leaving the field empty will fall back to default theme setting.', 'reykjavik' ) . ' ' . sprintf( esc_html__( 'You can use %s to display dynamic, always current year.', 'reykjavik' ), '<code>[year]</code>' ),
							'default'           => '',
							'sanitize_callback' => 'wp_kses_post',
							'preview_js'        => array(
								'custom' => "$( '.site-info' ).html( to ); if ( '-' === to ) { $( '.footer-area-site-info' ).hide(); } else { $( '.footer-area-site-info:hidden' ).show(); }",
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
							'type'              => 'range',
							'id'                => 'typography_size_html',
							'label'             => esc_html__( 'Basic font size in px', 'reykjavik' ),
							'description'       => esc_html__( 'All other font sizes are calculated automatically from this basic font size.', 'reykjavik' ),
							'default'           => 18,
							'min'               => 12,
							'max'               => 24,
							'step'              => 1,
							'suffix'            => 'px',
							'sanitize_callback' => 'absint',
							'css_var'           => 'Reykjavik_Library_Sanitize::css_pixels',
							'preview_js'        => array(
								'css' => array(
									':root' => array(
										array(
											'property' => '--[[id]]',
											'suffix'   => 'px',
										),
									),
								),
							),
						),

						900 . 'typography' . 200 => array(
							'type'        => 'checkbox',
							'id'          => 'typography_custom_fonts',
							'label'       => esc_html__( 'Use custom fonts', 'reykjavik' ),
							'description' => esc_html__( 'Disables theme default fonts loading and lets you set up your own custom fonts.', 'reykjavik' ),
							'default'     => false,
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
								'type'              => 'text',
								'id'                => 'typography_fonts_text',
								'label'             => esc_html__( 'General text font', 'reykjavik' ),
								'description'       => sprintf(
									esc_html__( 'Default value: %s', 'reykjavik' ),
									'<code>' . "'Open Sans', 'Helvetica Neue', Arial, sans-serif" . '</code>'
								),
								'default'           => "'Open Sans', 'Helvetica Neue', Arial, sans-serif",
								'active_callback'   => __CLASS__ . '::is_typography_custom_fonts',
								'sanitize_callback' => 'Reykjavik_Library_Sanitize::fonts',
								'css_var'           => 'Reykjavik_Library_Sanitize::css_fonts',
								'input_attrs'       => array(
									'placeholder' => "'Open Sans', 'Helvetica Neue', Arial, sans-serif",
								),
							),

							900 . 'typography' . 230 => array(
								'type'              => 'text',
								'id'                => 'typography_fonts_headings',
								'label'             => esc_html__( 'Headings font', 'reykjavik' ),
								'description'       => sprintf(
									esc_html__( 'Default value: %s', 'reykjavik' ),
									'<code>' . "'Montserrat', 'Helvetica Neue', Arial, sans-serif" . '</code>'
								),
								'default'           => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
								'active_callback'   => __CLASS__ . '::is_typography_custom_fonts',
								'sanitize_callback' => 'Reykjavik_Library_Sanitize::fonts',
								'css_var'           => 'Reykjavik_Library_Sanitize::css_fonts',
								'input_attrs'       => array(
									'placeholder' => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
								),
							),

							900 . 'typography' . 240 => array(
								'type'              => 'text',
								'id'                => 'typography_fonts_logo',
								'label'             => esc_html__( 'Logo font', 'reykjavik' ),
								'description'       => sprintf(
									esc_html__( 'Default value: %s', 'reykjavik' ),
									'<code>' . "'Montserrat', 'Helvetica Neue', Arial, sans-serif" . '</code>'
								),
								'default'           => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
								'active_callback'   => __CLASS__ . '::is_typography_custom_fonts',
								'sanitize_callback' => 'Reykjavik_Library_Sanitize::fonts',
								'css_var'           => 'Reykjavik_Library_Sanitize::css_fonts',
								'input_attrs'       => array(
									'placeholder' => "'Montserrat', 'Helvetica Neue', Arial, sans-serif",
								),
							),

							900 . 'typography' . 290 => array(
								'type'            => 'html',
								'content'         => '<h3>' . esc_html__( 'Info: CSS selectors', 'reykjavik' ) . '</h3>'
									. '<p class="description">' . esc_html__( 'Here you can find CSS selectors/variables list associated with each font group in the theme. You can use these in your custom font plugin settings.', 'reykjavik' ) . '</p>'

									. '<p>'
									. '<strong>' . esc_html__( 'General text font CSS selectors:', 'reykjavik' ) . '</strong>'
									. '</p>'
									. '<pre>'
									. '--typography_fonts_text'
									. '</pre>'

									. '<p>'
									. '<strong>' . esc_html__( 'Headings font CSS selectors:', 'reykjavik' ) . '</strong>'
									. '</p>'
									. '<pre>'
									. '--typography_fonts_headings'
									. '</pre>'

									. '<p>'
									. '<strong>' . esc_html__( 'Logo font CSS selectors:', 'reykjavik' ) . '</strong>'
									. '</p>'
									. '<pre>'
									. '--typography_fonts_logo'
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



				);


			// Output

				return $options;

		} // /options





	/**
	 * 20) Active callbacks
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
	 * 30) Partial refresh
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
		 * @version  1.3.0
		 */
		public static function partial_texts_site_info() {

			// Helper variables

				$site_info_text = trim( Reykjavik_Library_Customize::get_theme_mod( 'texts_site_info' ) );


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
		 * Get all theme colors in array and cache them.
		 *
		 * @uses  `wmhook_reykjavik_theme_options` global hook
		 *
		 * @subpackage  Customize Options
		 *
		 * @since    2.0.0
		 * @version  2.0.0
		 */
		public static function get_theme_colors() {

			// Requirements check

				$colors = get_transient( self::$cache_colors );

				if ( ! empty( $colors ) ) {
					return (array) $colors;
				}


			// Variables

				$mods          = (array) get_theme_mods();
				$theme_options = (array) apply_filters( 'wmhook_reykjavik_theme_options', array() );


			// Processing

				foreach ( $theme_options as $option ) {
					if ( 'color' === $option['type'] && isset( $option['default'] ) ) {
						$color = ( isset( $mods[ $option['id'] ] ) ) ? ( $mods[ $option['id'] ] ) : ( $option['default'] );
						$colors[ $option['id'] ] = array(
							'id'    => $option['id'],
							'color' => sanitize_hex_color_no_hash( $color ),
							'name'  => ( isset( $option['palette']['name'] ) ) ? ( $option['palette']['name'] ) : ( $option['label'] ),
							'slug'  => ( isset( $option['palette']['slug'] ) ) ? ( $option['palette']['slug'] ) : ( $option['id'] ),
						);
					}
				}

				set_transient( self::$cache_colors, $colors );


			// Output

				return $colors;

		} // /get_theme_colors



			/**
			 * Flush theme colors array cache.
			 *
			 * @since    2.0.0
			 * @version  2.0.0
			 */
			public static function theme_colors_cache_flush() {

				// Processing

					delete_transient( self::$cache_colors );

			} // /theme_colors_cache_flush



		/**
		 * Get alpha values (%) for CSS rgba() colors.
		 *
		 * @since    1.4.0
		 * @version  1.4.0
		 */
		public static function get_rgba_alphas() {

			// Output

				return (array) apply_filters( 'wmhook_reykjavik_customize_get_rgba_alphas', array() );

		} // /get_rgba_alphas



			/**
			 * Set alpha values (%) for CSS rgba() colors.
			 *
			 * @since    1.0.0
			 * @version  1.4.0
			 *
			 * @param  array $alphas
			 */
			public static function rgba_alphas( $alphas = array() ) {

				// Processing

					$alphas['color_content_text']       =
					$alphas['color_footer_text']        =
					$alphas['color_header_text']        =
					$alphas['color_intro_text']         =
					$alphas['color_intro_widgets_text'] =
					20; // Value for all the above.


				// Output

					return $alphas;

			} // /rgba_alphas



			/**
			 * Customize preview RGBA colors.
			 *
			 * @since    1.4.0
			 * @version  1.4.0
			 *
			 * @param  array $options
			 */
			public static function customize_preview_rgba( $options = array() ) {

				// Variables

					$alphas = self::get_rgba_alphas();


				// Processing

					foreach ( $options as $key => $option ) {
						if (
							isset( $option['css_var'] )
							&& isset( $alphas[ $option['id'] ] )
						) {
							$options[ $key ]['preview_js']['css'][':root'][] = array(
								'property'         => '--[[id]]--a' . absint( $alphas[ $option['id'] ] ),
								'prefix'           => 'rgba(',
								'suffix'           => ',.' . absint( $alphas[ $option['id'] ] ) . ')',
								'process_callback' => 'reykjavik.Customize.hexToRgbJoin',
							);
						}
					}


				// Output

					return $options;

			} // /customize_preview_rgba



			/**
			 * Adding RGBA CSS variables.
			 *
			 * @since    1.4.0
			 * @version  1.4.0
			 *
			 * @param  array  $css_vars
			 * @param  array  $option
			 * @param  string $value
			 */
			public static function css_vars_rgba( $css_vars = array(), $option = array(), $value = '' ) {

				// Variables

					$rgba_alphas = self::get_rgba_alphas();


				// Processing

					if (
						isset( $option['id'] )
						&& isset( $rgba_alphas[ $option['id'] ] )
					) {
						$alphas = (array) $rgba_alphas[ $option['id'] ];
						foreach ( $alphas as $alpha ) {
							$css_vars[ '--' . sanitize_title( $option['id'] ) . '--a' . absint( $alpha ) ] = esc_attr( self::color_hex_to_rgba( $value, absint( $alpha ) ) );
						}
					}


				// Output

					return $css_vars;

			} // /css_vars_rgba



			/**
			 * Hex color to RGBA.
			 *
			 * @since    1.4.0
			 * @version  1.4.0
			 *
			 * @link  http://php.net/manual/en/function.hexdec.php
			 *
			 * @param  string $hex
			 * @param  absint $alpha  [0-100]
			 *
			 * @return  string  Color in rgb() or rgba() format for CSS properties.
			 */
			public static function color_hex_to_rgba( $hex, $alpha = 100 ) {

				// Variables

					$alpha  = absint( $alpha );
					$output = ( 100 === $alpha ) ? ( 'rgb(' ) : ( 'rgba(' );

					$rgb = array();

					$hex = preg_replace( '/[^0-9A-Fa-f]/', '', $hex );
					$hex = substr( $hex, 0, 6 );


				// Processing

					// Converting hex color into rgb.
					$color    = (int) hexdec( $hex );
					$rgb['r'] = (int) 0xFF & ( $color >> 0x10 );
					$rgb['g'] = (int) 0xFF & ( $color >> 0x8 );
					$rgb['b'] = (int) 0xFF & $color;
					$output  .= implode( ',', $rgb );

					// Using alpha (rgba)?
					if ( 100 > $alpha ) {
						$output .= ',' . ( $alpha / 100 );
					}

					// Closing opening bracket.
					$output .= ')';


				// Output

					return $output;

			} // /color_hex_to_rgba





} // /Reykjavik_Customize

add_action( 'after_setup_theme', 'Reykjavik_Customize::init' );
